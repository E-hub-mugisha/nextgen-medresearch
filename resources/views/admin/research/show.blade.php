{{-- resources/views/admin/research/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="mb-3 d-flex justify-content-between align-items-center">
    <h4>Research Details</h4>
    <a href="{{ route('admin.research.index') }}" class="btn btn-secondary">Back to List</a>
</div>

<div class="row">
    <!-- Left Column: Info -->
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">Basic Information</div>
            <div class="card-body">
                <p><strong>Title:</strong> {{ $research->title }}</p>
                <p><strong>Category:</strong> {{ $research->category->name ?? '-' }}</p>
                <p><strong>Status:</strong> {{ ucfirst($research->status) }}</p>
                <p><strong>Featured:</strong> {{ $research->featured ? 'Yes' : 'No' }}</p>
                <p><strong>Views:</strong> {{ $research->view_count }}</p>
                <p><strong>Downloads:</strong> {{ $research->download_count }}</p>
                <hr>
                <p><small>Created by: {{ $research->creator->name ?? 'N/A' }}</small></p>
                <p><small>Updated by: {{ $research->updater->name ?? 'N/A' }}</small></p>
                <p><small>Created at: {{ $research->created_at->format('d M Y, H:i') }}</small></p>
                <p><small>Updated at: {{ $research->updated_at->format('d M Y, H:i') }}</small></p>
            </div>
        </div>
    </div>

    <!-- Right Column: Content -->
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-success text-white">Research Content</div>
            <div class="card-body">
                <h6>Summary</h6>
                <p>{{ $research->summary ?? '-' }}</p>

                <h6>Content</h6>
                <p>{!! nl2br(e($research->content)) !!}</p>

                @if($research->document)
                    <p><strong>Document:</strong> 
                        <a href="{{asset('file/researches')}}/{{ $research->document }}" target="_blank" class="btn btn-sm btn-outline-primary">Download</a>
                    </p>
                @endif

                @if($research->featured_image)
                    <p><strong>Featured Image:</strong></p>
                    <img src="{{asset('image/researches')}}/{{ $research->featured_image }}" class="img-fluid rounded" alt="Featured Image">
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
