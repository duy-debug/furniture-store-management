<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-indigo-600">Customer space</p>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Xin chào, {{ auth()->user()->name }}!
                </h2>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('orders.index') }}"
                   class="inline-flex items-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Lịch sử đơn hàng
                </a>
                <a href="{{ route('design-requests.create') }}"
                   class="inline-flex items-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Gửi yêu cầu thiết kế
                </a>
                <a href="{{ route('cart.index') }}"
                   class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                    Xem giỏ hàng
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-slate-950 via-slate-900 to-indigo-950 text-white shadow-2xl">
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute -top-20 right-0 h-72 w-72 rounded-full bg-indigo-500 blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 h-80 w-80 rounded-full bg-emerald-400 blur-3xl"></div>
                </div>

                <div class="relative grid gap-8 p-8 lg:grid-cols-[1.25fr,0.75fr] lg:p-10">
                    <div>
                        <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.28em] text-indigo-100">
                            Khách hàng
                        </span>
                        <h1 class="mt-5 max-w-2xl text-3xl font-bold tracking-tight sm:text-5xl">
                            Quản lý mua sắm, giỏ hàng và đơn hàng của bạn trong một không gian gọn gàng.
                        </h1>
                        <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-200 sm:text-base">
                            Từ đây bạn có thể khám phá sản phẩm, thêm vào giỏ, đặt hàng, theo dõi lịch sử đơn và cập nhật hồ sơ cá nhân.
                        </p>

                        <div class="mt-7 flex flex-wrap gap-3">
                            <a href="{{ route('products.index') }}"
                               class="inline-flex items-center rounded-md bg-white px-4 py-2.5 text-sm font-semibold text-slate-900 hover:bg-slate-100 transition">
                                Khám phá sản phẩm
                            </a>
                            <a href="{{ route('design-requests.create') }}"
                               class="inline-flex items-center rounded-md border border-white/15 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white hover:bg-white/15 transition">
                                Gửi yêu cầu thiết kế
                            </a>
                            <a href="{{ route('checkout.index') }}"
                               class="inline-flex items-center rounded-md border border-white/15 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white hover:bg-white/15 transition">
                                Thanh toán
                            </a>
                            <a href="{{ route('profile.edit') }}"
                               class="inline-flex items-center rounded-md border border-white/15 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white hover:bg-white/15 transition">
                                Cập nhật hồ sơ
                            </a>
                        </div>
                    </div>

                    <div class="grid gap-4">
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-sm text-slate-200">Trạng thái tài khoản</p>
                                    <p class="mt-2 text-2xl font-semibold">
                                        {{ auth()->user()->status === 'active' ? 'Đang hoạt động' : 'Đang bị khóa' }}
                                    </p>
                                </div>
                                <div class="rounded-2xl bg-white/10 p-3">
                                    <svg class="h-6 w-6 text-indigo-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-4 text-sm leading-6 text-slate-300">
                                Thông tin cá nhân dùng để đặt hàng và nhận hỗ trợ sẽ được lấy từ hồ sơ của bạn.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                            <p class="text-sm text-slate-200">Truy cập nhanh</p>
                            <div class="mt-3 grid gap-2">
                                <a href="{{ route('cart.index') }}"
                                   class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 text-sm font-medium text-white hover:bg-white/15 transition">
                                    <span>Giỏ hàng của tôi</span>
                                    <span>→</span>
                                </a>
                                <a href="{{ route('orders.index') }}"
                                   class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 text-sm font-medium text-white hover:bg-white/15 transition">
                                    <span>Đơn hàng của tôi</span>
                                    <span>→</span>
                                </a>
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center justify-between rounded-xl bg-white/10 px-4 py-3 text-sm font-medium text-white hover:bg-white/15 transition">
                                    <span>Hồ sơ cá nhân</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-5">
                <a href="{{ route('products.index') }}"
                   class="group rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="inline-flex rounded-2xl bg-amber-50 p-3 text-amber-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">Sản phẩm</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Xem danh sách sản phẩm, lọc theo nhu cầu và chọn món phù hợp không gian sống.
                    </p>
                    <p class="mt-4 text-sm font-semibold text-indigo-600 group-hover:text-indigo-700">
                        Xem ngay →
                    </p>
                </a>

                <a href="{{ route('cart.index') }}"
                   class="group rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="inline-flex rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">Giỏ hàng</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Điều chỉnh số lượng, xóa sản phẩm và chuyển sang thanh toán khi sẵn sàng.
                    </p>
                    <p class="mt-4 text-sm font-semibold text-indigo-600 group-hover:text-indigo-700">
                        Mở giỏ hàng →
                    </p>
                </a>

                <a href="{{ route('orders.index') }}"
                   class="group rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="inline-flex rounded-2xl bg-sky-50 p-3 text-sky-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6m-7 4h8m-9 4h10M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">Đơn hàng</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Theo dõi lịch sử đơn, trạng thái và xem lại chi tiết từng lần mua.
                    </p>
                    <p class="mt-4 text-sm font-semibold text-indigo-600 group-hover:text-indigo-700">
                        Xem lịch sử →
                    </p>
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="group rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="inline-flex rounded-2xl bg-violet-50 p-3 text-violet-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 019 16h6a4 4 0 013.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">Hồ sơ cá nhân</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Cập nhật tên, số điện thoại và thông tin liên hệ để đặt hàng thuận tiện hơn.
                    </p>
                    <p class="mt-4 text-sm font-semibold text-indigo-600 group-hover:text-indigo-700">
                        Chỉnh sửa hồ sơ →
                    </p>
                </a>

                <a href="{{ route('design-requests.create') }}"
                   class="group rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="inline-flex rounded-2xl bg-pink-50 p-3 text-pink-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m4-4H8m4 8a8 8 0 100-16 8 8 0 000 16z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">Thiết kế nội thất</h3>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Gửi yêu cầu thiết kế cho không gian của bạn và theo dõi tiến độ ngay trong hệ thống.
                    </p>
                    <p class="mt-4 text-sm font-semibold text-indigo-600 group-hover:text-indigo-700">
                        Tạo yêu cầu →
                    </p>
                </a>
            </div>

            <div class="grid gap-6 lg:grid-cols-[1.15fr,0.85fr]">
                <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Lộ trình nhanh</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Đây là các bước chính mà khách hàng thường dùng trong hệ thống.
                            </p>
                        </div>
                        <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                            Customer
                        </span>
                    </div>

                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-sm font-medium text-gray-900">Khám phá sản phẩm</p>
                            <p class="mt-1 text-sm text-gray-500">Tìm món phù hợp, xem chi tiết và thêm vào giỏ.</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-sm font-medium text-gray-900">Kiểm tra giỏ hàng</p>
                            <p class="mt-1 text-sm text-gray-500">Tăng, giảm hoặc xoá sản phẩm trước khi thanh toán.</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-sm font-medium text-gray-900">Đặt hàng</p>
                            <p class="mt-1 text-sm text-gray-500">Chọn phương thức thanh toán và gửi đơn hàng.</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-sm font-medium text-gray-900">Theo dõi đơn</p>
                            <p class="mt-1 text-sm text-gray-500">Xem lịch sử, chi tiết và trạng thái đơn của bạn.</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-2xl bg-slate-900 p-6 text-white shadow-sm">
                        <h3 class="text-lg font-semibold">Yêu cầu thiết kế</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-300">
                            Theo tài liệu chức năng, khách hàng còn có thể gửi yêu cầu thiết kế nội thất và xem lại các yêu cầu của mình.
                        </p>
                        <div class="mt-5 rounded-2xl border border-white/10 bg-white/10 p-4">
                            <p class="text-sm font-medium text-white">Thiết kế nội thất</p>
                            <p class="mt-1 text-sm text-slate-300">
                                Bạn có thể gửi yêu cầu thiết kế theo đúng nhu cầu của từng không gian và xem lại toàn bộ yêu cầu đã gửi.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <a href="{{ route('design-requests.create') }}"
                                   class="inline-flex items-center rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-slate-900 hover:bg-slate-100">
                                    Gửi yêu cầu
                                </a>
                                <a href="{{ route('design-requests.index') }}"
                                   class="inline-flex items-center rounded-full border border-white/15 px-3 py-1.5 text-xs font-semibold text-white hover:bg-white/10">
                                    Xem yêu cầu của tôi
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Gợi ý thao tác</h3>
                        <ul class="mt-4 space-y-3 text-sm text-gray-600">
                            <li class="flex gap-3">
                                <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-700">1</span>
                                Bắt đầu bằng việc khám phá sản phẩm phù hợp.
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-700">2</span>
                                Quản lý giỏ hàng trước khi sang bước thanh toán.
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-700">3</span>
                                Theo dõi đơn hàng ngay sau khi đặt xong.
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-0.5 inline-flex h-6 w-6 flex-none items-center justify-center rounded-full bg-indigo-50 text-xs font-bold text-indigo-700">4</span>
                                Cập nhật hồ sơ để thông tin nhận hàng luôn chính xác.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
