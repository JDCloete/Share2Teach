<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;


// Import the Role model

class UserController extends Controller
{

    public function getUsers(): JsonResponse
    {
        $users = User::select('name', 'surname', 'role_id')->get(); // Fetch only needed fields
        return response()->json($users);
    }

    public function readSingle(Request $request , User $user): JsonResponse
    {
        return response()->json(['message'=>'user fetched successfully','user'=>$user], 200);
    }






// ...

    public function store(Request $request): RedirectResponse
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'name' => 'required',
                'surname' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
            ]);

            // Hash the password and set additional attributes
            $validatedData['password'] = Hash::make($validatedData['password']);
            $validatedData['role_id'] = 1;
            $validatedData['created_at'] = Carbon::now();


            // Create the user
            $user = User::create($validatedData);

            // Redirect using Inertia with a success message
            return redirect()->route('login')->with('success', 'User created successfully!');
        } catch (ValidationException $e) {
            // Redirect back with validation errors and old input data
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle any other exceptions
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'role_id' => 'required|integer|exists:roles,id', // Ensure role_id is present and valid
            // Add any other fields you want to validate here
        ]);

        try {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Update the user's role_id
            $user->role_id = $validatedData['role_id'];
            $user->save(); // Save the changes

            // Return a success response
            return response()->json([
                'message' => 'User role updated successfully.',
                'user' => $user,
            ], 200);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error updating user role: ' . $e->getMessage());

            // Return an error response
            return response()->json([
                'message' => 'Error updating user role.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteUser(Request $request, User $user): JsonResponse
    {
        $user->delete();
        return response()->json(['message'=>'user deleted successfully'], 200);
    }




}
