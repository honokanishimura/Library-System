@extends('layouts.admin')
@section('title', 'Edit Book')

@section('content')
<div class="container py-5">
  <h2 class="text-center py-3"><strong>Edit Book</strong></h2>
  <hr class="border border-dark w-100">

  <div class="row">
    <!-- Book Image -->
    <div class="col-md-6 text-center mb-3">
      <img src="{{ asset('assets/images/' . $book->image) }}" alt="{{ $book->title }}" class="img-thumbnail" style="width: 100px; height: auto;">
    </div>

    <!-- Edit Form -->
    <div class="col-md-8 col-lg-4">
      <div class="card-body justify-content-start">
        <h4 class="fw-bold card-title text-center py-3" id="book-title">{{ $book->title }}</h4>
        <hr class="border border-dark w-100">

        <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- Title and Genre -->
          <div class="mb-3 row">
            <div class="col-md-5">
              <label for="title" class="form-label">Book Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
            </div>
            <div class="col-md-5">
              <label for="book-genre" class="form-label">Select Genre</label>
              <select class="form-select" id="book-genre" name="genre_id" required>
                <option value="1" {{ $book->genre_id == 1 ? 'selected' : '' }}>General</option>
                <option value="2" {{ $book->genre_id == 2 ? 'selected' : '' }}>Philosophy</option>
                <option value="3" {{ $book->genre_id == 3 ? 'selected' : '' }}>History</option>
              </select>
            </div>
          </div>

          <!-- Author and ISBN -->
          <div class="mb-3 row">
            <div class="col-md-5">
              <label for="author_name" class="form-label">Author Name</label>
              <input type="text" class="form-control" id="author_name" name="author_name" value="{{ $book->author_name }}" required>
            </div>
            <div class="col-md-5">
              <label for="isbn" class="form-label">ISBN</label>
              <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}" required>
            </div>
          </div>

          <!-- Image Upload -->
          <div class="card mt-4">
            <div class="card-header bg-outline-primary">
              <h5 class="mb-0">Upload Image</h5>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label for="uploadImage" class="form-label">Choose Image</label>
                <input type="file" class="form-control" id="uploadImage" name="uploadImage" accept="image/*">
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="d-flex justify-content-center align-items-center py-3">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection
