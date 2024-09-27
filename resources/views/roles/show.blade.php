@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role Details</h1>
        <p><strong>Role Name:</strong> {{ $role->role_name }}</p>
        <p><strong>Slug:</strong> {{ $role->slug }}</p>
        <p><strong>Description:</strong> {{ $role->description }}</p>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to list</a>
    </div>
@endsection
