@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    {{ html()->label(__("admin/{$folder}.pagination_admin")) }}
    {{ html()->number('admin', config('pagination.admin'))->placeholder(__("admin/{$folder}.pagination_admin_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.pagination_front")) }}
    {{ html()->number('front', config('pagination.front'))->placeholder(__("admin/{$folder}.pagination_front_placeholder"))->class('form-control') }}
@endsection
