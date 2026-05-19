<x-admin-layout>
    <x-slot name="header">Thêm người dùng nội bộ</x-slot>

    <div class="max-w-3xl">
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                @include('admin.users._form', ['user' => $user, 'roles' => $roles, 'isEdit' => false])

                <div class="mt-8 flex items-center gap-4">
                    <x-primary-button>{{ __('Tạo người dùng') }}</x-primary-button>
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
