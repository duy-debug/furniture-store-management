<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Quản trị</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        {{-- Toast Notification --}}
        <x-toast-notification />

        <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-slate-50 overflow-x-hidden">

            {{-- Mobile sidebar overlay --}}
              <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                  class="fixed inset-0 z-40 bg-slate-900/60 lg:hidden"
                  @click="sidebarOpen = false"
                  x-cloak>
            </div>

            {{-- Sidebar --}}
                <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                         class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col overflow-hidden bg-primary text-white shadow-xl transition-transform duration-300 ease-in-out lg:translate-x-0">

                {{-- Sidebar Header --}}
                <div class="flex items-center justify-between h-16 px-4 border-b border-white/10">
                    <a href="{{ url('/') }}" class="flex items-center gap-3" title="Về trang chủ">
                        <img src="{{ asset('images/logothongmai.jpg') }}" alt="Thông Mai" class="block h-9 w-9 rounded-lg object-cover ring-1 ring-white/20">
                        <span class="font-semibold text-white text-sm">Thông Mai</span>
                    </a>
                    <button @click="sidebarOpen = false" class="lg:hidden text-white/80 hover:text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Sidebar Navigation --}}
                <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                    {{-- Dashboard --}}
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.dashboard') ? 'text-accent' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>

                    {{-- Quản lý sản phẩm --}}
                    @if(auth()->user()->hasPermission('product.view'))
                    <a href="{{ Route::has('admin.products.index') ? route('admin.products.index') : '#' }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.products.*') ? 'bg-white/15 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.products.*') ? 'text-accent' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Sản phẩm
                    </a>
                    @endif

                    {{-- Quản lý danh mục --}}
                    @if(auth()->user()->hasPermission('category.view'))
                    <a href="{{ Route::has('admin.categories.index') ? route('admin.categories.index') : '#' }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.categories.*') ? 'bg-white/15 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.categories.*') ? 'text-accent' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Danh mục
                    </a>
                    @endif

                    {{-- Quản lý đơn hàng --}}
                    @if(auth()->user()->hasPermission('order.view'))
                    <a href="{{ route('admin.orders.index') }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.orders.*') ? 'bg-white/15 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.orders.*') ? 'text-accent' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        Đơn hàng
                    </a>
                    @endif

                    {{-- Quản lý khách hàng --}}
                    @if(auth()->user()->hasPermission('customer.view'))
                    <a href="{{ Route::has('admin.customers.index') ? route('admin.customers.index') : '#' }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.customers.*') ? 'bg-white/15 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.customers.*') ? 'text-accent' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Khách hàng
                    </a>
                    @endif

                    {{-- Yêu cầu thiết kế --}}
                    @if(auth()->user()->hasPermission('design_request.view'))
                    <a href="{{ Route::has('admin.design-requests.index') ? route('admin.design-requests.index') : '#' }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.design-requests.*') ? 'bg-white/15 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.design-requests.*') ? 'text-accent' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                        Yêu cầu thiết kế
                    </a>
                    @endif

                    {{-- Separator --}}
                    @if(auth()->user()->hasPermission('user.view') || auth()->user()->hasPermission('role.view') || auth()->user()->hasRole('admin'))
                    <div class="pt-4 mt-4 border-t border-white/10">
                        <p class="px-3 text-xs font-semibold uppercase tracking-wider text-white/50">Hệ thống</p>
                    </div>
                    @endif

                    {{-- Báo cáo --}}
                    @if(auth()->user()->hasRole('admin'))
                    <a href="{{ route('admin.reports.index') }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.reports.*') ? 'bg-white/15 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.reports.*') ? 'text-accent' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3v18m8-18v18M3 13h18M3 7h18M3 19h18"/>
                        </svg>
                        Báo cáo
                    </a>
                    @endif

                    {{-- Quản lý người dùng --}}
                    @if(auth()->user()->hasPermission('user.view'))
                    <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.users.*') ? 'bg-white/15 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.users.*') ? 'text-accent' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Người dùng
                    </a>
                    @endif

                    {{-- Quản lý vai trò --}}
                    @if(auth()->user()->hasPermission('role.view'))
                    <a href="{{ route('admin.roles.index') }}"
                       class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.roles.*') ? 'bg-white/15 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.roles.*') ? 'text-accent' : 'text-white/60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Vai trò & Quyền
                    </a>
                    @endif
                </nav>
            </aside>

            {{-- Main Content --}}
            <div class="min-h-screen flex flex-col ml-0 lg:ml-[16rem] min-w-0">
                {{-- Top Bar --}}
                <header class="sticky top-0 z-30 border-b border-primary/10 bg-white/90 backdrop-blur">
                    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                        {{-- Mobile menu button --}}
                        <button @click="sidebarOpen = true" class="lg:hidden text-primary hover:text-primary/80">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        {{-- Page Title --}}
                        <div class="hidden lg:block">
                            @isset($header)
                                <h1 class="text-lg font-semibold text-slate-900">{{ $header }}</h1>
                            @endisset
                        </div>

                        {{-- User Dropdown --}}
                        <div class="flex items-center gap-4 ml-auto">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center rounded-lg border border-primary/10 bg-primary/5 px-3 py-2 text-sm leading-4 font-medium text-primary transition duration-150 ease-in-out hover:bg-primary/10 focus:outline-none">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Hồ sơ') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('dashboard')">
                                        {{ __('Về trang chính') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Đăng xuất') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                    {{-- Mobile Page Title --}}
                    <div class="lg:hidden px-4 pb-3">
                        @isset($header)
                            <h1 class="text-lg font-semibold text-slate-900">{{ $header }}</h1>
                        @endisset
                    </div>
                </header>

                {{-- Page Content --}}
                <main class="flex-1 overflow-x-auto p-4 sm:p-6 lg:p-8 min-w-0">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
