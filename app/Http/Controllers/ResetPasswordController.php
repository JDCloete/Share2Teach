<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class ResetPasswordController extends Controller
{
    /**
     * Show the reset password form.
     *
     * @param  Request  $request
     * @return Response
     */
    public function showResetPasswordPage(Request $request): Response
    {
        return Inertia::render('ResetPasswordPage', [
            'email' => $request->email,  // Pre-populate the form with email if present
            'token' => $request->route('token') // The reset token from the URL
        ]);
    }

    /**
     * Handle the reset password form submission.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function reset(Request $request): RedirectResponse
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ]);

        // Attempt to reset the user's password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Update the user's password
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        // Check if the password reset was successful
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status)); // Redirect to login page with success message
        }

        // Otherwise, return with error message
        return back()->withErrors(['email' => [__($status)]]);
    }
}
