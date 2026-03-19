@extends('layouts.guest')
@section('title','Partnership & Collaboration')
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
                            <img src="{{ asset('assets/images/banner_New1.jpg') }}" alt="">
                        </figure>
                    </div>
                    <!-- How Work Image End -->
                </div>
                <!-- How Work Image Box End -->
            </div>

            <div class="col-lg-7">
                <!-- How Work Content Start -->
                <div class="how-work-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Partnership & Collaboration</h3>

                        <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            At NextGen MedResearch, we believe that meaningful impact in Africa’s health sector is achieved through collaboration.
                            We work hand-in-hand with academic institutions, hospitals, professional associations, and global partners to strengthen research capacity, mentorship, and innovation.
                        </p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Work Steps List Start -->
                    <div class="work-steps-list">
                        <!-- How Steps Item Start -->
                        <div class="work-steps-item wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                            <div class="work-step-no">
                                <h3 class="text-white"><img src="{{ asset('assets/images/users.png') }}" alt="Step 01"></h3>
                            </div>
                            <div class="work-step-content">
                                <p>Expand training opportunities and support high-impact research</p>
                            </div>
                        </div>
                        <!-- How Steps Item End -->

                        <!-- How Steps Item Start -->
                        <div class="work-steps-item wow fadeInUp" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                            <div class="work-step-no">
                                <h3 class="text-white"><img src="{{ asset('assets/images/microscope.png') }}" alt="Step 02"></h3>
                            </div>
                            <div class="work-step-content">
                                <p>
                                    Improve clinical practice connect experts across regions influence policy and healthcare outcomes</p>
                            </div>
                        </div>
                        <!-- How Steps Item End -->

                        <!-- How Steps Item Start -->
                        <div class="work-steps-item wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                            <div class="work-step-no">
                                <h3 class="text-white"><img src="{{ asset('assets/images/globe.png') }}" alt="Step 03"></h3>
                            </div>
                            <div class="work-step-content">
                                <p>Together, we are shaping the future of medical research in Africa.</p>
                            </div>
                        </div>
                        <!-- How Steps Item End -->
                    </div>
                    <!-- Work Steps List End -->
                </div>
                <!-- How Work Content End -->
            </div>
        </div>
    </div>
</div>


<div class="our-pricing bg-section mt-4 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <!-- Our Pricing Content Start -->
                <div class="our-pricing-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp text-white" style="visibility: visible; animation-name: fadeInUp;" style="border: 1px solid #fff">Partnership</h3>
                        <p class="wow fadeInUp text-white" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">Partner with us to expand mentorship and digital training across Africa.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Pricing Button Start -->
                    <div class="our-pricing-btn wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <a data-bs-toggle="modal" data-bs-target="#partnershipModal" role="button" class="btn-default">Become a Partner</a>
                    </div>
                    <!-- Pricing Button End -->
                </div>
                <!-- Our Pricing Content End -->
            </div>

            <div class="col-lg-6">
                <!-- Pricing Box Start -->
                <div class="pricing-box">
                    <!-- Pricing Item Start -->
                    <div class="pricing-item wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <!-- Pricing Body Start -->
                        <div class="pricing-body">
                            <!-- Pricing List Start -->
                            <div class="pricing-list">
                                <ul>
                                    <li>Build sustainable research capacity</li>

                                    <li>Connect emerging and senior professionals</li>

                                    <li>Deliver measurable outcomes</li>

                                    <li>Drive innovation and community impact</li>
                                </ul>
                            </div>
                            <!-- Pricing List End -->
                        </div>
                        <!-- Pricing Body End -->
                    </div>
                    <!-- Pricing Item End -->

                </div>
                <!-- Pricing Box End -->
            </div>
        </div>
    </div>
</div>

<!-- PARTNERSHIPS SECTION -->
<section id="partnerships" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">our Partners</h2>
        </div>
        <!-- Partner Logos / Names -->
        <style>
            .partner-logo {
                height: 70px;
                width: 100%;
                max-width: 120px;
                object-fit: contain;
            }
        </style>

        <div class="row justify-content-center align-items-center mb-4">
            @foreach($partners as $item)
            <div class="col-6 col-md-2 text-center mb-3 d-flex justify-content-center align-items-center">

                @if($item->logo)
                <img
                    src="{{ asset('image/partners/'.$item->logo) }}"
                    alt="{{ $item->name }}"
                    class="partner-logo">
                @else
                <p class="mb-0">{{ $item->name }}</p>
                @endif

            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="modal fade" id="partnershipModal" tabindex="-1" aria-labelledby="partnershipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">

            <div class="modal-header border-0 px-4 pt-4 pb-0">
                <h5 class="modal-title" id="partnershipModalLabel">
                    Partnership Application
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('membership.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">

                        <!-- Full Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control">
                        </div>

                        <!-- Partners Type -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Partnership Type *</label>
                            <select name="type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="public_private">Public & Private</option>
                                <option value="academic_industrial">Academic & Industrial</option>
                                <option value="non_profit">Non-Profit</option>
                                <option value="strategic">Strategic</option>
                                <option value="clinical_hospital">Clinical & Hospital</option>
                                <option value="others">Others</option>
                            </select>
                        </div>

                        <!-- Organization -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Organization (if applicable)</label>
                            <input type="text" name="organization" class="form-control">
                        </div>

                        <!-- Motivation -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Why do you want to join? (Specific contribution)</label>
                            <textarea name="motivation" class="form-control" rows="4"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Submit Application
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection