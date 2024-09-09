@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    {{ html()->label(__("admin/setting.maintenance_status")) }}
    {{ html()->select('status', App\Enums\StatusEnum::getOnOffSelectArray(), $settings["status"] ?? "default")->class('form-control') }}
    {{ html()->label(__("admin/setting.maintenance_message")) }}
    {{ html()->textarea('message', $settings["message"] ?? null)->placeholder(__("admin/setting.maintenance_message_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/setting.maintenance_end_date")) }}
    {{ html()->date('end_date', $settings["end_date"] ?? null)->class('form-control') }}
@endsection
