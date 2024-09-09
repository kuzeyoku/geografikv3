    @extends(themeView('admin', 'setting.main'))
    @section('setting_form')
        {{ html()->label(__("admin/setting.cache_status")) }}
        {{ html()->select('status', App\Enums\StatusEnum::getOnOffSelectArray(), $settings["status"] ?? "default")->class('form-control') }}
        {{ html()->label(__("admin/setting.cache_time")) }}
        {{ html()->number('time', $settings["time"] ?? 0)->placeholder(__("admin/setting.cache_time_placeholder"))->class('form-control') }}
    @endsection
