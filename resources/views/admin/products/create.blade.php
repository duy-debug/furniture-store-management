<x-admin-layout>
    <x-slot name="header">Thêm sản phẩm</x-slot>

    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.products._form', ['product' => $product, 'categories' => $categories, 'isEdit' => $isEdit])
        </form>
    </div>
</x-admin-layout>
