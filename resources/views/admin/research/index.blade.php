{{-- resources/views/admin/research/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Research List</h4>
    <a href="{{ route('admin.research.create') }}" class="btn btn-primary">+ Add Research</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Featured</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($research as $item)
        <tr>
            <td>{{ $item->title }}</td>
            <td>{{ ucfirst($item->status) }}</td>
            <td>{{ $item->featured ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.research.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <a href="{{ route('admin.research.show', $item->id) }}" class="btn btn-sm btn-info">View</a>
                <form action="{{ route('admin.research.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $research->links() }}
@endsection
