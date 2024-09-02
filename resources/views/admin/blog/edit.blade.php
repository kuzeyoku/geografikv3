@extends(themeView('admin', 'layout.edit'), ['tab' => true, 'item' => $blog])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->attribute('data-default-file', $blog->getFirstMediaUrl($module->COVER_COLLECTION()))->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}
    @foreach (languageList() as $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]", $blog->titles[$lang->code])->placeholder(__("admin/{$folder}.form_title_placeholder"))->class('form-control') }}
            {{ html()->label(__("admin/{$folder}.form_description")) }}
            {{ html()->textarea("description[$lang->code]", $blog->descriptions[$lang->code])->class('editor') }}
            {{ html()->label(__("admin/{$folder}.form_tags")) }}
            {{ html()->text("tags[$lang->code]", $blog->tags[$lang->code])->placeholder(__("admin/{$folder}.form_tags_placeholder"))->class('form-control') }}
        </div>
    @endforeach
    <div class="row">
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_category")) }}
            {{ html()->select('category_id', $categories, $blog->category_id)->placeholder(__('admin/general.select'))->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', $blog->order)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList(), $blog->status)->class('form-control') }}
        </div>
    </div>
@endsection
