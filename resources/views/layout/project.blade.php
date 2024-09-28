<section class="portfolio-area">
    <div class="container">
        <div class="row wow fadeInUp align-items-center counter-head">
            <div class="col-lg-6 col-md-7">
                <div class="portfolio-left">
                    <div class="section-title mb-55">
                        <div class="border-left">
                            <p>@lang("front/project.txt1")</p>
                        </div>
                        <h2>@lang("front/project.txt2")</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-5">
                <div class="portfolio-right mb-30 text-md-end">
                    <a href="{{ route('project.index') }}" class="grb-border-btn st-1">
                        @lang("front/project.txt3")
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-container">
        <div class="portfolio-inner">
            <div class="swiper-container portfolio-active swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                <div class="swiper-wrapper">
                    @foreach ($projects as $project)
                        <div class="swiper-slide">
                            <div class="single-portfolio">
                                <div class="portfolio-img">
                                    <a href="{{ $project->url }}"><img
                                            src="{{ $project->getFirstMediaUrl('cover') }}" alt=""></a>
                                </div>
                                <div class="portfolio-content">
                                    <h5><a href="{{ $project->url }}">{{ $project->title }}</a></h5>
                                    <a class="p-link" href="{{ $project->url }}"><i class="fal fa-link"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="portfolio-nav">
                    <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"><i
                            class="far fa-arrow-left"></i></div>
                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"><i
                            class="far fa-arrow-right"></i></div>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    </div>
</section>
