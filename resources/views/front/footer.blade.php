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
                        <form id="newslettersForm" action="#" method="POST">
                            <div class="form-group">
                                <input type="email" name="mail" class="form-control" id="mail" placeholder="Enter Your E-mail Address" required>
                                <button type="submit" class="newsletter-btn text-white"><img src="{{ asset('assets/images/arrow-primary.svg') }}" alt=""></button>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="#" name="#">
                                <label class="form-label">I agree to the <a href="#">Privacy Policy</a>.</label>
                            </div>
                        </form>
                    </div>
                    <!-- Footer Newsletter Form End -->
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