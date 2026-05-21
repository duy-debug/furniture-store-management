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
@php
    $vatRate = 0.10;
    $subtotal = (float) $order->subtotal;
    $vatAmount = (float) ($order->tax_amount ?? round($subtotal * $vatRate, 0));
    $grandTotal = (float) $order->total_amount;
    $paidAmount = $grandTotal;
    $remainingAmount = 0;
    $invoiceDate = $order->completed_at ?? $order->placed_at ?? now();
    $paymentMethodText = $paymentMethodLabels[$order->payment_method] ?? $order->payment_method;
@endphp

    <div class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="no-print mb-6 flex items-center justify-between">
            <a href="{{ route('admin.orders.show', $order) }}" class="secondary-button">
                Quay lại
            </a>
            <button type="button" onclick="window.print()" class="primary-button">
                In hóa đơn
            </button>
        </div>

        <div class="rounded-[1.25rem] bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <div class="border-b-2 border-slate-900 pb-5 text-center">
                <p class="text-base font-semibold uppercase tracking-[0.25em] text-slate-600">PHIẾU XUẤT HÓA ĐƠN</p>
                <div class="mt-3 flex flex-col gap-2 text-sm text-slate-700 sm:flex-row sm:items-center sm:justify-center sm:gap-4">
                    <p><span class="font-semibold text-slate-900">Số hóa đơn:</span> {{ $order->order_code }}</p>
                    <span class="hidden sm:inline text-slate-400">|</span>
                    <p><span class="font-semibold text-slate-900">Ngày xuất:</span> {{ $invoiceDate->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="mt-6 grid gap-6 md:grid-cols-2">
                <section class="rounded-2xl border border-slate-200 p-5">
                    <h2 class="text-sm font-bold uppercase tracking-[0.22em] text-slate-900">I. THÔNG TIN BÊN BÁN</h2>
                    <div class="mt-4 space-y-2 text-sm text-slate-700">
                        <p><span class="font-semibold text-slate-900">Tên cửa hàng:</span> Nội thất Thông Mai</p>
                        <p><span class="font-semibold text-slate-900">Số điện thoại:</span> 0900 000 000</p>
                        <p><span class="font-semibold text-slate-900">Địa chỉ:</span> 115 Nguyễn Xiển, phường Bắc Nha Trang, Khánh Hòa</p>
                        <p><span class="font-semibold text-slate-900">MST / Mã cửa hàng:</span> TM-INTERIOR-001</p>
                    </div>
                </section>

                <section class="rounded-2xl border border-slate-200 p-5">
                    <h2 class="text-sm font-bold uppercase tracking-[0.22em] text-slate-900">II. THÔNG TIN KHÁCH HÀNG</h2>
                    <div class="mt-4 space-y-2 text-sm text-slate-700">
                        <p><span class="font-semibold text-slate-900">Họ và tên:</span> {{ $order->customer_name }}</p>
                        <p><span class="font-semibold text-slate-900">Số điện thoại:</span> {{ $order->customer_phone }}</p>
                        <p><span class="font-semibold text-slate-900">Địa chỉ:</span> {{ $order->shipping_address }}</p>
                        <p><span class="font-semibold text-slate-900">Mã đơn hàng liên quan:</span> {{ $order->order_code }}</p>
                    </div>
                </section>
            </div>

            <section class="mt-6 rounded-2xl border border-slate-200">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h2 class="text-sm font-bold uppercase tracking-[0.22em] text-slate-900">III. CHI TIẾT HÀNG HÓA</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">STT</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Tên sản phẩm</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Mã SP</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">DVT</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">SL</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Đơn giá</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach($order->items as $index => $item)
                                <tr>
                                    <td class="px-4 py-4 text-sm text-slate-700">{{ $index + 1 }}</td>
                                    <td class="px-4 py-4 text-sm font-medium text-slate-900">{{ $item->product_name_snapshot }}</td>
                                    <td class="px-4 py-4 text-sm text-slate-700">{{ $item->product_code_snapshot ?? 'N/A' }}</td>
                                    <td class="px-4 py-4 text-sm text-slate-700">Cái</td>
                                    <td class="px-4 py-4 text-right text-sm text-slate-700">{{ $item->quantity }}</td>
                                    <td class="px-4 py-4 text-right text-sm text-slate-700">{{ number_format($item->unit_price, 0, ',', '.') }} đ</td>
                                    <td class="px-4 py-4 text-right text-sm font-semibold text-slate-900">{{ number_format($item->line_total, 0, ',', '.') }} đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <div class="mt-6 grid gap-6 lg:grid-cols-[1.2fr,0.8fr]">
                <section class="rounded-2xl border border-slate-200 p-5">
                    <h2 class="text-sm font-bold uppercase tracking-[0.22em] text-slate-900">IV. THÔNG TIN THANH TOÁN</h2>
                    <div class="mt-4 space-y-3 text-sm text-slate-700">
                        <p>
                            <span class="font-semibold text-slate-900">Phương thức thanh toán:</span>
                            ☐ COD &nbsp;&nbsp; ☐ Chuyển khoản &nbsp;&nbsp; ☐ Tiền mặt &nbsp;&nbsp; ☐ Khác
                        </p>
                        <div class="grid gap-3 sm:grid-cols-3">
                            <div class="rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200">
                                <p class="text-xs font-medium uppercase tracking-[0.2em] text-slate-500">Đã thanh toán</p>
                                <p class="mt-2 text-base font-semibold text-slate-900">{{ number_format($paidAmount, 0, ',', '.') }} đ</p>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200">
                                <p class="text-xs font-medium uppercase tracking-[0.2em] text-slate-500">Còn lại</p>
                                <p class="mt-2 text-base font-semibold text-slate-900">{{ number_format($remainingAmount, 0, ',', '.') }} đ</p>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200">
                                <p class="text-xs font-medium uppercase tracking-[0.2em] text-slate-500">Ngày thanh toán</p>
                                <p class="mt-2 text-base font-semibold text-slate-900">{{ $order->completed_at?->format('d/m/Y') ?? $invoiceDate->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl border border-slate-200 p-5">
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">Tổng cộng (chưa VAT)</span>
                            <span class="font-medium text-slate-900">{{ number_format($subtotal, 0, ',', '.') }} đ</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">VAT (10%)</span>
                            <span class="font-medium text-slate-900">{{ number_format($vatAmount, 0, ',', '.') }} đ</span>
                        </div>
                        <div class="flex items-center justify-between border-t border-slate-200 pt-3">
                            <span class="text-base font-semibold text-slate-900">TỔNG THANH TOÁN</span>
                            <span class="text-xl font-bold text-primary">{{ number_format($grandTotal, 0, ',', '.') }} đ</span>
                        </div>
                    </div>
                    <div class="mt-4 rounded-xl bg-slate-50 p-4 text-sm text-slate-700">
                        <p class="font-semibold text-slate-900">Số tiền bằng chữ:</p>
                        <p class="mt-2 leading-6">{{ \App\Helpers\NumberToWords::convert((int) round($grandTotal)) }} đồng.</p>
                    </div>
                </section>
            </div>

            <div class="mt-8 grid gap-8 sm:grid-cols-2">
                <div class="text-center">
                    <p class="font-semibold text-slate-900">Khách hàng</p>
                    <p class="mt-1 text-sm text-slate-500">(Ký và ghi rõ họ tên)</p>
                    <div class="mt-16 border-t border-dashed border-slate-300 pt-3 text-sm text-slate-500">
                        {{ $order->customer_name }}
                    </div>
                </div>
                <div class="text-center">
                    <p class="font-semibold text-slate-900">Nhân viên lập phiếu</p>
                    <p class="mt-1 text-sm text-slate-500">(Ký và ghi rõ họ tên)</p>
                    <div class="mt-16 border-t border-dashed border-slate-300 pt-3 text-sm text-slate-500">
                        Nội thất Thông Mai
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
