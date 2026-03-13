@extends('layouts.portal')
@section('title', $user->name . ' — Profile')

@section('content')

@php
    $isOwnProfile = $isOwnProfile ?? (auth()->id() === $user->id);
    $profile      = $user->role === 'mentor' ? $user->mentorProfile : $user->menteeProfile;
    $myProjects   = $myProjects ?? collect();
@endphp

{{-- Flash --}}
@if(session('success'))
    <div class="alert alert-success mb-4">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    </div>
@endif

{{-- PROFILE HEADER --}}
<div class="profile-header-card">

    {{-- Cover --}}
    <div class="profile-cover">
        <div class="profile-cover-pattern"></div>
    </div>

    {{-- Avatar + Info --}}
    <div class="profile-header-body">
        <div class="profile-avatar-wrap">
            @if($user->profile_photo ?? null)
                <img src="{{ asset('storage/' . $user->profile_photo) }}"
                     alt="{{ $user->name }}"
                     class="profile-avatar-img">
            @else
                <div class="profile-avatar-initials">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
            @endif

            {{-- Availability badge (mentor) --}}
            @if($user->role === 'mentor' && $profile)
                <span class="profile-avail-badge {{ $profile->available ? 'available' : '' }}">
                    {{ $profile->available ? 'Available' : 'Unavailable' }}
                </span>
            @endif
        </div>

        <div class="profile-header-info">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <h2 class="profile-name">
                    @if($user->role === 'mentor' && $profile?->academic_title)
                        {{ $profile->academic_title }}
                    @endif
                    {{ $user->name }}
                </h2>
                <span class="role-pill {{ $user->role }}">
                    @if($user->role === 'mentor')
                        <i class="bi bi-person-check me-1"></i>
                    @else
                        <i class="bi bi-mortarboard me-1"></i>
                    @endif
                    {{ ucfirst($user->role) }}
                </span>
            </div>

            <p class="profile-tagline">
                @if($user->role === 'mentor' && $profile)
                    {{ $profile->expertise }}
                    @if($profile->organization)
                        · {{ $profile->organization }}
                    @endif
                    @if($profile->experience_years)
                        · {{ $profile->experience_years }} years experience
                    @endif
                @elseif($user->role === 'mentee' && $profile)
                    {{ $profile->education_level }}
                    @if($profile->institution)
                        · {{ $profile->institution }}
                    @endif
                    @if($profile->country)
                        · {{ $profile->country }}
                    @endif
                @endif
            </p>

            {{-- Social Links (mentor) --}}
            @if($user->role === 'mentor' && $profile)
                <div class="profile-links">
                    @if($profile->linkedin_url)
                        <a href="{{ $profile->linkedin_url }}"
                           target="_blank" class="profile-social-link">
                            <i class="bi bi-linkedin"></i> LinkedIn
                        </a>
                    @endif
                    @if($profile->google_scholar_url)
                        <a href="{{ $profile->google_scholar_url }}"
                           target="_blank" class="profile-social-link">
                            <i class="bi bi-mortarboard"></i> Google Scholar
                        </a>
                    @endif
                </div>
            @endif
        </div>

        {{-- Actions --}}
        <div class="profile-header-actions">
            @if($isOwnProfile)
                <a href="{{ route('portal.profile.edit') }}"
                   class="btn btn-primary">
                    <i class="bi bi-pencil me-1"></i> Edit Profile
                </a>
            @else
                {{-- Invite to project --}}
                @if($myProjects->isNotEmpty())
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle"
                                data-bs-toggle="dropdown">
                            <i class="bi bi-person-plus me-1"></i> Invite to Project
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <h6 class="dropdown-header" style="font-size:.72rem;">
                                    Select a project
                                </h6>
                            </li>
                            @foreach($myProjects as $project)
                                @php
                                    $alreadyIn = $project->collaborators
                                        ->where('id', $user->id)->isNotEmpty();
                                @endphp
                                <li>
                                    @if($alreadyIn)
                                        <span class="dropdown-item disabled"
                                              style="font-size:.82rem;">
                                            <i class="bi bi-check2 me-2 text-success"></i>
                                            {{ Str::limit($project->title, 30) }}
                                        </span>
                                    @else
                                        <form method="POST"
                                              action="{{ route('portal.collaborators.invite', ['project' => $project, 'user' => $user]) }}">
                                            @csrf
                                            <button type="submit"
                                                    class="dropdown-item"
                                                    style="font-size:.82rem;">
                                                <i class="bi bi-folder2-open me-2"></i>
                                                {{ Str::limit($project->title, 30) }}
                                            </button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="{{ route('portal.projects.discover') }}"
                   class="btn btn-secondary">
                    <i class="bi bi-compass me-1"></i> View Projects
                </a>
            @endif
        </div>
    </div>

</div>

{{-- STATS ROW --}}
<div class="stats-row my-4">
    <div class="stat-card">
        <span class="stat-label">Projects</span>
        <span class="stat-value">{{ $stats['projects'] }}</span>
        <span class="stat-change">owned</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Collaborations</span>
        <span class="stat-value">{{ $stats['collaborations'] }}</span>
        <span class="stat-change">active</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Interests</span>
        <span class="stat-value">{{ $stats['interests'] }}</span>
        <span class="stat-change">research areas</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Milestones Done</span>
        <span class="stat-value">{{ $stats['milestones'] }}</span>
        <span class="stat-change">completed</span>
    </div>
</div>

