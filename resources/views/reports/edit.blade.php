@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Report</h1>
        <form action="{{ route('reports.update', $report->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="report_reason">Report Reason</label>
                <input type="text" name="report_reason" id="report_reason" class="form-control" value="{{ $report->report_reason }}" required>
            </div>
            <div class="form-group">
                <label for="report_description">Report Description</label>
                <textarea name="report_description" id="report_description" class="form-control">{{ $report->report_description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Report</button>
        </form>
    </div>
@endsection

