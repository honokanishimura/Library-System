@extends('layouts.admin')

@section('title', 'Admin Management')

@section('content')

<div class="container mt-5">
  <h2 class="fw-bold text-center py-3">Register New Administrator</h2>

  <div class="d-flex justify-content-center">
    <div class="card p-4" style="max-width: 400px; width:100%">
      <div class="card-header text-center">
        <h4 class="fw-bold">New Admin Registration</h4>
      </div>

      <form action="{{ route('admin.admins.store') }}" method="POST">
        @csrf

        <!-- Admin Name -->
        <div class="mb-3">
          <label for="admin-name" class="form-label">Admin Name:</label>
          <input type="text" class="form-control" id="admin-name" name="name" placeholder="Enter admin name" required>
        </div>

        <!-- Admin Email -->
        <div class="mb-3">
          <label for="admin-email" class="form-label">Email Address:</label>
          <input type="email" class="form-control" id="admin-email" name="email" placeholder="Enter email" required>
        </div>

        <!-- Admin Password -->
        <div class="mb-3">
          <label for="admin-password" class="form-label">Password:</label>
          <input type="password" class="form-control" id="admin-password" name="password" placeholder="Enter password" required>
        </div>

        <!-- Buttons -->
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Register</button>
          <a href="{{ route('admin.admins.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
