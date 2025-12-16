@extends('layouts.join')
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h3 class="text-center mb-4">Available Mentors</h3>

        <div class="row" id="mentorList">
            @foreach($mentors as $mentor)
            <div class="col-md-4 mb-4 mentor-card" data-id="{{ $mentor->id }}">
                <div class="card p-3 shadow-sm">
                    <h5>{{ $mentor->name }}</h5>
                    <p><strong>Bio:</strong> {{ $mentor->mentorProfile->bio ?? '-' }}</p>
                    <p><strong>Expertise:</strong> {{ $mentor->mentorProfile->expertise ?? '-' }}</p>
                    <button class="btn btn-gradient-primary request-btn">
                        Request
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .btn-gradient-primary {
        background: linear-gradient(90deg, #4e54c8, #8f94fb);
        color: #fff;
        border: none;
    }

    .btn-gradient-primary:hover {
        opacity: 0.9;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        // Request mentor via AJAX
        $(document).on('click', '.request-btn', function() {
            let btn = $(this);
            let mentorId = btn.closest('.mentor-card').data('id');

            Swal.fire({
                title: 'Send Mentorship Request?',
                showCancelButton: true,
                confirmButtonText: 'Yes, Request',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Sending...',
                        didOpen: () => Swal.showLoading(),
                        allowOutsideClick: false
                    });
                    $.ajax({
                        url: "{{ url('mentors') }}/" + mentorId + "/request", // Dynamically insert ID
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            Swal.close();
                            if (res.success) {
                                Swal.fire('Requested!', res.message, 'success');
                                btn.text('Pending').prop('disabled', true);
                            }
                        },
                        error: function(xhr) {
                            Swal.close();
                            let msg = xhr.responseJSON?.message || 'Could not send request';
                            Swal.fire('Error', msg, 'error');
                        }
                    });

                }
            });
        });

    });
</script>
@endsection