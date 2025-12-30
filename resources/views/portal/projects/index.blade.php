@extends('layouts.portal')

@section('content')
<div class="container mt-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Research Projects</h3>
            <p class="text-muted mb-0">Manage and track your ongoing research work</p>
        </div>

        <div class="d-flex align-items-center gap-2">

            <!-- Toggle -->
            <div class="btn-group" role="group">
                <button class="btn btn-outline-primary active" id="gridBtn">
                    <i class="fa-solid fa-grid-2"></i> Grid
                </button>
                <button class="btn btn-outline-primary" id="listBtn">
                    <i class="fa-solid fa-list"></i> List
                </button>
            </div>

            <a href="#newProjectModal" data-bs-toggle="modal" class="btn btn-primary px-4">
                <i class="fa-solid fa-plus"></i> New Project
            </a>
        </div>
    </div>

    <!-- PROJECTS WRAPPER -->
    <div id="projectContainer" class="row">

        @forelse($projects as $project)
        <div class="col-md-4 mb-4 project-item">
            <div class="project-card h-100">

                <!-- Status -->
                <div class="d-flex justify-content-between">
                    <span class="badge 
                        {{ $project->status == 'completed' ? 'bg-success' :
                        ($project->status == 'ongoing' ? 'bg-primary' : 'bg-warning text-dark') }}">
                        {{ ucfirst($project->status) }}
                    </span>

                    <span class="text-muted small">
                        {{ now()->diffForHumans($project->created_at, true) }} running
                    </span>
                </div>

                <!-- Title -->
                <h5 class="fw-bold mt-2 mb-2">{{ $project->title }}</h5>

                <!-- Description -->
                <p class="text-muted">{{ Str::limit($project->description, 100) }}</p>

                <!-- Research Area -->
                <span class="badge bg-light text-dark mb-2">
                    <i class="fa-solid fa-flask"></i>
                    {{ $project->research_area }}
                </span>

                <!-- Progress -->
                <label class="small fw-semibold mt-3">Progress</label>
                <div class="progress rounded-pill" style="height:8px;">
                    <div class="progress-bar
                        {{ $project->status == 'completed' ? 'bg-success' : 'bg-primary' }}"
                        role="progressbar"
                        style="width: {{ $project->progress ?? 60 }}%">
                    </div>
                </div>

                <!-- Collaborators -->
                <!-- Collaborators -->
                <div class="d-flex align-items-center mt-3">
                    <div class="avatar-group">

                        @php
                        $collabs = $project->collaborators->take(3);
                        $remaining = $project->collaborators->count() - $collabs->count();
                        @endphp

                        @foreach($collabs as $user)
                        <img
                            src="{{ $user->profile_photo ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0D6EFD&color=fff' }}"
                            class="avatar"
                            title="{{ $user->name }}">
                        @endforeach

                        @if($remaining > 0)
                        <span class="avatar more">+{{ $remaining }}</span>
                        @endif

                    </div>
                </div>


                <!-- Footer -->
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <small class="text-muted">Updated {{ $project->updated_at->diffForHumans() }}</small>

                    <a href="{{ route('projects.show', $project->id) }}"
                        class="btn btn-outline-primary btn-sm">
                        View Details
                    </a>
                </div>

            </div>
        </div>

        @empty
        <div class="col-12 text-center mt-5">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png"
                width="120" class="mb-3 opacity-75">
            <h5 class="fw-bold">No Projects Yet</h5>
            <p class="text-muted">Start by creating your first research project.</p>
            <a href="#newProjectModal" data-bs-toggle="modal"
                class="btn btn-primary px-4">
                Create Project
            </a>
        </div>
        @endforelse
    </div>
</div>

<!-- New Project Modal -->
<div class="modal fade" id="newProjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('projects.store') }}">
            @csrf
            <div class="modal-content modern-modal">

                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Create New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body pt-0">
                    <div class="mb-3">
                        <label class="fw-semibold">Project Title</label>
                        <input type="text" name="title" class="form-control modern-input" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Description</label>
                        <textarea name="description"
                            class="form-control modern-input"
                            rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="fw-semibold">Research Area</label>
                        <input type="text" name="research_area"
                            class="form-control modern-input" required>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Create Project</button>
                </div>

            </div>
        </form>
    </div>
</div>


<style>
    /* Card */
    .project-card {
        background: #fff;
        border-radius: 18px;
        padding: 20px;
        box-shadow: rgba(99, 99, 99, 0.12) 0px 4px 12px;
        transition: all .3s ease;
    }

    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: rgba(0, 0, 0, .18) 0px 10px 25px;
    }

    /* Avatars */
    .avatar-group {
        display: flex;
    }

    .avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        border: 2px solid #fff;
        margin-left: -8px;
        object-fit: cover;
    }

    .avatar:first-child {
        margin-left: 0;
    }

    .avatar.more {
        background: #0d6efd;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 12px;
    }

    /* List Mode */
    .list-view .project-item {
        flex: 0 0 100%;
    }

    .list-view .project-card {
        display: flex;
        flex-direction: row;
        gap: 25px;
    }

    .list-view .project-card p {
        max-width: 60%;
    }
</style>

<script>
    const gridBtn = document.getElementById('gridBtn');
    const listBtn = document.getElementById('listBtn');
    const container = document.getElementById('projectContainer');

    listBtn.addEventListener('click', () => {
        container.classList.add('list-view');
        listBtn.classList.add('active');
        gridBtn.classList.remove('active');
    });

    gridBtn.addEventListener('click', () => {
        container.classList.remove('list-view');
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
    });
</script>

@endsection