@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')

<div class="container mt-5">
    <h2 class="fw-bold text-center mb-4">Edit User</h2>

    <!-- Edit Form -->
    <div class="card mx-auto shadow-sm p-4 mb-5" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>

                <div class="mb-3">
                    <label for="register" class="form-label">Registration Date</label>
                    <input type="date" class="form-control" id="register" name="register" value="{{ $user->created_at->format('Y-m-d') }}">
                </div>

                <button type="submit" class="fw-bold btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
