<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Thanh toán đơn hàng
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(!$cart || $cart->items->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-8 text-center">
                        <h3 class="text-lg font-semibold text-gray-900">Giỏ hàng của bạn đang trống</h3>
                        <p class="mt-2 text-sm text-gray-500">Bạn cần thêm sản phẩm vào giỏ trước khi đặt hàng.</p>
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                                Xem sản phẩm
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-6">
                        <form method="POST" action="{{ route('checkout.store') }}" class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                            @csrf
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900">Thông tin giao hàng</h3>
                                <p class="mt-1 text-sm text-gray-500">Vui lòng nhập thông tin để hệ thống tạo đơn hàng.</p>
                            </div>

                            <div class="p-6 grid grid-cols-1 gap-5 md:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Họ tên người nhận</label>
                                    <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                                    <input type="text" name="customer_phone" value="{{ old('customer_phone', auth()->user()->phone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="customer_email" value="{{ old('customer_email', auth()->user()->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Phương thức thanh toán</label>
                                    <select name="payment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="cod" @selected(old('payment_method', 'cod') === 'cod')>Thanh toán khi nhận hàng</option>
                                        <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>Chuyển khoản ngân hàng</option>
                                    </select>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Địa chỉ giao hàng</label>
                                    <textarea name="shipping_address" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('shipping_address') }}</textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Ghi chú</label>
                                    <textarea name="shipping_note" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('shipping_note') }}</textarea>
                                </div>
                            </div>

                            <div class="px-6 pb-6">
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                                    Đặt hàng
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white shadow-sm sm:rounded-lg p-6 h-fit">
                        <h3 class="text-lg font-semibold text-gray-900">Đơn hàng của bạn</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $cart->item_count }} sản phẩm</p>

                        <div class="mt-5 space-y-4">
                            @foreach($cart->items as $item)
                                <div class="flex gap-3">
                                    <div class="h-16 w-16 overflow-hidden rounded-lg bg-gray-100 flex-shrink-0">
                                        @if($item->product_image_path_snapshot)
                                            <img src="{{ asset('storage/' . $item->product_image_path_snapshot) }}" alt="{{ $item->product_name_snapshot }}" class="h-full w-full object-cover">
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $item->product_name_snapshot }}</p>
                                        <p class="text-xs text-gray-500">SL: {{ $item->quantity }} x {{ number_format($item->unit_price, 0, ',', '.') }}đ</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ number_format($item->line_total, 0, ',', '.') }}đ</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 border-t border-gray-200 pt-4 space-y-3 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500">Tạm tính</span>
                                <span class="font-medium text-gray-900">{{ number_format($cart->subtotal, 0, ',', '.') }}đ</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500">Phí vận chuyển</span>
                                <span class="font-medium text-gray-900">0đ</span>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-3">
                                <span class="text-gray-500">Tổng thanh toán</span>
                                <span class="text-lg font-semibold text-indigo-600">{{ number_format($cart->subtotal, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
