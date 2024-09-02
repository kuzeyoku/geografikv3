<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ __('errors.404.title') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ themeAsset('admin', 'img/favicon.png') }}">
    <link rel="stylesheet" href="{{ themeAsset('admin', 'css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('admin', 'css/style.css') }}">
</head>

<body class="error-page">
    <div class="main-wrapper">
        <div class="error-box">
            <h1>404</h1>
            <h3 class="h2 mb-3"><i class="fas fa-exclamation-circle"></i> {{ __('errors.404.warning') }}</h3>
            <p class="h4 font-weight-normal">{{ __('errors.404.message') }}</p>
            <a href="{{ url('/') }}" class="btn btn-primary">{{ __('errors.404.button') }}</a>
        </div>
    </div>
    <script src="{{ themeAsset('admin', 'js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ themeAsset('admin', 'js/feather.min.js') }}"></script>
    <script src="{{ themeAsset('admin', 'js/script.js') }}"></script>
</body>

</html>
