@extends(themeView('admin', 'layout.main'))
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        {{ $menu ? __("admin/{$folder}.edit") : __("admin/{$folder}.create") }}
                    </div>
                    <div class="card-body">
                        @include(themeView('admin', 'layout.langtab'))
                        @empty($menu)
                            @include(themeView('admin', "{$folder}.create_form"))
                        @else
                            @include(themeView('admin', "{$folder}.edit_form"))
                        @endempty
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        {{ __("admin/{$folder}.content") }}
                    </div>
                    <div class="card-body">
                        <div class="menu">
                            <ul>
                                @forelse ($menus as $menu)
                                    @if ($menu->parent_id == 0)
                                        <li class="bg-primary d-flex flex-row justify-content-between">
                                            <span>{{ $menu->title }}</span>
                                            <div>
                                                <a href="{{ route("admin.{$folder}.edit", $menu) }}"
                                                    class="btn btn-sm btn-light">
                                                    {{ __('admin/general.edit') }}
                                                </a>
                                                {{ html()->form('DELETE')->route("admin.{$route}.destroy", $menu)->class('d-inline')->open() }}
                                                <a href="javascript:void(0);" class="btn btn-sm destroy-btn btn-danger">
                                                    {{ __('admin/general.delete') }}
                                                </a>
                                                {{ html()->form()->close() }}
                                            </div>
                                        </li>
                                        @if ($menu->subMenu)
                                            @include(themeView('admin', "{$folder}.subMenus"))
                                        @endif
                                    @endif
                                @empty
                                    <div class="alert alert-info">{{ __('admin/general.empty_table') }}</div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
