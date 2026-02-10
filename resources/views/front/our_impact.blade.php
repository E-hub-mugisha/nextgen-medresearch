@extends('layouts.guest')
@section('title','Impact That Matters')
@section('content')


<div class="why-choose-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <!-- Why Choose Image Box Start -->
                <div class="why-choose-image-box" style="padding-top: 50px;">
                    <!-- Why Choose Image Start -->
                    <div class="why-choose-image">
                        <figure class="image-anime reveal" style="transform: translate(0px, 0px); opacity: 1; visibility: inherit;">
                            <img src="{{ asset('assets/images/IYP_6213.jpg') }}" alt="" style="transform: translate(0px, 0px); height: 20rem;">
                        </figure>
                    </div>
                    <!-- Why Choose Image End -->
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
                            Our Impact That Matters
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
                                            <img src="{{ asset('assets/images/icon-why-choose-1.svg') }}" alt="">
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
                                <a href="{{ route('contact') }}" class="btn-default">contact us</a>
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

<div class="our-faqs">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- FAQs Content Start -->
                <div class="faqs-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Help us expand our reach and empower more researchers.</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">Support the growth of Africa’s next generation of medical researchers.</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">Help us expand our reach and empower more researchers. Support the growth of Africa’s next generation of medical researchers.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Our Faqs Button Start -->
                    <div class="our-faqs-btn wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <a href="{{ route('partners') }}" class="btn-default">Partner With Us</a>
                    </div>
                    <!-- Our Faqs Button End -->
                </div>
                <!-- FAQs Content End -->
            </div>
        </div>
    </div>
</div>

@endsection