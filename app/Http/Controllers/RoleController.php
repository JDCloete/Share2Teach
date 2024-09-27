<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Insert
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'role_name' => 'required',
                'slug' => 'required|unique:roles',
                'description' => 'nullable',
            ]);

            $role = Role::create($validatedData);
            return response()->json(['message' => 'role created successfully', 'role' => $role], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Delete
    public function deleteRole(Request $request, Role $role)
    {
        try {
            $role->delete();
            return response()->json(['message' => 'role deleted successfully'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function readAll(Request $request)
    {
        return response()->json(['message' => 'roles fetched successfully', 'roles' => Role::all()], 200);
    }
}












