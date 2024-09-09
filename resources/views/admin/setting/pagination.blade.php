@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    {{ html()->label(__("admin/setting.pagination_admin")) }}
    {{ html()->number('admin', $settings["admin"] ?? 0)->placeholder(__("admin/setting.pagination_admin_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/setting.pagination_front")) }}
    {{ html()->number('front', $settings["front"] ?? 0)->placeholder(__("admin/setting.pagination_front_placeholder"))->class('form-control') }}
@endsection
