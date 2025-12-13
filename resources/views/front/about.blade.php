@extends('layouts.guest')
@section('title','WHO WE ARE')
@section('content')

<!-- Our Core Value Section Start -->
<div class="our-core-value mt-10">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- Core Value Image Start -->
                <div class="core-value-image" style="padding-top: 50px;">
                    <div class="value-image-box-1">
                        <div class="value-img-1">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('assets/images/IYP_6213.jpg') }}" alt="">
                            </figure>
                        </div>
                    </div>
                    <div class="value-image-box-2">
                        <!-- About Experience Box Start -->
                        <div class="about-experience-box">
                            <div class="icon-box">
                                <img src="{{ asset('assets/images/icon-experience.svg') }}" alt="">
                            </div>
                            <div class="experience-box-content">
                                <h2><span class="counter">12</span>+</h2>
                                <p>Years of experience</p>
                            </div>
                        </div>
                        <!-- About Experience Box End -->

                        <div class="value-img-2">
                            <figure class="image-anime">
                                <img src="{{ asset('assets/images/banner_New1.jpg') }}" alt="">
                            </figure>
                        </div>
                    </div>
                </div>
                <!-- Our Value Image End -->
            </div>

            <div class="col-lg-6">
                <!-- Core Value Content Start -->
                <div class="core-value-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">About us</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Who We Are</h2>
                    </div>
                    <!-- Section Title End -->

                    <!-- Our Experiment List Start -->
                    <div class="our-experiment-list">
                        <!-- Our Experiment Item Start -->
                        <div class="our-experiment-item wow fadeInUp" data-wow-delay="0.2s">
                            <p>NextGen MedResearch.org is a social innovation initiative dedicated to building the next generation of medical researchers in Africa.</p>
                        </div>
                        <!-- Our Experiment Item End -->

                        <!-- Our Experiment Item Start -->
                        <div class="our-experiment-item wow fadeInUp" data-wow-delay="0.4s">
                            <p>We connect clinicians, researchers, mentors, and institutions to strengthen research capacity, accelerate publication, and drive impactful health innovations across the continent.</p>
                        </div>
                        <!-- Our Experiment Item End -->
                    </div>
                    <!-- Our Experiment List End -->
                </div>
                <!-- Core Value Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Our Value Section End -->


<!-- Our Approach Section Start -->
<div class="our-approach bg-section mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <!-- Approach Image Start -->
                <div class="approach-image">
                    <figure class="image-anime reveal">
                        <img src="{{ asset('assets/images/why-choose-image.jpg') }}" alt="">
                    </figure>
                </div>
                <!-- Approach Image End -->
            </div>

            <div class="col-lg-7">
                <!-- Approach Content Start -->
                <div class="approach-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Our Approach</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque" style="font-size: 30px;">Timely, Personalized, and Accessible research mentorship</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">We provide timely, personalized, and accessible research mentorship that connects all levels and drives impactful research.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Mission Vision List Start -->
                    <div class="mission-vision-list">
                        <!-- Mission Vision Item Start -->
                        <div class="mission-vision-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{ asset('assets/images/icon-mission.svg') }}" alt="">
                            </div>
                            <div class="mission-vision-content">
                                <h3>Our vision</h3>
                                <p>To transform medical research in Africa through mentorship, innovation, and collaboration.</p>
                            </div>
                        </div>
                        <!-- Mission Vision Item End -->

                        <!-- Mission Vision Item Start -->
                        <div class="mission-vision-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="icon-box">
                                <img src="{{ asset('assets/images/icon-vision.svg') }}" alt="">
                            </div>
                            <div class="mission-vision-content">
                                <h3>Our Mission</h3>
                                <p>We connect mentees, and mentors to build capacity, conduct impactful research projects, and shape future medical research leaders.</p>
                            </div>
                        </div>
                        <!-- Mission Vision Item End -->
                    </div>
                    <!-- Mission Vision List End -->

                    <!-- Approach Button Start -->
                    <div class="approach-button wow fadeInUp" data-wow-delay="0.8s">
                        <a href="#model" class="btn-default">our model</a>
                    </div>
                    <!-- Approach Button End -->
                </div>
                <!-- Approach Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Our Approach Section End -->

<div class="about-us">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-7">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Message</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                        Founder's message
                    </h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-5">
                <!-- Section Content Button Start -->
                <div class="section-content-btn">
                    <!-- Section Title Content Start -->
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <p>
                            Born from the challenges of limited research mentorship in Rwanda, NextGen MedResearch emerged to bridge gaps in mentorship,
                            training, and research collaboration.
                            We believe that every motivated clinician and researcher deserves access to guidance, opportunities,
                            and resources that enable them to contribute meaningfully to Africa’s health systems.</p>
                    </div>
                    <!-- Section Content Button End -->
                </div>
                <!-- Section Content Button End -->
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-12">
                <!-- About Us Images Start -->
                <div class="about-us-boxes">
                    <!-- About Image Content Box Start -->
                    <div class="about-image-content-box-1">
                        <!-- About Us Image Start -->
                        <div class="about-image">
                            <figure>
                                <img src="{{ asset('assets/images/about-us-image-1.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- About Us Image End -->

                        <!-- About Image Content Start -->
                        <div class="about-image-content">
                            <!-- Video Play Button Start -->
                            <div class="video-play-button">
                                <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                    <i class="fa-solid fa-play"></i>
                                </a>
                            </div>
                            <!-- Video Play Button End -->

                            <!-- About Video Title Start -->
                            <div class="about-video-title">
                                <h3>How Does it Work?</h3>
                            </div>
                            <!-- About Video Title End -->
                        </div>
                        <!-- About Image Content End -->
                    </div>
                    <!-- About Image Content Box End -->

                    <!-- About Counter Box Start -->
                    <div class="about-counter-box">
                        <!-- About Counter Title Start -->
                        <div class="about-counter-title">
                            <h2>Our Model</h2>
                        </div>
                        <!-- About Counter Title End -->

                        <!-- About Counter Content Start -->
                        <div class="about-counter-content">
                            <ul>

                                <li>Mentorship</li>

                                <li>Research Collaboration</li>

                                <li>Capacity Building & Innovation</li>

                                <li>Collaborative Scientific Partnerships</li>
                            </ul>
                            <a href="{{ route('our-impact') }}" class="readmore-btn">Our Impact</a>
                        </div>
                        <!-- About Counter Content End -->
                    </div>
                    <!-- About Counter Box End -->

                    <!-- About Image Content Box Start -->
                    <div class="about-image-content-box-2">
                        <!-- About Us Image Start -->
                        <div class="about-image">
                            <figure>
                                <img src="{{ asset('assets/images/about-us-image-2.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- About Us Image End -->

                        <!-- About Image Content Start -->
                        <div class="about-image-content">
                            <ul>
                                <li>Innovative Research</li>
                                <li>Scientific Excellence</li>
                                <li>Data-Driven Discovery</li>
                                <li>Trusted Expertise</li>
                            </ul>
                        </div>
                        <!-- About Image Content End -->
                    </div>
                    <!-- About Image Content Box End -->
                </div>
                <!-- About Us Images End -->
            </div>
        </div>
    </div>
</div>


@endsection