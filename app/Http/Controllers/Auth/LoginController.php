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
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'success' => true,
                'user' => $user, // Return user data including role_id
            ]);
        }

        return response()->json(['success' => false], 401);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return Response
     */
    public function logout(): Response
    {
        //Auth::logout();
        //return response()->json(['message' => 'Successfully logged out']);

        // Redirect the user to the login page
        return Inertia::render('LoginPage');

    }
}
