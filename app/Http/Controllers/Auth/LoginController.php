<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('LoginPage'); // Ensure this matches your Vue component name
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    // Login method
    public function login(Request $request): JsonResponse
    {
        // Validate the login data
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($validatedData)) {
            // Authentication passed
            return response()->json(['message' => 'Login successful!', 'user' => Auth::user()], 200);
        }

        // Authentication failed
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


}
