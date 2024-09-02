@extends(themeView('admin', 'layout.edit'), ['tab' => true, 'item' => $project])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->attribute('data-default-file', $project->getFirstMediaUrl($module->COVER_COLLECTION()))->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}
    @foreach (languageList() as $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]", $project->titles[$lang->code])->placeholder(__("admin/{$folder}.form_title_placeholder"))->class('form-control') }}
            {{ html()->label(__("admin/{$folder}.form_description")) }}
            {{ html()->textarea("description[$lang->code]", $project->descriptions[$lang->code])->class('editor') }}
            {{ html()->label(__("admin/{$folder}.form_features")) }}
            {{ html()->textarea("features[$lang->code]", $project->features[$lang->code])->placeholder(__("admin/{$folder}.form_features_placeholder"))->rows(4)->class('form-control') }}
        </div>
    @endforeach
    {{ html()->label(__("admin/{$folder}.form_category")) }}
    {{ html()->select('category_id', $categories, $project->category_id)->class('form-control') }}
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__("admin/{$folder}.form_video")) }}
            {{ html()->input('url', 'video', $project->video)->placeholder(__("admin/{$folder}.form_video_placeholder"))->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label(__("admin/{$folder}.form_model3D")) }}
            {{ html()->text('model3D', $project->model3D)->placeholder(__("admin/{$folder}.form_model3D_placeholder"))->class('form-control') }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', $project->order)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList(), $project->status)->class('form-control') }}
        </div>
    </div>
@endsection
