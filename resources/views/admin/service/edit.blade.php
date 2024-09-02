@extends(themeView('admin', 'layout.edit'), ['tab' => true, 'item' => $service])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->attribute('data-default-file', $service->getFirstMediaUrl($module->COVER_COLLECTION()))->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}
    {{ html()->file('document')->attribute('data-allowed-file-extensions', 'pdf doc docx xls xlsx ppt pptx')->attribute('data-default-file', $service->getFirstMediaUrl($module->DOCUMENT_COLLECTION()))->accept('.pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx')->class('dropify-document') }}
    @foreach (LanguageList() as $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]", $service->titles[$lang->code])->placeholder(__("admin/{$folder}.form_title_placeholder"))->class('form-control') }}
            {{ html()->label(__("admin/{$folder}.form_description")) }}
            {{ html()->textarea("description[$lang->code]", $service->descriptions[$lang->code])->class('editor') }}
        </div>
    @endforeach
    <div class="row">
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_category")) }}
            {{ html()->select('category_id', $categories, $service->category)->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', $service->order)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList(), $service->status ?? 'default')->class('form-control') }}
        </div>
    </div>
@endsection
