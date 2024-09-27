@extends('layouts.app')

@section('content')
    <h1>Share Details</h1>
    <p>User ID: {{ $share->user_id }}</p>
    <p>Document ID: {{ $share->document_id }}</p>
    <p>Recipient Email: {{ $share->recipient_email }}</p>
    <a href="{{ route('shares.edit', $share->id) }}">Edit</a>
    <form action="{{ route('shares.destroy', $share->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
