@extends(themeView('admin', 'layout.create'), ['tab' => false])
@section('form')
    {{ html()->label(__("admin/{$folder}.form_title")) }}
    {{ html()->text('title')->placeholder(__("admin/{$folder}.form_title_placeholder"))->class('form-control') }}
    {{ html()->label('code', __("admin/{$folder}.form_code")) }}
    {{ html()->text('code')->placeholder(__("admin/{$folder}.form_code_placeholder"))->class('form-control') }}
    {{ html()->label(__('admin/general.status')) }}
    {{ html()->select('status', statusList())->class('form-control') }}
@endsection
