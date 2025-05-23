@extends('layouts.admin')

@section('title', 'User Details')

@section('content')

<div class="container mt-5">
    <h2 class="fw-bold text-center mb-4">User Details</h2>

    <!-- User Profile Card -->
    <div class="card mx-auto shadow-sm mb-5" style="max-width: 600px;">
        <div class="card-header bg-dark text-white text-center">
            <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
        </div>
        <div class="card-body p-4">
            <p><strong>Member ID:</strong> {{ $user->member_number }}</p>
            <p><strong>Phone:</strong> {{ $user->phone }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Registered:</strong> {{ $user->created_at->format('Y-m-d') }}</p>
        </div>
    </div>

    <!-- Borrow History Section -->
    <h3 class="text-center mb-4">Borrow History</h3>

    @if ($borrowRecords->isEmpty())
        <div class="alert alert-info text-center">No borrow records found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Borrowed Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrowRecords as $record)
                        <tr>
                            <td>
                                <img src="{{ asset('assets/images/' . $record->book->image) }}" alt="{{ $record->book->title }}" class="img-thumbnail" style="width: 60px; height: auto;">
                            </td>
                            <td>{{ $record->book->isbn }}</td>
                            <td>{{ $record->book->title }}</td>
                            <td>{{ $record->borrowed_at->format('Y-m-d') }}</td>
                            <td>{{ $record->due_date->format('Y-m-d') }}</td>
                            <td>
                                @if ($record->returned_at)
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
    @endif
</div>

@endsection
