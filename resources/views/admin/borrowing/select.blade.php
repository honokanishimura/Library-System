@extends('layouts.admin')

@section('title', 'Lending Management')

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-center py-3 fw-bold">Lending Management</h2>

        <!-- Logged-in user information -->
        <div>
            @isset($user)
                <p class="mb-0 fw-bold text-black"><i class="fas fa-id-card"></i> {{ $user->member_number }}</p>
                <p class="mb-1 fw-bold text-black"><i class="fas fa-user"></i> {{ $user->name }}</p>
                <p class="mb-1 fw-bold"><i class="fas fa-phone"></i> {{ $user->phone_number }}</p>
                <p class="mb-0 fw-bold"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            @else
                <p>No user information available.</p>
            @endisset
        </div>
    </div>

    <hr class="border border-dark w-100">
</div>

<!-- ISBN search form -->
<section class="container my-4">
    <h4>Search by ISBN</h4>
    <form class="d-flex">
        <input type="text" class="form-control me-2" placeholder="e.g. 978-....">
        <button type="submit" class="fw-bold btn btn-warning">Search</button>
    </form>
</section>

<!-- Search results -->
<section class="mb-5">
    <h5 class="text-center mb-3">Search Results</h5>
    <div class="container">
        <div class="row g-3">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>ISBN</th>
                            <th>Status</th>
                            <th>Return Due Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($books)
                            @foreach($books as $book)
                                <tr>
                                    @if(is_object($book))
                                        <td>
                                            <img src="{{ asset('assets/images/' . $book->image) }}" 
                                                 alt="{{ $book->title }}" 
                                                 class="img-thumbnail" 
                                                 style="width: 60px; height: auto;">
                                        </td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author_name }}</td>
                                        <td>{{ $book->genre->name ?? 'Unknown' }}</td>
                                        <td>{{ $book->isbn }}</td>
                                        <td>{{ $book->status }}</td>
                                        <td>{{ $book->return_date }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.borrowing.addBook', ['book_id' => $book->id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Add</button>
                                            </form>
                                        </td>
                                    @else
                                        <td colspan="8" class="text-center">Invalid data format</td>
                                    @endif
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Next button -->
<div class="d-flex justify-content-center align-items-center mb-3">
    <a href="{{ route('admin.borrowing.list') }}" class="btn btn-primary">Next</a>
</div>

@endsection
