<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
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
    <body class="font-sans antialiased bg-slate-50 text-slate-900">

        {{-- Header / Navigation --}}
        <header class="relative z-30 border-b border-white/10 bg-primary text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    {{-- Logo --}}
                    <a href="/" class="flex items-center gap-3">
                        <img src="{{ asset('images/logothongmai.jpg') }}" alt="Thông Mai" class="block h-9 w-9 rounded-lg object-cover ring-1 ring-white/20">
                        <span class="font-bold text-lg text-white">Thông Mai</span>
                    </a>

                    {{-- Navigation Links --}}
                    <nav class="hidden md:flex items-center space-x-8">
                        <a href="/" class="text-sm font-medium text-white hover:text-accent transition">Trang chủ</a>
                        <a href="{{ route('products.index') }}" class="text-sm font-medium text-white/80 hover:text-white transition">Sản phẩm</a>
                        <a href="#categories" class="text-sm font-medium text-white/80 hover:text-white transition">Danh mục</a>
                        <a href="#contact" class="text-sm font-medium text-white/80 hover:text-white transition">Liên hệ</a>
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
                                              class="ms-3 inline-flex items-center rounded-lg border border-primary/20 bg-white bg-accent px-4 py-2 text-xs font-semibold uppercase tracking-widest text-primary transition hover:bg-accent/90 hover:text-white focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-primary">
                                    Đăng ký
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <header
            id="home-navbar"
            class="fixed inset-x-0 top-0 z-50 -translate-y-full border-b border-white/10 bg-primary text-white opacity-0 shadow-lg transition-all duration-500 ease-out pointer-events-none"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <a href="/" class="flex items-center gap-3">
                        <img src="{{ asset('images/logothongmai.jpg') }}" alt="Thông Mai" class="block h-9 w-9 rounded-lg object-cover ring-1 ring-white/20">
                        <span class="font-bold text-lg text-white">Thông Mai</span>
                    </a>

                    <nav class="hidden md:flex items-center space-x-8">
                        <a href="/" class="text-sm font-medium text-white hover:text-accent transition">Trang chủ</a>
                        <a href="{{ route('products.index') }}" class="text-sm font-medium text-white/80 hover:text-white transition">Sản phẩm</a>
                        <a href="#categories" class="text-sm font-medium text-white/80 hover:text-white transition">Danh mục</a>
                        <a href="#contact" class="text-sm font-medium text-white/80 hover:text-white transition">Liên hệ</a>
                    </nav>

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
                                   class="ms-3 inline-flex items-center rounded-lg border border-primary/20 bg-white bg-accent px-4 py-2 text-xs font-semibold uppercase tracking-widest text-primary transition hover:bg-accent/90 hover:text-white focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-primary">
                                    Đăng ký
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        {{-- Hero Banner --}}
        <section
            id="home-hero"
            class="relative overflow-hidden min-h-[340px]"
            x-data="{
                current: 0,
                timer: null,
                slides: [
                    '{{ asset('slides/1.jpg') }}',
                    '{{ asset('slides/2.jpg') }}',
                    '{{ asset('slides/3.jpg') }}',
                    '{{ asset('slides/4.jpg') }}',
                    '{{ asset('slides/5.jpg') }}',
                    '{{ asset('slides/6.jpg') }}',
                    '{{ asset('slides/7.jpg') }}',
                    '{{ asset('slides/8.jpg') }}',
                    '{{ asset('slides/9.jpg') }}'
                ],
                init() {
                    this.startAutoplay();
                },
                startAutoplay() {
                    this.stopAutoplay();
                    this.timer = setInterval(() => {
                        this.nextSlide();
                    }, 2500);
                },
                stopAutoplay() {
                    if (this.timer) {
                        clearInterval(this.timer);
                        this.timer = null;
                    }
                },
                goTo(index) {
                    if (index === this.current) return;
                    this.current = index;
                    this.startAutoplay();
                },
                nextSlide() {
                    this.current = (this.current + 1) % this.slides.length;
                    this.startAutoplay();
                },
                prevSlide() {
                    this.current = (this.current - 1 + this.slides.length) % this.slides.length;
                    this.startAutoplay();
                }
            }"
            x-init="init()"
            x-on:mouseenter="stopAutoplay()"
            x-on:mouseleave="startAutoplay()"
        >
            <div class="absolute inset-0 overflow-hidden">
                <template x-for="(slide, index) in slides" :key="`${index}-${slide}`">
                    <div
                        class="absolute inset-0 transition-[opacity,transform] duration-1000 ease-out will-change-transform"
                        :class="index === current ? 'opacity-100 scale-105' : 'opacity-0 scale-100 pointer-events-none'"
                    >
                        <img
                            :src="slide"
                            alt="Hero banner nội thất Thông Mai"
                            class="h-full w-full object-cover object-center"
                        >
                    </div>
                </template>
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/70 via-slate-900/40 to-slate-950/20"></div>
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(160,210,235,0.22),transparent_34%),radial-gradient(circle_at_bottom_left,rgba(44,127,184,0.28),transparent_40%)]"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 min-h-[420px] flex items-center">
                <div class="max-w-3xl text-white">
                    <span class="hero-fade-up hero-fade-up-delay-1 inline-flex items-center rounded-full border border-white/20 bg-white/10 px-4 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-white/90">
                        Nội thất cao cấp Thông Mai
                    </span>
                    <h1 class="mt-6 text-4xl lg:text-6xl font-bold leading-tight">
                        <span class="hero-fade-up hero-fade-up-delay-2 block">Không gian sống tinh tế</span>
                        <span class="hero-fade-up hero-fade-up-delay-3 block text-accent">được tạo nên từ chi tiết</span>
                    </h1>
                    <p class="hero-fade-up hero-fade-up-delay-3 mt-6 text-lg text-white/80 max-w-2xl">
                        Thông Mai mang đến giải pháp nội thất toàn diện - từ sản phẩm chất lượng đến dịch vụ thiết kế tư vấn chuyên nghiệp, giúp biến ngôi nhà thành tổ ấm.
                    </p>
                    <div class="hero-fade-up hero-fade-up-delay-3 mt-8 flex flex-wrap gap-4">
                        <a href="#products"
                           class="inline-flex items-center rounded-lg border border-transparent bg-primary px-6 py-3 text-sm font-semibold uppercase tracking-widest text-white transition hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-slate-900">
                            Xem sản phẩm
                        </a>
                        <a href="#contact"
                           class="inline-flex items-center rounded-lg border border-white/20 bg-white/10 px-6 py-3 text-sm font-semibold uppercase tracking-widest text-white transition hover:bg-white/15 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-slate-900">
                            Tư vấn thiết kế
                        </a>
                    </div>
                </div>

                <div class="absolute bottom-6 left-4 right-4 flex items-center justify-between gap-4 sm:left-6 sm:right-6 lg:left-8 lg:right-8">
                    <div class="flex items-center gap-2">
                        <button
                            type="button"
                            @click="prevSlide()"
                            class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white shadow-lg backdrop-blur transition hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-slate-900"
                            aria-label="Previous slide"
                        >
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.707 4.293a1 1 0 010 1.414L9.414 9h6.586a1 1 0 110 2H9.414l3.293 3.293a1 1 0 01-1.414 1.414l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button
                            type="button"
                            @click="nextSlide()"
                            class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white shadow-lg backdrop-blur transition hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 focus:ring-offset-slate-900"
                            aria-label="Next slide"
                        >
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.293 15.707a1 1 0 010-1.414L10.586 11H4a1 1 0 110-2h6.586L7.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-2">
                        <template x-for="(slide, index) in slides" :key="`dot-${index}`">
                            <button
                                type="button"
                                @click="goTo(index)"
                                :class="index === current ? 'bg-accent w-10' : 'bg-white/40 w-3 hover:bg-white/60'"
                                class="h-3 rounded-full transition-all duration-300"
                                :aria-label="`Chuyển sang ảnh ${index + 1}`"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>
        </section>

        {{-- Categories Section --}}
        <section id="categories" class="scroll-mt-24 py-16 lg:py-24 bg-accent/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div data-scroll-reveal="left" class="scroll-reveal scroll-reveal-left text-center mb-12">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Danh mục sản phẩm</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto">Khám phá các dòng sản phẩm nội thất đa dạng, phù hợp với mọi phong cách sống.</p>
                </div>

                <div data-scroll-reveal="left" class="scroll-reveal scroll-reveal-left grid grid-cols-2 md:grid-cols-4 gap-6">
                    @forelse($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->id]) }}" class="group text-center">
                        <div class="relative mb-3 h-32 overflow-hidden rounded-lg ring-1 ring-primary/10 transition group-hover:shadow-sm md:h-36 lg:h-40">
                            @if($cat->image_path)
                                <img src="{{ asset('storage/' . $cat->image_path) }}" alt="{{ $cat->name }}" class="absolute inset-0 h-full w-full object-cover object-center">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center bg-white/80 group-hover:bg-white">
                                    <svg class="h-12 w-12 text-slate-400 group-hover:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <h3 class="font-medium" style="color: #1E3A5F;">{{ $cat->name }}</h3>
                    </a>
                    @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">Chưa có danh mục nào.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Featured Products Section --}}
        <section id="products" class="scroll-mt-24 py-16 lg:py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div data-scroll-reveal="right" class="scroll-reveal scroll-reveal-right text-center mb-12">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Sản phẩm nổi bật</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto">Những sản phẩm được yêu thích nhất tại Thông Mai.</p>
                </div>

                <div data-scroll-reveal="right" class="scroll-reveal scroll-reveal-right grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($featuredProducts as $product)
                        @include('products._card', ['product' => $product])
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500">Chưa có sản phẩm nào.</p>
                        </div>
                    @endforelse
                </div>

                <div class="text-center mt-10">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center rounded-lg border border-primary/20 bg-white px-6 py-3 text-sm font-semibold uppercase tracking-widest text-primary transition hover:bg-primary/5">
                        Xem tất cả sản phẩm
                    </a>
                </div>
            </div>
        </section>

        {{-- Services Section --}}
        <section class="py-16 lg:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div data-scroll-reveal="left" class="scroll-reveal scroll-reveal-left text-center mb-12">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Dịch vụ của chúng tôi</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto">Không chỉ bán sản phẩm, Thông Mai còn cung cấp dịch vụ thiết kế nội thất trọn gói.</p>
                </div>

                <div data-scroll-reveal="left" class="scroll-reveal scroll-reveal-left grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-accent/30 mb-4">
                            <svg class="h-8 w-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Tư vấn thiết kế</h3>
                        <p class="text-slate-600 text-sm">Đội ngũ kiến trúc sư tư vấn miễn phí, giúp bạn lựa chọn phong cách phù hợp.</p>
                    </div>

                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-accent/30 mb-4">
                            <svg class="h-8 w-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Giao hàng & Lắp đặt</h3>
                        <p class="text-slate-600 text-sm">Giao hàng tận nơi, lắp đặt chuyên nghiệp, đảm bảo an toàn và thẩm mỹ.</p>
                    </div>

                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-accent/30 mb-4">
                            <svg class="h-8 w-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">Bảo hành dài hạn</h3>
                        <p class="text-slate-600 text-sm">Cam kết bảo hành sản phẩm lên đến 5 năm, hỗ trợ bảo trì trọn đời.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Contact Section --}}
        <section id="contact" class="scroll-mt-24 py-16 lg:py-24 bg-primary text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div>
                        <h2 class="text-3xl font-bold mb-4">Liên hệ với chúng tôi</h2>
                        <p class="text-white/75 mb-8">Hãy để Thông Mai đồng hành cùng bạn trong việc tạo nên không gian sống hoàn hảo.</p>

                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-white/80">115 Nguyễn Xiển, Nha Trang, Khánh Hòa</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-white/80">0900 000 001</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-white/80">contact@thongmai.local</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="rounded-lg bg-white/10 p-6 ring-1 ring-white/10">
                            <h3 class="text-lg font-semibold mb-4">Gửi tin nhắn</h3>
                            <form class="space-y-4">
                                <div>
                                    <input type="text" placeholder="Họ tên"
                                           class="w-full rounded-lg border border-white/10 bg-white/10 px-4 py-2 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent">
                                </div>
                                <div>
                                    <input type="email" placeholder="Email"
                                           class="w-full rounded-lg border border-white/10 bg-white/10 px-4 py-2 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent">
                                </div>
                                <div>
                                    <textarea rows="4" placeholder="Nội dung tin nhắn"
                                              class="w-full rounded-lg border border-white/10 bg-white/10 px-4 py-2 text-white placeholder-white/50 focus:border-accent focus:ring-2 focus:ring-accent"></textarea>
                                </div>
                                <button type="submit"
                                        class="w-full rounded-lg bg-accent px-6 py-3 text-sm font-semibold uppercase tracking-widest text-primary transition hover:bg-accent/90">
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

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const navbar = document.getElementById('home-navbar');
                const hero = document.getElementById('home-hero');
                if (!navbar || !hero) return;

                const threshold = Math.max(0, hero.offsetTop - 24);
                const updateNavbar = () => {
                    const isVisible = window.scrollY > threshold;
                    navbar.classList.toggle('-translate-y-full', !isVisible);
                    navbar.classList.toggle('opacity-0', !isVisible);
                    navbar.classList.toggle('pointer-events-none', !isVisible);
                    navbar.classList.toggle('translate-y-0', isVisible);
                    navbar.classList.toggle('opacity-100', isVisible);
                    navbar.classList.toggle('pointer-events-auto', isVisible);
                };

                updateNavbar();
                window.addEventListener('scroll', updateNavbar, { passive: true });
            });
        </script>
    </body>
</html>
