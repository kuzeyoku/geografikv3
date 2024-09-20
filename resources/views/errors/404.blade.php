<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ __('errors.404.title') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{themeAsset("front","img/favicon.png")}}">
    <link rel="stylesheet" href="{{themeAsset("admin","css/style.css")}}">
</head>
<body class="error-page">
<div id="global-loader">
    <div class="whirly-loader"></div>
</div>

<div class="main-wrapper">
    <div class="error-box">
        <div class="error-img">
            <img src="{{themeAsset("admin","img/authentication/error-404.png")}}" class="img-fluid" alt>
        </div>
        <h3 class="h2 mb-3">{{ __('errors.404.warning') }}</h3>
        <p>{{ __('errors.404.message') }}</p>
        <a href="index.html" class="btn btn-primary">{{ __('errors.404.button') }}</a>
    </div>
</div>

<div class="customizer-links" id="setdata">
    <ul class="sticky-sidebar">
        <li class="sidebar-icons">
            <a href="#" class="navigation-add" data-bs-toggle="tooltip" data-bs-placement="left"
               data-bs-original-title="Theme">
                <i data-feather="settings" class="feather-five"></i>
            </a>
        </li>
    </ul>
</div>

<script src="{{themeAsset("admin","js/jquery-3.7.1.min.js")}}"></script>
<script src="{{themeAsset("admin","js/feather.min.js")}}"></script>
<script src="{{themeAsset("admin","js/script.js")}}"></script>
</body>
</html>
