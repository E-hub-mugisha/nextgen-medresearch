@extends('layouts.guest')
@section('title', $program->title)
@section('content')

<div class="how-it-work">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <!-- How Work Image Box Start -->
                <div class="how-work-image-box" style="padding-top: 50px;">
                    <!-- How Work Image Start -->
                    <div class="how-work-image image-anime">
                        <figure>
                            <img src="{{ asset('assets/images/why-choose-body-image.jpg') }}" alt="">
                        </figure>
                    </div>
                    <!-- How Work Image End -->
                </div>
                <!-- How Work Image Box End -->
            </div>

            <div class="col-lg-7">
                <!-- How Work Content Start -->
                <div class="how-work-content" style="padding-top: 50px;">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">{{ $program->title }}</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            {{ $program->title }}
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            {!! nl2br(e($program->description)) !!}
                        </p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Work Steps List Start -->
                    <div class="work-steps-list">
                        <!-- How Steps Item Start -->
                        <div class="how-steps-item wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                            <div class="how-steps-content">
                                <h3>Apply as Mentee or Mentor</h3>
                                <p>Submit your application to join our mentorship program.</p>
                            </div>
                            <div class="approach-button wow fadeInUp" data-wow-delay="0.8s">
                                <a role="button" data-bs-toggle="modal" data-bs-target="#roleModal" class="btn-default">Join</a>
                            </div>
                        </div>
                    </div>
                    <!-- Work Steps List End -->
                </div>
                <!-- How Work Content End -->
            </div>
        </div>
    </div>
</div>

@endsection