@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Metadata</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('metadata.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="key">Key</label>
                <input type="text" class="form-control" id="key" name="key" required>
            </div>
            <div class="form-group">
                <label for="value">Value</label>
                <input type="text" class="form-control" id="value" name="value" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Metadata</button>
        </form>
    </div>
@endsection
