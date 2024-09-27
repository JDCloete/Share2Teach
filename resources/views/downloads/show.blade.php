@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Download Details</h1>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="mb-3">
            <strong>User ID:</strong> {{ $download->user_id }}
        </div>
        <div class="mb-3">
            <strong>Document ID:</strong> {{ $download->document_id }}
        </div>
        <div class="mb-3">
            <strong>Download Count:</strong> {{ $download->download_count }}
        </div>

        <a href="{{ route('downloads.index') }}" class="btn btn-secondary">Back to Downloads</a>
    </div>
@endsection
