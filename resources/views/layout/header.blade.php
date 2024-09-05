<header>
    <div class="header__top d-none d-md-block">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-9">
                    <div class="grb__cta header-cta">
                        <ul>
                            <li>
                                <div class="cta__icon">
                                    <span><i class="fas fa-phone-alt"></i></span>
                                </div>
                                <div class="cta__content">
                                    <p>Call Us:</p>
                                    <span>
                                        <a href="tel:{{ config('contact.phone') }}">{{ config('contact.phone') }}</a>
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="cta__icon">
                                    <span><i class="fas fa-envelope"></i></span>
                                </div>
                                <div class="cta__content">
                                    <p>Mail Us:</p>
                                    <span>
                                        <a href="mailto:{{ config('contact.email', '') }}">
                                            <span>{{ config('contact.email', '') }}</span>
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
                            @foreach (config('social', []) as $key => $value)
                                @if (config("social.{$key}"))
                                    <li>
                                        <a href="{{ config("social.{$key}") }}">
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
                            <img src="{{ themeAsset('front', 'img/logo/logo.png') }}" alt="">
                        </a>
                        <a class="logo-text-black" href="{{ route('home') }}">
                            <img src="{{ $themeAsset->logo_dark }}" alt="">
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
                            <a class="search-btn nav-search search-trigger d-none d-sm-inline-block" href="#">
                                <i class="fal fa-search"></i>
                            </a>
                            <a class="side-toggle d-lg-none" href="javascript:void(0)">
                                <i class="fal fa-bars"></i>
                            </a>
                        </div>
                        <div class="header__btn d-none d-xl-inline-block">
                            <a href="{{ route('contact.index') }}" class="grb-btn">
                                Get Reserved<i class="fas fa-arrow-right"></i>
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
            <div class="offset-widget offset-logo mb-30 pb-20">
                <div class="row align-items-center">
                    <div class="col-9"><a href="{{ route('home') }}"><img src="{{ $themeAsset->logo_dark }}"
                                alt="Logo"></a>
                    </div>
                    <div class="col-3 text-end"><button class="side-info-close"><i class="fal fa-times"></i></button>
                    </div>
                </div>
            </div>
            <div class="mobile-menu"></div>
            <div class="contact-infos mt-30 mb-30">
                <div class="contact-list mb-30">
                    <h4>İletişim Bilgilerimiz</h4>
                    <a href="#" class="">
                        <i class="fal fa-map-marker-alt"></i>
                        <span>{{ config('contact.address') }}</span>
                    </a>
                    <a href="tel:{{ config('contact.phone') }}" class="">
                        <i class="fal fa-phone"></i>
                        <span>{{ config('contact.phone') }}</span>
                    </a>
                    <a href="mailto:{{ config('contact.email') }}" class="">
                        <i class="far fa-envelope"></i>
                        <span>{{ config('contact.email') }}</span>
                    </a>
                </div>
                <div class="grb__social footer-social offset-social">
                    <ul>
                        @foreach (config('social', []) as $social)
                            <li>
                                <a href="{{ config('social.' . $social) }}">
                                    <i class="fab fa-{{ $social }}"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas-overlay"></div>
<div class="search-wrap">
    <div class="search-inner">
        <i class="fal fa-times search-close" id="search-close"></i>
        <div class="search-cell">
            <form method="get">
                <div class="search-field-holder">
                    <input type="search" class="main-search-input" placeholder="Search Your Keyword...">
                </div>
            </form>
        </div>
    </div>
</div>
