<x-admin-layout>
    <x-slot name="header">Quản lý danh mục</x-slot>

    <div class="space-y-6">
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <form method="GET" action="{{ route('admin.categories.index') }}" class="grid gap-4 lg:grid-cols-4">
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Tìm kiếm</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           placeholder="Tên danh mục, slug">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700">Trạng thái</label>
                    <select name="status" class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Tất cả</option>
                        <option value="active" @selected(request('status') === 'active')>Đang hiển thị</option>
                        <option value="hidden" @selected(request('status') === 'hidden')>Đã ẩn</option>
                    </select>
                </div>

                <div class="flex items-end gap-3">
                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                        Lọc dữ liệu
                    </button>
                </div>

                <div class="lg:col-span-4 flex flex-wrap gap-3">
                    <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Xóa bộ lọc
                    </a>
                    @if(auth()->user()->hasPermission('category.create'))
                        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white hover:bg-slate-800">
                            Thêm danh mục
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-900">Danh sách danh mục</h3>
                <p class="mt-1 text-sm text-gray-500">Hiển thị số sản phẩm, danh mục cha và trạng thái.</p>
            </div>

            @if($categories->isEmpty())
                <div class="p-8 text-center">
                    <h3 class="text-lg font-semibold text-gray-900">Chưa có danh mục nào</h3>
                    <p class="mt-2 text-sm text-gray-500">Hãy thêm danh mục đầu tiên để bắt đầu quản lý sản phẩm.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Danh mục</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Danh mục cha</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Sản phẩm</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Trạng thái</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($categories as $category)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-12 w-12 overflow-hidden rounded-xl bg-gray-100">
                                                @if($category->image_path)
                                                    <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="h-full w-full object-cover">
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900">{{ $category->name }}</div>
                                                <div class="mt-1 text-xs text-gray-500">{{ $category->slug }}</div>
                                                @if($category->trashed())
                                                    <div class="mt-1 text-xs font-semibold text-red-600">Đã xóa mềm</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $category->parent?->name ?? 'Không có' }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $category->products_count }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $category->statusBadgeClasses() }}">
                                            {{ $category->statusLabel() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex flex-wrap justify-end gap-2">
                                            @if(auth()->user()->hasPermission('category.update'))
                                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                                                    Sửa
                                                </a>
                                            @endif
                                            @if(auth()->user()->hasPermission('category.delete'))
                                                @if($category->trashed())
                                                    <x-confirm-delete-modal
                                                        :name="'restore-category-'.$category->id"
                                                        :action="route('admin.categories.restore', $category)"
                                                        title="Khôi phục danh mục?"
                                                        message="Bạn chắc chắn muốn khôi phục danh mục này?"
                                                        trigger-label="Khôi phục"
                                                        confirm-label="Khôi phục"
                                                        method="patch"
                                                        trigger-class="text-sm font-medium text-emerald-600 hover:text-emerald-700 bg-transparent border-0 p-0"
                                                    />
                                                @else
                                                    <x-confirm-delete-modal
                                                        :name="'delete-category-'.$category->id"
                                                        :action="route('admin.categories.destroy', $category)"
                                                        title="Xóa danh mục?"
                                                        message="Bạn chắc chắn muốn xóa danh mục này?"
                                                        trigger-label="Xóa"
                                                        confirm-label="Xóa"
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
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
