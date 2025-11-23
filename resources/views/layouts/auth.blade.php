<!DOCTYPE html>
<html lang="zxx" class="js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}">
    <title>@yield('title') | Dashboard</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dashlitee1e3.css?ver=3.2.4') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin/assets/css/themee1e3.css?ver=3.2.4') }}">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-91615293-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-91615293-4');
    </script>
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="#" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="{{ asset('admin/images/logo.png') }}" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('admin/images/logo-dark.png') }}" alt="logo-dark">
                            </a>
                        </div>

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets/js/bundlee1e3.js?ver=3.2.4') }}"></script>
    <script src="{{ asset('admin/assets/js/scriptse1e3.js?ver=3.2.4') }}"></script>
    <script src="{{ asset('admin/assets/js/demo-settingse1e3.js?ver=3.2.4') }}"></script>
</body>

</html>