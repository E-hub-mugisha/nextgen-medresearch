@extends('layouts.portal')
@section('title', 'Dashboard')

@section('content')

{{-- Welcome Banner --}}
<div class="welcome-banner">
    <div>
        <h5 class="mb-1">Welcome back, {{ auth()->user()->name }}! 👋</h5>
        <p class="mb-0">
            You have
            <strong>{{ $stats['open_requests'] }} pending requests</strong>
            and
            <strong>{{ $upcomingMilestones->count() }} upcoming milestones.</strong>
        </p>
    </div>
    <a href="#requests" class="btn-banner">View Requests</a>
</div>

{{-- Stats Row --}}
<div class="stats-row">
    <div class="stat-card">
        <span class="stat-label">My Projects</span>
        <span class="stat-value">{{ $stats['projects'] }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Collaborators</span>
        <span class="stat-value">{{ $stats['collaborators'] }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Milestones Done</span>
        <span class="stat-value">{{ $stats['milestones_done'] }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Open Requests</span>
        <span class="stat-value text-danger">{{ $stats['open_requests'] }}</span>
    </div>
</div>

{{-- Main Grid --}}
<div class="dashboard-grid">

    {{-- My Projects --}}
    <div class="panel">
        <div class="panel-header">
            <span>My Projects</span>
            <a href="{{ route('portal.projects.index') }}">View all →</a>
        </div>
        <div class="panel-body">
            @forelse($myProjects as $project)
            <div class="project-row">
                <div class="project-icon">
                    {{ strtoupper(substr($project->title, 0, 1)) }}
                </div>
                <div class="project-details">
                    <a href="{{ route('portal.projects.show', $project) }}" class="project-title">
                        {{ $project->title }}
                    </a>
                    <span class="project-meta">
                        {{ $project->collaborators_count }} collaborators
                        · {{ $project->milestones_count }} milestones
                    </span>
                </div>
                <span class="status-badge status-{{ $project->status }}">
                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                </span>
            </div>
            @empty
            <p class="text-muted text-center py-3" style="font-size:13px;">
                No projects yet.
                <a href="{{ route('portal.projects.create') }}">Create your first one →</a>
            </p>
            @endforelse
        </div>
    </div>

    {{-- Pending Requests --}}
    <div class="panel" id="requests">
        <div class="panel-header">
            <span>Collaboration Requests</span>
            <a href="#">See all →</a>
        </div>
        <div class="panel-body">
            @forelse($pendingRequests as $req)
            <div class="request-row">
                <div class="req-avatar">
                    {{ strtoupper(substr($req->name, 0, 2)) }}
                </div>
                <div class="req-details">
                    <span class="req-name">{{ $req->name }}</span>
                    <span class="req-project">Wants to join · {{ $req->project_title }}</span>
                </div>
                <div class="req-actions">
                    <form method="POST"
                          action="{{ route('portal.collaborators.accept', ['project' => $req->project_id, 'user' => $req->user_id]) }}"
                          style="display:inline;">
                        @csrf @method('PATCH')
                        <button class="btn-accept">Accept</button>
                    </form>
                    <form method="POST"
                          action="{{ route('portal.collaborators.reject', ['project' => $req->project_id, 'user' => $req->user_id]) }}"
                          style="display:inline;">
                        @csrf @method('PATCH')
                        <button class="btn-reject">Reject</button>
                    </form>
                </div>
            </div>
            @empty
            <p class="text-muted text-center py-3" style="font-size:13px;">
                No pending requests.
            </p>
            @endforelse
        </div>
    </div>

    {{-- Upcoming Milestones --}}
    <div class="panel">
        <div class="panel-header">
            <span>Upcoming Milestones</span>
            <a href="#">View all →</a>
        </div>
        <div class="panel-body">
            @forelse($upcomingMilestones as $milestone)
            <div class="milestone-row">
                <div class="ms-check {{ $milestone->status === 'done' ? 'done' : '' }}">
                    @if($milestone->status === 'done')
                        <i class="bi bi-check"></i>
                    @endif
                </div>
                <span class="ms-title {{ $milestone->status === 'done' ? 'done' : '' }}">
                    {{ $milestone->title }}
                </span>
                <span class="ms-due {{ $milestone->due_date?->isPast() ? 'overdue' : '' }}">
                    {{ $milestone->due_date?->format('M d') ?? '—' }}
                </span>
            </div>
            @empty
            <p class="text-muted text-center py-3" style="font-size:13px;">
                No upcoming milestones.
            </p>
            @endforelse
        </div>
    </div>

    {{-- Suggested Mentors / Mentees --}}
    <div class="panel">
        <div class="panel-header">
            <span>Suggested {{ auth()->user()->role === 'mentee' ? 'Mentors' : 'Mentees' }}</span>
            <a href="{{ route('portal.projects.discover') }}">Discover →</a>
        </div>
        <div class="panel-body">
            @forelse($suggested as $person)
            <div class="person-row">
                <div class="person-avatar">
                    {{ strtoupper(substr($person->name, 0, 2)) }}
                </div>
                <div class="person-info">
                    <span class="person-name">{{ $person->name }}</span>
                    <span class="person-role">
                        @if($person->role === 'mentor' && $person->mentorProfile)
                            {{ $person->mentorProfile->expertise }}
                            · {{ $person->mentorProfile->experience_years }} yrs exp.
                        @else
                            {{ $person->menteeProfile->education_level ?? 'Researcher' }}
                        @endif
                    </span>
                </div>
                <a href="{{ route('portal.users.show', $person) }}" class="btn-connect">
                    View Profile
                </a>
            </div>
            @empty
            <p class="text-muted text-center py-3" style="font-size:13px;">
                No suggestions yet.
            </p>
            @endforelse
        </div>
    </div>

</div>

@endsection
