<x-admin-layout>
    <x-slot name="header">Chỉnh sửa vai trò: {{ $role->name }}</x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                        @csrf
                        @method('PUT')

                        {{-- Tên vai trò --}}
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Tên vai trò')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                          :value="old('name', $role->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Code --}}
                        <div class="mb-4">
                            <x-input-label for="code" :value="__('Code (định danh)')" />
                            <x-text-input id="code" name="code" type="text" class="mt-1 block w-full"
                                          :value="old('code', $role->code)" required
                                          :disabled="$role->is_system" />
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            @if($role->is_system)
                                <p class="mt-1 text-sm text-amber-600">Code của vai trò hệ thống không thể thay đổi.</p>
                            @endif
                        </div>

                        {{-- Mô tả --}}
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Mô tả')" />
                            <textarea id="description" name="description" rows="3"
                                      class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $role->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        {{-- Thứ tự sắp xếp --}}
                        <div class="mb-6">
                            <x-input-label for="sort_order" :value="__('Thứ tự sắp xếp')" />
                            <x-text-input id="sort_order" name="sort_order" type="number" class="mt-1 block w-32"
                                          :value="old('sort_order', $role->sort_order)" min="0" />
                            <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
                        </div>

                        @if($role->is_system)
                            <div class="mb-6 p-3 bg-blue-50 border border-blue-200 rounded-md">
                                <p class="text-sm text-blue-700">
                                    <strong>Lưu ý:</strong> Đây là vai trò hệ thống. Bạn chỉ có thể thay đổi tên, mô tả và thứ tự sắp xếp.
                                </p>
                            </div>
                        @endif

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Cập nhật') }}</x-primary-button>
                            <a href="{{ route('admin.roles.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
