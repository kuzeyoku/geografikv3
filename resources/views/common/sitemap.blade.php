<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>{{ config('sitemap.home_changefreq') }}</changefreq>
        <priority>{{ config('sitemap.home_priority') }}</priority>
    </url>
    @isset($services)
        <url>
            <loc>{{ url(route(\App\Enums\ModuleEnum::Service->route() . '.index')) }}</loc>
            <changefreq>{{ config('sitemap.service_changefreq') }}</changefreq>
            <priority>{{ config('sitemap.service_priority') }}</priority>
        </url>
        @foreach ($services as $service)
            <url>
                <loc>{{ url($service->url) }}</loc>
                <lastmod>{{ $service->updated_at->format('Y-m-d') }}</lastmod>
                <changefreq>{{ config('sitemap.service_detail_changefreq') }}</changefreq>
                <priority>{{ config('sitemap.service_detail_priority') }}</priority>
            </url>
        @endforeach
    @endisset
    @isset($projects)
        <url>
            <loc>{{ url(route(\App\Enums\ModuleEnum::Project->route() . '.index')) }}</loc>
            <changefreq>{{ config('sitemap.project_changefreq') }}</changefreq>
            <priority>{{ config('sitemap.project_priority') }}</priority>
        </url>
        @foreach ($projects as $project)
            <url>
                <loc>{{ url($project->url) }}</loc>
                <lastmod>{{ $project->updated_at->format('Y-m-d') }}</lastmod>
                <changefreq>{{ config('sitemap.project_detail_changefreq') }}</changefreq>
                <priority>{{ config('sitemap.project_detail_priority') }}</priority>
            </url>
        @endforeach
    @endisset
    @isset($products)
        <url>
            <loc>{{ url(route(\App\Enums\ModuleEnum::Product->route() . '.index')) }}</loc>
            <changefreq>{{ config('sitemap.product_changefreq') }}</changefreq>
            <priority>{{ config('sitemap.product_priority') }}</priority>
        </url>
        @foreach ($products as $product)
            <url>
                <loc>{{ url($product->url) }}</loc>
                <lastmod>{{ $product->updated_at->format('Y-m-d') }}</lastmod>
                <changefreq>{{ config('sitemap.product_detail_changefreq') }}</changefreq>
                <priority>{{ config('sitemap.product_detail_priority') }}</priority>
            </url>
        @endforeach
    @endisset
    @isset($posts)
        <url>
            <loc>{{ url(route(\App\Enums\ModuleEnum::Blog->route() . '.index')) }}</loc>
            <changefreq>{{ config('sitemap.blog_changefreq') }}</changefreq>
            <priority>{{ config('sitemap.blog_priority') }}</priority>
        </url>
        @foreach ($posts as $post)
            <url>
                <loc>{{ url($post->url) }}</loc>
                <lastmod>{{ $post->updated_at->format('Y-m-d') }}</lastmod>
                <changefreq>{{ config('sitemap.blog_detail_changefreq') }}</changefreq>
                <priority>{{ config('sitemap.blog_detail_priority') }}</priority>
            </url>
        @endforeach
    @endisset
    @foreach ($pages as $page)
        <url>
            <loc>{{ url(route('page.show', [$page, $page->slug])) }}</loc>
            <lastmod>{{ $page->updated_at->format('Y-m-d') }}</lastmod>
            <changefreq>{{ config('sitemap.static_pages_changefreq') }}</changefreq>
            <priority>{{ config('sitemap.static_pages_priority') }}</priority>
        </url>
    @endforeach
</urlset>
