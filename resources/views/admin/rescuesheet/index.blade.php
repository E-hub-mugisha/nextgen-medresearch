@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Rescue Sheets</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            + Add Rescue Sheet
        </button>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Vehicle Model</th>
                <th>QR Code</th>
                <th>Scans</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sheets as $sheet)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sheet->title }}</td>
                <td>{{ $sheet->vehicle_model ?? '-' }}</td>
                <td>
                    @if($sheet->qr_code_path)
                        <a href="{{ route('rescue.sheet.show',$sheet->slug) }}" target="_blank">
                            <img src="{{ asset('storage/'.$sheet->qr_code_path) }}" width="60" alt="QR Code">
                        </a>
                    @endif
                </td>
                <td>{{ $sheet->scan_count ?? 0 }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $sheet->id }}">Edit</button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $sheet->id }}">Delete</button>
                </td>
            </tr>

            {{-- EDIT MODAL --}}
            <div class="modal fade" id="editModal{{ $sheet->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('admin.rescue.update', $sheet->id) }}"
                        enctype="multipart/form-data" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Rescue Sheet</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $sheet->title }}"
                                    required>
                            </div>
                            <div class="mb-2">
                                <label>Vehicle Model</label>
                                <input type="text" name="vehicle_model" class="form-control"
                                    value="{{ $sheet->vehicle_model }}">
                            </div>
                            <div class="mb-2">
                                <label>PDF File (optional)</label>
                                <input type="file" name="file" class="form-control">
                                @if($sheet->file_path)
                                <small>Current file: <a
                                        href="{{ asset('storage/'.$sheet->file_path) }}" target="_blank">View</a></small>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- DELETE MODAL --}}
            <div class="modal fade" id="deleteModal{{ $sheet->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('admin.rescue.destroy', $sheet->id) }}"
                        class="modal-content">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Rescue Sheet</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete <b>{{ $sheet->title }}</b>?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>

            @empty
            <tr>
                <td colspan="6" class="text-center">No rescue sheets added yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- CREATE MODAL --}}
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.rescue.store') }}" enctype="multipart/form-data"
            class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Rescue Sheet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Vehicle Model</label>
                    <input type="text" name="vehicle_model" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Upload PDF File</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection
