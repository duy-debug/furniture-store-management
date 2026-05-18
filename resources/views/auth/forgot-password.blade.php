<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Quên mật khẩu? Nhập email của bạn và chúng tôi sẽ gửi link đặt lại mật khẩu.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('login') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Quay lại đăng nhập') }}
            </a>

            <x-primary-button>
                {{ __('Gửi link đặt lại') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
