@extends('layouts.app')

@section('content')

<style>
    .aspect-ratio {
    width: 400px;
    aspect-ratio: 4000 / 2667;
}

.aspect-ratio img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
<div class="container my-5">

    <div class="row justify-content-center">
        <div class="col-lg-12">

            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary btn-sm">
                    ← Back to Posts
                </a>
            </div>

            <!-- Post Card -->
            <div class="card shadow-sm border-0">

                <!-- Featured Image -->
                @if($post->featured_image)
                    <img 
                        src="{{asset('image/posts')}}/{{ $post->featured_image }}" 
                        class="card-img-top rounded-top"
                        alt="{{ $post->title }}"
                    >
                @endif

                <div class="card-body p-4 p-lg-5">

                    <!-- Category & Status -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-primary">
                            {{ $post->category?->name ?? 'Uncategorized' }}
                        </span>

                        <span class="badge 
                            {{ $post->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="fw-bold mb-3">
                        {{ $post->title }}
                    </h1>

                    <!-- Meta Info -->
                    <div class="text-muted mb-4 d-flex flex-wrap gap-3 small">
                        <span>
                            <i class="bi bi-person"></i>
                            {{ $post->author?->name ?? 'Unknown Author' }}
                        </span>

                        <span>
                            <i class="bi bi-calendar-event"></i>
                            {{ $post->publish_at?->format('M d, Y') ?? $post->created_at->format('M d, Y') }}
                        </span>

                        @if($post->featured)
                            <span class="badge bg-warning text-dark">
                                ⭐ Featured
                            </span>
                        @endif
                    </div>

                    <!-- Excerpt -->
                    @if($post->excerpt)
                        <div class="alert alert-light border-start border-4 border-primary">
                            <strong>Summary</strong><br>
                            {!! $post->excerpt !!}
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="post-content fs-6 lh-lg">
                        {!! $post->content !!}
                    </div>

                </div>

                <!-- Footer Actions -->
                <div class="card-footer bg-white border-top d-flex justify-content-between align-items-center px-4 py-3">

                    <small class="text-muted">
                        Created {{ $post->created_at->diffForHumans() }}
                        @if($post->updated_at)
                            • Updated {{ $post->updated_at->diffForHumans() }}
                        @endif
                    </small>

                    @can('update', $post)
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endcan

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
