<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Document;
use App\Models\Download;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /*public function readAllUsers(Request $request)
    {
        return response()->json(['message'=>'analytics fetched successfully','analytics'=>Analytics::all()], 200);
    }*/

    // Users
    public function readAllUsers(Request $request)
    {
        // Get the total count of users
        $totalUsers = User::count();

        return response()->json([
            'message' => 'user analytics fetched successfully',
            'total_users' => $totalUsers,
        ], 200);
    }

    // Downloads
    public function readAllDownloads(Request $request)
    {
        // Get the total count of users
        $totalDownloads = Download::count();

        return response()->json([
            'message' => 'download analytics fetched successfully',
            'total_downloads' => $totalDownloads,
        ], 200);
    }

    // Documents
    public function readAllDocuments(Request $request)
    {
        // Get the total count of users
        $totalDocuments = Document::count();

        return response()->json([
            'message' => 'document analytics fetched successfully',
            'total_document' => $totalDocuments,
        ], 200);
    }

    // Reported Documents
    public function readAllReportedDocuments(Request $request)
    {
        try {
            // Get the total count of reported documents
            $totalReportedDocuments = \DB::table('reports') // Start from the reports table
            ->leftJoin('users', 'reports.user_id', '=', 'users.id') // Left join to ensure all reports are included
            ->leftJoin('analytics', 'users.id', '=', 'analytics.user_id') // Left join Analytics to include all reports
            ->count('reports.id'); // Count the id in Reports table, assuming the primary key is 'id'

            return response()->json([
                'message' => 'reported document analytics fetched successfully',
                'total_reported_documents' => $totalReportedDocuments,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
