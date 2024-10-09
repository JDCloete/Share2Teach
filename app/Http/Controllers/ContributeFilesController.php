<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ContributeFilesController extends Controller
{
    /**
     * Show the contribute files page.
     */
    public function index(): Response
    {
        return Inertia::render('ContributeFilesPage'); // Ensure this matches your Vue component's name
    }

    /**
     * Handle the file upload and save the file information to the database.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'file' => 'required|mimes:pdf,docx,txt|max:10240', // Validate file type and size (e.g., max 10MB)
            'description' => 'required|string|max:255',
            'tags' => 'nullable|string|max:255', // Optional tags
        ]);

        // Store the file
        $filePath = $request->file('file')->store('contributed_files');

        // Save file information to the database
        $document = Document::create([
            'user_id' => auth()->id(), // Assuming the user is authenticated
            'file_path' => $filePath,
            'description' => $validatedData['description'],
            'tags' => $validatedData['tags'],
            'upload_date' => now(),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }

    /**
     * Delete the contributed file.
     */
    public function destroy(Document $document)
    {
        // Check if the authenticated user owns the document
        if ($document->user_id !== auth()->id()) {
            return redirect()->back()->withErrors('You are not authorized to delete this file.');
        }

        // Delete the file from storage
        Storage::delete($document->file_path);

        // Delete the file record from the database
        $document->delete();

        return redirect()->back()->with('success', 'File deleted successfully!');
    }
}
