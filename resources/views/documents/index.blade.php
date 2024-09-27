<!-- resources/views/documents/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Documents</h1>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('documents.create') }}">Upload New Document</a>

    <ul>
        @foreach($documents as $document)
            <li>
                {{ $document->title }} -
                <a href="{{ route('documents.edit', $document->id) }}">Edit</a>
                <form action="{{ route('documents.destroy', $document->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
