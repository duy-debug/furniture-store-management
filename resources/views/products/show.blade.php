@php($layout = $layout ?? 'public-layout')
<x-dynamic-component :component="$layout">
    <x-slot name="header">
        @if($layout === 'app-layout')
            <div class="pt-4 sm:pt-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $product->name }}
                </h2>
            </div>
        @else
            <div class="py-5 sm:py-6">
                <p class="text-sm font-semibold uppercase tracking-widest text-primary">Chi tiết sản phẩm</p>
                <h1 class="mt-2 text-3xl font-bold text-slate-900 sm:text-4xl">{{ $product->name }}</h1>
            </div>
        @endif
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="mb-6 text-sm text-gray-500">
                <a href="{{ route('products.index') }}" class="text-[#1E3A5F]">Sản phẩm</a>
                <span class="mx-2">/</span>
                @if($product->category)
                    <a href="{{ route('products.index', ['category' => $product->category_id]) }}" class="text-[#1E3A5F]">{{ $product->category->name }}</a>
                    <span class="mx-2">/</span>
                @endif
                <span class="text-gray-900">{{ $product->name }}</span>
            </nav>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">

                    {{-- Image Gallery --}}
                    <div class="p-6" x-data="{ activeImage: 0 }">
                        {{-- Main Image --}}
                        <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden mb-4">
                            @if($product->images->isNotEmpty())
                                @foreach($product->images as $index => $image)
                                    <img x-show="activeImage === {{ $index }}"
                                         src="{{ asset('storage/' . $image->image_path) }}"
                                         alt="{{ $image->alt_text ?? $product->name }}"
                                         class="w-full h-full object-cover">
                                @endforeach
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Thumbnails --}}
                        @if($product->images->count() > 1)
                            <div class="flex gap-2 overflow-x-auto">
                                @foreach($product->images as $index => $image)
                                    <button @click="activeImage = {{ $index }}"
                                            :class="activeImage === {{ $index }} ? 'ring-2 ring-[#1E3A5F]' : 'ring-1 ring-gray-200'"
                                            class="flex-shrink-0 w-16 h-16 rounded-md overflow-hidden">
                                        <img src="{{ asset('storage/' . $image->image_path) }}"
                                             alt="" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Product Info --}}
                    <div class="p-6 lg:border-l border-gray-200">
                        {{-- Category --}}
                        @if($product->category)
                            <p class="text-sm font-medium mb-2 text-[#1E3A5F]">{{ $product->category->name }}</p>
                        @endif

                        {{-- Name --}}
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>

                        {{-- Code --}}
                        <p class="text-sm text-gray-500 mb-4">Mã: <code class="bg-gray-100 px-2 py-0.5 rounded">{{ $product->product_code }}</code></p>

                        {{-- Price --}}
                        <div class="mb-6">
                            <span class="text-3xl font-bold text-[#2563EB]">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                        </div>

                        {{-- Stock Status --}}
                        <div class="mb-6">
                            @if($product->stock_quantity > 0)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-green-50 text-green-700">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Còn hàng ({{ $product->stock_quantity }})
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-red-50 text-red-700">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Hết hàng
                                </span>
                            @endif
                        </div>

                        {{-- Specs --}}
                        <div class="border-t border-gray-200 pt-4 mb-6 space-y-3">
                            @if($product->material)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Chất liệu</span>
                                    <span class="text-gray-900 font-medium">{{ $product->material }}</span>
                                </div>
                            @endif
                            @if($product->size)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Kích thước</span>
                                    <span class="text-gray-900 font-medium">{{ $product->size }}</span>
                                </div>
                            @endif
                            @if($product->color)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Màu sắc</span>
                                    <span class="text-gray-900 font-medium">{{ $product->color }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Add to Cart --}}
                        @auth
                            @if($product->stock_quantity > 0)
                                <form method="POST" action="{{ route('cart.items.store') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full px-6 py-3 bg-primary text-white font-semibold rounded-md hover:bg-primary/90 transition text-sm uppercase tracking-widest">
                                        Thêm vào giỏ hàng
                                    </button>
                                </form>
                            @else
                                <button disabled class="secondary-button w-full justify-center cursor-not-allowed opacity-60">
                                    Hết hàng
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="primary-button block w-full justify-center text-center">
                                Đăng nhập để mua hàng
                            </a>
                        @endauth
                    </div>
                </div>

                {{-- Description --}}
                @if($product->description)
                    <div class="border-t border-gray-200 p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-3">Mô tả sản phẩm</h2>
                        <div class="prose prose-sm max-w-none text-gray-600">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                @endif
            </div>

            {{-- Related Products --}}
            @if($relatedProducts->isNotEmpty())
                <div class="mt-10">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Sản phẩm liên quan</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                        @foreach($relatedProducts as $related)
                            @include('products._card', ['product' => $related])
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-dynamic-component>
