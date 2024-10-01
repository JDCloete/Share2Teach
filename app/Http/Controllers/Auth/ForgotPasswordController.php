<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /**
     * Show the form for requesting a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.forgot-password'); // Create this view as needed
    }

    /**
     * Send a password reset link to the given email address.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLink(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|string|email',
        ]);

        // Send the password reset link
        $response = Password::sendResetLink($request->only('email'));

        // Check if the email was sent successfully
        if ($response === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Password reset link sent.'], 200);
        }

        throw ValidationException::withMessages([
            'email' => ['Unable to send password reset link.'],
        ]);
    }
}
