@extends('layouts.app')

@section('content')
    <h1>Analytics Details</h1>

    <p>User ID: {{ $analytics->user_id }}</p>
    <p>User Count: {{ $analytics->user_count }}</p>
    <p>Document Count: {{ $analytics->document_count }}</p>
    <p>Reported Documents Count: {{ $analytics->reported_documents_count }}</p>
    <p>Total Download Count: {{ $analytics->total_download_count }}</p>

    <a href="{{ route('analytics.index') }}">Back to Analytics</a>
@endsection

