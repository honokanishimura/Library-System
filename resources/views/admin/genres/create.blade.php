@extends('layouts.admin')

@section('title', 'Add Genre')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-center py-3">Add New Genre</h2>

    <form action="{{ route('admin.genres.store') }}" method="POST">
        @csrf

        <!-- Genre Name Input -->
        <div class="mb-3">
            <label for="name" class="form-label">Genre Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter genre name" required>
        </div>

        <!-- Action Buttons -->
        <div class="text-center">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Add
            </button>

            <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>
    </form>
</div>
@endsection
