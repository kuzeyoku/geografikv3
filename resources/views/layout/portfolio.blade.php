<section class="portfolio-area">
    <div class="container">
        <div class="row wow fadeInUp align-items-center counter-head"
            style="visibility: visible; animation-name: fadeInUp;">
            <div class="col-lg-6 col-md-7">
                <div class="portfolio-left">
                    <div class="section-title mb-55">
                        <div class="border-left">
                            <p>Portfolio</p>
                        </div>
                        <h2>Explore some Recent Projects</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-5">
                <div class="portfolio-right mb-30 text-md-end">
                    <a href="{{ route('project.index') }}" class="grb-border-btn st-1">
                        All Projects
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-container">
        <div class="portfolio-inner">
            <div class="swiper-container portfolio-active swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                <div class="swiper-wrapper">
                    @foreach ($project as $project)
                        <div class="swiper-slide">
                            <div class="single-portfolio">
                                <div class="portfolio-img">
                                    <a href="portfolio-details.html"><img
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
                    <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"
                        aria-controls="swiper-wrapper-ff1dcba42f10adc4f"><i class="far fa-arrow-left"></i></div>
                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                        aria-controls="swiper-wrapper-ff1dcba42f10adc4f"><i class="far fa-arrow-right"></i></div>
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    </div>
</section>
