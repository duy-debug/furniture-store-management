<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lịch sử đơn hàng
            </h2>
            <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-md bg-primary px-4 py-2 text-sm font-semibold text-white hover:bg-primary/90">
                Tiếp tục mua sắm
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                @if($orders->isEmpty())
                    <div class="p-8 text-center">
                        <h3 class="text-lg font-semibold text-gray-900">Bạn chưa có đơn hàng nào</h3>
                        <p class="mt-2 text-sm text-gray-500">Khi bạn đặt hàng thành công, các đơn sẽ xuất hiện ở đây.</p>
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-md bg-primary px-4 py-2 text-sm font-semibold text-white hover:bg-primary/90">
                                Xem sản phẩm
                            </a>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Mã đơn</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Ngày đặt</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Tổng tiền</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Trạng thái</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $order->order_code }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $order->placed_at?->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ number_format($order->total_amount, 0, ',', '.') }}đ</td>
                                        <td class="px-6 py-4 text-sm">
                                            <span @class([
                                                'inline-flex rounded-full px-3 py-1 text-xs font-semibold',
                                                'bg-yellow-50 text-yellow-700' => $order->status === 'pending',
                                                'bg-blue-50 text-blue-700' => $order->status === 'processing',
                                                'bg-primary/10 text-primary' => $order->status === 'preparing',
                                                'bg-sky-50 text-sky-700' => $order->status === 'shipping',
                                                'bg-green-50 text-green-700' => $order->status === 'completed',
                                                'bg-red-50 text-red-700' => $order->status === 'cancelled',
                                                'bg-rose-50 text-rose-700' => $order->status === 'returned',
                                            ])>
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('orders.show', $order) }}" class="text-sm font-medium text-primary hover:text-primary/90">
                                                Xem chi tiết
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="border-t border-gray-200 px-6 py-4">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
