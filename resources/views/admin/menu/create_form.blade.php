{{ html()->form()->route("admin.{$route}.store")->open() }}
<div class="tab-content">
    @foreach (languageList() as $key => $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]")->placeholder(__("admin/{$folder}.form_title_placeholder"))->class('form-control') }}
        </div>
    @endforeach
</div>
{{ html()->label(__("admin/{$folder}.form_urlSelect")) }}
{{ html()->select('urlSelect', $urlList)->placeholder(__('admin/general.select'))->class('form-control') }}
<span>{{ __("admin/{$folder}.form_urlSelectNote") }}</span>
{{ html()->label(__("admin/{$folder}.form_url")) }}
{{ html()->text('url')->placeholder(__("admin/{$folder}.form_url_placeholder"))->class('form-control') }}
{{ html()->label(__("admin/{$folder}.form_order")) }}
{{ html()->number('order', 0)->placeholder(__("admin/{$folder}.form_order_placeholder"))->class('form-control') }}
{{ html()->label(__("admin/{$folder}.form_parent")) }}
{{ html()->select('parent_id', $parents)->placeholder(__('admin/general.select'))->class('form-control') }}
<label class="inputcheck">
    {{ html()->label(__("admin/{$folder}.form_blank")) }}
    {{ html()->checkbox('blank', false, true) }}
    <span class="checkmark"></span>
</label>
{{ html()->submit(__('admin/general.save'))->class('btn btn-primary') }}
{{ html()->form()->close() }}
