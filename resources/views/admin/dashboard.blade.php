@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-4">
    <h3>Dashboard</h3>
    <hr class="dashboard-divider">
    <div class="row g-4 mt-3">
        <div class="col-md-4">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-dark">
                <div class="card text-center p-4">
                    <i class="fas fa-user fa-2x mb-3"></i>
                    <p>User Management</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.books.index') }}" class="text-decoration-none text-dark">
                <div class="card text-center p-4">
                    <i class="fas fa-book fa-2x mb-3"></i>
                    <p>Book List</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.borrowing.index') }}" class="text-decoration-none text-dark">
                <div class="card text-center p-4">
                    <i class="fas fa-exchange-alt fa-2x mb-3"></i>
                    <p>Borrowing & Returns</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.genres.index') }}" class="text-decoration-none text-dark">
                <div class="card text-center p-4">
                    <i class="fas fa-tags fa-2x mb-3"></i>
                    <p>Genre Management</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('admin.admins.index') }}" class="text-decoration-none text-dark">
                <div class="card text-center p-4">
                    <i class="fas fa-user-shield fa-2x mb-3"></i>
                    <p>Admin Accounts</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
