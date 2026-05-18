@php
    $selectedParentId = old('parent_id', $category->parent_id);
    $selectedStatus = old('status', $category->status ?: 'active');
@endphp

<div class="space-y-6">
    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">Tên danh mục</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Ví dụ: Phòng khách">
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $category->slug) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Bo trống để hệ thống tự tạo từ tên">
            @error('slug')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">Danh mục cha</label>
            <select name="parent_id" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Không có</option>
                @foreach($parents as $parent)
                    <option value="{{ $parent->id }}" @selected((string) $selectedParentId === (string) $parent->id)>
                        {{ $parent->name }}{{ $parent->trashed() ? ' (đã xóa mềm)' : '' }}
                    </option>
                @endforeach
            </select>
            @error('parent_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">Thứ tự hiển thị</label>
            <input type="number" name="sort_order" min="0" step="1" value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="0">
            @error('sort_order')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700">Mô tả</label>
        <textarea name="description" rows="5"
                  class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                  placeholder="Mô tả danh mục">{{ old('description', $category->description) }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid gap-6 md:grid-cols-2">
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

        <div>
            <label class="mb-2 block text-sm font-medium text-gray-700">
                Ảnh danh mục
                <span class="text-gray-500">(jpg, png, webp, tối đa 5MB)</span>
            </label>
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"
                   class="w-full rounded-xl border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-indigo-500 focus:ring-indigo-500">
            @error('image')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            @if($isEdit && $category->image_path)
                <p class="mt-2 text-xs text-gray-500">Tải ảnh mới sẽ thay thế ảnh hiện tại.</p>
            @endif
        </div>
    </div>

    <div class="flex items-center justify-end gap-3 border-t border-gray-200 pt-6">
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
            Hủy
        </a>
        <button type="submit" class="inline-flex items-center rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
            {{ $isEdit ? 'Cập nhật danh mục' : 'Tạo danh mục' }}
        </button>
    </div>
</div>
