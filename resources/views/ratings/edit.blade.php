@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Rating</h1>
        <form action="{{ route('ratings.update', $rating->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" name="user_id" class="form-control" value="{{ $rating->user_id }}" required>
            </div>
            <div class="form-group">
                <label for="document_id">Document ID</label>
                <input type="number" name="document_id" class="form-control" value="{{ $rating->document_id }}" required>
            </div>
            <div class="form-group">
                <label for="rating_value">Rating Value</label>
                <input type="number" name="rating_value" class="form-control" value="{{ $rating->rating_value }}" required>
            </div>
            <button type="submit" class="btn btn-warning">Update Rating</button>
        </form>
    </div>
@endsection
