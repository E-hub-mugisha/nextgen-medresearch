@extends('layouts.app')
@section('title', 'Testimonials')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Testimonials</h4>

        <!-- Add Testimonial Button -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
            <i class="fas fa-plus"></i> Add Testimonial
        </button>
    </div>

    <div class="card">
        <div class="card-body p-0">
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

            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Organization</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($testimonials as $testimonial)
                    <tr>
                        <td>{{ $testimonial->id }}</td>
                        <td>{{ $testimonial->name }}</td>
                        <td>{{ $testimonial->role ?? '-' }}</td>
                        <td>{{ $testimonial->organization ?? '-' }}</td>
                        <td>{{ $testimonial->rating ?? '-' }}</td>
                        <td>
                            <span class="badge bg-info">{{ ucfirst($testimonial->status) }}</span>
                        </td>
                        <td>
                            @if($testimonial->featured)
                            <span class="badge bg-success">Yes</span>
                            @else
                            <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#editTestimonialModal{{ $testimonial->id }}">
                                Edit
                            </button>

                            <button class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteTestimonialModal{{ $testimonial->id }}">
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

@foreach($testimonials as $testimonial)
<!-- Edit Modal INCLUDE -->
@include('admin.testimonials.modals.edit', ['testimonial' => $testimonial])
<!-- Delete Modal INCLUDE -->
@include('admin.testimonials.modals.delete', ['testimonial' => $testimonial])
@endforeach

<!-- Add Modal INCLUDE -->
@include('admin.testimonials.modals.create')

@endsection