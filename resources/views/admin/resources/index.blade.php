@extends('layouts.app')

@section('title', 'Resources')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Resources</h3>
    <button class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#createResourceModal">
        <i class="mdi mdi-plus"></i> Add Resource
    </button>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
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

<div class="card shadow-sm p-3">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Downloads</th>
                <th>File</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($resources as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->category->name }}</td>
                <td>
                    <span class="badge bg-info">{{ $item->status }}</span>
                </td>
                <td>{{ $item->download_count }}</td>

                <td>
                    @if($item->file_path)
                    <a href="{{asset('file/resources')}}/{{ $item->file_path }}" target="_blank" class="btn btn-sm btn-secondary">
                        View File
                    </a>
                    @else
                    <span class="text-muted">No file</span>
                    @endif
                </td>

                <td>
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editResourceModal{{ $item->id }}">
                        Edit
                    </button>

                    <form action="{{ route('admin.resources.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this resource?')" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

            {{-- Edit Modal --}}
            <div class="modal fade" id="editResourceModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('admin.resources.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Resource</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $item->title }}" required>
                                </div>

                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">Select...</option>
                                        @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ $item->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="4">{{ $item->description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Upload File (optional)</label>
                                    <input type="file" name="file_path" class="form-control">

                                    @if($item->file_path)
                                    <small class="text-muted">Current File: {{ $item->file_path }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option {{ $item->status == 'draft' ? 'selected' : '' }}>draft</option>
                                        <option {{ $item->status == 'published' ? 'selected' : '' }}>published</option>
                                        <option {{ $item->status == 'archived' ? 'selected' : '' }}>archived</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Update</button>
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>

{{-- Create Modal --}}
<div class="modal fade" id="createResourceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add Resource</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Select...</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Upload File</label>
                        <input type="file" name="file_path" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="draft">draft</option>
                            <option value="published">published</option>
                            <option value="archived">archived</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Resource</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection