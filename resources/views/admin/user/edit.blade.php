@extends(themeView('admin', 'layout.edit'), ['tab' => false, 'item' => $user])
@section('form')
    {{ html()->label(__("admin/{$folder}.form_name")) }}
    {{ html()->text('name', $user->name)->placeholder(__("admin/{$folder}.form_name_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_email")) }}
    {{ html()->email('email', $user->email)->placeholder(__("admin/{$folder}.form_email_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_password")) }}
    {{ html()->password('password')->placeholder(__("admin/{$folder}.form_password_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_role")) }}
    {{ html()->select('role', $roles, $user->role->value)->class('form-control') }}
@endsection
