<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Starred;
use App\Models\Rating;
use App\Models\Download;
use App\Models\Report;
use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


/*

Group Related Actions:

Controllers can group related actions together. For example, a UserController might have methods for:

index() to list users

create - store(Request $request) to create a new user
read   - show($id) to display a specific user
update - update(Request $request, $id) to update an existing user
delete - destroy($id) to delete a user

*/


    public function index()
    {
        // Logic to retrieve and display users
    }

    /**
     * Star a document.
     */
    public function star(Document $document)
    {
        $user = Auth::user();

        // Check if user already starred the document
        if ($user->stars()->where('document_id', $document->id)->exists()) {
            return response()->json(['message' => 'You have already starred this document.'], 400);
        }

        // Star the document
        $user->stars()->attach($document->id);
        return response()->json(['message' => 'Document starred successfully.']);
    }

    /**
     * Rate a document.
     */
    public function rate(Request $request, Document $document)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $user = Auth::user();

        // Check if user already rated the document
        if ($user->ratedDocuments()->where('document_id', $document->id)->exists()) {
            return response()->json(['message' => 'You have already rated this document.'], 400);
        }

        // Rate the document
        $user->ratedDocuments()->attach($document->id, ['rating' => $request->rating]);
        return response()->json(['message' => 'Document rated successfully.']);
    }

    /**
     * Download a document.
     */
    public function download(Document $document)
    {
        $user = Auth::user();

        // Record the download
        Download::create([
            'user_id' => $user->id,
            'document_id' => $document->id,
        ]);

        // Proceed with downloading the document
        $path = $document->storage_path;
        return Storage::download($path, $document->document_name);
    }

    /**
     * Report a document.
     */
    public function report(Request $request, Document $document)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        // Check if the user has already reported the document
        if ($user->reportedDocuments()->where('document_id', $document->id)->exists()) {
            return response()->json(['message' => 'You have already reported this document.'], 400);
        }

        // Report the document
        $user->reportedDocuments()->attach($document->id, ['reason' => $request->reason]);
        return response()->json(['message' => 'Document reported successfully.']);
    }

    /**
     * Share a document.
     */
    public function share(Request $request, Document $document)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = Auth::user();

        // Share the document by creating a record in the Share table
        Share::create([
            'user_id' => $user->id,
            'document_id' => $document->id,
            'recipient_email' => $request->email,
        ]);

        // Ideally, you would also send an email here to the recipient

        return response()->json(['message' => 'Document shared successfully.']);
    }
}
