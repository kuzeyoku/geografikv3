@extends(themeView('admin', 'layout.main'))
@section('pageTitle', __("admin/{$folder}.list"))
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>@lang("admin/{$folder}.title")</h4>
                    <h6>@lang("admin/{$folder}.description")</h6>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="alert alert-danger text-center">@lang("admin/{$folder}.delete_alert")</div>
                <div class="row">
                    @forelse ($items as $item)
                        <div class="col-lg-2">
                            <div class="card">
                                <div class="card-body">
                                    <img class="card-img" style="height: 200px" src="{{ $item->getUrl() }}">
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    {{ $item->file_name }}
                                    {{ html()->form('DELETE')->route("admin.{$route}.destroy", $item)->open() }}
                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger confirm-btn">
                                        @lang('admin/general.delete')</a>
                                    {{ html()->form()->close() }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <div class="alert alert-info">@lang("admin/{$folder}.empty")</div>
                        </div>
                    @endforelse
                </div>
                {{ $items->links(themeView('admin', 'layout.pagination')) }}
            </div>
        </div>
    </div>
@endsection
