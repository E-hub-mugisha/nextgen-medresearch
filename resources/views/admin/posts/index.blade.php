@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="az-content-title">Posts</h2>

    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add Post</a>
</div>

@if (session('success'))
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

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Featured</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Publish At</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>

                    <td>
                        @if ($post->featured_image)
                        <img src="{{ asset('storage/'.$post->featured_image) }}" width="50" height="40" style="object-fit: cover">
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                    </td>

                    <td>{{ $post->title }}</td>

                    <td>{{ $post->category->name ?? '-' }}</td>

                    <td>
                        <span class="badge bg-secondary">{{ $post->status }}</span>
                    </td>

                    <td>{{ $post->publish_at ? $post->publish_at : '-' }}</td>

                    <td>
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete post?')" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $posts->links() }}
        </div>
    </div>
</div>

@endsection
