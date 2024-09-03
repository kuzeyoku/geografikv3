@extends(themeView('admin', 'layout.edit'), ['tab' => true, 'item' => $category])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->attribute('data-default-file', $category->getFirstMediaUrl($module->COVER_COLLECTION()))->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}

    @foreach (LanguageList() as $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]", $category->titles[$lang->code])->placeholder(__("admin/{$folder}.form_title_placeholder"))->class('form-control') }}
            {{ html()->label(__("admin/{$folder}.form_description")) }}
            {{ html()->textarea("description[$lang->code]", $category->descriptions[$lang->code])->class('editor') }}
        </div>
    @endforeach
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__("admin/{$folder}.form_module")) }}
            {{ html()->select('module', $modules, $category->module)->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label(__("admin/{$folder}.form_parent")) }}
            {{ html()->select('parent', $categories, $category->parent_id)->placeholder(__('admin/general.select'))->class('form-control') }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', $category->order)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList(), $category->status)->class('form-control') }}
        </div>
    </div>
@endsection
