@extends('layouts.portal')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h3 class="mb-4 text-center">My Mentorship Requests</h3>

        @if($requests->isEmpty())
            <div class="text-center p-4">
                <h5>No Mentorship Requests Yet</h5>
                <p class="text-muted">Start exploring mentors and request mentorship.</p>
                <a href="{{ route('mentors.list') }}" class="btn btn-primary">
                    Find Mentors
                </a>
            </div>
        @else
        <div class="row">
            @foreach($requests as $mentor)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm p-3 request-card">

                        <h5 class="fw-bold">{{ $mentor->name }}</h5>
                        <p class="text-muted mb-1">
                            {{ $mentor->mentorProfile->expertise ?? 'No expertise provided' }}
                        </p>

                        <span class="badge 
                            @if($mentor->pivot->status == 'pending') bg-warning
                            @elseif($mentor->pivot->status == 'approved') bg-success
                            @else bg-danger
                            @endif
                        ">
                            {{ ucfirst($mentor->pivot->status) }}
                        </span>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('mentor.details', $mentor->id) }}"
                               class="btn btn-outline-primary btn-sm">
                                View Profile
                            </a>

                            @if($mentor->pivot->status == 'pending')
                            <button class="btn btn-danger btn-sm cancel-btn"
                                    data-id="{{ $mentor->id }}">
                                Cancel Request
                            </button>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</div>


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
