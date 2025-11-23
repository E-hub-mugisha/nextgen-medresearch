@extends('layouts.guest')
@section('title','Home')
@section('content')

<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Mentorship Hub</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mentorship Hub</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="how-it-work">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- How Work Image Box Start -->
                <div class="how-work-image-box">
                    <!-- How Work Image Start -->
                    <div class="how-work-image image-anime">
                        <figure>
                            <img src="{{ asset('assets/images/how-work-image.jpg') }}" alt="">
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

            <div class="col-lg-6">
                <!-- How Work Content Start -->
                <div class="how-work-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Mentorship Hub</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                            Mentorship Hub
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">We match senior researchers and clinicians with young professionals to accelerate academic and clinical growth</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Work Steps List Start -->
                    <div class="work-steps-list">
                        <!-- How Steps Item Start -->
                        <div class="work-steps-item wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                            <div class="work-step-no">
                                <h3>Step 01</h3>
                            </div>
                            <div class="work-step-content">
                                <h3>Mentor–Mentee Matching Portal</h3>
                                <p>You'll meet with our scientific advisors to define your research goals, scope, timeline, and budget.</p>
                            </div>
                        </div>
                        <!-- How Steps Item End -->

                        <!-- How Steps Item Start -->
                        <div class="work-steps-item wow fadeInUp" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                            <div class="work-step-no">
                                <h3>Step 02</h3>
                            </div>
                            <div class="work-step-content">
                                <h3>Profile system by specialty, goals, and research interest</h3>
                                <p>Our team selects the right techniques, tools, and protocols to meet your scientific and regulatory requirements.</p>
                            </div>
                        </div>
                        <!-- How Steps Item End -->

                        <!-- How Steps Item Start -->
                        <div class="work-steps-item wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                            <div class="work-step-no">
                                <h3>Step 03</h3>
                            </div>
                            <div class="work-step-content">
                                <h3>Progress tracking dashboard</h3>
                                <p>Using advanced equipment and strict quality controls, we carry out all lab procedures with precision.</p>
                            </div>
                        </div>
                        <!-- How Steps Item End -->
                         <div class="approach-button wow fadeInUp" data-wow-delay="0.8s">
                        <a href="pricing.html" class="btn-default">Join as Mentee</a>
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