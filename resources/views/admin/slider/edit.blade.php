@extends(themeView('admin', 'layout.edit'), ['tab' => true, 'item' => $slider])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->attribute('data-default-file', $slider->getFirstMediaUrl())->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}

    @foreach (languageList() as $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]", $slider->titles[$lang->code])->placeholder(__("admin/{$folder}.form_title"))->class('form-control') }}
            {{ html()->label(__("admin/{$folder}.form_description")) }}
            {{ html()->textarea("description[$lang->code]", $slider->descriptions[$lang->code])->placeholder(__("admin/{$folder}.form_description_placeholder"))->rows(3)->class('form-control') }}
        </div>
    @endforeach
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__("admin/{$folder}.form_button")) }}
            {{ html()->text('button', $slider->button)->placeholder(__("admin/{$folder}.form_button_placeholder"))->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label(__("admin/{$folder}.form_video")) }}
            {{ html()->input('url', 'video', $slider->video)->placeholder(__("admin/{$folder}.form_video_placeholder"))->class('form-control') }}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', $slider->order)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label('status', __('admin/general.status')) }}
            {{ html()->select('status', statusList(), $slider->status)->class('form-control') }}
        </div>
    </div>
@endsection
