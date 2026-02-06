@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Post</h4>

        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="card">
        <div class="card-body">
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

            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- TITLE --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Enter title">
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- CATEGORY --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category *</label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-control">
                            @foreach(['draft','pending_review','scheduled','published','archived'] as $status)
                            <option value="{{ $status }}"
                                {{ $post->status == $status ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- FEATURED --}}
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Featured</label>
                        <select name="featured" class="form-control">
                            <option value="0" {{ $post->featured == false ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $post->featured == true ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    {{-- PUBLISH DATE --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Publish Date (optional)</label>
                        <input type="datetime-local"
                            name="publish_at" class="form-control"
                            value="{{ old('publish_at', $post->publish_at ? \Carbon\Carbon::parse($post->publish_at)->format('Y-m-d\TH:i') : '') }}">
                    </div>

                    {{-- EXCERPT --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Excerpt</label>
                        <textarea name="excerpt" rows="3"
                            class="form-control">{{ old('excerpt', $post->excerpt) }}</textarea>
                    </div>

                    {{-- CONTENT --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" id="editor"
                            rows="10" class="form-control">{{ old('content', $post->content) }}</textarea>
                    </div>

                    {{-- IMAGE --}}
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Featured Image</label>

                        @if($post->featured_image)
                        <div class="mb-2">
                            <img src="{{asset('image/posts')}}/{{ $post->featured_image }}" height="120" class="rounded">
                        </div>
                        @endif

                        <input type="file" name="featured_image" class="form-control">
                        <small class="text-muted">Upload to replace the current image (optional)</small>
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4">Update Post</button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection