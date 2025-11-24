@extends('layouts.guest')
@section('title', $project->title)
@section('content')

<!-- Page Header Start -->
<div class="page-header parallaxie">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Page Header Box Start -->
                <div class="page-header-box">
                    <h1 class="text-anime-style-3" data-cursor="-opaque">{{ $project->title}}</h1>
                    <div class="post-single-meta wow fadeInUp">
                        <ol class="breadcrumb">
                            <li><i class="fa-regular fa-user"></i> Admin</li>
                            <li><i class="fa-regular fa-clock"></i> 13 June, 2025</li>
                        </ol>
                    </div>
                </div>
                <!-- Page Header Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


<div class="page-case-study-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- Page Single Sidebar Start -->
                <div class="page-single-sidebar">
                    <!-- Page Category List Start -->
                    <div class="page-category-list case-study-category-list wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <h3>Case Study Information</h3>
                        <ul>
                            <li>Client :<span>David Wilson</span></li>
                            <li>Category :<span>{{ $project->category->name }}</span></li>
                            <li>Location :<span>USA</span></li>
                            <li>Duration :<span>6 Month</span></li>
                            <li>Date :<span>10th April 2025</span></li>
                        </ul>
                    </div>
                    <!-- Page Category List End -->

                    <!-- Sidebar CTA Box Start -->
                    <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                        <!-- Sidebar CTA Content Start -->
                        <div class="sidebar-cta-logo">
                            <img src="{{ asset('assets/images/logo.svg') }}" alt="">
                        </div>
                        <!-- Sidebar CTA Content End -->

                        <!-- Sidebar CTA Contact Start -->
                        <div class="sidebar-cta-content">
                            <p>Partner with us to drive innovation and shape a healthier future.</p>
                            <a href="contact.html" class="btn-default btn-highlighted">Join Our Research</a>
                        </div>
                        <!-- Sidebar CTA Contact End -->
                    </div>
                    <!-- Sidebar CTA Box End -->
                </div>
                <!-- Page Single Sidebar End -->
            </div>

            <div class="col-lg-8">
                <!-- Case Study Single Content Start -->
                <div class="case-study-single-content">
                    <!-- Page Single image Start -->
                    <div class="page-single-image">
                        <figure class="image-anime reveal" style="transform: translate(0px, 0px); opacity: 1; visibility: inherit;">
                            <img src="{{ asset('assets/images/case-study-1.jpg') }}" alt="" style="transform: translate(0px, 0px);">
                        </figure>
                    </div>
                    <!-- Page Single image End -->

                    <!-- Case Study Entry Start -->
                    <div class="case-study-entry">
                        <p class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">{{ $project->summary}}</p>
                        <p class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">{{ $project->description }}</p>

                        <!-- Empowering Agriculture Box Start -->
                        <div class="empowering-agriculture-box">
                            <h2 class="text-anime-style-3" style="perspective: 400px;">
                                {{ $project->title}}
                            </h2>
                            <p class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Through advanced genomic research, we're revolutionizing the way crops adapt to changing climates. By identifying and enhancing genes responsible for drought resistance</p>

                            <!-- Empowering Box List Start -->
                            <div class="empowering-box-list">
                                <!-- Empowering Box Start -->
                                <div class="empowering-box wow fadeInUp" data-wow-delay="0.2s" style="visibility: hidden; animation-delay: 0.2s; animation-name: none;">
                                    <!-- Empowering Item Start -->
                                    <div class="empowering-item">
                                        <div class="icon-box">
                                            <img src="images/icon-empowering-1.svg" alt="">
                                        </div>
                                        <div class="empowering-item-content">
                                            <h3>Project challenge</h3>
                                            <p>You'll meet with our scientific advisors to define your research goals, scope, timeline &amp; budget.</p>
                                        </div>
                                    </div>
                                    <!-- Empowering Item End -->
                                    <ul>
                                        <li>Utilizing advanced gene-mapping techniques to develop crop varieties that thrive in low-water</li>
                                        <li>Driving sustainable agriculture by integrating genomics with environmental science, helping</li>
                                    </ul>
                                </div>
                                <!-- Empowering Box End -->

                                <!-- Empowering Box Start -->
                                <div class="empowering-box wow fadeInUp" data-wow-delay="0.4s" style="visibility: hidden; animation-delay: 0.4s; animation-name: none;">
                                    <!-- Empowering Item Start -->
                                    <div class="empowering-item">
                                        <div class="icon-box">
                                            <img src="images/icon-empowering-2.svg" alt="">
                                        </div>
                                        <div class="empowering-item-content">
                                            <h3>Project solution</h3>
                                            <p>You'll meet with our scientific advisors to define your research goals, scope, timeline &amp; budget.</p>
                                        </div>
                                    </div>
                                    <!-- Empowering Item End -->
                                    <ul>
                                        <li>Utilizing advanced gene-mapping techniques to develop crop varieties that thrive in low-water</li>
                                        <li>Driving sustainable agriculture by integrating genomics with environmental science, helping</li>
                                    </ul>
                                </div>
                                <!-- Empowering Box End -->
                            </div>
                            <!-- Empowering Box List End -->
                        </div>
                        <!-- Empowering Agriculture Box End -->

                        <!-- Field Trials Box Start -->
                        <div class="field-trials-box">
                            <h2 class="text-anime-style-3" style="perspective: 400px;">
                                <div class="split-line" style="display: block; text-align: start; position: relative;">
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">F</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">i</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">l</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">d</div>
                                    </div>
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">t</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">r</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">i</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">a</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">l</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">s</div>
                                    </div>
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">t</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">h</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">a</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">t</div>
                                    </div>
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">v</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">a</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">l</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">i</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">d</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">a</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">t</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                    </div>
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">o</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">u</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">r</div>
                                    </div>
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">s</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">c</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">i</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">n</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">c</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                    </div>
                                </div>
                            </h2>
                            <p class="wow fadeInUp" style="visibility: hidden; animation-name: none;">Our research doesn't stop in the lab — it extends to real-world agricultural environments where we test, monitor, and refine our drought-resistant crop varieties. Through rigorous field trials conducted in diverse</p>

                            <!-- Field Trials Step List Start -->
                            <div class="field-trials-step-list">
                                <!-- Field Trials Step Item Start -->
                                <div class="field-trials-step-item wow fadeInUp" data-wow-delay="0.2s" style="visibility: hidden; animation-delay: 0.2s; animation-name: none;">
                                    <div class="field-trials-step-no">
                                        <h3>01</h3>
                                    </div>
                                    <div class="field-trials-content">
                                        <h3>Impact Through Precision</h3>
                                        <p>From hypothesis to execution we craft tailored research strategies that align with scientific best practice &amp; your project goal.</p>
                                    </div>
                                </div>
                                <!-- Field Trials Step Item End -->

                                <!-- Field Trials Step Item Start -->
                                <div class="field-trials-step-item wow fadeInUp" data-wow-delay="0.4s" style="visibility: hidden; animation-delay: 0.4s; animation-name: none;">
                                    <div class="field-trials-step-no">
                                        <h3>02</h3>
                                    </div>
                                    <div class="field-trials-content">
                                        <h3>Controlled Trial Environments</h3>
                                        <p>From hypothesis to execution we craft tailored research strategies that align with scientific best practice &amp; your project goal.</p>
                                    </div>
                                </div>
                                <!-- Field Trials Step Item End -->

                                <!-- Field Trials Step Item Start -->
                                <div class="field-trials-step-item wow fadeInUp" data-wow-delay="0.6s" style="visibility: hidden; animation-delay: 0.6s; animation-name: none;">
                                    <div class="field-trials-step-no">
                                        <h3>03</h3>
                                    </div>
                                    <div class="field-trials-content">
                                        <h3>Evidence Based Outcomes</h3>
                                        <p>From hypothesis to execution we craft tailored research strategies that align with scientific best practice &amp; your project goal.</p>
                                    </div>
                                </div>
                                <!-- Field Trials Step Item End -->

                                <!-- Field Trials Step Item Start -->
                                <div class="field-trials-step-item wow fadeInUp" data-wow-delay="0.8s" style="visibility: hidden; animation-delay: 0.8s; animation-name: none;">
                                    <div class="field-trials-step-no">
                                        <h3>04</h3>
                                    </div>
                                    <div class="field-trials-content">
                                        <h3>Reliable Data Collection</h3>
                                        <p>From hypothesis to execution we craft tailored research strategies that align with scientific best practice &amp; your project goal.</p>
                                    </div>
                                </div>
                                <!-- Field Trials Step Item End -->
                            </div>
                            <!-- Field Trials Step List End -->
                        </div>
                        <!-- Field Trials Box End -->

                        <!-- Shaping Future Box Start -->
                        <div class="shaping-future-box">
                            <h2 class="text-anime-style-3" style="perspective: 400px;">
                                <div class="split-line" style="display: block; text-align: start; position: relative;">
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">S</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">h</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">a</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">p</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">i</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">n</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">g</div>
                                    </div>
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">t</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">h</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                    </div>
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">f</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">u</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">t</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">u</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">r</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                    </div>
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">o</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">f</div>
                                    </div>
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">s</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">u</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">s</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">t</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">a</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">i</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">n</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">a</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">b</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">l</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                    </div>
                                </div>
                            </h2>
                            <p class="wow fadeInUp" style="visibility: hidden; animation-name: none;">Our commitment to genomic innovation goes beyond present solutions — we're laying the foundation for a new era of sustainable agriculture. By integrating cutting-edge research with ecological responsibility.</p>

                            <!-- Shaping Future Image Content Start -->
                            <div class="shaping-future-image-content">
                                <!-- Shaping Future Content Start -->
                                <div class="shaping-future-content">
                                    <h2 class="text-anime-style-3" style="perspective: 400px;">
                                        <div class="split-line" style="display: block; text-align: start; position: relative;">
                                            <div style="position:relative;display:inline-block;">
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">I</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">n</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">n</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">o</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">v</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">a</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">t</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">i</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">n</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">g</div>
                                            </div>
                                            <div style="position:relative;display:inline-block;">
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">f</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">o</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">r</div>
                                            </div>
                                        </div>
                                        <div class="split-line" style="display: block; text-align: start; position: relative;">
                                            <div style="position:relative;display:inline-block;">
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">G</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">n</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">r</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">a</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">t</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">i</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">o</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">n</div>
                                                <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">s</div>
                                            </div>
                                        </div>
                                    </h2>
                                    <p class="wow fadeInUp" style="visibility: hidden; animation-name: none;">Our work is focused not just on today's agricultural need but on building long-term solutions that will serve future farmers</p>

                                    <div class="shaping-future-item wow fadeInUp" data-wow-delay="0.2s" style="visibility: hidden; animation-delay: 0.2s; animation-name: none;">
                                        <h3>Global Smart Labs</h3>
                                        <p>Portfolio of successful sdies and satisfied</p>
                                    </div>
                                </div>
                                <!-- Shaping Future Content Start -->

                                <!-- Shaping Future Image Start -->
                                <div class="shaping-future-image">
                                    <figure class="image-anime reveal" style="transform: translate(-100%, 0%);">
                                        <img src="images/shaping-future-image.jpg" alt="" style="transform: translate(0px, 0px);">
                                    </figure>
                                </div>
                                <!-- Shaping Future Image Start -->
                            </div>
                            <!-- Shaping Future Image Content End -->
                        </div>
                        <!-- Shaping Future Box End -->
                    </div>
                    <!-- Case Study Entry End -->

                    <!-- Page Single FAQs Start -->
                    <div class="page-single-faqs">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h2 class="text-anime-style-3" data-cursor="-opaque" style="perspective: 400px;">
                                <div class="split-line" style="display: block; text-align: start; position: relative;">
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">F</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">r</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">q</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">u</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">n</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">t</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">l</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">y</div>
                                    </div>
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">a</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">s</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">k</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">d</div>
                                    </div>
                                    <div style="position:relative;display:inline-block;">
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">q</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">u</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">e</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">s</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">t</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">i</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">o</div>
                                        <div style="position: relative; display: inline-block; transform: translate(50px, 0px); opacity: 0;">n</div>
                                    </div>
                                </div>
                            </h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- FAQ Accordion Start -->
                        <div class="faq-accordion" id="faqaccordion">
                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" style="visibility: hidden; animation-name: none;">
                                <h2 class="accordion-header" id="heading1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        Q1. What types of research services do you offer?
                                    </button>
                                </h2>
                                <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>We specialize in laboratory testing, analytical research, scientific custom experiments and data interpretation.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s" style="visibility: hidden; animation-delay: 0.2s; animation-name: none;">
                                <h2 class="accordion-header" id="heading2">
                                    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        Q2. Can I request a custom research project?
                                    </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse show" aria-labelledby="heading2" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>We specialize in laboratory testing, analytical research, scientific custom experiments and data interpretation.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s" style="visibility: hidden; animation-delay: 0.4s; animation-name: none;">
                                <h2 class="accordion-header" id="heading3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        Q3. How long does a typical research project take?
                                    </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>We specialize in laboratory testing, analytical research, scientific custom experiments and data interpretation.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s" style="visibility: hidden; animation-delay: 0.6s; animation-name: none;">
                                <h2 class="accordion-header" id="heading4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                        Q4. Are your labs certified or accredited?
                                    </button>
                                </h2>
                                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>We specialize in laboratory testing, analytical research, scientific custom experiments and data interpretation.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.8s" style="visibility: hidden; animation-delay: 0.8s; animation-name: none;">
                                <h2 class="accordion-header" id="heading5">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                        Q5. How do I submit a sample or start a project?
                                    </button>
                                </h2>
                                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#faqaccordion">
                                    <div class="accordion-body">
                                        <p>We specialize in laboratory testing, analytical research, scientific custom experiments and data interpretation.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->
                        </div>
                        <!-- FAQ Accordion End -->
                    </div>
                    <!-- Page Single FAQs End -->
                </div>
                <!-- Case Study Single Content End -->
            </div>
        </div>
    </div>
</div>

@endsection