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
                    <h1 class="text-anime-style-3" data-cursor="-opaque">About us</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About us</li>
                        </ol>
                    </nav>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Scrolling Ticker Section Start -->
<div class="our-scrolling-ticker">
    <!-- Scrolling Ticker Start -->
    <div class="scrolling-ticker-box">
        <div class="scrolling-content">
            <span><img src="images/icon-sparkle.svg" alt="">Diagnostics</span>
            <span><img src="images/icon-sparkle.svg" alt="">Innovation</span>
            <span><img src="images/icon-sparkle.svg" alt="">Biotech</span>
            <span><img src="images/icon-sparkle.svg" alt="">Environment</span>
            <span><img src="images/icon-sparkle.svg" alt="">Testing</span>
            <span><img src="images/icon-sparkle.svg" alt="">Research</span>
            <span><img src="images/icon-sparkle.svg" alt="">Diagnostics</span>
            <span><img src="images/icon-sparkle.svg" alt="">Innovation</span>
            <span><img src="images/icon-sparkle.svg" alt="">Biotech</span>
        </div>

        <div class="scrolling-content">
            <span><img src="images/icon-sparkle.svg" alt="">Diagnostics</span>
            <span><img src="images/icon-sparkle.svg" alt="">Innovation</span>
            <span><img src="images/icon-sparkle.svg" alt="">Biotech</span>
            <span><img src="images/icon-sparkle.svg" alt="">Environment</span>
            <span><img src="images/icon-sparkle.svg" alt="">Testing</span>
            <span><img src="images/icon-sparkle.svg" alt="">Research</span>
            <span><img src="images/icon-sparkle.svg" alt="">Diagnostics</span>
            <span><img src="images/icon-sparkle.svg" alt="">Innovation</span>
            <span><img src="images/icon-sparkle.svg" alt="">Biotech</span>
        </div>
    </div>
    <!-- Scrolling Ticker End -->
</div>
<!-- Scrolling Ticker Section End -->

<!-- Our Core Value Section Start -->
<div class="our-core-value">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- Core Value Image Start -->
                <div class="core-value-image">
                    <div class="value-image-box-1">
                        <div class="value-img-1">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('assets/images/value-img-1.jpg') }}" alt="">
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
                                <img src="{{ asset('assets/images/value-img-2.jpg') }}" alt="">
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
            <div class="col-lg-6">
                <!-- Approach Image Start -->
                <div class="approach-image">
                    <figure class="image-anime reveal">
                        <img src="{{ asset('assets/images/approach-image.jpg') }}" alt="">
                    </figure>
                </div>
                <!-- Approach Image End -->
            </div>

            <div class="col-lg-6">
                <!-- Approach Content Start -->
                <div class="approach-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Our Approach</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Rooted in collaboration and community, we bring</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">Together, we are shaping a stronger, evidence-driven healthcare future for Africa.</p>
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
                                <p>To transform medical education and research in Africa through mentorship, innovation, and collaboration.</p>
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
                                <p>We connect clinicians, researchers, and mentors to build capacity, conduct impactful studies, and shape future healthcare leaders.</p>
                            </div>
                        </div>
                        <!-- Mission Vision Item End -->
                    </div>
                    <!-- Mission Vision List End -->

                    <!-- Approach Button Start -->
                    <div class="approach-button wow fadeInUp" data-wow-delay="0.8s">
                        <a href="pricing.html" class="btn-default">our model</a>
                    </div>
                    <!-- Approach Button End -->
                </div>
                <!-- Approach Content End -->
            </div>
        </div>
    </div>
</div>
<!-- Our Approach Section End -->



