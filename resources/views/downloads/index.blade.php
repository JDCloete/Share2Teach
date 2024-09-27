@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Downloads</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('downloads.create') }}" class="btn btn-primary">Add Download</a>

        <table class="table mt-3">
            <thead>
            <tr>
                <th>User ID</th>
                <th>Document ID</th>
                <th>Download Count</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($downloads as $download)
                <tr>
                    <td>{{ $download->user_id }}</td>
                    <td>{{ $download->document_id }}</td>
                    <td>{{ $download->download_count }}</td>
                    <td>
                        <a href="{{ route('downloads.show', $download->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
