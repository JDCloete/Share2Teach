<?php

namespace App\Http\Controllers;

use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/*

Group Related Actions:

Controllers can group related actions together. For example, a UserController might have methods for:

index() to list users

create - store(Request $request) to create a new user
read   - show($id) to display a specific user
update - update(Request $request, $id) to update an existing user
delete - destroy($id) to delete a user

*/

class ShareController extends Controller
{
    // Create a new share
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
        'document_id' => 'required|exists:documents,document_id',
        'recipient_email' => 'required|email',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Create the share record
    $share = Share::create([
        'user_id' => auth()->user()->user_id, // Assuming the user is authenticated
        'document_id' => $request->document_id,
        'recipient_email' => $request->recipient_email,
    ]);

        return response()->json($share, 201);
    }

    // Get all shares for the authenticated user
    public function index()
    {
        $shares = Share::where('user_id', auth()->user()->user_id)->with('document')->get();
        return response()->json($shares);
    }

    // Get a specific share
    public function show($id)
    {
        $share = Share::with('document')->findOrFail($id);
        return response()->json($share);
    }

    // Update a share
    public function update(Request $request, $id)
    {
        $share = Share::findOrFail($id);

        // Validate the request
        $validator = Validator::make($request->all(), [
        'recipient_email' => 'required|email',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

        // Update the share record
        $share->recipient_email = $request->recipient_email;
        $share->save();

        return response()->json($share);
    }

    // Delete a share
    public function destroy($id)
    {
        $share = Share::findOrFail($id);
        $share->delete();

    return response()->json(null, 204);

    }
}
