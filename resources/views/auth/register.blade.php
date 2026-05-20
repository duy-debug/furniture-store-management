<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Họ tên')" />
            <x-text-input id="name" class="mt-1 block w-full rounded-2xl border-slate-300 bg-slate-50 px-4 py-3 shadow-sm focus:border-primary focus:ring-primary" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-1 block w-full rounded-2xl border-slate-300 bg-slate-50 px-4 py-3 shadow-sm focus:border-primary focus:ring-primary" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Số điện thoại')" />
            <x-text-input id="phone" class="mt-1 block w-full rounded-2xl border-slate-300 bg-slate-50 px-4 py-3 shadow-sm focus:border-primary focus:ring-primary" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" placeholder="0901234567" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Mật khẩu')" />
            <x-text-input id="password" class="mt-1 block w-full rounded-2xl border-slate-300 bg-slate-50 px-4 py-3 shadow-sm focus:border-primary focus:ring-primary" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Xác nhận mật khẩu')" />
            <x-text-input id="password_confirmation" class="mt-1 block w-full rounded-2xl border-slate-300 bg-slate-50 px-4 py-3 shadow-sm focus:border-primary focus:ring-primary" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-4 pt-2">
            <a class="text-xs font-semibold uppercase tracking-widest text-primary hover:text-secondary" href="{{ route('login') }}">
                {{ __('Đã có tài khoản?') }}
            </a>

            <button type="submit" class="ms-4 inline-flex items-center rounded-2xl bg-primary px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-primary/20 hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                {{ __('Đăng ký') }}
            </button>
        </div>
    </form>
</x-guest-layout>
