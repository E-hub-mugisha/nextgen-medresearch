@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Story Details</h4>
            <small class="text-muted">View story information</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.stories.index') }}" class="btn btn-outline-secondary btn-sm p-3">
                ← Back
            </a>
            <a href="{{ route('admin.stories.edit', $story) }}" class="btn btn-primary btn-sm p-3">
                <i class="bi bi-pencil"></i> Edit
            </a>
        </div>
    </div>

    <div class="row g-4">

        <!-- Left: Main Content -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body p-4">

                    <!-- Image -->
                    @if($story->image)
                    <div class="text-center mb-4">
                        <img
                            src="{{ asset('uploads/stories/' . $story->image) }}"
                            alt="{{ $story->title }}"
                            class="img-fluid rounded"
                            style="max-height: 300px;">
                    </div>
                    @endif

                    <!-- Title -->
                    <h3 class="fw-bold mb-2">{{ $story->title }}</h3>

                    <!-- Name (optional author/person) -->
                    @if($story->name)
                    <p class="text-muted mb-2">
                        <i class="bi bi-person"></i> {{ $story->name }}
                    </p>
                    @endif

                    <!-- Category -->
                    <p class="text-muted mb-4">
                        <i class="bi bi-folder"></i>
                        {{ $story->category->name ?? 'Uncategorized' }}
                    </p>

                    <!-- Story Content -->
                    <div class="mt-4">
                        <h6 class="fw-semibold">Story</h6>
                        <div class="text-muted lh-lg">
                            {{ $story->story ?: 'No story content provided.' }}
                        </div>
                    </div>

                    <!-- Video -->
                    @if($story->video_url)
                    <div class="mt-4">
                        <h6 class="fw-semibold">Video</h6>
                        <a href="{{ $story->video_url }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-play-circle"></i> Watch Video
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

                    <h6 class="fw-semibold mb-3">Story Info</h6>

                    <ul class="list-group list-group-flush small">

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Status</span>
                            <span class="badge 
                                {{ $story->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($story->status) }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Featured</span>
                            @if($story->featured)
                            <span class="badge bg-warning text-dark">Yes</span>
                            @else
                            <span class="badge bg-light text-muted">No</span>
                            @endif
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Created</span>
                            <span>{{ $story->created_at->format('M d, Y') }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Updated</span>
                            <span>{{ $story->updated_at->diffForHumans() }}</span>
                        </li>

                    </ul>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection