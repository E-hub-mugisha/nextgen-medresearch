@extends('layouts.guest')
@section('title', 'Research Space')
@section('content')

<style>
    :root {
        --bg-white: #ffffff;
        --bg-light: #f8fafc;
        --bg-subtle: #f1f5f9;
        --border-color: #e2e8f0;
        --border-light: #f1f5f9;
        --text-primary: #0f172a;
        --text-secondary: #475569;
        --text-muted: #94a3b8;
        --accent: #00697E;
        --accent-light: #6366f1;
        --accent-bg: #eef2ff;
        --accent-border: #c7d2fe;
        --orange: #ea580c;
        --orange-bg: #fff7ed;
        --orange-border: #fed7aa;
        --emerald: #059669;
        --emerald-bg: #ecfdf5;
        --emerald-border: #a7f3d0;
        --purple: #7c3aed;
        --purple-bg: #f5f3ff;
        --purple-border: #ddd6fe;
        --pink: #db2777;
        --radius-sm: 0.5rem;
        --radius-md: 0.75rem;
        --radius-lg: 1rem;
        --radius-xl: 1.25rem;
        --shadow-sm: 0 1px 2px 0 rgba(0,0,0,0.05);
        --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -2px rgba(0,0,0,0.05);
        --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.04);
        --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.04);
    }

    .rs-section {
        padding: 5rem 0;
    }

    .rs-section-sm {
        padding: 3rem 0;
    }

    /* ---- Hero ---- */
    .rs-hero {
        padding: 6rem 0 4rem;
        background: linear-gradient(135deg, var(--accent-bg) 0%, #ffffff 50%, var(--purple-bg) 100%);
        position: relative;
        overflow: hidden;
    }

    .rs-hero::after {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(99,102,241,0.08) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .rs-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 1rem;
        background: var(--bg-white);
        border: 1px solid var(--accent-border);
        border-radius: 9999px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--accent);
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .rs-hero-badge .dot {
        width: 6px;
        height: 6px;
        background: var(--accent);
        border-radius: 50%;
        animation: pulse-dot 2s ease-in-out infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(1.6); }
    }

    .rs-hero-title {
        font-size: clamp(2.25rem, 4.5vw, 3.5rem);
        font-weight: 700;
        line-height: 1.1;
        letter-spacing: -0.03em;
        color: var(--text-primary);
        margin-bottom: 1.25rem;
    }

    .rs-hero-title .gradient-text {
        background: linear-gradient(135deg, var(--accent), var(--purple));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .rs-hero-desc {
        font-size: 1.1rem;
        font-weight: 400;
        line-height: 1.75;
        color: var(--text-secondary);
        max-width: 540px;
        margin-bottom: 2rem;
    }

    .rs-hero-image {
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-xl);
        border: 1px solid var(--border-color);
    }

    .rs-hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .rs-stat-row {
        display: flex;
        gap: 2.5rem;
        flex-wrap: wrap;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    .rs-stat-item .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .rs-stat-item .stat-label {
        font-size: 0.8rem;
        color: var(--text-muted);
        font-weight: 400;
    }

    /* ---- Section Headers ---- */
    .rs-section-label {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 0.9rem;
        background: var(--accent-bg);
        border: 1px solid var(--accent-border);
        border-radius: 9999px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--accent);
        margin-bottom: 0.75rem;
    }

    .rs-section-title {
        font-size: clamp(1.75rem, 3vw, 2.25rem);
        font-weight: 700;
        line-height: 1.2;
        letter-spacing: -0.02em;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
    }

    .rs-section-desc {
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.7;
        color: var(--text-secondary);
        max-width: 640px;
    }

    /* ---- Buttons ---- */
    .rs-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.5rem;
        background: var(--accent);
        color: #fff;
        font-size: 0.85rem;
        font-weight: 500;
        border: none;
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: all 0.25s ease;
        text-decoration: none;
    }

    .rs-btn-primary:hover {
        background: var(--accent-light);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 20px -4px rgba(79,70,229,0.3);
    }

    .rs-btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.5rem;
        background: var(--bg-white);
        color: var(--text-secondary);
        font-size: 0.85rem;
        font-weight: 500;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: all 0.25s ease;
        text-decoration: none;
    }

    .rs-btn-outline:hover {
        background: var(--bg-light);
        border-color: #cbd5e1;
        color: var(--text-primary);
    }

    /* ---- Feature Split ---- */
    .rs-feature-split {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    @media (max-width: 768px) {
        .rs-feature-split { grid-template-columns: 1fr; gap: 2rem; }
    }

    .rs-feature-image {
        border-radius: var(--radius-xl);
        overflow: hidden;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-lg);
    }

    .rs-feature-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    /* ---- Target Grid ---- */
    .rs-target-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.875rem;
    }

    @media (max-width: 992px) { .rs-target-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px) { .rs-target-grid { grid-template-columns: 1fr; } }

    .rs-target-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.9rem 1.1rem;
        background: var(--bg-white);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        transition: all 0.25s ease;
        cursor: default;
    }

    .rs-target-item:hover {
        border-color: var(--accent-border);
        background: var(--accent-bg);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .rs-target-item .target-num {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-sm);
        background: var(--accent-bg);
        color: var(--accent);
        font-size: 0.7rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .rs-target-item:hover .target-num {
        background: var(--accent);
        color: #fff;
    }

    .rs-target-item .target-label {
        font-size: 0.875rem;
        font-weight: 400;
        color: var(--text-secondary);
    }

    .rs-target-item:hover .target-label {
        color: var(--text-primary);
    }

    /* ---- Research Cards ---- */
    .rs-research-card {
        background: var(--bg-white);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: all 0.35s cubic-bezier(0.25,0.46,0.45,0.94);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .rs-research-card:hover {
        border-color: var(--accent-border);
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
    }

    .rs-research-card .card-accent {
        height: 3px;
        background: linear-gradient(90deg, var(--accent), var(--purple));
    }

    .rs-research-card .card-body-inner {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .rs-research-card .card-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .rs-research-card .card-desc {
        font-size: 0.85rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 1rem;
        flex: 1;
    }

    .rs-research-card .card-target {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--accent);
        background: var(--accent-bg);
        padding: 0.25rem 0.65rem;
        border-radius: var(--radius-sm);
        display: inline-block;
        margin-bottom: 0;
    }

    .rs-research-card .card-footer-inner {
        padding: 0.9rem 1.5rem;
        border-top: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--bg-light);
    }

    .rs-research-card .card-date {
        font-size: 0.72rem;
        color: var(--text-muted);
    }

    .rs-research-card .card-btn {
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--accent);
        background: none;
        border: 1px solid var(--accent-border);
        padding: 0.3rem 0.8rem;
        border-radius: var(--radius-sm);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .rs-research-card .card-btn:hover {
        background: var(--accent);
        color: #fff;
        border-color: var(--accent);
    }

    /* ---- Resource Sections ---- */
    .rs-resource-group-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .rs-resource-group-title .icon-circle {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-md);
        font-size: 1rem;
    }

    .rs-resource-group-title .icon-circle.ppt {
        background: var(--orange-bg);
        border: 1px solid var(--orange-border);
        color: var(--orange);
    }

    .rs-resource-group-title .icon-circle.rec {
        background: var(--emerald-bg);
        border: 1px solid var(--emerald-border);
        color: var(--emerald);
    }

    .rs-resource-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .rs-resource-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.9rem 1.1rem;
        background: var(--bg-white);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        text-decoration: none;
        transition: all 0.25s ease;
        cursor: pointer;
    }

    .rs-resource-item:hover {
        border-color: #cbd5e1;
        background: var(--bg-light);
        transform: translateX(4px);
        box-shadow: var(--shadow-sm);
    }

    .rs-resource-item .resource-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-md);
        flex-shrink: 0;
    }

    .rs-resource-item .resource-icon.ppt-icon {
        background: var(--orange-bg);
        border: 1px solid var(--orange-border);
        color: var(--orange);
    }

    .rs-resource-item .resource-icon.rec-icon {
        background: var(--emerald-bg);
        border: 1px solid var(--emerald-border);
        color: var(--emerald);
    }

    .rs-resource-item .resource-info {
        flex: 1;
        min-width: 0;
    }

    .rs-resource-item .resource-title {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--text-primary);
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .rs-resource-item .resource-author {
        font-size: 0.72rem;
        color: var(--text-muted);
        margin-top: 0.15rem;
    }

    .rs-resource-item .resource-arrow {
        color: var(--text-muted);
        font-size: 0.875rem;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .rs-resource-item:hover .resource-arrow {
        color: var(--accent);
        transform: translateX(2px);
    }

    /* ---- Inline Preview ---- */
    .rs-inline-preview {
        display: none;
        margin-top: 0.5rem;
        margin-left: 1rem;
        padding: 1rem 1.25rem;
        background: var(--bg-light);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        animation: slideDown 0.3s ease;
    }

    .rs-inline-preview.active {
        display: block;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-6px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .rs-inline-preview .preview-placeholder {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .rs-inline-preview .preview-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .rs-inline-preview .preview-info .preview-icon-sm {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--orange-bg);
        border: 1px solid var(--orange-border);
        border-radius: var(--radius-sm);
        color: var(--orange);
        font-size: 0.85rem;
    }

    .rs-inline-preview .preview-info p {
        margin: 0;
        font-size: 0.8rem;
        color: var(--text-secondary);
    }

    .rs-inline-preview .preview-info p small {
        display: block;
        font-size: 0.7rem;
        color: var(--text-muted);
    }

    .rs-toggle-preview {
        cursor: pointer;
        user-select: none;
    }

    .rs-toggle-preview .resource-arrow {
        transition: transform 0.3s ease;
    }

    .rs-toggle-preview.expanded .resource-arrow {
        transform: rotate(90deg);
    }

    /* ---- Resources Grid ---- */
    .rs-resources-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
    }

    @media (max-width: 992px) {
        .rs-resources-grid { grid-template-columns: 1fr; }
    }

    /* ---- Divider ---- */
    .rs-divider {
        height: 1px;
        background: var(--border-color);
        border: none;
        margin: 0;
    }

    /* ---- CTA Card ---- */
    .rs-cta-card {
        background: linear-gradient(135deg, var(--accent-bg), var(--purple-bg));
        border: 1px solid var(--accent-border);
        border-radius: var(--radius-xl);
        padding: 4rem 2rem;
        text-align: center;
    }

    /* ---- Highlight Box ---- */
    .rs-highlight-box {
        background: var(--bg-light);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: 1.1rem 1.4rem;
    }

    .rs-highlight-box p {
        font-size: 0.9rem;
        color: var(--text-secondary);
        line-height: 1.65;
        margin: 0;
    }

    .rs-highlight-box .hl-feasible { color: var(--accent); font-weight: 600; }
    .rs-highlight-box .hl-ethical { color: var(--purple); font-weight: 600; }
    .rs-highlight-box .hl-impact { color: var(--pink); font-weight: 600; }

    /* ---- Modal Override ---- */
    .modal-content {
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-xl);
    }

    .modal-header {
        border-bottom: 1px solid var(--border-color);
        padding: 1.5rem 2rem;
    }

    .modal-header .modal-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-body p {
        color: var(--text-secondary);
        line-height: 1.7;
        margin-bottom: 1.25rem;
    }

    .modal-body p strong {
        color: var(--text-primary);
        font-weight: 600;
        display: block;
        margin-bottom: 0.4rem;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--text-muted);
    }

    .modal-footer {
        border-top: 1px solid var(--border-color);
        padding: 1rem 2rem;
    }

    /* ---- Pagination ---- */
    .pagination .page-item .page-link {
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        font-size: 0.8rem;
        padding: 0.45rem 0.8rem;
        margin: 0 0.1rem;
        border-radius: var(--radius-sm) !important;
    }

    .pagination .page-item.active .page-link {
        background: var(--accent);
        border-color: var(--accent);
        color: #fff;
    }

    .pagination .page-item .page-link:hover {
        background: var(--bg-light);
        color: var(--text-primary);
    }

    /* ---- Fade Up ---- */
    .fade-up {
        opacity: 0;
        transform: translateY(16px);
        transition: all 0.6s cubic-bezier(0.25,0.46,0.45,0.94);
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* ---- Small btn for preview ---- */
    .rs-btn-sm {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 0.9rem;
        background: var(--accent);
        color: #fff;
        font-size: 0.72rem;
        font-weight: 500;
        border: none;
        border-radius: var(--radius-sm);
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .rs-btn-sm:hover {
        background: var(--accent-light);
        color: #fff;
    }
</style>

<!-- ==================== HERO ==================== -->
<section class="rs-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="rs-hero-badge fade-up">
                    <span class="dot"></span>
                    Research Space
                </div>
                <h1 class="rs-hero-title fade-up" style="transition-delay:0.1s">
                    Dissertation-Ready<br>
                    <span class="gradient-text">Research Topics</span>
                </h1>
                <p class="rs-hero-desc fade-up" style="transition-delay:0.2s">
                    Developed through literature reviews, analysis of university research repositories, and consultations with experienced clinicians and researchers to ensure feasibility, relevance, and academic quality.
                </p>
                <div class="d-flex gap-3 flex-wrap fade-up" style="transition-delay:0.3s">
                    <a href="{{ route('contact') }}" class="rs-btn-primary">
                        Get Started
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="#presentations" class="rs-btn-outline">
                        Browse Resources
                    </a>
                </div>
                <div class="rs-stat-row fade-up" style="transition-delay:0.4s">
                    <div class="rs-stat-item">
                        <div class="stat-value">7</div>
                        <div class="stat-label">Presentations</div>
                    </div>
                    <div class="rs-stat-item">
                        <div class="stat-value">9</div>
                        <div class="stat-label">Recordings</div>
                    </div>
                    <div class="rs-stat-item">
                        <div class="stat-value">8</div>
                        <div class="stat-label">Target Groups</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="rs-hero-image fade-up" style="transition-delay:0.3s">
                    <img src="{{ asset('assets/images/image-3.png') }}" alt="Research Space">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================== TARGETS ==================== -->
<section class="rs-section" style="background-color: var(--bg-light);">
    <div class="container">
        <div class="text-center mb-5">
            <div class="rs-section-label fade-up">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m12 8-4 4 4 4"/><path d="m16 8-4 4 4 4"/></svg>
                Who It's For
            </div>
            <h2 class="rs-section-title fade-up" style="transition-delay:0.1s">Research Space Targets</h2>
            <p class="rs-section-desc mx-auto fade-up" style="transition-delay:0.2s">
                This research space is designed to support learners and professionals who want strong, realistic and academically defensible dissertation topics.
            </p>
        </div>

        <div class="rs-target-grid">
            <div class="rs-target-item fade-up" style="transition-delay:0.05s">
                <span class="target-num">1</span>
                <span class="target-label">Medical Students & Interns</span>
            </div>
            <div class="rs-target-item fade-up" style="transition-delay:0.1s">
                <span class="target-num">2</span>
                <span class="target-label">Residents & Fellows</span>
            </div>
            <div class="rs-target-item fade-up" style="transition-delay:0.15s">
                <span class="target-num">3</span>
                <span class="target-label">Early-Career Clinicians</span>
            </div>
            <div class="rs-target-item fade-up" style="transition-delay:0.2s">
                <span class="target-num">4</span>
                <span class="target-label">Allied Health Professionals</span>
            </div>
            <div class="rs-target-item fade-up" style="transition-delay:0.25s">
                <span class="target-num">5</span>
                <span class="target-label">Academic Institutions</span>
            </div>
            <div class="rs-target-item fade-up" style="transition-delay:0.3s">
                <span class="target-num">6</span>
                <span class="target-label">Public Health Researchers</span>
            </div>
            <div class="rs-target-item fade-up" style="transition-delay:0.35s">
                <span class="target-num">7</span>
                <span class="target-label">NGOs & Policy Partners</span>
            </div>
            <div class="rs-target-item fade-up" style="transition-delay:0.4s">
                <span class="target-num">8</span>
                <span class="target-label">Independent Researchers</span>
            </div>
        </div>

        <div class="text-center mt-5 fade-up" style="transition-delay:0.5s">
            <a data-bs-toggle="modal" data-bs-target="#roleModal" class="rs-btn-primary">
                Join the Research Space
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
<!-- ==================== PRESENTATIONS & RECORDINGS ==================== -->
<section class="rs-section" id="presentations" style="background-color: var(--bg-light);">
    <div class="container">
        <div class="text-center mb-5">
            <div class="rs-section-label fade-up">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Learning Resources
            </div>
            <h2 class="rs-section-title fade-up" style="transition-delay:0.1s">Presentations & Recordings</h2>
            <p class="rs-section-desc mx-auto fade-up" style="transition-delay:0.2s">
                Access expert-led PowerPoint presentations and session recordings to strengthen your research skills.
            </p>
        </div>

        <div class="rs-resources-grid">
            <!-- PowerPoint Presentations -->
            <div class="fade-up" style="transition-delay:0.1s">
                <div class="rs-resource-group-title">
                    <span class="icon-circle ppt">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                    </span>
                    PowerPoint Presentations
                </div>

                <div class="rs-resource-list">
                    <!-- 1 -->
                    <div class="rs-resource-item rs-toggle-preview" onclick="togglePreview('ppt-1', this)">
                        <div class="resource-icon ppt-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="m8 21 4-4 4 4"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">Research as a Career Anchor</div>
                            <div class="resource-author">Dr. Mojeed Gbadamosi</div>
                        </div>
                        <span class="resource-arrow">→</span>
                    </div>
                    <div class="rs-inline-preview" id="ppt-1">
                        <div class="preview-placeholder">
                            <div class="preview-info">
                                <div class="preview-icon-sm">📊</div>
                                <p>Google Slides Presentation <small>Click to open in new tab</small></p>
                            </div>
                            <a href="https://docs.google.com/presentation/d/1G8ael2_TtIwdRPhS78jGdhaidhrnf-1Q/edit?usp=drive_link" target="_blank" class="rs-btn-sm">
                                Open
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="rs-resource-item rs-toggle-preview" onclick="togglePreview('ppt-2', this)">
                        <div class="resource-icon ppt-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="m8 21 4-4 4 4"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">Research Concept Development</div>
                            <div class="resource-author">Dr. Daniel Byiringiro</div>
                        </div>
                        <span class="resource-arrow">→</span>
                    </div>
                    <div class="rs-inline-preview" id="ppt-2">
                        <div class="preview-placeholder">
                            <div class="preview-info">
                                <div class="preview-icon-sm">📊</div>
                                <p>Google Drive Presentation <small>Click to open in new tab</small></p>
                            </div>
                            <a href="https://drive.google.com/file/d/16nEeLWqo71-6CGIFatY6cm8BnI7f2o24/view?usp=drive_link" target="_blank" class="rs-btn-sm">
                                Open
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="rs-resource-item rs-toggle-preview" onclick="togglePreview('ppt-3', this)">
                        <div class="resource-icon ppt-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="m8 21 4-4 4 4"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">How to Protect Your Resident Research from Bias, Bad Charts, and Tiny Samples</div>
                            <div class="resource-author">Dr. Mojeed Gbadamosi</div>
                        </div>
                        <span class="resource-arrow">→</span>
                    </div>
                    <div class="rs-inline-preview" id="ppt-3">
                        <div class="preview-placeholder">
                            <div class="preview-info">
                                <div class="preview-icon-sm">📊</div>
                                <p>Google Drive Presentation <small>Click to open in new tab</small></p>
                            </div>
                            <a href="https://drive.google.com/file/d/1M9uW6zihM3hKp68VXwURKUMLrb6AKpFg/view?usp=drive_link" target="_blank" class="rs-btn-sm">
                                Open
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- 4 -->
                    <div class="rs-resource-item rs-toggle-preview" onclick="togglePreview('ppt-4', this)">
                        <div class="resource-icon ppt-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="m8 21 4-4 4 4"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">How to Stop Guessing Your Sample Size and Start Convincing the IRB</div>
                            <div class="resource-author">Dr. Mojeed Gbadamosi</div>
                        </div>
                        <span class="resource-arrow">→</span>
                    </div>
                    <div class="rs-inline-preview" id="ppt-4">
                        <div class="preview-placeholder">
                            <div class="preview-info">
                                <div class="preview-icon-sm">📊</div>
                                <p>Google Drive Presentation <small>Click to open in new tab</small></p>
                            </div>
                            <a href="https://drive.google.com/file/d/15UYQ6-RielG4awsx08F3gj87ZeBb3cik/view?usp=sharing" target="_blank" class="rs-btn-sm">
                                Open
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- 5 -->
                    <div class="rs-resource-item rs-toggle-preview" onclick="togglePreview('ppt-5', this)">
                        <div class="resource-icon ppt-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="m8 21 4-4 4 4"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">Your Checklist for Flawless Analysis, Management, and Reporting</div>
                            <div class="resource-author">Dr. Mojeed Gbadamosi</div>
                        </div>
                        <span class="resource-arrow">→</span>
                    </div>
                    <div class="rs-inline-preview" id="ppt-5">
                        <div class="preview-placeholder">
                            <div class="preview-info">
                                <div class="preview-icon-sm">📊</div>
                                <p>Google Drive Presentation <small>Click to open in new tab</small></p>
                            </div>
                            <a href="https://drive.google.com/file/d/1WqKpylgI5UIXnHfoiF5OFBb7F5xVLqwb/view?usp=sharing" target="_blank" class="rs-btn-sm">
                                Open
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- 6 -->
                    <div class="rs-resource-item rs-toggle-preview" onclick="togglePreview('ppt-6', this)">
                        <div class="resource-icon ppt-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="m8 21 4-4 4 4"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">Writing High-Quality Results Sections</div>
                            <div class="resource-author">Dr. David Ikwuka</div>
                        </div>
                        <span class="resource-arrow">→</span>
                    </div>
                    <div class="rs-inline-preview" id="ppt-6">
                        <div class="preview-placeholder">
                            <div class="preview-info">
                                <div class="preview-icon-sm">📊</div>
                                <p>Google Drive Presentation <small>Click to open in new tab</small></p>
                            </div>
                            <a href="https://drive.google.com/file/d/1G-MrwOEEUpr4im3_qw1XV_D6tb8dLRlu/view?usp=sharing" target="_blank" class="rs-btn-sm">
                                Open
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- 7 -->
                    <div class="rs-resource-item rs-toggle-preview" onclick="togglePreview('ppt-7', this)">
                        <div class="resource-icon ppt-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="m8 21 4-4 4 4"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">Writing Discussion Sections Seminar</div>
                            <div class="resource-author">Dr. David Ikwuka</div>
                        </div>
                        <span class="resource-arrow">→</span>
                    </div>
                    <div class="rs-inline-preview" id="ppt-7">
                        <div class="preview-placeholder">
                            <div class="preview-info">
                                <div class="preview-icon-sm">📊</div>
                                <p>Google Drive Presentation <small>Click to open in new tab</small></p>
                            </div>
                            <a href="https://drive.google.com/file/d/1XYV_WIZhDWeRyI54WT9Su3A6VmE9bJXL/view?usp=sharing" target="_blank" class="rs-btn-sm">
                                Open
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- 8 -->
                    <div class="rs-resource-item rs-toggle-preview" onclick="togglePreview('ppt-8', this)">
                        <div class="resource-icon ppt-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="m8 21 4-4 4 4"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">The Resident Research Space</div>
                            <div class="resource-author">Dr. Menelas N. MD, MMed, MSc</div>
                        </div>
                        <span class="resource-arrow">→</span>
                    </div>
                    <div class="rs-inline-preview" id="ppt-8">
                        <div class="preview-placeholder">
                            <div class="preview-info">
                                <div class="preview-icon-sm">📊</div>
                                <p>Google Drive Presentation <small>Click to open in new tab</small></p>
                            </div>
                            <a href="https://docs.google.com/presentation/d/1o4E8eDQl5hR4h0ZUGMYiF3fBpNQ2rqIu/edit?usp=sharing&ouid=116808387962001444555&rtpof=true&sd=true" target="_blank" class="rs-btn-sm">
                                Open
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>
                    </div>

                    <!-- 9 -->
                    <div class="rs-resource-item rs-toggle-preview" onclick="togglePreview('ppt-9', this)">
                        <div class="resource-icon ppt-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="m8 21 4-4 4 4"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">Conceptual Alignment Strategic Literature search</div>
                            <div class="resource-author">Daniel BYIRINGIRO MD, MMSc GHD (Cand)</div>
                        </div>
                        <span class="resource-arrow">→</span>
                    </div>
                    <div class="rs-inline-preview" id="ppt-9">
                        <div class="preview-placeholder">
                            <div class="preview-info">
                                <div class="preview-icon-sm">📊</div>
                                <p>Google Drive Presentation <small>Click to open in new tab</small></p>
                            </div>
                            <a href="https://drive.google.com/file/d/1QKIaMuMqdiPXhKsS80Rz95rCG0h6tlIl/view?usp=sharing" target="_blank" class="rs-btn-sm">
                                Open
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recordings -->
            <div class="fade-up" style="transition-delay:0.2s">
                <div class="rs-resource-group-title">
                    <span class="icon-circle rec">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
                    </span>
                    Session Recordings
                </div>

                <div class="rs-resource-list">
                    <a href="https://us06web.zoom.us/rec/share/q8mwH_W5vlTHs1dbj0NZz-h-9ViEL6Rpdmg6vRpkJBYVBebjRYnn-6xEsm7IpK-d._tzgk9lc0XgMY3x1" target="_blank" class="rs-resource-item">
                        <div class="resource-icon rec-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">Identifying Meaningful Research Gaps and Refining Research Ideas</div>
                            <div class="resource-author">Zoom Recording</div>
                        </div>
                        <span class="resource-arrow">↗</span>
                    </a>

                    <a href="https://us06web.zoom.us/rec/share/RvM1klu48KdXuDAiZ0MAL2pfYIntEK9NNVWHhEwMG_Nvo4JBK9S0HLOZzvcwYnw.Qn7UNWb4hUhd6mrE" target="_blank" class="rs-resource-item">
                        <div class="resource-icon rec-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">Effective Search Strategies: Keywords, Boolean Operators & MeSH Terms</div>
                            <div class="resource-author">Zoom Recording</div>
                        </div>
                        <span class="resource-arrow">↗</span>
                    </a>

                    <a href="https://us06web.zoom.us/rec/share/Wq4gfw7ddaG8iiptGxyxxAWRDxZym8vPBDyyuNmzzoGOYjbFslShiPRFzJoivkcy.Jy3ZScGChs9suSoX" target="_blank" class="rs-resource-item">
                        <div class="resource-icon rec-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">How to Formulate a Clear Problem Statement / Research Gap</div>
                            <div class="resource-author">Zoom Recording</div>
                        </div>
                        <span class="resource-arrow">↗</span>
                    </a>

                    <a href="https://us06web.zoom.us/rec/share/bX1fxVYgxMFEopxWxHyuch-zzDQYvpq6CiRJv5_aovIDdpEGbM1DSYjNHSdDuCAG.a2hV3xEqY2kGBHqZ" target="_blank" class="rs-resource-item">
                        <div class="resource-icon rec-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">Translating a Refined Research Question into Variables, Data Sources & Study Design</div>
                            <div class="resource-author">Zoom Recording</div>
                        </div>
                        <span class="resource-arrow">↗</span>
                    </a>

                    <a href="https://us06web.zoom.us/rec/share/rov9jg84VemVWctWtqRfTQg4L2q97LpDsWp5ku3dRRHQxVEStzV_puQ0kUAR9rd4.M5RFvNkUPDOygAxV" target="_blank" class="rs-resource-item">
                        <div class="resource-icon rec-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">Your Checklist for Flawless Analysis, Management, and Reporting</div>
                            <div class="resource-author">Dr. Mojeed Gbadamosi — Zoom Recording</div>
                        </div>
                        <span class="resource-arrow">↗</span>
                    </a>

                    <a href="https://us06web.zoom.us/rec/share/Jcon6MycIERa-kEVDznc3mrFZrEO0558yGjE4mD6YlpyHvoadK2muN-SGcg6JFEw.GRLijtPlQUlA8zae" target="_blank" class="rs-resource-item">
                        <div class="resource-icon rec-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">How to Protect Your Resident Research from Bias, Bad Charts, and Tiny Samples</div>
                            <div class="resource-author">Dr. Mojeed Gbadamosi — Zoom Recording</div>
                        </div>
                        <span class="resource-arrow">↗</span>
                    </a>

                    <a href="https://us06web.zoom.us/rec/share/HtWLxubhlia_QuHAftqW42kUhpOEER8AIQ1ZhESR_ZoRDzDq_uL6jLzXGEsK0x7i.JFAVSwpu8oriHw-_" target="_blank" class="rs-resource-item">
                        <div class="resource-icon rec-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">How to Stop Guessing Your Sample Size and Start Convincing the IRB</div>
                            <div class="resource-author">Dr. Mojeed Gbadamosi — Zoom Recording</div>
                        </div>
                        <span class="resource-arrow">↗</span>
                    </a>

                    <a href="https://us06web.zoom.us/rec/share/7i5k_tlEDTQVyPWkvKpFtkWOLR9zqxU9H2UHlHXXaoTaV4Y-I56i6c9tmIEs_DEa.2t7qzYnc1M_SJxKe" target="_blank" class="rs-resource-item">
                        <div class="resource-icon rec-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">Writing Discussion Sections Seminar</div>
                            <div class="resource-author">Dr. David Ikwuka — Zoom Recording</div>
                        </div>
                        <span class="resource-arrow">↗</span>
                    </a>

                    <a href="https://us06web.zoom.us/rec/share/vdJoRL5prs-9BnVWRAJwodwLmbXFEQxSLIqEpWnk7VCrx7zRwyy7lLbb_k8tTmpr.SJ2f5pf36ONgOBvf" target="_blank" class="rs-resource-item">
                        <div class="resource-icon rec-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        </div>
                        <div class="resource-info">
                            <div class="resource-title">Writing High-Quality Results Sections</div>
                            <div class="resource-author">Dr. David Ikwuka — Zoom Recording</div>
                        </div>
                        <span class="resource-arrow">↗</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== WHY IMPORTANT ==================== -->
<section class="rs-section" style="background-color: var(--bg-white);">
    <div class="container">
        <div class="rs-feature-split">
            <div class="rs-feature-image fade-up">
                <img src="{{ asset('assets/images/image-4.png') }}" alt="Why This Space Matters">
            </div>
            <div>
                <div class="rs-section-label fade-up">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                    Why It Matters
                </div>
                <h2 class="rs-section-title fade-up" style="transition-delay:0.1s">Why This Space is Important</h2>
                <p class="rs-section-desc fade-up" style="transition-delay:0.2s">
                    Many students struggle with unclear topics, lack of direction, or choosing research ideas that are either too broad or not academically relevant.
                </p>
                <p class="rs-section-desc mt-3 fade-up" style="transition-delay:0.3s">
                    This Research Space bridges that gap by offering well-thought-out, realistic, and academically strong dissertation ideas that respond to real healthcare challenges in Rwanda and beyond.
                </p>
                <div class="rs-highlight-box mt-4 fade-up" style="transition-delay:0.35s">
                    <p>Each topic is designed to be <span class="hl-feasible">feasible</span>, <span class="hl-ethical">ethically sound</span>, <span class="hl-impact">impactful</span>, and aligned with national and global health priorities.</p>
                </div>
                <div class="mt-4 fade-up" style="transition-delay:0.45s">
                    <a data-bs-toggle="modal" data-bs-target="#roleModal" class="rs-btn-primary">
                        Get Mentorship
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ==================== CTA ==================== -->
<section class="rs-section" style="background-color: var(--bg-white);">
    <div class="container">
        <div class="rs-cta-card fade-up">
            <div class="rs-section-label" style="justify-content: center; margin-bottom: 1rem;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Get Involved
            </div>
            <h2 class="rs-section-title">Ready to Start Your Research Journey?</h2>
            <p class="rs-section-desc mx-auto">
                Join our research community and get access to mentorship, dissertation-ready topics, and expert guidance.
            </p>
            <div class="d-flex gap-3 justify-content-center mt-4 flex-wrap">
                <a data-bs-toggle="modal" data-bs-target="#roleModal" class="rs-btn-primary">
                    Join the Research Space
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a href="{{ route('contact') }}" class="rs-btn-outline">
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const delay = entry.target.style.transitionDelay || '0s';
                    entry.target.style.transitionDelay = delay;
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -40px 0px'
        });

        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
    });

    function togglePreview(id, triggerEl) {
        const preview = document.getElementById(id);
        const allPreviews = document.querySelectorAll('.rs-inline-preview');
        const allTriggers = document.querySelectorAll('.rs-toggle-preview');

        allPreviews.forEach(p => {
            if (p.id !== id) p.classList.remove('active');
        });

        allTriggers.forEach(t => {
            if (t !== triggerEl) t.classList.remove('expanded');
        });

        preview.classList.toggle('active');
        triggerEl.classList.toggle('expanded');
    }
</script>

@endsection