<?php

namespace App\Http\Controllers;

use App\Models\Download; // Make sure this is imported
use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    public function readAll(Request $request)
    {
        try {
            return response()->json(['message' => 'Total Downloads:', 'downloads' => Download::count()], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([

            ]);

            $validatedData['user_id'] = 1;
            $validatedData['document_id'] = 1;
            $download = Download::create($validatedData);
            return response()->json(['message' => 'Download created successfully', 'download' => $download], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
