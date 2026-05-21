<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DesignRequestController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Tất cả route trong file này đều có prefix 'admin' và middleware 'auth'.
| Mỗi route kiểm tra quyền cụ thể thông qua middleware 'permission'.
|
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin', 'account.active'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::middleware('permission:role.view')->group(function () {
        Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    });

    Route::middleware('permission:role.create')->group(function () {
        Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    });

    Route::middleware('permission:role.update')->group(function () {
        Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    });

    Route::middleware('permission:role.delete')->group(function () {
        Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    Route::middleware('permission:permission.assign')->group(function () {
        Route::get('roles/{role}/permissions', [PermissionController::class, 'edit'])->name('roles.permissions.edit');
        Route::put('roles/{role}/permissions', [PermissionController::class, 'update'])->name('roles.permissions.update');
    });

    Route::middleware('permission:user.view')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
    });

    Route::middleware('permission:user.create')->group(function () {
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
    });

    Route::middleware('permission:user.update')->group(function () {
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->whereNumber('user')->withTrashed()->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->whereNumber('user')->withTrashed()->name('users.update');
    });

    Route::middleware('permission:user.lock')->group(function () {
        Route::patch('users/{user}/status', [UserController::class, 'toggleLock'])->whereNumber('user')->withTrashed()->name('users.status');
    });

    Route::middleware('permission:customer.view')->group(function () {
        Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
    });

    Route::middleware('permission:customer.detail')->group(function () {
        Route::get('customers/{customer}', [CustomerController::class, 'show'])->whereNumber('customer')->name('customers.show');
    });

    Route::middleware('permission:customer.lock')->group(function () {
        Route::patch('customers/{customer}/status', [CustomerController::class, 'updateStatus'])->whereNumber('customer')->name('customers.status');
    });

    Route::middleware('permission:category.view')->group(function () {
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    });

    Route::middleware('permission:category.create')->group(function () {
        Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    });

    Route::middleware('permission:category.update')->group(function () {
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->withTrashed()->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->withTrashed()->name('categories.update');
    });

    Route::middleware('permission:category.delete')->group(function () {
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->withTrashed()->name('categories.destroy');
        Route::patch('categories/{category}/restore', [CategoryController::class, 'restore'])->withTrashed()->name('categories.restore');
    });

    Route::middleware('permission:product.view')->group(function () {
        Route::get('products', [ProductController::class, 'index'])->name('products.index');
        Route::get('products/{product}', [ProductController::class, 'show'])->whereNumber('product')->withTrashed()->name('products.show');
    });

    Route::middleware('permission:product.create')->group(function () {
        Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('products', [ProductController::class, 'store'])->name('products.store');
    });

    Route::middleware('permission:product.update')->group(function () {
        Route::get('products/{product}/edit', [ProductController::class, 'edit'])->whereNumber('product')->withTrashed()->name('products.edit');
        Route::put('products/{product}', [ProductController::class, 'update'])->whereNumber('product')->withTrashed()->name('products.update');
    });

    Route::middleware('permission:product.delete')->group(function () {
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->whereNumber('product')->withTrashed()->name('products.destroy');
        Route::patch('products/{product}/restore', [ProductController::class, 'restore'])->whereNumber('product')->withTrashed()->name('products.restore');
    });

    Route::middleware('permission:product.manage_image')->group(function () {
        Route::get('products/{product}/images', [ProductController::class, 'images'])->whereNumber('product')->withTrashed()->name('products.images');
        Route::post('products/{product}/images', [ProductController::class, 'storeImages'])->whereNumber('product')->withTrashed()->name('products.images.store');
        Route::patch('products/{product}/images/{image}/primary', [ProductController::class, 'setPrimaryImage'])->whereNumber('product')->whereNumber('image')->withTrashed()->name('products.images.primary');
        Route::delete('products/{product}/images/{image}', [ProductController::class, 'destroyImage'])->whereNumber('product')->whereNumber('image')->withTrashed()->name('products.images.destroy');
    });

    Route::middleware('permission:order.view')->group(function () {
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [OrderController::class, 'show'])->whereNumber('order')->name('orders.show');
        Route::get('orders/{order}/invoice', [OrderController::class, 'invoice'])->whereNumber('order')->name('orders.invoice');
    });

    Route::middleware('permission:order.update_status')->group(function () {
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status.update');
    });

    Route::middleware('permission:order.cancel')->group(function () {
        Route::patch('orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    });

    Route::middleware('admin.only')->group(function () {
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    });

    Route::middleware('permission:design_request.view')->group(function () {
        Route::get('design-requests', [DesignRequestController::class, 'index'])->name('design-requests.index');
    });

    Route::middleware('permission:design_request.detail')->group(function () {
        Route::get('design-requests/{designRequest}', [DesignRequestController::class, 'show'])->whereNumber('designRequest')->withTrashed()->name('design-requests.show');
    });

    Route::middleware('permission:design_request.update_status')->group(function () {
        Route::patch('design-requests/{designRequest}/status', [DesignRequestController::class, 'updateStatus'])->whereNumber('designRequest')->withTrashed()->name('design-requests.status');
    });
});