{{-- MAIN GRID --}}
<div class="profile-grid">

    {{-- LEFT COLUMN --}}
    <div class="profile-left">

        {{-- Bio --}}
        @if($profile?->bio)
        <div class="panel mb-4">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-person-lines-fill me-2"></i>About
                </span>
            </div>
            <div class="panel-body py-3">
                <p style="font-size:.9rem;line-height:1.85;color:var(--gray-700);">
                    {{ $profile->bio }}
                </p>
            </div>
        </div>
        @endif

        {{-- Research Goal (mentee) --}}
        @if($user->role === 'mentee' && $profile?->research_goal)
        <div class="panel mb-4">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-bullseye me-2"></i>Research Goal
                </span>
            </div>
            <div class="panel-body py-3">
                <p style="font-size:.9rem;line-height:1.8;color:var(--gray-700);">
                    {{ $profile->research_goal }}
                </p>
            </div>
        </div>
        @endif

        {{-- Recent Projects --}}
        <div class="panel">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-folder2-open me-2"></i>Projects
                    <span class="ms-badge ms-2">{{ $recentProjects->count() }}</span>
                </span>
                @if($isOwnProfile)
                    <a href="{{ route('portal.projects.index') }}"
                       class="panel-link">View all →</a>
                @endif
            </div>

            @if($recentProjects->isEmpty())
                <div class="panel-empty">
                    <i class="bi bi-folder-plus"></i>
                    No projects yet.
                </div>
            @else
                <div class="panel-body">
                    @foreach($recentProjects as $project)
                    <div class="project-row">
                        <div class="project-icon">
                            {{ strtoupper(substr($project->title, 0, 1)) }}
                        </div>
                        <div class="project-details">
                            <a href="{{ route('portal.projects.show', $project) }}"
                               class="project-title">
                                {{ $project->title }}
                            </a>
                            <span class="project-meta">
                                {{ $project->collaborators_count }} collaborators
                                · {{ $project->milestones_count }} milestones
                            </span>
                        </div>
                        <span class="status-badge status-{{ str_replace(' ', '_', $project->status) }}">
                            {{ ucfirst($project->status) }}
                        </span>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

    {{-- RIGHT COLUMN --}}
    <div class="profile-right">

        {{-- Details Card --}}
        <div class="panel mb-4">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-info-circle me-2"></i>Details
                </span>
                @if($isOwnProfile)
                    <a href="{{ route('portal.profile.edit') }}"
                       class="panel-link">Edit →</a>
                @endif
            </div>
            <div class="panel-body">
                <table class="details-table">
                    @if($profile?->country)
                    <tr>
                        <td><i class="bi bi-geo-alt me-1"></i>Country</td>
                        <td>{{ $profile->country }}</td>
                    </tr>
                    @endif

                    @if($user->role === 'mentor' && $profile)
                        @if($profile->experience_years)
                        <tr>
                            <td><i class="bi bi-briefcase me-1"></i>Experience</td>
                            <td>{{ $profile->experience_years }} years</td>
                        </tr>
                        @endif
                        @if($profile->max_mentees)
                        <tr>
                            <td><i class="bi bi-people me-1"></i>Max Mentees</td>
                            <td>{{ $profile->max_mentees }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><i class="bi bi-circle-fill me-1" style="font-size:.5rem"></i>Status</td>
                            <td>
                                <span class="status-badge {{ $profile->available ? 'status-active' : 'status-completed' }}">
                                    {{ $profile->available ? 'Available' : 'Unavailable' }}
                                </span>
                            </td>
                        </tr>
                    @else
                        @if($profile?->education_level)
                        <tr>
                            <td><i class="bi bi-mortarboard me-1"></i>Education</td>
                            <td>{{ $profile->education_level }}</td>
                        </tr>
                        @endif
                        @if($profile?->institution)
                        <tr>
                            <td><i class="bi bi-building me-1"></i>Institution</td>
                            <td>{{ $profile->institution }}</td>
                        </tr>
                        @endif
                        @if($profile?->availability)
                        <tr>
                            <td><i class="bi bi-clock me-1"></i>Availability</td>
                            <td>{{ $profile->availability }}</td>
                        </tr>
                        @endif
                    @endif

                    <tr>
                        <td><i class="bi bi-calendar me-1"></i>Joined</td>
                        <td>{{ $user->created_at->format('M Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Research Interests --}}
        @if($user->researchInterests->isNotEmpty())
        <div class="panel mb-4">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-flask me-2"></i>Research Interests
                </span>
            </div>
            <div class="panel-body py-3">
                <div class="d-flex flex-wrap gap-2">
                    @foreach($user->researchInterests as $interest)
                        <span class="person-tag interest">{{ $interest->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- Mentor capacity bar --}}
        @if($user->role === 'mentor' && $profile)
        <div class="panel">
            <div class="panel-header">
                <span class="panel-title">
                    <i class="bi bi-bar-chart me-2"></i>Mentee Capacity
                </span>
            </div>
            <div class="panel-body py-3">
                @php
                    $current  = $profile->mentee_count ?? 0;
                    $max      = $profile->max_mentees  ?? 1;
                    $pct      = $max > 0 ? min(100, round(($current / $max) * 100)) : 0;
                    $barColor = $pct >= 100 ? 'var(--danger)' : ($pct >= 75 ? 'var(--warning)' : 'var(--teal-600)');
                @endphp
                <div class="d-flex justify-content-between mb-1" style="font-size:.8rem;">
                    <span class="text-muted">{{ $current }} / {{ $max }} mentees</span>
                    <span class="fw-medium">{{ $pct }}%</span>
                </div>
                <div class="progress-bar-wrap">
                    <div class="progress-fill"
                         style="width:{{ $pct }}%;background:{{ $barColor }};">
                    </div>
                </div>
                @if($pct >= 100)
                    <p class="text-danger mt-2 mb-0" style="font-size:.75rem;">
                        <i class="bi bi-x-circle me-1"></i>Currently at full capacity
                    </p>
                @endif
            </div>
        </div>
        @endif

    </div>

</div>

@endsection