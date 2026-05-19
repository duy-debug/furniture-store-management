<nav x-data="{ open: false }" class="bg-primary text-white shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-3">
                        <img src="{{ asset('images/logothongmai.jpg') }}" alt="Thông Mai" class="block h-9 w-9 rounded-lg object-cover ring-1 ring-white/20">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="/" :active="request()->is('/')">
                        {{ __('Trang chủ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                        {{ __('Sản phẩm') }}
                    </x-nav-link>
                    @auth
                        <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                            {{ __('Đơn hàng') }}
                        </x-nav-link>
                    @endauth
                    @auth
                        <x-nav-link :href="route('design-requests.index')" :active="request()->routeIs('design-requests.*')">
                            {{ __('Thiết kế') }}
                        </x-nav-link>
                    @endauth
                    @auth
                        <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.*')">
                            {{ __('Giỏ hàng') }}
                        </x-nav-link>
                    @endauth
                    @auth
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Trang cá nhân') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown / Auth Links -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48" contentClasses="py-1 bg-white text-slate-700">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center rounded-lg border border-white/20 bg-white/10 px-3 py-2 text-sm leading-4 font-medium text-white transition duration-150 ease-in-out hover:bg-white/15 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Hồ sơ') }}
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
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center rounded-lg border border-white/20 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-white/15 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-primary">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="ms-3 inline-flex items-center rounded-lg border border-transparent bg-accent px-4 py-2 text-xs font-semibold uppercase tracking-widest text-primary transition hover:bg-accent/90 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-primary">Đăng ký</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-lg p-2 text-white/80 transition duration-150 ease-in-out hover:bg-white/10 hover:text-white focus:outline-none focus:bg-white/10 focus:text-white">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-white/10 bg-primary/95">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="/" :active="request()->is('/')">
                {{ __('Trang chủ') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                {{ __('Sản phẩm') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">
                    {{ __('Đơn hàng') }}
                </x-responsive-nav-link>
            @endauth
            @auth
                <x-responsive-nav-link :href="route('design-requests.index')" :active="request()->routeIs('design-requests.*')">
                    {{ __('Thiết kế') }}
                </x-responsive-nav-link>
            @endauth
            @auth
                <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.*')">
                    {{ __('Giỏ hàng') }}
                </x-responsive-nav-link>
            @endauth
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Trang cá nhân') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white/10">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-white/70">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Hồ sơ') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Đăng xuất') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 py-3 space-y-3">
                    <a href="{{ route('login') }}" class="block rounded-lg border border-white/20 bg-white/10 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-white/15 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-primary">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="block rounded-lg border border-transparent bg-accent px-4 py-2 text-center text-sm font-semibold text-primary transition hover:bg-accent/90 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-primary">Đăng ký</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
