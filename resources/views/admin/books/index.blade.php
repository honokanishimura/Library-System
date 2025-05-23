@extends('layouts.admin')
@section('title', 'Book List')

@section('content')
<div class="container mt-5">
  <h2 class="fw-bold text-center py-3">Book List</h2>
</div>

<!-- Action Buttons -->
<div class="row justify-content-end gap-4">
  <div class="col-md-8 d-flex justify-content-end">
    <a href="{{ route('admin.books.add') }}" class="btn btn-outline-secondary">
      <i class="fas fa-plus"></i> Add Book
    </a>
    <a href="{{ route('admin.books.import') }}" class="btn btn-outline-secondary">
      <i class="fas fa-file-upload"></i> Bulk Upload
    </a>
  </div>
</div>

<!-- Book Cards -->
<div class="container-fluid py-5">
  <h5 class="text-center py-3"><strong>Book Entries</strong></h5>
  <div class="row">
    @foreach($books as $index => $book)
    <div class="col-md-4 col-lg-3 mb-4">
      <div class="card h-100 shadow-sm">
        <div class="d-flex justify-content-center align-items-center p-3 bg-light">
          <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
        </div>

        <div class="card-body">
          <h5 class="fw-bold card-title text-center mb-3 py-1">{{ $book->title }}</h5>
          <hr class="border border-dark w-100">

          <p class="card-text"><strong>Author:</strong> {{ $book->author_name }}</p>
          <p class="card-text"><strong>Genre:</strong> {{ $book->genre_id }}</p>
          <p class="card-text"><strong>ISBN:</strong> {{ $book->isbn }}</p>
          <p class="card-text"><strong>Description:</strong> {{ Str::limit($book->description, 30, '...') }}</p>

          <p class="card-text"><strong>Status:</strong>
            @if($book->lended)
              <span class="badge bg-primary">Checked Out</span>
            @else
              <span class="badge bg-success">Available</span>
            @endif
          </p>
        </div>

        <div class="card-footer text-center bg-white">
          <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-warning w-100 mb-2">Edit</a>
          <a href="{{ route('admin.books.details', $book->id) }}" class="btn btn-outline-secondary w-100">View Details</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="d-flex justify-content-center mt-4">
    {{ $books->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection