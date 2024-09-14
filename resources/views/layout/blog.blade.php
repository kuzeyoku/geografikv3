<section class="blog-area pt-120 pb-90">
    <div class="container">
        <div class="row wow fadeInUp align-items-center counter-head">
            <div class="col-lg-6 col-md-8">
                <div class="blog-left">
                    <div class="section-title mb-55">
                        <div class="border-left">
                            <p>@lang('front/blog.txt1')</p>
                        </div>
                        <h2>@lang('front/blog.txt2')</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="blog-right mb-30 f-right">
                    <a href="{{ route('blog.index') }}" class="grb-btn">@lang('front/blog.txt3')</a>
                </div>
            </div>
        </div>
        <div class="row wow fadeInUp">
            @foreach ($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-single mb-30 p-relative">
                        <div class="blog-date">
                            <div class="blog-date-shape">
                                <img src="{{ themeAsset('front', 'img/shape/blog-date-shape.png') }}" alt="">
                            </div>
                            <i class="fal fa-calendar-alt"></i>
                            <span>{{ $blog->created_at->translatedFormat('d') }}</span>
                            <p>{{ $blog->created_at->translatedFormat('M Y') }}</p>
                        </div>
                        <div class="blog-img">
                            <a href="{{ $blog->url }}">
                                <img src="{{ $blog->getFirstMediaUrl('cover') }}" alt="{{$blog->title}}">
                            </a>
                        </div>
                        <div class="blog-content">
                            <h4><a href="{{ $blog->url }}">{{ \Illuminate\Support\Str::limit($blog->title,30) }}</a></h4>
                            <p>{{ $blog->short_description }}</p>
                            <a href="{{ $blog->url }}" class="read-btn">@lang('front/blog.txt4')</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
