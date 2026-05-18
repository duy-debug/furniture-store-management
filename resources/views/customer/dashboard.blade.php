<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Xin chào, {{ auth()->user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Welcome --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <p class="text-gray-600">Chào mừng bạn đến với cửa hàng nội thất Thông Mai. Quản lý đơn hàng, giỏ hàng và yêu cầu thiết kế của bạn tại đây.</p>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="#" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-blue-50 rounded-lg">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                            </div>
                            <h4 class="font-medium text-gray-900">Đơn hàng của tôi</h4>
                        </div>
                        <p class="text-sm text-gray-500">Xem lịch sử và trạng thái đơn hàng.</p>
                    </div>
                </a>

                <a href="#" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-green-50 rounded-lg">
                                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                                </svg>
                            </div>
                            <h4 class="font-medium text-gray-900">Giỏ hàng</h4>
                        </div>
                        <p class="text-sm text-gray-500">Xem và quản lý giỏ hàng của bạn.</p>
                    </div>
                </a>

                <a href="#" class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2 bg-purple-50 rounded-lg">
                                <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z"/>
                                </svg>
                            </div>
                            <h4 class="font-medium text-gray-900">Yêu cầu thiết kế</h4>
                        </div>
                        <p class="text-sm text-gray-500">Gửi yêu cầu tư vấn thiết kế nội thất.</p>
                    </div>
                </a>
            </div>

            {{-- Sản phẩm --}}
            <div class="mt-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Xem sản phẩm</h3>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-500 text-sm">
                        Danh sách sản phẩm sẽ hiển thị ở đây khi hoàn thành Task 9.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
