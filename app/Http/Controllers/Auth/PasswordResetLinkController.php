<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status == Password::RESET_LINK_SENT) {
                return back()->with('success', 'Link đặt lại mật khẩu đã được gửi đến email của bạn.');
            }

            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Không tìm thấy tài khoản với email này.');

        } catch (\Exception $e) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Không thể gửi email. Vui lòng thử lại sau.');
        }
    }
}
