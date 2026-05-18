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
    <body class="font-sans antialiased">
        <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-gray-100">

            {{-- Mobile sidebar overlay --}}
            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-40 bg-gray-600/75 lg:hidden"
                 @click="sidebarOpen = false"
                 style="display: none;">
            </div>

            {{-- Sidebar --}}
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                   class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 ease-in-out lg:translate-x-0 overflow-y-auto">

                {{-- Sidebar Header --}}
                <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-8 w-auto fill-current text-gray-800" />
                        <span class="font-semibold text-gray-800 text-sm">Thông Mai</span>
                    </a>
                    <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Sidebar Navigation --}}
                <nav class="mt-4 px-3 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 4rem)">
                    {{-- Dashboard --}}
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>

                    {{-- Quản lý sản phẩm --}}
                    @if(auth()->user()->hasPermission('product.view'))
                    <a href="{{ Route::has('admin.products.index') ? route('admin.products.index') : '#' }}"
                       class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.products.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.products.*') ? 'text-indigo-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        Sản phẩm
                    </a>
                    @endif

                    {{-- Quản lý danh mục --}}
                    @if(auth()->user()->hasPermission('category.view'))
                    <a href="{{ Route::has('admin.categories.index') ? route('admin.categories.index') : '#' }}"
                       class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.categories.*') ? 'text-indigo-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Danh mục
                    </a>
                    @endif

                    {{-- Quản lý đơn hàng --}}
                    @if(auth()->user()->hasPermission('order.view'))
                    <a href="{{ Route::has('admin.orders.index') ? route('admin.orders.index') : '#' }}"
                       class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.orders.*') ? 'text-indigo-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        Đơn hàng
                    </a>
                    @endif

                    {{-- Quản lý khách hàng --}}
                    @if(auth()->user()->hasPermission('customer.view'))
                    <a href="{{ Route::has('admin.customers.index') ? route('admin.customers.index') : '#' }}"
                       class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.customers.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.customers.*') ? 'text-indigo-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Khách hàng
                    </a>
                    @endif

                    {{-- Yêu cầu thiết kế --}}
                    @if(auth()->user()->hasPermission('design_request.view'))
                    <a href="{{ Route::has('admin.design-requests.index') ? route('admin.design-requests.index') : '#' }}"
                       class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.design-requests.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.design-requests.*') ? 'text-indigo-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                        </svg>
                        Yêu cầu thiết kế
                    </a>
                    @endif

                    {{-- Separator --}}
                    @if(auth()->user()->hasPermission('user.view') || auth()->user()->hasPermission('role.view'))
                    <div class="pt-4 mt-4 border-t border-gray-200">
                        <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Hệ thống</p>
                    </div>
                    @endif

                    {{-- Quản lý người dùng --}}
                    @if(auth()->user()->hasPermission('user.view'))
                    <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}"
                       class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.users.*') ? 'text-indigo-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Người dùng
                    </a>
                    @endif

                    {{-- Quản lý vai trò --}}
                    @if(auth()->user()->hasPermission('role.view'))
                    <a href="{{ route('admin.roles.index') }}"
                       class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.roles.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 {{ request()->routeIs('admin.roles.*') ? 'text-indigo-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Vai trò & Quyền
                    </a>
                    @endif
                </nav>
            </aside>

            {{-- Main Content --}}
            <div class="min-h-screen flex flex-col ml-0 lg:ml-[16rem]">
                {{-- Top Bar --}}
                <header class="sticky top-0 z-30 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                        {{-- Mobile menu button --}}
                        <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        {{-- Page Title --}}
                        <div class="hidden lg:block">
                            @isset($header)
                                <h1 class="text-lg font-semibold text-gray-800">{{ $header }}</h1>
                            @endisset
                        </div>

                        {{-- User Dropdown --}}
                        <div class="flex items-center gap-4 ml-auto">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
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
                            <h1 class="text-lg font-semibold text-gray-800">{{ $header }}</h1>
                        @endisset
                    </div>
                </header>

                {{-- Page Content --}}
                <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-x-auto">
                    {{-- Flash Messages --}}
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
