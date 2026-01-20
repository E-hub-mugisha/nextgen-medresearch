@extends('layouts.app')
@section('title', 'Programs')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Programs</h4>

        <a href="{{ route('admin.programs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Program
        </a>
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
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($programs as $program)
                    <tr>
                        <td>{{ $program->id }}</td>
                        <td>{{ $program->title }}</td>
                        <td>{{ $program->category->name ?? '-' }}</td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($program->status) }}</span>
                        </td>
                        <td>
                            @if($program->featured)
                            <span class="badge bg-success">Yes</span>
                            @else
                            <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>{{ $program->display_order }}</td>

                        <td>
                            <a href="{{ route('admin.programs.show', $program->id) }}"
                                class="btn btn-sm btn-info">
                                view
                            </a>
                            <a href="{{ route('admin.programs.edit', $program->id) }}"
                                class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.programs.destroy', $program->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Delete this program?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-3">No programs found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection