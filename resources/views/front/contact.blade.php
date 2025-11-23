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
                    <h1 class="text-anime-style-3" data-cursor="-opaque">Contact us</h1>
                    <nav class="wow fadeInUp">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">contact us</li>
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

<!-- Page Contact Us Start -->
<div class="page-contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Contact Us Box Start -->
                <div class="contact-us-box">
                    <!-- Contact Us Content Start -->
                    <div class="contact-us-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Contact us</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Have Questions? We're Ready to Help</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Whether you're looking to collaborate, inquire about our research, or simply have a question — we're just a message away. Reach out to our team and we'll get back you with the information you need.</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Contact Info List Start -->
                        <div class="contact-info-list">
                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon-box">
                                    <img src="{{ asset('assets/images/icon-phone.svg')}}" alt="">
                                </div>
                                <div class="contact-item-content">
                                    <p>Contact</p>
                                    <h3><a href="tel:246333085">+1 (246) 333-085</a></h3>
                                </div>
                            </div>
                            <!-- Contact Info Item End -->

                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.6s">
                                <div class="icon-box">
                                    <img src="{{ asset('assets/images/icon-mail.svg')}}" alt="">
                                </div>
                                <div class="contact-item-content">
                                    <p>Email</p>
                                    <h3><a href="mailto:info@domain.com">info@domain.com</a></h3>
                                </div>
                            </div>
                            <!-- Contact Info Item End -->

                            <!-- Contact Info Item Start -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.8s">
                                <div class="icon-box">
                                    <img src="{{ asset('assets/images/icon-location.svg')}}" alt="">
                                </div>
                                <div class="contact-item-content">
                                    <p>Address</p>
                                    <h3>Kigali, Rwanda</h3>
                                </div>
                            </div>
                            <!-- Contact Info Item End -->
                        </div>
                        <!-- Contact Info List End -->
                    </div>
                    <!-- Contact Us Content End -->

                    <!-- Contact Us Image Start -->
                    <div class="contact-us-image">
                        <div class="contact-us-img">
                            <figure class="image-anime">
                                <img src="{{ asset('assets/images/contact-us-image.jpg') }}" alt="">
                            </figure>
                        </div>
                        <!-- Working Hours Box Start -->
                        <div class="working-hours-box">
                            <!-- Working Hours Header Start -->
                            <div class="working-hours-header">
                                <h3>Working Hours:</h3>
                            </div>
                            <!-- Working Hours Header End -->

                            <!-- Working Hours Body Start -->
                            <div class="working-hours-body">
                                <ul>
                                    <li>Mon - Fri: <span>10:00AM - 07:00PM</span></li>
                                    <li>Saturday: <span>12:00AM - 05:00PM</span></li>
                                    <li>Sunday: <span>closed</span></li>
                                </ul>
                            </div>
                            <!-- Working Hours Body End -->
                        </div>
                        <!-- Working Hours Box End -->
                    </div>
                    <!-- Contact Us Image End -->
                </div>
                <!-- Contact Us Box End -->
            </div>
        </div>
    </div>
</div>
<!-- Page Contact Us End -->

<!-- Contact Form Map Section Start -->
<div class="contact-form-map">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Contact Form Box start -->
                <div class="contact-form-box">
                    <!-- Contact Form Box End -->
                    <div class="contact-us-form">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Get in touch with us</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">We're here to answer your questions & explore new possibilities together.</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Contact Form Start -->
                        <div class="contact-form wow fadeInUp" data-wow-delay="0.4s">
                            <form id="contactForm" action="#" method="POST" data-toggle="validator">
                                <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-12 mb-5">
                                        <textarea name="message" class="form-control" id="message" rows="4" placeholder="Message..."></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn-default btn-highlighted"><span>Submit Message</span></button>
                                        <div id="msgSubmit" class="h3 hidden"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Contact Form End -->
                    </div>

                    <!-- Google Map Start -->
                    <div class="google-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96737.10562045308!2d-74.08535042841811!3d40.739265258395164!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1703158537552!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <!-- Google Map End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Form Map Section End -->

@endsection