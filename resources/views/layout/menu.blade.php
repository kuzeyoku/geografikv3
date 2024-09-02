<li class="{{ $menu->subMenu->isNotEmpty() ? 'menu-item-has-children' : '' }}">
    <a href="{{ $menu->url ?? '#' }}">{{ $menu->title }}</a>
    <ul class="sub-menu">
        @foreach ($menu->subMenu as $subMenu)
            @if ($subMenu->subMenu->isNotEmpty())
                @include('layout.menu', ['menu' => $subMenu])
            @else
                <li><a href="{{ $subMenu->url }}">{{ $subMenu->title }}</a></li>
            @endif
        @endforeach
    </ul>
</li>
