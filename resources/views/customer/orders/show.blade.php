<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Chi tiết đơn hàng
                </h2>
                <p class="mt-1 text-sm text-gray-500">{{ $order->order_code }}</p>
            </div>
            <a href="{{ route('orders.index') }}" class="secondary-button">
                Quay lại lịch sử
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Thông tin đơn hàng</h3>
                                    <p class="mt-1 text-sm text-gray-500">Mã đơn: {{ $order->order_code }}</p>
                                </div>
                                <span @class([
                                    'inline-flex rounded-full px-3 py-1 text-xs font-semibold',
                                    'bg-yellow-50 text-yellow-700' => $order->status === 'pending',
                                    'bg-blue-50 text-blue-700' => $order->status === 'processing',
                                'bg-primary/10 text-primary' => $order->status === 'preparing',
                                    'bg-sky-50 text-sky-700' => $order->status === 'shipping',
                                    'bg-green-50 text-green-700' => $order->status === 'completed',
                                    'bg-red-50 text-red-700' => $order->status === 'cancelled',
                                    'bg-rose-50 text-rose-700' => $order->status === 'returned',
                                ])>
                                {{ $order->status }}
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
                        </div>
                    </div>

                    <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Sản phẩm trong đơn</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @foreach($order->items as $item)
                                <div class="p-6 flex gap-4">
                                    <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-lg bg-gray-100">
                                        @if($item->product_image_path_snapshot)
                                            <img src="{{ asset('storage/' . $item->product_image_path_snapshot) }}" alt="{{ $item->product_name_snapshot }}" class="h-full w-full object-cover">
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h4 class="text-sm font-semibold text-gray-900">{{ $item->product_name_snapshot }}</h4>
                                        <p class="mt-1 text-sm text-gray-500">Mã SP: {{ $item->product_code_snapshot ?? 'N/A' }}</p>
                                        <div class="mt-2 flex flex-wrap gap-x-6 gap-y-1 text-sm text-gray-600">
                                            <span>SL: {{ $item->quantity }}</span>
                                            <span>Đơn giá: {{ number_format($item->unit_price, 0, ',', '.') }}đ</span>
                                            <span>Thành tiền: {{ number_format($item->line_total, 0, ',', '.') }}đ</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900">Tổng kết</h3>
                        <div class="mt-4 space-y-3 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500">Tạm tính</span>
                                <span class="font-medium text-gray-900">{{ number_format($order->subtotal, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500">Phí vận chuyển</span>
                                <span class="font-medium text-gray-900">{{ number_format($order->shipping_fee, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500">Giảm giá</span>
                                <span class="font-medium text-gray-900">{{ number_format($order->discount_amount, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-3">
                                <span class="text-gray-500">Tổng thanh toán</span>
                                <span class="text-lg font-semibold text-primary">{{ number_format($order->total_amount, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
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
            </div>
        </div>
    </div>
</x-app-layout>
