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
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Our Impact That Matters</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Impact That Matters</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="why-choose-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <!-- Why Choose Image Box Start -->
                <div class="why-choose-image-box">
                    <!-- Why Choose Image Start -->
                    <div class="why-choose-image">
                        <figure class="image-anime reveal" style="transform: translate(0px, 0px); opacity: 1; visibility: inherit;">
                            <img src="images/why-choose-image.jpg" alt="" style="transform: translate(0px, 0px);">
                        </figure>
                    </div>
                    <!-- Why Choose Image End -->

                    <!-- Satisfy Client Box Start -->
                    <div class="satisfy-client-box">
                        <!-- Satisfy Client Images Start -->
                        <div class="satisfy-client-images">
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="images/satisfy-client-img-1.jpg" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="images/satisfy-client-img-2.jpg" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="images/satisfy-client-img-3.jpg" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="images/satisfy-client-img-4.jpg" alt="">
                                </figure>
                            </div>
                            <div class="satisfy-client-image add-more">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <!-- Satisfy Client Images End -->

                        <!-- Satisfy Client Content Start -->
                        <div class="satisfy-client-content">
                            <h3>Proven Track Record</h3>
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
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Impact That Matters</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                            Our mission is not just to train — but to transform.
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            NextGen MedResearch measures success through real-world outcomes: stronger research capacity, published studies, improved clinical practice, and empowered healthcare professionals.
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
                                <div class="why-choose-item wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                    <div class="why-choose-item-header">
                                        <div class="icon-box">
                                            <img src="images/icon-why-choose-1.svg" alt="">
                                        </div>
                                        <div class="why-choose-item-title">
                                            <h3>Proven Track Record</h3>
                                        </div>
                                    </div>
                                    <div class="why-choose-item-content">
                                        <p>Our impact is visible in hospitals, universities, communities, and policy discussions across Africa.</p>
                                    </div>
                                </div>
                                <!-- Why Choose Item End -->
                            </div>
                            <!-- Why Choose Item List End -->

                            <!-- Why choose Button Start -->
                            <div class="why-choose-btn wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                                <a href="contact.html" class="btn-default">contact us</a>
                            </div>
                            <!-- Why choose Button End -->
                        </div>
                        <!-- Why Choose Item Box End -->

                        <!-- Why Choose Body Image Start -->
                        <div class="why-choose-body-image">
                            <figure class="image-anime reveal" style="transform: translate(0px, 0px); opacity: 1; visibility: inherit;">
                                <img src="images/why-choose-body-image.jpg" alt="" style="transform: translate(0px, 0px);">
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

<div class="what-we-do bg-section dark-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9">
                <!-- What We Content Start -->
                <div class="what-we-contant">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">What We Do</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                            Community Impact
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">Beyond academia, our work reaches communities through</p>
                    </div>
                    <!-- Section Title End -->
                    <div class="what-we-item-list mb-4">
                        <!-- What We Item Start -->
                        <div class="what-we-item wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <div class="icon-box">
                                <img src="{{ asset('assets/images/icon-what-we-item-1.svg') }}" alt="">
                            </div>
                            <div class="what-we-content">
                                <p>training programs, action research and emergency response tools</p>
                            </div>
                        </div>
                        <!-- What We Item End -->
                    </div>

                    <!-- What We Button Start -->
                    <div class="what-we-btn wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <a href="contact.html" class="btn-default btn-highlighted">Rescue Sheet</a>
                    </div>
                    <!-- What We Button End -->

                    <!-- What We Counter Box Start -->
                    <div class="what-we-counter-box">
                        <p>Including the Rescue Sheet initiative used in hospitals and ambulances.</p>
                    </div>
                    <!-- What We Counter Box End -->
                </div>
                <!-- What We Content End -->
            </div>
        </div>
    </div>
</div>

<div class="our-faqs">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- FAQs Content Start -->
                <div class="faqs-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Help us expand our reach and empower more researchers.</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">Support the growth of Africa’s next generation of medical innovators.</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">Help us expand our reach and empower more researchers. Support the growth of Africa’s next generation of medical innovators.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Our Faqs Button Start -->
                    <div class="our-faqs-btn wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <a href="faqs.html" class="btn-default">Partner With Us</a>
                    </div>
                    <!-- Our Faqs Button End -->
                </div>
                <!-- FAQs Content End -->
            </div>
        </div>
    </div>
</div>

@endsection