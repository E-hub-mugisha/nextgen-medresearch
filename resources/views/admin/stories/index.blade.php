@extends('layouts.app')
@section('title', 'Stories')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Stories</h4>

        <!-- Add Story Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStoryModal">
            <i class="fas fa-plus"></i> Add Story
        </button>
    </div>

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
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($stories as $story)
                    <tr>
                        <td>{{ $story->id }}</td>
                        <td>{{ $story->title }}</td>
                        <td>{{ $story->category->name ?? '-' }}</td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($story->status) }}</span>
                        </td>
                        <td>
                            @if($story->featured)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editStoryModal{{ $story->id }}">
                                Edit
                            </button>

                            <button class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteStoryModal{{ $story->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@foreach($stories as $story)
    <!-- Edit Modal INCLUDE -->
    @include('admin.stories.modals.edit', ['story' => $story])
    <!-- Delete Modal INCLUDE -->
    @include('admin.stories.modals.delete', ['story' => $story])
@endforeach

<!-- Add Modal INCLUDE -->
@include('admin.stories.modals.create')

@endsection
