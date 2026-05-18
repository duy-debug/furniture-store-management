<x-admin-layout>
    <x-slot name="header">Thêm vai trò mới</x-slot>

    <div class="max-w-2xl">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.roles.store') }}">
                        @csrf

                        {{-- Tên vai trò --}}
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Tên vai trò')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                          :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Code --}}
                        <div class="mb-4">
                            <x-input-label for="code" :value="__('Code (định danh)')" />
                            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full"
                                          :value="old('code')" required
                                          placeholder="vd: warehouse_staff" />
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500">Chỉ dùng chữ thường, số và dấu gạch dưới.</p>
                        </div>

                        {{-- Mô tả --}}
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Mô tả')" />
                            <textarea id="description" name="description" rows="3"
                                      class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        {{-- Thứ tự sắp xếp --}}
                        <div class="mb-6">
                            <x-input-label for="sort_order" :value="__('Thứ tự sắp xếp')" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-32"
                                          :value="old('sort_order', 0)" min="0" />
                            <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Tạo vai trò') }}</x-primary-button>
                            <a href="{{ route('admin.roles.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
