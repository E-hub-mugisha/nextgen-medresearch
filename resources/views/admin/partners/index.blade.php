@extends('layouts.app')

@section('title', 'Partners')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Partners</h3>

    <button class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#createPartnerModal">
        <i class="mdi mdi-plus"></i> Add Partner
    </button>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <strong>There were some errors:</strong>
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow-sm p-3">
    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Logo</th>
                <th>Name</th>
                <th>Status</th>
                <th>Order</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($partners as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>
                    @if($item->logo)
                    <img src="{{ asset('storage/'.$item->logo) }}"
                        width="70" class="rounded shadow-sm">
                    @else
                    <span class="text-muted">No logo</span>
                    @endif
                </td>

                <td>{{ $item->name }}</td>

                <td>
                    <span class="badge bg-{{ $item->status == 'active' ? 'success' : 'secondary' }}">
                        {{ $item->status }}
                    </span>
                </td>

                <td>{{ $item->display_order }}</td>

                <td>
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editPartnerModal{{ $item->id }}">
                        Edit
                    </button>

                    <form action="{{ route('admin.partners.destroy', $item->id) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this partner?')"
                            class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

            {{-- Edit Modal --}}
            <div class="modal fade" id="editPartnerModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <form action="{{ route('admin.partners.update', $item->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Partner</h5>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label>Partner Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $item->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label>Logo (optional)</label>
                                    <input type="file" name="logo" class="form-control">

                                    @if($item->logo)
                                    <small class="text-muted d-block mt-2">
                                        Current: {{ $item->logo }}
                                    </small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label>Testimonial</label>
                                    <textarea name="testimonial" class="form-control" rows="3">
                                    {{ $item->testimonial }}
                                    </textarea>
                                </div>

                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>
                                            active
                                        </option>
                                        <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>
                                            inactive
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Order</label>
                                    <input type="number" name="display_order" class="form-control"
                                        value="{{ $item->display_order }}">
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Update</button>
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>

{{-- Create Modal --}}
<div class="modal fade" id="createPartnerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add Partner</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Partner Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Logo</label>
                        <input type="file" name="logo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Testimonial</label>
                        <textarea name="testimonial" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="active">active</option>
                            <option value="inactive">inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Order</label>
                        <input type="number" name="display_order" class="form-control" value="0">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Partner</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection