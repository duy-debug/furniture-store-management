<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusLog;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::query()
            ->with('user')
            ->withCount('items')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim($request->string('search')->toString());

                $query->where(function ($inner) use ($search) {
                    $inner->where('order_code', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_phone', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('date_from'), fn ($query) => $query->whereDate('placed_at', '>=', $request->date('date_from')))
            ->when($request->filled('date_to'), fn ($query) => $query->whereDate('placed_at', '<=', $request->date('date_to')))
            ->latest('placed_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.orders.index', [
            'orders' => $orders,
            'statusLabels' => Order::STATUS_LABELS,
        ]);
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'items.product', 'statusLogs.changedBy']);

        return view('admin.orders.show', [
            'order' => $order,
            'statusLabels' => Order::STATUS_LABELS,
            'paymentMethodLabels' => Order::PAYMENT_METHOD_LABELS,
            'availableStatuses' => array_values(array_filter(
                Order::ADMIN_STATUS_FLOW[$order->status] ?? [],
                fn ($status) => $status !== 'cancelled'
            )),
        ]);
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in(['processing', 'preparing', 'shipping', 'completed', 'returned'])],
            'note' => ['nullable', 'string', 'max:2000'],
        ]);

        $user = $request->user();

        DB::transaction(function () use ($validated, $user, $order) {
            $order = Order::query()
                ->with('items')
                ->lockForUpdate()
                ->findOrFail($order->id);

            if (in_array($order->status, ['completed', 'cancelled', 'returned'], true)) {
                throw ValidationException::withMessages([
                    'status' => 'Đơn hàng đã kết thúc nên không thể cập nhật trạng thái.',
                ]);
            }

            $allowedStatuses = Order::ADMIN_STATUS_FLOW[$order->status] ?? [];
            $allowedStatuses = array_values(array_filter($allowedStatuses, fn ($status) => $status !== 'cancelled'));
            if (!in_array($validated['status'], $allowedStatuses, true)) {
                throw ValidationException::withMessages([
                    'status' => 'Trạng thái mới không hợp lệ theo luồng xử lý hiện tại.',
                ]);
            }

            $fromStatus = $order->status;
            $toStatus = $validated['status'];

            if ($fromStatus === 'pending' && $toStatus === 'processing') {
                $this->deductStockForOrder($order);
                $order->processed_at = now();
            }

            if ($toStatus === 'returned') {
                $this->restoreStockForOrder($order);
            }

            if ($toStatus === 'completed') {
                $order->completed_at = now();
            }

            if ($toStatus === 'cancelled') {
                $order->cancelled_at = now();
            }

            $order->status = $toStatus;
            $order->save();

            OrderStatusLog::create([
                'order_id' => $order->id,
                'changed_by' => $user->id,
                'from_status' => $fromStatus,
                'to_status' => $toStatus,
                'note' => $validated['note'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Đã cập nhật trạng thái đơn hàng thành công.');
    }

    public function cancel(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'cancel_reason' => ['required', 'string', 'max:2000'],
        ]);

        $user = $request->user();

        DB::transaction(function () use ($validated, $user, $order) {
            $order = Order::query()
                ->with('items')
                ->lockForUpdate()
                ->findOrFail($order->id);

            if ($order->status === 'completed') {
                throw ValidationException::withMessages([
                    'cancel_reason' => 'Không thể hủy đơn hàng đã hoàn thành.',
                ]);
            }

            if (in_array($order->status, ['cancelled', 'returned'], true)) {
                throw ValidationException::withMessages([
                    'cancel_reason' => 'Đơn hàng này đã được xử lý hủy hoặc hoàn trả trước đó.',
                ]);
            }

            $fromStatus = $order->status;
            $stockRestored = false;

            if (in_array($order->status, ['processing', 'preparing', 'shipping'], true)) {
                $this->restoreStockForOrder($order);
                $stockRestored = true;
            }

            $order->status = 'cancelled';
            $order->cancel_reason = $validated['cancel_reason'];
            $order->cancelled_at = now();
            $order->save();

            OrderStatusLog::create([
                'order_id' => $order->id,
                'changed_by' => $user->id,
                'from_status' => $fromStatus,
                'to_status' => 'cancelled',
                'note' => $stockRestored ? 'Đã hủy và cộng lại tồn kho.' : 'Đã hủy khi đơn chưa trừ tồn kho.',
                'reason' => $validated['cancel_reason'],
            ]);
        });

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Đã hủy đơn hàng thành công.');
    }

    private function deductStockForOrder(Order $order): void
    {
        foreach ($order->items as $item) {
            $product = Product::query()
                ->lockForUpdate()
                ->findOrFail($item->product_id);

            if ($product->status !== 'active') {
                throw ValidationException::withMessages([
                    'status' => "Sản phẩm \"{$item->product_name_snapshot}\" không còn khả dụng để trừ kho.",
                ]);
            }

            if ($product->stock_quantity < $item->quantity) {
                throw ValidationException::withMessages([
                    'status' => "Sản phẩm \"{$product->name}\" chỉ còn {$product->stock_quantity} trong kho.",
                ]);
            }

            $product->stock_quantity -= $item->quantity;
            $product->save();
        }
    }

    private function restoreStockForOrder(Order $order): void
    {
        foreach ($order->items as $item) {
            if (!$item->product_id) {
                continue;
            }

            $product = Product::query()
                ->lockForUpdate()
                ->find($item->product_id);

            if (!$product) {
                continue;
            }

            $product->stock_quantity += $item->quantity;
            $product->save();
        }
    }
}
