@extends('layouts.guest')
@section('title','Get To Know')
@section('content')

<!-- Hero Section Start -->
<div class="hero dark-section parallaxie 100vh">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <!-- Hero Content Start -->
                <div class="hero-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <!-- <h3 class="wow fadeInUp">The next generation medsearch</h3> -->
                        <h1 class="text-anime-style-3" data-cursor="-opaque">Building the Next Generation of Medical Researchers in Africa</h1>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">A social innovation platform connecting clinicians, mentors, and institutions for research, mentorship, and capacity building</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Hero Button Start -->
                    <div class="hero-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ route('about') }}" class="btn-default btn-highlighted">Learn more</a>
                    </div>
                    <!-- Hero Button End -->

                </div>
                <!-- Hero Content End -->
            </div>


        </div>
    </div>
</div>
<!-- Hero Section End -->


<!-- About Us Section Start -->
<div class="about-us">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-7">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">About Our Vision</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">To transform medical research in Africa through mentorship, innovation, and collaboration</h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-5">
                <!-- Section Content Button Start -->
                <div class="section-content-btn">
                    <!-- Section Title Content Start -->
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>“Born from the challenges of limited research mentorship in Rwanda, NextGen MedResearch emerged to bridge gaps in mentorship, training, and research collaboration.”</p>
                    </div>
                    <!-- Section Content Button End -->

                    <!-- Customer Rating Box Start -->
                    <div class="customer-rating-box">
                        <!-- Customer Rating Content Start -->
                        <div class="customer-rating-content">
                            <p>Founder’s Message</p>
                        </div>
                        <!-- Customer Rating Content End -->

                        <!-- Satisfy Client Images Start -->
                        <div class="satisfy-client-images customer-rating-images">
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('assets/images/founder-1.jpeg') }}" alt="">
                                </figure>
                            </div>
                        </div>
                        <!-- Satisfy Client Images End -->
                    </div>
                    <!-- Customer Rating Box End -->
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
                                <img src="{{ asset('assets/images/banner_New1.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- About Us Image End -->

                        <!-- About Image Content Start -->
                        <div class="about-image-content">

                            <!-- About Video Title Start -->
                            <div class="about-video-title">
                                <h3>NextGen MedResearch</h3>
                            </div>
                            <!-- About Video Title End -->
                        </div>
                        <!-- About Image Content End -->
                    </div>
                    <!-- About Image Content Box End -->

                    <!-- About Counter Box Start -->
                    <div class="about-counter-box">
                        <!-- About Counter Title Start -->
                        
                        <!-- About Counter Title End -->

                        <!-- About Counter Content Start -->
                        <div class="about-counter-content">
                            <h3  class="text-white">our mission</h3>
                            <p>We connect clinicians, researchers, <br>and mentors to build capacity, <br>conduct impactful studies, <br>and shape future healthcare leaders</p>
                            <a href="{{ route('about') }}" class="readmore-btn">Learn More</a>
                        </div>
                        <!-- About Counter Content End -->
                    </div>
                    <!-- About Counter Box End -->

                    <!-- About Image Content Box Start -->
                    <div class="about-image-content-box-2">
                        <!-- About Us Image Start -->
                        <div class="about-image">
                            <figure>
                                <img src="{{ asset('assets/images/IYP_6213.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- About Us Image End -->

                        <!-- About Image Content Start -->
                        <div class="about-image-content">
                            <ul>
                                <li>Mentorship</li>
                                <li>Research Collaboration</li>
                                <li>Capacity Building & Innovation</li>
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
<!-- About Us Section End -->

