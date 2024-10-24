@extends(themeView('admin', 'layout.create'), ['tab' => true])
@section('form')
    {{ html()->file('image')->attribute('data-allowed-file-extensions', 'png jpg jpeg gif')->accept('.png, .jpg, .jpeg, .gif')->class('dropify-image') }}
    @foreach (languageList() as $lang)
        <div id="{{ $lang->code }}" class="tab-pane @if ($loop->first) active show @endif">
            {{ html()->label(__("admin/{$folder}.form_title")) }}
            {{ html()->text("title[$lang->code]")->placeholder(__("admin/{$folder}.form_title"))->class('form-control') }}
            {{ html()->label(__("admin/{$folder}.form_description")) }}
            {{ html()->textarea("description[$lang->code]")->class('editor') }}
            {{ html()->label(__("admin/{$folder}.form_tags")) }}
            {{ html()->text("tags[$lang->code]")->placeholder(__("admin/{$folder}.form_tags_placeholder"))->class('form-control') }}
        </div>
    @endforeach
    <div class="accordion accordion-flush mb-2 border" id="seo">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Seo Ayarları
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                 data-bs-parent="#seo">
                <div class="accordion-body">
                    {{ html()->label("Seo Başlık") }}
                    {{ html()->text("seo_title")->placeholder("Seo Başlığı")->class("form-control") }}
                    {{ html()->label("Seo Açıklaması") }}
                    {{ html()->textarea("seo_description")->placeholder("Seo Açıklaması. Max:270 Karakter")->class("form-control") }}
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-4">
            {{ html()->label(__("admin/{$folder}.form_category")) }}
            {{ html()->select('category_id', $categories)->placeholder(__('admin/general.select'))->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__('admin/general.order')) }}
            {{ html()->number('order', 0)->placeholder(__('admin/general.order_placeholder'))->class('form-control') }}
        </div>
        <div class="col-lg-4">
            {{ html()->label(__('admin/general.status')) }}
            {{ html()->select('status', statusList())->class('form-control') }}
        </div>
    </div>
@endsection
