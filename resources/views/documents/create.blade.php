{{-- resources/views/documents/create.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Document</title>
    <!-- Include any necessary stylesheets here -->
</head>
<body>
<h1>Upload Document</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="document_name">Document Name:</label>
        <input type="text" name="title" id="document_name" required>
    </div>
    <div>
        <label for="file">Upload File:</label>
        <input type="file" name="file" id="file" required>
    </div>
    <button type="submit">Upload</button>
</form>
</body>
</html>
