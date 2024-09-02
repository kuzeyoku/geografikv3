@extends(themeView('admin', 'layout.main'))
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>@lang("admin/{$folder}.show_title")</h4>
                    <h6>@lang("admin/{$folder}.show_description")</h6>
                </div>
            </div>
            <div class="page-btn">
                <a href="{{ route("admin.{$route}.index") }}" class="btn btn-added"><i data-feather="list"
                        class="me-2"></i>@lang("admin/{$folder}.list")</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div>{{ $message->name }}</div>
                <small class="text-muted">
                    {{ __("admin/{$folder}.email") }} {{ $message->email }} |
                    {{ __("admin/{$folder}.phone") }} {{ $message->phone }} |
                    {{ __("admin/{$folder}.ip") }} {{ $message->ip }}
                </small>
                <hr>
                <h4 class="mb-3">{{ $message->subject }}</h4>
                {{ $message->message }}
                <hr>
                <a class="btn btn-primary" href="{{ route("admin.{$route}.reply", $message) }}">
                    {{ __("admin/{$folder}.reply") }}
                </a>
                {{ html()->form('delete')->route("admin.{$route}.destroy", $message)->class('d-inline')->open() }}
                <button type="button" class="btn btn-danger destroy-btn">{{ __('admin/general.delete') }}</button>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
@endsection
