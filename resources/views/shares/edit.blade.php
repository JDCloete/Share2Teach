@extends('layouts.app')

@section('content')
    <h1>Edit Share</h1>
    <form action="{{ route('shares.update', $share->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" value="{{ $share->user_id }}" required>

        <label for="document_id">Document ID:</label>
        <input type="text" name="document_id" value="{{ $share->document_id }}" required>

        <label for="recipient_email">Recipient Email:</label>
        <input type="email" name="recipient_email" value="{{ $share->recipient_email }}" required>

        <button type="submit">Update</button>
    </form>
@endsection
