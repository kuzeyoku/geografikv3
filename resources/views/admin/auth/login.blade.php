<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="robots" content="noindex, nofollow">
    <title>@lang("admin/{$folder}.login_title")</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ themeAsset('admin', 'img/favicon.png') }}">
    <link rel="stylesheet" href="{{ themeAsset('admin', 'css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ themeAsset('admin', 'css/style.css') }}">
</head>

<body class="account-page">
<div id="global-loader">
    <div class="whirly-loader"></div>
</div>
<div class="main-wrapper">
    <div class="account-content">
        <div class="login-wrapper bg-img">
            <div class="login-content">
                {{ html()->form()->route("admin.{$route}.authenticate")->id('login-form')->open() }}
                <div class="login-userset">
                    <div class="login-logo logo-normal">
                        <img src="{{ themeAsset('admin', 'img/logo.png') }}" alt="img">
                    </div>
                    <a href="{{ route('admin.index') }}" class="login-logo logo-white">
                        <img src="{{ themeAsset('admin', 'img/logo-white.png') }}" alt="">
                    </a>
                    <div class="login-userheading">
                        <h3>@lang("admin/{$folder}.welcome")</h3>
                        <h4>@lang("admin/{$folder}.please_login")</h4>
                    </div>
                    <div class="form-login">
                        {{ html()->label(__("admin/{$folder}.email")) }}
                        <div class="form-addons">
                            {{ html()->email('email')->class('form-control mb-0')->placeholder(__("admin/{$folder}.email_placeholder")) }}
                            <img src="{{ themeAsset('admin', 'img/icons/mail.svg') }}" alt="img">
                        </div>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-login">
                        {{ html()->label(__("admin/{$folder}.password")) }}
                        <div class="pass-group">
                            {{ html()->password('password')->class('form-control pass-input mb-0')->placeholder(__("admin/{$folder}.password_placeholder")) }}
                            @svg('fas-eye-slash', 'fas toggle-password' )
                        </div>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-login authentication-check">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="custom-control custom-checkbox">
                                <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                    <input type="checkbox" class="form-control">
                                    <span class="checkmarks"></span>@lang("admin/{$folder}.remember_me")
                                </label>
                            </div>
                            <div class="text-end">
                                <a class="forgot-link"
                                   href="{{ route("admin.{$route}.forgot_password") }}">@lang("admin/{$folder}.forgot_password")</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-login">
                        {{ html()->submit(__('admin/auth.login'))->class('btn btn-login g-recaptcha')->data("sitekey",setting("integration","recaptcha_site_key"))->data("callback","onSubmit")->data("action","submit") }}
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
<script src="{{ themeAsset('admin', 'js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ themeAsset('common', 'js/sweetalert.js') }}"></script>
@include(themeView('admin', 'layout.alert'))
<script src="{{ themeAsset('admin', 'js/script.js') }}"></script>
@if (setting('integration','recaptcha_status') == App\Enums\StatusEnum::Active->value)
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            const form = document.getElementById("login-form");
            if (form.checkValidity()) {
                form.submit();
            } else {
                form.reportValidity();
            }
        }
    </script>
@endif
</body>

</html>
