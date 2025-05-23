@extends('layouts.user')

@section('content')

<section class="py-5 bg-light">
  <div class="container">

    <!-- Search Title and Query Display -->
    <h2 class="text-center mb-4 fs-2">
      <i class="fas fa-book-open-reader text-warning me-2"></i>
      All Books
      @if(request('query'))
        for “<strong>{{ request('query') }}</strong>”
      @endif
    </h2>

    <!-- Search Form -->
    <div class="card shadow-sm mb-5 border-0 rounded-4">
      <div class="card-body">
        <form action="{{ route('books.search') }}" method="GET" class="d-flex flex-column flex-md-row gap-2">
          <input
            type="text"
            name="query"
            class="form-control"
            placeholder="Search by title, author..."
            value="{{ request('query') }}"
          >
          <button type="submit" class="btn btn-warning px-4">
            <i class="fas fa-search me-1"></i>
          </button>
        </form>
      </div>
    </div>

    <!-- Book Cards (Horizontal Layout) -->
    <div class="row g-4">
      @forelse ($books as $book)
        <div class="col-12 col-md-6">
          <div class="card shadow-sm border-0 d-flex flex-row overflow-hidden rounded-4 h-100">

            <!-- Book Image -->
            <div class="bg-light d-flex align-items-center justify-content-center" style="min-width: 150px;">
              <img
                src="{{ asset('/assets/images/' . $book->image) }}"
                alt="{{ $book->title }}"
                class="img-fluid p-2"
                style="max-height: 180px; object-fit: contain;"
              >
            </div>

            <!-- Book Info -->
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ $book->title }}</h5>
              <p class="text-muted small mb-1">
                <i class="fas fa-user me-1"></i>{{ $book->author_name }}
              </p>
              <p class="text-muted small flex-grow-1">
                {{ Str::limit($book->description, 80) }}
              </p>

              <!-- Status Badge and Details Button -->
              <div class="d-flex justify-content-between align-items-center mt-auto">
                @if ($book->status === '貸出中')
                  <span class="badge bg-warning text-dark">On Loan</span>
                @else
                  <span class="badge bg-success">Returned</span>
                @endif

                <a href="{{ route('books.details', $book->id) }}" class="btn btn-outline-primary btn-sm">
                  <i class="fas fa-eye me-1"></i>Details
                </a>
              </div>
            </div>

          </div>
        </div>
      @empty
        <p class="text-center text-muted">No books found.</p>
      @endforelse
    </div>

    <!-- Pagination -->
    <nav class="mt-5">
      <ul class="pagination justify-content-center">
        {{ $books->links() }}
      </ul>
    </nav>

  </div>
</section>

@endsection
