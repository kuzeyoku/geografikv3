<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Growbiz HTML5 Digital Agency</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="{{ themeAsset('front', 'css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('front', 'css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('front', 'css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('front', 'css/custom-animation.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('front', 'css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('front', 'css/odometer-theme-default.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('front', 'css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('front', 'css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('front', 'css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('front', 'css/main.css') }}">
    @stack('style')
</head>

<body>
    @include('layout.header')
    <main>
        @yield('content')
    </main>
    @include('layout.footer')
    <script src="{{ themeAsset('front', 'js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/swiper-bundle.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/ajax-form.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/wow.min.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/odometer.min.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/appair.min.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/plugins.js') }}"></script>
    <script src="{{ themeAsset('front', 'js/main.js') }}"></script>
</body>

</html>
