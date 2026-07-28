@extends('layouts.guest')
@section('title','Get To Know')
@section('content')

<style>
    :root {
        --primary: #00697E;
        --primary-dark: #004F5F;
        --primary-deep: #003843;
        --primary-light: #E8F4F6;
        --primary-soft: #F4FAFB;
        --accent: #7DD3C0;
        --white: #FFFFFF;
        --text-dark: #0F1B2D;
        --text-muted: #5B6B7B;
        --border: #E4ECEF;
        --shadow-sm: 0 2px 10px rgba(0, 105, 126, .06);
        --shadow-md: 0 10px 30px rgba(0, 105, 126, .10);
        --shadow-lg: 0 22px 55px rgba(0, 105, 126, .16);
        --r-sm: 10px;
        --r-md: 16px;
        --r-lg: 24px;
        --tr: all .3s cubic-bezier(.4, 0, .2, 1);
    }

    * {
        box-sizing: border-box
    }

    img {
        max-width: 100%
    }

    /* ===== HERO ===== */
    .hero-modern {
        position: relative;
        min-height: 92vh;
        display: flex;
        align-items: center;
        color: var(--white);
        padding: 120px 0 80px;
        overflow: hidden;
        background: linear-gradient(125deg, #00697E 0%, #004F5F 55%, #003843 100%);
    }

    .hero-modern::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        background:
            radial-gradient(circle at 12% 20%, rgba(255, 255, 255, .10) 0%, transparent 38%),
            radial-gradient(circle at 88% 78%, rgba(125, 211, 192, .14) 0%, transparent 42%);
    }

    .hero-modern::after {
        content: "";
        position: absolute;
        top: -120px;
        right: -120px;
        width: 420px;
        height: 420px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, .12);
    }

    .hero-modern .container {
        position: relative;
        z-index: 2
    }

    .hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, .10);
        border: 1px solid rgba(255, 255, 255, .22);
        backdrop-filter: blur(8px);
        padding: 9px 18px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 24px;
    }

    .hero-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--accent)
    }

    .hero-title {
        font-size: clamp(2.1rem, 5vw, 3.9rem);
        font-weight: 800;
        line-height: 1.08;
        letter-spacing: -.02em;
        margin-bottom: 22px;
        max-width: 820px;
    }

    .hero-title span {
        color: var(--accent)
    }

    .hero-subtitle {
        font-size: 1.08rem;
        line-height: 1.75;
        color: rgba(255, 255, 255, .86);
        max-width: 620px;
        margin-bottom: 34px;
    }

    .hero-actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        align-items: center
    }

    .hero-stats {
        display: flex;
        gap: 42px;
        margin-top: 60px;
        padding-top: 34px;
        border-top: 1px solid rgba(255, 255, 255, .16);
        flex-wrap: wrap;
    }

    .hero-stat-num {
        font-size: 1.9rem;
        font-weight: 800;
        color: var(--accent)
    }

    .hero-stat-label {
        font-size: 12.5px;
        color: rgba(255, 255, 255, .78);
        margin-top: 4px;
        letter-spacing: .5px
    }

    /* ===== BUTTONS ===== */
    .btn-m {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 26px;
        border-radius: 100px;
        font-weight: 600;
        font-size: 14px;
        letter-spacing: .3px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: var(--tr);
        white-space: nowrap;
    }

    .btn-m-primary {
        background: var(--white);
        color: var(--primary)
    }

    .btn-m-primary:hover {
        background: var(--accent);
        color: var(--primary-deep);
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(0, 0, 0, .22)
    }

    .btn-m-outline {
        background: transparent;
        color: var(--primary);
        border: 1.5px solid var(--primary)
    }

    .btn-m-outline:hover {
        background: var(--primary);
        color: var(--white);
        transform: translateY(-2px)
    }

    .btn-m-light {
        background: var(--primary);
        color: var(--white)
    }

    .btn-m-light:hover {
        background: var(--primary-dark);
        transform: translateY(-2px)
    }

    .btn-m-ghost {
        background: rgba(255, 255, 255, .08);
        color: #fff;
        border: 1.5px solid rgba(255, 255, 255, .4)
    }

    .btn-m-ghost:hover {
        background: rgba(255, 255, 255, .18)
    }

    .readmore-m {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
        font-size: 13.5px;
        color: var(--primary);
        text-decoration: none;
        transition: var(--tr);
    }

    .readmore-m:hover {
        gap: 12px;
        color: var(--primary-dark)
    }

    .readmore-m.light {
        color: var(--accent)
    }

    .readmore-m.light:hover {
        color: #fff
    }

    /* ===== SECTION COMMON ===== */
    .section {
        padding: 96px 0
    }

    .section-light {
        background: var(--white)
    }

    .section-soft {
        background: var(--primary-soft)
    }

    .section-dark {
        background: linear-gradient(160deg, #00697E, #003843);
        color: #fff
    }

    .section-head {
        margin-bottom: 52px
    }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--primary);
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1.8px;
        margin-bottom: 14px;
    }

    .eyebrow::before {
        content: "";
        width: 26px;
        height: 2px;
        background: var(--primary)
    }

    .section-dark .eyebrow {
        color: var(--accent)
    }

    .section-dark .eyebrow::before {
        background: var(--accent)
    }

    .s-title {
        font-size: clamp(1.65rem, 3.4vw, 2.5rem);
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -.02em;
        color: var(--text-dark);
        margin-bottom: 14px;
    }

    .section-dark .s-title {
        color: #fff
    }

    .s-sub {
        font-size: 1rem;
        color: var(--text-muted);
        line-height: 1.75;
        max-width: 620px
    }

    .section-dark .s-sub {
        color: rgba(255, 255, 255, .85)
    }

    /* ===== ABOUT ===== */
    .about-card {
        background: #fff;
        border-radius: var(--r-lg);
        padding: 32px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        position: relative;
        overflow: hidden;
    }

    .about-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--primary)
    }

    .about-quote {
        font-size: 1.05rem;
        line-height: 1.7;
        color: var(--text-dark);
        font-style: italic;
        margin-bottom: 24px
    }

    .founder-row {
        display: flex;
        align-items: center;
        gap: 16px;
        padding-top: 20px;
        border-top: 1px solid var(--border)
    }

    .founder-avatar {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid var(--primary)
    }

    .founder-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    .founder-label {
        font-size: 11px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1.2px
    }

    .founder-name {
        font-weight: 700;
        color: var(--text-dark);
        font-size: 14px
    }

    .about-grid {
        display: grid;
        grid-template-columns: 1.3fr 1fr 1.3fr;
        gap: 22px;
        margin-top: 56px
    }

    .about-tile {
        border-radius: var(--r-lg);
        overflow: hidden;
        position: relative;
        min-height: 340px;
        box-shadow: var(--shadow-md)
    }

    .about-tile>img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        inset: 0
    }

    .about-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 40%, rgba(0, 57, 67, .92) 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 26px;
        color: #fff
    }

    .about-overlay h3 {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0
    }

    .about-list {
        list-style: none;
        padding: 0;
        margin: 0
    }

    .about-list li {
        padding: 5px 0;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px
    }

    .about-list li::before {
        content: "→";
        color: var(--accent);
        font-weight: 700
    }

    .about-mission {
        background: linear-gradient(160deg, #00697E, #003843);
        color: #fff;
        padding: 32px;
        display: flex;
        flex-direction: column;
        justify-content: center
    }

    .about-mission h3 {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 12px
    }

    .about-mission p {
        line-height: 1.7;
        opacity: .92;
        margin-bottom: 20px;
        font-size: 14.5px
    }

    /* ===== PROGRAMS ===== */
    .program-card {
        background: #fff;
        border-radius: var(--r-md);
        padding: 28px;
        height: 100%;
        border: 1px solid var(--border);
        transition: var(--tr);
        position: relative;
        overflow: hidden;
    }

    .program-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary);
        transform: scaleX(0);
        transform-origin: left;
        transition: var(--tr)
    }

    .program-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
        border-color: transparent
    }

    .program-card:hover::before {
        transform: scaleX(1)
    }

    .program-card h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 12px
    }

    .program-card h3 a {
        color: inherit;
        text-decoration: none
    }

    .program-card p {
        color: var(--text-muted);
        font-size: 13.5px;
        line-height: 1.65;
        margin-bottom: 18px
    }

    /* ===== WHY CHOOSE ===== */
    .why-img-wrap {
        border-radius: var(--r-lg);
        overflow: hidden;
        position: relative;
        box-shadow: var(--shadow-lg)
    }

    .why-img-wrap img {
        width: 100%;
        height: auto;
        display: block
    }

    .why-badge {
        position: absolute;
        bottom: 22px;
        left: 22px;
        background: #fff;
        padding: 16px 22px;
        border-radius: var(--r-md);
        box-shadow: var(--shadow-md);
        display: flex;
        align-items: center;
        gap: 14px;
        max-width: 80%
    }

    .why-badge-num {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1
    }

    .why-badge-text {
        font-size: 12.5px;
        color: var(--text-muted);
        line-height: 1.4
    }

    .why-feature {
        display: flex;
        gap: 18px;
        padding: 22px;
        background: #fff;
        border-radius: var(--r-md);
        border: 1px solid var(--border);
        transition: var(--tr);
        margin-bottom: 14px
    }

    .why-feature:hover {
        box-shadow: var(--shadow-md);
        transform: translateX(6px);
        border-color: var(--primary)
    }

    .why-icon {
        width: 50px;
        height: 50px;
        flex-shrink: 0;
        background: var(--primary-light);
        border-radius: var(--r-sm);
        display: flex;
        align-items: center;
        justify-content: center
    }

    .why-icon img {
        width: 26px;
        height: 26px
    }

    .why-feature h3 {
        font-size: 1.02rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 6px
    }

    .why-feature p {
        font-size: 13.5px;
        color: var(--text-muted);
        line-height: 1.6;
        margin: 0
    }

    /* ===== MEMBERSHIP ===== */
    .member-card {
        background: rgba(255, 255, 255, .07);
        border: 1px solid rgba(255, 255, 255, .16);
        backdrop-filter: blur(8px);
        border-radius: var(--r-md);
        padding: 24px;
        margin-bottom: 14px;
        transition: var(--tr);
        display: flex;
        gap: 18px;
    }

    .member-card:hover {
        background: rgba(255, 255, 255, .13);
        transform: translateY(-4px);
        border-color: var(--accent)
    }

    .member-icon {
        width: 46px;
        height: 46px;
        flex-shrink: 0;
        background: rgba(125, 211, 192, .18);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .member-icon img {
        width: 22px;
        height: 22px
    }

    .member-card h3 {
        font-size: 1.02rem;
        font-weight: 700;
        margin-bottom: 6px;
        color: #fff
    }

    .member-card p {
        font-size: 13px;
        color: rgba(255, 255, 255, .82);
        line-height: 1.6;
        margin: 0
    }

    /* ===== RESEARCH ===== */
    .research-card {
        border-radius: var(--r-md);
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--border);
        transition: var(--tr);
        height: 100%;
        position: relative
    }

    .research-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg)
    }

    .research-img {
        aspect-ratio: 4/3;
        overflow: hidden;
        position: relative
    }

    .research-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s ease
    }

    .research-card:hover .research-img img {
        transform: scale(1.08)
    }

    .research-arrow {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: translateY(-8px);
        transition: var(--tr);
        box-shadow: var(--shadow-sm)
    }

    .research-card:hover .research-arrow {
        opacity: 1;
        transform: translateY(0)
    }

    .research-arrow img {
        width: 16px
    }

    .research-body {
        padding: 20px 22px
    }

    .research-body h3 {
        font-size: 1.02rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.4
    }

    .research-body h3 a {
        color: var(--text-dark);
        text-decoration: none
    }

    .research-body h3 a:hover {
        color: var(--primary)
    }

    /* ===== FAQ ===== */
    .accordion-item {
        background: #fff;
        border: 1px solid var(--border) !important;
        border-radius: var(--r-md) !important;
        margin-bottom: 12px;
        overflow: hidden
    }

    .accordion-button {
        background: #fff;
        color: var(--text-dark);
        font-weight: 600;
        font-size: 1rem;
        padding: 20px 24px;
        box-shadow: none !important
    }

    .accordion-button:not(.collapsed) {
        background: #fff;
        color: var(--primary)
    }

    .accordion-button::after {
        filter: invert(20%) sepia(85%) saturate(800%) hue-rotate(155deg)
    }

    .accordion-body {
        padding: 0 24px 20px;
        color: var(--text-muted);
        line-height: 1.7;
        font-size: 14.5px
    }

    /* ===== TESTIMONIAL ===== */
    .testimonial-card {
        background: #fff;
        border-radius: var(--r-lg);
        padding: 38px;
        max-width: 780px;
        margin: 0 auto;
        box-shadow: var(--shadow-lg);
        position: relative;
        color: #00697E;
    }

    .testimonial-quote {
        font-size: 3.2rem;
        color: var(--primary);
        line-height: 1;
        font-family: Georgia, serif;
        margin-bottom: 8px
    }

    .testimonial-text {
        font-size: 1.1rem;
        line-height: 1.7;
        color: var(--text-dark);
        font-style: italic;
        margin-bottom: 24px
    }

    .testimonial-author h4 {
        margin: 0;
        font-size: 1rem;
        color: var(--text-dark)
    }

    .testimonial-author p {
        margin: 0;
        font-size: 13px;
        color: var(--primary);
        font-weight: 600
    }

    /* ===== BLOG ===== */
    .blog-card {
        background: #fff;
        border-radius: var(--r-md);
        overflow: hidden;
        border: 1px solid var(--border);
        transition: var(--tr);
        height: 100%
    }

    .blog-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg)
    }

    .blog-img {
        aspect-ratio: 16/10;
        overflow: hidden;
        background: var(--primary-soft);
        display: flex;
        align-items: center;
        justify-content: center
    }

    .blog-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s
    }

    .blog-card:hover .blog-img img {
        transform: scale(1.06)
    }

    .blog-body {
        padding: 22px
    }

    .blog-body h3 {
        font-size: 1.05rem;
        font-weight: 700;
        margin: 0 0 12px;
        line-height: 1.4
    }

    .blog-body h3 a {
        color: var(--text-dark);
        text-decoration: none
    }

    .blog-body h3 a:hover {
        color: var(--primary)
    }

    .cta-pill {
        background: #fff;
        color: var(--primary);
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--tr)
    }

    .cta-pill:hover {
        background: var(--accent);
        color: var(--primary-deep)
    }

    @media(max-width:991px) {
        .about-grid {
            grid-template-columns: 1fr
        }

        .section {
            padding: 70px 0
        }
    }
