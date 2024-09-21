@extends(themeView('admin', 'layout.edit'), ['tab' => false, 'item' => $reference])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->attribute('data-default-file', $reference->getFirstMediaUrl())->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}
    <br>
    {{ html()->label(__("admin/{$folder}.form_title")) }}
    {{ html()->text('title', $reference->title)->placeholder(__("admin/{$folder}.form_title_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_url")) }}
    {{ html()->input('url', 'url', $reference->url)->placeholder(__("admin/{$folder}.form_url_placeholder"))->class('form-control') }}
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', $reference->order)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList(), $reference->status)->class('form-control') }}
        </div>
    </div>
@endsection
