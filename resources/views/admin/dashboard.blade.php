<x-admin-layout>
    <x-slot name="header">Dashboard</x-slot>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        @if(isset($stats['total_orders']))
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-blue-50 rounded-lg">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Tổng đơn hàng</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_orders']) }}</p>
                </div>
            </div>
        </div>
        @endif

        @if(isset($stats['pending_orders']))
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-yellow-50 rounded-lg">
                    <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Đơn chờ xác nhận</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['pending_orders']) }}</p>
                </div>
            </div>
        </div>
        @endif

        @if(isset($stats['revenue']))
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-green-50 rounded-lg">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Doanh thu</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['revenue'], 0, ',', '.') }}đ</p>
                </div>
            </div>
        </div>
        @endif

        @if(isset($stats['low_stock_products']))
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-red-50 rounded-lg">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">SP sắp hết hàng</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['low_stock_products']) }}</p>
                </div>
            </div>
        </div>
        @endif

        @if(isset($stats['total_customers']))
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-purple-50 rounded-lg">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Khách hàng</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['total_customers']) }}</p>
                </div>
            </div>
        </div>
        @endif

        @if(isset($stats['new_design_requests']))
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-3 bg-indigo-50 rounded-lg">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">YC thiết kế mới</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['new_design_requests']) }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Đơn hàng mới nhất --}}
        @if($recentOrders)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-sm font-semibold text-gray-900">Đơn hàng mới nhất</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($recentOrders as $order)
                <div class="px-6 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $order->order_code }}</p>
                        <p class="text-xs text-gray-500">{{ $order->customer_name }} · {{ $order->placed_at?->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">{{ number_format($order->total_amount, 0, ',', '.') }}đ</p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                            @switch($order->status)
                                @case('pending') bg-yellow-100 text-yellow-800 @break
                                @case('processing') bg-blue-100 text-blue-800 @break
                                @case('preparing') bg-indigo-100 text-indigo-800 @break
                                @case('shipping') bg-purple-100 text-purple-800 @break
                                @case('completed') bg-green-100 text-green-800 @break
                                @case('cancelled') bg-red-100 text-red-800 @break
                                @default bg-gray-100 text-gray-800
                            @endswitch
                        ">
                            @switch($order->status)
                                @case('pending') Chờ xác nhận @break
                                @case('processing') Đang xử lý @break
                                @case('preparing') Đang chuẩn bị @break
                                @case('shipping') Đang giao @break
                                @case('completed') Hoàn thành @break
                                @case('cancelled') Đã hủy @break
                                @case('returned') Đổi/trả @break
                                @default {{ $order->status }}
                            @endswitch
                        </span>
                    </div>
                </div>
                @empty
                <div class="px-6 py-4 text-sm text-gray-500 text-center">Chưa có đơn hàng nào.</div>
                @endforelse
            </div>
        </div>
        @endif

        {{-- Sản phẩm sắp hết hàng --}}
        @if($lowStockProducts)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-sm font-semibold text-gray-900">Sản phẩm sắp hết hàng</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($lowStockProducts as $product)
                <div class="px-6 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
                        <p class="text-xs text-gray-500">Mã: {{ $product->product_code }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                            Còn {{ $product->stock_quantity }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="px-6 py-4 text-sm text-gray-500 text-center">Không có sản phẩm nào sắp hết hàng.</div>
                @endforelse
            </div>
        </div>
        @endif
    </div>
</x-admin-layout>
