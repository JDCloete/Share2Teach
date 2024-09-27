<!-- resources/views/documents/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit Document</h1>

    <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Specify that this is a PUT request -->

        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ old('title', $document->title) }}" required>
        </div>

        <div>
            <label for="file">File:</label>
            <input type="file" name="file">
            <p>Current File: {{ $document->file_path }}</p>
        </div>

        <button type="submit">Update Document</button>
    </form>
@endsection
# The form in this view is similar to the form in the create view, but with a few key differences:
