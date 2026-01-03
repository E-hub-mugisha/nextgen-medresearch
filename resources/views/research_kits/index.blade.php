@extends('layouts.guest')

@section('title', 'Research Kits')

@section('content')

<!-- Our Core Value Section Start -->
<div class="our-core-value mt-10">
    <div class="container">
        <div class="row align-items-center">

            <div class="container my-5">
                <h2 class="text-center mb-5">Research Kits</h2>

                <div class="row">
                    @forelse($kits as $kit)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100 kit-card">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $kit->title }}</h5>
                                <p class="card-text">{{ Str::limit($kit->description, 100) }}</p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    @if($kit->file_path)
                                    <a href="{{ route('kits.download', $kit->id) }}" class="btn btn-gradient-primary btn-sm">Download</a>
                                    @else
                                    <span class="text-muted">No file</span>
                                    @endif
                                    <a href="{{ route('kits.show', $kit->id) }}" class="btn-default">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-muted">No research kits available.</p>
                    @endforelse
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

    .kit-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .kit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }
</style>

@endsection