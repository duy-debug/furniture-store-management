<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-medium text-indigo-600">Customer area</p>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Xin chào, {{ auth()->user()->name }}!
                </h2>
            </div>

            <a href="{{ route('cart.index') }}"
               class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                Xem giỏ hàng
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-900 text-white shadow-xl">
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute -top-24 right-0 h-72 w-72 rounded-full bg-indigo-400 blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-emerald-400 blur-3xl"></div>
                </div>

                <div class="relative grid gap-8 p-8 lg:grid-cols-[1.3fr,0.7fr] lg:p-10">
                    <div>
                        <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-indigo-100">
                            Dashboard khách hàng
                        </span>
                        <h1 class="mt-5 max-w-2xl text-3xl font-bold tracking-tight sm:text-4xl">
                            Quản lý giỏ hàng, mua sắm và theo dõi trải nghiệm của bạn tại Thông Mai.
                        </h1>
                        <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-200 sm:text-base">
                            Từ đây bạn có thể xem sản phẩm, mở giỏ hàng và tiếp tục hành trình mua sắm chỉ trong vài cú nhấp.
                        </p>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('products.index') }}"
                               class="inline-flex items-center rounded-md bg-white px-4 py-2.5 text-sm font-semibold text-slate-900 hover:bg-slate-100 transition">
                                Khám phá sản phẩm
                            </a>
                            <a href="{{ route('cart.index') }}"
                               class="inline-flex items-center rounded-md border border-white/20 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white hover:bg-white/15 transition">
                                Đi tới giỏ hàng
                            </a>
                        </div>
                    </div>

                    <div class="grid gap-4">
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                            <p class="text-sm text-slate-200">Trạng thái tài khoản</p>
                            <p class="mt-2 text-xl font-semibold">
                                {{ auth()->user()->status === 'active' ? 'Đang hoạt động' : 'Đang bị khóa' }}
                            </p>
                            <p class="mt-2 text-sm text-slate-300">
                                Bạn có thể cập nhật thông tin cá nhân trong hồ sơ.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                            <p class="text-sm text-slate-200">Lối tắt nhanh</p>
                            <div class="mt-3 grid gap-3">
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 text-sm font-medium text-white hover:bg-white/15 transition">
                                    <span>Hồ sơ cá nhân</span>
                                    <span>→</span>
                                </a>
                                <a href="{{ route('cart.index') }}"
                                   class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 text-sm font-medium text-white hover:bg-white/15 transition">
                                    <span>Giỏ hàng của tôi</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <a href="{{ route('products.index') }}"
                   class="group rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="mb-4 inline-flex rounded-2xl bg-amber-50 p-3 text-amber-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Khám phá sản phẩm</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Tìm kiếm, lọc và chọn sản phẩm nội thất phù hợp cho không gian của bạn.
                    </p>
                    <p class="mt-4 text-sm font-semibold text-indigo-600 group-hover:text-indigo-700">
                        Mở danh sách sản phẩm →
                    </p>
                </a>

                <a href="{{ route('cart.index') }}"
                   class="group rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="mb-4 inline-flex rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Giỏ hàng của tôi</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Xem sản phẩm đã chọn, điều chỉnh số lượng và sẵn sàng thanh toán.
                    </p>
                    <p class="mt-4 text-sm font-semibold text-indigo-600 group-hover:text-indigo-700">
                        Đi tới giỏ hàng →
                    </p>
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="group rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="mb-4 inline-flex rounded-2xl bg-violet-50 p-3 text-violet-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 019 16h6a4 4 0 013.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Hồ sơ cá nhân</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Cập nhật thông tin liên hệ để đặt hàng và nhận hỗ trợ thuận tiện hơn.
                    </p>
                    <p class="mt-4 text-sm font-semibold text-indigo-600 group-hover:text-indigo-700">
                        Chỉnh sửa hồ sơ →
                    </p>
                </a>
            </div>

            <div class="grid gap-6 lg:grid-cols-[1.2fr,0.8fr]">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Mở đầu nhanh</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Từ đây bạn có thể tiếp tục thao tác với những chức năng chính của khách hàng.
                            </p>
                        </div>
                        <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                            Customer
                        </span>
                    </div>

                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-sm font-medium text-gray-900">1. Chọn sản phẩm</p>
                            <p class="mt-1 text-sm text-gray-500">Duyệt danh sách sản phẩm nội thất và thêm vào giỏ.</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-sm font-medium text-gray-900">2. Chỉnh giỏ hàng</p>
                            <p class="mt-1 text-sm text-gray-500">Tăng, giảm số lượng hoặc xóa sản phẩm khi cần.</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-sm font-medium text-gray-900">3. Cập nhật hồ sơ</p>
                            <p class="mt-1 text-sm text-gray-500">Giữ thông tin liên hệ luôn chính xác để đặt hàng thuận lợi.</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-sm font-medium text-gray-900">4. Thanh toán</p>
                            <p class="mt-1 text-sm text-gray-500">Sẵn sàng chuyển sang bước đặt hàng khi bạn hoàn tất giỏ.</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-slate-900 p-6 text-white shadow-sm">
                    <h3 class="text-lg font-semibold">Gợi ý sử dụng</h3>
                    <ul class="mt-4 space-y-4 text-sm text-slate-300">
                        <li class="flex gap-3">
                            <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-white/10 text-xs font-bold text-white">1</span>
                            Vào trang sản phẩm để xem chi tiết, hình ảnh và giá bán.
                        </li>
                        <li class="flex gap-3">
                            <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-white/10 text-xs font-bold text-white">2</span>
                            Dùng giỏ hàng để điều chỉnh số lượng trước khi thanh toán.
                        </li>
                        <li class="flex gap-3">
                            <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-white/10 text-xs font-bold text-white">3</span>
                            Cập nhật hồ sơ để giữ thông tin đặt hàng luôn chính xác.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
