@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Report</h1>
        <form action="{{ route('reports.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" name="user_id" id="user_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="document_id">Document ID</label>
                <input type="number" name="document_id" id="document_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="report_reason">Report Reason</label>
                <input type="text" name="report_reason" id="report_reason" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="report_description">Report Description</label>
                <textarea name="report_description" id="report_description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Report</button>
        </form>
    </div>
@endsection

