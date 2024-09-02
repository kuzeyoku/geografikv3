@extends(themeView('admin', 'layout.main'))
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>@lang("admin/{$folder}.reply_title")</h4>
                    <h6>@lang("admin/{$folder}.reply_description")</h6>
                </div>
            </div>
            <div class="page-btn">
                <a href="{{ route("admin.{$route}.index") }}" class="btn btn-added"><i data-feather="list"
                        class="me-2"></i>@lang("admin/{$folder}.list")</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                {{ html()->form()->route("admin.{$route}.sendReply", $message)->open() }}
                {{ html()->hidden('message_id', $message->id) }}
                {{ html()->label(__("admin/{$folder}.form_customer")) }}
                {{ html()->text('email', $message->email)->class('form-control')->attribute('readonly', '') }}
                {{ html()->label(__("admin/{$folder}.form_subject")) }}
                {{ html()->text('subject', 're:' . $message->subject)->class('form-control') }}
                {{ html()->label(__("admin/{$folder}.form_content")) }}
                {{ html()->textarea('message', null)->class('form-control') }}
                {{ html()->submit(__("admin/{$folder}.form_send"))->class('btn btn-primary') }}
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
@endsection
