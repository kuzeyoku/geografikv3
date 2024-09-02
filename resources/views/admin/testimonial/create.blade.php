@extends(themeView('admin', 'layout.create'), ['tab' => false])
@section('form')
    {{ html()->label(__("admin/{$folder}.form_name")) }}
    {{ html()->text('name')->placeholder(__("admin/{$folder}.form_name_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_company")) }}
    {{ html()->text('company')->placeholder(__("admin/{$folder}.form_company_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_position")) }}
    {{ html()->text('position')->placeholder(__("admin/{$folder}.form_position_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_message")) }}
    {{ html()->textarea('message')->placeholder(__("admin/{$folder}.form_message_placeholder"))->class('form-control') }}
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', 0)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList())->class('form-control') }}
        </div>
    </div>
@endsection
