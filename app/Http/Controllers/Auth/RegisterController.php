<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{

    public function showRegistrationForm(): Response
    {
        return Inertia::render('RegisterPage'); // Ensure this matches your Vue component name
    }

    // Return type declaration for the store method
    public function store(Request $request): RedirectResponse
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id'
        ]);

        // Create a new user (ensure the User model uses the MassAssignable trait)
        User::create([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $validatedData['role_id'], // Assuming the 'role' field exists
        ]);

        // Redirect after successful registration
        return redirect()->route('login'); // Adjust the route as needed
    }
}
