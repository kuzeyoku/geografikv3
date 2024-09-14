@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    {{ html()->label(__("admin/setting.general_title")) }}
    {{ html()->text('title', $settings["title"] ?? null)->placeholder(__("admin/setting.general_title_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/setting.general_description")) }}
    {{ html()->textarea('description', $settings["description"] ?? null)->placeholder(__("admin/setting.general_description_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/setting.general_keywords")) }}
    {{ html()->text('keywords', $settings["keywords"] ?? null)->placeholder(__("admin/setting.general_keywords_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/setting.general_video")) }}
    {{ html()->text('video', $settings["video"] ?? null)->placeholder(__("admin/setting.general_video_placeholder"))->class('form-control') }}
@endsection
