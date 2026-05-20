<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-50">
        <x-toast-notification />

        <div class="relative min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(44,127,184,0.18),_transparent_30%),radial-gradient(circle_at_top_right,_rgba(160,210,235,0.22),_transparent_26%),linear-gradient(180deg,_#eff6fb_0%,_#f8fbfe_42%,_#f8fafc_100%)]">
            <div class="absolute inset-0 opacity-[0.16] [background-image:linear-gradient(rgba(44,127,184,0.12)_1px,transparent_1px),linear-gradient(90deg,rgba(44,127,184,0.12)_1px,transparent_1px)] [background-size:36px_36px]"></div>

            <div class="relative mx-auto flex min-h-screen max-w-7xl items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
                <div class="grid w-full items-stretch gap-8 lg:grid-cols-[1.05fr,0.95fr]">
                    <div class="flex flex-col justify-between rounded-[2rem] border border-primary/15 bg-gradient-to-br from-primary via-primary to-secondary p-8 text-white shadow-2xl shadow-primary/10 backdrop-blur-xl sm:p-10">
                        <div class="flex items-center gap-3">
                            <a href="/" class="inline-flex items-center gap-3">
                                <img src="{{ asset('images/logothongmai.jpg') }}" alt="Thông Mai" class="h-14 w-14 rounded-2xl object-cover ring-1 ring-white/25">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-accent">Thông Mai</p>
                                    <h1 class="mt-1 text-2xl font-semibold text-white">Nội Thất Hiện Đại</h1>
                                </div>
                            </a>
                        </div>

                        <div class="mt-10 max-w-xl">
                            <p class="text-sm font-medium uppercase tracking-[0.3em] text-accent">Customer Portal</p>
                            <h2 class="mt-4 text-4xl font-semibold leading-tight text-white sm:text-5xl">
                                Đăng nhập để quản lý đơn hàng, giỏ hàng và yêu cầu thiết kế.
                            </h2>
                            <p class="mt-5 max-w-lg text-base leading-7 text-slate-200">
                                Hệ thống hỗ trợ khách hàng theo dõi đơn hàng, gửi yêu cầu thiết kế nội thất và trải nghiệm mua sắm đồng bộ trên một giao diện duy nhất.
                            </p>
                        </div>

                        <div class="mt-10 grid gap-3 sm:grid-cols-3">
                            <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-300">Sản phẩm</p>
                                <p class="mt-2 text-sm text-white/90">Khám phá danh mục nội thất phong phú</p>
                            </div>
                            <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-300">Đơn hàng</p>
                                <p class="mt-2 text-sm text-white/90">Theo dõi trạng thái đơn theo thời gian thực</p>
                            </div>
                            <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-300">Thiết kế</p>
                                <p class="mt-2 text-sm text-white/90">Gửi yêu cầu thiết kế nội thất nhanh chóng</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-center">
                        <div class="w-full max-w-xl rounded-[2rem] border border-slate-200/80 bg-white p-6 shadow-[0_24px_80px_rgba(44,127,184,0.18)] sm:p-8">
                            <div class="mb-6 flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-primary">Chào mừng trở lại</p>
                                    <p class="mt-1 text-2xl font-semibold text-gray-900">Đăng nhập tài khoản</p>
                                </div>
                                <a href="/" class="inline-flex items-center gap-2 rounded-full bg-accent/30 px-3 py-2 text-xs font-semibold text-primary hover:bg-accent/50">
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l6 6A1 1 0 0116 10h-1v6a1 1 0 01-1 1h-3a1 1 0 01-1-1v-4H10v4a1 1 0 01-1 1H6a1 1 0 01-1-1v-6H4a1 1 0 01-.707-1.707l6-6z" clip-rule="evenodd" />
                                    </svg>
                                    Trang chủ
                                </a>
                            </div>

                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
