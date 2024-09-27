@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Report Details</h1>
        <p>User ID: {{ $report->user_id }}</p>
        <p>Document ID: {{ $report->document_id }}</p>
        <p>Report Reason: {{ $report->report_reason }}</p>
        <p>Report Description: {{ $report->report_description }}</p>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Back to Reports</a>
    </div>
@endsection

