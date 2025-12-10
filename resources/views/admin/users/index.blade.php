@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="az-content-title">Users Management</h2>

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
        Add User
    </button>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>There were some errors:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#editUserModal{{ $user->id }}">
                            Edit
                        </button>
                        <button class="btn btn-sm btn-info"
                            data-bs-toggle="modal"
                            data-bs-target="#resetPasswordModal{{ $user->id }}">
                            Reset Password
                        </button>

                        <button class="btn btn-sm btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteUserModal{{ $user->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach ($users as $user)
{{-- Edit Modal --}}
<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label>Password (leave blank to keep same)</label>
                    <input type="password" name="password" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach

@foreach ($users as $user)
{{-- Reset Password Modal --}}
<div class="modal fade" id="resetPasswordModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST"
            action="{{ route('admin.users.resetPassword', $user->id) }}"
            class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Reset Password - {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>New Password *</label>
                    <input type="password"
                        name="password"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label>Confirm New Password *</label>
                    <input type="password"
                        name="password_confirmation"
                        class="form-control"
                        required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Reset Password</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@foreach ($users as $user)
{{-- Delete Modal --}}
<div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="modal-content">
            @csrf
            @method('DELETE')

            <div class="modal-header">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete <b>{{ $user->name }}</b>?
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
</div>
@endforeach
{{-- Add User Modal --}}
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.users.store') }}" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Email *</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password *</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection