@extends('layouts.admin')
@section('title', 'Edit Book')

@section('content')
<!-- Book Detail Section -->
<div class="container mt-4">
  <h2 class="fw-bold text-center py-4">Book Details</h2>
  <hr class="border border-dark w-100 mx-auto">

  <div class="row mt-5">
    <!-- Book Images -->
    <div class="col-md-5 text-center">
      <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
      <div class="d-flex justify-content-center gap-2">
        <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
        <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
        <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
      </div>
    </div>

    <!-- Book Information -->
    <div class="col-md-7">
      <h2 class="fw-bold mb-3">Yabai Nihonshi</h2>
      <p><strong>Author:</strong> Ryunosuke Akutagawa</p>
      <p><strong>Genre:</strong> General</p>
      <p><strong>ISBN:</strong> 123-123456789</p>
      <p>
        <strong>Status:</strong>
        <span class="badge bg-primary">Checked Out</span>
      </p>
      <p>
        <strong>Due Date:</strong> 2025-01-24
      </p>

      <hr>
      <h5 class="fw-bold">Book Summary</h5>
      <p>
        - This book presents little-known historical events and intriguing episodes from a unique perspective.<br>
        - Written in an engaging style, it vividly narrates Japanese history from ancient times to the modern era.
      </p>
      <hr>

      <!-- Borrowing History -->
      <div class="mt-5">
        <h5 class="fw-bold">Borrowing History</h5>
        <div class="table-responsive">
          <table class="table table-striped text-center">
            <thead>
              <tr>
                <th>Member Name</th>
                <th>Member ID</th>
                <th>Borrowed Date</th>
                <th>Returned Date</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Taro Yamada</td>
                <td>20250001</td>
                <td>2025-01-20</td>
                <td>2025-01-30</td>
              </tr>
              <tr>
                <td>Hanako Yamada</td>
                <td>20250002</td>
                <td>2025-01-31</td>
                <td>2025-02-02</td>
              </tr>
              <tr>
                <td>Jiro Yamada</td>
                <td>20250003</td>
                <td>2025-02-20</td>
                <td>2025-02-30</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection