<x-guest-layout>
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="login" :value="__('Email hoặc Số điện thoại')" />
            <x-text-input id="login" class="mt-1 block w-full rounded-2xl border-slate-300 bg-slate-50 px-4 py-3 shadow-sm focus:border-primary focus:ring-primary" type="text" name="login" :value="old('login')" required autofocus autocomplete="username" placeholder="email@example.com hoặc 0901234567" />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Mật khẩu')" />
            <x-text-input id="password" class="mt-1 block w-full rounded-2xl border-slate-300 bg-slate-50 px-4 py-3 shadow-sm focus:border-primary focus:ring-primary" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ghi nhớ đăng nhập') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-primary hover:text-secondary" href="{{ route('password.request') }}">
                    {{ __('Quên mật khẩu?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="flex w-full justify-center rounded-2xl bg-primary px-4 py-3 text-sm font-semibold normal-case tracking-normal shadow-lg shadow-primary/20 hover:bg-secondary focus:ring-primary">
                {{ __('Đăng nhập') }}
            </x-primary-button>
        </div>

        <div class="flex items-center justify-center pt-2 text-sm text-slate-500">
            <span>Bạn chưa có tài khoản?</span>
            <a href="{{ route('register') }}" class="ms-1 inline-flex items-center text-xs font-semibold uppercase tracking-widest text-primary hover:text-secondary">
                {{ __('Đăng ký ngay') }}
            </a>
        </div>
    </form>
</x-guest-layout>
