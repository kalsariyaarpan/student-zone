@extends('user-auth.auth')
@section('title')
forget-password
@endsection
@section('auth-content')

  <div class="main-container">
    <h2>Forgot Password</h2>
    <p>Enter your email address to reset your password.</p>
    <form action="/reset-password" method="POST">
      <input type="email" name="email" placeholder="Enter your email" required>
      <button type="submit">Reset Password</button>
    </form>
    <a href="{{route('login')}}">Back to Login Page </a>
  </div>

@endsection
