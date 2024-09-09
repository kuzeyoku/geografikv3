@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    @php
        $formElementList = [
            'host',
            'port',
            'username',
            'password',
            'encryption',
            'from_address',
            'from_name',
            'reply_address',
        ];
    @endphp
    @foreach ($formElementList as $element)
        {{ html()->label(__("admin/setting.smtp_{$element}")) }}
        {{ html()->text($element, $settings[$element] ?? null)->placeholder(__("admin/setting.smtp_{$element}_placeholder"))->class('form-control') }}
    @endforeach
@endsection
