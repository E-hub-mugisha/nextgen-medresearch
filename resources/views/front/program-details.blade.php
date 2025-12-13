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

                    <!-- Satisfy Client Box Start -->
                    <div class="satisfy-client-box">
                        <!-- Satisfy Client Images Start -->
                        <div class="satisfy-client-images">
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('assets/images/satisfy-client-img-1.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('assets/images/satisfy-client-img-2.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('assets/images/satisfy-client-img-3.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('assets/images/satisfy-client-img-4.jpg') }}" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('assets/images/satisfy-client-img-5.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <!-- Satisfy Client Images End -->

                        <!-- Satisfy Client Content Start -->
                        <div class="satisfy-client-content">
                            <h3>5K+ Satisfied Clients</h3>
                            <p>Trusted by organizations, institutions, and researchers worldwide.</p>
                        </div>
                        <!-- Satisfy Client Content End -->
                    </div>
                    <!-- Satisfy Client Box End -->
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
                                <h3>Apply as Mentee</h3>
                                <p>Submit your application to join our mentorship program.</p>
                            </div>
                            <div class="approach-button wow fadeInUp" data-wow-delay="0.8s">
                                <a href="#" class="btn-default">Join as Mentee</a>
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