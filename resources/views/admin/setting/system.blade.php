@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    {{ html()->label(__("admin/setting.system_admin_route")) }}
    {{ html()->text('admin_route', $settings["admin_route"] ?? null)->placeholder(__("admin/setting.system_admin_route_placeholder"))->class('form-control') }}
    <div class="alert alert-warning">@lang("admin/setting.system_admin_route_alert")</div>
    {{ html()->label(__("admin/setting.system_multilanguage")) }}
    {{ html()->select('multilanguage', App\Enums\StatusEnum::getOnOffSelectArray(), $settings["multilanguage"] ?? "default")->class('form-control') }}
@endsection
