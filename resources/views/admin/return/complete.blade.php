@extends('layouts.admin')

@section('title', 'Return Complete')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <!-- Success Icon -->
        <i class="fas fa-check-circle text-success" style="font-size: 64px;"></i>

        <!-- Title and Message -->
        <h2 class="mt-4">Return Completed</h2>
        <p class="mt-3">The return process was successfully completed.</p>

        <!-- Action Buttons -->
        <div class="mt-5">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary me-3">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                <i class="fas fa-users"></i> User List
            </a>
        </div>
    </div>
</div>
@endsection
