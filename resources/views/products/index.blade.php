@php($layout = $layout ?? 'public-layout')
<x-dynamic-component :component="$layout">
    <x-slot name="header">
        @if($layout === 'app-layout')
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sản phẩm') }}
            </h2>
        @else
            <div class="py-2">
                <p class="text-sm font-semibold uppercase tracking-widest text-primary">Danh mục sản phẩm</p>
                <h1 class="mt-2 text-3xl font-bold text-slate-900 sm:text-4xl">Sản phẩm</h1>
                <p class="mt-3 max-w-2xl text-slate-600">
                    Khám phá các mẫu nội thất chất lượng cao và lọc nhanh theo nhu cầu của bạn.
                </p>
            </div>
        @endif
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-6">

                {{-- Sidebar Filters --}}
                <aside class="w-full lg:w-64 flex-shrink-0">
                    <form method="GET" action="{{ route('products.index') }}" class="bg-white shadow-sm sm:rounded-lg p-5 space-y-5">

                        {{-- Tìm kiếm --}}
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Tìm kiếm</label>
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                   class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="Tên, mã, chất liệu...">
                        </div>

                        {{-- Danh mục --}}
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Danh mục</label>
                            <select id="category" name="category"
                                    class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Tất cả</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Khoảng giá --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Khoảng giá</label>
                            <div class="flex gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="Từ" min="0">
                                <input type="number" name="max_price" value="{{ request('max_price') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="Đến" min="0">
                            </div>
                        </div>

                        {{-- Còn hàng --}}
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="in_stock" value="1"
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                       {{ request('in_stock') === '1' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Chỉ còn hàng</span>
                            </label>
                        </div>

                        {{-- Sắp xếp --}}
                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Sắp xếp</label>
                            <select id="sort" name="sort"
                                    class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Mới nhất</option>
                                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                                <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Tên A-Z</option>
                                <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Tên Z-A</option>
                            </select>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit"
                                    class="flex-1 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition">
                                Lọc
                            </button>
                            <a href="{{ route('products.index') }}"
                               class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-200 transition">
                                Xóa
                            </a>
                        </div>
                    </form>
                </aside>

                {{-- Product Grid --}}
                <div class="flex-1">
                    {{-- Results info --}}
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-sm text-gray-600">
                            Hiển thị {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} / {{ $products->total() }} sản phẩm
                        </p>
                    </div>

                    @if($products->isEmpty())
                        <div class="bg-white shadow-sm sm:rounded-lg p-12 text-center">
                            <svg class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <p class="text-gray-500 text-lg">Không tìm thấy sản phẩm phù hợp</p>
                            <p class="text-gray-400 text-sm mt-1">Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                            @foreach($products as $product)
                                @include('products._card', ['product' => $product])
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-6">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
