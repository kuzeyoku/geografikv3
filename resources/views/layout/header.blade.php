<header>
    <div class="header__top d-none d-md-block">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-9">
                    <div class="grb__cta header-cta">
                        <ul>
                            <li>
                                <div class="cta__content">
                                    @include('common.language_selector')
                                </div>
                            </li>
                            <li>
                                <div class="cta__icon">
                                    <span><i class="fas fa-phone-alt"></i></span>
                                </div>
                                <div class="cta__content">
                                    <p>@lang('front/header.txt1')</p>
                                    <span>
                                        <a href="tel:@setting('contact','phone')">@setting("contact","phone")</a>
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="cta__icon">
                                    <span><i class="fas fa-envelope"></i></span>
                                </div>
                                <div class="cta__content">
                                    <p>@lang('front/header.txt2')</p>
                                    <span>
                                        <a href="mailto:@setting('contact','email')">
                                            <span>@setting("contact","email")</span>
                                        </a>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="grb__social f-right st-1">
                        <ul>
                            @foreach (setting("social") as $key => $value)
                                @if (setting("social",$key))
                                    <li>
                                        <a href="{{setting("social",$key)}}">
                                            <i class="fab fa-{{ $key }}"></i>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header__main header-sticky header-main-1">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-8">
                    <div class="logo">
                        <div class="logo-bg-1">
                            <img src="{{ themeAsset('front', 'img/shape/logo-bg-1.png') }}" alt="">
                        </div>
                        <a class="logo-text-white" href="{{ route('home') }}">
                            <img src="{{ themeAsset('front', 'img/logo/logo.png') }}" alt="@setting('general','title')">
                        </a>
                        <a class="logo-text-black" href="{{ route('home') }}">
                            <img src="@setting('asset','logo_dark')" alt="@setting('general','title')">
                        </a>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-9 col-4">
                    <div class="header__menu-area f-right">
                        <div class="menu-bg-1">
                            <img src="{{ themeAsset('front', 'img/shape/menu-bg-1.png') }}" alt="">
                        </div>
                        <div class="main-menu main-menu-1">
                            <nav id="mobile-menu">
                                <ul>
                                    @foreach ($menu as $menu)
                                        @if ($menu->parent_id === 0)
                                            @if ($menu->subMenu->isNotEmpty())
                                                @include('layout.menu', ['menu' => $menu])
                                            @else
                                                <li>
                                                    <a href="{{ $menu->url }}">{{ $menu->title }}</a>
                                                </li>
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                        <div class="header__search">
                            <a class="side-toggle d-lg-none" href="javascript:void(0)">
                                <i class="fal fa-bars"></i>
                            </a>
                        </div>
                        <div class="header__btn d-none d-xl-inline-block">
                            <a href="{{ route('contact.index') }}" class="grb-btn">
                                @lang('front/header.txt3')<i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="fix">
    <div class="side-info">
        <div class="side-info-content">
            <div class="offset-widget offset-logo">
                <div class="row align-items-center">
                    <div class="col-9">
                        <a href="{{ route('home') }}">
                            <img src="@setting('asset','logo_light')" alt="@setting('general','title')">
                        </a>
                    </div>
                    <div class="col-3 text-end">
                        <button class="side-info-close">
                            <i class="fal fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="mobile-menu"></div>
            <div class="contact-infos mt-30 mb-30">
                <div class="contact-list mb-30">
                    <h4>@lang('front/header.txt4')</h4>
                    <a href="#" class="">
                        <i class="fal fa-map-marker-alt"></i>
                        <span>@setting('contact','address')</span>
                    </a>
                    <a href="tel:@setting('contact','phone')" class="">
                        <i class="fal fa-phone"></i>
                        <span>@setting('contact','phone')</span>
                    </a>
                    <a href="mailto:@setting('contact','email')" class="">
                        <i class="far fa-envelope"></i>
                        <span>@setting('contact','email')</span>
                    </a>
                </div>
                <div class="grb__social footer-social offset-social">
                    <ul>
                        @foreach (setting("social") as $key => $value)
                            @if (setting("social",$key))
                                <li>
                                    <a href="{{setting("social",$key)}}">
                                        <i class="fab fa-{{ $key }}"></i>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas-overlay"></div>
