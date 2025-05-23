@extends('layouts.admin')

@section('title', 'Add Book')

@section('content')
<div class="container py-5">
  <h2 class="text-center py-3"><strong>Add New Book</strong></h2>
  <hr class="border border-dark w-100">

  <!-- Book Form -->
  <div class="row">
    <!-- Preview Image -->
    <div class="col-md-6 text-center mb-3">
      <img src="{{ asset('images/book-placeholder.jpg') }}" alt="Book Image Placeholder" class="img-fluid rounded py-5" id="bookImagePreview">
    </div>

    <!-- Book Details -->
    <div class="col-md-8 col-lg-4">
      <div class="card-body justify-content-start">
        <h4 class="fw-bold text-center py-3">Book Details</h4>
        <hr class="border border-dark w-100">

        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- Title & Genre -->
          <div class="mb-3 row">
            <div class="col-md-5">
              <label for="title" class="form-label">Book Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Book Title" required>
            </div>
            <div class="col-md-5">
              <label for="genre_id" class="form-label">Select Genre</label>
              <select class="form-select" id="genre_id" name="genre_id" required>
                <option value="">Choose</option>
                <option value="1">General</option>
                <option value="2">Philosophy</option>
                <option value="3">History</option>
              </select>
            </div>
          </div>

          <!-- Author & ISBN -->
          <div class="mb-3 row">
            <div class="col-md-5">
              <label for="author_name" class="form-label">Author</label>
              <input type="text" class="form-control" id="author_name" name="author_name" placeholder="Author Name" required>
            </div>
            <div class="col-md-5">
              <label for="isbn" class="form-label">ISBN</label>
              <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN Number" required>
            </div>
          </div>

          <!-- Image Upload -->
          <div class="card mt-4">
            <div class="card-header bg-outline-primary">
              <h5 class="mb-0">Image Upload</h5>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label for="uploadImage" class="form-label">Choose Image</label>
                <input type="file" class="form-control" id="uploadImage" name="uploadImage" accept="image/*" required>
              </div>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="text-center py-3">
            <button type="submit" class="btn btn-primary w-50">Add</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection