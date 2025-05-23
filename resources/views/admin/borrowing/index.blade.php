@extends('layouts.admin')

@section('content')
<!-- Page Header -->
<div class="container mt-5">
  <h2 class="container text-center py-3">Borrowing & Returning Management</h2>
</div>

<!-- Member Search Form -->
<section class="container my-4">
  <h5>Member Search</h5>
  <form action="{{ route('admin.borrowing.index') }}" method="GET" class="d-flex">
    <input type="text" name="member_number" class="form-control me-2" placeholder="Enter member number" value="{{ request('member_number') }}">
    <button type="submit" class="btn btn-warning">Search</button>
  </form>
</section>

<!-- Member Info Section -->
@if (request('member_number') && $user)
<section class="container mb-5">
  <div class="alert alert-secondary">
    <h6 class="text-center py-3"><strong>-- Member Information --</strong></h6>
    <hr class="border border-dark border w-100">
    <p class="d-flex container justify-content-center"><strong>Name:</strong> {{ $user->name }}</p>
    <p class="d-flex container justify-content-center"><strong>Member Number:</strong> {{ $user->member_number }}</p>
    <p class="d-flex container justify-content-center"><strong>Email:</strong> {{ $user->email }}</p>
    <p class="d-flex container justify-content-center"><strong>Registration Date:</strong> {{ $user->created_at->format('Y-m-d') }}</p>
  </div>
</section>

<!-- Borrow Section -->
<div class="row">
  <section id="lend-books" class="col-md-6 mb-5">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Would you like to borrow books?</h5>
      </div>
      <div class="card-body">
        <p class="mb-2">Click the button below to start borrowing new books.</p>
        <form action="{{ route('admin.borrowing.selectMember') }}" method="POST">
          @csrf
          <input type="hidden" name="member_number" value="{{ $user->member_number }}">
          <button type="submit" class="btn btn-warning btn-sm">Start Borrowing</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Return Section -->
  <section id="return-books" class="col-md-6 mb-5">
    <div class="card">
      <div class="card-header">
        <h5 class="mb-0">Would you like to return books?</h5>
      </div>
      <div class="card-body">
        <p class="mb-2">Click below if you are returning books.</p>
        @if ($borrowedBooks->isNotEmpty())
          <a href="{{ route('admin.return.index', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">Return Books</a>
        @else
          <p>No books are currently borrowed.</p>
        @endif
      </div>
    </div>
  </section>
</div>
@endif
</div>
</div>
@endsection