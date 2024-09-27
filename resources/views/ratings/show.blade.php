@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Rating Details</h1>
        <p><strong>ID:</strong> {{ $rating->id }}</p>
        <p><strong>User ID:</strong> {{ $rating->user_id }}</p>
        <p><strong>Document ID:</strong> {{ $rating->document_id }}</p>
        <p><strong>Rating Value:</strong> {{ $rating->rating_value }}</p>
        <a href="{{ route('ratings.index') }}" class="btn btn-primary">Back to Ratings</a>
    </div>
@endsection
