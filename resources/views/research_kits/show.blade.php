@extends('layouts.guest')
@section('title', 'Research Kit Details')
@section('content')

<!-- Our Core Value Section Start -->
<div class="our-core-value mt-10">
    <div class="container">
        <div class="row align-items-center">
            <div class="container my-5">

                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <div class="card shadow-lg p-4">

                            <div class="mb-3">
                                <a href="{{ route('kits.index') }}" class="text-decoration-none text-muted">
                                    ← Back to Research Kits
                                </a>
                            </div>

                            <h2 class="mb-3">{{ $kit->title }}</h2>

                            <span class="badge 
                    {{ $kit->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($kit->status) }}
                            </span>

                            <hr>

                            <div class="mb-4">
                                <h5>Description</h5>
                                <p class="text-muted">
                                    {{ $kit->description ?? 'No description provided for this research kit.' }}
                                </p>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-muted">Display Order</h6>
                                <p>{{ $kit->display_order }}</p>
                            </div>

                            @if($kit->file_path)
                            <div class="d-flex gap-3">
                                <a href="{{ route('kits.download', $kit->id) }}"
                                    class="btn btn-gradient-primary">
                                    Download Kit
                                </a>

                                <a href="{{ asset($kit->file_path) }}" target="_blank"
                                    class="btn btn-outline-secondary">
                                    Preview File
                                </a>
                            </div>
                            @else
                            <div class="alert alert-warning">
                                No downloadable file attached to this research kit.
                            </div>
                            @endif

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<style>
    .btn-gradient-primary {
        background: linear-gradient(90deg, #4e54c8, #8f94fb);
        color: #fff;
        border: none;
    }

    .btn-gradient-primary:hover {
        opacity: 0.9;
    }
</style>
@endsection