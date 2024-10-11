<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
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
    public function store(Request $request): JsonResponse
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'string|min:8|confirmed', // required|
            'role_id' => 'required|exists:roles,id'
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $validatedData['role_id'],
        ]);

        // Return a success response
        return response()->json(['message' => 'Registration successful!', 'user' => $user], 201);
    }
}
