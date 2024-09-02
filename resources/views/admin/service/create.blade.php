@extends(themeView('admin', 'layout.create'), ['tab' => true])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}
    {{ html()->file('document')->attribute('data-allowed-file-extensions', 'pdf doc docx xls xlsx ppt pptx')->accept('.pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx')->class('dropify-document') }}
    @foreach (LanguageList() as $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]")->placeholder(__("admin/{$folder}.form_title_placeholder"))->class('form-control') }}
            {{ html()->label(__("admin/{$folder}.form_description")) }}
            {{ html()->textarea("description[$lang->code]")->class('editor') }}
        </div>
    @endforeach
    <div class="row">
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_category")) }}
            {{ html()->select('category_id', $categories, null)->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', 0)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList(), 'default')->class('form-control') }}
        </div>
    </div>
@endsection
