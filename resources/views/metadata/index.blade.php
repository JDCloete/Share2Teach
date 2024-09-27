@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Metadata</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('metadata.create') }}" class="btn btn-primary mb-3">Add Metadata</a>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Key</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($metadata as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->key }}</td>
                    <td>{{ $item->value }}</td>
                    <td>
                        <a href="{{ route('metadata.show', $item->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
