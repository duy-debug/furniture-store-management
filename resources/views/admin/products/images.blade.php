<x-admin-layout>
    <x-slot name="header">Quản lý hình ảnh sản phẩm</x-slot>

    <div class="space-y-6">
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm font-medium text-indigo-600">{{ $product->product_code }}</p>
                    <h2 class="mt-1 text-2xl font-semibold text-gray-900">{{ $product->name }}</h2>
                    <p class="mt-1 text-sm text-gray-500">Tải nhiều ảnh, chọn ảnh đại diện và quản lý ảnh hiện có.</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.products.show', $product) }}" class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Quay lại chi tiết
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[0.9fr,1.1fr]">
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Tải ảnh mới</h3>
                <p class="mt-1 text-sm text-gray-500">Định dạng cho phép: jpg, png, webp. Mỗi ảnh tối đa 5MB.</p>

                <form method="POST" action="{{ route('admin.products.images.store', $product) }}" enctype="multipart/form-data" class="mt-6" x-data="{
                        files: [],
                        primaryIndex: 0,
                        onChange(event) {
                            this.files = Array.from(event.target.files || []);
                            if (this.primaryIndex >= this.files.length) {
                                this.primaryIndex = 0;
                            }
                        }
                    }">
                    @csrf

                    <label class="mb-2 block text-sm font-medium text-gray-700">Chọn ảnh</label>
                    <input type="file" name="images[]" multiple accept=".jpg,.jpeg,.png,.webp"
                           @change="onChange($event)"
                           class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('images')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('images.*')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <input type="hidden" name="primary_index" :value="primaryIndex">

                    <div class="mt-4" x-show="files.length > 0">
                        <p class="text-sm font-medium text-gray-700">Chọn ảnh đại diện cho lô upload này</p>
                        <div class="mt-3 space-y-2 max-h-60 overflow-y-auto rounded-2xl border border-gray-200 p-3">
                            <template x-for="(file, index) in files" :key="file.name + index">
                                <label class="flex items-center gap-3 rounded-xl px-3 py-2 hover:bg-gray-50">
                                    <input type="radio" name="primary_preview" :value="index" x-model="primaryIndex" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-medium text-gray-900" x-text="file.name"></p>
                                        <p class="text-xs text-gray-500" x-text="Math.round(file.size / 1024) + ' KB'"></p>
                                    </div>
                                </label>
                            </template>
                        </div>
                    </div>

                    <button type="submit" class="mt-6 w-full rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                        Tải ảnh lên
                    </button>
                </form>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Ảnh hiện có</h3>
                        <p class="mt-1 text-sm text-gray-500">Đặt ảnh đại diện hoặc xóa ảnh không dùng nữa.</p>
                    </div>
                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                        {{ $product->images->count() }} ảnh
                    </span>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
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
                                    <span class="text-xs text-gray-400">#{{ $image->sort_order }}</span>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">
                                    Upload bởi: {{ $image->uploader?->name ?? 'Hệ thống' }}
                                </p>
                                <div class="mt-4 flex flex-wrap gap-2">
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
                                    />
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="sm:col-span-2 xl:col-span-3 rounded-2xl border border-dashed border-gray-300 p-8 text-center text-sm text-gray-500">
                            Chưa có ảnh nào cho sản phẩm này.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
