<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Customer\DesignRequestController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $featuredProducts = \App\Models\Product::where('status', 'active')
        ->with(['category', 'images'])
        ->latest()
        ->take(8)
        ->get();

    $categories = \App\Models\Category::where('status', 'active')
        ->orderBy('sort_order')
        ->take(8)
        ->get();

    return view('welcome', compact('featuredProducts', 'categories'));
});

// Sản phẩm public
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/dashboard', function () {
    $user = auth()->user();

    // Admin/Staff → redirect về admin dashboard
    if ($user->hasRole(['admin', 'staff'])) {
        return redirect()->route('admin.dashboard');
    }

    // Customer → hiển thị customer dashboard
    return view('customer.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/items', [CartController::class, 'store'])->name('cart.items.store');
    Route::patch('/cart/items/{cartItem}', [CartController::class, 'update'])->name('cart.items.update');
    Route::delete('/cart/items/{cartItem}', [CartController::class, 'destroy'])->name('cart.items.destroy');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'permission:design_request.create'])->group(function () {
    Route::get('/design-requests/create', [DesignRequestController::class, 'create'])->name('design-requests.create');
    Route::post('/design-requests', [DesignRequestController::class, 'store'])->name('design-requests.store');
});

Route::middleware(['auth', 'permission:design_request.own_view'])->group(function () {
    Route::get('/design-requests', [DesignRequestController::class, 'index'])->name('design-requests.index');
});

Route::middleware(['auth', 'permission:design_request.own_detail,design_request.detail'])->group(function () {
    Route::get('/design-requests/{designRequest}', [DesignRequestController::class, 'show'])->name('design-requests.show');
});

Route::middleware(['auth', 'permission:order.create'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::middleware(['auth', 'permission:order.own_view'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

Route::middleware(['auth', 'permission:order.own_detail,order.detail'])->group(function () {
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

require __DIR__.'/auth.php';
