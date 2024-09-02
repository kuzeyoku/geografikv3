@extends(themeView('admin', 'layout.create'), ['tab' => false])
@section('form')
    {{ html()->label(__("admin/{$folder}.form_name")) }}
    {{ html()->text('name')->placeholder(__("admin/{$folder}.form_name_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_email")) }}
    {{ html()->email('email')->placeholder(__("admin/{$folder}.form_email_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_password")) }}
    {{ html()->password('password')->placeholder(__("admin/{$folder}.form_password_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_password_confirmation")) }}
    {{ html()->password('password_confirmation')->placeholder(__("admin/{$folder}.form_password_confirmation_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_role")) }}
    {{ html()->select('role', $roles, 'default')->class('form-control') }}
@endsection
