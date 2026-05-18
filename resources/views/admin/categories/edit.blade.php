<x-admin-layout>
    <x-slot name="header">Cập nhật danh mục</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.categories._form', ['category' => $category, 'parents' => $parents, 'isEdit' => $isEdit])
        </form>
    </div>
</x-admin-layout>
