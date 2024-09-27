@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Metadata Details</h1>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="mb-3">
            <strong>ID:</strong> {{ $metadata->id }}
        </div>
        <div class="mb-3">
            <strong>Document ID:</strong> {{ $metadata->document_id }}
        </div>
        <div class="mb-3">
            <strong>Module Code:</strong> {{ $metadata->module_code }}
        </div>
        <div class="mb-3">
            <strong>Category:</strong> {{ $metadata->category }}
        </div>
        <div class="mb-3">
            <strong>Academic Year:</strong> {{ $metadata->academic_year }}
        </div>
        <div class="mb-3">
            <strong>Lecturer Name:</strong> {{ $metadata->lecturer_name }}
        </div>
        <div class="mb-3">
            <strong>Upload Date:</strong> {{ $metadata->upload_date }}
        </div>
        <div class="mb-3">
            <strong>Type:</strong> {{ $metadata->type }}
        </div>
        <div class="mb-3">
            <strong>Size:</strong> {{ $metadata->size }}
        </div>
        <div class="mb-3">
            <strong>Created At:</strong> {{ $metadata->created_at }}
        </div>
        <div class="mb-3">
            <strong>Updated At:</strong> {{ $metadata->updated_at }}
        </div>

        <a href="{{ route('metadata.index') }}" class="btn btn-secondary">Back to Metadata</a>
    </div>
@endsection
