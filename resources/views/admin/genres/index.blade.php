@extends('layouts.admin')

@section('title', 'Genre Management')

@section('content')

<div class="container mt-5">
    <h2 class="fw-bold text-center py-3">Genre Management</h2>

    <!-- Add Genre Button -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.genres.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add
        </a>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Genre Table -->
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Genre Name</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Predefined Genres -->
            <tr>
                <td>General</td>
                <td class="text-center">
                    <a href="{{ route('admin.genres.edit', 1) }}" class="btn btn-primary">
                        <i class="fas fa-pencil"></i> Edit
                    </a>
                    <form action="{{ route('admin.genres.destroy', 1) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>

            <tr>
                <td>Philosophy</td>
                <td class="text-center">
                    <a href="{{ route('admin.genres.edit', 2) }}" class="btn btn-primary">
                        <i class="fas fa-pencil"></i> Edit
                    </a>
                    <form action="{{ route('admin.genres.destroy', 2) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>

            <tr>
                <td>History</td>
                <td class="text-center">
                    <a href="{{ route('admin.genres.edit', 3) }}" class="btn btn-primary">
                        <i class="fas fa-pencil"></i> Edit
                    </a>
                    <form action="{{ route('admin.genres.destroy', 3) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>

            <!-- Genres from DB -->
            @foreach ($genres as $genre)
            <tr>
                <td>{{ $genre->name }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.genres.edit', $genre->id) }}" class="btn btn-primary">
                        <i class="fas fa-pencil"></i> Edit
                    </a>
                    <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
