@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    {{ __("admin/{$folder}.sitemap_view") }}
    <a onclick="return!window.open(this.href)" href="{{ url(route('sitemap.index')) }}">{{ url(route('sitemap.index')) }}</a>
    <hr>
    @foreach ($service->getSitemapModuleList() as $module)
        {{ html()->label(__("admin/{$folder}.sitemap_{$module}")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("{$module}_priority", $settings[$module."_priority"] ?? 0.5)->attributes([
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select(
                        "{$module}_changefreq",
                        $service->getChangeFreqList(),
                        $settings[$module . '_changefreq'] ?? "default",
                    )->class('form-control sitemap-changefreq') }}
            </div>
        </div>
    @endforeach
@endsection
