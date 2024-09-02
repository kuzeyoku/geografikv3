@extends(themeView('admin', 'layout.main'))
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>@lang("admin/{$folder}.title")</h4>
                    <h6>@lang("admin/{$folder}.description")</h6>
                </div>
            </div>
            <div class="page-btn">
                <a href="{{ route("admin.{$route}.create") }}" class="btn btn-added"><i data-feather="plus-circle"
                        class="me-2"></i>@lang("admin/{$folder}.create")</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @yield('table')
                </div>
                {{ $items->links(themeView('admin', 'layout.pagination')) }}
            </div>
        </div>
    </div>
@endsection
