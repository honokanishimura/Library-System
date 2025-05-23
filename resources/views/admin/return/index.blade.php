@extends('layouts.admin')

@section('title', 'Return Confirmation')

@section('content')
<div class="container mt-5">
    <!-- Page Header and User Info -->
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold py-3">Return Confirmation</h2>
        <div class="text-end">
            @if ($user)
                <p class="mb-0 fw-bold text-black"><i class="fas fa-id-card"></i> {{ $user->member_number }}</p>
                <p class="mb-1 fw-bold text-black"><i class="fas fa-user"></i> {{ $user->name }}</p>
                <p class="mb-1 fw-bold"><i class="fas fa-phone"></i> {{ $user->phone_number }}</p>
                <p class="mb-0 fw-bold"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
            @else
                <p class="text-danger fw-bold">User information could not be retrieved.</p>
            @endif
        </div>
    </div>
    <hr class="border border-dark">
</div>

<!-- Return Table and Form -->
<div class="container my-4">
    <form method="POST" action="">
        @csrf

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Select</th>
                        <th>Image</th>
                        <th>Book Info</th>
                        <th>Genre</th>
                        <th>ISBN</th>
                        <th>Borrow/Return</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowedBooks as $record)
                    <tr>
                        <td>
                            <input type="checkbox" name="returned_books_ids[]" value="{{ $record->id }}">
                        </td>
                        <td>
                            <img src="{{ asset('assets/images/' . $record->book->image) }}" 
                                 alt="{{ $record->book->title }}" 
                                 class="img-thumbnail" 
                                 style="width: 60px;">
                        </td>
                        <td class="text-start">
                            <strong>{{ $record->book->title }}</strong><br>
                            <small class="text-muted">{{ $record->book->author_name }}</small>
                        </td>
                        <td>{{ $record->book->genre->name ?? 'Unknown' }}</td>
                        <td class="text-muted">{{ $record->book->isbn }}</td>
                        <td class="text-start">
                            <div class="border rounded p-2 bg-light">
                                <div><strong>Borrowed:</strong> {{ $record->borrowed_at->format('Y-m-d') }}</div>
                                <div class="mt-1">
                                    <strong>Due:</strong>
                                    <input type="date" name="due_date[{{ $record->id }}]" 
                                           value="{{ $record->due_date->format('Y-m-d') }}" 
                                           class="form-control text-center due-date w-auto d-inline-block">
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="{{ $record->returned_at ? 'text-success' : 'text-danger' }}">
                                {{ $record->returned_at ? 'Returned' : 'Not Returned' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end gap-3 mt-4">
            <button type="submit" formaction="{{ route('admin.return.confirm') }}" class="btn btn-danger px-4">
                Confirm Return
            </button>
            <button type="submit" formaction="{{ route('admin.return.updateDueDate') }}" class="btn btn-primary px-4">
                Update Due Date
            </button>
        </div>
    </form>
</div>

<!-- Book Count -->
<div class="container text-end mt-4">
    <p class="fw-bold">Total books: {{ count($borrowedBooks) }}</p>
</div>
@endsection
