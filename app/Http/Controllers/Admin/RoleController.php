<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Hiển thị danh sách vai trò.
     */
    public function index(Request $request)
    {
        $roles = Role::query()
            ->withCount('users')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Hiển thị form tạo vai trò mới.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Lưu vai trò mới.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:roles,code'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_system'] = false;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Role::create($validated);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Vai trò đã được tạo thành công.');
    }

    /**
     * Hiển thị form chỉnh sửa vai trò.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Cập nhật vai trò.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', Rule::unique('roles', 'code')->ignore($role->id)],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        // Không cho sửa code của vai trò hệ thống
        if ($role->is_system) {
            unset($validated['code']);
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $role->update($validated);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Vai trò đã được cập nhật thành công.');
    }

    /**
     * Xóa vai trò.
     */
    public function destroy(Role $role)
    {
        // Không cho xóa vai trò hệ thống
        if ($role->is_system) {
            return back()->with('error', 'Không thể xóa vai trò hệ thống.');
        }

        // Kiểm tra vai trò có đang được gán cho user không
        if ($role->users()->count() > 0) {
            return back()->with('error', 'Không thể xóa vai trò đang được gán cho người dùng.');
        }

        // Xóa quyền liên kết trước khi soft delete
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Vai trò đã được xóa thành công.');
    }
}
