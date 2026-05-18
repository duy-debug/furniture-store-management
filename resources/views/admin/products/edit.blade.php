<x-admin-layout>
    <x-slot name="header">Cập nhật sản phẩm</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.products._form', ['product' => $product, 'categories' => $categories, 'isEdit' => $isEdit])
        </form>
    </div>
</x-admin-layout>