<!-- Our Services Section Start -->
<div class="our-services bg-section">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-6">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp text-white" style="border: 1px solid #fff">Key Research Fields</h3>
                    <h2 class="text-anime-style-3 text-white" data-cursor="-opaque">OUR PROGRAMS </h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-6">
                <!-- Section Title Content Start -->
                <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                    <p class="text-white">Each research field is supported by expert teams and cutting-edge technologies, ensuring precision, innovation, and real-world relevance. our work is rooted in curiosity, driven by data, and designed to deliver meaningful impact.</p>
                </div>
                <!-- Section Content Button End -->
            </div>
        </div>

        <div class="row service-list">
            @foreach($programs as $program)
            <div class="col-lg-3 col-md-6">
                <!-- Service Item Start -->
                <div class="service-item wow fadeInUp">

                    <!-- Service Body Start -->
                    <div class="service-body">
                        <!-- Service Body Header Start -->
                        <div class="service-body-header">
                            <!-- Icon Box Start -->
                            <div class="icon-box">
                                <img src="{{ asset('assets/images/icon-service-1.svg') }}" alt="">
                            </div>
                            <!-- Icon Box End -->

                            <!-- Service Readmore Button Start -->
                            <div class="service-readmore-btn">
                                <a href="{{ route('programs.detail', $program->slug ) }}"><img src="{{ asset('assets/images/arrow-white.svg') }}" alt=""></a>
                            </div>
                            <!-- Service Readmore Button End -->
                        </div>
                        <!-- Service Body Header End -->

                        <!-- Service Content Start -->
                        <div class="service-content">
                            <h3><a href="{{ route('programs.detail', $program->slug ) }}">{{ $program->title }}</a></h3>
                            <p>{{ Str::limit($program->description, 30) }}</p>
                            <a href="{{ route('programs.detail', $program->slug )}}" class="readmore-btn">learn more</a>
                        </div>
                        <!-- Service Content End -->
                    </div>
                    <!-- Service Body End -->
                </div>
                <!-- Service Item End -->
            </div>
            @endforeach

            <div class="col-lg-12">
                <!-- Section Footer Text Start-->
                <div class="section-footer-text wow fadeInUp" data-wow-delay="0.8s">
                    <p class="text-white">Explore the research that shapes tomorrow - <a role="button" data-bs-toggle="modal" data-bs-target="#membershipModal" style="background: #fff; color: #00697E; padding: 6px; border-radius: 5px;">Apply for Membership!</a></p>
                </div>
                <!-- Section Footer Text End-->
            </div>
        </div>
    </div>
</div>
<!-- Our Services Section End -->

