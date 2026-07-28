<!-- Footer Start -->
<footer class="main-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row g-4 g-lg-5">

                <!-- Brand / About -->
                <div class="col-lg-4 col-md-12">
                    <div class="footer-brand">
                        <a href="{{ route('home') }}" class="footer-logo">
                            <img src="{{ asset('assets/images/logo-white.png') }}" alt="{{ config('app.name') }}">
                        </a>
                        <p class="footer-tagline">From Curiosity to Clinical Impact</p>
                        <p class="footer-desc">
                            A community-driven research platform empowering the next generation of
                            medical researchers through mentorship, collaboration and shared knowledge.
                        </p>

                        <!-- Social -->
                        <div class="footer-social">
                            <span class="footer-social-label">Follow Us</span>
                            <ul class="social-list">
                                <li>
                                    <a href="https://x.com/HomegrownMR" target="_blank" rel="noopener" aria-label="X (Twitter)">
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/in/nextgen-medresearchers-840987366" target="_blank" rel="noopener" aria-label="LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://bsky.app/profile/mugangamukuru.bsky.social" target="_blank" rel="noopener" aria-label="Bluesky">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path d="M12 11.39c-.67-1.3-2.5-3.9-4.46-5.28C5.66 4.77 4.93 4.5 4.23 4.5c-.7 0-1.23.36-1.23 1.33 0 .97.52 8.15.86 9.31.42 1.4 1.9 1.88 3.25 1.64-1.96.33-3.7 1.14-3.7 3.23 0 2.09 1.16 2.63 2.6 2.63 2.6 0 4.1-3.35 4.99-5.13.9 1.78 2.28 5.13 4.99 5.13 1.44 0 2.6-.54 2.6-2.63 0-2.09-1.74-2.9-3.7-3.23 1.35.24 2.83-.24 3.25-1.64.34-1.16.86-8.34.86-9.31 0-.97-.53-1.33-1.23-1.33-.7 0-1.43.27-3.31 1.61-1.96 1.38-3.79 3.98-4.46 5.28z"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="footer-links">
                        <h3 class="footer-title">Quick Links</h3>
                        <ul>
                            <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"></i> Home</a></li>
                            <li><a href="{{ route('about') }}"><i class="bi bi-chevron-right"></i> About</a></li>
                            <li><a href="{{ route('contact') }}"><i class="bi bi-chevron-right"></i> Contact Us</a></li>
                            <li><a href="{{ route('rescue.sheet.public') }}"><i class="bi bi-chevron-right"></i> Rescue Sheets</a></li>
                            <li>
                                <a role="button" data-bs-toggle="modal" data-bs-target="#roleModal">
                                    <i class="bi bi-chevron-right"></i> Join the Community
                                </a>
                            </li>
                            <li>
                                <a role="button" data-bs-toggle="modal" data-bs-target="#membershipModal">
                                    <i class="bi bi-chevron-right"></i> Become a Member
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- About (from header submenu) -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="footer-links">
                        <h3 class="footer-title">Programs</h3>
                        @php $footerPrograms = \App\Models\Program::where('status','published')->orderBy('title')->limit(4)->get(); @endphp
                        @if($footerPrograms->count())
                        <ul>
                            @foreach($footerPrograms as $program)
                            <li><a href="{{ route('programs.detail', $program->slug) }}"><i class="bi bi-chevron-right"></i> {{ $program->title }}</a></li>
                            @endforeach
                        </ul>
                        @else
                        <p class="footer-desc">No programs available at the moment.</p>
                        @endif
                    </div>
                </div>

                <!-- Resources / Knowledge Hub (from header mega menu) -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="footer-links">
                        <h3 class="footer-title">Resources</h3>
                        <ul>
                            <li><a href="{{ route('research.index') }}"><i class="bi bi-chevron-right"></i> Research Projects</a></li>
                            <li><a href="{{ route('kits.index') }}"><i class="bi bi-chevron-right"></i> Research Kits</a></li>
                            <li><a href="{{ route('mentor_qna.index') }}"><i class="bi bi-chevron-right"></i> Ask a Mentor</a></li>
                            <li><a href="{{ route('research.space') }}"><i class="bi bi-chevron-right"></i> Research Space</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="col-lg-2 col-md-12 col-sm-6">
                    <div class="footer-newsletter">
                        <h3 class="footer-title">Newsletter</h3>
                        <p class="newsletter-text">Get research insights and updates in your inbox.</p>

                        <form method="POST" action="{{ route('newsletter.subscribe') }}" class="newsletter-form" id="newsletterFormFooter">
                            @csrf
                            <div class="newsletter-input-wrap">
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control newsletter-input"
                                    placeholder="Your email address"
                                    required>
                                <button type="submit" class="newsletter-btn" aria-label="Subscribe">
                                    <i class="bi bi-send-fill"></i>
                                </button>
                            </div>

                            @if(session('success'))
                                <div class="newsletter-msg newsletter-msg--success">
                                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                                </div>
                            @endif

                            @error('email')
                                <div class="newsletter-msg newsletter-msg--error">
                                    <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                </div>
                            @enderror
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom / Copyright -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <p class="footer-copyright">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
                <p class="footer-tagline-sm">
                    <i class="bi bi-people-fill"></i> Mentorship
                    <span class="sep">•</span>
                    <i class="bi bi-handshake-fill"></i> Collaboration
                    <span class="sep">•</span>
                    <i class="bi bi-award-fill"></i> Research Excellence
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->

