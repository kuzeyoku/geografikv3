<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="robots" content="noindex, nofollow">
    <title>@lang("admin/{$folder}.reset_password_title")</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ themeAsset('admin', 'img/favicon.png') }}">
    <link rel="stylesheet" href="{{ themeAsset('admin', 'css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('admin', 'plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('admin', 'plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('admin', 'css/style.css') }}">
</head>

<body class="account-page">
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper bg-img">
                <div class="login-content">
                    {{ html()->form()->route("admin.{$route}.reset_password")->id('reset-password-form')->open() }}
                    <div class="login-userset">
                        <div class="login-logo logo-normal">
                            <img src="{{ themeAsset('admin', 'img/logo.png') }}" alt="img">
                        </div>
                        <a href="{{ route('admin.index') }}" class="login-logo logo-white">
                            <img src="{{ themeAsset('admin', 'img/logo-white.png') }}" alt="">
                        </a>
                        <div class="login-userheading">
                            <h3>@lang("admin/{$folder}.reset_password")</h3>
                            <h4>@lang("admin/{$folder}.reset_password_description")</h4>
                        </div>
                        {{ html()->hidden('token', $token) }}
                        <div class="form-login">
                            {{ html()->label(__("admin/{$folder}.new_password")) }}
                            <div class="pass-group">
                                {{ html()->password('password')->class('pass-inputs form-control') }}
                                <span class="fas toggle-passwords fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login">
                            {{ html()->label(__("admin/{$folder}.new_password_confirmation")) }}
                            <div class="pass-group">
                                {{ html()->password('password_confirmation')->class('pass-inputa form-control') }}
                                <span class="fas toggle-passworda fa-eye-slash"></span>
                            </div>
                        </div>
                        <div class="form-login">
                            {{ html()->submit(__('admin/auth.confirm'))->class('btn btn-login g-recaptcha')->attributes([
                                    'data-sitekey' => config('setting.recaptcha.site_key'),
                                    'data-callback' => 'onSubmit',
                                    'data-action' => 'submit',
                                ]) }}
                        </div>
                        <div class="signinform text-center">
                            <h4>@lang("admin/{$folder}.or") <a href="{{ route("admin.{$route}.login") }}" class="hover-a">
                                    @lang("admin/{$folder}.login") </a></h4>
                        </div>
                        <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                            <p>@lang("admin/{$folder}.copyright", ['year' => date('Y')])</p>
                        </div>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ themeAsset('admin', 'js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ themeAsset('admin', 'js/feather.min.js') }}"></script>
    <script src="{{ themeAsset('admin', 'js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ themeAsset('admin', 'js/theme-script.js') }}"></script>
    <script src="{{ themeAsset('admin', 'plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
    @include(themeView('admin', 'layout.alert'))
    <script src="{{ themeAsset('admin', 'js/script.js') }}"></script>
    @if (config('setting.recaptcha.status') == App\Enums\StatusEnum::Active->value)
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script>
            function onSubmit(token) {
                document.getElementById("reset-password-form").submit();
            }
        </script>
    @endif
</body>

</html>
