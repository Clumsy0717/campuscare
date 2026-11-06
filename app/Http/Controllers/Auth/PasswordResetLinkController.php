<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\ValidRecaptcha;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset request page.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle the password reset link request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate email and Google reCAPTCHA first.
        $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'g-recaptcha-response' => [
                'required',
                new ValidRecaptcha(),
            ],
        ]);

        // Send the password reset link.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Return success or error message.
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => __($status),
                ]);
    }
}
