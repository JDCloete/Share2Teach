@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Details</h1>

        <div class="mb-3">
            <strong>ID:</strong> {{ $user->id }}
        </div>
        <div class="mb-3">
            <strong>Name:</strong> {{ $user->name }}
        </div>
        <div class="mb-3">
            <strong>Surname:</strong> {{ $user->surname }}
        </div>
        <div class="mb-3">
            <strong>Email:</strong> {{ $user->email }}
        </div>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
    </div>
@endsection
