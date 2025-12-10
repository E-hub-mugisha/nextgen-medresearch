@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="az-content-title">Categories</h2>

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        Add Category
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
                    <th>Slug</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->slug }}</td>
                    <td>{{ $cat->type ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $cat->status == 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($cat->status) }}
                        </span>
                    </td>
                    <td>{{ $cat->created_at->format('Y-m-d') }}</td>

                    <td>
                        <button class="btn btn-sm btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#editCategoryModal{{ $cat->id }}">
                            Edit
                        </button>

                        <button class="btn btn-sm btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteCategoryModal{{ $cat->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach ($categories as $cat)

{{-- Edit Modal --}}
<div class="modal fade" id="editCategoryModal{{ $cat->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.categories.update', $cat->id) }}" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Name *</label>
                    <input type="text" name="name" value="{{ $cat->name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Type</label>
                    <input type="text" name="type" value="{{ $cat->type }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control">{{ $cat->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $cat->status=='active'?'selected':'' }}>Active</option>
                        <option value="inactive" {{ $cat->status=='inactive'?'selected':'' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@foreach ($categories as $cat)
{{-- Delete Modal --}}
<div class="modal fade" id="deleteCategoryModal{{ $cat->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" class="modal-content">
            @csrf
            @method('DELETE')

            <div class="modal-header">
                <h5 class="modal-title">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete <strong>{{ $cat->name }}</strong>?
            </div>

            <div class="modal-footer">
                <button class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- Add Category Modal --}}
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Type</label>
                    <input type="text" name="type" class="form-control" placeholder="post, program, resource...">
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection