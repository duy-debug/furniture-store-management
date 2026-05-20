<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden group hover:shadow-md transition">
    {{-- Image --}}
    <a href="{{ route('products.show', $product->slug) }}" class="block">
        <div class="aspect-square bg-gray-100 flex items-center justify-center overflow-hidden">
            @if($product->images->isNotEmpty())
                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                     alt="{{ $product->images->first()->alt_text ?? $product->name }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            @else
                <svg class="h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            @endif
        </div>
    </a>

    {{-- Info --}}
    <div class="p-4">
        {{-- Category --}}
        @if($product->category)
            <p class="text-xs font-medium mb-1 text-[#1E3A5F]">{{ $product->category->name }}</p>
        @endif

        {{-- Name --}}
        <a href="{{ route('products.show', $product->slug) }}" class="block">
            <h3 class="text-sm font-medium text-gray-900 line-clamp-2 transition hover:text-[#1E3A5F]">
                {{ $product->name }}
            </h3>
        </a>

        {{-- Price & Stock --}}
        <div class="flex items-center justify-between mt-3">
            <span class="text-base font-semibold text-[#2563EB]">
                {{ number_format($product->price, 0, ',', '.') }}đ
            </span>
            @if($product->stock_quantity > 0)
                <span class="text-xs text-green-600 font-medium">Còn hàng</span>
            @else
                <span class="text-xs text-red-500 font-medium">Hết hàng</span>
            @endif
        </div>

        {{-- Add to cart button --}}
        @auth
            @if($product->stock_quantity > 0)
                <form method="POST" action="{{ route('cart.items.store') }}" class="mt-3">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="primary-button w-full justify-center text-xs">
                        Thêm vào giỏ
                    </button>
                </form>
            @else
                <button disabled class="secondary-button mt-3 w-full justify-center cursor-not-allowed opacity-60 text-xs">
                    Hết hàng
                </button>
            @endif
        @endauth
    </div>
</div>
