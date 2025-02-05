@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    @php
        $formElementList = ['facebook', 'twitter', 'instagram', 'youtube', 'linkedin'];
    @endphp
    @foreach ($formElementList as $element)
        {{ html()->label(__("admin/setting.social_{$element}")) }}
        {{ html()->text($element, $settings[$element] ?? null)->placeholder(__("admin/setting.social_{$element}_placeholder"))->class('form-control') }}
    @endforeach
@endsection
