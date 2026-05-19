@php
    $selectedRoleId = old('role_id', $user->roles->first()?->id);
@endphp

<div class="space-y-5">
    <div>
        <x-input-label for="name" :value="__('Họ tên')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="phone" :value="__('Số điện thoại')" />
        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password" :value="$isEdit ? __('Mật khẩu mới') : __('Mật khẩu')" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" :value="old('password')" :required="! $isEdit" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
        @if($isEdit)
            <p class="mt-1 text-xs text-gray-500">Để trống nếu không muốn thay đổi mật khẩu.</p>
        @endif
    </div>

    <div>
        <x-input-label for="role_id" :value="__('Vai trò')" />
        <select id="role_id" name="role_id" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
            <option value="">Chọn vai trò</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" @selected((string) $selectedRoleId === (string) $role->id)>
                    {{ $role->name }} ({{ $role->code }})
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
    </div>
</div>
