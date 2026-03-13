<header class="topbar">

    <div class="topbar-search">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Search projects, mentors, topics...">
    </div>

    <div class="topbar-right">

        {{-- Notifications --}}
        <button class="icon-btn position-relative">
            <i class="bi bi-bell"></i>
            <span class="notif-dot"></span>
        </button>

        {{-- New Project --}}
        <a href="{{ route('portal.projects.create') }}" class="btn-primary-sm">
            <i class="bi bi-plus-lg"></i> New Project
        </a>

    </div>
</header>