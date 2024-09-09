@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    {{ __("admin/setting.sitemap_view") }}
    <a onclick="return!window.open(this.href)"
       href="{{ url(route('sitemap.index')) }}">{{ url(route('sitemap.index')) }}</a>
    <hr>
    {{ html()->label(__("admin/setting.sitemap_home")) }}
    <div class="row">
        <div class="col-lg-9">
            {{ html()->range("home_priority", $settings["home_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
        </div>

        <div class="col-lg-3">
            {{ html()->select("home_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["home_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
        </div>
    </div>
    @if(config("module.page.status"))
        {{ html()->label(__("admin/setting.sitemap_static_pages")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("static_pages_priority", $settings["static_pages_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("static_pages_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["static_pages_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
    @endif
    @if(config("module.blog.status"))
        {{ html()->label(__("admin/setting.sitemap_blog")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("blog_priority", $settings["blog_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("blog_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["blog_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
        {{ html()->label(__("admin/setting.sitemap_blog_category")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("blog_category_priority", $settings["blog_category_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("blog_category_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["blog_category_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
        {{ html()->label(__("admin/setting.sitemap_blog_detail")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("blog_detail_priority", $settings["blog_detail_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("blog_detail_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["blog_detail_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
    @endif
    @if(config("module.service.status"))
        {{ html()->label(__("admin/setting.sitemap_service")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("service_priority", $settings["service_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("service_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["service_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
        {{ html()->label(__("admin/setting.sitemap_service_category")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("service_category_priority", $settings["service_category_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("service_category_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["service_category_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
        {{ html()->label(__("admin/setting.sitemap_service_detail")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("service_detail_priority", $settings["service_detail_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("service_detail_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["service_detail_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
    @endif
    @if(config("module.project.status"))
        {{ html()->label(__("admin/setting.sitemap_project")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("project_priority", $settings["project_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("project_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["project_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
        {{ html()->label(__("admin/setting.sitemap_project_category")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("project_category_priority", $settings["project_category_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("project_category_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["project_category_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
        {{ html()->label(__("admin/setting.sitemap_project_detail")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("project_detail_priority", $settings["project_detail_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("project_detail_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["project_detail_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
    @endif
    @if(config("module.product.status"))
        {{ html()->label(__("admin/setting.sitemap_product")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("product_priority", $settings["product_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("product_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["product_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
        {{ html()->label(__("admin/setting.sitemap_product_category")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("product_category_priority", $settings["product_category_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("product_category_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["product_category_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
        {{ html()->label(__("admin/setting.sitemap_product_detail")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("product_detail_priority", $settings["product_detail_priority"] ?? 0.5)->attributes(['min'=> 0,'max'=>1,'step'=>0.1])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select("product_detail_changefreq",App\Services\Admin\SettingService::getChangeFreqList(),$settings["product_detail_changefreq"] ?? "default")->class('form-control sitemap-changefreq') }}
            </div>
        </div>
    @endif
@endsection
