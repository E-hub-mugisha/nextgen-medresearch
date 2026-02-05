@extends('layouts.join')
@section('title', 'Available Mentors')
@section('content')

<div class="our-team">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Our mentors</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                        Available Mentors
                    </h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            @foreach($mentors as $mentor)
            <div class="col-lg-3 col-md-6">
                    <!-- Team Member Item Start -->
                    <div class="team-item wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <!-- Team Image Start -->
                        <div class="team-image">
                            <a href="{{ route('mentor.profile',$mentor->id) }}" data-cursor-text="View">
                                <figure>
                                    <img src="{{ asset('assets/images/default-profile.png') }}" alt="">
                                </figure>
                            </a>

                            <!-- Team Social Icon Start -->
                            <div class="team-social-icon">
                                <ul>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <!-- Team Social Icon End -->
                        </div>
                        <!-- Team Image End -->

                        <!-- Team Content Start -->
                        <div class="team-content">
                            <h3><a href="{{ route('mentor.profile',$mentor->id) }}">{{ $mentor->name }}</a></h3>
                            <p>{{ $mentor->mentorProfile->expertise ?? '-' }}</p>
                            <p class="text-muted mb-1">Rating: {{ number_format($mentor->reviews_avg_rating ?? 0,1) }}/5 ({{ $mentor->reviews_count }})</p>
                        </div>
                        <!-- Team Content End -->
                        <a href="{{ route('mentor.profile',$mentor->id) }}" class="btn-default">View Profile</a>
                    </div>
                    <!-- Team Member Item End -->
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
@endsection

@section('scripts')
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
                        url: "{{ url('mentors') }}/" + mentorId + "/request",
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