<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Metadata;
use Carbon\Carbon;
use Illuminate\Http\Request;

// Make sure this is imported

class MetadataController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'module_code' => 'required',
            'category' => 'required|string',
            'academic_year' => 'required|string',
            'lecturer_name' => 'required|string',
            'document_name' => 'required|string',

        ]);

        $validatedData['document_id'] = 1;
        $validatedData['upload_date'] = Carbon::now();
        $validatedData['size'] = 1000;
       return response()->json(['message'=>'metadata created successfully','metadata'=>Metadata::create($validatedData)], 201);

    }

    public function deleteMetadata(Request $request, Metadata $metadata)
    {
        $metadata->delete();
        return response()->json(['message'=>'metadata deleted successfully'], 200);
    }





    // searchMetadata works
    public function searchMetadata(Request $request)
    {
        try{
        // Get search parameters from the request
        $query = Metadata::query();

        // Apply filters based on the request parameters
        if ($request->filled('module_code')) {
            $query->where('module_code', '=', $request->input('module_code'));
        }

        if ($request->filled('category')) {
            $query->where('category', '=', $request->input('category'));
        }

        if ($request->filled('academic_year')) {
            $query->where('academic_year', '=', $request->input('academic_year'));
        }

        if ($request->filled('lecturer_name')) {
            $query->where('lecturer_name', '=', $request->input('lecturer_name'));
        }

        if ($request->filled('upload_date')) {
            $query->whereDate('upload_date', $request->input('upload_date'));
        }

        // Get the filtered results
        $metadata = $query->get();

        return response()->json([
            'message' => 'Metadata fetched successfully',
            'data' => $metadata,
        ], 200);

    } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
