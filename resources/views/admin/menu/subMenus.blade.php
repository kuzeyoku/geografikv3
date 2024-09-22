<ul class="submenu">
    @foreach ($menu->subMenu as $subMenu)
        <li class="d-flex flex-row justify-content-between align-center">
            <div>
                <a>{{ $subMenu->title }}</a>
            </div>
            <div>
                <a href="{{ route("admin.{$folder}.edit", $subMenu) }}" class="btn btn-sm btn-primary">
                    {{ __('admin/general.edit') }}
                </a>
                {{ html()->form('DELETE')->route("admin.{$route}.destroy", $subMenu)->class('d-inline')->open() }}
                <a href="javascript:void(0);" class="btn btn-sm btn-danger confirm-btn">
                    {{ __('admin/general.delete') }}
                </a>
                {{ html()->form()->close() }}
            </div>
        </li>
        @if ($subMenu->subMenu)
            @include(themeView('admin', "{$folder}.subMenus"), ['menu' => $subMenu])
        @endif
    @endforeach
</ul>
