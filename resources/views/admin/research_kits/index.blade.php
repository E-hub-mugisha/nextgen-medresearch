@extends('layouts.portal')

@section('content')
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Research Kits</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            + New Kit
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Order</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>File</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kits as $kit)
                    <tr>
                        <td>{{ $kit->display_order }}</td>
                        <td>{{ $kit->title }}</td>
                        <td>
                            <span class="badge {{ $kit->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($kit->status) }}
                            </span>
                        </td>
                        <td>
                            @if($kit->file_path)
                            <a href="{{ asset('storage/'.$kit->file_path) }}" target="_blank">View</a>
                            @else
                            <span class="text-muted">None</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $kit->id }}">
                                Edit
                            </button>

                            <form action="{{ route('admin.research_kits.destroy', $kit) }}"
                                method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this kit?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- Edit Modal --}}
                    <div class="modal fade" id="editModal{{ $kit->id }}">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST"
                                    action="{{ route('admin.research_kits.update', $kit) }}"
                                    enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-header">
                                        <h5>Edit Research Kit</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $kit->title ?? '' }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="3">{{ $kit->description ?? '' }}</textarea>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="active" @selected(($kit->status ?? '')==='active')>Active</option>
                                                    <option value="inactive" @selected(($kit->status ?? '')==='inactive')>Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Display Order</label>
                                                <input type="number" name="display_order" class="form-control"
                                                    value="{{ $kit->display_order ?? 0 }}">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label>File (PDF / ZIP)</label>
                                            <input type="file" name="file" class="form-control">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="modal fade" id="createModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.kits.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5>Create Research Kit</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ $kit->title ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $kit->description ?? '' }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Status</label>
                            <select name="status" class="form-select">
                                <option value="active" @selected(($kit->status ?? '')==='active')>Active</option>
                                <option value="inactive" @selected(($kit->status ?? '')==='inactive')>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Display Order</label>
                            <input type="number" name="display_order" class="form-control"
                                value="{{ $kit->display_order ?? 0 }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>File (PDF / ZIP)</label>
                        <input type="file" name="file" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection