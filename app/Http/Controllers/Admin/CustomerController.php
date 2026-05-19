<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        $customers = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('code', 'customer');
            })
            ->withCount(['orders', 'designRequests'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim($request->string('search')->toString());

                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.customers.index', [
            'customers' => $customers,
            'stats' => [
                'total_customers' => User::query()->whereHas('roles', fn ($query) => $query->where('code', 'customer'))->count(),
                'active_customers' => User::query()->whereHas('roles', fn ($query) => $query->where('code', 'customer'))->where('status', 'active')->count(),
                'locked_customers' => User::query()->whereHas('roles', fn ($query) => $query->where('code', 'customer'))->where('status', 'locked')->count(),
            ],
        ]);
    }

    public function show(User $customer): View
    {
        abort_unless($customer->hasRole('customer'), 404);

        $customer->loadCount(['orders', 'designRequests']);

        $orders = $customer->orders()
            ->with(['items.product'])
            ->withCount('items')
            ->latest('placed_at')
            ->paginate(8, ['*'], 'orders_page');

        $designRequests = $customer->designRequests()
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('admin.customers.show', compact('customer', 'orders', 'designRequests'));
    }

    public function updateStatus(Request $request, User $customer): RedirectResponse
    {
        abort_unless($customer->hasRole('customer'), 404);

        $wasLocked = $customer->status === 'locked';

        DB::transaction(function () use ($request, $customer) {
            $customer = User::query()->withTrashed()->lockForUpdate()->findOrFail($customer->id);

            if ($customer->status === 'locked') {
                $customer->status = 'active';
                $customer->lock_reason = null;
                $customer->locked_at = null;
                $customer->save();

                return;
            }

            $reasonKey = collect(array_keys($request->all()))
                ->first(fn ($key) => str_starts_with($key, 'lock_reason_')) ?? 'lock_reason';

            $validated = $request->validate([
                $reasonKey => ['required', 'string', 'min:3', 'max:1000'],
            ]);

            $customer->status = 'locked';
            $customer->lock_reason = trim($validated[$reasonKey]);
            $customer->locked_at = now();
            $customer->save();
        });

        $message = $wasLocked
            ? 'Đã mở khóa tài khoản khách hàng.'
            : 'Đã khóa tài khoản khách hàng.';

        return redirect()
            ->back()
            ->with('success', $message);
    }
}
