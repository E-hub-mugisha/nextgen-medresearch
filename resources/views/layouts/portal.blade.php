<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Space — @yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @stack('styles')
</head>

<body>

    <div class="portal-layout">

        {{-- ── SIDEBAR ─────────────────────────────────────── --}}
        @include('portal.partials.sidebar')

        <div class="portal-main">

            {{-- ── TOPBAR ──────────────────────────────────── --}}
            @include('portal.partials.topbar')

            {{-- ── PAGE CONTENT ───────────────────────────── --}}
            <main class="portal-content">
                @yield('content')
            </main>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>

</html>