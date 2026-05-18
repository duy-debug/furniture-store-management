<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Admin / Staff: Redirect to admin panel --}}
            @if(auth()->user()->hasRole(['admin', 'staff']))
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-2">Xin chào, {{ auth()->user()->name }}!</h3>
                        <p class="text-gray-600 mb-4">Bạn có quyền truy cập trang quản trị.</p>
                        <a href="{{ route('admin.dashboard') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Vào trang quản trị
                        </a>
                    </div>
                </div>
            @endif

            {{-- Customer: Show personal info --}}
            @if(auth()->user()->hasRole('customer'))
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-2">Xin chào, {{ auth()->user()->name }}!</h3>
                        <p class="text-gray-600">Chào mừng bạn đến với cửa hàng nội thất Thông Mai.</p>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="p-2 bg-blue-50 rounded-lg">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                                </div>
                                <h4 class="font-medium text-gray-900">Đơn hàng của tôi</h4>
                            </div>
                            <p class="text-sm text-gray-500 mb-3">Xem lịch sử và trạng thái đơn hàng.</p>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">Xem đơn hàng →</a>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="p-2 bg-green-50 rounded-lg">
                                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                                    </svg>
                                </div>
                                <h4 class="font-medium text-gray-900">Giỏ hàng</h4>
                            </div>
                            <p class="text-sm text-gray-500 mb-3">Xem và quản lý giỏ hàng của bạn.</p>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">Xem giỏ hàng →</a>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="p-2 bg-purple-50 rounded-lg">
                                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z"/>
                                    </svg>
                                </div>
                                <h4 class="font-medium text-gray-900">Yêu cầu thiết kế</h4>
                            </div>
                            <p class="text-sm text-gray-500 mb-3">Gửi yêu cầu tư vấn thiết kế nội thất.</p>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">Gửi yêu cầu →</a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Fallback for users without specific role --}}
            @if(!auth()->user()->hasRole(['admin', 'staff', 'customer']))
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p>Xin chào, {{ auth()->user()->name }}! Bạn đã đăng nhập thành công.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
