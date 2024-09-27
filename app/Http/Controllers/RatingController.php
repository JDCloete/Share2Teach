<?php


namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function readAll(Request $request)
    {
        try{
        return response()->json(['message'=>'ratings fetched successfully','ratings'=>Rating::all()], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try{
        $validatedData = $request->validate([
            'rating_value' => 'required',
        ]);

            $validatedData['user_id'] = 1;
            $validatedData['document_id'] = 1;
        $rating = Rating::create($validatedData);
        return response()->json(['message'=>'rating created successfully','rating'=>$rating], 201);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(Request $request, Rating $rating)
    {
        try{
        $rating->delete();
        return response()->json(['message'=>'rating deleted successfully'], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Rating $rating)
    {
        try{
        $validatedData = $request->validate([
            'rating_value' => 'required',
        ]);

        $rating->update($validatedData);
        return response()->json(['message'=>'rating updated successfully','rating'=>$rating], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
  

}
