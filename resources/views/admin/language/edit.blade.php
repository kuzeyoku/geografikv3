@extends(themeView('admin', 'layout.edit'), ['tab' => false, 'item' => $language])
@section('form')
    {{ html()->label(__("admin/{$folder}.form_title")) }}
    {{ html()->text('title', $language->title)->placeholder("admin/{$folder}.form_title_placeholder")->class('form-control') }}
    {{ html()->label('code', __("admin/{$folder}.form_code")) }}
    {{ html()->text('code', $language->code)->placeholder("admin/{$folder}.form_code_placeholder")->class('form-control') }}
    {{ html()->label(__('admin/general.status')) }}
    {{ html()->select('status', statusList(), $language->status)->class('form-control') }}
@endsection
