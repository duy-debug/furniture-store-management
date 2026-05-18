<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $stats = [];

        // Thống kê đơn hàng
        if ($user->hasPermission('order.view')) {
            $stats['total_orders'] = Order::count();
            $stats['pending_orders'] = Order::where('status', 'pending')->count();
            $stats['processing_orders'] = Order::where('status', 'processing')->count();
            $stats['completed_orders'] = Order::where('status', 'completed')->count();
            $stats['revenue'] = Order::where('status', 'completed')->sum('total_amount');
        }

        // Thống kê sản phẩm
        if ($user->hasPermission('product.view')) {
            $stats['total_products'] = Product::count();
            $stats['low_stock_products'] = Product::whereColumn('stock_quantity', '<=', 'low_stock_threshold')
                ->where('status', 'active')
                ->count();
        }

        // Thống kê khách hàng
        if ($user->hasPermission('customer.view')) {
            $stats['total_customers'] = User::whereHas('roles', function ($q) {
                $q->where('code', 'customer');
            })->count();
        }

        // Thống kê yêu cầu thiết kế
        if ($user->hasPermission('design_request.view')) {
            $stats['total_design_requests'] = DesignRequest::count();
            $stats['new_design_requests'] = DesignRequest::where('status', 'new')->count();
        }

        // Đơn hàng mới nhất
        $recentOrders = null;
        if ($user->hasPermission('order.view')) {
            $recentOrders = Order::latest('placed_at')->take(5)->get();
        }

        // Sản phẩm sắp hết hàng
        $lowStockProducts = null;
        if ($user->hasPermission('product.view')) {
            $lowStockProducts = Product::whereColumn('stock_quantity', '<=', 'low_stock_threshold')
                ->where('status', 'active')
                ->orderBy('stock_quantity')
                ->take(5)
                ->get();
        }

        return view('admin.dashboard', compact('stats', 'recentOrders', 'lowStockProducts'));
    }
}
