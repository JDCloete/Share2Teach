@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Analytics</h1>
        <a href="{{ route('analytics.create') }}" class="btn btn-primary">Add Analytics</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>User ID</th>
                <th>User Count</th>
                <th>Document Count</th>
                <th>Reported Documents Count</th>
                <th>Total Download Count</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($analytics as $analytic)
                <tr>
                    <td>{{ $analytic->user_id }}</td>
                    <td>{{ $analytic->user_count }}</td>
                    <td>{{ $analytic->document_count }}</td>
                    <td>{{ $analytic->reported_documents_count }}</td>
                    <td>{{ $analytic->total_download_count }}</td>
                    <td>
                        <a href="{{ route('analytics.edit', $analytic->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('analytics.destroy', $analytic->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('analytics.show', $analytic->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
