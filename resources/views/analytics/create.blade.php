@extends('layouts.app')

@section('content')
    <h1>Add Analytics</h1>
    <form action="{{ route('analytics.store') }}" method="POST">
        @csrf
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" required>

        <label for="user_count">User Count:</label>
        <input type="number" name="user_count" required>

        <label for="document_count">Document Count:</label>
        <input type="number" name="document_count" required>

        <label for="reported_documents_count">Reported Documents Count:</label>
        <input type="number" name="reported_documents_count" required>

        <label for="total_download_count">Total Download Count:</label>
        <input type="number" name="total_download_count" required>

        <button type="submit">Add Analytics</button>
    </form>
@endsection

