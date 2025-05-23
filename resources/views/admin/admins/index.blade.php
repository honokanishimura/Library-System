@extends('layouts.admin')

@section('title', 'Admin Management')

@section('content')

<div class="container mt-5">
  <h2 class="fw-bold container text-center py-3">Admin Management</h2>

  <!-- Add New Admin Button -->
  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.admins.create') }}" class="btn btn-success">
      <i class="fas fa-plus"></i> Add
    </a>
  </div>

  <!-- Success Message -->
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <!-- Admins Table -->
  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Admin Name</th>
        <th>Email</th>
        <th class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>

      <!-- Static Example Admin -->
      <tr>
        <td>Super Administrator</td>
        <td>japan@gmail.com</td>
        <td class="text-center">
          <a href="{{ route('admin.admins.edit', 1) }}" class="btn btn-primary">
            <i class="fas fa-pencil"></i> Edit
          </a>
          <form action="{{ route('admin.admins.destroy', 1) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
              <i class="fas fa-trash"></i> Delete
            </button>
          </form>
        </td>
      </tr>

      <!-- Admins from Database -->
      @foreach ($admins as $admin)
        <tr>
          <td>{{ $admin->name }}</td>
          <td>{{ $admin->email }}</td>
          <td class="text-center">
            <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-primary">
              <i class="fas fa-pencil"></i> Edit
            </a>
            <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
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
