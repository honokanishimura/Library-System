@extends('layouts.user')

@section('content')

<!-- Hero Section with Search Form -->
<section class="hero-netflix d-flex align-items-center justify-content-center text-center text-white">
  <div class="overlay"></div>
  <div class="content position-relative z-2">
    <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Welcome to Library Store</h1>
    <p class="lead animate__animated animate__fadeInUp">Find your next favorite book from our collection.</p>

    <form action="{{ route('books.search') }}" method="GET" class="search-form mt-4">
      <div class="row g-2">
        <div class="col-12 col-md-9">
          <input type="text" name="query" class="form-control form-control-lg shadow-sm w-100" placeholder="Title・Author">
        </div>
        <div class="col-12 col-md-3">
          <button type="submit" class="btn btn-warning btn-lg w-100">
            <i class="fa-solid fa-magnifying-glass me-2"></i>Search
          </button>
        </div>
      </div>
    </form>
  </div>
</section>

<!-- Book Listing Section -->
<section class="py-5 bg-white">
  <div class="container">
    <h2 class="all-books-heading text-center mb-5" data-aos="fade-up">
      <i class="fas fa-book-open-reader me-2 text-warning"></i> Discover Our Collection
    </h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
      @foreach ($books as $book)
        <div class="col">
          <div class="card h-100 shadow-sm border-0 rounded-4 d-flex flex-column hover-effect">
            <!-- Book Cover Image -->
            <img src="{{ asset('/assets/images/' . $book->image) }}"
                 alt="{{ $book->title }}"
                 class="w-100"
                 style="height: 230px; object-fit: contain; background-color: #f8f9fa; padding: 10px; border-top-left-radius: 12px; border-top-right-radius: 12px;">

            <div class="card-body d-flex flex-column">
              <!-- Title and Author -->
              <h5 class="card-title mb-1">{{ Str::limit($book->title, 35) }}</h5>
              <p class="text-muted small mb-2">
                <i class="fas fa-user me-1 text-secondary"></i>{{ Str::limit($book->author_name, 25) }}
              </p>

              <!-- Random Rating Display -->
              <p class="mb-2">
                @for ($i = 0; $i < rand(3, 5); $i++)
                  <i class="fas fa-star text-warning"></i>
                @endfor
              </p>

              <!-- Description -->
              <p class="text-muted small flex-grow-1">
                {{ Str::limit($book->description, 70) }}
              </p>

              <!-- Book Status and Return Date -->
              @if ($book->status === '貸出中')
                <span class="badge bg-danger mb-2">On Loan</span>
                @if ($book->return_date)
                  <p class="text-muted small mt-1">
                    <i class="fas fa-calendar-alt me-1 text-secondary"></i>
                    Return Date: {{ \Carbon\Carbon::parse($book->return_date)->format('F j, Y') }}
                  </p>
                @endif
              @else
                <span class="badge bg-success mb-2">Returned</span>
              @endif

              <!-- Action Button -->
              <div class="d-flex justify-content-between align-items-center mt-auto">
                <a href="{{ route('books.details', $book->id) }}" class="btn btn-warning btn-sm">
                  <i class="fas fa-eye me-1"></i> Details
                </a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <nav class="mt-4">
      <ul class="pagination justify-content-center">
        {{ $books->links() }}
      </ul>
    </nav>
  </div>
</section>

@endsection