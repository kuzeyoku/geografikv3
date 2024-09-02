@extends(themeView('admin', 'layout.edit'), ['tab' => true, 'item' => $page])
@section('form')
    @foreach (LanguageList() as $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]", $page->titles[$lang->code])->placeholder(__("admin/{$folder}.form_title_placeholder"))->class('form-control') }}
            {{ html()->label(__("admin/{$folder}.form_description")) }}
            {{ html()->textarea("description[$lang->code]", $page->descriptions[$lang->code])->class('editor') }}
        </div>
    @endforeach
    <div class="row">
        <div class="col-lg-6">
            {{ html()->label(__('admin/page.form_quick_link')) }}
            {{ html()->select('quick_link', App\Enums\StatusEnum::getYesNoSelectArray(), $page->quick_link)->class('form-control') }}
        </div>
        <div class="col-lg-6">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList(), $page->status)->class('form-control') }}
        </div>
    </div>
@endsection
