@extends('layouts.admin')
@section('title', 'Bulk Book Upload')

@section('content')
<div class="container mt-5">
  <h2 class="text-center py-3"><strong>Bulk Book Upload</strong></h2>
  <hr class="border border-dark w-100">

  <form action="{{ route('admin.books.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="csvFile" class="form-label">Select CSV file</label>
      <input type="file" class="form-control" id="csvFile" name="csvFile" accept=".csv" required>
      <div class="invalid-feedback">Please select a CSV file.</div>
    </div>
    <div class="d-flex justify-content-end py-3">
      <button type="submit" class="fw-bold btn btn-primary">
        <i class="fas fa-upload" style="color: white;"></i> Upload
      </button>
    </div>
  </form>

  <!-- Preview Table -->
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>Title</th>
          <th>Genre</th>
          <th>Author</th>
          <th>ISBN</th>
          <th>Image</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Yabai Nihonshi</td>
          <td>History</td>
          <td>Ryunosuke Akutagawa</td>
          <td>123-1234567</td>
          <td>
            <img src="{{ asset('images/book1.jpg') }}" alt="Book Image" class="img-thumbnail" style="width: 80px; height: auto;">
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection