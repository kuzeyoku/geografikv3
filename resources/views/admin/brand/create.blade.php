@extends(themeView('admin', 'layout.create'), ['tab' => false])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}
    <br>
    {{ html()->label(__("admin/{$folder}.form_title")) }}
    {{ html()->text('title')->placeholder(__("admin/{$folder}.form_title_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_url")) }}
    {{ html()->text('url')->placeholder(__("admin/{$folder}.form_url_placeholder"))->class('form-control') }}
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
