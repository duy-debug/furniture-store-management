<x-admin-layout>
    <x-slot name="header">Chi tiết sản phẩm</x-slot>

    <div class="space-y-6">
        <div class="flex flex-col gap-3 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-medium text-indigo-600">{{ $product->product_code }}</p>
                <h2 class="mt-1 text-2xl font-semibold text-gray-900">{{ $product->name }}</h2>
                <p class="mt-1 text-sm text-gray-500">{{ $product->category?->name ?? 'Chưa có danh mục' }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                @if(auth()->user()->hasPermission('product.manage_image'))
                    <a href="{{ route('admin.products.images', $product) }}" class="inline-flex items-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                        Quản lý ảnh
                    </a>
                @endif
                @if(auth()->user()->hasPermission('product.update'))
                    <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                        Cập nhật
                    </a>
                @endif
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Quay lại danh sách
                </a>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.2fr,0.8fr]">
            <div class="space-y-6">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Thông tin sản phẩm</h3>
                            <p class="mt-1 text-sm text-gray-500">Trạng thái: {{ $product->statusLabel() }}</p>
                        </div>
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $product->statusBadgeClasses() }}">
                            {{ $product->statusLabel() }}
                        </span>
                    </div>

                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Giá bán</p>
                            <p class="mt-2 text-sm font-semibold text-gray-900">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Tồn kho</p>
                            <p class="mt-2 text-sm font-semibold text-gray-900">{{ $product->stock_quantity }}</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Kích thước</p>
                            <p class="mt-2 text-sm text-gray-900">{{ $product->size ?? 'Chưa cập nhật' }}</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Chất liệu</p>
                            <p class="mt-2 text-sm text-gray-900">{{ $product->material ?? 'Chưa cập nhật' }}</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Màu sắc</p>
                            <p class="mt-2 text-sm text-gray-900">{{ $product->color ?? 'Chưa cập nhật' }}</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Đơn hàng liên quan</p>
                            <p class="mt-2 text-sm text-gray-900">{{ $product->orderItems->count() }}</p>
                        </div>
                    </div>

                    <div class="mt-4 rounded-2xl bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Mô tả</p>
                        <p class="mt-2 text-sm leading-6 text-gray-700 whitespace-pre-line">{{ $product->description ?? 'Chưa có mô tả' }}</p>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-900">Ảnh sản phẩm</h3>
                    </div>
                    <div class="grid gap-4 p-6 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($product->images as $image)
                            <div class="overflow-hidden rounded-2xl border border-gray-200">
                                <div class="aspect-square bg-gray-100">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-xs font-semibold {{ $image->is_primary ? 'text-emerald-700' : 'text-gray-500' }}">
                                            {{ $image->is_primary ? 'Ảnh đại diện' : 'Ảnh phụ' }}
                                        </span>
                                        <span class="text-xs text-gray-400">{{ $image->sort_order }}</span>
                                    </div>
                                    <div class="mt-3 flex gap-2">
                                        @if(auth()->user()->hasPermission('product.manage_image'))
                                            @unless($image->is_primary)
                                                <form method="POST" action="{{ route('admin.products.images.primary', [$product, $image]) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-emerald-700">
                                                        Đặt chính
                                                    </button>
                                                </form>
                                            @endunless
                                            <x-confirm-delete-modal
                                                :name="'delete-product-image-'.$product->id.'-'.$image->id"
                                                :action="route('admin.products.images.destroy', [$product, $image])"
                                                title="Xóa ảnh?"
                                                message="Bạn chắc chắn muốn xóa ảnh này?"
                                                trigger-label="Xóa"
                                                confirm-label="Xóa"
                                                class="rounded-lg bg-red-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-red-700"
                                            />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full rounded-2xl border border-dashed border-gray-300 p-8 text-center text-sm text-gray-500">
                                Chưa có ảnh cho sản phẩm này.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Tổng quan giao dịch</h3>
                    <div class="mt-4 space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">Đã phát sinh đơn</span>
                            <span class="font-medium text-gray-900">{{ $product->orderItems->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">Ngày tạo</span>
                            <span class="font-medium text-gray-900">{{ $product->created_at?->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">Cập nhật gần nhất</span>
                            <span class="font-medium text-gray-900">{{ $product->updated_at?->format('d/m/Y H:i') }}</span>
                        </div>
                        @if($product->trashed())
                            <div class="rounded-xl bg-red-50 p-3 text-sm text-red-700">
                                Sản phẩm này đã được xóa mềm.
                            </div>
                        @endif
                    </div>
                </div>`r`n`r`n                @if(auth()->user()->hasPermission('product.delete'))
                    <div class="rounded-2xl border border-red-200 bg-red-50 p-6">
                        <h3 class="text-lg font-semibold text-red-800">
                            {{ $product->trashed() ? 'Khôi phục sản phẩm' : 'Xóa / ẩn sản phẩm' }}
                        </h3>
                        <p class="mt-2 text-sm text-red-700">
                            @if($product->trashed())
                                Sản phẩm này đang ở trạng thái xóa mềm. Bạn có thể khôi phục lại để hiển thị trong danh sách quản trị.
                            @else
                                Nếu sản phẩm chưa có giao dịch, hệ thống sẽ xóa mềm. Nếu đã có đơn, hệ thống sẽ chuyển sang trạng thái hidden.
                            @endif
                        </p>
                        <div class="mt-4">
                            @if($product->trashed())
                                <x-confirm-delete-modal
                                    :name="'restore-product-detail-'.$product->id"
                                    :action="route('admin.products.restore', $product)"
                                    title="Khôi phục sản phẩm?"
                                    message="Bạn chắc chắn muốn khôi phục sản phẩm này?"
                                    trigger-label="Khôi phục"
                                    confirm-label="Khôi phục"
                                    method="patch"
                                    class="w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700 justify-center"
                                />
                            @else
                                <x-confirm-delete-modal
                                    :name="'delete-product-detail-'.$product->id"
                                    :action="route('admin.products.destroy', $product)"
                                    title="Xóa/ẩn sản phẩm?"
                                    message="Bạn chắc chắn muốn xóa hoặc ẩn sản phẩm này?"
                                    trigger-label="Xóa / ẩn"
                                    confirm-label="Xác nhận"
                                    class="w-full rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700 justify-center"
                                />
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
