<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Hiển thị trang gán quyền cho vai trò.
     * Hiển thị danh sách quyền nhóm theo module, tick chọn quyền hiện tại của vai trò.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::query()
            ->orderBy('module')
            ->orderBy('name')
            ->get()
            ->groupBy('module');

        $rolePermissionIds = $role->permissions()->pluck('permissions.id')->toArray();

        return view('admin.permissions.edit', compact('role', 'permissions', 'rolePermissionIds'));
    }

    /**
     * Lưu quyền đã gán cho vai trò.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ]);

        $user = $request->user();

        // Không cho nhân viên tự cấp quyền cho vai trò của chính mình
        if ($user->roles()->where('roles.id', $role->id)->exists()) {
            // Kiểm tra user có phải admin không (admin được phép)
            if (!$user->hasRole('admin')) {
                return back()->with('error', 'Bạn không thể gán quyền cho vai trò của chính mình.');
            }
        }

        $permissionIds = $validated['permissions'] ?? [];

        $role->permissions()->sync($permissionIds);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Quyền đã được cập nhật cho vai trò "' . $role->name . '".');
    }
}
