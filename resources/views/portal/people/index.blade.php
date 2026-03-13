@extends('layouts.portal')
@section('title', 'People Directory')

@section('content')

{{-- Header --}}
<div class="page-header-row">
    <div>
        <h1 class="page-title">People Directory</h1>
        <p class="page-subtitle">
            Find mentors and mentees to collaborate with
        </p>
    </div>
</div>

{{-- Flash --}}
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

{{-- FILTERS --}}
<form method="GET" action="{{ route('portal.people.index') }}">
<div class="people-filters panel mb-4">
    <div class="panel-body py-3">
        <div class="discover-filters">

            {{-- Search --}}
            <div class="filter-search">
                <i class="bi bi-search"></i>
                <input type="text"
                       name="search"
                       class="filter-search-input"
                       placeholder="Search by name or expertise..."
                       value="{{ request('search') }}">
            </div>

            {{-- Role Tabs --}}
            <div class="people-tabs">
                <a href="{{ request()->fullUrlWithQuery(['role' => '']) }}"
                   class="people-tab {{ !request('role') ? 'active' : '' }}">
                    All
                </a>
                <a href="{{ request()->fullUrlWithQuery(['role' => 'mentor']) }}"
                   class="people-tab {{ request('role') === 'mentor' ? 'active' : '' }}">
                    <i class="bi bi-person-check me-1"></i>Mentors
                </a>
                <a href="{{ request()->fullUrlWithQuery(['role' => 'mentee']) }}"
                   class="people-tab {{ request('role') === 'mentee' ? 'active' : '' }}">
                    <i class="bi bi-mortarboard me-1"></i>Mentees
                </a>
            </div>

            {{-- Research Interest --}}
            <select name="interest" class="form-select filter-select">
                <option value="">All Interests</option>
                @foreach($interests as $interest)
                    <option value="{{ $interest->id }}"
                        {{ request('interest') == $interest->id ? 'selected' : '' }}>
                        {{ $interest->name }}
                    </option>
                @endforeach
            </select>

            {{-- Available mentors only --}}
            <label class="people-filter-check">
                <input type="checkbox"
                       name="available"
                       value="1"
                       {{ request('available') ? 'checked' : '' }}>
                <span>Available mentors only</span>
            </label>

            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-funnel me-1"></i> Filter
            </button>

            @if(request()->hasAny(['search', 'role', 'interest', 'available']))
                <a href="{{ route('portal.people.index') }}"
                   class="btn btn-secondary btn-sm">
                    <i class="bi bi-x me-1"></i> Clear
                </a>
            @endif

        </div>
    </div>
</div>
</form>

{{-- Results Count --}}
<div class="d-flex align-items-center justify-content-between mb-3">
    <p class="text-muted mb-0" style="font-size:.85rem;">
        Showing <strong>{{ $people->total() }}</strong>
        {{ request('role') ? ucfirst(request('role')) . 's' : 'people' }}
    </p>
    <p class="text-muted mb-0" style="font-size:.82rem;">
        Page {{ $people->currentPage() }} of {{ $people->lastPage() }}
    </p>
</div>

{{-- GRID --}}
@if($people->isEmpty())
    <div class="panel">
        <div class="panel-empty" style="padding:3rem;">
            <i class="bi bi-people" style="font-size:2.5rem;opacity:.3;display:block;margin-bottom:12px;"></i>
            No people found matching your criteria.
            <a href="{{ route('portal.people.index') }}"
               class="d-block mt-2 text-teal fw-medium">
                Clear filters →
            </a>
        </div>
    </div>
@else
    <div class="people-grid mb-4">
        @foreach($people as $person)
        <div class="person-card">

            {{-- Card Top --}}
            <div class="person-card-top">
                <div class="person-card-avatar {{ $person->role === 'mentor' ? 'blue' : '' }}">
                    {{ strtoupper(substr($person->name, 0, 2)) }}
                </div>
                <div class="person-card-info">
                    <span class="person-card-name">{{ $person->name }}</span>
                    <span class="role-pill {{ $person->role }}">
                        @if($person->role === 'mentor')
                            <i class="bi bi-person-check me-1"></i>
                        @else
                            <i class="bi bi-mortarboard me-1"></i>
                        @endif
                        {{ ucfirst($person->role) }}
                    </span>
                </div>

                {{-- Availability dot (mentors only) --}}
                @if($person->role === 'mentor' && $person->mentorProfile)
                    <span class="person-avail-dot {{ $person->mentorProfile->available ? 'available' : '' }}"
                          title="{{ $person->mentorProfile->available ? 'Available' : 'Unavailable' }}">
                    </span>
                @endif
            </div>

            {{-- Tags --}}
            <div class="person-card-tags">
                @if($person->role === 'mentor' && $person->mentorProfile)
                    @if($person->mentorProfile->expertise)
                        <span class="person-tag">{{ $person->mentorProfile->expertise }}</span>
                    @endif
                    @if($person->mentorProfile->experience_years)
                        <span class="person-tag">
                            {{ $person->mentorProfile->experience_years }} yrs exp.
                        </span>
                    @endif
                    @if($person->mentorProfile->organization)
                        <span class="person-tag">
                            {{ Str::limit($person->mentorProfile->organization, 20) }}
                        </span>
                    @endif
                @elseif($person->role === 'mentee' && $person->menteeProfile)
                    @if($person->menteeProfile->education_level)
                        <span class="person-tag">
                            {{ $person->menteeProfile->education_level }}
                        </span>
                    @endif
                    @if($person->menteeProfile->country)
                        <span class="person-tag">
                            {{ $person->menteeProfile->country }}
                        </span>
                    @endif
                @endif
                @foreach($person->researchInterests->take(2) as $interest)
                    <span class="person-tag interest">{{ $interest->name }}</span>
                @endforeach
            </div>

            {{-- Stats --}}
            <div class="person-card-stats">
                <div class="person-stat">
                    <span class="person-stat-val">{{ $person->projects_count }}</span>
                    <span class="person-stat-lbl">Projects</span>
                </div>
                @if($person->role === 'mentor' && $person->mentorProfile)
                    <div class="person-stat">
                        <span class="person-stat-val">
                            {{ $person->mentorProfile->max_mentees ?? '—' }}
                        </span>
                        <span class="person-stat-lbl">Max Mentees</span>
                    </div>
                @else
                    <div class="person-stat">
                        <span class="person-stat-val">
                            {{ $person->researchInterests->count() }}
                        </span>
                        <span class="person-stat-lbl">Interests</span>
                    </div>
                @endif
            </div>

            {{-- Bio --}}
            @php
                $bio = $person->role === 'mentor'
                    ? $person->mentorProfile?->bio
                    : $person->menteeProfile?->bio;
            @endphp
            @if($bio)
                <p class="person-card-bio">{{ Str::limit($bio, 110) }}</p>
            @endif

            {{-- Footer Actions --}}
            <div class="person-card-footer">

                {{-- View Profile --}}
                <a href="{{ route('portal.users.show', $person) }}"
                   class="btn btn-secondary btn-sm w-50">
                    <i class="bi bi-person me-1"></i> Profile
                </a>

                {{-- Invite / Request --}}
                @if($myProjects->isEmpty())
                    <a href="{{ route('portal.projects.create') }}"
                       class="btn btn-primary btn-sm w-50">
                        <i class="bi bi-plus me-1"></i> Create Project
                    </a>
                @else
                    <div class="dropdown w-50">
                        <button class="btn btn-primary btn-sm w-100 dropdown-toggle"
                                data-bs-toggle="dropdown">
                            <i class="bi bi-person-plus me-1"></i>
                            Invite
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end w-100">
                            <li>
                                <h6 class="dropdown-header" style="font-size:.72rem;">
                                    Select a project
                                </h6>
                            </li>
                            @foreach($myProjects as $project)
                                @php
                                    $alreadyIn = $project->collaborators
                                        ->where('id', $person->id)
                                        ->isNotEmpty();
                                @endphp
                                <li>
                                    @if($alreadyIn)
                                        <span class="dropdown-item disabled"
                                              style="font-size:.82rem;">
                                            <i class="bi bi-check2 me-2 text-success"></i>
                                            {{ Str::limit($project->title, 28) }}
                                        </span>
                                    @else
                                        <form method="POST"
                                              action="{{ route('portal.collaborators.invite', ['project' => $project, 'user' => $person]) }}">
                                            @csrf
                                            <button type="submit"
                                                    class="dropdown-item"
                                                    style="font-size:.82rem;">
                                                <i class="bi bi-folder2-open me-2"></i>
                                                {{ Str::limit($project->title, 28) }}
                                            </button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a href="{{ route('portal.projects.create') }}"
                                   class="dropdown-item"
                                   style="font-size:.82rem;">
                                    <i class="bi bi-plus-circle me-2"></i>
                                    New Project
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif

            </div>

        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $people->links('vendor.pagination.portal') }}
    </div>
@endif

@endsection