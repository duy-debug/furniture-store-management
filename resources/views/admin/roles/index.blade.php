<x-admin-layout>
    <x-slot name="header">Quản lý vai trò</x-slot>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Danh sách vai trò</h2>
        @if(auth()->user()->hasPermission('role.create'))
                <a href="{{ route('admin.roles.create') }}"
                    class="primary-button">
                + Thêm vai trò
            </a>
        @endif
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mô tả</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Người dùng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hệ thống</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($roles as $role)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $role->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $role->code }}</code>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
                                {{ $role->description ?? '—' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $role->users_count }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($role->is_system)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Hệ thống
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Tùy chỉnh
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                @if(auth()->user()->hasPermission('permission.assign'))
                                    <a href="{{ route('admin.roles.permissions.edit', $role) }}"
                                       class="text-indigo-600 hover:text-indigo-900">Quyền</a>
                                @endif

                                @if(auth()->user()->hasPermission('role.update'))
                                    <a href="{{ route('admin.roles.edit', $role) }}"
                                       class="text-yellow-600 hover:text-yellow-900">Sửa</a>
                                @endif

                                @if(auth()->user()->hasPermission('role.delete') && !$role->is_system)
                                    <x-confirm-delete-modal
                                        :name="'delete-role-'.$role->id"
                                        :action="route('admin.roles.destroy', $role)"
                                        title="Xóa vai trò?"
                                        message="Bạn có chắc muốn xóa vai trò này?"
                                        trigger-label="Xóa"
                                        confirm-label="Xóa"
                                        trigger-class="text-sm font-medium text-red-600 hover:text-red-700 bg-transparent border-0 p-0"
                                    />
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                Chưa có vai trò nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
