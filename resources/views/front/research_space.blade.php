@extends('layouts.guest')
@section('title','Research Space')
@section('content')

<!-- Why Choose Us Section Start -->
<div class="why-choose-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <!-- Why Choose Image Box Start -->
                <div class="why-choose-image-box mt-5">
                    <!-- Why Choose Image Start -->
                    <div class="why-choose-image">
                        <figure class="image-anime reveal">
                            <img src="{{ asset('assets/images/why-choose-image.jpg') }}" alt="">
                        </figure>
                    </div>
                    <!-- Why Choose Image End -->

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
                            <div class="satisfy-client-image add-more">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <!-- Satisfy Client Images End -->

                        <!-- Satisfy Client Content Start -->
                        <div class="satisfy-client-content">
                            <h3>Dissertation-Ready Research Topics</h3>
                        </div>
                        <!-- Satisfy Client Content End -->
                    </div>
                    <!-- Satisfy Client Box End -->
                </div>
                <!-- Why Choose Image Box End -->
            </div>

            <div class="col-lg-7">
                <!-- Why Choose Content Start -->
                <div class="why-choose-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Research Space</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Dissertation-Ready Research Topics</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            Dissertation-Ready Topics are developed through literature reviews, analysis of existing
                            university research repositories, and consultations with experienced clinicians and researchers
                            to ensure feasibility, relevance, and academic quality.
                        </p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Why Choose Body Start -->
                    <div class="why-choose-body">
                        <!-- Why Choose Item Box Start -->
                        <div class="why-choose-item-box">
                            <!-- Why Choose Item List Start -->
                            <div class="why-choose-item-list">
                                <!-- Why Choose Item Start -->
                                <div class="why-choose-item wow fadeInUp" data-wow-delay="0.4s">

                                    <div class="why-choose-item-content">
                                        <p>Each topic is designed to be feasible, ethically sound, impactful, and aligned with national and global health priorities.</p>
                                    </div>
                                </div>
                                <!-- Why Choose Item End -->
                            </div>
                            <!-- Why Choose Item List End -->

                            <!-- Why choose Button Start -->
                            <div class="why-choose-btn wow fadeInUp" data-wow-delay="0.8s">
                                <a href="{{ route('contact') }}" class="btn-default">contact us</a>
                            </div>
                            <!-- Why choose Button End -->
                        </div>
                        <!-- Why Choose Item Box End -->

                        <!-- Why Choose Body Image Start -->
                        <div class="why-choose-body-image">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('assets/images/why-choose-body-image.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Why Choose Body Image End -->
                    </div>
                    <!-- Why Choose Body End -->
                </div>
                <!-- Why Choose Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Why Choose Us Section End -->

<!-- What We Do Section Start -->
<div class="what-we-do bg-section dark-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <!-- What We Content Start -->
                <div class="what-we-contant">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Sample Dissertation Topic</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Sample Dissertation Topic</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            Dissertation-Ready Topics are developed through literature reviews, University of Rwanda research portal analysis,
                            and expert consultations with clinicians and researchers to ensure feasibility, relevance, and academic quality.
                        </p>
                    </div>
                    <!-- Section Title End -->

                    <!-- What We Button Start -->
                    <div class="what-we-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a role="button" data-bs-toggle="modal" data-bs-target="#membershipModal" class="btn-default btn-highlighted">Join Us</a>
                        <p class="mt-3 text-white">Unlock your potential. Connect, contribute, and lead Africa’s next generation of medical researchers</p>
                    </div>
                    <!-- What We Button End -->

                </div>
                <!-- What We Content End -->
            </div>

            <div class="col-lg-7">
                <!-- What We Item List Start -->
                <div class="what-we-item-list">

                    <!-- What We Item Start -->
                    <div class="what-we-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icon-what-we-item-2.svg') }}" alt="">
                        </div>
                        <div class="what-we-content">
                            <h3>Title</h3>
                            <p>
                                Assessing the Impact of Digital Health Solutions on Patient Follow-Up and Treatment Compliance
                                in Public Hospitals.
                            </p>
                        </div>
                    </div>
                    <!-- What We Item End -->

                    <!-- What We Item Start -->
                    <div class="what-we-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icon-what-we-item-3.svg') }}" alt="">
                        </div>
                        <div class="what-we-content">
                            <h3>Who It’s For</h3>
                            <p>
                                Medical Students, Public Health Students, Residents, Fellows, Health Informatics Students,
                                and other Healthcare Professionals seeking strong, publication-ready research topics.
                            </p>
                        </div>
                    </div>
                    <!-- What We Item End -->

                    <!-- What We Item Start -->
                    <div class="what-we-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icon-what-we-item-4.svg') }}" alt="">
                        </div>
                        <div class="what-we-content">
                            <h3>Why This Is Important</h3>
                            <p>
                                Many health systems struggle with patient follow-up, missed appointments, delayed treatment,
                                and poor continuity of care. Understanding whether digital tools such as SMS reminders,
                                telemedicine platforms, and electronic follow-up systems improve outcomes can help guide policy,
                                enhance patient care, and reduce preventable complications.
                            </p>
                        </div>
                    </div>
                    <!-- What We Item End -->
                    <!-- What We Item Start -->
                    <div class="what-we-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icon-what-we-item-4.svg') }}" alt="">
                        </div>
                        <div class="what-we-content">
                            <h3>Confirm with a Mentor</h3>
                            <p>
                                Confirming with a mentor ensures your topic is academically sound, ethically feasible,
                                methodologically strong, and aligned with available data and institutional priorities.
                                Mentor guidance helps refine objectives, study design, data collection strategy, and
                                statistical analysis approach.
                            </p>
                        </div>
                    </div>
                    <!-- What We Item End -->
                </div>
                <!-- What We Item List End -->
            </div>
        </div>
    </div>
</div>
<!-- What We Do Section End -->

<!-- Why Choose Us Section Start -->
<div class="why-choose-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <!-- Why Choose Image Box Start -->
                <div class="why-choose-image-box">
                    <!-- Why Choose Image Start -->
                    <div class="why-choose-image">
                        <figure class="image-anime reveal">
                            <img src="{{ asset('assets/images/why-choose-image.jpg') }}" alt="">
                        </figure>
                    </div>
                    <!-- Why Choose Image End -->

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
                            <div class="satisfy-client-image add-more">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <!-- Satisfy Client Images End -->

                        <!-- Satisfy Client Content Start -->
                        <div class="satisfy-client-content">
                            <h3>Research Space Supports</h3>
                        </div>
                        <!-- Satisfy Client Content End -->
                    </div>
                    <!-- Satisfy Client Box End -->
                </div>
                <!-- Why Choose Image Box End -->
            </div>

            <div class="col-lg-7">
                <!-- Why Choose Content Start -->
                <div class="why-choose-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Research Space</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Who This Research Space Supports</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            This research space is designed to support learners and professionals who want strong,
                            realistic and academically defensible dissertation topics
                        </p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Why Choose Body Start -->
                    <div class="why-choose-body">
                        <!-- Why Choose Item Box Start -->
                        <div class="why-choose-item-box">
                            <!-- Why Choose Item List Start -->
                            <div class="why-choose-item-list">
                                <!-- Why Choose Item Start -->
                                <div class="why-choose-item wow fadeInUp" data-wow-delay="0.4s">

                                    <div class="why-choose-item-content">
                                        <p> Undergraduate and Postgraduate Students</p>
                                    </div>
                                    <div class="why-choose-item-content">
                                        <p>Medical Residents and Fellows</p>
                                    </div>
                                    <div class="why-choose-item-content">
                                        <p>Public Health and Health Policy Students</p>
                                    </div>
                                    <div class="why-choose-item-content">
                                        <p>Clinical and Applied Health Researchers</p>
                                    </div>
                                </div>
                                <!-- Why Choose Item End -->
                            </div>
                            <!-- Why Choose Item List End -->

                            <!-- Why choose Button Start -->
                            <div class="why-choose-btn wow fadeInUp" data-wow-delay="0.8s">
                                <a href="{{ route('contact') }}" class="btn-default">Join us</a>
                            </div>
                            <!-- Why choose Button End -->
                        </div>
                        <!-- Why Choose Item Box End -->
                    </div>
                    <!-- Why Choose Body End -->
                </div>
                <!-- Why Choose Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Why Choose Us Section End -->

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
                        <h3 class="wow fadeInUp">Why This Matters</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque" style="font-size: 30px;">Why This Space is Important</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            Many students struggle with unclear topics, lack of direction, or choosing research ideas that are either too broad or not academically relevant.

                        </p>
                    </div>
                    <!-- Section Title End -->
                    <p class="wow fadeInUp" data-wow-delay="0.2s">
                        This Research Space bridges that gap by offering well-thought-out, realistic, and academically strong dissertation ideas
                        that respond to real healthcare challenges in Rwanda and beyond.
                    </p>
                    <!-- Approach Button Start -->
                    <div class="approach-button wow fadeInUp" data-wow-delay="0.8s">
                        <a href="#model" class="btn-default">Get Mentorship</a>
                    </div>
                    <!-- Approach Button End -->
                </div>
                <!-- Approach Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Our Approach Section End -->

<div class="our-approach mb-4">
    <div class="container">
        <div class="row">
            <div class="section-title">
                <h3 class="wow fadeInUp">Why This Matters</h3>
                <h2 class="text-anime-style-3" data-cursor="-opaque" style="font-size: 30px;">Why This Space is Important</h2>
                <p class="wow fadeInUp mb-4" data-wow-delay="0.2s">
                    Many students struggle with unclear topics, lack of direction, or choosing research ideas that are either too broad or not academically relevant.
                </p>
                <button class="btn-default">
                    Confirm with a Mentor
                </button>
            </div>
        </div>
    </div>
</div>
@endsection