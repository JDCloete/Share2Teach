<?php

namespace App\Http\Controllers;


use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DocumentController extends Controller
{
    public function readAll(Request $request)
    {
        return response()->json(['message'=>'documents fetched successfully','documents'=>Document::all()], 200);
    }

    public function readSingle(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        return response()->json(['message'=>'document fetched successfully','document'=>$document], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'document_name' => 'required',
            'storage_path' => 'nullable',
        ]);
        $validatedData['user_id'] = 1;
        $validatedData['document_date_created'] = Carbon::now();
        $validatedData['watermark_info'] = 'Property of S2T_Triple_Vision';
        $validatedData['key'] = 'A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R8S9T0';

        $document = Document::create($validatedData);
        return response()->json(['message'=>'document created successfully','document'=>$document], 201);
    }

    public function update(Request $request, Document $document)
    {
        $validatedData = $request->validate([
            'document_name' => 'required'
        ]);

        $document->update($validatedData);
        return response()->json(['message'=>'document updated successfully','document'=>$document], 200);
    }

    public function deleteDocument(Request $request, Document $document)
    {
        $document->delete();
        return response()->json(['message'=>'document deleted successfully'], 200);
    }


}








































    /*
    public function index()
    {
        $documents = Document::all(); // Fetch all documents
        return view('documents.index', compact('documents')); // Return view with documents
    }


    public function create()
    {
        return view('documents.create'); // Return the view with the upload form
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Store the file and create a document record
        $path = $request->file('file')->store('documents');

        Document::create([
            'document_name' => $request->document_name, // Use the correct property name
            'file_path' => $path,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully!');
    }


    public function edit($id)
    {
        $document = Document::findOrFail($id); // Find the document by ID
        return view('documents.edit', compact('document')); // Return the edit view with the document
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'document_name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        $document = Document::findOrFail($id); // Find the document by ID
        $document->document_name = $request->document_name; // Update the document name

        // Check if a new file is uploaded
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents'); // Store the new file
            $document->file_path = $path; // Update the file path
        }

        $document->save(); // Save the changes
        return redirect()->route('documents.index')->with('success', 'Document updated successfully!');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id); // Find the document by ID
        $document->delete(); // Delete the document

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully!');
    }
}
*/
