<x-admin-layout>
    <x-slot name="header">Chi tiết đơn hàng</x-slot>

    <div class="space-y-6">
        <div class="flex flex-col gap-3 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-medium text-indigo-600">Mã đơn: {{ $order->order_code }}</p>
                <h2 class="mt-1 text-2xl font-semibold text-gray-900">{{ $order->customer_name }}</h2>
                <p class="mt-1 text-sm text-gray-500">{{ $order->customer_phone }} @if($order->customer_email) · {{ $order->customer_email }} @endif</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Quay lại danh sách
                </a>
                @if($order->status !== 'completed' && $order->status !== 'cancelled' && $order->status !== 'returned')
                    <a href="#update-status" class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                        Cập nhật trạng thái
                    </a>
                @endif
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.15fr,0.85fr]">
            <div class="space-y-6">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Thông tin đơn hàng</h3>
                            <p class="mt-1 text-sm text-gray-500">Ngày đặt: {{ $order->placed_at?->format('d/m/Y H:i') }}</p>
                        </div>
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $order->statusBadgeClasses() }}">
                            {{ $order->statusLabel() }}
                        </span>
                    </div>

                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Khách hàng</p>
                            <p class="mt-2 text-sm font-medium text-gray-900">{{ $order->customer_name }}</p>
                            <p class="mt-1 text-sm text-gray-600">{{ $order->customer_phone }}</p>
                            @if($order->customer_email)
                                <p class="mt-1 text-sm text-gray-600">{{ $order->customer_email }}</p>
                            @endif
                        </div>

                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Giao hàng</p>
                            <p class="mt-2 text-sm text-gray-900 whitespace-pre-line">{{ $order->shipping_address }}</p>
                            @if($order->shipping_note)
                                <p class="mt-2 text-sm text-gray-600 whitespace-pre-line">{{ $order->shipping_note }}</p>
                            @endif
                        </div>

                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Thanh toán</p>
                            <p class="mt-2 text-sm font-medium text-gray-900">{{ $paymentMethodLabels[$order->payment_method] ?? $order->payment_method }}</p>
                            <p class="mt-1 text-sm text-gray-600">Trạng thái thanh toán: {{ $order->payment_status }}</p>
                        </div>

                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Nhân viên tạo đơn</p>
                            <p class="mt-2 text-sm font-medium text-gray-900">{{ $order->user?->name ?? 'Hệ thống' }}</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-900">Danh sách sản phẩm</h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <div class="flex gap-4 p-6">
                                <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-xl bg-gray-100">
                                    @if($item->product_image_path_snapshot)
                                        <img src="{{ asset('storage/' . $item->product_image_path_snapshot) }}" alt="{{ $item->product_name_snapshot }}" class="h-full w-full object-cover">
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                                        <div>
                                            <h4 class="text-sm font-semibold text-gray-900">{{ $item->product_name_snapshot }}</h4>
                                            <p class="mt-1 text-sm text-gray-500">Mã SP: {{ $item->product_code_snapshot ?? 'N/A' }}</p>
                                        </div>
                                        <div class="text-right text-sm">
                                            <p class="font-semibold text-gray-900">{{ number_format($item->line_total, 0, ',', '.') }} đ</p>
                                            <p class="mt-1 text-gray-500">{{ number_format($item->unit_price, 0, ',', '.') }} đ x {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Lịch sử trạng thái</h3>
                    <div class="mt-4 space-y-4">
                        @forelse($order->statusLogs as $log)
                            <div class="rounded-2xl border border-gray-200 p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $log->from_status ?? 'Khởi tạo' }} → {{ $log->to_status }}</p>
                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $log->created_at?->format('d/m/Y H:i') }}
                                            @if($log->changedBy)
                                                · {{ $log->changedBy->name }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @if($log->note)
                                    <p class="mt-2 text-sm text-gray-600">{{ $log->note }}</p>
                                @endif
                                @if($log->reason)
                                    <p class="mt-2 text-sm text-red-600">{{ $log->reason }}</p>
                                @endif
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Chưa có lịch sử trạng thái.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Tổng kết</h3>
                    <div class="mt-4 space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">Tạm tính</span>
                            <span class="font-medium text-gray-900">{{ number_format($order->subtotal, 0, ',', '.') }} đ</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">Phí vận chuyển</span>
                            <span class="font-medium text-gray-900">{{ number_format($order->shipping_fee, 0, ',', '.') }} đ</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">Giảm giá</span>
                            <span class="font-medium text-gray-900">{{ number_format($order->discount_amount, 0, ',', '.') }} đ</span>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-3">
                            <span class="text-gray-500">Tổng thanh toán</span>
                            <span class="text-lg font-semibold text-indigo-600">{{ number_format($order->total_amount, 0, ',', '.') }} đ</span>
                        </div>
                    </div>
                </div>

                @if($order->status !== 'completed' && $order->status !== 'cancelled' && $order->status !== 'returned')
                    <div id="update-status" class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Cập nhật trạng thái</h3>
                        <p class="mt-1 text-sm text-gray-500">Luồng hợp lệ sẽ được kiểm tra tự động. Khi chuyển từ pending → processing, hệ thống sẽ trừ tồn kho.</p>

                        @if($errors->any())
                            <div class="mt-4 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.orders.status.update', $order) }}" class="mt-4 space-y-4">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Trạng thái mới</label>
                                <select name="status" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Chọn trạng thái</option>
                                    @foreach($availableStatuses as $status)
                                        <option value="{{ $status }}" @selected(old('status') === $status)>{{ $statusLabels[$status] ?? $status }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Ghi chú</label>
                                <textarea name="note" rows="4" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ghi chú cập nhật trạng thái...">{{ old('note') }}</textarea>
                                @error('note')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="w-full rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                                Lưu trạng thái
                            </button>
                        </form>
                    </div>

                    <div class="rounded-2xl border border-red-200 bg-red-50 p-6">
                        <h3 class="text-lg font-semibold text-red-800">Hủy đơn hàng</h3>
                        <p class="mt-1 text-sm text-red-700">
                            Không thể hủy đơn đã hoàn thành. Nếu đơn đã trừ kho, hệ thống sẽ cộng lại tồn kho trong transaction.
                        </p>

                        <form method="POST" action="{{ route('admin.orders.cancel', $order) }}" class="mt-4 space-y-4">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label class="mb-2 block text-sm font-medium text-red-800">Lý do hủy</label>
                                <textarea name="cancel_reason" rows="4" class="w-full rounded-xl border-red-200 focus:border-red-500 focus:ring-red-500" placeholder="Nhập lý do hủy đơn...">{{ old('cancel_reason') }}</textarea>
                                @error('cancel_reason')
                                    <p class="mt-2 text-sm text-red-700">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="w-full rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                                Hủy đơn hàng
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
