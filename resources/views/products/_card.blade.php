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
            <p class="text-xs text-indigo-600 font-medium mb-1">{{ $product->category->name }}</p>
        @endif

        {{-- Name --}}
        <a href="{{ route('products.show', $product->slug) }}" class="block">
            <h3 class="text-sm font-medium text-gray-900 line-clamp-2 hover:text-indigo-600 transition">
                {{ $product->name }}
            </h3>
        </a>

        {{-- Price & Stock --}}
        <div class="flex items-center justify-between mt-3">
            <span class="text-base font-semibold text-indigo-600">
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
                <button class="mt-3 w-full px-3 py-2 bg-indigo-600 text-white text-xs font-medium rounded-md hover:bg-indigo-700 transition">
                    Thêm vào giỏ
                </button>
            @else
                <button disabled class="mt-3 w-full px-3 py-2 bg-gray-200 text-gray-400 text-xs font-medium rounded-md cursor-not-allowed">
                    Hết hàng
                </button>
            @endif
        @endauth
    </div>
</div>
