<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Share;

class ShareController extends Controller
{
    public function readAll(Request $request)
    {
        try{
            return response()->json(['message'=>'shares fetched successfully','shares'=>Share::all()], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'recipient_email' => 'required|email',
            ]);
            $validatedData['user_id'] = 1;
            $validatedData['document_id'] = 1;

            $share = Share::create($validatedData);
            return response()->json(['message'=>'share created successfully','share'=>$share], 201);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
