<x-admin-layout>
    <x-slot name="header">Quản lý sản phẩm</x-slot>

    <div class="space-y-6">
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <form method="GET" action="{{ route('admin.products.index') }}" class="grid gap-4 lg:grid-cols-5">
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Tìm kiếm</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           placeholder="Mã SP, tên, chất liệu, màu sắc">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Danh mục</label>
                    <select name="category_id" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Tất cả</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) request('category_id') === (string) $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Trạng thái</label>
                    <select name="status" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Tất cả</option>
                        <option value="active" @selected(request('status') === 'active')>Đang hiển thị</option>
                        <option value="hidden" @selected(request('status') === 'hidden')>Đã ẩn</option>
                    </select>
                </div>

                <div class="lg:col-span-5 flex flex-wrap gap-3">
                    <button type="submit" class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                        Lọc dữ liệu
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Xóa bộ lọc
                    </a>
                    @if(auth()->user()->hasPermission('product.create'))
                        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white hover:bg-slate-800">
                            Thêm sản phẩm
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-900">Danh sách sản phẩm</h3>
                <p class="mt-1 text-sm text-gray-500">Hiển thị cả sản phẩm đã ẩn hoặc đã xóa mềm để admin theo dõi.</p>
            </div>

            @if($products->isEmpty())
                <div class="p-8 text-center">
                    <h3 class="text-lg font-semibold text-gray-900">Chưa có sản phẩm nào</h3>
                    <p class="mt-2 text-sm text-gray-500">Bắt đầu bằng việc tạo sản phẩm đầu tiên.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Sản phẩm</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Danh mục</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Giá</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Tồn kho</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Trạng thái</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-12 w-12 overflow-hidden rounded-xl bg-gray-100">
                                                @if($product->images->first())
                                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                                                <div class="mt-1 text-xs text-gray-500">{{ $product->product_code }}</div>
                                                @if($product->trashed())
                                                    <div class="mt-1 text-xs font-semibold text-red-600">Đã xóa mềm</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $product->category?->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ number_format($product->price, 0, ',', '.') }} đ</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $product->stock_quantity }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $product->statusBadgeClasses() }}">
                                            {{ $product->statusLabel() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex flex-wrap justify-end gap-2">
                                            <a href="{{ route('admin.products.show', $product) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Xem</a>
                                            @if(auth()->user()->hasPermission('product.manage_image'))
                                                <a href="{{ route('admin.products.images', $product) }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700">Ảnh</a>
                                            @endif
                                            @if(auth()->user()->hasPermission('product.update'))
                                                <a href="{{ route('admin.products.edit', $product) }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-900">Sửa</a>
                                            @endif
                                            @if(auth()->user()->hasPermission('product.delete'))
                                                @if($product->trashed())
                                                    <x-confirm-delete-modal
                                                        :name="'restore-product-'.$product->id"
                                                        :action="route('admin.products.restore', $product)"
                                                        title="Khôi phục sản phẩm?"
                                                        message="Bạn chắc chắn muốn khôi phục sản phẩm này?"
                                                        trigger-label="Khôi phục"
                                                        confirm-label="Khôi phục"
                                                        method="patch"
                                                        trigger-class="text-sm font-medium text-emerald-600 hover:text-emerald-700 bg-transparent border-0 p-0"
                                                    />
                                                @else
                                                    <x-confirm-delete-modal
                                                        :name="'delete-product-'.$product->id"
                                                        :action="route('admin.products.destroy', $product)"
                                                        title="Xóa sản phẩm?"
                                                        message="Bạn chắc chắn muốn xóa sản phẩm này?"
                                                        trigger-label="Xóa"
                                                        confirm-label="Xác nhận"
                                                        trigger-class="text-sm font-medium text-red-600 hover:text-red-700 bg-transparent border-0 p-0"
                                                    />
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
