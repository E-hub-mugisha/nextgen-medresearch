<aside class="sidebar">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <img src="{{ asset('assets/images/logo-new-white.png') }}" alt="Logo" style="width: 100%; height:4rem">
    </div>

    {{-- Navigation --}}
    <nav class="sidebar-nav">

        <div class="nav-group">
            <span class="nav-group-label">Main</span>
            <a href="{{ route('portal.dashboard.index') }}"
                class="nav-item {{ request()->routeIs('portal.dashboard.*') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> Dashboard
            </a>
            <a href="{{ route('portal.projects.discover') }}"
                class="nav-item {{ request()->routeIs('portal.projects.discover') ? 'active' : '' }}">
                <i class="bi bi-compass"></i> Discover
            </a>
            <a href="{{ route('portal.people.index') }}"
                class="nav-item {{ request()->routeIs('portal.people.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> People
            </a>
            <a href="{{ route('portal.projects.index') }}"
                class="nav-item {{ request()->routeIs('portal.projects.*') ? 'active' : '' }}">
                <i class="bi bi-folder2-open"></i> My Projects
            </a>
            <a href="#"
                class="nav-item {{ request()->routeIs('collaborators.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Collaborators
                @php
                $pendingCount = \DB::table('project_collaborators')
                ->whereIn('project_id', auth()->user()
                ->projects()->pluck('id'))
                ->where('status', 'pending')
                ->count();
                @endphp
                @if($pendingCount > 0)
                <span class="nav-badge">{{ $pendingCount }}</span>
                @endif
            </a>
        </div>

        <div class="nav-group">
            <span class="nav-group-label">Research</span>
            <a href="{{ route('portal.interests.index') }}"
                class="nav-item {{ request()->routeIs('portal.interests.*') ? 'active' : '' }}">
                <i class="bi bi-flask"></i> Research Topics
            </a>
        </div>

        <div class="nav-group">
            <span class="nav-group-label">Account</span>
            <a href="{{ route('portal.profile.show') }}"
                class="nav-item {{ request()->routeIs('portal.profile.*') ? 'active' : '' }}">
                <i class="bi bi-person"></i> Profile
            </a>
            <a href="#" class="nav-item">
                <i class="bi bi-gear"></i> Settings
            </a>
        </div>

    </nav>

    {{-- User Footer --}}
    <div class="sidebar-user">
        <div class="user-avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
        </div>
        <div class="user-info">
            <span class="user-name">{{ auth()->user()->name }}</span>
            <span class="user-role">{{ ucfirst(auth()->user()->role) }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-icon-logout" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </form>
    </div>

</aside>