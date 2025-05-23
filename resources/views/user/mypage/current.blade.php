@extends('layouts.user')

@section('content')

<div class="container my-5">
  <h2 class="fw-bold mb-4">My Page</h2>
  <hr class="border border-dark w-100">

  <!-- Navigation Tabs -->
  <div class="d-flex justify-content-around py-4">
    <a href="{{ route('mypage.borrowed') }}" class="btn btn-outline-secondary w-25 text-center">Borrowing History</a>
    <a href="{{ route('mypage.current') }}" class="btn btn-primary w-25 text-center">Currently Borrowed</a>
  </div>

  <p class="text-center text-muted py-2">Welcome, {{ $user->name }}</p>
  <hr class="border border-dark w-100">

  <h4 class="fw-bold mb-3">Currently Borrowed Books</h4>

  <!-- Flash Messages -->
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <!-- Borrowed Books Table -->
  <table class="table table-bordered table-hover align-middle">
    <thead class="table-dark text-center">
      <tr>
        <th>Borrowed Date</th>
        <th>Cover</th>
        <th>Title</th>
        <th>Due Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($currentBooks->sortBy('borrowed_at') as $book)
      <tr>
        <td class="text-center">{{ $book->borrowed_at->format('Y/m/d') }}</td>
        <td class="text-center">
          <img src="{{ asset('assets/images/' . $book->book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 100px; height: auto; object-fit: cover;">
        </td>
        <td class="text-center">{{ $book->book->title }}</td>
        <td class="text-center">{{ $book->due_date->format('Y/m/d') }}</td>
        <td class="text-center">
          <span class="badge bg-warning text-dark">On Loan</span>
        </td>
        <td class="text-center">
          <form method="POST" action="{{ route('mypage.return', $book->id) }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">
              Return
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Upcoming Due Alert -->
  @if(isset($upcomingDueBooks) && $upcomingDueBooks->count() > 0)
    <div class="alert alert-warning">
      <h5 class="fw-bold mb-2">Books Approaching Due Date</h5>
      <ul class="mb-0">
        @foreach($upcomingDueBooks as $book)
          <li>{{ $book->book->title ?? 'Untitled' }} (Due: {{ \Carbon\Carbon::parse($book->due_date)->format('Y/m/d') }})</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Overdue Alert -->
  @if(isset($overdueBooks) && $overdueBooks->count() > 0)
    <div class="alert alert-danger mt-4">
      <h5 class="fw-bold mb-2">Overdue Books</h5>
      <ul class="mb-0">
        @foreach($overdueBooks as $book)
          <li>{{ $book->book->title ?? 'Untitled' }} (Due: {{ \Carbon\Carbon::parse($book->due_date)->format('Y/m/d') }})</li>
        @endforeach
      </ul>
    </div>
  @endif

</div>

@endsection