<!-- Why Choose Us Section Start -->
<div class="why-choose-us">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <!-- Why Choose Image Box Start -->
                <div class="why-choose-image-box">
                    <!-- Why Choose Image Start -->
                    <div class="why-choose-image">
                        <figure class="image-anime">
                            <img src="{{ asset('assets/images/image-3.png') }}" alt="">
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
                        <h3 class="wow fadeInUp">Why choose us</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Building a Connected, Collaborative and Impactful Research Ecosystem</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Join a connected research community linking medical professionals, researchers, and institutions to foster innovation and collaboration.</p>
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
                                    <div class="why-choose-item-header">
                                        <div class="icon-box">
                                            <img src="{{ asset('assets/images/icon-why-choose-1.svg') }}" alt="">
                                        </div>
                                        <div class="why-choose-item-title">
                                            <h3>Proven Track Record</h3>
                                        </div>
                                    </div>
                                    <div class="why-choose-item-content">
                                        <p>Evidenced mentorship, collaborative work and research impact</p>
                                    </div>
                                </div>
                                <!-- Why Choose Item End -->

                                <!-- Why Choose Item Start -->
                                <div class="why-choose-item wow fadeInUp" data-wow-delay="0.6s">
                                    <div class="why-choose-item-header">
                                        <div class="icon-box">
                                            <img src="{{ asset('assets/images/icon-why-choose-2.svg') }}" alt="">
                                        </div>
                                        <div class="why-choose-item-title">
                                            <h3>Collaborative Approach</h3>
                                        </div>
                                    </div>
                                    <div class="why-choose-item-content">
                                        <p>We work closely with members of the research community to understand their needs and challenges.</p>
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
                        <!-- <div class="why-choose-body-image">
                            <figure class="image-anime">
                                <img src="{{ asset('assets/images/image-1.png') }}" alt="">
                            </figure>
                        </div> -->
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
            <div class="col-lg-6">
                <!-- What We Content Start -->
                <div class="what-we-contant">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Join the NextGen MedResearch Community</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Empower your journey. Shape Africa’s medical research future.</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">NextGen MedResearch membership connects you to mentorship, research collaboration, workshops, and innovation opportunities across Africa. Choose the membership tier that fits your role and impact goals.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- What We Button Start -->
                    <div class="what-we-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a role="button" data-bs-toggle="modal" data-bs-target="#membershipModal" class="btn-default btn-highlighted">Apply for Membership</a>
                        <p class="mt-3 text-white">Unlock your potential. Connect, contribute, and lead Africa’s next generation of medical researchers</p>
                    </div>
                    <!-- What We Button End -->

                    <!-- What We Counter Box Start -->
                    <!-- <div class="what-we-counter-box">
                        <h3>Environmental Science</h3>
                        <p>Unlock your potential. Connect, contribute, and lead Africa’s next generation of medical researchers</p>
                    </div> -->
                    <!-- What We Counter Box End -->
                </div>
                <!-- What We Content End -->
            </div>

            <div class="col-lg-6">
                <!-- What We Item List Start -->
                <div class="what-we-item-list">
                    <!-- What We Item Start -->
                    <div class="what-we-item wow fadeInUp">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icon-what-we-item-1.svg') }}" alt="">
                        </div>
                        <div class="what-we-content">
                            <h3>Individual Membership</h3>
                            <p>
                                Ideal for students, residents, and early-career researchers.

                                Access to mentorship programs, webinars, and training resources.

                                Certificate eligibility upon course completion.
                            </p>
                        </div>
                    </div>
                    <!-- What We Item End -->

                    <!-- What We Item Start -->
                    <div class="what-we-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icon-what-we-item-2.svg') }}" alt="">
                        </div>
                        <div class="what-we-content">
                            <h3>Trainer / Expert Membership</h3>
                            <p>
                                Designed for mentors and facilitators.

                                Host sessions, guide mentees, and increase professional visibility.

                                Access to collaboration tools and expert dashboards.
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
                            <h3>Institutional Membership</h3>
                            <p>
                                Universities, hospitals, NGOs.

                                Priority collaboration in research projects, workshops, and innovation initiatives.

                                Visibility across NextGen’s professional network.
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
                            <h3>Collaborative Scientific Partnerships</h3>
                            <p>We work closely with academic institutions, private industries, and government agencies to co-develop innovative research.</p>
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

<!-- Case Study Section Start -->
<div class="case-study">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-6">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Our Research Studies</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque"> Research Studies</h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-6">
                <!-- Section Button Start -->
                <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                    <a href="{{ route('research.index') }}" class="btn-default">Explore All Research</a>
                </div>
                <!-- Section Button End -->
            </div>
        </div>

        <div class="row">
            @foreach($researches as $research)
            <div class="col-lg-4 col-md-6">
                <!-- Case Study Item Start -->
                <div class="case-study-item wow fadeInUp">
                    <!-- Case Study Image Start-->
                    <div class="case-study-image">
                        <figure class="image-anime">
                            <img src="{{asset('image/research')}}/{{ $research->featured_image }}" alt="">
                        </figure>

                        <!-- Case Study Button Start-->
                        <div class="case-study-btn">
                            <a href="{{ route('research.detail', $research->slug) }}"><img src="{{ asset('assets/images/arrow-primary.svg') }}" alt=""></a>
                        </div>
                        <!-- Case Study Button End-->
                    </div>
                    <!-- Case Study Image End -->

                    <!-- Case Study Content Start -->
                    <div class="case-study-content">
                        <h2><a href="{{ route('research.detail', $research->slug) }}">{{ $research->title }}</a></h2>
                    </div>
                    <!-- Case Study Content End -->
                </div>
                <!-- Case Study Item End -->
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Case Study Section End -->

