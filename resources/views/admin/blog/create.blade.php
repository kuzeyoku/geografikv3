@extends(themeView('admin', 'layout.create'), ['tab' => true])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}
    @foreach (languageList() as $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]")->placeholder(__("admin/{$folder}.form_title"))->class('form-control') }}
            {{ html()->label(__("admin/{$folder}.form_description")) }}
            {{ html()->textarea("description[$lang->code]")->class('editor') }}
            {{ html()->label(__("admin/{$folder}.form_tags")) }}
            {{ html()->text("tags[$lang->code]")->placeholder(__("admin/{$folder}.form_tags_placeholder"))->class('form-control') }}
        </div>
    @endforeach
    <div class="row">
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_category")) }}
            {{ html()->select('category_id', $categories)->placeholder(__('admin/general.select'))->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', 0)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList())->class('form-control') }}
        </div>
    </div>
@endsection
