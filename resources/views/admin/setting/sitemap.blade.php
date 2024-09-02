@extends(themeView('admin', 'setting.main'))
@section('setting_form')
    {{ __("admin/{$folder}.sitemap_view") }}<a target="_blank"
        href="{{ url(route('sitemap.index')) }}">{{ url(route('sitemap.index')) }}</a>
    <hr>
    @foreach ($service->getSitemapModuleList() as $module)
        {{ html()->label(__("admin/{$folder}.sitemap_{$module}")) }}
        <div class="row">
            <div class="col-lg-9">
                {{ html()->range("{$module}_priority", config('sitemap.' . $module . '_priority'))->attributes([
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ])->class('form-control') }}
            </div>
            <div class="col-lg-3">
                {{ html()->select(
                        "{$module}_changefreq",
                        $service->getChangeFreqList(),
                        config('sitemap.' . $module . '_changefreq'),
                    )->class('form-control sitemap-changefreq') }}
            </div>
        </div>
    @endforeach
@endsection
