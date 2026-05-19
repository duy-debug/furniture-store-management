<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return $next($request);
        }

        if ($user->status !== 'locked') {
            return $next($request);
        }

        Auth::logout();
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
}
