@extends('layouts.portal')
@section('title', $project->title)

@section('content')

{{-- Flash --}}
@if(session('success'))
<div class="alert alert-success mb-4">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
</div>
@endif

{{-- PAGE HEADER --}}
<div class="page-header-row">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <span class="status-badge status-{{ str_replace(' ', '_', $project->status) }}">
                {{ ucfirst($project->status) }}
            </span>
            @if($project->research_area)
            <span class="project-area-tag">
                <i class="bi bi-tag me-1"></i>{{ $project->research_area }}
            </span>
            @endif
        </div>
        <h1 class="page-title">{{ $project->title }}</h1>
        <p class="page-subtitle">
            By {{ $project->owner->name }}
            @if($project->start_date)
            · {{ optional($project->start_date)->format('M Y') }}
            @if($project->end_date)
            — {{ optional($project->end_date)->format('M Y') }}
            @endif
            @endif
        </p>
    </div>
    <div class="d-flex gap-2">
        @if($isOwner)
        <a href="{{ route('portal.projects.edit', $project) }}"
            class="btn btn-secondary btn-sm">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('projects.milestones.create', $project) }}"
            class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Add Milestone
        </a>

        @elseif($isCollaborator)
        {{-- Already an accepted collaborator — show leave button --}}
        <form method="POST"
            action="{{ route('portal.collaborators.remove', ['project' => $project, 'user' => auth()->user()]) }}"
            onsubmit="return confirm('Leave this project?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-secondary btn-sm">
                <i class="bi bi-box-arrow-left me-1"></i> Leave Project
            </button>
        </form>

        @elseif($hasRequested)
        {{-- Pending request --}}
        <button class="btn btn-secondary btn-sm" disabled>
            <i class="bi bi-clock me-1"></i> Request Pending
        </button>

        @else
        {{-- Not yet requested — show the button ✅ --}}
        <form method="POST"
            action="{{ route('portal.collaborators.request', $project) }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-person-plus me-1"></i> Request to Join
            </button>
        </form>

        @endif
    </div>
</div>

