<x-admin-layout>
    <x-slot name="header">Hồ sơ cá nhân</x-slot>

    <div class="space-y-6">
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm font-medium text-indigo-600">Tài khoản nội bộ</p>
                    <h2 class="mt-1 text-2xl font-semibold text-gray-900">{{ $user->name }}</h2>
                    <p class="mt-1 text-sm text-gray-500">{{ $user->email }}</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    @if($user->hasRole('admin'))
                        <span class="inline-flex rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">Admin</span>
                    @elseif($user->hasRole('staff'))
                        <span class="inline-flex rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">Staff</span>
                    @endif
                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $user->statusBadgeClasses() }}">
                        {{ $user->statusLabel() }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid gap-6 xl:grid-cols-[1.1fr,0.9fr]">
            <div class="space-y-6">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl bg-slate-950 p-6 text-white shadow-sm">
                    <h3 class="text-lg font-semibold">Ghi chú cho tài khoản nội bộ</h3>
                    <ul class="mt-4 space-y-3 text-sm text-slate-300">
                        <li class="flex gap-3">
                            <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-white/10 text-xs font-bold text-white">1</span>
                            Đây là giao diện hồ sơ dành riêng cho nhân viên và quản trị viên.
                        </li>
                        <li class="flex gap-3">
                            <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-white/10 text-xs font-bold text-white">2</span>
                            Bạn có thể cập nhật thông tin cá nhân và đổi mật khẩu tại đây.
                        </li>
                        <li class="flex gap-3">
                            <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-white/10 text-xs font-bold text-white">3</span>
                            Nếu cần xóa tài khoản nội bộ, nên thực hiện qua quy trình quản trị thay vì tự xóa tại đây.
                        </li>
                    </ul>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
