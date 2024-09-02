@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    <div class="row">
        @foreach ($service->getThemeAssets() as $key => $value)
            <div class="col-lg-3 mb-3">
                {{ html()->file($key)->class('dropify-image')->attribute('data-default-file', $themeAsset->{$key})->accept('.png, .jpg, .jpeg, .gif') }}
                <kbd>@lang('admin/setting.asset_usage', ['code' => '$themeAsset->' . $key])</kbd>
            </div>
        @endforeach
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{ themeAsset('admin', 'css/dropify.min.css') }}">
@endpush
@push('script')
    <script src="{{ themeAsset('admin', 'js/dropzone.min.js') }}"></script>
    <script src="{{ themeAsset('admin', 'js/dropify.min.js') }}"></script>
@endpush
