<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Thông Mai') }} - Nội thất cao cấp</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">

        {{-- Header / Navigation --}}
        <header class="fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-primary text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    {{-- Logo --}}
                    <a href="/" class="flex items-center gap-3">
                        <img src="{{ asset('images/logothongmai.jpg') }}" alt="Thông Mai" class="block h-9 w-9 rounded-lg object-cover ring-1 ring-white/20">
                        <span class="font-bold text-lg text-white">Thông Mai</span>
                    </a>

                    {{-- Navigation Links --}}
                    <nav class="hidden md:flex items-center space-x-8">
                        <a href="/" class="text-sm font-medium text-white/80 hover:text-white transition {{ request()->is('/') ? 'text-white' : '' }}">Trang chủ</a>

                        @isset($navProducts)
                            <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                                <button
                                    type="button"
                                    @click="open = !open"
                                    class="inline-flex items-center gap-1 text-sm font-medium text-white/80 transition hover:text-white {{ request()->routeIs('products.*') ? 'text-white' : '' }}"
                                >
                                    <span>Sản phẩm</span>
                                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.942l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div
                                    x-cloak
                                    x-show="open"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-2"
                                    class="absolute left-0 top-full z-50 mt-3 w-72 max-h-80 overflow-y-auto rounded-2xl bg-white p-2 text-slate-700 shadow-xl ring-1 ring-black/5"
                                >
                                    <a href="{{ route('products.index') }}"
                                       class="mb-1 block rounded-xl px-4 py-3 text-sm font-semibold text-primary transition hover:bg-primary/5">
                                        Xem tất cả sản phẩm
                                    </a>
                                    @foreach($navProducts as $product)
                                        <a href="{{ route('products.show', $product->slug) }}"
                                           class="block rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-primary/5 hover:text-primary {{ request()->routeIs('products.show') && request()->route('slug') === $product->slug ? 'bg-primary/5 text-primary' : '' }}">
                                            {{ $product->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ route('products.index') }}" class="text-sm font-medium text-white/80 hover:text-white transition {{ request()->routeIs('products.*') ? 'text-white' : '' }}">Sản phẩm</a>
                        @endisset

                        @isset($navCategories)
                            <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                                <button
                                    type="button"
                                    @click="open = !open"
                                    class="inline-flex items-center gap-1 text-sm font-medium text-white/80 transition hover:text-white"
                                >
                                    <span>Danh mục</span>
                                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.942l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <div
                                    x-cloak
                                    x-show="open"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-2"
                                    class="absolute left-0 top-full z-50 mt-3 w-64 rounded-2xl bg-white p-2 text-slate-700 shadow-xl ring-1 ring-black/5"
                                >
                                    @foreach($navCategories as $category)
                                        <a href="{{ url('/products?category=' . $category->id) }}"
                                           class="block rounded-xl px-4 py-3 text-sm font-medium transition hover:bg-primary/5 hover:text-primary {{ (string) request('category') === (string) $category->id ? 'bg-primary/5 text-primary' : '' }}">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="/#categories" class="text-sm font-medium text-white/80 hover:text-white transition">Danh mục</a>
                        @endisset

                        <a href="/#contact" class="text-sm font-medium text-white/80 hover:text-white transition">Liên hệ</a>
                    </nav>

                    {{-- Auth Links --}}
                    <div class="flex items-center gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}"
                               class="inline-flex items-center rounded-lg border border-accent/40 bg-accent px-4 py-2 text-xs font-semibold uppercase tracking-widest text-primary transition hover:bg-accent/90">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center rounded-lg border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-white/15 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-primary">
                                Đăng nhập
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="inline-flex items-center rounded-lg border border-primary/20 bg-accent px-4 py-2 text-xs font-semibold uppercase tracking-widest text-primary transition hover:bg-accent/90 hover:text-white focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-primary">
                                    Đăng ký
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        {{-- Toast Notification --}}
        <x-toast-notification />

        {{-- Page Heading --}}
        @isset($header)
            <header class="border-b border-primary/10 bg-white/90 shadow-sm backdrop-blur">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Page Content --}}
        <main class="pt-16">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="bg-gray-950 text-gray-400 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm">&copy; {{ date('Y') }} Thông Mai Furniture. All rights reserved.</p>
                    <div class="flex items-center gap-6">
                        <a href="#" class="text-sm hover:text-white transition">Chính sách bảo mật</a>
                        <a href="#" class="text-sm hover:text-white transition">Điều khoản sử dụng</a>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
