@extends(themeView('admin', 'layout.main'))
@section('content')
    <div class="content mb-4">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>@lang("admin/{$folder}.title")</h4>
                    <h6>@lang("admin/{$folder}.description")</h6>
                </div>
            </div>
        </div>
        {{ html()->form('PUT', route('admin.setting.update'))->acceptsFiles()->open() }}
        {{ html()->hidden('category', request()->category) }}
        <div class="card">
            <div class="card-header">
                <h4>@lang("admin/{$folder}.category_" . request()->category)</h4>
            </div>
            <div class="card-body">
                @yield('setting_form')
            </div>
        </div>
        {{ html()->submit(__('admin/general.save'))->class('btn btn-submit') }}
        {{ html()->form()->close() }}
    </div>
@endsection

