@extends('layouts.user')

@section('content')
<div class="container my-5">
  <h2 class="fw-bold mb-4">My Page</h2>
  <hr class="border border-dark w-100">

  <!-- Navigation Tabs -->
  <div class="d-flex justify-content-around py-4">
    <a href="{{ route('mypage.borrowed') }}" class="btn btn-primary w-25 text-center">Borrowing History</a>
    <a href="{{ route('mypage.current') }}" class="btn btn-outline-secondary w-25 text-center">Currently Borrowed</a>
  </div>

  <p class="text-center text-muted py-2">Welcome, {{ $user->name }}</p>
  <hr class="border border-dark w-100">

  <!-- Borrowing History Section -->
  <div class="mt-5">
    <h4 class="fw-bold mb-4">Borrowing History List</h4>

    <!-- Search Form -->
    <form class="row g-3 mb-4">
      <div class="col-md-4">
        <label for="search-title" class="form-label">Book Title</label>
        <input type="text" id="search-title" class="form-control" placeholder="Enter title">
      </div>
      <div class="col-md-3">
        <label for="start-date" class="form-label">Start Date</label>
        <input type="date" id="start-date" class="form-control">
      </div>
      <div class="col-md-3">
        <label for="end-date" class="form-label">End Date</label>
        <input type="date" id="end-date" class="form-control">
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">Search</button>
      </div>
    </form>

    <!-- History Table -->
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-dark text-center">
        <tr>
          <th>Borrowed Date</th>
          <th>Cover</th>
          <th>Title</th>
          <th>Due Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($borrowedBooks->sortBy('borrowed_at') as $book)
        <tr>
          <td class="text-center">{{ $book->borrowed_at->format('Y/m/d') }}</td>
          <td class="text-center">
            <img src="{{ asset('assets/images/' . $book->book->image) }}" class="img-thumbnail" style="width: 80px; height: auto; object-fit: cover;" alt="{{ $book->book->title }}">
          </td>
          <td class="text-center">{{ $book->book->title }}</td>
          <td class="text-center">{{ $book->due_date->format('Y/m/d') }}</td>
          <td class="text-center">
            @if ($book->returned_at)
              <span class="badge bg-success">Returned</span>
            @else
              <span class="badge bg-warning text-dark">On Loan</span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection