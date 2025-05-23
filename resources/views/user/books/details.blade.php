@extends('layouts.user')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10 col-md-12 shadow-lg p-4 p-md-5 rounded bg-light">
      <div class="row g-4 align-items-center">

        <!-- Book Image -->
        <div class="col-md-4 text-center">
          <img src="{{ asset('/assets/images/' . $book->image) }}"
               alt="{{ $book->title }}"
               class="img-fluid rounded shadow-sm"
               style="max-height: 300px; object-fit: cover;">
        </div>

        <!-- Book Information -->
        <div class="col-md-8">
          <h2 class="fw-bold mb-3 border-bottom pb-2">{{ $book->title }}</h2>

          <ul class="list-unstyled text-muted">
            <li class="mb-2">
              <i class="fas fa-user me-2 text-primary"></i>
              Author: {{ $book->author_name }}
            </li>
            <li class="mb-2">
              <i class="fas fa-book me-2 text-primary"></i>
              ISBN: {{ $book->isbn }}
            </li>
            <li class="mb-2">
              <i class="fas fa-tags me-2 text-primary"></i>
              Genre: {{ $book->genre->name ?? 'Not Set' }}
            </li>
            <li class="mb-3">
              <i class="fas fa-info-circle me-2 text-primary"></i>
              Description: {{ $book->description }}
            </li>
          </ul>

          @php
            $latestBorrow = $book->borrowRecords->sortByDesc('borrowed_at')->first();
          @endphp

          <!-- Book Status -->
          <div class="mb-4">
            @if($book->status === '貸出中')
              <span class="badge bg-warning text-dark">On Loan</span>
              <p class="text-muted mt-2 mb-0">
                Return Due Date:
                {{ $latestBorrow && $latestBorrow->due_date ? $latestBorrow->due_date->format('Y/m/d') : 'Not Set' }}
              </p>
            @else
              <span class="badge bg-success">Returned</span>
            @endif
          </div>

          <!-- Navigation Buttons -->
          <div class="d-flex flex-column flex-md-row gap-3 mt-3">
            <a href="{{ route('books.search') }}" class="btn btn-outline-primary w-100 w-md-auto">
              <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
            <a href="{{ route('home') }}" class="btn btn-secondary w-100 w-md-auto">
              <i class="fas fa-home me-1"></i> Back to Home
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection