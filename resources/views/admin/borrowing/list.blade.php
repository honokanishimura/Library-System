@extends('layouts.admin')

@section('title', 'Borrowing Confirmation')

@section('content')
<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center">
    <h2 class="fw-bold py-3">Borrowing Confirmation</h2>

    <!-- Member Information -->
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

  <!-- Borrowing Form -->
  <form action="{{ route('admin.borrowing.confirm') }}" method="POST" class="row g-3 mb-4">
    @csrf
    <div class="col-md-3">
      <label for="borrowed_at" class="form-label fw-bold">Borrowed Date</label>
      <input type="date" id="borrowed_at" name="borrowed_at" class="form-control" required>
    </div>
    <div class="col-md-3">
      <label for="due_date" class="form-label fw-bold">Due Date</label>
      <input type="date" id="due_date" name="due_date" class="form-control" required>
    </div>
    <div class="col-md-2 d-flex align-items-end">
      <button type="submit" class="btn btn-primary w-100 fw-bold">Proceed to Confirmation</button>
    </div>
  </form>

  <hr class="border border-dark">
</div>

<!-- Borrowed Book List -->
<div class="container my-4">
  <div class="table-responsive">
    <table class="table table-striped table-bordered text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>Cover</th>
          <th>Title</th>
          <th>Author</th>
          <th>Genre</th>
          <th>ISBN</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($borrowedBooks as $book)
        <tr>
          <td>
            <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
          </td>
          <td>{{ $book->title }}</td>
          <td>{{ $book->author_name }}</td>
          <td>{{ $book->genre->name ?? 'Unknown' }}</td>
          <td>{{ $book->isbn }}</td>
          <td>
            <form action="{{ route('admin.borrowing.removeBook', $book->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm fw-bold">Remove</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Total Count -->
<div class="container text-end mt-3">
  <p class="fw-bold">Total Borrowed Books: {{ count($borrowedBooks) }}</p>
</div>

<!-- Back Button -->
<div class="container d-flex justify-content-start mt-4">
  <a href="{{ route('admin.borrowing.select') }}" class="btn btn-outline-secondary">
    Back
  </a>
</div>
@endsection

@section('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const today = new Date();
    const todayStr = today.toISOString().split("T")[0];

    const due = new Date();
    due.setDate(today.getDate() + 14);
    const dueStr = due.toISOString().split("T")[0];

    const borrowedInput = document.getElementById("borrowed_at");
    const dueInput = document.getElementById("due_date");

    if (borrowedInput) {
      borrowedInput.value = todayStr;
      borrowedInput.setAttribute("min", todayStr);
    }

    if (dueInput) {
      dueInput.value = dueStr;
      dueInput.setAttribute("min", todayStr);
    }
  });
</script>
@endsection