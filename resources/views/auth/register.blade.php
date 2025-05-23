@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-10 col-lg-6">
    <h2 class="fw-bold text-center my-4">Account Registration</h2>
    <form method="POST" action="{{ route('register') }}" class="bg-white rounded shadow-sm p-4" style="min-height: 50vh;">
      @csrf

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Name Input -->
      <div class="mb-4">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-user"></i></span>
          <input type="text" name="name" class="form-control" placeholder="e.g., Taro Yamada" value="{{ old('name') }}" required>
        </div>
      </div>

      <!-- Phone Number Input -->
      <div class="mb-4">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-phone"></i></span>
          <input type="tel" name="phone_number" class="form-control" placeholder="e.g., 090-1234-5678" value="{{ old('phone_number') }}">
        </div>
      </div>

      <!-- Email Input -->
      <div class="mb-4">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          <input type="email" name="email" class="form-control" placeholder="Email (Login ID)" value="{{ old('email') }}" required>
        </div>
      </div>

      <!-- Password Input -->
      <div class="mb-4">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="8+ characters" required>
          <span class="input-group-text" onclick="togglePasswordVisibility()">
            <i class="fas fa-eye" id="togglePassword"></i>
          </span>
        </div>
        @error('password')
          <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
      </div>

      <!-- Confirm Password Input -->
      <div class="mb-4">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
        </div>
      </div>

      <script>
        function togglePasswordVisibility() {
          const passwordInput = document.getElementById('password');
          const toggleIcon = document.getElementById('togglePassword');
          const isPassword = passwordInput.type === 'password';
          passwordInput.type = isPassword ? 'text' : 'password';
          toggleIcon.classList.toggle('fa-eye', !isPassword);
          toggleIcon.classList.toggle('fa-eye-slash', isPassword);
        }
      </script>

      <!-- Terms Agreement -->
      <div class="mb-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="termsCheckbox" name="terms" required>
          <label class="form-check-label" for="termsCheckbox">
            I agree to the <a href="#" class="text-decoration-underline text-danger">Terms and Privacy Policy</a>.
          </label>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="d-grid mb-4">
        <button type="submit" class="btn btn-register">Register</button>
      </div>

      <hr class="border border-dark w-100">
      <div class="text-center py-3 mb-2">
        <span class="text-muted">Register with a social account</span>
      </div>

      <!-- Social Buttons -->
      <div class="d-flex justify-content-center py-3 mb-3">
        <button class="btn-social btn-line">
          <i class="fab fa-line"></i>
        </button>
        <button class="btn-social btn-apple">
          <i class="fab fa-apple"></i>
        </button>
        <button class="btn-social btn-twitter">
          <i class="fab fa-twitter"></i>
        </button>
        <button class="btn-social btn-facebook">
          <i class="fab fa-facebook-f"></i>
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
