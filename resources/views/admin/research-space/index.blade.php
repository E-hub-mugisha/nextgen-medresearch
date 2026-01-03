@extends('layouts.app')

@section('title', 'Manage Research Space')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h4>Research Space</h4>
        <a href="{{ route('admin.research_spaces.create') }}" class="btn btn-primary">
            + Add Research topic
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Target Area</th>
                <th>Users</th>
                <th>Created</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($researchSpaces as $research)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $research->title }}</td>
                <td>{{ $research->target_area }}</td>
                <td>
                    <a href="{{ route('admin.research_spaces.users', $research) }}">
                        {{ $research->users_count }} Users
                    </a>
                <td>{{ $research->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.research_spaces.edit', $research) }}"
                        class="btn btn-sm btn-warning">Edit</a>

                    <a href="{{ route('admin.research_spaces.users', $research->id) }}"
                        class="btn btn-sm btn-outline-primary ms-2">
                        View Users
                    </a>
                    <form action="{{ route('admin.research_spaces.destroy', $research) }}"
                        method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this research?')"
                            class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No research found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $researchSpaces->links() }}

</div>
@endsection