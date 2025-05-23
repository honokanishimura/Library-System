@extends('layouts.admin')

@section('title', 'Borrow Complete')

@section('content')
<div class="container mt-5">
  <div class="text-center">
    <i class="fas fa-check-circle text-success" style="font-size: 64px;"></i>
    <h2 class="mt-4">Borrowing Completed</h2>
    <p class="mt-3">The borrowing process has been successfully completed.</p>

    <div class="mt-5">
      <a href="{{ route('admin.borrowing.list') }}" class="btn btn-primary me-3">
        <i class="fas fa-list"></i> View Borrow List
      </a>
      <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
        <i class="fas fa-home"></i> Back to Dashboard
      </a>
    </div>
  </div>
</div>
@endsection