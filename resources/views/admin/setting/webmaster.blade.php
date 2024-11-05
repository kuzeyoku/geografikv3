@extends(themeView("admin","setting.main"))
@section("setting_form")
    {{ html()->label(__("admin/setting.webmaster_google")) }}
    {{ html()->text("google",$settings["google"] ?? null)->placeholder(__("admin/setting.webmaster_google_placeholder"))->class("form-control") }}
    {{ html()->label(__("admin/setting.webmaster_bing")) }}
    {{ html()->text("bing",$settings["bing"] ?? null)->placeholder(__("admin/setting.webmaster_bing_placeholder"))->class("form-control") }}
    {{ html()->label(__("admin/setting.webmaster_alexa")) }}
    {{ html()->text("alexa", $settings["alexa"] ?? null)->placeholder(__("admin/setting.webmaster_alexa_placeholder"))->class("form-control") }}
    {{ html()->label(__("admin/setting.webmaster_pinterest")) }}
    {{ html()->text("pinterest", $settings["pinterest"] ?? null)->placeholder(__("admin/setting.webmaster_pinterest_placeholder"))->class("form-control") }}
    {{ html()->label(__("admin/setting.webmaster_yandex")) }}
    {{ html()->text("yandex", $settings["yandex"] ?? null)->placeholder(__("admin/setting.webmaster_yandex_placeholder"))->class("form-control") }}
@endsection
