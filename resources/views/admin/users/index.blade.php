<x-admin-layout>
    <x-slot name="header">Quản lý người dùng nội bộ</x-slot>

    <div class="space-y-6">
        <div class="grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <p class="text-sm font-medium text-gray-500">Tổng người dùng</p>
                <p class="mt-2 text-3xl font-semibold text-gray-900">{{ number_format($stats['total_users']) }}</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <p class="text-sm font-medium text-gray-500">Đang hoạt động</p>
                <p class="mt-2 text-3xl font-semibold text-emerald-600">{{ number_format($stats['active_users']) }}</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <p class="text-sm font-medium text-gray-500">Đang bị khóa</p>
                <p class="mt-2 text-3xl font-semibold text-red-600">{{ number_format($stats['locked_users']) }}</p>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <form method="GET" action="{{ route('admin.users.index') }}" class="grid gap-4 lg:grid-cols-4">
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Tìm kiếm</label>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Tên, email, số điện thoại"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Vai trò</label>
                    <select name="role" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Tất cả</option>
                        @foreach($roleOptions as $role)
                            <option value="{{ $role->code }}" @selected(request('role') === $role->code)>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Trạng thái</label>
                    <select name="status" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Tất cả</option>
                        <option value="active" @selected(request('status') === 'active')>Đang hoạt động</option>
                        <option value="locked" @selected(request('status') === 'locked')>Đang bị khóa</option>
                    </select>
                </div>

                <div class="lg:col-span-4 flex flex-wrap gap-3">
                    <button type="submit" class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                        Lọc dữ liệu
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Xóa bộ lọc
                    </a>
                    @if(auth()->user()->hasPermission('user.create'))
                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white hover:bg-slate-800">
                            Thêm người dùng
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-900">Danh sách người dùng nội bộ</h3>
                <p class="mt-1 text-sm text-gray-500">Chỉ hiển thị tài khoản quản trị và nhân viên.</p>
            </div>

            @if($users->isEmpty())
                <div class="p-8 text-center">
                    <h3 class="text-lg font-semibold text-gray-900">Chưa có người dùng nào</h3>
                    <p class="mt-2 text-sm text-gray-500">Hãy tạo người dùng nội bộ đầu tiên.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Người dùng</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Liên hệ</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Vai trò</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Trạng thái</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-700">
                                                <span class="text-sm font-semibold">{{ mb_substr($user->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                                <div class="mt-1 text-xs text-gray-500">ID: {{ $user->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <div>{{ $user->email }}</div>
                                        <div class="mt-1 text-xs text-gray-500">{{ $user->phone ?? 'Chưa có SĐT' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($user->roles as $role)
                                                <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $user->statusBadgeClasses() }}">
                                            {{ $user->statusLabel() }}
                                        </span>
                                        @if($user->isLocked() && $user->lock_reason)
                                            <p class="mt-2 text-xs text-gray-500">{{ $user->lock_reason }}</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex flex-wrap justify-end gap-2">
                                            @if(auth()->user()->hasPermission('user.update'))
                                                <a href="{{ route('admin.users.edit', $user) }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-900">Sửa</a>
                                            @endif
                                            @if(auth()->user()->hasPermission('user.lock'))
                                                @if($user->isLocked())
                                                    <x-confirm-status-modal
                                                        :name="'unlock-user-'.$user->id"
                                                        :action="route('admin.users.status', $user)"
                                                        title="Mở khóa người dùng?"
                                                        message="Bạn chắc chắn muốn mở khóa người dùng này?"
                                                        trigger-label="Mở khóa"
                                                        confirm-label="Mở khóa"
                                                        confirm-class="bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500"
                                                        tone="green"
                                                        trigger-class="text-sm font-medium text-emerald-600 hover:text-emerald-700 bg-transparent border-0 p-0"
                                                    />
                                                @elseif($user->hasRole('admin') && $stats['active_admins'] <= 1)
                                                    <span class="text-sm font-medium text-gray-400">Admin duy nhất</span>
                                                @else
                                                    <x-confirm-status-modal
                                                        :name="'lock-user-'.$user->id"
                                                        :action="route('admin.users.status', $user)"
                                                        title="Khóa người dùng?"
                                                        message="Bạn chắc chắn muốn khóa người dùng này?"
                                                        trigger-label="Khóa"
                                                        confirm-label="Khóa"
                                                        confirm-class="bg-red-600 hover:bg-red-700 focus:ring-red-500"
                                                        tone="red"
                                                        trigger-class="text-sm font-medium text-red-600 hover:text-red-700 bg-transparent border-0 p-0"
                                                    />
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
