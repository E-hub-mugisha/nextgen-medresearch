@extends('layouts.guest')
@section('title','CONTACT US')
@section('content')



<!-- Page Contact Us Start -->
<div class="page-contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Contact Us Box Start -->
                <div class="contact-us-box" style="margin-top: 40px;">
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
                                    <h3><a href="tel:+250788409237">+250 788 409 237</a></h3>
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
                                    <h3><a href="mailto:info@nextgenmedresearch.org">info@nextgenmedresearch.org</a></h3>
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
                            <style>
                                .footer-social-links ul {
                                    list-style: none;
                                    padding: 0;
                                    display: flex;
                                    gap: 15px;
                                }

                                .footer-social-links ul li a {
                                    color: #00697E;
                                    font-size: 16px;
                                    transition: color 0.3s;
                                }

                                .footer-social-links ul li a:hover {
                                    color: #007bff;
                                }
                            </style>
                            <div class="footer-social-links mt-4">
                                <h3 class=" mb-3">Follow Us</h3>
                                <ul>
                                    <li><a href="https://x.com/HomegrownMR" style="color: #00697E;"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.linkedin.com/in/nextgen-medresearchers-840987366?utm_source=share_via&utm_content=profile&utm_medium=member_android" style="color: #00697E;"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li>
                                        <a href="https://bsky.app/profile/mugangamukuru.bsky.social" target="_blank" aria-label="Bluesky" style="color: #00697E;">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 11.39c-.67-1.3-2.5-3.9-4.46-5.28C5.66 4.77 4.93 4.5 4.23 4.5c-.7 0-1.23.36-1.23 1.33 0 .97.52 8.15.86 9.31.42 1.4 1.9 1.88 3.25 1.64-1.96.33-3.7 1.14-3.7 3.23 0 2.09 1.16 2.63 2.6 2.63 2.6 0 4.1-3.35 4.99-5.13.9 1.78 2.28 5.13 4.99 5.13 1.44 0 2.6-.54 2.6-2.63 0-2.09-1.74-2.9-3.7-3.23 1.35.24 2.83-.24 3.25-1.64.34-1.16.86-8.34.86-9.31 0-.97-.53-1.33-1.23-1.33-.7 0-1.43.27-3.31 1.61-1.96 1.38-3.79 3.98-4.46 5.28z" />
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Contact Info List End -->
                    </div>
                    <!-- Contact Us Content End -->

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
                            <form id="contactForm" method="POST" action="{{ route('contact.send') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="fname" class="form-control form-control-lg" placeholder="First Name" required>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="lname" class="form-control form-control-lg" placeholder="Last Name" required>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" name="phone" class="form-control form-control-lg" placeholder="Phone" required>
                                    </div>

                                    <div class="form-group col-md-12 mb-5">
                                        <textarea name="message" class="form-control" rows="4" placeholder="Message..." required></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn-default btn-highlighted">Submit</button>
                                    </div>
                                </div>
                            </form>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                $(document).ready(function() {
                                    $('#contactForm').submit(function(e) {
                                        e.preventDefault();
                                        let form = $(this);
                                        $.ajax({
                                            url: form.attr('action'),
                                            method: 'POST',
                                            data: form.serialize(),
                                            success: function(res) {
                                                if (res.success) {
                                                    Swal.fire('Success', res.message, 'success');
                                                    form[0].reset();
                                                }
                                            },
                                            error: function(xhr) {
                                                let msg = 'Something went wrong';
                                                if (xhr.responseJSON && xhr.responseJSON.errors) {
                                                    msg = Object.values(xhr.responseJSON.errors).map(e => e.join(',')).join('\n');
                                                }
                                                Swal.fire('Error', msg, 'error');
                                            }
                                        });
                                    });
                                });
                            </script>

                        </div>
                        <!-- Contact Form End -->
                    </div>

                    <!-- Google Map Start -->
                    <div class="google-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127601.78934010678!2d30.044843255949928!3d-1.9295970340479436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca4258ed8e797%3A0xf32b36a5411d0bc8!2sKigali!5e0!3m2!1sen!2srw!4v1767443617880!5m2!1sen!2srw" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <!-- Google Map End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Form Map Section End -->

@endsection