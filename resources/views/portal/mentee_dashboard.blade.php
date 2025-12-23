@extends('layouts.portal')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">Welcome, {{ $mentee->name }}</h3>

    <!-- Active Requests -->
    <div class="mb-4">
        <h5>My Requests</h5>
        <div class="row">
            @foreach($requestedMentors as $mentor)
            <div class="col-md-4 mb-3">
                <div class="card p-3 shadow-sm">
                    <h6>{{ $mentor->name }}</h6>
                    <p>{{ $mentor->mentorProfile->expertise ?? '-' }}</p>
                    <span class="badge bg-warning">{{ ucfirst($mentor->pivot->status) }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Available Mentors -->
    <div class="mb-4">
        <h5>Available Mentors</h5>
        <div class="row">
            @foreach($availableMentors as $mentor)
            <div class="col-md-4 mb-3">
                <div class="card p-3 shadow-sm">
                    <h6>{{ $mentor->name }}</h6>
                    <p>{{ $mentor->mentorProfile->expertise ?? '-' }}</p>
                    <a href="#" class="btn btn-gradient-primary btn-sm">View Profile</a>
                </div>
            </div>
            @endforeach
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