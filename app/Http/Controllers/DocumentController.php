<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    public function getStarredUsers($documentId)
    {
        $document = Document::findOrFail($documentId);
        $users = $document->starredBy()->get(); // Get users who starred the document

        return response()->json($users);
    }

    public function getRatedUsers($documentId)
    {
        $document = Document::findOrFail($documentId);
        $users = $document->ratedBy()->withPivot('rating')->get(); // Get users and their ratings

        return response()->json($users);
    }

    public function getDownloadedUsers($documentId)
    {
        $document = Document::findOrFail($documentId);
        $users = $document->downloadedBy()->get(); // Get users who downloaded the document

        return response()->json($users);
    }

    public function getReportedUsers($documentId)
    {
        $document = Document::findOrFail($documentId);
        $users = $document->reportedBy()->withPivot('report_reason', 'report_description')->get(); // Get users with report details

        return response()->json($users);
    }

    public function getSharedUsers($documentId)
    {
        $document = Document::findOrFail($documentId);
        $users = $document->sharedBy()->get(); // Get users who shared the document

        return response()->json($users);
    }
}
