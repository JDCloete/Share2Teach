<?php

namespace App\Http\Controllers;

use App\Models\Faq;
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

    public function readAll(Request $request)
    {
        return response()->json(['message'=>'faqs fetched successfully','faqs'=>FAQ::all()], 200);
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
