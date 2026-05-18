<x-admin-layout>
    <x-slot name="header">Gán quyền cho vai trò: {{ $role->name }}</x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.roles.permissions.update', $role) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <p class="text-sm text-gray-600">
                                Chọn các quyền cần gán cho vai trò <strong>{{ $role->name }}</strong>.
                                Các quyền được nhóm theo module.
                            </p>
                        </div>

                        {{-- Nút chọn tất cả / bỏ chọn tất cả --}}
                        <div class="mb-4 flex gap-3">
                            <button type="button" onclick="toggleAll(true)"
                                    class="text-sm text-indigo-600 hover:text-indigo-900 underline">
                                Chọn tất cả
                            </button>
                            <button type="button" onclick="toggleAll(false)"
                                    class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Bỏ chọn tất cả
                            </button>
                        </div>

                        @foreach($permissions as $module => $modulePermissions)
                            <div class="mb-6 border border-gray-200 rounded-lg overflow-hidden">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                    <h3 class="text-sm font-semibold text-gray-700 uppercase">
                                        {{ ucfirst(str_replace('_', ' ', $module)) }}
                                    </h3>
                                </div>
                                <div class="p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($modulePermissions as $permission)
                                        <label class="flex items-start gap-2 cursor-pointer">
                                            <input type="checkbox"
                                                   name="permissions[]"
                                                   value="{{ $permission->id }}"
                                                   class="permission-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mt-0.5"
                                                   {{ in_array($permission->id, $rolePermissionIds) ? 'checked' : '' }}>
                                            <span class="text-sm">
                                                <span class="text-gray-900">{{ $permission->name }}</span>
                                                <br>
                                                <code class="text-xs text-gray-500">{{ $permission->code }}</code>
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>{{ __('Lưu quyền') }}</x-primary-button>
                            <a href="{{ route('admin.roles.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAll(checked) {
            document.querySelectorAll('.permission-checkbox').forEach(cb => {
                cb.checked = checked;
            });
        }
    </script>
</x-admin-layout>
