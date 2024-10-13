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
            $newDownloadsToday = $this->readAllNewDownloadsFromToday(); // Returns count directly
            $newDocumentsToday = $this->readAllNewDocumentsFromToday(); // Returns count directly
            $newReportsToday = $this->readAllNewReportsFromToday(); // Returns count directly

            // Calculate new users in the last week and month using Carbon
            $newUsersLastWeek = User::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();
            $newUsersLastMonth = User::whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])->count();

            // Calculate new downloads in the last week and month using Carbon
            $newDownloadsLastWeek = Download::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();
            $newDownloadsLastMonth = Download::whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])->count();

            // Calculate new documents in the last week and month using Carbon
            $newDocumentsLastWeek = Document::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();
            $newDocumentsLastMonth = Document::whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])->count();

            // Calculate new reports in the last week and month using Carbon
            $newReportsLastWeek = Report::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();
            $newReportsLastMonth = Report::whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])->count();


            // Return combined data in JSON response
            return response()->json([
                // Total counts
                'users' => $usersCount,
                'downloads' => $downloadsCount,
                'documents' => $documentsCount,
                'reports' => $reportedDocumentsCount,

                // Daily counts
                'new_users_today' => $newUsersToday,
                'new_downloads_today' => $newDownloadsToday,
                'new_documents_today' => $newDocumentsToday,
                'new_reports_today' => $newReportsToday,

                // Weekly and monthly counts
                'new_users_last_week' => $newUsersLastWeek,
                'new_users_last_month' => $newUsersLastMonth,

                'new_downloads_last_week' => $newDownloadsLastWeek,
                'new_downloads_last_month' => $newDownloadsLastMonth,

                'new_documents_last_week' => $newDocumentsLastWeek,
                'new_documents_last_month' => $newDocumentsLastMonth,

                'new_reports_last_week' => $newReportsLastWeek,
                'new_reports_last_month' => $newReportsLastMonth,
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


    public function readAllNewDownloadsFromToday()
    {
        return Download::whereDate('created_at', Carbon::today())->count();
    }

    public function readAllDownloads(): JsonResponse
    {
        $totalDownloads = Download::count();

        return response()->json([
            'message' => 'download analytics fetched successfully',
            'total_downloads' => $totalDownloads,
        ], 200);
    }

    public function readAllNewDocumentsFromToday()
    {
        return Document::whereDate('created_at', Carbon::today())->count();
    }

    public function readAllDocuments(): JsonResponse
    {
        $totalDocuments = Document::count();

        return response()->json([
            'message' => 'document analytics fetched successfully',
            'total_document' => $totalDocuments,
        ], 200);
    }


    public function readAllNewReportsFromToday()
    {
        return Report::whereDate('created_at', Carbon::today())->count();
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
