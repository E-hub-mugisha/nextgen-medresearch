@php
if (! function_exists('activeRoute')) {
    function activeRoute($routes)
    {
        return request()->routeIs($routes) ? 'active' : '';
    }
}
 $programs = \App\Models\Program::where('status', 'published')->orderBy('title')->get();
@endphp

<!-- Header Start -->
<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex flex-wrap align-items-center justify-content-between">

                <!-- Logo Start -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/logo-white.png') }}" alt="Logo" class="site-logo">
                </a>
                <!-- Logo End -->

                <!-- Mobile Toggle -->
                <button class="navbar-toggler" type="button" aria-controls="mainNavbar"
                    aria-expanded="false" aria-label="Toggle navigation" id="navToggler">
                    <span class="toggler-bar"></span>
                    <span class="toggler-bar"></span>
                    <span class="toggler-bar"></span>
                </button>

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu" id="mainNavbar">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex flex-wrap align-items-center" id="menu">

                            <!-- About -->
                            <li class="nav-item submenu {{ activeRoute(['about','partners','our-impact']) }}">
                                <a class="nav-link submenu-toggle" href="#">
                                    About <i class="bi bi-chevron-down submenu-caret"></i>
                                </a>
                                <ul class="submenu-panel submenu-panel--simple">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('about') }}">
                                            <i class="bi bi-compass"></i> Vision, Mission
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('our-impact') }}">
                                            <i class="bi bi-graph-up-arrow"></i> Our Impact
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('partners') }}">
                                            <i class="bi bi-diagram-3"></i> Our Partners
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Programs -->
                            <li class="nav-item submenu {{ activeRoute(['programs','programs.detail']) }}">
                                <a class="nav-link submenu-toggle" href="#">
                                    Programs <i class="bi bi-chevron-down submenu-caret"></i>
                                </a>
                                <ul class="submenu-panel submenu-panel--simple">
                                    @forelse($programs as $program)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('programs.detail', $program->slug) }}">
                                            <i class="bi bi-journal-bookmark"></i> {{ $program->title }}
                                        </a>
                                    </li>
                                    @empty
                                    <li class="nav-item">
                                        <span class="nav-link text-muted">No active programs</span>
                                    </li>
                                    @endforelse
                                </ul>
                            </li>

                            <!-- Resources -->
                            <li class="nav-item submenu {{ activeRoute(['research.index','kits.index','mentor_qna.*']) }}">
                                <a class="nav-link submenu-toggle" href="#">
                                    Resources <i class="bi bi-chevron-down submenu-caret"></i>
                                </a>
                                <div class="submenu-panel submenu-panel--mega">
                                    <div class="mega-col">
                                        <p class="mega-col-title">Knowledge Hub</p>
                                        <a class="mega-link" href="{{ route('research.index') }}">
                                            <span class="mega-icon"><i class="bi bi-search"></i></span>
                                            <span>
                                                <span class="mega-link-title">Research Projects</span>
                                                <span class="mega-link-desc">Ongoing studies &amp; findings</span>
                                            </span>
                                        </a>
                                        <a class="mega-link" href="{{ route('kits.index') }}">
                                            <span class="mega-icon"><i class="bi bi-box-seam"></i></span>
                                            <span>
                                                <span class="mega-link-title">Research Kits</span>
                                                <span class="mega-link-desc">Templates &amp; toolkits</span>
                                            </span>
                                        </a>
                                        <a class="mega-link" href="{{ route('mentor_qna.index') }}">
                                            <span class="mega-icon"><i class="bi bi-chat-dots"></i></span>
                                            <span>
                                                <span class="mega-link-title">Ask a Mentor</span>
                                                <span class="mega-link-desc">Get expert guidance</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="mega-col mega-col--divide">
                                        <p class="mega-col-title">Latest</p>
                                        <a class="mega-link" href="{{ route('research.index') }}">
                                            <span class="mega-icon"><i class="bi bi-newspaper"></i></span>
                                            <span>
                                                <span class="mega-link-title">News</span>
                                                <span class="mega-link-desc">Updates from the community</span>
                                            </span>
                                        </a>
                                        <a class="mega-link" href="{{ route('kits.index') }}">
                                            <span class="mega-icon"><i class="bi bi-calendar-event"></i></span>
                                            <span>
                                                <span class="mega-link-title">Events</span>
                                                <span class="mega-link-desc">Workshops &amp; meetups</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <!-- Research Space -->
                            <li class="nav-item {{ activeRoute('research.space') }}">
                                <a class="nav-link" href="{{ route('research.space') }}">Research Space</a>
                            </li>

                            <!-- Contact -->
                            <li class="nav-item">
                                <a class="nav-link {{ activeRoute('contact') }}" href="{{ route('contact') }}">Contact</a>
                            </li>

                            <!-- Mobile Buttons -->
                            <li class="nav-item d-lg-none mt-3 w-100">
                                <a role="button" data-bs-toggle="modal" data-bs-target="#roleModal"
                                    class="nav-link btn btn-nav-primary w-100 text-center">Join</a>
                            </li>
                            <li class="nav-item d-lg-none mt-2 w-100 mb-1">
                                <a href="{{ route('rescue.sheet.public') }}"
                                    class="nav-link btn btn-nav-secondary w-100 text-center">Rescue Sheets</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Desktop Buttons -->
                    <div class="header-btn d-none d-lg-flex ms-3 flex-wrap mt-2 mt-lg-0 ms-lg-3">
                        <a href="{{ route('rescue.sheet.public') }}" class="btn btn-nav-secondary me-2">Rescue Sheets</a>
                        <a role="button" data-bs-toggle="modal" data-bs-target="#roleModal" class="btn btn-nav-primary">Join</a>
                    </div>
                </div>
                <!-- Main Menu End -->
            </div>
        </nav>
    </div>
</header>

<style>
    :root {
        --brand-teal: #00697E;
        --brand-teal-dark: #004E5F;
        --brand-teal-light: #0C8AA3;
        --brand-teal-50: rgba(0, 105, 126, 0.08);
        --brand-white: #ffffff;
        --header-radius: 0.85rem;
    }

    /* ============ HEADER SHELL ============ */
    .main-header {
        background: linear-gradient(180deg, var(--brand-teal-dark) 0%, var(--brand-teal) 100%);
    }

    .header-sticky {
        position: sticky;
        top: 0;
        z-index: 1030;
        background: rgba(0, 78, 95, 0.72);
        backdrop-filter: blur(14px) saturate(160%);
        -webkit-backdrop-filter: blur(14px) saturate(160%);
        box-shadow: 0 8px 24px rgba(0, 20, 25, 0.18);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .navbar {
        padding-top: 0.7rem;
        padding-bottom: 0.7rem;
    }

    /* ============ LOGO ============ */
    .site-logo {
        height: 2.5rem;
        width: auto;
        max-width: 100%;
    }

    @media (min-width: 576px) { .site-logo { height: 2.9rem; } }
    @media (min-width: 992px) { .site-logo { height: 3.5rem; } }

    /* ============ NAV LINKS ============ */
    #menu .nav-link {
        color: var(--brand-white);
        font-weight: 500;
        font-size: 0.94rem;
        letter-spacing: 0.01em;
        padding: 0.65rem 1rem;
        border-radius: 999px;
        display: flex;
        align-items: center;
        gap: 0.35rem;
        opacity: 0.88;
        transition: opacity 0.15s ease, background-color 0.15s ease, color 0.15s ease;
    }

    #menu .nav-link:hover,
    #menu .nav-link:focus {
        opacity: 1;
        background-color: rgba(255, 255, 255, 0.1);
    }

    #menu .nav-item.active > .nav-link {
        opacity: 1;
        font-weight: 700;
        background-color: rgba(255, 255, 255, 0.14);
    }

    .submenu-caret {
        font-size: 0.6rem;
        transition: transform 0.2s ease;
    }

    /* ============ CUSTOM TOGGLE BUTTON (Mobile) ============ */
    .navbar-toggler {
        border: 1px solid rgba(255, 255, 255, 0.45);
        padding: 0.45rem 0.6rem;
        border-radius: 0.5rem;
        background: transparent;
        display: flex;
        flex-direction: column;
        gap: 4px;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 34px;
        transition: background 0.2s ease;
    }

    .navbar-toggler:hover {
        background: rgba(255, 255, 255, 0.08);
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        outline: none;
    }

    .toggler-bar {
        display: block;
        width: 20px;
        height: 2px;
        background: var(--brand-white);
        border-radius: 2px;
        transition: transform 0.3s ease, opacity 0.3s ease, width 0.3s ease;
    }

    .navbar-toggler[aria-expanded="true"] .toggler-bar:nth-child(1) {
        transform: translateY(6px) rotate(45deg);
    }

    .navbar-toggler[aria-expanded="true"] .toggler-bar:nth-child(2) {
        opacity: 0;
        width: 0;
    }

    .navbar-toggler[aria-expanded="true"] .toggler-bar:nth-child(3) {
        transform: translateY(-6px) rotate(-45deg);
    }

    /* ============ DESKTOP DROPDOWNS ============ */
    @media (min-width: 992px) {
        .nav-item.submenu { position: relative; }

        .submenu-panel {
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: opacity 0.18s ease, transform 0.18s ease, visibility 0.18s ease;
            position: absolute;
            top: calc(100% + 0.65rem);
            left: 0;
            z-index: 1040;
        }

        .nav-item.submenu:hover .submenu-panel,
        .nav-item.submenu:focus-within .submenu-panel {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .nav-item.submenu:hover .submenu-caret {
            transform: rotate(180deg);
        }

        /* Simple dropdown */
        .submenu-panel--simple {
            list-style: none;
            margin: 0;
            padding: 0.5rem;
            min-width: 230px;
            background: var(--brand-white);
            border-radius: var(--header-radius);
            box-shadow: 0 18px 40px rgba(0, 20, 25, 0.2);
        }

        .submenu-panel--simple .nav-link {
            color: var(--brand-teal-dark) !important;
            opacity: 1;
            padding: 0.6rem 0.75rem;
            border-radius: 0.6rem;
            font-size: 0.9rem;
            font-weight: 500;
            gap: 0.6rem;
        }

        .submenu-panel--simple .nav-link i {
            color: var(--brand-teal);
            font-size: 0.95rem;
            width: 1.1rem;
        }

        .submenu-panel--simple .nav-link:hover {
            background: var(--brand-teal-50);
        }

        /* Mega menu */
        .submenu-panel--mega {
            display: flex;
            gap: 0;
            min-width: 480px;
            padding: 0.9rem;
            background: var(--brand-white);
            border-radius: var(--header-radius);
            box-shadow: 0 18px 40px rgba(0, 20, 25, 0.2);
        }

        .mega-col {
            flex: 1;
            padding: 0.25rem 0.9rem;
        }

        .mega-col--divide {
            border-left: 1px solid #ecebe9;
        }

        .mega-col-title {
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.06em;
            color: #9aa3a6;
            margin: 0 0 0.55rem 0.15rem;
        }

        .mega-link {
            display: flex;
            align-items: flex-start;
            gap: 0.7rem;
            padding: 0.5rem 0.5rem;
            border-radius: 0.65rem;
            text-decoration: none;
            transition: background-color 0.15s ease;
        }

        .mega-link:hover {
            background: var(--brand-teal-50);
        }

        .mega-icon {
            flex: 0 0 auto;
            width: 34px;
            height: 34px;
            border-radius: 0.55rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--brand-teal-50);
            color: var(--brand-teal);
            font-size: 0.95rem;
        }

        .mega-link-title {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            color: #1c2b2f;
        }

        .mega-link-desc {
            display: block;
            font-size: 0.76rem;
            color: #8a9396;
            margin-top: 0.1rem;
        }

        /* Desktop: hide mobile-only elements */
        .nav-item.d-lg-none { display: none !important; }
        .header-btn.d-none.d-lg-flex { display: flex !important; }
    }

    /* ============ MOBILE MENU ============ */
    @media (max-width: 991.98px) {

        /* ---- Menu panel ---- */
        .main-menu {
            background: var(--brand-teal-dark);
            border-radius: var(--header-radius);
            padding: 0.85rem 1rem 1.1rem;
            margin-top: 0.65rem;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Fix: allow overflow for submenu expansion inside collapse */
        .main-menu.collapsing,
        .main-menu.collapse.show {
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .nav-menu-wrapper { width: 100%; }

        #menu { width: 100%; }

        #menu .nav-item {
            width: 100%;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        #menu .nav-item:last-of-type { border-bottom: none; }

        .submenu-toggle {
            justify-content: space-between;
            width: 100%;
        }

        /* ---- Submenu panels: accordion ---- */
        .submenu-panel,
        .submenu-panel--mega {
            display: none;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .nav-item.submenu.open > .submenu-panel,
        .nav-item.submenu.open > .submenu-panel--mega {
            display: block;
        }

        .nav-item.submenu.open .submenu-caret {
            transform: rotate(180deg);
        }

        /* ---- Simple dropdown links (mobile) ---- */
        .submenu-panel--simple .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            opacity: 1;
            padding: 0.55rem 0.9rem 0.55rem 1.6rem;
            border-radius: 0.5rem;
            font-size: 0.88rem;
            font-weight: 400;
            gap: 0.55rem;
        }

        .submenu-panel--simple .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            opacity: 1;
        }

        .submenu-panel--simple .nav-link i {
            font-size: 0.85rem;
            color: var(--brand-teal-light);
        }

        /* ---- Mega menu (mobile) ---- */
        .submenu-panel--mega {
            padding: 0.5rem 0 0.25rem 0;
        }

        .mega-col {
            padding: 0 0.5rem;
        }

        .mega-col--divide {
            border-left: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 0.4rem;
            padding-top: 0.4rem;
        }

        .mega-col-title {
            text-transform: uppercase;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.06em;
            color: rgba(255, 255, 255, 0.5);
            margin: 0.5rem 0.9rem 0.2rem;
            padding: 0;
        }

        .mega-link {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            padding: 0.5rem 0.9rem;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: background 0.15s ease;
        }

        .mega-link:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .mega-icon {
            width: 30px;
            height: 30px;
            border-radius: 0.45rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(12, 138, 163, 0.15);
            color: var(--brand-teal-light);
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .mega-link-title {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--brand-white);
        }

        .mega-link-desc {
            display: block;
            font-size: 0.72rem;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 0.05rem;
        }

        /* ---- Mobile buttons ---- */
        .header-btn.d-none.d-lg-flex { display: none !important; }
        .nav-item.d-lg-none { display: block !important; }

        .btn-nav-primary,
        .btn-nav-secondary {
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 999px;
            padding: 0.6rem 1.4rem;
            transition: transform 0.15s ease, background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
            white-space: nowrap;
        }

        .btn-nav-primary {
            background: var(--brand-white);
            color: var(--brand-teal) !important;
            border: 1px solid var(--brand-white);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .btn-nav-primary:hover,
        .btn-nav-primary:focus {
            background: transparent;
            color: var(--brand-white) !important;
            border-color: var(--brand-white);
            transform: translateY(-1px);
        }

        .btn-nav-secondary {
            background: transparent;
            color: var(--brand-white) !important;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .btn-nav-secondary:hover,
        .btn-nav-secondary:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.7);
            transform: translateY(-1px);
        }
    }

    /* ============ DESKTOP BUTTONS (shared) ============ */
    @media (min-width: 992px) {
        .btn-nav-primary,
        .btn-nav-secondary {
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 999px;
            padding: 0.6rem 1.4rem;
            transition: transform 0.15s ease, background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
            white-space: nowrap;
        }

        .btn-nav-primary {
            background: var(--brand-white);
            color: var(--brand-teal) !important;
            border: 1px solid var(--brand-white);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .btn-nav-primary:hover,
        .btn-nav-primary:focus {
            background: transparent;
            color: var(--brand-white) !important;
            border-color: var(--brand-white);
            transform: translateY(-1px);
        }

        .btn-nav-secondary {
            background: transparent;
            color: var(--brand-white) !important;
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .btn-nav-secondary:hover,
        .btn-nav-secondary:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.7);
            transform: translateY(-1px);
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var toggler  = document.getElementById('navToggler');
    var navbar   = document.getElementById('mainNavbar');
    var bsCollapse = null;

    /* Initialise Bootstrap collapse once the DOM is ready */
    if (navbar) {
        bsCollapse = new bootstrap.Collapse(navbar, { toggle: false });
    }

    /* ---- Hamburger toggle ---- */
    if (toggler) {
        toggler.addEventListener('click', function () {
            var isExpanded = toggler.getAttribute('aria-expanded') === 'true';
            toggler.setAttribute('aria-expanded', String(!isExpanded));

            if (bsCollapse) {
                bsCollapse.toggle();
            }
        });
    }

    /* ---- Submenu accordion (mobile only) ---- */
    document.querySelectorAll('.submenu-toggle').forEach(function (toggle) {
        toggle.addEventListener('click', function (e) {
            if (window.innerWidth >= 992) return;   // desktop uses hover
            e.preventDefault();
            e.stopPropagation();                    // don't bubble to hamburger

            var parent  = toggle.closest('.nav-item.submenu');
            var isOpen  = parent.classList.contains('open');

            // Close every other open submenu (accordion behaviour)
            document.querySelectorAll('.nav-item.submenu.open').forEach(function (item) {
                if (item !== parent) item.classList.remove('open');
            });

            parent.classList.toggle('open', !isOpen);

            // Scroll the newly opened submenu into view inside the menu panel
            if (!isOpen) {
                setTimeout(function () {
                    var panel = parent.querySelector('.submenu-panel, .submenu-panel--mega');
                    if (panel) {
                        panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                }, 50);
            }
        });
    });

    /* ---- Close entire mobile menu when a NON-dropdown link is tapped ---- */
    document.querySelectorAll('#menu > .nav-item:not(.submenu) > .nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth < 992 && bsCollapse) {
                bsCollapse.hide();
                toggler.setAttribute('aria-expanded', 'false');
            }
        });
    });

    /* ---- Close mobile menu when a link INSIDE a submenu is tapped ---- */
    document.querySelectorAll('.submenu-panel .nav-link, .submenu-panel--mega .mega-link').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth < 992 && bsCollapse) {
                // Let the link navigate first, then close the menu
                setTimeout(function () {
                    bsCollapse.hide();
                    toggler.setAttribute('aria-expanded', 'false');
                    // Also close the submenu accordion
                    document.querySelectorAll('.nav-item.submenu.open').forEach(function (item) {
                        item.classList.remove('open');
                    });
                }, 150);
            }
        });
    });

    /* ---- Auto-close menu on resize to desktop ---- */
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) {
            document.querySelectorAll('.nav-item.submenu.open').forEach(function (item) {
                item.classList.remove('open');
            });
            if (navbar.classList.contains('show') && bsCollapse) {
                bsCollapse.hide();
                toggler.setAttribute('aria-expanded', 'false');
            }
        }
    });

    /* ---- Close menu when clicking outside (mobile) ---- */
    document.addEventListener('click', function (e) {
        if (window.innerWidth >= 992) return;
        var isInsideMenu = navbar.contains(e.target) || toggler.contains(e.target);
        if (!isInsideMenu && navbar.classList.contains('show') && bsCollapse) {
            bsCollapse.hide();
            toggler.setAttribute('aria-expanded', 'false');
            document.querySelectorAll('.nav-item.submenu.open').forEach(function (item) {
                item.classList.remove('open');
            });
        }
    });
});
</script>

<!-- Role Selection Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 560px;">
        <div class="modal-content border-0 rounded-4 shadow-lg">

            <div class="modal-header border-0 px-4 pt-4 pb-0 align-items-start">
                <div>
                    <p class="role-modal-eyebrow mb-1">Research Portal</p>
                    <h4 class="fw-semibold mb-1" id="roleModalLabel">How will you contribute?</h4>
                    <p class="text-muted mb-0" style="font-size: 14px;">Select your role to get started</p>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-4 pb-4 pt-3">
                <div class="row g-3 mb-3">

                    <div class="col-12 col-sm-6">
                        <div class="role-card p-3 rounded-3 h-100 border"
                            id="card-mentee"
                            data-role="mentee"
                            role="button"
                            tabindex="0"
                            onclick="selectRole('mentee')"
                            onkeypress="if(event.key==='Enter'){selectRole('mentee')}">
                            <div class="role-icon role-icon--mentee mb-3 d-flex align-items-center justify-content-center rounded-3">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                            <p class="fw-semibold mb-1" style="font-size:15px;">Join as Mentee</p>
                            <p class="text-muted mb-3" style="font-size:12px;line-height:1.5;">
                                Explore research, get guidance and grow faster with expert support.
                            </p>
                            <span class="role-badge role-badge--mentee">Get mentored</span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="role-card p-3 rounded-3 h-100 border"
                            id="card-mentor"
                            data-role="mentor"
                            role="button"
                            tabindex="0"
                            onclick="selectRole('mentor')"
                            onkeypress="if(event.key==='Enter'){selectRole('mentor')}">
                            <div class="role-icon role-icon--mentor mb-3 d-flex align-items-center justify-content-center rounded-3">
                                <i class="bi bi-person-check-fill"></i>
                            </div>
                            <p class="fw-semibold mb-1" style="font-size:15px;">Join as Mentor</p>
                            <p class="text-muted mb-3" style="font-size:12px;line-height:1.5;">
                                Share expertise, guide researchers and shape the next generation.
                            </p>
                            <span class="role-badge role-badge--mentor">Become a guide</span>
                        </div>
                    </div>
                </div>

                <div id="continueWrapper" class="mb-3" style="display:none;">
                    <a id="continueBtn" href="#" class="btn w-100 py-2 fw-semibold text-white rounded-3 continue-btn">
                        Continue
                    </a>
                </div>

                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                    <p class="text-muted mb-0" style="font-size:13px;">Already have an account?</p>
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary rounded-3 px-3" style="font-size:13px;">
                        Sign in
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .role-modal-eyebrow {
        text-transform: uppercase;
        font-weight: 600;
        font-size: 11px;
        letter-spacing: 0.08em;
        color: var(--brand-teal);
    }

    .role-card {
        cursor: pointer;
        transition: border-color 0.15s ease, background 0.15s ease, box-shadow 0.15s ease;
        border-color: #dee2e6 !important;
    }

    .role-card:hover {
        background: #f8f9fa;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .role-card.selected-mentee {
        border: 2px solid #1D9E75 !important;
        background: rgba(225, 245, 238, 0.3) !important;
    }

    .role-card.selected-mentor {
        border: 2px solid #185FA5 !important;
        background: rgba(230, 241, 251, 0.3) !important;
    }

    .role-icon {
        width: 42px;
        height: 42px;
        font-size: 18px;
    }

    .role-icon--mentee { background: #E1F5EE; color: #0F6E56; }
    .role-icon--mentor { background: #E6F1FB; color: #185FA5; }

    .role-badge {
        display: inline-block;
        border-radius: 999px;
        padding: 0.35rem 0.75rem;
        font-size: 11px;
        font-weight: 600;
    }

    .role-badge--mentee { background: #E1F5EE; color: #0F6E56; }
    .role-badge--mentor { background: #E6F1FB; color: #185FA5; }

    .continue-btn { background-color: var(--brand-teal); }
    .continue-btn:hover { background-color: var(--brand-teal-dark); color: var(--brand-white); }
</style>

<script>
    function selectRole(role) {
        document.getElementById('card-mentee').className = 'role-card p-3 rounded-3 h-100 border';
        document.getElementById('card-mentor').className = 'role-card p-3 rounded-3 h-100 border';
        document.getElementById('card-' + role).classList.add('selected-' + role);

        var btn     = document.getElementById('continueBtn');
        var wrapper = document.getElementById('continueWrapper');
        var routeBase = "{{ url('/onboarding') }}";

        btn.href = routeBase + '?role=' + role;
        btn.style.background = role === 'mentee' ? '#0F6E56' : '#185FA5';
        wrapper.style.display = 'block';
    }
</script>

<!-- Membership Modal -->
<div class="modal fade" id="membershipModal" tabindex="-1" aria-labelledby="membershipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">

            <div class="modal-header border-0 px-4 pt-4 pb-0">
                <h5 class="modal-title" id="membershipModalLabel">Membership Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('membership.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Membership Type *</label>
                            <select name="type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="individual">Individual</option>
                                <option value="trainer">Trainer</option>
                                <option value="institutional">Institutional</option>
                                <option value="corporate">Corporate</option>
                                <option value="honorary">Honorary</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Organization (if applicable)</label>
                            <input type="text" name="organization" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Why do you want to join?</label>
                            <textarea name="motivation" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background-color: var(--brand-teal); border-color: var(--brand-teal);">Submit Application</button>
                </div>
            </form>
        </div>
    </div>
</div>