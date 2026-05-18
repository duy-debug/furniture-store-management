<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = Cart::query()
            ->where('user_id', $request->user()->id)
            ->where('status', 'active')
            ->with(['items' => fn ($query) => $query->orderBy('created_at')])
            ->first();

        return view('customer.cart.index', compact('cart'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $quantityToAdd = (int) ($data['quantity'] ?? 1);
        $user = $request->user();
        $errorMessage = null;

        $cart = DB::transaction(function () use ($user, $data, $quantityToAdd, &$errorMessage) {
            $product = Product::query()
                ->with('images')
                ->lockForUpdate()
                ->findOrFail($data['product_id']);

            if ($product->status !== 'active') {
                throw ValidationException::withMessages([
                    'product_id' => 'Sản phẩm này hiện không còn hiển thị.',
                ]);
            }

            if ($product->stock_quantity < 1) {
                throw ValidationException::withMessages([
                    'product_id' => 'Sản phẩm hiện đã hết hàng.',
                ]);
            }

            $cart = Cart::withTrashed()
                ->where('user_id', $user->id)
                ->lockForUpdate()
                ->first();

            if (!$cart) {
                $cart = new Cart([
                    'user_id' => $user->id,
                    'status' => 'active',
                    'item_count' => 0,
                    'subtotal' => 0,
                ]);
                $cart->save();
            } elseif ($cart->trashed()) {
                $cart->restore();
                $cart->status = 'active';
                $cart->checked_out_at = null;
                $cart->save();
            } elseif ($cart->status !== 'active') {
                $cart->status = 'active';
                $cart->checked_out_at = null;
                $cart->save();
            }

            $cartItem = CartItem::query()
                ->where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->lockForUpdate()
                ->first();

            $currentQuantity = $cartItem?->quantity ?? 0;
            $newQuantity = $currentQuantity + $quantityToAdd;

            if ($newQuantity > $product->stock_quantity) {
                $availableToAdd = max(0, (int) $product->stock_quantity - $currentQuantity);
                $errorMessage = $availableToAdd > 0
                    ? "Số lượng vượt tồn kho. Hiện bạn chỉ còn có thể thêm tối đa {$availableToAdd} sản phẩm."
                    : 'Sản phẩm này đã đạt số lượng tối đa theo tồn kho hiện tại.';
                return null;
            }

            $unitPrice = (float) $product->price;
            $lineTotal = round($unitPrice * $newQuantity, 2);
            $snapshotImagePath = $product->images->first()?->image_path;

            if ($cartItem) {
                $cartItem->update([
                    'product_name_snapshot' => $product->name,
                    'product_image_path_snapshot' => $snapshotImagePath,
                    'quantity' => $newQuantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $lineTotal,
                ]);
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'product_name_snapshot' => $product->name,
                    'product_image_path_snapshot' => $snapshotImagePath,
                    'quantity' => $newQuantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $lineTotal,
                ]);
            }

            $cart->syncTotals();

            return $cart->fresh(['items']);
        });

        if ($errorMessage) {
            return back()->with('error', $errorMessage);
        }

        return back()->with('success', "Đã cập nhật giỏ hàng. Tổng số lượng sản phẩm trong giỏ: {$cart->item_count}.");
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $data = $request->validate([
            'action' => ['required', 'in:increase,decrease'],
        ]);
        $overflowMessage = null;

        DB::transaction(function () use ($request, $cartItem, $data, &$overflowMessage): void {
            $cart = Cart::withTrashed()
                ->where('user_id', $request->user()->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($cartItem->cart_id !== $cart->id) {
                throw ValidationException::withMessages([
                    'cart_item' => 'Mục giỏ hàng không hợp lệ.',
                ]);
            }

            $product = Product::query()
                ->lockForUpdate()
                ->findOrFail($cartItem->product_id);

            if ($product->status !== 'active') {
                throw ValidationException::withMessages([
                    'product_id' => 'Sản phẩm này hiện không còn hiển thị.',
                ]);
            }

            $currentQuantity = (int) $cartItem->quantity;
            $newQuantity = $data['action'] === 'increase'
                ? $currentQuantity + 1
                : $currentQuantity - 1;

            if ($data['action'] === 'decrease' && $newQuantity < 1) {
                $cartItem->delete();
                $cart->syncTotals();

                return;
            }

            if ($newQuantity > $product->stock_quantity) {
                $availableToAdd = max(0, (int) $product->stock_quantity - $currentQuantity);
                $overflowMessage = $availableToAdd > 0
                    ? "Số lượng vượt tồn kho. Hiện bạn chỉ còn có thể thêm tối đa {$availableToAdd} sản phẩm."
                    : 'Sản phẩm này đã đạt số lượng tối đa theo tồn kho hiện tại.';
                return;
            }

            $cartItem->update([
                'quantity' => $newQuantity,
                'line_total' => round(((float) $cartItem->unit_price) * $newQuantity, 2),
            ]);

            $cart->syncTotals();
        });

        if ($overflowMessage) {
            return back()->with('error', $overflowMessage);
        }

        return back()->with('success', 'Đã cập nhật giỏ hàng.');
    }

    public function destroy(Request $request, CartItem $cartItem): RedirectResponse
    {
        DB::transaction(function () use ($request, $cartItem): void {
            $cart = Cart::withTrashed()
                ->where('user_id', $request->user()->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($cartItem->cart_id !== $cart->id) {
                throw ValidationException::withMessages([
                    'cart_item' => 'Mục giỏ hàng không hợp lệ.',
                ]);
            }

            $cartItem->delete();
            $cart->syncTotals();
        });

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function clear(Request $request): RedirectResponse
    {
        DB::transaction(function () use ($request): void {
            $cart = Cart::withTrashed()
                ->where('user_id', $request->user()->id)
                ->lockForUpdate()
                ->firstOrFail();

            $cart->items()->delete();
            $cart->syncTotals();
        });

        return back()->with('success', 'Đã làm trống giỏ hàng.');
    }
}