</style>

<!-- ============ HERO ============ -->
<section class="hero-modern">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <span class="hero-tag"><span class="hero-dot"></span> NextGen MedResearch • Africa</span>
                <h1 class="hero-title">Building Africa's Next Generation of <span>Medical Researchers</span></h1>
                <p class="hero-subtitle">A social innovation platform connecting clinicians, mentors, and institutions to advance research, mentorship, and capacity building.</p>
                <div class="hero-actions">
                    <a href="{{ route('about') }}" class="btn-m btn-m-primary">Learn more →</a>
                    <a role="button" data-bs-toggle="modal" data-bs-target="#membershipModal" class="btn-m btn-m-ghost">Join the community</a>
                </div>
                <div class="hero-stats">
                    <div>
                        <div class="hero-stat-num">3+</div>
                        <div class="hero-stat-label">Membership tiers</div>
                    </div>
                    <div>
                        <div class="hero-stat-num">100%</div>
                        <div class="hero-stat-label">Impact-driven</div>
                    </div>
                    <div>
                        <div class="hero-stat-num">Pan-African</div>
                        <div class="hero-stat-label">Network reach</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ ABOUT ============ -->
<section class="section section-light">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="eyebrow">Our Vision</span>
                <h2 class="s-title">Transforming medical research in Africa through mentorship, innovation & collaboration.</h2>
            </div>
            <div class="col-lg-5">
                <div class="about-card">
                    <p class="about-quote">"Born from the challenges of limited research mentorship in Rwanda, NextGen MedResearch bridges gaps in training, mentorship, and research collaboration."</p>
                    <div class="founder-row">
                        <div class="founder-avatar"><img src="{{ asset('assets/images/founder-1.jpeg') }}" alt=""></div>
                        <div>
                            <div class="founder-label">Founder's Message</div>
                            <div class="founder-name">NextGen MedResearch</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="about-grid">
            <div class="about-tile">
                <img src="{{ asset('assets/images/banner_New1.jpg') }}" alt="">
                <div class="about-overlay">
                    <h3>NextGen MedResearch</h3>
                </div>
            </div>
            <div class="about-tile about-mission">
                <h3>Our Mission</h3>
                <p>Connecting clinicians, researchers, and mentors to build capacity, conduct impactful studies, and shape future healthcare leaders.</p>
                <a href="{{ route('about') }}" class="readmore-m light">Learn more →</a>
            </div>
            <div class="about-tile">
                <img src="{{ asset('assets/images/IYP_6213.jpg') }}" alt="">
                <div class="about-overlay">
                    <ul class="about-list">
                        <li>Mentorship</li>
                        <li>Research Collaboration</li>
                        <li>Capacity Building & Innovation</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ PROGRAMS ============ -->
<section class="section section-soft">
    <div class="container">
        <div class="row align-items-end g-4 section-head">
            <div class="col-lg-7">
                <span class="eyebrow">Our Programs</span>
                <h2 class="s-title">Key research fields driving impact</h2>
            </div>
            <div class="col-lg-5">
                <p class="s-sub">Each program is supported by expert teams and modern methods — rooted in curiosity, driven by data, and designed for real-world impact.</p>
            </div>
        </div>

        <div class="row g-4">
            @foreach($programs as $program)
            <div class="col-lg-3 col-md-6">
                <div class="program-card">
                    <h3><a href="{{ route('programs.detail', $program->slug) }}">{{ $program->title }}</a></h3>
                    <p>{!! Str::limit($program->description, 60) !!}</p>
                    <a href="{{ route('programs.detail', $program->slug)}}" class="readmore-m">Learn more →</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <p style="color:var(--text-dark);font-size:1.02rem;margin:0;">
                Explore the research that shapes tomorrow —
                <a role="button" data-bs-toggle="modal" data-bs-target="#membershipModal" class="cta-pill">Apply for Membership</a>
            </p>
        </div>
    </div>
</section>

<!-- ============ WHY CHOOSE US ============ -->
<section class="section section-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <div class="why-img-wrap">
                    <img src="{{ asset('assets/images/image-3.png') }}" alt="">
                    <div class="why-badge">
                        <div class="why-badge-num">★</div>
                        <div class="why-badge-text">Connected research<br>ecosystem</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <span class="eyebrow">Why Choose Us</span>
                <h2 class="s-title">A connected, collaborative, and impactful research ecosystem.</h2>
                <p class="s-sub mb-4">Join a community linking medical professionals, researchers, and institutions to foster innovation across Africa.</p>

                <div class="why-feature">
                    <div class="why-icon"><img src="{{ asset('assets/images/icon-why-choose-1.svg') }}" alt=""></div>
                    <div>
                        <h3>Proven Track Record</h3>
                        <p>Evidence-based mentorship, collaborative work, and measurable research impact.</p>
                    </div>
                </div>
                <div class="why-feature">
                    <div class="why-icon"><img src="{{ asset('assets/images/icon-why-choose-2.svg') }}" alt=""></div>
                    <div>
                        <h3>Collaborative Approach</h3>
                        <p>We work closely with the research community to understand their needs and challenges.</p>
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="btn-m btn-m-light mt-3">Contact us →</a>
            </div>
        </div>
    </div>
</section>

<!-- ============ MEMBERSHIP ============ -->
<section class="section section-dark">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="eyebrow">Join Our Community</span>
                <h2 class="s-title">Empower your journey. Shape Africa's medical research future.</h2>
                <p class="s-sub mb-4">Membership connects you to mentorship, research collaboration, workshops, and innovation opportunities across Africa.</p>
                <a role="button" data-bs-toggle="modal" data-bs-target="#membershipModal" class="btn-m btn-m-primary">Apply for Membership →</a>
                <p class="mt-3" style="color:rgba(255,255,255,.8);font-size:14px;">Unlock your potential. Connect, contribute, and lead.</p>
            </div>
            <div class="col-lg-6">
                <div class="member-card">
                    <div class="member-icon"><img src="{{ asset('assets/images/icon-what-we-item-1.svg') }}" alt=""></div>
                    <div>
                        <h3>Individual Membership</h3>
                        <p>For students, residents, and early-career researchers. Mentorship, webinars, training resources, and certification.</p>
                    </div>
                </div>
                <div class="member-card">
                    <div class="member-icon"><img src="{{ asset('assets/images/icon-what-we-item-2.svg') }}" alt=""></div>
                    <div>
                        <h3>Trainer / Expert Membership</h3>
                        <p>For mentors and facilitators. Host sessions, guide mentees, and access collaboration dashboards.</p>
                    </div>
                </div>
                <div class="member-card">
                    <div class="member-icon"><img src="{{ asset('assets/images/icon-what-we-item-3.svg') }}" alt=""></div>
                    <div>
                        <h3>Institutional Membership</h3>
                        <p>For universities, hospitals, and NGOs. Priority collaboration in projects, workshops, and innovation initiatives.</p>
                    </div>
                </div>
                <div class="member-card">
                    <div class="member-icon"><img src="{{ asset('assets/images/icon-what-we-item-4.svg') }}" alt=""></div>
                    <div>
                        <h3>Scientific Partnerships</h3>
                        <p>Co-developing innovative research with academic, private, and government partners.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ RESEARCH ============ -->
<section class="section section-light">
    <div class="container">
        <div class="row align-items-end g-4 section-head">
            <div class="col-lg-7">
                <span class="eyebrow">Research Studies</span>
                <h2 class="s-title">Explore our latest research</h2>
            </div>
            <div class="col-lg-5 text-lg-end">
                <a href="{{ route('research.index') }}" class="btn-m btn-m-outline">Explore All Research →</a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($researches as $research)
            <div class="col-lg-4 col-md-6">
                <div class="research-card">
                    <div class="research-img">
                        <img src="{{asset('image/research')}}/{{ $research->featured_image }}" alt="">
                        <a href="{{ route('research.detail', $research->slug) }}" class="research-arrow">
                            <img src="{{ asset('assets/images/arrow-primary.svg') }}" alt="">
                        </a>
                    </div>
                    <div class="research-body">
                        <h3><a href="{{ route('research.detail', $research->slug) }}">{{ $research->title }}</a></h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ============ FAQs ============ -->
<section class="section section-soft">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <span class="eyebrow">FAQs</span>
                <h2 class="s-title">Frequently asked questions</h2>
                <p class="s-sub mb-4">Quick answers about our services, research process, and capabilities.</p>
                <a href="{{ route('faq.page') }}" class="btn-m btn-m-light">View All FAQs →</a>
            </div>
            <div class="col-lg-7">
                <div class="accordion" id="faqAccordion">
                    @foreach($faqs as $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $loop->index + 1 }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index + 1 }}" aria-expanded="false" aria-controls="collapse{{ $loop->index + 1 }}">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $loop->index + 1 }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loop->index + 1 }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">{{ $faq->answer }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ TESTIMONIALS ============ -->
@if($testimonials->isNotEmpty())
<section class="section section-dark">
    <div class="container">
        <div class="text-center mb-5">
            <span class="eyebrow" style="justify-content:center;">Testimonials</span>
            <h2 class="s-title">What our community says</h2>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testimonial-card">
                                    <div class="testimonial-quote">"</div>
                                    <p class="testimonial-text">{!! str::limit($testimonial->testimonial, 100) !!}</p>
                                    <div class="testimonial-author">
                                        <div>
                                            <h4>{{ $testimonial->name }}</h4>
                                            <p>{{ $testimonial->role }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="testimonial-pagination mt-4 text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ============ BLOG ============ -->
<section class="section section-light">
    <div class="container">
        <div class="row align-items-end g-4 section-head">
            <div class="col-lg-7">
                <span class="eyebrow">Our Blog</span>
                <h2 class="s-title">Stay updated with science & innovation</h2>
            </div>
            <div class="col-lg-5 text-lg-end">
                <a href="{{ route('news')}}" class="btn-m btn-m-outline">View All Blogs →</a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($news as $new)
            <div class="col-lg-4 col-md-6">
                <div class="blog-card">
                    <div class="blog-img">
                        @if ($new->featured_image)
                        <img src="{{asset('image/posts')}}/{{ $new->featured_image }}" alt="">
                        @else
                        <span class="text-muted" style="font-size:13px;">No image</span>
                        @endif
                    </div>
                    <div class="blog-body">
                        <h3><a href="{{ route('news.detail', $new->slug )}}">{{ $new->title }}</a></h3>
                        <a href="{{ route('news.detail', $new->slug )}}" class="readmore-m">Learn more →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection