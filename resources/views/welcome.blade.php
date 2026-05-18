<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Thông Mai') }} - Nội thất cao cấp</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white">

        {{-- Header / Navigation --}}
        <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    {{-- Logo --}}
                    <a href="/" class="flex items-center gap-2">
                        <x-application-logo class="block h-8 w-auto fill-current text-gray-800" />
                        <span class="font-bold text-lg text-gray-800">Thông Mai</span>
                    </a>

                    {{-- Navigation Links --}}
                    <nav class="hidden md:flex items-center space-x-8">
                        <a href="/" class="text-sm font-medium text-gray-900 hover:text-indigo-600 transition">Trang chủ</a>
                        <a href="#products" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition">Sản phẩm</a>
                        <a href="#categories" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition">Danh mục</a>
                        <a href="#contact" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition">Liên hệ</a>
                    </nav>

                    {{-- Auth Links --}}
                    <div class="flex items-center gap-3">
                        @auth
                            <a href="{{ route('dashboard') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="text-sm font-medium text-gray-500 hover:text-gray-700 transition">
                                Đăng nhập
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                                    Đăng ký
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        {{-- Hero Banner --}}
        <section class="relative bg-gradient-to-br from-gray-50 to-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
                <div class="max-w-3xl">
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-6">
                        Nội thất cao cấp<br>
                        <span class="text-indigo-600">cho không gian sống của bạn</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-2xl">
                        Thông Mai mang đến giải pháp nội thất toàn diện — từ sản phẩm chất lượng đến dịch vụ thiết kế tư vấn chuyên nghiệp, giúp biến ngôi nhà thành tổ ấm.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#products"
                           class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                            Xem sản phẩm
                        </a>
                        <a href="#contact"
                           class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                            Tư vấn thiết kế
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Categories Section --}}
        <section id="categories" class="py-16 lg:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Danh mục sản phẩm</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Khám phá các dòng sản phẩm nội thất đa dạng, phù hợp với mọi phong cách sống.</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="group text-center">
                        <div class="bg-gray-100 rounded-lg p-8 mb-3 group-hover:bg-indigo-50 transition">
                            <svg class="h-12 w-12 mx-auto text-gray-400 group-hover:text-indigo-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-900">Phòng khách</h3>
                    </div>

                    <div class="group text-center">
                        <div class="bg-gray-100 rounded-lg p-8 mb-3 group-hover:bg-indigo-50 transition">
                            <svg class="h-12 w-12 mx-auto text-gray-400 group-hover:text-indigo-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-900">Phòng ngủ</h3>
                    </div>

                    <div class="group text-center">
                        <div class="bg-gray-100 rounded-lg p-8 mb-3 group-hover:bg-indigo-50 transition">
                            <svg class="h-12 w-12 mx-auto text-gray-400 group-hover:text-indigo-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-900">Văn phòng</h3>
                    </div>

                    <div class="group text-center">
                        <div class="bg-gray-100 rounded-lg p-8 mb-3 group-hover:bg-indigo-50 transition">
                            <svg class="h-12 w-12 mx-auto text-gray-400 group-hover:text-indigo-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                            </svg>
                        </div>
                        <h3 class="font-medium text-gray-900">Nhà bếp</h3>
                    </div>
                </div>
            </div>
        </section>

        {{-- Featured Products Section --}}
        <section id="products" class="py-16 lg:py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Sản phẩm nổi bật</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Những sản phẩm được yêu thích nhất tại Thông Mai.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Placeholder products - sẽ được thay bằng dữ liệu thật --}}
                    @for($i = 1; $i <= 4; $i++)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden group">
                        <div class="aspect-square bg-gray-100 flex items-center justify-center">
                            <svg class="h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-medium text-gray-900 mb-1">Sản phẩm mẫu {{ $i }}</h3>
                            <p class="text-xs text-gray-500 mb-2">Danh mục</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-indigo-600">{{ number_format(rand(1, 50) * 100000, 0, ',', '.') }}đ</span>
                                <span class="text-xs text-green-600 font-medium">Còn hàng</span>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

                <div class="text-center mt-10">
                    <a href="#"
                       class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition">
                        Xem tất cả sản phẩm
                    </a>
                </div>
            </div>
        </section>

        {{-- Services Section --}}
        <section class="py-16 lg:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Dịch vụ của chúng tôi</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Không chỉ bán sản phẩm, Thông Mai còn cung cấp dịch vụ thiết kế nội thất trọn gói.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-50 rounded-full mb-4">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tư vấn thiết kế</h3>
                        <p class="text-gray-600 text-sm">Đội ngũ kiến trúc sư tư vấn miễn phí, giúp bạn lựa chọn phong cách phù hợp.</p>
                    </div>

                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-50 rounded-full mb-4">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Giao hàng & Lắp đặt</h3>
                        <p class="text-gray-600 text-sm">Giao hàng tận nơi, lắp đặt chuyên nghiệp, đảm bảo an toàn và thẩm mỹ.</p>
                    </div>

                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-50 rounded-full mb-4">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Bảo hành dài hạn</h3>
                        <p class="text-gray-600 text-sm">Cam kết bảo hành sản phẩm lên đến 5 năm, hỗ trợ bảo trì trọn đời.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Contact Section --}}
        <section id="contact" class="py-16 lg:py-24 bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div>
                        <h2 class="text-3xl font-bold mb-4">Liên hệ với chúng tôi</h2>
                        <p class="text-gray-400 mb-8">Hãy để Thông Mai đồng hành cùng bạn trong việc tạo nên không gian sống hoàn hảo.</p>

                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-gray-300">115 Nguyễn Xiển, Nha Trang, Khánh Hòa</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-gray-300">0900 000 001</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-gray-300">contact@thongmai.local</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="bg-gray-800 rounded-lg p-6">
                            <h3 class="text-lg font-semibold mb-4">Gửi tin nhắn</h3>
                            <form class="space-y-4">
                                <div>
                                    <input type="text" placeholder="Họ tên"
                                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>
                                <div>
                                    <input type="email" placeholder="Email"
                                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>
                                <div>
                                    <textarea rows="4" placeholder="Nội dung tin nhắn"
                                              class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                                </div>
                                <button type="submit"
                                        class="w-full px-6 py-3 bg-indigo-600 rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                                    Gửi tin nhắn
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
