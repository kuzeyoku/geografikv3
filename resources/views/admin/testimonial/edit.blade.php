@extends(themeView("admin","layout.edit"),["tab"=>false,"item" => $testimonial])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->attribute('data-default-file', $testimonial->getFirstMediaUrl("avatar"))->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}
    <br>
    {{ html()->label(__("admin/{$folder}.form_name")) }}
    {{ html()->text('name', $testimonial->name)->placeholder(__("admin/{$folder}.form_name_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_company")) }}
    {{ html()->text('company', $testimonial->company)->placeholder(__("admin/{$folder}.form_company_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_position")) }}
    {{ html()->text('position', $testimonial->position)->placeholder(__("admin/{$folder}.form_position_placeholder"))->class('form-control') }}
    {{ html()->label(__("admin/{$folder}.form_message")) }}
    {{ html()->textarea('message', $testimonial->message)->placeholder(__("admin/{$folder}.form_message_placeholder"))->class('form-control') }}
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', $testimonial->order)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList(), $testimonial->status)->class('form-control') }}
        </div>
    </div>
@endsection
