@extends('layouts.app')

@section('title','Projects')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Projects</h3>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
        <i class="mdi mdi-plus"></i> Add Project
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card p-3 shadow-sm">
    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Banner</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>
                    @if($project->banner)
                        <img src="{{ asset('uploads/projects/'.$project->banner) }}" width="70" class="rounded shadow-sm">
                    @else
                        <span class="text-muted">No banner</span>
                    @endif
                </td>

                <td>{{ $project->title }}</td>
                <td>{{ $project->category->name ?? '-' }}</td>
                <td>{{ ucfirst($project->status) }}</td>
                <td>
                    @if($project->featured)
                        <span class="badge bg-success">Yes</span>
                    @else
                        <span class="badge bg-secondary">No</span>
                    @endif
                </td>
                <td>{{ $project->display_order }}</td>

                <td>
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.projects.destroy',$project->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this project?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
