@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    {{ html()->label(__("admin/{$folder}.contact_phone")) }}
    {{ html()->text('phone', config('contact.phone'))->placeholder(__("admin/{$folder}.contact_phone_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.contact_email")) }}
    {{ html()->text('email', config('contact.email'))->placeholder(__("admin/{$folder}.contact_email_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.contact_address")) }}
    {{ html()->text('address', config('contact.address'))->placeholder(__("admin/{$folder}.contact_address_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.contact_map")) }}
    {{ html()->text('map', config('contact.map'))->placeholder(__("admin/{$folder}.contact_map_placeholder"))->class('form-control') }}
@endsection
