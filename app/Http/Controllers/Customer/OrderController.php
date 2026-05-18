<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::query()
            ->where('user_id', $request->user()->id)
            ->latest('placed_at')
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order): View
    {
        if (!$request->user()->hasPermission('order.detail') && $order->user_id !== $request->user()->id) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        if ($order->user_id !== $request->user()->id && !$request->user()->hasPermission('order.detail')) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        $order->load([
            'items.product',
            'statusLogs.changedBy',
            'user',
        ]);

        return view('customer.orders.show', compact('order'));
    }
}
