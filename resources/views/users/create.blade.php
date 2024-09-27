@extends('layouts.app')

@section('content')
    <h2>Create User</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ old('name') }}">

        <label for="surname">Surname:</label>
        <input type="text" name="surname" value="{{ old('surname') }}">

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email') }}">

        <label for="role_id">Role:</label>
        <select name="role_id" id="role_id" required>
            <option value="" disabled selected>Select a role</option> <!-- Placeholder -->

            <option value="1" {{ isset($user) && $user->role_id == 1 ? 'selected' : '' }}>Educator</option>
            <option value="2" {{ isset($user) && $user->role_id == 2 ? 'selected' : '' }}>Admin</option>
            <option value="3" {{ isset($user) && $user->role_id == 3 ? 'selected' : '' }}>Moderator</option>
        </select>

        <label for="password">Password:</label>
        <input type="password" name="password">

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation">

        <button type="submit">Create User</button>
    </form>
@endsection
