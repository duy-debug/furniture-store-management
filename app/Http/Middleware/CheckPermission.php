<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * Kiểm tra:
     * 1. Đã đăng nhập
     * 2. Tài khoản không bị khóa
     * 3. Có quyền cần thiết (thông qua vai trò)
     *
     * Usage trong route: ->middleware('permission:product.create')
     * Nhiều quyền (OR): ->middleware('permission:product.create,product.update')
     */
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        $user = $request->user();

        // 1. Kiểm tra đã đăng nhập
        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            return redirect()->guest(route('login'));
        }

        // 2. Kiểm tra tài khoản không bị khóa
        if ($user->status === 'locked') {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Tài khoản của bạn đã bị khóa.',
                    'reason' => $user->lock_reason,
                ], 403);
            }

            return redirect()->route('login')
                ->withErrors(['email' => 'Tài khoản của bạn đã bị khóa. Lý do: ' . ($user->lock_reason ?? 'Không rõ')]);
        }

        // 3. Kiểm tra quyền (nếu có yêu cầu quyền cụ thể)
        if (!empty($permissions)) {
            $hasAnyPermission = false;

            foreach ($permissions as $permission) {
                if ($user->hasPermission($permission)) {
                    $hasAnyPermission = true;
                    break;
                }
            }

            if (!$hasAnyPermission) {
                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Bạn không có quyền thực hiện thao tác này.'], 403);
                }

                abort(403, 'Bạn không có quyền thực hiện thao tác này.');
            }
        }

        return $next($request);
    }
}
