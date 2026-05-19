<x-admin-layout>
    <x-slot name="header">Chi tiết khách hàng</x-slot>

    <div class="space-y-6">
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-lg font-semibold text-indigo-700">
                        {{ mb_substr($customer->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-indigo-600">Khách hàng #{{ $customer->id }}</p>
                        <h2 class="mt-1 text-2xl font-semibold text-gray-900">{{ $customer->name }}</h2>
                        <div class="mt-2 flex flex-wrap gap-2">
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $customer->statusBadgeClasses() }}">
                                {{ $customer->statusLabel() }}
                            </span>
                            <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                {{ $customer->orders_count }} đơn hàng
                            </span>
                            <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                {{ $customer->design_requests_count }} yêu cầu thiết kế
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-2">
                    @if(auth()->user()->hasPermission('customer.lock'))
                        @if($customer->isLocked())
                            <x-confirm-status-modal
                                :name="'unlock-customer-detail-'.$customer->id"
                                :action="route('admin.customers.status', $customer)"
                                title="Mở khóa tài khoản?"
                                message="Bạn chắc chắn muốn mở khóa tài khoản khách hàng này?"
                                trigger-label="Mở khóa"
                                confirm-label="Mở khóa"
                                confirm-class="bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500"
                                tone="green"
                                trigger-class="inline-flex items-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700"
                            />
                        @else
                            <x-confirm-status-modal
                                :name="'lock-customer-detail-'.$customer->id"
                                :action="route('admin.customers.status', $customer)"
                                title="Khóa tài khoản?"
                                message="Bạn chắc chắn muốn khóa tài khoản khách hàng này?"
                                trigger-label="Khóa"
                                confirm-label="Khóa"
                                show-reason-field
                                :reason-name="'lock_reason_'.$customer->id"
                                reason-label="Lý do khóa"
                                reason-placeholder="Nhập lý do khóa tài khoản"
                                reason-help="Lý do này sẽ được lưu trong hồ sơ khách hàng."
                                trigger-class="inline-flex items-center rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700"
                            />
                        @endif
                    @endif
                    <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[0.9fr,1.1fr]">
            <div class="space-y-6">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Thông tin cá nhân</h3>
                    <div class="mt-4 space-y-3 text-sm">
                        <div class="flex items-start justify-between gap-4">
                            <span class="text-gray-500">Email</span>
                            <span class="font-medium text-gray-900">{{ $customer->email }}</span>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <span class="text-gray-500">Số điện thoại</span>
                            <span class="font-medium text-gray-900">{{ $customer->phone ?? 'Chưa có' }}</span>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <span class="text-gray-500">Ngày sinh</span>
                            <span class="font-medium text-gray-900">{{ $customer->birthday?->format('d/m/Y') ?? 'Chưa có' }}</span>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <span class="text-gray-500">Giới tính</span>
                            <span class="font-medium text-gray-900">{{ $customer->gender ?? 'Chưa có' }}</span>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <span class="text-gray-500">Địa chỉ</span>
                            <span class="font-medium text-right text-gray-900">{{ $customer->fullAddress() ?: 'Chưa có' }}</span>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <span class="text-gray-500">Lần đăng nhập cuối</span>
                            <span class="font-medium text-gray-900">{{ $customer->last_login_at?->format('d/m/Y H:i') ?? 'Chưa có' }}</span>
                        </div>
                        @if($customer->isLocked())
                            <div class="rounded-2xl bg-red-50 p-4 text-sm text-red-700">
                                <p class="font-semibold">Lý do khóa</p>
                                <p class="mt-1">{{ $customer->lock_reason ?? 'Chưa ghi nhận' }}</p>
                                <p class="mt-2 text-xs text-red-600">Khóa lúc: {{ $customer->locked_at?->format('d/m/Y H:i') ?? 'Chưa có' }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Yêu cầu thiết kế gần nhất</h3>
                    <div class="mt-4 space-y-3">
                        @forelse($designRequests as $request)
                            <div class="rounded-2xl border border-gray-200 p-4">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $request->spaceTypeLabel() }}</p>
                                        <p class="mt-1 text-xs text-gray-500">{{ $request->created_at?->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $request->statusBadgeClasses() }}">
                                        {{ $request->statusLabel() }}
                                    </span>
                                </div>
                                <p class="mt-3 text-sm text-gray-600">{{ $request->space_address }}</p>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Khách hàng chưa có yêu cầu thiết kế nào.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Đơn hàng liên quan</h3>
                        <p class="mt-1 text-sm text-gray-500">Sắp xếp mới nhất trước.</p>
                    </div>
                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                        {{ $orders->total() }} đơn
                    </span>
                </div>

                <div class="mt-6 overflow-hidden rounded-2xl border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Mã đơn</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Ngày đặt</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Tổng tiền</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Trạng thái</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $order->order_code }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $order->placed_at?->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ number_format($order->total_amount, 0, ',', '.') }} đ</td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $order->statusBadgeClasses() }}">
                                            {{ $order->statusLabel() }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        @if(auth()->user()->hasPermission('order.view'))
                                            <a href="{{ route('admin.orders.show', $order) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                                                Xem
                                            </a>
                                        @else
                                            <span class="text-sm text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">Khách hàng chưa có đơn hàng nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-0 pt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
