@extends(themeView('admin', 'layout.edit'), ['tab' => true, 'item' => $sector])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->attribute('data-default-file', $sector->getFirstMediaUrl())->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}
    @foreach (LanguageList() as $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]", $sector->titles[$lang->code])->placeholder(__("admin/{$folder}.form_title_placeholder"))->class('form-control') }}
        </div>
    @endforeach
    <div class="row">
        <div class="col-lg-4">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', $sector->order)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList(), $sector->status ?? 'default')->class('form-control') }}
        </div>
    </div>
@endsection
