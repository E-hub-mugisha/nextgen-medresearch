@extends('layouts.portal')
@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Your Research Projects</h3>

    <a href="#newProjectModal" data-bs-toggle="modal" class="btn btn-gradient-primary mb-3">+ New Project</a>

    <div class="row">
        @forelse($projects as $project)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm p-3 h-100">
                <h5>{{ $project->title }}</h5>
                <p>{{ Str::limit($project->description, 80) }}</p>
                <p><strong>Research Area:</strong> {{ $project->research_area }}</p>
                <p><strong>Status:</strong> {{ ucfirst($project->status) }}</p>
                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-outline-primary mt-auto">View</a>
            </div>
        </div>
        @empty
        <p>No projects yet.</p>
        @endforelse
    </div>
</div>

<!-- New Project Modal -->
<div class="modal fade" id="newProjectModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label>Research Area</label>
                    <input type="text" name="research_area" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-gradient-primary">Create Project</button>
            </div>
        </div>
    </form>
  </div>
</div>

<style>
.btn-gradient-primary {
    background: linear-gradient(90deg, #4e54c8, #8f94fb);
    color: #fff;
    border: none;
}
.btn-gradient-primary:hover {opacity:0.9;}
</style>
@endsection
