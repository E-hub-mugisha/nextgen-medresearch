<!-- Footer Start -->
<footer class="main-footer bg-section dark-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- About Footer Start -->
                <div class="about-footer">
                    <!-- Footer Logo Start -->
                    <div class="footer-logo">
                        <img src="{{ asset('assets/images/logo-white.png') }}" alt="">
                    </div>
                    <!-- Footer Logo End -->

                    <!-- About Footer Content Start -->
                    <div class="about-footer-content">
                        <p>NextGen MedResearch.org is a social innovation initiative dedicated to building the next generation of medical researchers in Africa.</p>
                    </div>
                    <!-- About Footer Content End -->

                </div>
                <!-- About Footer End -->
            </div>

            <div class="col-lg-5 col-md-7">
                <!-- Footer Links Box Start -->
                <div class="footer-links-box">
                    <!-- Footer Links Start -->
                    <div class="footer-links">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About us</a></li>
                            <li><a href="{{ route('projects') }}">Projects</a></li>
                            <li><a href="{{ route('contact') }}">contact us</a></li>
                        </ul>
                    </div>
                    <!-- Footer Links End -->

                    <!-- Footer Links Start -->
                    <div class="footer-links">
                        <h3>Our Programs</h3>
                        <ul>
                            @php $programs = \App\Models\Program::all(); @endphp
                            @foreach($programs as $program)
                            <li><a href="{{ route('programs.detail', $program->slug)}}">{{ $program->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Footer Links End -->
                </div>
                <!-- Footer Links Box End -->
            </div>

            <div class="col-lg-3 col-md-5">
                <div class="footer-newsletter-box">
                    <h3>Subscribe to our newsletter</h3>

                    <!-- Footer Newsletter Form Start -->
                    <div class="footer-newsletter-form">
                        <form id="newsletterForm" method="POST">
                            @csrf

                            <div class="form-group d-flex align-items-center position-relative">
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Enter your email address"
                                    required>
                                <button type="submit" class="newsletter-btn text-white">
                                    <img src="{{ asset('assets/images/arrow-primary.svg') }}" style="color: white;" alt="Submit">
                                </button>
                            </div>

                            <div class="form-group mt-2">
                                <input type="checkbox" id="privacy" name="privacy" required>
                                <label for="privacy" style="color: white;">
                                    I agree to the <a href="#" style="color: white;">Privacy Policy</a>.
                                </label>
                            </div>

                            <small class="text-success d-none" id="newsletterSuccess">
                                Thank you for subscribing!
                            </small>
                        </form>


                    </div>
                    <!-- Footer Newsletter Form End -->

                    <!-- footer social links -->

                    <style>
                        .footer-social-links ul {
                            list-style: none;
                            padding: 0;
                            display: flex;
                            gap: 15px;
                        }

                        .footer-social-links ul li a {
                            color: #ffffff;
                            font-size: 16px;
                            transition: color 0.3s;
                        }

                        .footer-social-links ul li a:hover {
                            color: #007bff;
                        }
                    </style>
                    <div class="footer-social-links mt-4">
                        <h2 class="h5 text-white mb-3">Follow Us</h2>
                        <ul>
                            <li><a href="https://x.com/HomegrownMR"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com/in/nextgen-medresearchers-840987366?utm_source=share_via&utm_content=profile&utm_medium=member_android"><i class="fab fa-linkedin-in"></i></a></li>
                            <li>
                                <a href="https://bsky.app/profile/mugangamukuru.bsky.social" target="_blank" aria-label="Bluesky">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 11.39c-.67-1.3-2.5-3.9-4.46-5.28C5.66 4.77 4.93 4.5 4.23 4.5c-.7 0-1.23.36-1.23 1.33 0 .97.52 8.15.86 9.31.42 1.4 1.9 1.88 3.25 1.64-1.96.33-3.7 1.14-3.7 3.23 0 2.09 1.16 2.63 2.6 2.63 2.6 0 4.1-3.35 4.99-5.13.9 1.78 2.28 5.13 4.99 5.13 1.44 0 2.6-.54 2.6-2.63 0-2.09-1.74-2.9-3.7-3.23 1.35.24 2.83-.24 3.25-1.64.34-1.16.86-8.34.86-9.31 0-.97-.53-1.33-1.23-1.33-.7 0-1.43.27-3.31 1.61-1.96 1.38-3.79 3.98-4.46 5.28z" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <!-- Footer Copyright Start -->
                <div class="footer-copyright-text">
                    <p>Copyright © 2025 {{ config('app.name') }} All Rights Reserved.</p>
                </div>
                <!-- Footer Copyright End -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->

<script>
$('#newsletterForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: "{{ route('newsletter.subscribe') }}",
        method: "POST",
        data: $(this).serialize(),
        success: function () {
            $('#newsletterSuccess').removeClass('d-none');
            $('#newsletterForm')[0].reset();
        },
        error: function (xhr) {
            alert(
                xhr.responseJSON?.message ??
                'Subscription failed. Please try again.'
            );
        }
    });
});
</script>
