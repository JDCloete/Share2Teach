@extends('layouts.app')

@section('content')
    <h1>Create Share</h1>
    <form action="{{ route('shares.store') }}" method="POST">
        @csrf
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" required>

        <label for="document_id">Document ID:</label>
        <input type="text" name="document_id" required>

        <label for="recipient_email">Recipient Email:</label>
        <input type="email" name="recipient_email" required>

        <button type="submit">Submit</button>
    </form>
@endsection
