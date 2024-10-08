@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <div class="card-title-head">
                <h6>@lang("admin/setting.recaptcha")</h6>
            </div>
            {{ html()->label(__("admin/setting.recaptcha_status")) }}
            {{ html()->select('recaptcha_status', App\Enums\StatusEnum::getOnOffSelectArray(), $settings["recaptcha_status"] ?? "default")->class('form-control') }}
            {{ html()->label(__("admin/setting.recaptcha_site_key")) }}
            {{ html()->text('recaptcha_site_key', $settings["recaptcha_site_key"] ?? null)->placeholder(__("admin/setting.recaptcha_site_key_placeholder"))->class('form-control') }}
            {{ html()->label(__("admin/setting.recaptcha_secret_key")) }}
            {{ html()->text('recaptcha_secret_key', $settings["recaptcha_secret_key"] ?? null)->placeholder(__("admin/setting.recaptcha_secret_key_placeholder"))->class('form-control') }}
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card-title-head">
                <h6>@lang("admin/setting.analytics")</h6>
            </div>
            {{ html()->label(__("admin/setting.analytics_status")) }}
            {{ html()->select('analytics_status', App\Enums\StatusEnum::getOnOffSelectArray(), $settings['analytics_status'] ?? "default")->class('form-control') }}
            {{ html()->label(__("admin/setting.analytics_code")) }}
            {{ html()->textarea('analytics_code', $settings["analytics_code"] ?? null)->placeholder(__("admin/setting.analytics_code_placeholder"))->class('form-control')->rows(3) }}
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card-title-head">
                <h6>@lang("admin/setting.tag_manager")</h6>
            </div>
            {{ html()->label(__("admin/setting.tag_manager_status")) }}
            {{ html()->select('tag_manager_status', App\Enums\StatusEnum::getOnOffSelectArray(), $settings["tag_manager_status"] ?? "default")->class('form-control') }}
            {{ html()->label(__("admin/setting.tag_manager_head_code")) }}
            {{ html()->textarea('tag_manager_head_code', $settings["tag_manager_head_code"] ?? null)->placeholder(__("admin/setting.tag_manager_head_code_placeholder"))->class('form-control')->rows(3) }}
            {{ html()->label(__("admin/setting.tag_manager_body_code")) }}
            {{ html()->textarea('tag_manager_body_code', $settings["tag_manager_body_code"] ?? null)->placeholder(__("admin/setting.tag_manager_body_code_placeholder"))->class('form-control')->rows(3) }}
        </div>
    </div>
@endsection
