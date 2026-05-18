@props([
    'name',
    'action',
    'title' => 'Xóa mục này?',
    'message' => 'Bạn chắc chắn muốn xóa mục này?',
    'confirmLabel' => 'Xóa',
    'cancelLabel' => 'Hủy',
    'triggerLabel' => 'Xóa',
    'triggerClass' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150',
    'method' => 'delete',
])

@php
    // Allow callers to fully control the trigger button style with a plain `class` attribute.
    $buttonClass = $attributes->get('class') ?: $triggerClass;
    $buttonAttributes = $attributes->except('class')->merge([
        'type' => 'button',
        'class' => $buttonClass,
    ]);
@endphp

<button
    {{ $buttonAttributes }}
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', '{{ $name }}')"
>
    {{ $triggerLabel }}
</button>

<x-modal name="{{ $name }}" :show="false" focusable maxWidth="lg">
    <form method="POST" action="{{ $action }}" class="p-6 sm:p-8">
        @csrf
        @if(strtolower($method) !== 'delete')
            @method(strtoupper($method))
        @else
            @method('DELETE')
        @endif

        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-50 text-red-600">
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

        <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-center">
            <x-secondary-button x-on:click="$dispatch('close-modal', '{{ $name }}')" class="justify-center">
                {{ $cancelLabel }}
            </x-secondary-button>

            <x-danger-button class="justify-center">
                {{ $confirmLabel }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
