@extends('layouts.guest')
@section('title','Research Space')
@section('content')

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
                        <h3 class="wow fadeInUp">Dissertation-Ready Topics</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Dissertation-Ready Topics</h2>
                        <p class="wow fadeInUp" data-wow-delay="0.2s">
                            These Dissertation-Ready Topics are carefully curated through systematic literature reviews, analysis of the University of Rwanda research portal,
                            and consultations with clinicians, researchers, and academic supervisors. Each topic is designed to be feasible, ethically sound, impactful,
                            and aligned with national and global health priorities.
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
<div class="container py-5">


    <!-- Example Dissertation Topic Card -->
    <div class="card shadow-sm p-4 mb-4">
        <h4 class="fw-bold mb-3">Sample Dissertation Topic</h4>

        <div class="mb-3">
            <h6 class="fw-bold">1️⃣ Title</h6>
            <p>
                Assessing the Impact of Early Diabetes Screening on Preventing Complications among Adults in Rwanda.
            </p>
        </div>

        <div class="mb-3">
            <h6 class="fw-bold">2️⃣ Who It’s For</h6>
            <p>
                Medical Students, Medical Residents, Public Health Researchers, and Healthcare Policy Trainees who want a clinically meaningful,
                data-driven research topic that contributes to improving patient outcomes.
            </p>
        </div>

        <div class="mb-3">
            <h6 class="fw-bold">3️⃣ Why This Is Important</h6>
            <p>
                Diabetes complications such as kidney failure, cardiovascular disease, and amputations remain a major burden in Rwanda and globally.
                Early screening and timely intervention can significantly reduce morbidity and mortality.
                This topic helps generate evidence that can inform clinical guidelines, hospital protocols, and national health policy.
            </p>
        </div>

        <div>
            <h6 class="fw-bold">4️⃣ Confirm with a Mentor</h6>
            <p>
                Before starting your dissertation, a mentor review ensures the topic meets academic standards,
                has available data sources, ethical approval feasibility, and fits your academic level.
                A mentor helps refine objectives, methodology, and scope to make the project successful.
            </p>
        </div>
    </div>

    <!-- Who This Page Serves -->
    <div class="card shadow-sm p-4 mb-4">
        <h4 class="fw-bold mb-3">Who This Research Space Supports</h4>
        <p>
            This page is designed for learners and health professionals who want structured, high-quality research inspiration without starting from scratch:
        </p>
        <ul>
            <li>🎓 Medical Students preparing final year dissertations</li>
            <li>🏥 Medical Residents developing specialty theses</li>
            <li>📚 Fellows and Early-Career Researchers exploring advanced topics</li>
            <li>👩‍⚕️ Public Health and Allied Health Professionals interested in evidence-based practice</li>
        </ul>
    </div>

    <!-- Importance Section -->
    <div class="card shadow-sm p-4 mb-4">
        <h4 class="fw-bold mb-3">Why This Space is Important</h4>
        <p>
            Many students struggle with unclear topics, lack of direction, or choosing research ideas that are either too broad or not academically relevant.
            This Research Space bridges that gap by offering well-thought-out, realistic, and academically strong dissertation ideas
            that respond to real healthcare challenges in Rwanda and beyond.
        </p>
    </div>

    <!-- Action Button -->
    <div class="text-center">
        <button class="btn btn-primary px-4 py-2">
            Confirm with a Mentor
        </button>
    </div>

</div>

<style>
    .card {
        border-radius: 12px;
        border: none;
    }

    button.btn-primary {
        background: linear-gradient(45deg, #4e54c8, #8f94fb);
        border: none;
        font-weight: 600;
    }

    button.btn-primary:hover {
        opacity: .9;
    }
</style>

@endsection