<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FaqController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('FaqPage'); // Ensure this matches your Vue component name
    }

    public function readAll(Request $request): JsonResponse
    {
        // Select only the required fields
        $faqs = FAQ::select('faq_question', 'faq_answer')->get();
        return response()->json([
            'success' => true,
            'message' => 'FAQs fetched successfully',
            'faqs' => $faqs,
            'total' => $faqs->count() // Optional: Include total count
        ], 200);
    }



    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'faq_question' => 'required',
            'faq_answer' => 'nullable',

        ]);

        $validatedData['faq_date_created'] = Carbon::now();
        $validatedData['user_id'] = 1;

        $faq = FAQ::create($validatedData);
        return response()->json(['message'=>'faq created successfully','faq'=>$faq], 201);
    }

    public function readSingle(Request $request, FAQ $faq)
    {
        return response()->json(['message'=>'faq fetched successfully','faq'=>$faq], 200);
    }



    public function update(Request $request, FAQ $faq)
    {
        $validatedData = $request->validate([
            'faq_question' => 'required',
            'faq_answer' => 'nullable',
        ]);

        $faq->update($validatedData);
        return response()->json(['message'=>'faq updated successfully','faq'=>$faq], 200);
    }

    public function deleteFaq(Request $request, FAQ $faq)
    {
        $faq->delete();
        return response()->json(['message'=>'faq deleted successfully'], 200);
    }

}
