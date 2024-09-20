@extends(themeView('admin', 'layout.main'))
@push('style')
    <link rel="stylesheet" href="{{ themeAsset('admin', 'css/dropzone.min.css') }}" type="text/css" />
@endpush
@push('script')
    <script src="{{ themeAsset('admin', 'js/dropzone.js') }}"></script>
@endpush
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>@lang("admin/{$folder}.images")</h4>
                    <h6>@lang("admin/{$folder}.images_description")</h6>
                </div>
            </div>
            {{ html()->form('DELETE')->route("admin.{$route}.imageAllDelete", $item)->open() }}
            <a href="javascript:void(0);" class="btn btn-danger destroy-btn">{{ __('admin/general.all_delete') }}</a>
            {{ html()->form()->close() }}
        </div>
        <div class="card">
            <div class="card-body">
                {{ html()->form()->route("admin.{$route}.imageStore", $item)->class('dropzone mb-4')->acceptsFiles()->open() }}
                @yield('form')
                {{ html()->form()->close() }}
                <div class="row">
                    @foreach ($item->getMedia('images') as $image)
                        <div class="col-md-2">
                            <div class="p-2 border rounded position-relative mb-4">
                                <img src="{{ $image->getUrl() }}" class="img-fluid">
                                {{ html()->form('DELETE')->route("admin.{$route}.imageDelete", $image)->open() }}
                                <button type="button"
                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 destroy-btn">{{ __('admin/general.delete') }}</button>
                                {{ html()->form()->close() }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
