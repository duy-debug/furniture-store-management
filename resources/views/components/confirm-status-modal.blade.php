@props([
    'name',
    'action',
    'title' => 'Xác nhận',
    'message' => 'Bạn có chắc chắn muốn thực hiện thao tác này?',
    'confirmLabel' => 'Xác nhận',
    'cancelLabel' => 'Hủy',
    'triggerLabel' => 'Thực hiện',
    'triggerClass' => 'inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150',
    'method' => 'patch',
    'showReasonField' => false,
    'reasonName' => 'reason',
    'reasonLabel' => 'Lý do',
    'reasonPlaceholder' => 'Nhập lý do tại đây...',
    'reasonHelp' => null,
    'confirmClass' => null,
    'tone' => 'amber',
])

@php
    $buttonClass = $attributes->get('class') ?: $triggerClass;
    $buttonAttributes = $attributes->except('class')->merge([
        'type' => 'button',
        'class' => $buttonClass,
    ]);

    $showModal = $showReasonField && $errors->has($reasonName);
    $confirmButtonClass = $confirmClass ?: match ($tone) {
        'green' => 'bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500',
        'blue' => 'bg-primary hover:bg-primary/90 focus:ring-primary',
        default => 'bg-amber-600 hover:bg-amber-700 focus:ring-amber-500',
    };
@endphp

<button
    {{ $buttonAttributes }}
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', '{{ $name }}')"
>
    {{ $triggerLabel }}
</button>

<x-modal name="{{ $name }}" :show="$showModal" focusable maxWidth="lg">
    <form method="POST" action="{{ $action }}" class="p-6 sm:p-8">
        @csrf
        @method(strtoupper($method))

        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-amber-50 text-amber-600">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 9v4"></path>
                <path d="M12 17h.01"></path>
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3l-8.47-14.14a2 2 0 0 0-3.42 0Z"></path>
            </svg>
        </div>

        <h2 class="mt-4 text-center text-xl font-semibold text-gray-900">
            {{ $title }}
        </h2>

        <p class="mt-2 text-center text-sm leading-6 text-gray-600">
            {{ $message }}
        </p>

        @if($showReasonField)
            <div class="mt-6 text-left">
                <x-input-label :for="$reasonName" :value="$reasonLabel" />
                <textarea
                    id="{{ $reasonName }}"
                    name="{{ $reasonName }}"
                    rows="4"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                    placeholder="{{ $reasonPlaceholder }}"
                    required
                >{{ old($reasonName) }}</textarea>
                @if($reasonHelp)
                    <p class="mt-2 text-xs text-gray-500">{{ $reasonHelp }}</p>
                @endif
                <x-input-error :messages="$errors->get($reasonName)" class="mt-2" />
            </div>
        @endif

        <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-center">
            <x-secondary-button x-on:click="$dispatch('close-modal', '{{ $name }}')" class="justify-center">
                {{ $cancelLabel }}
            </x-secondary-button>

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-lg border border-transparent px-4 py-2 font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition duration-150 ease-in-out {{ $confirmButtonClass }}"
            >
                {{ $confirmLabel }}
            </button>
        </div>
    </form>
</x-modal>
