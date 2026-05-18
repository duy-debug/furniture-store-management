<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
