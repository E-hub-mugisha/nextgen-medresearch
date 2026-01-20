@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Program Details</h4>
            <small class="text-muted">View full program information</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.programs.index') }}" class="btn btn-outline-secondary btn-sm p-3">
                ← Back
            </a>
            <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-primary btn-sm p-3">
                <i class="bi bi-pencil"></i> Edit
            </a>
        </div>
    </div>

    <div class="row g-4">

        <!-- Left: Main Content -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">

                    <!-- Icon -->
                    @if($program->icon)
                        <div class="mb-4 text-center">
                            <img 
                                src="{{ asset('storage/' . $program->icon) }}" 
                                alt="{{ $program->title }}"
                                class="img-fluid rounded"
                                style="max-height: 220px;"
                            >
                        </div>
                    @endif

                    <!-- Title -->
                    <h3 class="fw-bold mb-2">{{ $program->title }}</h3>

                    <!-- Category -->
                    <p class="text-muted mb-3">
                        <i class="bi bi-folder"></i>
                        {{ $program->category->name ?? 'Uncategorized' }}
                    </p>

                    <!-- Description -->
                    <div class="mt-4">
                        <h6 class="fw-semibold">Description</h6>
                        <p class="text-muted mb-0">
                            {{ $program->description ?? 'No description provided.' }}
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <!-- Right: Meta Info -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h6 class="fw-semibold mb-3">Program Info</h6>

                    <ul class="list-group list-group-flush small">

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Status</span>
                            <span class="badge 
                                {{ $program->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($program->status) }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Featured</span>
                            @if($program->featured)
                                <span class="badge bg-warning text-dark">Yes</span>
                            @else
                                <span class="badge bg-light text-muted">No</span>
                            @endif
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Display Order</span>
                            <span>{{ $program->display_order ?? 0 }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Slug</span>
                            <span class="text-muted">{{ $program->slug }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Created</span>
                            <span>{{ $program->created_at->format('M d, Y') }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Last Updated</span>
                            <span>{{ $program->updated_at->diffForHumans() }}</span>
                        </li>

                    </ul>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
