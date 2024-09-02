<li class="{{ $menu->subMenu->isNotEmpty() ? 'dropdown' : '' }}">
    <a href="{{ $menu->url ?? '#' }}">{{ $menu->title }}@svg('fas-chevron-down')</a>
    <ul>
        @foreach ($menu->subMenu as $subMenu)
            @if ($subMenu->subMenu->isNotEmpty())
                @include('layout.menu', ['menu' => $subMenu])
            @else
                <li><a href="{{ $subMenu->url }}">{{ $subMenu->title }}</a></li>
            @endif
        @endforeach
    </ul>
</li>
