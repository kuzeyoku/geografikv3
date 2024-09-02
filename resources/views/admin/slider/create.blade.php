@extends(themeView('admin', 'layout.create'), ['tab' => true])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}

    @foreach (languageList() as $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]")->placeholder(__("admin/{$folder}.form_title"))->class('form-control') }}
            {{ html()->label(__("admin/{$folder}.form_description")) }}
            {{ html()->textarea("description[$lang->code]")->placeholder(__("admin/{$folder}.form_description_placeholder"))->rows(3)->class('form-control') }}
        </div>
    @endforeach
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__("admin/{$folder}.form_button")) }}
            {{ html()->text('button')->placeholder(__("admin/{$folder}.form_button_placeholder"))->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label(__("admin/{$folder}.form_video")) }}
            {{ html()->input('url', 'video')->placeholder(__("admin/{$folder}.form_video_placeholder"))->class('form-control') }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', 0)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList())->class('form-control') }}
        </div>
    </div>
@endsection
