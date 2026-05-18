<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
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

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // ─── Dashboard ─────────────────────────────────────────────────────
    Route::get('/', DashboardController::class)->name('dashboard');

    // ─── Quản lý vai trò ───────────────────────────────────────────────
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

    // ─── Gán quyền cho vai trò ─────────────────────────────────────────
    Route::middleware('permission:permission.assign')->group(function () {
        Route::get('roles/{role}/permissions', [PermissionController::class, 'edit'])->name('roles.permissions.edit');
        Route::put('roles/{role}/permissions', [PermissionController::class, 'update'])->name('roles.permissions.update');
    });

    // â”€â”€â”€ Quáº£n lÃ½ Ä‘Æ¡n hÃ ng â”€â”€â”€
    Route::middleware('permission:order.view')->group(function () {
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });

    Route::middleware('permission:order.update_status')->group(function () {
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status.update');
    });

    Route::middleware('permission:order.cancel')->group(function () {
        Route::patch('orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    });
});
