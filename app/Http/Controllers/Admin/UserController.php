<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->with(['roles' => fn ($query) => $query->orderBy('sort_order')->orderBy('name')])
            ->whereHas('roles', function ($query) {
                $query->whereIn('code', ['admin', 'staff']);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim($request->string('search')->toString());

                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->when($request->filled('role'), function ($query) use ($request) {
                $query->whereHas('roles', function ($roleQuery) use ($request) {
                    $roleQuery->where('code', $request->string('role')->toString());
                });
            })
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        $roleOptions = Role::query()
            ->whereIn('code', ['admin', 'staff'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.users.index', [
            'users' => $users,
            'roleOptions' => $roleOptions,
            'stats' => [
                'total_users' => User::query()->whereHas('roles', fn ($query) => $query->whereIn('code', ['admin', 'staff']))->count(),
                'active_users' => User::query()->whereHas('roles', fn ($query) => $query->whereIn('code', ['admin', 'staff']))->where('status', 'active')->count(),
                'locked_users' => User::query()->whereHas('roles', fn ($query) => $query->whereIn('code', ['admin', 'staff']))->where('status', 'locked')->count(),
                'active_admins' => User::query()->whereHas('roles', fn ($query) => $query->where('code', 'admin'))->where('status', 'active')->count(),
            ],
        ]);
    }

    public function create(): View
    {
        return view('admin.users.create', [
            'user' => new User(),
            'roles' => Role::query()
                ->whereIn('code', ['admin', 'staff'])
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateUser($request);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'password' => $validated['password'],
                'status' => 'active',
                'email_verified_at' => now(),
            ]);

            $user->roles()->sync([$validated['role_id']]);
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Đã tạo người dùng nội bộ thành công.');
    }

    public function edit(User $user): View
    {
        $this->ensureInternalUser($user);

        $user->load('roles');

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::query()
                ->whereIn('code', ['admin', 'staff'])
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
            'canLock' => !($user->status === 'active' && $user->hasRole('admin') && $this->activeAdminCountExcluding($user) === 0),
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->ensureInternalUser($user);

        $validated = $this->validateUser($request, $user);

        $targetRole = Role::query()->findOrFail($validated['role_id']);

        if ($user->hasRole('admin') && $targetRole->code !== 'admin' && $this->activeAdminCountExcluding($user) === 0) {
            return back()->with('error', 'Không thể thay đổi vai trò vì hệ thống cần ít nhất một admin đang hoạt động.')->withInput();
        }

        DB::transaction(function () use ($validated, $user) {
            $user = User::query()->withTrashed()->lockForUpdate()->findOrFail($user->id);

            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
            ];

            if (! empty($validated['password'])) {
                $data['password'] = $validated['password'];
            }

            $user->update($data);
            $user->roles()->sync([$validated['role_id']]);
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Đã cập nhật người dùng nội bộ thành công.');
    }

    public function toggleLock(User $user): RedirectResponse
    {
        $this->ensureInternalUser($user);

        if ($user->status === 'active' && $user->hasRole('admin') && $this->activeAdminCountExcluding($user) === 0) {
            return back()->with('error', 'Không thể khóa admin duy nhất.');
        }

        DB::transaction(function () use ($user) {
            $user = User::query()->withTrashed()->lockForUpdate()->findOrFail($user->id);

            if ($user->status === 'active') {
                $user->status = 'locked';
                $user->lock_reason = 'Khóa bởi quản trị viên.';
                $user->locked_at = now();
                $user->save();
            } else {
                $user->status = 'active';
                $user->lock_reason = null;
                $user->locked_at = null;
                $user->save();
            }
        });

        return back()->with('success', 'Đã cập nhật trạng thái người dùng.');
    }

    private function validateUser(Request $request, ?User $user = null): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user?->id)],
            'phone' => ['nullable', 'string', 'max:20', Rule::unique('users', 'phone')->ignore($user?->id)],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:8', 'max:255'],
            'role_id' => [
                'required',
                'integer',
                Rule::exists('roles', 'id')->where(function ($query) {
                    $query->whereIn('code', ['admin', 'staff']);
                }),
            ],
        ];

        $validated = $request->validate($rules);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        return $validated;
    }

    private function ensureInternalUser(User $user): void
    {
        abort_unless($user->roles()->whereIn('code', ['admin', 'staff'])->exists(), 404);
    }

    private function activeAdminCountExcluding(User $user): int
    {
        return User::query()
            ->where('id', '!=', $user->id)
            ->where('status', 'active')
            ->whereHas('roles', fn ($query) => $query->where('code', 'admin'))
            ->count();
    }
}
