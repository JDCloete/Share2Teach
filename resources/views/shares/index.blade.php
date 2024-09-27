@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Shares</h1>
        <a href="{{ route('shares.create') }}" class="btn btn-primary">Add Share</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th>User ID</th>
                <th>Document ID</th>
                <th>Recipient Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($shares as $share)
                <tr>
                    <td>{{ $share->user_id }}</td>
                    <td>{{ $share->document_id }}</td>
                    <td>{{ $share->recipient_email }}</td>
                    <td>
                        <a href="{{ route('shares.edit', $share->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('shares.destroy', $share->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('shares.show', $share->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
