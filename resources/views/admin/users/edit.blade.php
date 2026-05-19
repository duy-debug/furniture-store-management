<x-admin-layout>
    <x-slot name="header">Chỉnh sửa người dùng: {{ $user->name }}</x-slot>

    <div class="max-w-3xl">
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                @include('admin.users._form', ['user' => $user, 'roles' => $roles, 'isEdit' => true])

                @if(isset($canLock))
                    <div class="mt-6 rounded-2xl border border-gray-200 bg-gray-50 p-4 text-sm text-gray-600">
                        @if($canLock)
                            Người dùng này có thể được khóa hoặc mở khóa từ danh sách hoặc sau khi lưu cập nhật.
                        @else
                            Không thể khóa vì đây là admin duy nhất đang hoạt động.
                        @endif
                    </div>
                @endif

                <div class="mt-8 flex items-center gap-4">
                    <x-primary-button>{{ __('Cập nhật') }}</x-primary-button>
                    <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
