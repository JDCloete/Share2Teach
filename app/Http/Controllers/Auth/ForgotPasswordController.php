<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ForgotPasswordController extends Controller
{

    public function index(): Response
    {
        return Inertia::render('ResetPasswordPage'); // Ensure this matches your Vue component name
    }

    /**
     * Send a password reset link to the given email address.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function sendResetLink(Request $request): JsonResponse
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
