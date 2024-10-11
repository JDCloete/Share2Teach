<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // Import the Role model
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;


class UserController extends Controller
{
    public function readAll(Request $request)
    {
        return response()->json(['message'=>'users fetched successfully','users'=>User::all()], 200);
    }

    public function readSingle(Request $request , User $user)
    {
        return response()->json(['message'=>'user fetched successfully','user'=>$user], 200);
    }



// ...

    public function store(Request $request)
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
            return Inertia::location(route('login'))->with('success', 'User created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Instead of returning a plain JSON response, redirect back with errors
            return back()->withErrors($e->errors())->withInput();
        }
    }













    public function update(Request $request, User $user)
    {
        try{
         $validatedData = $request->validate([
        'name' => 'required',
        'surname' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'required',
         ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role_id'] = 1;
        $validatedData['created_at'] = Carbon::now();
        $user->update($validatedData);
        return response()->json(['message' => 'user updated successfully', 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function deleteUser(Request $request, User $user)
    {
        $user->delete();
        return response()->json(['message'=>'user deleted successfully'], 200);
    }




}
