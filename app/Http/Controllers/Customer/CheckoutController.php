<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusLog;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(Request $request): View
    {
        $cart = Cart::query()
            ->where('user_id', $request->user()->id)
            ->where('status', 'active')
            ->with(['items' => fn ($query) => $query->orderBy('created_at')])
            ->first();

        return view('customer.checkout.index', compact('cart'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'shipping_address' => ['required', 'string', 'max:2000'],
            'shipping_note' => ['nullable', 'string', 'max:2000'],
            'payment_method' => ['required', 'in:cod,bank_transfer'],
        ]);

        $user = $request->user();

        $order = DB::transaction(function () use ($user, $validated) {
            $cart = Cart::query()
                ->where('user_id', $user->id)
                ->where('status', 'active')
                ->with(['items'])
                ->lockForUpdate()
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                throw ValidationException::withMessages([
                    'cart' => 'Giỏ hàng không được rỗng.',
                ]);
            }

            $cartItems = $cart->items;
            $cartItems->loadMissing('product');

            foreach ($cartItems as $cartItem) {
                if ((int) $cartItem->quantity < 1) {
                    throw ValidationException::withMessages([
                        'quantity' => "Số lượng của sản phẩm \"{$cartItem->product_name_snapshot}\" không hợp lệ.",
                    ]);
                }

                $product = Product::query()
                    ->with('images')
                    ->lockForUpdate()
                    ->find($cartItem->product_id);

                if (!$product || $product->status !== 'active') {
                    throw ValidationException::withMessages([
                        'product_id' => "Sản phẩm \"{$cartItem->product_name_snapshot}\" hiện không còn khả dụng để đặt hàng.",
                    ]);
                }

                if ($cartItem->quantity > $product->stock_quantity) {
                    throw ValidationException::withMessages([
                        'quantity' => "Sản phẩm \"{$product->name}\" chỉ còn {$product->stock_quantity} trong kho.",
                    ]);
                }
            }

            $subtotal = round((float) $cartItems->sum('line_total'), 2);
            $orderCode = $this->generateOrderCode();

            $order = Order::create([
                'user_id' => $user->id,
                'order_code' => $orderCode,
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'] ?? null,
                'shipping_address' => $validated['shipping_address'],
                'shipping_note' => $validated['shipping_note'] ?? null,
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'unpaid',
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax_amount' => 0,
                'shipping_fee' => 0,
                'discount_amount' => 0,
                'total_amount' => $subtotal,
                'placed_at' => now(),
            ]);

            foreach ($cartItems as $cartItem) {
                $product = Product::query()
                    ->with('images')
                    ->lockForUpdate()
                    ->findOrFail($cartItem->product_id);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_code_snapshot' => $product->product_code,
                    'product_name_snapshot' => $product->name,
                    'product_image_path_snapshot' => $product->images->first()?->image_path ?? $cartItem->product_image_path_snapshot,
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $cartItem->unit_price,
                    'line_total' => $cartItem->line_total,
                ]);
            }

            OrderStatusLog::create([
                'order_id' => $order->id,
                'changed_by' => $user->id,
                'from_status' => null,
                'to_status' => 'pending',
                'note' => 'Đơn hàng được tạo từ checkout.',
            ]);

            $cart->items()->delete();
            $cart->status = 'converted';
            $cart->checked_out_at = now();
            $cart->save();
            $cart->delete();

            return $order;
        });

        return redirect()
            ->route('orders.show', $order)
            ->with('success', "Đặt hàng thành công. Mã đơn hàng: {$order->order_code}");
    }

    private function generateOrderCode(): string
    {
        do {
            $code = 'ORD-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));
        } while (Order::where('order_code', $code)->exists());

        return $code;
    }
}
