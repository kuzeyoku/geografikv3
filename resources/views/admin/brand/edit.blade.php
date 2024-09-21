@extends(themeView('admin', 'layout.edit'), ['tab' => false, 'item' => $brand])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->attribute('data-default-file', $brand->getFirstMediaUrl())->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}
    <br>
    {{ html()->label(__("admin/{$folder}.form_title")) }}
    {{ html()->text('title', $brand->title)->placeholder(__("admin/{$folder}.form_title_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_url")) }}
    {{ html()->text('url', $brand->url)->placeholder(__("admin/{$folder}.form_url_placeholder"))->class('form-control') }}
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', $brand->order)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList(), $brand->status)->class('form-control') }}
        </div>
    </div>
@endsection