<style>
    /* ============ FOOTER ============ */
    .main-footer {
        --ft-teal: #00697E;
        --ft-teal-dark: #004E5F;
        --ft-teal-light: #0C8AA3;
        --ft-white: #ffffff;
        background: linear-gradient(180deg, var(--ft-teal) 0%, var(--ft-teal-dark) 100%);
        color: rgba(255, 255, 255, 0.85);
        position: relative;
        overflow: hidden;
    }

    /* subtle decorative overlay */
    .main-footer::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 12% 10%, rgba(255,255,255,0.06) 0%, transparent 35%),
            radial-gradient(circle at 88% 90%, rgba(255,255,255,0.05) 0%, transparent 40%);
        pointer-events: none;
        z-index: 0;
    }

    .main-footer > * { position: relative; z-index: 1; }

    /* ---------- Top Section ---------- */
    .footer-top {
        padding: 70px 0 55px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    }

    /* Brand column */
    .footer-brand .footer-logo img {
        height: 52px;
        width: auto;
        margin-bottom: 1.1rem;
        filter: brightness(0) invert(1);
    }

    .footer-tagline {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--ft-white);
        margin-bottom: 0.85rem;
        letter-spacing: 0.01em;
        position: relative;
        padding-bottom: 0.75rem;
    }

    .footer-tagline::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 48px;
        height: 3px;
        background: var(--ft-white);
        border-radius: 3px;
    }

    .footer-desc {
        font-size: 0.9rem;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.78);
        margin-bottom: 1.5rem;
        max-width: 380px;
    }

    /* ---------- Link columns ---------- */
    .footer-title {
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--ft-white);
        margin-bottom: 1.35rem;
        padding-bottom: 0.75rem;
        position: relative;
    }

    .footer-title::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 32px;
        height: 2px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 2px;
    }

    .footer-links ul,
    .footer-programs-list,
    .social-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.65rem;
    }

    .footer-links a {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: rgba(255, 255, 255, 0.78);
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        padding: 2px 0;
        transition: color 0.2s ease, transform 0.2s ease, padding-left 0.2s ease;
    }

    .footer-links a i {
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.55);
        transition: color 0.2s ease, transform 0.2s ease;
    }

    .footer-links a:hover {
        color: var(--ft-white);
        transform: translateX(3px);
    }

    .footer-links a:hover i {
        color: var(--ft-white);
    }

    /* ---------- Social ---------- */
    .footer-social {
        margin-top: 0.5rem;
    }

    .footer-social-label {
        display: block;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: rgba(255, 255, 255, 0.65);
        margin-bottom: 0.75rem;
    }

    .social-list {
        display: flex;
        gap: 0.6rem;
    }

    .social-list li a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: var(--ft-white);
        font-size: 0.95rem;
        text-decoration: none;
        transition: background 0.25s ease, border-color 0.25s ease, transform 0.25s ease;
    }

    .social-list li a:hover {
        background: var(--ft-white);
        color: var(--ft-teal);
        border-color: var(--ft-white);
        transform: translateY(-3px);
    }

    .social-list li a svg {
        width: 16px;
        height: 16px;
    }

    /* ---------- Newsletter ---------- */
    .newsletter-text {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.75);
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    .newsletter-form {
        margin-bottom: 1.4rem;
    }

    .newsletter-input-wrap {
        position: relative;
        display: flex;
        align-items: stretch;
    }

    .newsletter-input {
        flex: 1;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-right: none;
        border-radius: 8px 0 0 8px;
        padding: 0.65rem 0.85rem;
        font-size: 0.85rem;
        color: var(--ft-white);
        outline: none;
        transition: background 0.2s ease, border-color 0.2s ease;
    }

    .newsletter-input::placeholder {
        color: rgba(255, 255, 255, 0.55);
    }

    .newsletter-input:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.5);
    }

    .newsletter-btn {
        background: var(--ft-white);
        color: var(--ft-teal);
        border: 1px solid var(--ft-white);
        border-radius: 0 8px 8px 0;
        padding: 0 1rem;
        font-size: 0.95rem;
        cursor: pointer;
        transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .newsletter-btn:hover {
        background: var(--ft-teal-light);
        color: var(--ft-white);
        border-color: var(--ft-teal-light);
    }

    .newsletter-msg {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.8rem;
        margin-top: 0.6rem;
        padding: 0.4rem 0.6rem;
        border-radius: 6px;
    }

    .newsletter-msg--success {
        background: rgba(40, 200, 130, 0.15);
        color: #b6f3d4;
        border: 1px solid rgba(40, 200, 130, 0.3);
    }

    .newsletter-msg--error {
        background: rgba(255, 99, 99, 0.15);
        color: #ffc4c4;
        border: 1px solid rgba(255, 99, 99, 0.3);
    }

    /* Programs mini list */
    .footer-programs-list li {
        margin-bottom: 0.5rem;
    }

    .footer-programs-list a {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .footer-programs-list a:hover {
        color: var(--ft-white);
    }

    .footer-programs-list a i {
        color: var(--ft-teal-light);
        font-size: 0.85rem;
        filter: brightness(1.6);
    }

    /* ---------- Bottom bar ---------- */
    .footer-bottom {
        padding: 18px 0;
        background: rgba(0, 0, 0, 0.18);
    }

    .footer-bottom-inner {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
    }

    .footer-copyright {
        margin: 0;
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.8);
        font-weight: 500;
    }

    .footer-tagline-sm {
        margin: 0;
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.7);
        display: flex;
        align-items: center;
        gap: 0.4rem;
        flex-wrap: wrap;
    }

    .footer-tagline-sm i {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.85rem;
    }

    .footer-tagline-sm .sep {
        opacity: 0.5;
        margin: 0 0.15rem;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 991.98px) {
        .footer-top { padding: 55px 0 40px; }
        .footer-brand { margin-bottom: 1rem; }
        .footer-desc { max-width: 100%; }
    }

    @media (max-width: 767.98px) {
        .footer-top { padding: 45px 0 35px; }
        .footer-bottom-inner {
            flex-direction: column;
            text-align: center;
        }
        .footer-tagline-sm { justify-content: center; }
        .footer-brand .footer-logo img { height: 44px; }
    }

    @media (max-width: 575.98px) {
        .footer-title { margin-bottom: 1rem; }
        .footer-links li { margin-bottom: 0.5rem; }
    }
</style>

<script>
    // Newsletter AJAX (footer)
    (function () {
        var form = document.getElementById('newsletterFormFooter');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                        || formData.get('_token'),
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(function (res) { return res.json(); })
            .then(function () {
                form.reset();
                alert('Thank you for subscribing!');
            })
            .catch(function () {
                alert('Subscription failed. Please try again.');
            });
        });
    })();
</script>