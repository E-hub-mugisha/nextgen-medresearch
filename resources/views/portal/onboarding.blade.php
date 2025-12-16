@extends('layouts.join')
@section('title', 'Start your journey.')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-3 text-center">Welcome to Research Mentor Portal</h4>
                <p class="text-center text-muted mb-4">Start your journey as a mentor or mentee.</p>

                <a href="{{ route('join') }}" class="btn btn-primary w-100">Get Started</a>
            </div>
        </div>
    </div>
</div>
@endsection
