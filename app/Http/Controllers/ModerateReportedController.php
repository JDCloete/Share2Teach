<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Report;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ModerateReportedController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request): Response
    {
        // Load only documents that have not been reviewed, along with the associated user and metadata
        $documents = Document::with('user', 'metadata')
            ->where('is_reviewed', false) // Fetch only non-reviewed documents
            ->get();

        return Inertia::render('ModerateReportedPage', [
            'role_id' => (int) $request->query('role_id'), // Cast to integer
            'filteredDocuments' => $documents
        ]);
    }


//    public function index(Request $request): Response
//    {
//        // Load documents that have been reported along with the associated user
//        $documents = Document::with(['user', 'report'])
//            ->whereHas('report') // Only include documents that have at least one report
//            ->get();
//
//        // Render the view and pass the filtered documents along with their user data
//        return Inertia::render('ModerateReportedPage', [
//            'filteredDocuments' => $documents,
//        ]);
//    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
