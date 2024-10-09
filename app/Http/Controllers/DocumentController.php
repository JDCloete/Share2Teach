<?php

namespace App\Http\Controllers;


use App\Models\Document;
use App\Models\Metadata;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Writer\PDF\DomPDF;


class DocumentController extends Controller
{




    public function readAll(Request $request)
    {
        return response()->json(['message'=>'documents fetched successfully','documents'=>Document::all()], 200);
    }

    public function readSingle(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        return response()->json(['message'=>'document fetched successfully','document'=>$document], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'document_name' => 'required',
            'storage_path' => 'nullable',
        ]);
        $validatedData['user_id'] = 1;
        $validatedData['document_date_created'] = Carbon::now();
        $validatedData['watermark_info'] = 'Property of S2T_Triple_Vision';
        $validatedData['key'] = 'A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R8S9T0';

        $document = Document::create($validatedData);
        return response()->json(['message'=>'document created successfully','document'=>$document], 201);
    }

    public function update(Request $request, Document $document)
    {
        $validatedData = $request->validate([
            'document_name' => 'required'
        ]);

        $document->update($validatedData);
        return response()->json(['message'=>'document updated successfully','document'=>$document], 200);
    }

    public function deleteDocument(Request $request, Document $document)
    {
        $document->delete();
        return response()->json(['message'=>'document deleted successfully'], 200);
    }

    public function uploadAndConvert(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:docx,txt,png,jpg,pdf|max:5120', // Accept various file types
        ]);

        // Get the uploaded file
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $fileType = $file->getClientOriginalExtension();

        // Define a unique filename for the converted PDF
        $pdfFileName = pathinfo($originalName, PATHINFO_FILENAME) . '-' . time() . '.pdf';

        // Check file type and convert if needed
        if ($fileType == 'docx') {
            $pdfFilePath = $this->convertDocxToPdf($file, $pdfFileName);
        } elseif (in_array($fileType, ['png', 'jpg'])) {
            $pdfFilePath = $this->convertImageToPdf($file, $pdfFileName);
        } else {
            // If it's already a PDF or another supported format, just move it
            $pdfFilePath = $file->storeAs('documents', $pdfFileName, 'public');
        }

        // Save document info in the database (Document and Metadata tables)
        $document = new Document();
        $document->title = $originalName;
        $document->file_path = $pdfFilePath;
        $document->save();

        // Add metadata (for example, upload date and file type)
        $metadata = new Metadata();
        $metadata->document_id = $document->id;
        $metadata->module_code = 'DOC'; // Example static field
        $metadata->category = $fileType;
        $metadata->academic_year = Carbon::now()->year;
        $metadata->lecturer_name = 'John Doe'; // Example static field
        $metadata->upload_date = Carbon::now();
        $metadata->type = $fileType;
        $metadata->size = $file->getSize();
        $metadata->save();

        return response()->json(['message' => 'File uploaded and converted to PDF successfully']);
    }

    // Convert .docx to PDF
    protected function convertDocxToPdf($file, $pdfFileName)
    {
        $phpWord = IOFactory::load($file->getPathName());

        $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
        $pdfFilePath = 'documents/' . $pdfFileName;
        Storage::put('public/' . $pdfFilePath, $pdfWriter->save());

        return $pdfFilePath;
    }

    // Convert an image to PDF
    protected function convertImageToPdf($file, $pdfFileName)
    {
        $dompdf = new Dompdf();
        $imgPath = $file->getPathName();

        $html = '<img src="' . $imgPath . '" style="width: 100%">';
        $dompdf->loadHtml($html);
        $dompdf->render();

        $pdfFilePath = 'documents/' . $pdfFileName;
        Storage::put('public/' . $pdfFilePath, $dompdf->output());

        return $pdfFilePath;
    }
}








































    /*
    public function index()
    {
        $documents = Document::all(); // Fetch all documents
        return view('documents.index', compact('documents')); // Return view with documents
    }


    public function create()
    {
        return view('documents.create'); // Return the view with the upload form
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Store the file and create a document record
        $path = $request->file('file')->store('documents');

        Document::create([
            'document_name' => $request->document_name, // Use the correct property name
            'file_path' => $path,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully!');
    }


    public function edit($id)
    {
        $document = Document::findOrFail($id); // Find the document by ID
        return view('documents.edit', compact('document')); // Return the edit view with the document
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'document_name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        $document = Document::findOrFail($id); // Find the document by ID
        $document->document_name = $request->document_name; // Update the document name

        // Check if a new file is uploaded
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents'); // Store the new file
            $document->file_path = $path; // Update the file path
        }

        $document->save(); // Save the changes
        return redirect()->route('documents.index')->with('success', 'Document updated successfully!');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id); // Find the document by ID
        $document->delete(); // Delete the document

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully!');
    }
}
*/