{{-- MAIN LAYOUT --}}
<div class="project-show-layout">

    {{-- LEFT — Main Content --}}
    <div class="project-show-main">

        {{-- Description --}}
        <div class="panel mb-4">
            <div class="panel-header">
                <span class="panel-title"><i class="bi bi-file-text me-2"></i>About this Project</span>
            </div>
            <div class="panel-body py-3">
                <p style="font-size:.9rem;line-height:1.8;color:var(--gray-700);">
                    {{ $project->description }}
                </p>
            </div>
        </div>

        {{-- Milestones --}}
        <div class="panel">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-check2-square me-2"></i>Milestones
                    <span class="ms-badge ms-2">{{ $project->milestones->count() }}</span>
                </span>
                @if($isOwner || $isCollaborator)
                <a href="{{ route('projects.milestones.create', $project) }}"
                    class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Add
                </a>
                @endif
            </div>

            @if($project->milestones->isEmpty())
            <div class="panel-empty">
                <i class="bi bi-check2-square"></i>
                No milestones yet.
                @if($isOwner)
                <a href="{{ route('projects.milestones.create', $project) }}"
                    class="d-block mt-1 text-teal fw-medium">
                    Add the first milestone →
                </a>
                @endif
            </div>
            @else
            <div class="panel-body">
                @foreach($project->milestones as $milestone)
                <div class="milestone-show-row">
                    <div class="ms-check {{ $milestone->status === 'done' ? 'done' : '' }}">
                        @if($milestone->status === 'done')
                        <i class="bi bi-check"></i>
                        @endif
                    </div>
                    <div class="milestone-show-info">
                        <a href="{{ route('milestones.show', $milestone) }}"
                            class="milestone-show-title {{ $milestone->status === 'done' ? 'done' : '' }}">
                            {{ $milestone->title }}
                        </a>
                        <div class="d-flex align-items-center gap-3 mt-1">
                            <span class="status-badge status-{{ $milestone->status }}">
                                {{ ucfirst(str_replace('_', ' ', $milestone->status)) }}
                            </span>
                            @if($milestone->due_date)
                            <span class="ms-due {{ $milestone->due_date->isPast() && $milestone->status !== 'done' ? 'overdue' : '' }}">
                                <i class="bi bi-calendar2 me-1"></i>
                                {{ $milestone->due_date->format('M d, Y') }}
                            </span>
                            @endif
                            <span class="ms-due">
                                <i class="bi bi-chat me-1"></i>
                                {{ $milestone->comments_count }} comment{{ $milestone->comments_count !== 1 ? 's' : '' }}
                            </span>
                        </div>
                    </div>
                    @if($isOwner || $isCollaborator)
                    <a href="{{ route('milestones.show', $milestone) }}"
                        class="btn btn-secondary btn-sm ms-auto">
                        View
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>

    {{-- RIGHT — Sidebar --}}
    <div class="project-show-sidebar">

        {{-- Project Info --}}
        <div class="panel mb-3">
            <div class="panel-header">
                <span class="panel-title"><i class="bi bi-info-circle me-2"></i>Details</span>
            </div>
            <div class="panel-body">
                <table class="details-table">
                    <tr>
                        <td>Status</td>
                        <td>
                            <span class="status-badge status-{{ str_replace(' ', '_', $project->status) }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Research Area</td>
                        <td>{{ $project->research_area ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td>Start Date</td>
                        <td>{{ $project->start_date?->format('M d, Y') ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td>End Date</td>
                        <td>{{ $project->end_date?->format('M d, Y') ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td>Milestones</td>
                        <td>{{ $project->milestones->count() }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Owner --}}
        <div class="panel mb-3">
            <div class="panel-header">
                <span class="panel-title"><i class="bi bi-person-badge me-2"></i>Owner</span>
            </div>
            <div class="panel-body">
                <div class="person-row pt-0 border-0">
                    <div class="person-avatar">
                        {{ strtoupper(substr($project->owner->name, 0, 2)) }}
                    </div>
                    <div class="person-info">
                        <span class="person-name">{{ $project->owner->name }}</span>
                        <span class="person-role">{{ ucfirst($project->owner->role) }}</span>
                    </div>
                    <a href="{{ route('portal.users.show', $project->owner) }}" class="btn-connect">Profile</a>
                </div>
            </div>
        </div>

        {{-- Collaborators --}}
        {{-- Collaborators --}}
        <div class="panel">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-people me-2"></i>Collaborators
                    <span class="ms-badge ms-2">
                        {{ $project->collaborators->where('pivot.status','accepted')->count() }}
                    </span>
                </span>
                @if($isOwner)
                <a href="{{ route('portal.collaborators.index', $project) }}"
                    class="panel-link">Manage →</a>
                @endif
            </div>
            <div class="panel-body">

                @php
                $mentors = $project->collaborators
                ->where('pivot.status','accepted')
                ->where('role','mentor');
                $mentees = $project->collaborators
                ->where('pivot.status','accepted')
                ->where('role','mentee');
                @endphp

                {{-- Mentors --}}
                @if($mentors->isNotEmpty())
                <p class="collab-group-label">
                    <i class="bi bi-person-check me-1"></i>Mentors
                </p>
                @foreach($mentors as $c)
                <div class="person-row">
                    <div class="person-avatar blue">
                        {{ strtoupper(substr($c->name, 0, 2)) }}
                    </div>
                    <div class="person-info">
                        <span class="person-name">{{ $c->name }}</span>
                        <span class="person-role">
                            {{ $c->mentorProfile->expertise ?? 'Mentor' }}
                        </span>
                    </div>
                    <a href="{{ route('portal.users.show', $c) }}"
                        class="btn-connect">View</a>
                </div>
                @endforeach
                @endif

                {{-- Mentees --}}
                @if($mentees->isNotEmpty())
                <p class="collab-group-label mt-2">
                    <i class="bi bi-mortarboard me-1"></i>Mentees
                </p>
                @foreach($mentees as $c)
                <div class="person-row">
                    <div class="person-avatar">
                        {{ strtoupper(substr($c->name, 0, 2)) }}
                    </div>
                    <div class="person-info">
                        <span class="person-name">{{ $c->name }}</span>
                        <span class="person-role">
                            {{ $c->menteeProfile->education_level ?? 'Mentee' }}
                        </span>
                    </div>
                    <a href="{{ route('portal.users.show', $c) }}"
                        class="btn-connect">View</a>
                </div>
                @endforeach
                @endif

                @if($mentors->isEmpty() && $mentees->isEmpty())
                <p class="text-muted text-center py-2" style="font-size:.82rem;">
                    No collaborators yet.
                </p>
                @endif

                {{-- Pending requests (owner only) --}}
                @if($isOwner)
                @php $pending = $project->collaborators->where('pivot.status','pending'); @endphp
                @if($pending->count() > 0)
                <div class="section-label mt-3"><span>Pending ({{ $pending->count() }})</span></div>
                @foreach($pending as $requester)
                <div class="person-row">
                    <div class="person-avatar {{ $requester->role === 'mentor' ? 'blue' : '' }}">
                        {{ strtoupper(substr($requester->name, 0, 2)) }}
                    </div>
                    <div class="person-info">
                        <span class="person-name">{{ $requester->name }}</span>
                        <span class="person-role">
                            <span class="role-pill {{ $requester->role }}">
                                {{ ucfirst($requester->role) }}
                            </span>
                        </span>
                    </div>
                    <div class="req-actions">
                        <form method="POST"
                            action="{{ route('portal.collaborators.accept', ['project' => $project, 'user' => $requester]) }}">
                            @csrf @method('PATCH')
                            <button class="btn-accept"><i class="bi bi-check"></i></button>
                        </form>
                        <form method="POST"
                            action="{{ route('portal.collaborators.reject', ['project' => $project, 'user' => $requester]) }}">
                            @csrf @method('PATCH')
                            <button class="btn-reject"><i class="bi bi-x"></i></button>
                        </form>
                    </div>
                </div>
                @endforeach
                @endif
                @endif

            </div>
        </div>

    </div>

</div>

@endsection