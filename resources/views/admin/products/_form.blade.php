@php
    $selectedCategoryId = old('category_id', $product->category_id);
    $selectedStatus = old('status', $product->status ?: 'active');
@endphp

<div class="space-y-6">
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">Mã sản phẩm</label>
            <input type="text" name="product_code" value="{{ old('product_code', $product->product_code) }}"
                   @if($isEdit) readonly @endif
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @if($isEdit) bg-gray-100 @endif"
                   placeholder="Ví dụ: SP0001">
            @error('product_code')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">Danh mục</label>
            <select name="category_id" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Chọn danh mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) $selectedCategoryId === (string) $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">Tên sản phẩm</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}"
               class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
               placeholder="Tên sản phẩm">
        @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">Mô tả</label>
        <textarea name="description" rows="5"
                  class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                  placeholder="Mô tả chi tiết sản phẩm">{{ old('description', $product->description) }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">Giá bán</label>
            <input type="number" name="price" min="0" step="0.01" value="{{ old('price', $product->price) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="0">
            @error('price')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">Tồn kho</label>
            <input type="number" name="stock_quantity" min="0" step="1" value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="0">
            @error('stock_quantity')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">Kích thước</label>
            <input type="text" name="size" value="{{ old('size', $product->size) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Ví dụ: 160x80x75 cm">
            @error('size')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">Chất liệu</label>
            <input type="text" name="material" value="{{ old('material', $product->material) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Ví dụ: Gỗ MDF, da thật...">
            @error('material')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">Màu sắc</label>
            <input type="text" name="color" value="{{ old('color', $product->color) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Ví dụ: Trắng, nâu, xám...">
            @error('color')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">Trạng thái</label>
            <select name="status" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option value="active" @selected($selectedStatus === 'active')>Đang hiển thị</option>
                <option value="hidden" @selected($selectedStatus === 'hidden')>Đã ẩn</option>
            </select>
            @error('status')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">
            Ảnh đại diện
            <span class="text-gray-500">(jpg, png, webp, tối đa 5MB)</span>
        </label>
        <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"
               class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-indigo-500 focus:ring-indigo-500">
        @error('image')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror

        @if($isEdit && $product->images->firstWhere('is_primary', true))
            <p class="mt-2 text-xs text-gray-500">Upload ảnh mới sẽ thay thế ảnh đại diện hiện tại.</p>
        @endif
    </div>

    <div class="flex items-center justify-end gap-3 border-t border-gray-200 pt-6">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Hủy
        </a>
        <button type="submit" class="primary-button px-5 py-2.5">
            {{ $isEdit ? 'Cập nhật sản phẩm' : 'Tạo sản phẩm' }}
        </button>
    </div>
</div>
