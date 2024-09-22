@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    <div class="row">
        <div class="col-lg-3 mb-3">
            <div class="alert alert-primary text-center">
                {{html()->label("Logo Beyaz")->class("d-block")}}
            </div>
            {{html()->file("logo_light")->class("dropify-image")->attribute("data-default-file", $settings["logo_light"] ?? null)->accept(".png, .jpg, .jpeg, .gif")}}
        </div>
        <div class="col-lg-3">
            <div class="alert alert-primary text-center">
                {{html()->label("Logo Siyah")->class("d-block")}}
            </div>
            {{html()->file("logo_dark")->class("dropify-image")->attribute("data-default-file", $settings["logo_dark"] ?? null)->accept(".png, .jpg, .jpeg, .gif")}}
        </div>
        <div class="col-lg-3">
            <div class="alert alert-primary text-center">
                {{html()->label("Favicon")->class("d-block")}}
            </div>
            {{html()->file("favicon")->class("dropify-image")->attribute("data-default-file", $settings["favicon"] ?? null)->accept(".png, .jpg, .jpeg, .gif")}}
        </div>
        <div class="col-lg-3">
            <div class="alert alert-primary text-center">
                {{html()->label("Varsayılan Cover")->class("d-block")}}
            </div>
            {{html()->file("cover")->class("dropify-image")->attribute("data-default-file", $settings["cover"] ?? null)->accept(".png, .jpg, .jpeg, .gif")}}
        </div>
        <div class="col-lg-3">
            <div class="alert alert-primary text-center">
                {{html()->label("Breadcrumb")->class("d-block")}}
            </div>
            {{html()->file("breadcrumb")->class("dropify-image")->attribute("data-default-file", $settings["breadcrumb"] ?? null)->accept(".png, .jpg, .jpeg, .gif")}}
        </div>
        <div class="col-lg-3">
            <div class="alert alert-primary text-center">
                {{html()->label("About 1")->class("d-block")}}
            </div>
            {{html()->file("about_1")->class("dropify-image")->attribute("data-default-file", $settings["about_1"] ?? null)->accept(".png, .jpg, .jpeg, .gif")}}
        </div>
        <div class="col-lg-3">
            <div class="alert alert-primary text-center">
                {{html()->label("About 2")->class("d-block")}}
            </div>
            {{html()->file("about_2")->class("dropify-image")->attribute("data-default-file", $settings["about_2"] ?? null)->accept(".png, .jpg, .jpeg, .gif")}}
        </div>
        <div class="col-lg-3">
            <div class="alert alert-primary text-center">
                {{html()->label("Hire Area")->class("d-block")}}
            </div>
            {{html()->file("hire_area")->class("dropify-image")->attribute("data-default-file", $settings["hire_area"] ?? null)->accept(".png, .jpg, .jpeg, .gif")}}
        </div>
        <div class="col-lg-3">
            <div class="alert alert-primary text-center">
                {{html()->label("Counter")->class("d-block")}}
            </div>
            {{html()->file("counter")->class("dropify-image")->attribute("data-default-file", $settings["counter"] ?? null)->accept(".png, .jpg, .jpeg, .gif")}}
        </div>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{ themeAsset('admin', 'css/dropify.min.css') }}">
@endpush
@push('script')
    <script src="{{ themeAsset('admin', 'js/dropzone.min.js') }}"></script>
    <script src="{{ themeAsset('admin', 'js/dropify.min.js') }}"></script>
@endpush
