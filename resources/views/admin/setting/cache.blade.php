    @extends(themeView('admin', 'setting.main'))
    @section('setting_form')
        {{ html()->label(__("admin/{$folder}.cache_status")) }}
        {{ html()->select('status', App\Enums\StatusEnum::getOnOffSelectArray(), config("cache.status"))->class('form-control') }}
        {{ html()->label(__("admin/{$folder}.cache_time")) }}
        {{ html()->text('time', config("cache.time"))->placeholder(__("admin/{$folder}.cache_time_placeholder"))->class('form-control') }}
    @endsection
