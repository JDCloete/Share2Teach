@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create New Rating</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ratings.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="text" name="user_id" class="form-control" id="user_id" required>
            </div>
            <div class="mb-3">
                <label for="document_id" class="form-label">Document ID</label>
                <input type="text" name="document_id" class="form-control" id="document_id" required>
            </div>
            <div class="mb-3">
                <label for="rating_value" class="form-label">Rating Value</label>
                <input type="number" name="rating_value" class="form-control" id="rating_value" required min="1" max="5">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
