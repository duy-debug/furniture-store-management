<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hóa đơn {{ $order->order_code }}</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: #fff !important;
            }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="no-print mb-6 flex items-center justify-between">
            <a href="{{ route('admin.orders.show', $order) }}" class="secondary-button">
                Quay lại
            </a>
            <button type="button" onclick="window.print()" class="primary-button">
                In hóa đơn
            </button>
        </div>

        <div class="rounded-[2rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-col gap-6 border-b border-slate-200 pb-6 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <img src="{{ asset('images/logothongmai.jpg') }}" alt="Thông Mai" class="h-12 w-12 rounded-xl object-cover ring-1 ring-slate-200">
                    <h1 class="mt-4 text-3xl font-bold text-slate-900">Hóa đơn thanh toán</h1>
                    <p class="mt-2 text-sm text-slate-600">Mã đơn: <span class="font-semibold text-slate-900">{{ $order->order_code }}</span></p>
                    <p class="text-sm text-slate-600">Ngày đặt: {{ $order->placed_at?->format('d/m/Y H:i') }}</p>
                </div>

                <div class="rounded-2xl bg-primary/5 px-5 py-4 ring-1 ring-primary/10">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary">Trạng thái</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $order->statusLabel() }}</p>
                </div>
            </div>

            <div class="mt-6 grid gap-6 md:grid-cols-2">
                <div class="rounded-2xl bg-slate-50 p-5 ring-1 ring-slate-200">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary">Thông tin khách hàng</p>
                    <div class="mt-4 space-y-2 text-sm text-slate-700">
                        <p><span class="font-semibold text-slate-900">Họ tên:</span> {{ $order->customer_name }}</p>
                        <p><span class="font-semibold text-slate-900">SĐT:</span> {{ $order->customer_phone }}</p>
                        @if($order->customer_email)
                            <p><span class="font-semibold text-slate-900">Email:</span> {{ $order->customer_email }}</p>
                        @endif
                        <p><span class="font-semibold text-slate-900">Địa chỉ giao hàng:</span> {{ $order->shipping_address }}</p>
                    </div>
                </div>

                <div class="rounded-2xl bg-slate-50 p-5 ring-1 ring-slate-200">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary">Thanh toán</p>
                    <div class="mt-4 space-y-2 text-sm text-slate-700">
                        <p><span class="font-semibold text-slate-900">Phương thức:</span> {{ $paymentMethodLabels[$order->payment_method] ?? $order->payment_method }}</p>
                        <p><span class="font-semibold text-slate-900">Trạng thái thanh toán:</span> {{ $order->payment_status }}</p>
                        @if($order->shipping_note)
                            <p><span class="font-semibold text-slate-900">Ghi chú:</span> {{ $order->shipping_note }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8 overflow-hidden rounded-2xl border border-slate-200">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Sản phẩm</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Đơn giá</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Số lượng</th>
                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="px-5 py-4">
                                    <div class="font-medium text-slate-900">{{ $item->product_name_snapshot }}</div>
                                    <div class="text-sm text-slate-500">{{ $item->product_code_snapshot ?? 'N/A' }}</div>
                                </td>
                                <td class="px-5 py-4 text-right text-sm text-slate-700">{{ number_format($item->unit_price, 0, ',', '.') }} đ</td>
                                <td class="px-5 py-4 text-right text-sm text-slate-700">{{ $item->quantity }}</td>
                                <td class="px-5 py-4 text-right text-sm font-semibold text-slate-900">{{ number_format($item->line_total, 0, ',', '.') }} đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8 flex justify-end">
                <div class="w-full max-w-md rounded-2xl bg-slate-50 p-5 ring-1 ring-slate-200">
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">Tạm tính</span>
                            <span class="font-medium text-slate-900">{{ number_format($order->subtotal, 0, ',', '.') }} đ</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">Phí vận chuyển</span>
                            <span class="font-medium text-slate-900">{{ number_format($order->shipping_fee, 0, ',', '.') }} đ</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">Giảm giá</span>
                            <span class="font-medium text-slate-900">{{ number_format($order->discount_amount, 0, ',', '.') }} đ</span>
                        </div>
                        <div class="flex items-center justify-between border-t border-slate-200 pt-3">
                            <span class="text-base font-semibold text-slate-900">Tổng thanh toán</span>
                            <span class="text-xl font-bold text-primary">{{ number_format($order->total_amount, 0, ',', '.') }} đ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
