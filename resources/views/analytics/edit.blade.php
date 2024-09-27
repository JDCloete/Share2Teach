@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Analytics</h1>

        <form action="{{ route('analytics.update', $analytics->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" name="user_id" class="form-control" value="{{ $analytics->user_id }}" required>
            </div>
            <div class="form-group">
                <label for="user_count">User Count</label>
                <input type="number" name="user_count" class="form-control" value="{{ $analytics->user_count }}" required>
            </div>
            <div class="form-group">
                <label for="document_count">Document Count</label>
                <input type="number" name="document_count" class="form-control" value="{{ $analytics->document_count }}" required>
            </div>
            <div class="form-group">
                <label for="reported_documents_count">Reported Documents Count</label>
                <input type="number" name="reported_documents_count" class="form-control" value="{{ $analytics->reported_documents_count }}" required>
            </div>
            <div class="form-group">
                <label for="total_download_count">Total Download Count</label>
                <input type="number" name="total_download_count" class="form-control" value="{{ $analytics->total_download_count }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
