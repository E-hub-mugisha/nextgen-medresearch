@extends('layouts.portal')

@section('content')
<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm p-3">
            <h6>Total Requests</h6>
            <h3>{{ $mentee->requestedMentors()->count() }}</h3>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm p-3">
            <h6>Active Projects</h6>
            <h3>{{ $mentee->projects()->where('status','active')->count() }}</h3>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm p-3">
            <h6>Messages</h6>
            <h3>{{ $mentee->unreadMessages()->count() }}</h3>
        </div>
    </div>
</div>

<!-- Recent Mentors / Projects -->
<div class="row mt-4">
    <div class="col-md-6">
        <h5>Available Mentors</h5>
        <div class="list-group">
            @foreach($availableMentors as $mentor)
            <a href="#" class="list-group-item list-group-item-action">
                {{ $mentor->name }} <span class="badge bg-primary float-end">{{ $mentor->mentorProfile->expertise ?? '-' }}</span>
            </a>
            @endforeach
        </div>
    </div>
    <div class="col-md-6">
        <h5>My Projects</h5>
        <div class="list-group">
            @foreach($mentee->projects as $project)
            <a href="#" class="list-group-item list-group-item-action">
                {{ $project->title }} <span class="badge bg-success float-end">{{ ucfirst($project->status) }}</span>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection