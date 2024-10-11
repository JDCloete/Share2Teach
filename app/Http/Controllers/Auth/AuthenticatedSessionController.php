<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        // Perform the logout
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Return an Inertia response that redirects to the login page
        return redirect()->route('login'); // Or any page you want to redirect to after logout
    }
}

