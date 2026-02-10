@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2>Account Settings</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('account.update.password') }}" class="mb-4">
        @csrf

        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Password</button>
    </form>

    <hr>

    <form method="POST" action="{{ route('account.update.theme') }}">
        @csrf
        <div class="mb-3">
            <label for="theme" class="form-label">Theme</label>
            <select name="theme" class="form-select">
                <option value="light" {{ auth()->user() && auth()->user()->theme === 'light' ? 'selected' : '' }}>Light</option>
                <option value="dark" {{ auth()->user() && auth()->user()->theme === 'dark' ? 'selected' : '' }}>Dark</option>
            </select>
        </div>
        <button type="submit" class="btn btn-secondary">Save Theme</button>
    </form>
<div class="main-container">
    <a href="{{route('login')}}">Back to Login Page </a>
</div>
</div>
@endsection
