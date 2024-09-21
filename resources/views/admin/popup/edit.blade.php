@extends(themeView('admin', 'layout.edit'), ['tab' => true, 'item' => $popup])
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/izimodal.min.css') }}">
@endpush
@section('form')
    {{ html()->label(__("admin/{$folder}.form_type")) }}
    {{ html()->select('type')->options([
            'image' => __("admin/{$folder}.type_image"),
            'text' => __("admin/{$folder}.type_text"),
            'video' => __("admin/{$folder}.type_video"),
        ])->value($popup->type)->placeholder(__('admin/general.select'))->class('form-control')->id('type') }}
    <div id="image" style="display: none">
        {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->attribute('data-default-file', $popup->getFirstMediaUrl())->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}
    </div>
    @foreach (languageList() as $key => $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]", $popup->titles[$lang->code])->placeholder(__("admin/{$folder}.form_title"))->class('form-control') }}
            <div id="text" style="display: none">
                {{ html()->label(__("admin/{$folder}.form_description")) }}
                {{ html()->textarea("description[$lang->code]", $popup->descriptions[$lang->code])->class('editor') }}
            </div>
        </div>
    @endforeach
    <div id="video" style="display: none">
        {{ html()->label(__("admin/{$folder}.form_video")) }}
        {{ html()->input('url', 'video', $popup->video)->placeholder(__("admin/{$folder}.form_video_placeholder"))->class('form-control') }}
    </div>
    <div class="row">
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_time")) }}
            {{ html()->number('time', $popup->settings->time)->placeholder(__("admin/{$folder}.form_time_placeholder"))->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_width")) }}
            {{ html()->number('width', $popup->settings->width)->placeholder(__("admin/{$folder}.form_width_placeholder"))->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_url")) }}
            {{ html()->input('url', 'url', $popup->url)->placeholder(__("admin/{$folder}.form_url_placeholder"))->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_closeButton")) }}
            {{ html()->select('closeButton', App\Enums\StatusEnum::getTrueFalseSelectArray(), $popup->settings->closeButton)->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_closeOnEscape")) }}
            {{ html()->select('closeOnEscape', App\Enums\StatusEnum::getTrueFalseSelectArray(), $popup->settings->closeOnEscape)->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_overlayClose")) }}
            {{ html()->select('overlayClose', App\Enums\StatusEnum::getTrueFalseSelectArray(), $popup->settings->overlayClose)->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_pauseOnHover")) }}
            {{ html()->select('pauseOnHover', App\Enums\StatusEnum::getTrueFalseSelectArray(), $popup->settings->pauseOnHover)->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_fullScreenButton")) }}
            {{ html()->select('fullScreenButton', App\Enums\StatusEnum::getTrueFalseSelectArray(), $popup->settings->fullScreenButton)->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_color")) }}
            {{ html()->input('color', 'color', $popup->settings->color)->class('form-control form-control-color') }}
        </div>
    </div>
    {{ html()->label(__('admin/general.status')) }}
    {{ html()->select('status', statusList(), $popup->status)->class('form-control') }}
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            var type = $("#type").val()
            $("#" + type).show();
        });
        $("#type").on("change", function() {
            var type = $(this).val();
            $("#" + type).show();
            $("#text, #image, #video").not("#" + type).hide();
        });
    </script>
@endpush
