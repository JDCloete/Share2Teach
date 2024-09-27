@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Ratings List</h2>
        <a href="{{ route('ratings.create') }}" class="btn btn-primary">Create Rating</a>

        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-2">
                {{ $message }}
            </div>
        @endif

        <table class="table mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Document ID</th>
                <th>Rating Value</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($ratings as $rating)
                <tr>
                    <td>{{ $rating->id }}</td>
                    <td>{{ $rating->user_id }}</td>
                    <td>{{ $rating->document_id }}</td>
                    <td>{{ $rating->rating_value }}</td>
                    <td>
                        <a href="{{ route('ratings.show', $rating->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('ratings.edit', $rating->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('ratings.destroy', $rating->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
