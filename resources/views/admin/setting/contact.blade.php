@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    {{ html()->label(__("admin/setting.contact_phone")) }}
    {{ html()->text('phone', $settings["phone"])->placeholder(__("admin/setting.contact_phone_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/setting.contact_email")) }}
    {{ html()->text('email', $settings["email"])->placeholder(__("admin/setting.contact_email_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/setting.contact_address")) }}
    {{ html()->text('address', $settings["address"])->placeholder(__("admin/setting.contact_address_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/setting.contact_map")) }}
    {{ html()->text('map', $settings["map"])->placeholder(__("admin/setting.contact_map_placeholder"))->class('form-control') }}
@endsection
