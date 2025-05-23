@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-10 col-lg-6">
    <h2 class="fw-bold text-center my-4">Sign in</h2>

    <form class="bg-white rounded shadow-sm p-4" style="min-height: 50vh;" method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email Input -->
      <div class="mb-4">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          <input type="email" name="email" class="form-control" placeholder="Email (Login ID)" required>
        </div>
      </div>

      <!-- Password Input -->
      <div class="mb-4">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Password (min 8 characters)" required>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="d-grid mb-4">
        <button type="submit" class="btn btn-register">Login</button>
      </div>

      <hr class="border border-dark w-100">

      <!-- Social Login Heading -->
      <div class="text-center py-3 mb-2">
        <span class="text-muted">Sign in with</span>
      </div>

      <!-- Social Login Icons -->
      <div class="d-flex justify-content-center py-3 mb-3">
        <button class="btn-social btn-line" type="button">
          <i class="fab fa-line"></i>
        </button>
        <button class="btn-social btn-apple" type="button">
          <i class="fab fa-apple"></i>
        </button>
        <button class="btn-social btn-twitter" type="button">
          <i class="fab fa-twitter"></i>
        </button>
        <button class="btn-social btn-facebook" type="button">
          <i class="fab fa-facebook-f"></i>
        </button>
      </div>
    </form>

    <!-- Registration Link -->
    <div class="text-center mt-4">
      <a href="{{ url('/register') }}" class="text-decoration-none">
        <span style="color: black;">Don't have an account?</span>
        <span style="color: #ff9800;">Register here</span>
      </a>
    </div>
  </div>
</div>
@endsection
