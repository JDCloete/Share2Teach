@extends('layouts.app')

@section('content')
    <h2>Edit User</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $user->name }}">

        <label for="surname">Surname:</label>
        <input type="text" name="surname" value="{{ $user->surname }}">

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $user->email }}">

        <label for="role_id">Role:</label>
        <select name="role_id" id="role_id" required>
            <option value="" disabled selected>Select a role</option> <!-- Placeholder -->

            <option value="1" {{ isset($user) && $user->role_id == 1 ? 'selected' : '' }}>Educator</option>
            <option value="2" {{ isset($user) && $user->role_id == 2 ? 'selected' : '' }}>Admin</option>
            <option value="3" {{ isset($user) && $user->role_id == 3 ? 'selected' : '' }}>Moderator</option>
        </select>

        <label for="password">New Password (optional):</label>
        <input type="password" name="password">

        <button type="submit">Update User</button>
    </form>
@endsection
