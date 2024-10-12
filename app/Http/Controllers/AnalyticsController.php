<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Document;
use App\Models\Download;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Import the Log facade
use Inertia\Inertia;
use Inertia\Response;

class AnalyticsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('AnalyticsPage'); // Ensure this matches your Vue component name
    }

    public function getAllAnalyticsData(Request $request): JsonResponse
    {
        try {
            // Retrieve counts using existing methods
            $usersCount = $this->readAllUsers()->original['total_users'];
            $downloadsCount = $this->readAllDownloads()->original['total_downloads'];
            $documentsCount = $this->readAllDocuments()->original['total_document'];
            $reportedDocumentsCount = $this->readAllReportedDocuments()->original['total_reported_documents'];
            $newUsersToday = $this->readAllNewUsersFromToday(); // Returns count directly

            // Calculate new users in the last week and month using Carbon
            $newUsersLastWeek = User::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();
            $newUsersLastMonth = User::whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])->count();

            // Return combined data in JSON response
            return response()->json([
                'users' => $usersCount,
                'downloads' => $downloadsCount,
                'documents' => $documentsCount,
                'reported_documents' => $reportedDocumentsCount,
                'new_users_today' => $newUsersToday,
                'new_users_last_week' => $newUsersLastWeek, // Add this
                'new_users_last_month' => $newUsersLastMonth, // Add this
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage()); // Log the error message
            return response()->json(['error' => 'An error occurred while fetching analytics data.'], 500);
        }
    }


    public function readAllNewUsersFromToday()
    {
        return User::whereDate('created_at', Carbon::today())->count();
    }

    public function readAllUsers(): JsonResponse
    {
        $totalUsers = User::count();

        return response()->json([
            'message' => 'user analytics fetched successfully',
            'total_users' => $totalUsers,
        ], 200);
    }

    public function readAllDownloads(): JsonResponse
    {
        $totalDownloads = Download::count();

        return response()->json([
            'message' => 'download analytics fetched successfully',
            'total_downloads' => $totalDownloads,
        ], 200);
    }

    public function readAllDocuments(): JsonResponse
    {
        $totalDocuments = Document::count();

        return response()->json([
            'message' => 'document analytics fetched successfully',
            'total_document' => $totalDocuments,
        ], 200);
    }

    public function readAllReportedDocuments(): JsonResponse
    {
        $totalReportedDocuments = Report::count(); // Ensure this gets the count correctly

        return response()->json([
            'message' => 'reported document analytics fetched successfully',
            'total_reported_documents' => $totalReportedDocuments,
        ], 200);
    }
}
