<x-admin-layout>
    <x-slot name="header">Quản lý khách hàng</x-slot>

    <div class="space-y-6">
        <div class="grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <p class="text-sm font-medium text-gray-500">Tổng khách hàng</p>
                <p class="mt-2 text-3xl font-semibold text-gray-900">{{ number_format($stats['total_customers']) }}</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <p class="text-sm font-medium text-gray-500">Đang hoạt động</p>
                <p class="mt-2 text-3xl font-semibold text-emerald-600">{{ number_format($stats['active_customers']) }}</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <p class="text-sm font-medium text-gray-500">Đang bị khóa</p>
                <p class="mt-2 text-3xl font-semibold text-red-600">{{ number_format($stats['locked_customers']) }}</p>
            </div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <form method="GET" action="{{ route('admin.customers.index') }}" class="grid gap-4 lg:grid-cols-4">
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
                    <label class="mb-2 block text-sm font-medium text-gray-700">Trạng thái</label>
                    <select name="status" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Tất cả</option>
                        <option value="active" @selected(request('status') === 'active')>Đang hoạt động</option>
                        <option value="locked" @selected(request('status') === 'locked')>Đang bị khóa</option>
                    </select>
                </div>

                <div class="flex items-end gap-3">
                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                        Lọc dữ liệu
                    </button>
                </div>

                <div class="lg:col-span-4 flex flex-wrap gap-3">
                    <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Xóa bộ lọc
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-900">Danh sách khách hàng</h3>
                <p class="mt-1 text-sm text-gray-500">Tìm kiếm, lọc và phân trang khách hàng trong hệ thống.</p>
            </div>

            @if($customers->isEmpty())
                <div class="p-8 text-center">
                    <h3 class="text-lg font-semibold text-gray-900">Chưa có khách hàng nào</h3>
                    <p class="mt-2 text-sm text-gray-500">Khi có tài khoản khách hàng, danh sách sẽ hiển thị tại đây.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Khách hàng</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Liên hệ</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Đơn hàng</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Yêu cầu TK</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Trạng thái</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($customers as $customer)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-700">
                                                <span class="text-sm font-semibold">{{ mb_substr($customer->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">{{ $customer->name }}</div>
                                                <div class="mt-1 text-xs text-gray-500">ID: {{ $customer->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <div>{{ $customer->email }}</div>
                                        <div class="mt-1 text-xs text-gray-500">{{ $customer->phone ?? 'Chưa có SĐT' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $customer->orders_count }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $customer->design_requests_count }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex flex-col gap-2">
                                            <span class="inline-flex w-fit rounded-full px-3 py-1 text-xs font-semibold {{ $customer->statusBadgeClasses() }}">
                                                {{ $customer->statusLabel() }}
                                            </span>
                                            @if($customer->isLocked() && $customer->locked_at)
                                                <span class="text-xs text-gray-500">Khóa từ {{ $customer->locked_at->format('d/m/Y H:i') }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex flex-wrap justify-end gap-2">
                                            @if(auth()->user()->hasPermission('customer.detail'))
                                                <a href="{{ route('admin.customers.show', $customer) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Chi tiết</a>
                                            @endif

                                            @if(auth()->user()->hasPermission('customer.lock'))
                                                @if($customer->isLocked())
                                                    <x-confirm-status-modal
                                                        :name="'unlock-customer-'.$customer->id"
                                                        :action="route('admin.customers.status', $customer)"
                                                        title="Mở khóa tài khoản?"
                                                        message="Bạn chắc chắn muốn mở khóa tài khoản khách hàng này?"
                                                        trigger-label="Mở khóa"
                                                        confirm-label="Mở khóa"
                                                        confirm-class="bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500"
                                                        tone="green"
                                                        trigger-class="text-sm font-medium text-emerald-600 hover:text-emerald-700 bg-transparent border-0 p-0"
                                                    />
                                                @else
                                                    <x-confirm-status-modal
                                                        :name="'lock-customer-'.$customer->id"
                                                        :action="route('admin.customers.status', $customer)"
                                                        title="Khóa tài khoản?"
                                                        message="Bạn chắc chắn muốn khóa tài khoản khách hàng này?"
                                                        trigger-label="Khóa"
                                                        confirm-label="Khóa"
                                                        show-reason-field
                                                        :reason-name="'lock_reason_'.$customer->id"
                                                        reason-label="Lý do khóa"
                                                        reason-placeholder="Nhập lý do khóa tài khoản"
                                                        reason-help="Lý do này sẽ được lưu để quản trị viên theo dõi."
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
                    {{ $customers->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
