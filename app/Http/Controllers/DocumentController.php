<?php

namespace App\Http\Controllers;


use App\Models\Document;
use App\Models\Metadata;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Log facade
use Inertia\Inertia;
use Inertia\Response;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\Settings;
use setasign\Fpdi\Fpdi; // For FPDI
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentController extends Controller
{

    public function index(Request $request): Response
    {
        // Load documents along with the associated user
        $documents = Document::with('user', 'metadata')->get();

        //filter documents to only ones that are not reviewed
        $documents = $documents->filter(function ($document) {
            return $document->is_reviewed;
        });

        return Inertia::render('ExplorePage', [
            'role_id' => (int)$request->query('role_id'), // Cast to integer
            'filteredDocuments' => $documents
        ]);
    }


    public function readAll(): JsonResponse
    {
        return response()->json(['message' => 'documents fetched successfully', 'documents' => Document::all()], 200);
    }

    public function readSingle($id): JsonResponse
    {
        $document = Document::findOrFail($id);
        return response()->json(['message' => 'document fetched successfully', 'document' => $document], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'document_name' => 'required',
            'storage_path' => 'nullable',
        ]);

        $validatedData['user_id'] = Auth::id(); // Get authenticated user ID
        $validatedData['document_date_created'] = Carbon::now();
        $validatedData['watermark_info'] = 'Property of S2T_Triple_Vision';
        $validatedData['key'] = 'A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R8S9T0';

        $document = Document::create($validatedData);
        return response()->json(['message' => 'document created successfully', 'document' => $document], 201);
    }

    public function update(Request $request, Document $document): JsonResponse
    {
        $validatedData = $request->validate([
            'is_approved' => 'required'
        ]);

        if ($validatedData['is_approved'] === true) {
            $validatedData['moderator_id'] = 1; // Get authenticated user ID
            $validatedData['is_reviewed'] = true;
        }

        $document->update($validatedData);
        return response()->json(['message' => 'document updated successfully', 'document' => $document], 200);
    }

    public function deleteDocument(Request $request, Document $document): JsonResponse
    {
        $document->delete();
        return response()->json(['message' => 'document deleted successfully'], 200);
    }

    public function updateReported(Request $request, Document $document): JsonResponse
    {
        $validatedData = $request->validate([
            'is_approved' => 'required'
        ]);

        if ($validatedData['is_approved'] === true) {
            $validatedData['moderator_id'] = 1; // Get authenticated user ID
            $validatedData['is_reviewed'] = true; // true ?!?
        }

        $document->update($validatedData);
        return response()->json(['message' => 'document updated successfully', 'document' => $document], 200);
    }

    public function deleteReported(Request $request, Document $document): JsonResponse
    {
        $document->delete();
        return response()->json(['message' => 'document deleted successfully'], 200);
    }

    public function updateReportedDocument(Request $request, $id): JsonResponse
    {
        // Validate incoming request data
        $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $document = Document::findOrFail($id);

        // Check if the approval is true
        if ($request->input('is_approved') === true) {
            $document->moderator_id = 1; // Assign moderator ID
            $document->is_reviewed = true; // Set is_reviewed to false
        }

        // Save the updated document
        $document->save();

        return response()->json(['message' => 'Document reported successfully', 'document' => $document], 200);
    }


    public function deleteReportedDocument($id): JsonResponse
    {
        try {
            // Find the document by ID
            $document = Document::findOrFail($id);

            // Delete the document
            $document->delete();

            // Return a success response
            return response()->json(['message' => 'Document deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Document not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error deleting the document'], 500);
        }
    }






    ///
    /// Rate document & Report document
    public function rate(Request $request, $id): JsonResponse
    {
        // Validate incoming request data
        $request->validate([
            'is_approved' => 'required|boolean',
            'document_rating_average' => 'required|numeric', // Ensure rating is passed
        ]);

        $document = Document::findOrFail($id);

        // Check if the approval is true and get the rating from request
        if ($request->input('is_approved') === true) {
            $document->moderator_id = 1; // Assign moderator ID

            $newRating = $request->input('document_rating_average'); // Get the rating from request

            // Calculate the new average rating
            if ($document->document_rating_average) {
                $document_rating_average = ($document->document_rating_average + $newRating) / 2;
            } else {
                $document_rating_average = $newRating; // If no previous rating, just set to new rating
            }

            $document->document_rating_average = $document_rating_average; // Update rating
        }

        // Save the updated document
        $document->save();

        return response()->json(['message' => 'Document rated successfully'], 200);
    }






    public function report(Request $request, $id): JsonResponse
    {
        // Validate incoming request data
        $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $document = Document::findOrFail($id);

        // Check if the approval is true
        if ($request->input('is_approved') === true) {
            $document->moderator_id = 1; // Assign moderator ID
            $document->is_reviewed = false; // Set is_reviewed to false
        }

        // Save the updated document
        $document->save();

        return response()->json(['message' => 'Document reported successfully', 'document' => $document], 200);
    }



    // In DocumentController.php or appropriate controller
    public function updateUserToEducator(Request $request, Document $document): JsonResponse
    {
        $validatedData = $request->validate([
            'is_approved' => 'required|boolean'
        ]);

        if ($validatedData['is_approved']) {
            $validatedData['role_id'] = 1;
        }

        $document->update($validatedData);
        return response()->json(['message' => 'Document updated successfully', 'document' => $document], 200);
    }


    public function updateUserToModerator(Request $request, Report $report): JsonResponse
    {
        $validatedData = $request->validate([
            'action_taken' => 'required|string|in:approved',
        ]);

        $report->action_taken = $validatedData['action_taken'];
        $report->moderator_id = 2; // Get authenticated user ID
        $report->save();

        return response()->json(['message' => 'Report action updated successfully', 'report' => $report], 200);
    }

    public function updateUserToAdmin(Request $request, Report $report): JsonResponse
    {
        $validatedData = $request->validate([
            'action_taken' => 'required|string|in:approved',
        ]);

        $report->action_taken = $validatedData['action_taken'];
        $report->moderator_id = 2; // Get authenticated user ID
        $report->save();

        return response()->json(['message' => 'Report action updated successfully', 'report' => $report], 200);
    }


    public function deleteUser(Report $report): JsonResponse
    {
        try {
            $report->delete(); // Delete the report
            return response()->json(['message' => 'Report deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error deleting the report'], 500);
        }
    }


    public function download($id): BinaryFileResponse|JsonResponse
    {
        $document = Document::find($id);
        $filePath = storage_path('app/public/documents/' . $document->filename); // Adjust path

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }


    public function upload(Request $request): JsonResponse
    {
        try {
            // Validate the uploaded file and metadata
            $validatedData = $request->validate([
                'file' => 'required|mimes:pdf,doc,docx|max:2048',
                'document_name' => 'required|string|max:255',
                'module_code' => 'required|string|max:100',
                'category' => 'required|string|max:255',
                'academic_year' => 'required|integer',
                'lecturer_name' => 'required|string|max:255',
            ]);

            $originalName = $request->document_name;
            $moduleCode = $request->input('module_code');
            $category = $request->input('category');

            // Check for existing documents with the same criteria
            $existingDocument = Document::where('document_name', $originalName)
                ->join('metadata', 'documents.id', '=', 'metadata.document_id')
                ->where('metadata.module_code', $moduleCode)
                ->where('metadata.category', $category)
                ->first();

            if ($existingDocument) {
                return response()->json(['message' => 'This document already exists in the database.'], 409);
            }

            // Proceed with the file upload since no duplicate was found
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();

            // Custom path for file storage
            $customPath = 'Documents/' . $moduleCode . '/' . $category;
            $fileName = $originalName . '.' . $extension;

            // Convert docx to PDF if necessary
            if ($extension === 'docx') {
                // Store the file in the 'temp' directory within 'storage/app'
                $tempPath = $file->storeAs('temp', $fileName);

                // Use the storage_path() to get the full path of the uploaded file
                $fullTempPath = storage_path('app/' . $tempPath);

                // Load the docx file using the correct full path
                $phpWord = IOFactory::load($fullTempPath);
                $pdfFileName = $originalName . '.pdf';
                $pdfFilePath = storage_path('app/temp/' . $pdfFileName);

                // Convert docx to PDF
                $domPdfPath = base_path('vendor/dompdf/dompdf');
                Settings::setPdfRendererPath($domPdfPath);
                Settings::setPdfRendererName('DomPDF');

                $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
                $pdfWriter->save($pdfFilePath);

                // Treat the file as a PDF for the next steps
                $uploadedFilePath = $pdfFilePath;
                $extension = 'pdf'; // Override extension to PDF since we converted it
            } else {
                // If not a .docx file, store it as usual
                $uploadedFilePath = storage_path('app/' . $file->storeAs('temp', $fileName));
            }

            // Define the path to the existing document to prepend (e.g., a cover page)
            $existingDocumentPath = storage_path('app/public/cover.pdf'); // Adjust this path as needed

            // If the file is a PDF (either originally or converted), proceed with watermarking
            if ($extension === 'pdf') {
                $pdf = new Fpdi();

                // Prepend the existing document (cover page) to the uploaded document
                $existingPageCount = $pdf->setSourceFile($existingDocumentPath);
                for ($pageNo = 1; $pageNo <= $existingPageCount; $pageNo++) {
                    $pdf->AddPage();
                    $templateId = $pdf->importPage($pageNo);
                    $pdf->useTemplate($templateId, 0, 0, 210); // Adjust the width if necessary
                }

                // Add the pages from the uploaded or converted document
                $uploadedPageCount = $pdf->setSourceFile($uploadedFilePath);
                for ($pageNo = 1; $pageNo <= $uploadedPageCount; $pageNo++) {
                    $pdf->AddPage();
                    $templateId = $pdf->importPage($pageNo);
                    $pdf->useTemplate($templateId, 10, 10, 200);

                    // Add the watermark on each page
                    $pdf->SetFont('Helvetica', 'B', 10);
                    $pdf->SetTextColor(255, 0, 0); // Red color
                    $pdf->SetXY(10, 275); // Position for the watermark
                    $pdf->Cell(0, 0, 'Property of S2T_Triple_Vision', 0, 0, 'C');
                }

                // Save the merged and watermarked PDF to the final storage location
                $mergedFilePath = $customPath . '/' . $originalName . '.pdf';
                Storage::disk('public')->put($mergedFilePath, $pdf->Output('S'));

                // Delete the original temporary uploaded file
                Storage::delete($uploadedFilePath);
            } else {
                // For non-PDF files, store without merging or watermarking
                $mergedFilePath = $file->storeAs($customPath, $fileName, 'public');
            }

            // Use a transaction to insert into the database

            DB::transaction(function () use ($validatedData, $mergedFilePath, $fileSize, $moduleCode) {
                // Save document information
                $document = Document::create([
                    'document_name' => $validatedData['document_name'],
                    'storage_path' => $mergedFilePath,
                    'user_id' => 3, // Jean-Luc == user_id = 2 | Danika == user_id = 1
                    'document_date_created' => Carbon::now(),
                    'category' => $validatedData['category'],
                    'academic_year' => $validatedData['academic_year'],
                    'lecturer_name' => $validatedData['lecturer_name'],
                ]);

                // Create corresponding metadata entry
                Metadata::create([
                    'document_id' => $document->id,
                    'module_code' => $moduleCode,
                    'category' => $validatedData['category'],
                    'academic_year' => $validatedData['academic_year'],
                    'lecturer_name' => $validatedData['lecturer_name'],
                    'size' => $fileSize,
                ]);
            });
        } catch (Exception $e) {
            return response()->json(['message' => 'Error inserting document metadata: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'File uploaded, converted, watermarked, and processed successfully!'], 200);
    }


    public function getDocumentUrl($id)
    {
        $document = Document::findOrFail($id);

        // Remove any leading slash from `storage_path` and avoid double slashes
        $storagePath = ltrim($document->storage_path, '/');
        $url = asset("storage/$storagePath"); // Properly format the URL with a single `/storage` prefix

        return response()->json(['url' => $url]);
    }





    public function getDocumentsWithMetadata(): JsonResponse
    {
        try{
            $documents = Document::with(['user', 'metadata'])
                ->get()
                ->map(function ($document) {
                    return [
                        'document_name' => $document->document_name,
                        'uploaded_by' => $document->user ? $document->user->name . ' ' . $document->user->surname : 'Unknown', // Check if user exists
                        'upload_date' => $document->metadata->upload_date,
                        'type' => $document->metadata->type,
                        'size' => $document->metadata->size,
                    ];
                });

            return response()->json(['documents' => $documents], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getDocumentsWithRatings(): JsonResponse
    {
        try {
            $documents = Document::with(['user', 'metadata'])
                ->get()
                ->map(function ($document) {
                    return [
                        'document_name' => $document->document_name,
                        'uploaded_by' => $document->user ? $document->user->name . ' ' . $document->user->surname : 'Unknown', // Check if user exists
                        'upload_date' => $document->metadata->upload_date,
                        'type' => $document->metadata->type,
                        'size' => $document->metadata->size,
                        'document_rating_average' => $document->document_rating_average,
                    ];
                });

            return response()->json(['documents' => $documents], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getReportedDocuments(): JsonResponse
    {
        try {
            // Fetch reported documents along with related document and user data
            $reports = Report::with(['document.user'])
                ->get()
                ->map(function ($report) {
                    return [
                        'report_id' => $report->id, // Include report_id
                        'document_id' => $report->document_id,
                        'document_name' => $report->document ? $report->document->document_name : 'Unknown',
                        'uploaded_by' => $report->document->user ?
                            $report->document->user->name . ' ' . $report->document->user->surname : 'Unknown',
                        'report_reason' => $report->report_reason,
                    ];
                });

            return response()->json(['reported_documents' => $reports], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function getRolesWithUsers(): JsonResponse
    {
        try {
            // Eager load the 'role' relationship on the User model
            $users = User::with('role') // Assuming 'role' is the relationship on the User model
            ->get()
                ->map(function ($user) {
                    return [
                        'user_id' => $user->id, // Return the user ID
                        'user_name' => $user->name, // Get the user's name
                        'user_surname' => $user->surname, // Get the user's surname
                        'role_name' => $user->role ? $user->role->role_name : 'Unknown', // Get role_name from the role if it exists
                    ];
                });

            return response()->json(['users' => $users], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}



//    public function download(FilesActionRequest $request)
//    {
//        $data = $request->validated();
//        $parent = $request->parent;
//
//        $all = $data['all'] ?? false;
//        $ids = $data['ids'] ?? [];
//
//        if (!$all && empty($ids)) {
//            return [
//                'message' => 'Please select files to download'
//            ];
//        }
//
//        if ($all) {
//            $url = $this->createZip($parent->children);
//            $filename = $parent->name . '.zip';
//        } else {
//            [$url, $filename] = $this->getDownloadUrl($ids, $parent->name);
//        }
//
//        return [
//            'url' => $url,
//            'filename' => $filename
//        ];
//    }