<!-- Our FAQs Section Start -->
<div class="our-faqs">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <!-- FAQs Content Start -->
                <div class="faqs-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Frequently Asked Questions</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Browse our most asked questions</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">We've compiled answers to the most common questions about our lab services, research process, and capabilities.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Our Faqs Button Start -->
                    <div class="our-faqs-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a href="{{ route('faq.page') }}" class="btn-default">View All Faqs</a>
                    </div>
                    <!-- Our Faqs Button End -->
                </div>
                <!-- FAQs Content End -->
            </div>

            <div class="col-lg-7">
                <!-- FAQ Accordion Start -->
                <div class="faq-accordion" id="accordion">
                    @foreach($faqs as $faq)
                    <!-- FAQ Item Start -->
                    <div class="accordion-item wow fadeInUp">
                        <h2 class="accordion-header" id="heading{{ $loop->index + 1 }} text-white">
                            <button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index + 1 }}" aria-expanded="true" aria-controls="collapse{{ $loop->index + 1 }}">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $loop->index + 1 }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loop->index + 1 }}" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <p class="text-white">{{ $faq->answer }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item End -->
                    @endforeach
                </div>
                <!-- FAQ Accordion End -->
            </div>
        </div>
    </div>
</div>
<!-- Our FAQs Section End -->

<!-- Our Testimonial Section Start -->
@if($testimonials->isNotEmpty())
<div class="our-testimonials bg-section dark-section parallaxie">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-12">
                <div class="section-title section-title-center">
                    <h3 class="wow fadeInUp">Our Testimonials</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">
                        What our community say about their experience with us
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper" data-cursor-text="Drag">
                            @foreach($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testimonial-item">

                                    <div class="testimonial-content">
                                        <div class="testimonial-quote">
                                            <img src="{{ asset('assets/images/testimonial-quote.svg') }}" alt="">
                                        </div>

                                        <div class="testimonial-info">
                                            <p>{{ $testimonial->testimonial }}</p>
                                        </div>

                                        <div class="author-content">
                                            <h3>{{ $testimonial->name }}</h3>
                                            <p>{{ $testimonial->role }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="testimonial-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Our Testimonial Section End -->

<!-- Our Blog Section Start -->
<div class="our-blog">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-6">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp">Our blog</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque">Stay updated with latest in science and innovation</h2>
                </div>
                <!-- Section Title End -->
            </div>

            <div class="col-lg-6">
                <!-- Section Button Start -->
                <div class="section-btn wow fadeInUp" data-wow-delay="0.2s">
                    <a href="{{ route('news')}}" class="btn-default">view all blogs</a>
                </div>
                <!-- Section Button End -->
            </div>
        </div>

        <div class="row">
            @foreach($news as $new)
            <div class="col-lg-4 col-md-6">
                <!-- Post Item Start -->
                <div class="post-item wow fadeInUp">
                    <!-- Post Featured Image Start-->
                    <div class="post-featured-image">
                        <a href="{{ route('news.detail', $new->slug )}}" data-cursor-text="View">
                            <figure class="image-anime">
                                @if ($new->featured_image)
                                <img src="{{asset('image/posts')}}/{{ $new->featured_image }}" alt="">
                                @else
                                <span class="text-muted">No Image</span>
                                @endif
                            </figure>
                        </a>
                    </div>
                    <!-- Post Featured Image End -->

                    <!-- Post Item Body Start -->
                    <div class="post-item-body">
                        <!-- Post Item Content Start -->
                        <div class="post-item-content">
                            <h2><a href="{{ route('news.detail', $new->slug )}}">{{ $new->title }}</a></h2>
                        </div>
                        <!-- Post Item Content End -->

                        <!-- Post Item Readmore Button Start-->
                        <div class="post-item-btn">
                            <a href="{{ route('news.detail', $new->slug )}}" class="readmore-btn">learn more</a>
                        </div>
                        <!-- Post Item Readmore Button End-->
                    </div>
                    <!-- Post Item Body End -->
                </div>
                <!-- Post Item End -->
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Our Blog Section End -->

@endsection