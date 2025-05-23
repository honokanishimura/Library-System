@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fw-bold py-3">{{ $user->name }}'s Borrowing History</h2>
        <div class="text-end">
            @if ($user)
                <p class="mb-0 fw-bold text-black"><i class="fas fa-id-card"></i> Member ID: {{ $user->member_number }}</p>
                <p class="mb-1 fw-bold text-black"><i class="fas fa-user"></i> Name: {{ $user->name }}</p>
                <p class="mb-1 fw-bold"><i class="fas fa-phone"></i> Phone: {{ $user->phone_number }}</p>
                <p class="mb-0 fw-bold"><i class="fas fa-envelope"></i> Email: {{ $user->email }}</p>
            @else
                <p class="text-danger fw-bold">User information not found.</p>
            @endif
        </div>
    </div>
    <hr class="border border-dark">
</div>

<div class="container my-4">
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Borrowed At</th>
                    <th>Due Date</th>
                    <th>Returned At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowedBooks as $borrowRecord)
                    <tr>
                        <td>
                            <img src="{{ asset('assets/images/' . $borrowRecord->book->image) }}" 
                                 alt="{{ $borrowRecord->book->title }}" 
                                 class="img-thumbnail" 
                                 style="width: 60px; height: auto;">
                        </td>
                        <td class="text-start">
                            <strong>{{ $borrowRecord->book->title ?? 'Unknown' }}</strong>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($borrowRecord->borrowed_at)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($borrowRecord->due_date)->format('Y-m-d') }}</td>
                        <td>
                            {{ $borrowRecord->returned_at 
                                ? \Carbon\Carbon::parse($borrowRecord->returned_at)->format('Y-m-d') 
                                : 'Not Returned' }}
                        </td>
                        <td>
                            @if ($borrowRecord->returned_at)
                                <span class="badge bg-success">Returned</span>
                            @else
                                <span class="badge bg-warning text-dark">Borrowed</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $borrowedBooks->links() }}
    </div>

    <div class="text-end mt-3">
        <a href="{{ route('mypage.current') }}" class="btn btn-secondary">Back to Current Borrowings</a>
    </div>
</div>

<div class="container mt-5">
    <h4 class="fw-bold">Borrowing Statistics</h4>
    <ul class="list-group">
        <li class="list-group-item">Total Borrowed: {{ $totalBorrowed }} books</li>
        <li class="list-group-item">Currently Borrowed: {{ $currentlyBorrowed }} books</li>
    </ul>
</div>
@endsection
