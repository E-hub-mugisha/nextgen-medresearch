@extends('layouts.join')
@section('title', $mentor->name )
@section('content')

<div class="page-team-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Team Single Box Start -->
                <div class="team-single-box">
                    <!-- Sticky Header -->
                    <div class="sticky-header shadow-sm mb-4 rounded-3">
                        <div class="container d-flex justify-content-between align-items-center py-2">

                            <!-- Back Button -->
                            <a href="{{ url()->previous() }}" class="btn-default me-3">
                                ← Back
                            </a>

                            <!-- Mentor Name -->
                            <h4 class="mb-0 flex-grow-1 text-center">{{ $mentor->name }}</h4>

                            <!-- Request Button -->
                            <button id="requestBtn" data-id="{{ $mentor->id }}" class="btn-default">
                                Request Mentorship
                            </button>

                        </div>
                    </div>
                    <!-- Team About Box Start -->
                    <div class="team-about-box">
                        <!-- Team Single Image Start -->
                        <div class="team-single-image">
                            <figure class="image-anime reveal" style="transform: translate(0px, 0px); opacity: 1; visibility: inherit;">
                                <img src="{{ asset('assets/images/default-profile.png') }}" alt="" style="transform: translate(0px, 0px);">
                            </figure>
                        </div>
                        <!-- Team Single Image End -->

                        <!-- Team About Content Start -->
                        <div class="team-about-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                                    {{ $mentor->name }}
                                </h2>
                                <p class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">{{ $mentor->mentorProfile->expertise ?? '-' }}</p>
                            </div>
                            <!-- Section Title End -->

                            <!-- Member Social List Start -->
                            <div class="member-social-list wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <!-- Member Social List End -->

                            <!-- Section Title Start -->
                            <div class="section-title">
                                <p>{{ $mentor->mentorProfile->bio ?? 'No bio available' }}</p>
                            </div>
                            <!-- Section Title End -->

                            <!-- Team Contact List Start -->
                            <div class="team-contact-list wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <!-- Team Contact Item Start -->
                                <div class="team-contact-item">
                                    <div class="icon-box">
                                        <img src="images/icon-location.svg" alt="">
                                    </div>
                                    <div class="team-contact-content">
                                        <p>Location</p>
                                        <h3>{{ $mentor->mentorProfile->country ?? '-' }}</h3>
                                    </div>
                                </div>
                                <!-- Team Contact Item End -->

                                <!-- Team Contact Item Start -->
                                <div class="team-contact-item">
                                    <div class="icon-box">
                                        <img src="images/icon-phone.svg" alt="">
                                    </div>
                                    <div class="team-contact-content">
                                        <p>Rating: </p>
                                        <h3>
                                            {{ number_format($mentor->reviews_avg_rating ?? 0, 1) }} / 5
                                            ({{ $mentor->reviews_count }} reviews)
                                        </h3>
                                    </div>
                                </div>
                                <!-- Team Contact Item End -->

                                <!-- Team Contact Item Start -->
                                <div class="team-contact-item">
                                    <div class="icon-box">
                                        <img src="images/icon-mail.svg" alt="">
                                    </div>
                                    <div class="team-contact-content">
                                        <p>email address</p>
                                        <h3>info@domainname.com</h3>
                                    </div>
                                </div>
                                <!-- Team Contact Item End -->

                                <div class="mb-3">
                                    <button id="requestBtn" data-id="{{ $mentor->id }}" class="btn-default">
                                        Request Mentorship
                                    </button>

                                </div>
                            </div>
                            <!-- Team Contact List End -->
                        </div>
                        <!-- Team About Content End -->
                    </div>
                    <!-- Team About Box End -->

                    <!-- Team Member Contact Box Start -->
                    <div class="team-member-contact-box">
                        <!-- Team Member Contact Info Start -->
                        <div class="team-member-contact-info">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                                    Reviews
                                </h2>
                                @if($mentor->reviews->count() > 0)
                                <ul class="list-group">
                                    @foreach($mentor->reviews as $review)
                                    <li class="list-group-item">
                                        <strong>{{ $review->mentee?->name ?? 'Anonymous' }}</strong>

                                        <span class="text-warning">
                                            @for($i = 0; $i < round($review->rating); $i++)
                                                ★
                                                @endfor
                                        </span>

                                        <p>{{ $review->review }}</p>
                                    </li>
                                    @endforeach
                                </ul>
                                @else
                                <p class="text-muted">No reviews yet.</p>
                                @endif
                            </div>
                            <!-- Section Title End -->
                        </div>
                        <!-- Team Member Contact Info End -->

                        <!-- Contact Form Start -->
                        <div class="contact-form contact-us-form wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                            <form id="contactForm" action="#" method="POST" data-toggle="validator" novalidate="true">
                                <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-12 mb-5">
                                        <textarea name="message" class="form-control" id="message" rows="4" placeholder="Message..."></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn-default btn-highlighted disabled"><span>Submit Message</span></button>
                                        <div id="msgSubmit" class="h3 hidden"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Contact Form End -->
                    </div>
                    <!-- Team Member Contact Box End -->
                </div>
                <!-- Team Single Box End -->
            </div>
        </div>
    </div>
</div>
@if($similarMentors->count() > 0)
<div class="our-team">
    <div class="container">
        <div class="row section-row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Our Mentors</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                        Similar Mentors
                    </h2>
                </div>
                <!-- Section Title End -->
            </div>
        </div>

        <div class="row">
            <div class="similar-mentors-carousel d-flex overflow-auto gap-3 pb-2">
                @foreach($similarMentors as $simMentor)
                <div class="col-lg-3 col-md-6">
                    <!-- Team Member Item Start -->
                    <div class="team-item wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <!-- Team Image Start -->
                        <div class="team-image">
                            <a href="{{ route('mentor.profile',$simMentor->id) }}" data-cursor-text="View">
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
                            <h3><a href="{{ route('mentor.profile',$simMentor->id) }}">{{ $simMentor->name }}</a></h3>
                            <p>{{ $simMentor->mentorProfile->expertise ?? '-' }}</p>
                            <p class="text-muted mb-1">Rating: {{ number_format($simMentor->reviews_avg_rating ?? 0,1) }}/5 ({{ $simMentor->reviews_count }})</p>
                        </div>
                        <!-- Team Content End -->
                        <a href="{{ route('mentor.profile',$simMentor->id) }}" class="btn-default">View Profile</a>
                    </div>
                    <!-- Team Member Item End -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
<style>
    .list-group-item {
        border: none;
        padding: 15px 10px;
    }

    .similar-mentors-carousel::-webkit-scrollbar {
        height: 6px;
    }

    .similar-mentors-carousel::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }

    .similar-mentors-carousel .card {
        transition: transform 0.2s;
    }

    .similar-mentors-carousel .card:hover {
        transform: translateY(-5px);
    }

    /* Sticky Header */
    .sticky-header {
        position: sticky;
        top: 0;
        background: #fff;
        z-index: 1050;
        border-bottom: 1px solid #dee2e6;
    }

    /* Similar Mentors Carousel */
    .similar-mentors-carousel .card {
        transition: transform 0.3s ease;
    }

    .similar-mentors-carousel .card:hover {
        transform: translateY(-5px);
    }
</style>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        $('#requestBtn').click(function() {
            let mentorId = $(this).data('id');

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
                        url: "/mentor/" + mentorId + "/request",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            Swal.close();
                            if (res.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Requested Successfully!',
                                    text: 'You will be redirected to your panel...',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    // Redirect to mentee panel/dashboard
                                    window.location.href = "{{ route('portal.dashboard') }}";
                                });
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