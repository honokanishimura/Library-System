@extends('layouts.admin')

@section('title', 'Return Confirmation')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-center mb-4">Return Confirmation</h2>

    <!-- Alert Message -->
    <div class="alert alert-secondary text-center">
        The following items will be returned.
    </div>

    <!-- User Information -->
    <div class="d-flex justify-content-end mb-4">
        <div class="text-end">
            @if ($user)
                <p class="mb-0 fw-bold text-black"><i class="fas fa-id-card"></i> {{ $user->member_number }}</p>
                <p class="mb-1 fw-bold text-black"><i class="fas fa-user"></i> {{ $user->name }}</p>
                <p class="mb-1 fw-bold"><i class="fas fa-phone"></i> {{ $user->phone_number }}</p>
                <p class="mb-0 fw-bold"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            @else
                <p class="text-danger fw-bold">User information not found.</p>
            @endif
        </div>
    </div>

    <!-- Book Return Table -->
    <form method="POST" action="{{ route('admin.return.complete') }}">
        @csrf
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>ISBN</th>
                        <th>Borrowed At</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowedBooks as $record)
                    <tr>
                        <td>
                            <img src="{{ asset('assets/images/' . $record->book->image) }}"
                                 alt="{{ $record->book->title }}"
                                 class="img-thumbnail"
                                 style="width: 60px;">
                        </td>
                        <td class="fw-bold">{{ $record->book->title }}</td>
                        <td>{{ $record->book->author_name }}</td>
                        <td>{{ $record->book->genre->name ?? 'Unknown' }}</td>
                        <td class="text-muted">{{ $record->book->isbn }}</td>
                        <td>{{ $record->borrowed_at->format('Y-m-d') }}</td>
                        <td>{{ $record->due_date->format('Y-m-d') }}</td>
                    </tr>
                    <input type="hidden" name="returned_books_ids[]" value="{{ $record->id }}">
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                Back
            </a>
            <button type="submit" class="btn btn-success fw-bold">
                Confirm Return
            </button>
        </div>
    </form>
</div>
@endsection
