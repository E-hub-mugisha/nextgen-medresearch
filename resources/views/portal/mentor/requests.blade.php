@extends('layouts.portal')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h3 class="mb-4 text-center">My Mentorship Requests</h3>

        @if($requests->isEmpty())
            <div class="text-center p-4">
                <h5>No Mentorship Requests Yet</h5>
                <p class="text-muted">Start exploring mentors and request mentorship.</p>
                <a href="{{ route('mentors.list') }}" class="btn btn-gradient-primary">
                    Find Mentors
                </a>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mentor Name</th>
                        <th>Expertise</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $mentor)
                    <tr>
                        <td>{{ $mentor->name }}</td>
                        <td>{{ $mentor->mentorProfile->expertise ?? 'No expertise provided' }}</td>
                        <td>
                            <span class="badge 
                                @if($mentor->pivot->status == 'pending') bg-warning text-dark
                                @elseif($mentor->pivot->status == 'approved') bg-success
                                @else bg-danger
                                @endif">
                                {{ ucfirst($mentor->pivot->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('mentor.details', $mentor->id) }}"
                               class="btn btn-outline-primary btn-sm me-2">
                                View Profile
                            </a>
                            @if($mentor->pivot->status == 'pending')
                            <button class="btn btn-danger btn-sm cancel-btn"
                                    data-id="{{ $mentor->id }}">
                                Cancel
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

{{-- Styles --}}
<style>
.btn-gradient-primary{
    background: linear-gradient(90deg,#4e54c8,#8f94fb);
    color:#fff;border:none;
}
.btn-gradient-primary:hover{opacity:.9;}
.table-hover tbody tr:hover{background:#f8f9ff;}
</style>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).on('click','.cancel-btn',function(){
    let mentorId = $(this).data('id');

    Swal.fire({
        title: 'Cancel Request?',
        text: "Are you sure you want to cancel this mentorship request?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Cancel',
        cancelButtonText: 'No',
    }).then(result => {
        if(result.isConfirmed){

            Swal.fire({
                title: 'Processing...',
                allowOutsideClick:false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: "/requests/" + mentorId + "/cancel",
                method: "DELETE",
                data:{
                    _token: "{{ csrf_token() }}"
                },
                success:function(res){
                    Swal.close();
                    Swal.fire('Cancelled', res.message,'success')
                        .then(()=> location.reload());
                },
                error:function(){
                    Swal.close();
                    Swal.fire('Error','Something went wrong','error');
                }
            });
        }
    });
});
</script>
@endsection
