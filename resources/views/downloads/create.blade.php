@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Download</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('downloads.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="text" class="form-control" id="user_id" name="user_id" required>
            </div>
            <div class="form-group">
                <label for="document_id">Document ID</label>
                <input type="text" class="form-control" id="document_id" name="document_id" required>
            </div>
            <div class="form-group">
                <label for="download_count">Download Count</label>
                <input type="number" class="form-control" id="download_count" name="download_count" value="0" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Download</button>
        </form>
    </div>
@endsection