<!-- What We Do Section Start -->
<div class="what-we-do bg-section dark-section mt-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <!-- What We Content Start -->
                <div class="what-we-contant">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Our Model</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Our Model</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">We operate through three interlocking pillars that reinforce each other</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- What We Button Start -->
                    <div class="what-we-btn wow fadeInUp" data-wow-delay="0.4s">
                        <a href="contact.html" class="btn-default btn-highlighted">contact us</a>
                    </div>
                    <!-- What We Button End -->

                    <!-- What We Counter Box Start -->
                    <div class="what-we-counter-box">
                        <h2><span class="counter">98</span>%</h2>
                        <h3>Environmental Science</h3>
                        <p>This integrated model creates sustainable growth and measurable impact.</p>
                    </div>
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
                            <img src="{{ asset('assets/images/icon-what-we-item-1.svg')}}" alt="">
                        </div>
                        <div class="what-we-content">
                            <h3>Mentorship</h3>
                            <p>Personalized guidance from experienced researchers and clinicians</p>
                        </div>
                    </div>
                    <!-- What We Item End -->

                    <!-- What We Item Start -->
                    <div class="what-we-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icon-what-we-item-2.svg')}}" alt="">
                        </div>
                        <div class="what-we-content">
                            <h3>Research Collaboration</h3>
                            <p>Supporting teams to design, conduct, and publish studies</p>
                        </div>
                    </div>
                    <!-- What We Item End -->

                    <!-- What We Item Start -->
                    <div class="what-we-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icon-what-we-item-3.svg')}}" alt="">
                        </div>
                        <div class="what-we-content">
                            <h3>Capacity Building & Innovation</h3>
                            <p>Workshops, digital learning, and tools that enable practical research skills</p>
                        </div>
                    </div>
                    <!-- What We Item End -->

                    <!-- What We Item Start -->
                    <div class="what-we-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-box">
                            <img src="images/icon-what-we-item-4.svg" alt="">
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

<div class="about-us">
    <div class="container">
        <div class="row section-row align-items-center">
            <div class="col-lg-7">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Founder's message</h3>
                    <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                        <div class="split-line" style="display: block; text-align: start; position: relative;">
                            <div style="position:relative;display:inline-block;">
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">F</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">o</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">u</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">n</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">d</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">e</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">r</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">'</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">s</div>
                            </div>
                            <div style="position:relative;display:inline-block;">
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">m</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">e</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">s</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">s</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">a</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">g</div>
                                <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">e</div>
                            </div>
                        </div>
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
                            <h2>Our Core Values</h2>
                            <h3>We are driven by</h3>
                        </div>
                        <!-- About Counter Title End -->

                        <!-- About Counter Content Start -->
                        <div class="about-counter-content">
                            <ul>
                                <li>Excellence in research and education</li>

                                <li>Collaboration and shared knowledge</li>

                                <li>Innovation and technology-driven solutions</li>

                                <li>Integrity and transparency</li>

                                <li>Community empowerment</li>

                                <li>Impact-oriented action</li>
                            </ul>
                            <a href="about.html" class="readmore-btn">Learn More</a>
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
                            <h3>5K+ Satisfied partners</h3>
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
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Our Impact</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                            <div class="split-line" style="display: block; text-align: start; position: relative;">
                                <div style="position:relative;display:inline-block;">
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">O</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">u</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">r</div>
                                </div>
                                <div style="position:relative;display:inline-block;">
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">I</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">m</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">p</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">a</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">c</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">t</div>
                                </div>
                            </div>
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            Our growing ecosystem has supported
                        </p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Work Steps List Start -->
                    <div class="work-steps-list">
                        <!-- How Steps Item Start -->
                        <div class="work-steps-item wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                            <div class="work-step-no">
                                <h3>250+</h3>
                            </div>
                            <div class="work-step-content">
                                <p>health professionals trained</p>
                            </div>
                        </div>
                        <!-- How Steps Item End -->

                        <!-- How Steps Item Start -->
                        <div class="work-steps-item wow fadeInUp" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                            <div class="work-step-no">
                                <h3>15 </h3>
                            </div>
                            <div class="work-step-content">
                                <p>institutional partners</p>
                            </div>
                        </div>
                        <!-- How Steps Item End -->

                        <!-- How Steps Item Start -->
                        <div class="work-steps-item wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                            <div class="work-step-no">
                                <h3>10 </h3>
                            </div>
                            <div class="work-step-content">
                                <p>active research collaborations</p>
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

