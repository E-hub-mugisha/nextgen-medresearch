@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Project Details</h4>
            <small class="text-muted">View project information</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm p-3">
                ← Back
            </a>
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary btn-sm p-3">
                <i class="bi bi-pencil"></i> Edit
            </a>
        </div>
    </div>

    <div class="row g-4">

        <!-- Left: Main Content -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">

                    <!-- Banner -->
                    @if($project->banner)
                        <div class="mb-4">
                            <img
                                src="{{ asset('storage/' . $project->banner) }}"
                                alt="{{ $project->title }}"
                                class="img-fluid rounded w-100"
                                style="max-height: 320px; object-fit: cover;"
                            >
                        </div>
                    @endif

                    <!-- Title -->
                    <h3 class="fw-bold mb-2">{{ $project->title }}</h3>

                    <!-- Category -->
                    <p class="text-muted mb-3">
                        <i class="bi bi-folder"></i>
                        {{ $project->category->name ?? 'Uncategorized' }}
                    </p>

                    <!-- Summary -->
                    @if($project->summary)
                        <div class="alert alert-light border-start border-4 border-primary">
                            <strong>Summary</strong><br>
                            {{ $project->summary }}
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="mt-4">
                        <h6 class="fw-semibold">Description</h6>
                        <p class="text-muted mb-0">
                            {{ $project->description ?: 'No description provided.' }}
                        </p>
                    </div>

                    <!-- Project Link -->
                    @if($project->project_link)
                        <div class="mt-4">
                            <a href="{{ $project->project_link }}" target="_blank"
                               class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-box-arrow-up-right"></i> View Project
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- Right: Meta Info -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <h6 class="fw-semibold mb-3">Project Info</h6>

                    <ul class="list-group list-group-flush small">

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Status</span>
                            <span class="badge
                                @switch($project->status)
                                    @case('published') bg-success @break
                                    @case('in_progress') bg-info @break
                                    @case('draft') bg-secondary @break
                                    @default bg-dark
                                @endswitch
                            ">
                                {{ ucwords(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Featured</span>
                            @if($project->featured)
                                <span class="badge bg-warning text-dark">Yes</span>
                            @else
                                <span class="badge bg-light text-muted">No</span>
                            @endif
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Display Order</span>
                            <span>{{ $project->display_order ?? 0 }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Created</span>
                            <span>{{ $project->created_at->format('M d, Y') }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Updated</span>
                            <span>{{ $project->updated_at->diffForHumans() }}</span>
                        </li>

                    </ul>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
