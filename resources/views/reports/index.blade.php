@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reports</h1>
        <a href="{{ route('reports.create') }}" class="btn btn-primary">Add Report</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>User ID</th>
                <th>Document ID</th>
                <th>Report Reason</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->user_id }}</td>
                    <td>{{ $report->document_id }}</td>
                    <td>{{ $report->report_reason }}</td>
                    <td>
                        <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('reports.show', $report->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