<div class="our-pricing bg-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <!-- Our Pricing Content Start -->
                <div class="our-pricing-content">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Get started</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                            <div class="split-line" style="display: block; text-align: start; position: relative;">
                                <div style="position:relative;display:inline-block;">
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">j</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">o</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">i</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">n</div>
                                </div>
                                <div style="position:relative;display:inline-block;">
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">t</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">h</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">e</div>
                                </div>
                                <div style="position:relative;display:inline-block;">
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">m</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">o</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">v</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">e</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">m</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">e</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">n</div>
                                    <div style="position: relative; display: inline-block; transform: translate(0px, 0px); opacity: 1;">t</div>
                                </div>
                            </div>
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">Whether you are a learner, mentor, institution, or supporter, you have a place in this ecosystem.</p>
                    </div>
                    <!-- Section Title End -->

                    <!-- Pricing Button Start -->
                    <div class="our-pricing-btn wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                        <a href="pricing.html" class="btn-default">Partner With Us</a>
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
                        <!-- Pricing Header Start -->
                        <div class="pricing-header">
                            <h3>Help build the next generation of African medical researchers</h3>
                        </div>
                        <!-- Pricing Header End -->

                        <!-- Pricing Body Start -->
                        <div class="pricing-body">
                            <!-- Pricing Content Start -->
                            <div class="pricing-content">
                                <!-- Pricing Button Start -->
                                <div class="pricing-btn">
                                    <a href="contact.html" class="btn-default">Apply for Membership</a>
                                </div>
                                <!-- Pricing Button End -->
                            </div>
                            <!-- Pricing Content End -->
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
                        <a href="faqs.html" class="btn-default">View All Faqs</a>
                    </div>
                    <!-- Our Faqs Button End -->
                </div>
                <!-- FAQs Content End -->
            </div>

            <div class="col-lg-7">
                <!-- FAQ Accordion Start -->
                <div class="faq-accordion" id="accordion">
                    <!-- FAQ Item Start -->
                    <div class="accordion-item wow fadeInUp">
                        <h2 class="accordion-header" id="heading1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                Q1. What types of research services do you offer?
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <p>We specialize in laboratory testing, analytical research, scientific custom experiments and data interpretation.</p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item End -->

                    <!-- FAQ Item Start -->
                    <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                        <h2 class="accordion-header" id="heading2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                Q2. Can I request a custom research project?
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse show" aria-labelledby="heading2" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <p>We specialize in laboratory testing, analytical research, scientific custom experiments and data interpretation.</p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item End -->

                    <!-- FAQ Item Start -->
                    <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                        <h2 class="accordion-header" id="heading3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                Q3. How long does a typical research project take?
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <p>We specialize in laboratory testing, analytical research, scientific custom experiments and data interpretation.</p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item End -->

                    <!-- FAQ Item Start -->
                    <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s">
                        <h2 class="accordion-header" id="heading4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                Q4. Are your labs certified or accredited?
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <p>We specialize in laboratory testing, analytical research, scientific custom experiments and data interpretation.</p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item End -->

                    <!-- FAQ Item Start -->
                    <div class="accordion-item wow fadeInUp" data-wow-delay="0.8s">
                        <h2 class="accordion-header" id="heading5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                Q5. How do I submit a sample or start a project?
                            </button>
                        </h2>
                        <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordion">
                            <div class="accordion-body">
                                <p>We specialize in laboratory testing, analytical research, scientific custom experiments and data interpretation.</p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item End -->
                </div>
                <!-- FAQ Accordion End -->
            </div>
        </div>
    </div>
</div>
<!-- Our FAQs Section End -->

@endsection