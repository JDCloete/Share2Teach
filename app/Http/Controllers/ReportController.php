<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function storeReportedDocument(Request $request)
    {
        try {
            $validatedData = $request->validate([
                //'user_id' => 'required|exists:users,id', // Ensure the user_id exists in the users table
                //'document_id' => 'required|exists:documents,id', // Ensure the document_id exists in the documents table
                'report_reason' => 'required|string|max:255',
                'report_description' => 'nullable|string',
                //'moderator_id' => 'required|exists:users,id', // Ensure the moderator_id exists in the users table
                'action_taken' => 'required|in:approved,denied', // Ensure action_taken is either 'approved' or 'denied'
            ]);

            $validatedData['user_id'] = 1;
            $validatedData['document_id'] = 1;
            $validatedData['moderator_id'] = 3;

            // Create the report using validated data
            $report = Report::create($validatedData);

            return response()->json(['message' => 'Report created successfully', 'report' => $report], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function readAllReports(Request $request)
    {
        try {
            $reports = Report::all(); // Retrieve all reports

            return response()->json([
                'message' => 'Reports fetched successfully',
                'data' => $reports,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function readReport($id)
    {
        try {
            $report = Report::findOrFail($id); // Retrieve a specific report by ID

            return response()->json([
                'message' => 'Report fetched successfully',
                'data' => $report,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function updateReport(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'report_reason' => 'nullable|string|max:255',
                'report_description' => 'nullable|string',
                'moderator_id' => 'nullable|exists:users,id',
                'action_taken' => 'nullable|in:approved,denied',
            ]);

            $report = Report::findOrFail($id); // Find the report by ID
            $report->update($validatedData); // Update the report

            return response()->json(['message' => 'Report updated successfully', 'report' => $report], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteReport($id)
    {
        try {
            $report = Report::findOrFail($id); // Find the report by ID
            $report->delete(); // Delete the report

            return response()->json(['message' => 'Report deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function readReportsByUser($userId)
    {
        try {
            $reports = Report::where('user_id', $userId)->get(); // Retrieve reports for a specific user

            return response()->json([
                'message' => 'Reports fetched successfully',
                'data' => $reports,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
