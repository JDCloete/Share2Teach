<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // Import the Role model
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'surname'=> 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',

        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role_id'] = 1;
        $validatedData['created_at'] = Carbon::now();

        $user = User::create($validatedData);
        return response()->json(['message'=>'user created successfully','users'=>$user], 201);
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
