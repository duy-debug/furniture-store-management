<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsCustomer
{
    /**
     * Chỉ cho phép khách hàng truy cập các route dành riêng cho customer.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->hasRole('customer')) {
            abort(403, 'Bạn không có quyền truy cập khu vực khách hàng.');
        }

        return $next($request);
    }
}
