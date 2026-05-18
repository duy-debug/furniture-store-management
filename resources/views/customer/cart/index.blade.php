<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Giỏ hàng của bạn
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(!$cart || $cart->items->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-8 text-center">
                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
                            <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Giỏ hàng của bạn đang trống</h3>
                        <p class="mt-2 text-sm text-gray-500">Hãy thêm sản phẩm vào giỏ để bắt đầu mua sắm.</p>
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                                Xem sản phẩm
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 bg-white shadow-sm sm:rounded-lg overflow-hidden">
                        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Sản phẩm trong giỏ</h3>
                                <p class="text-sm text-gray-500">{{ $cart->item_count }} sản phẩm, {{ number_format($cart->subtotal, 0, ',', '.') }}đ</p>
                            </div>

                            <form method="POST" action="{{ route('cart.clear') }}" onsubmit="return confirm('Bạn có muốn làm trống giỏ hàng không?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">
                                    Làm trống giỏ
                                </button>
                            </form>
                        </div>

                        <div class="divide-y divide-gray-200">
                            @foreach($cart->items as $item)
                                <div class="p-6 flex gap-4">
                                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-lg bg-gray-100">
                                        @if($item->product_image_path_snapshot)
                                            <img src="{{ asset('storage/' . $item->product_image_path_snapshot) }}" alt="{{ $item->product_name_snapshot }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-gray-300">
                                                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
                                            <div>
                                                <h4 class="text-base font-semibold text-gray-900">{{ $item->product_name_snapshot }}</h4>
                                                <p class="mt-1 text-sm text-gray-500">Đơn giá: {{ number_format($item->unit_price, 0, ',', '.') }}đ</p>
                                                <p class="mt-1 text-sm text-gray-500">Thành tiền: {{ number_format($item->line_total, 0, ',', '.') }}đ</p>
                                            </div>

                                            <div class="flex flex-wrap items-center gap-2">
                                                <form method="POST" action="{{ route('cart.items.update', $item) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="action" value="decrease">
                                                    <button type="submit" class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50">
                                                        -
                                                    </button>
                                                </form>

                                                <div class="min-w-12 rounded-md border border-gray-300 px-3 py-2 text-center text-sm font-medium text-gray-900">
                                                    {{ $item->quantity }}
                                                </div>

                                                <form method="POST" action="{{ route('cart.items.update', $item) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="action" value="increase">
                                                    <button type="submit" class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-gray-300 text-gray-600 hover:bg-gray-50">
                                                        +
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('cart.items.destroy', $item) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center rounded-md bg-red-50 px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-100">
                                                        Xóa
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white shadow-sm sm:rounded-lg p-6 h-fit">
                        <h3 class="text-lg font-semibold text-gray-900">Tổng đơn hàng</h3>
                        <div class="mt-4 space-y-3 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500">Số lượng sản phẩm</span>
                                <span class="font-medium text-gray-900">{{ $cart->item_count }}</span>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-3">
                                <span class="text-gray-500">Tổng tiền</span>
                                <span class="text-lg font-semibold text-indigo-600">{{ number_format($cart->subtotal, 0, ',', '.') }}đ</span>
                            </div>
                        </div>

                        <div class="mt-6 space-y-3">
                            <a href="{{ route('products.index') }}" class="block w-full rounded-md bg-gray-100 px-4 py-2.5 text-center text-sm font-semibold text-gray-700 hover:bg-gray-200">
                                Tiếp tục mua sắm
                            </a>
                            <button type="button" class="block w-full rounded-md bg-indigo-600 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-indigo-700">
                                Thanh toán
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
