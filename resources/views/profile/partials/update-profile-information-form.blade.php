<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Thông tin cá nhân') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Cập nhật thông tin cá nhân và địa chỉ liên hệ.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Họ tên --}}
        <div>
            <x-input-label for="name" :value="__('Họ tên')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Email chưa được xác minh.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Gửi lại email xác minh.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Đã gửi link xác minh mới.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Số điện thoại --}}
        <div>
            <x-input-label for="phone" :value="__('Số điện thoại')" />
            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        {{-- Ngày sinh & Giới tính --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="birthday" :value="__('Ngày sinh')" />
                <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', $user->birthday?->format('Y-m-d'))" />
                <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
            </div>

            <div>
                <x-input-label for="gender" :value="__('Giới tính')" />
                <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">-- Chọn --</option>
                    <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Nam</option>
                    <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Nữ</option>
                    <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Khác</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>
        </div>

        {{-- Địa chỉ --}}
        <div class="border-t border-gray-200 pt-4">
            <h3 class="text-sm font-medium text-gray-700 mb-3">Địa chỉ</h3>

            <div class="space-y-4">
                <div>
                    <x-input-label for="address_line_1" :value="__('Địa chỉ dòng 1')" />
                    <x-text-input id="address_line_1" name="address_line_1" type="text" class="mt-1 block w-full" :value="old('address_line_1', $user->address_line_1)" placeholder="Số nhà, tên đường" />
                    <x-input-error class="mt-2" :messages="$errors->get('address_line_1')" />
                </div>

                <div>
                    <x-input-label for="address_line_2" :value="__('Địa chỉ dòng 2')" />
                    <x-text-input id="address_line_2" name="address_line_2" type="text" class="mt-1 block w-full" :value="old('address_line_2', $user->address_line_2)" placeholder="Tòa nhà, tầng (nếu có)" />
                    <x-input-error class="mt-2" :messages="$errors->get('address_line_2')" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="ward" :value="__('Phường/Xã')" />
                        <x-text-input id="ward" name="ward" type="text" class="mt-1 block w-full" :value="old('ward', $user->ward)" />
                        <x-input-error class="mt-2" :messages="$errors->get('ward')" />
                    </div>

                    <div>
                        <x-input-label for="district" :value="__('Quận/Huyện')" />
                        <x-text-input id="district" name="district" type="text" class="mt-1 block w-full" :value="old('district', $user->district)" />
                        <x-input-error class="mt-2" :messages="$errors->get('district')" />
                    </div>

                    <div>
                        <x-input-label for="province" :value="__('Tỉnh/Thành phố')" />
                        <x-text-input id="province" name="province" type="text" class="mt-1 block w-full" :value="old('province', $user->province)" />
                        <x-input-error class="mt-2" :messages="$errors->get('province')" />
                    </div>
                </div>

                <div class="w-1/3">
                    <x-input-label for="postal_code" :value="__('Mã bưu chính')" />
                    <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('postal_code', $user->postal_code)" />
                    <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
                </div>
            </div>
        </div>

        {{-- Liên hệ ưu tiên --}}
        <div>
            <x-input-label for="preferred_contact_method" :value="__('Cách liên hệ ưu tiên')" />
            <select id="preferred_contact_method" name="preferred_contact_method" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="both" {{ old('preferred_contact_method', $user->preferred_contact_method) === 'both' ? 'selected' : '' }}>Email & Điện thoại</option>
                <option value="email" {{ old('preferred_contact_method', $user->preferred_contact_method) === 'email' ? 'selected' : '' }}>Email</option>
                <option value="phone" {{ old('preferred_contact_method', $user->preferred_contact_method) === 'phone' ? 'selected' : '' }}>Điện thoại</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('preferred_contact_method')" />
        </div>

        {{-- Ghi chú --}}
        <div>
            <x-input-label for="notes" :value="__('Ghi chú cá nhân')" />
            <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes', $user->notes) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('notes')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Lưu thay đổi') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <span class="inline-flex items-center gap-1 text-sm text-green-600 font-medium">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Đã lưu thành công
                </span>
            @endif
        </div>
    </form>
</section>
