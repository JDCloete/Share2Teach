<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Starred;
use Illuminate\Http\Request;

class StarredController extends Controller
{

    public function readAll(Request $request)
    {
        try{
        return response()->json(['message'=>'starred fetched successfully','starred'=>Starred::all()], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //Jacques se goed
    /*public function getStarredDocuments(Request $request)
    {
        try {
            // Get document IDs from the starred table for user_id 1
            $starredDocuments = DB::table('starred')
                ->where('user_id', 1)
                ->pluck('document_id'); // Retrieve only the document_id column

            return response()->json([
                'message' => 'Starred documents fetched successfully',
                'document_ids' => $starredDocuments,
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }*/


    public function store(Request $request)
    {
        try{
        $validatedData = $request->validate([

        ]);

            $validatedData['user_id'] = 1;
            $validatedData['document_id'] = 1;

        $starred = Starred::create($validatedData);
        return response()->json(['message'=>'starred created successfully','starred'=>$starred], 201);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(Request $request, Starred $starred)
    {
        try{
        $starred->delete();
        return response()->json(['message'=>'starred deleted successfully'], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



}
