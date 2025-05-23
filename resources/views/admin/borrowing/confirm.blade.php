@extends('layouts.admin')

@section('title', 'Borrow Confirmation')

@section('content')
<div class="container mt-5">
  <h2 class="fw-bold text-center mb-4">Final Confirmation</h2>

  <div class="alert alert-secondary text-center">
    Please confirm the following details before finalizing the borrowing process.
  </div>

  <!-- Member Info -->
  <div class="mb-4 d-flex justify-content-end">
    <div class="text-end">
      @if ($user)
        <p class="mb-0 fw-bold text-black"><i class="fas fa-id-card"></i> {{ $user->member_number }}</p>
        <p class="mb-1 fw-bold text-black"><i class="fas fa-user"></i> {{ $user->name }}</p>
        <p class="mb-1 fw-bold"><i class="fas fa-phone"></i> {{ $user->phone_number }}</p>
        <p class="mb-0 fw-bold"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
      @else
        <p class="text-danger fw-bold">Member information could not be retrieved.</p>
      @endif
    </div>
  </div>

  <!-- Borrowed Book List -->
  <div class="table-responsive mb-4">
    <table class="table table-bordered table-hover text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>Cover</th>
          <th>Title</th>
          <th>Author</th>
          <th>Genre</th>
          <th>ISBN</th>
        </tr>
      </thead>
      <tbody>
        @foreach($borrowedBooks as $book)
        <tr>
          <td>
            <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 70px; height: auto;">
          </td>
          <td class="fw-bold">{{ $book->title }}</td>
          <td>{{ $book->author_name }}</td>
          <td>{{ $book->genre->name ?? 'Unknown' }}</td>
          <td class="text-muted">{{ $book->isbn }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Summary -->
  <div class="row text-center mb-5">
    <div class="col-md-4">
      <div class="border p-3 rounded bg-white shadow-sm">
        <h6 class="text-muted mb-1">Borrow Date</h6>
        <div class="fs-5">{{ $borrowed_at }}</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="border p-3 rounded bg-white shadow-sm">
        <h6 class="text-muted mb-1">Due Date</h6>
        <div class="fs-5">{{ $due_date }}</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="border p-3 rounded bg-white shadow-sm">
        <h6 class="text-muted mb-1">Books Borrowed</h6>
        <div class="fs-5">{{ count($borrowedBooks) }} books</div>
      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="d-flex justify-content-between">
    <a href="{{ route('admin.borrowing.index') }}" class="btn btn-outline-secondary btn-lg">
      <i class="fas fa-arrow-left me-1"></i> Back
    </a>
    <form action="{{ route('admin.borrowing.complete') }}" method="POST">
      @csrf
      <input type="hidden" name="borrowed_at" value="{{ $borrowed_at }}">
      <input type="hidden" name="due_date" value="{{ $due_date }}">
      <button type="submit" class="btn btn-success btn-lg fw-bold">
        Confirm Borrow
      </button>
    </form>
  </div>
</div>
@endsection