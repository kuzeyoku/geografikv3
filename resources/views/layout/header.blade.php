<header class="main-header">
    <nav class="main-menu">
        <div class="main-menu__wrapper">
            <div class="main-menu__wrapper-inner">
                <div class="main-menu__left">
                    <div class="main-menu__logo">
                        <a href="{{ route('home') }}"><img width="150" src="{{ $themeAsset->logo_dark }}"
                                alt="{{ config('general.title') }}"></a>
                    </div>
                    <div class="main-menu__main-menu-box">
                        <a href="javascript:void();" class="mobile-nav__toggler">{{ svg('fas-bars') }}</a>
                        <ul class="main-menu__list">
                            @foreach ($menu as $menu)
                                @if ($menu->parent_id === 0)
                                    @if ($menu->subMenu->count() > 0)
                                        @include('layout.menu', ['menu' => $menu])
                                    @else
                                        <li class="{{ $menu->subMenu->count() > 0 ? 'dropdown' : '' }}">
                                            <a href="{{ $menu->url }}">{{ $menu->title }}</a>
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="stricky-header stricked-menu main-menu">
    <div class="sticky-header__content"></div>
</div>
