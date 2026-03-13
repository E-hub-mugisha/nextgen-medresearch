@extends('layouts.portal')
@section('title', 'Collaborators — ' . $project->title)

@section('content')

<div class="page-header-row">
    <div>
        <a href="{{ route('portal.projects.show', $project) }}" class="breadcrumb-link">
            <i class="bi bi-arrow-left me-1"></i>{{ $project->title }}
        </a>
        <h1 class="page-title mt-1">Collaborators</h1>
        <p class="page-subtitle">
            {{ $accepted->flatten()->count() }} accepted
            · {{ $pending->count() }} pending
        </p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success mb-4">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger mb-4">
        <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
    </div>
@endif

<div class="collab-layout">

    {{-- LEFT — Accepted Collaborators --}}
    <div class="collab-main">

        {{-- Mentors --}}
        <div class="panel mb-4">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-person-check me-2" style="color:var(--blue-600)"></i>
                    Mentors
                    <span class="ms-badge ms-2">
                        {{ isset($accepted['mentor']) ? $accepted['mentor']->count() : 0 }}
                    </span>
                </span>
            </div>

            @if(empty($accepted['mentor']) || $accepted['mentor']->isEmpty())
                <div class="panel-empty">
                    <i class="bi bi-person-plus"></i>
                    No mentors yet on this project.
                </div>
            @else
                <div class="panel-body">
                    @foreach($accepted['mentor'] as $collaborator)
                        @include('portal.projects.partials.collaborator-row', [
                            'collaborator' => $collaborator,
                            'project'      => $project,
                            'badgeClass'   => 'badge-mentor',
                            'badgeLabel'   => 'Mentor',
                        ])
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Mentees --}}
        <div class="panel">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-mortarboard me-2" style="color:var(--teal-600)"></i>
                    Mentees
                    <span class="ms-badge ms-2">
                        {{ isset($accepted['mentee']) ? $accepted['mentee']->count() : 0 }}
                    </span>
                </span>
            </div>

            @if(empty($accepted['mentee']) || $accepted['mentee']->isEmpty())
                <div class="panel-empty">
                    <i class="bi bi-person-plus"></i>
                    No mentees yet on this project.
                </div>
            @else
                <div class="panel-body">
                    @foreach($accepted['mentee'] as $collaborator)
                        @include('portal.projects.partials.collaborator-row', [
                            'collaborator' => $collaborator,
                            'project'      => $project,
                            'badgeClass'   => 'badge-mentee',
                            'badgeLabel'   => 'Mentee',
                        ])
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    {{-- RIGHT — Pending Requests --}}
    @if(auth()->id() === $project->owner_id)
    <div class="collab-sidebar">

        {{-- Pending --}}
        <div class="panel mb-3">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-clock me-2" style="color:var(--warning)"></i>
                    Pending Requests
                    <span class="ms-badge ms-2">{{ $pending->count() }}</span>
                </span>
            </div>

            @if($pending->isEmpty())
                <div class="panel-empty">
                    <i class="bi bi-inbox"></i>
                    No pending requests.
                </div>
            @else
                <div class="panel-body">
                    @foreach($pending as $requester)
                    <div class="collab-request-row">
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
                                <button class="btn-accept" title="Accept">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>
                            <form method="POST"
                                  action="{{ route('portal.collaborators.reject', ['project' => $project, 'user' => $requester]) }}">
                                @csrf @method('PATCH')
                                <button class="btn-reject" title="Reject">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Rejected --}}
        @if($rejected->isNotEmpty())
        <div class="panel">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-x-circle me-2" style="color:var(--danger)"></i>
                    Rejected
                    <span class="ms-badge ms-2">{{ $rejected->count() }}</span>
                </span>
            </div>
            <div class="panel-body">
                @foreach($rejected as $person)
                <div class="person-row">
                    <div class="person-avatar">
                        {{ strtoupper(substr($person->name, 0, 2)) }}
                    </div>
                    <div class="person-info">
                        <span class="person-name">{{ $person->name }}</span>
                        <span class="person-role">{{ ucfirst($person->role) }}</span>
                    </div>
                    {{-- Allow re-accepting --}}
                    <form method="POST"
                          action="{{ route('portal.collaborators.accept', ['project' => $project, 'user' => $person]) }}">
                        @csrf @method('PATCH')
                        <button class="btn-connect" title="Accept after all">
                            Accept
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
    @endif

</div>

@endsection