@extends('layouts.admin')

@section('title', 'User Management')

@section('content')

<div class="container mt-5">
    <h2 class="fw-bold text-center py-3">User Management</h2>
</div>

<!-- Search Form -->
<form class="mb-4">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search by member number, name, email, or phone number">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i> Search
        </button>
    </div>
</form>

<!-- User List -->
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Member ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Registered At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->member_number }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.users.details', ['id' => $user->id]) }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-eye"></i> View
                    </a>

                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>

                    <a href="{{ route('admin.users.history', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-book"></i> History
                    </a>

                    <a href="{{ route('admin.return.index', ['id' => $user->id]) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-undo-alt"></i> Returns
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
