<div class="portfolio-area-slide grey-bg pt-70 pb-50">
    <div class="container">
        <div class="row wow fadeInUp justify-content-center">
            <div class="col-lg-8">
                <div class="section-title mb-55 text-center">
                    <h2>@lang("front/service.txt1")</h2>
                </div>
            </div>
        </div>
        <div class="portfolio-slide-wrapper p-relative">
            <div
                class="swiper-container portfolio-slide swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                <div class="swiper-wrapper" aria-live="off">
                    @foreach ($sectors as $sector)
                        <div class="swiper-slide">
                            <div class="portfolio-slide-single p-relative mb-30">
                                <a href="{{ $sector->url }}">
                                    <img src="{{ $sector->image }}" alt="{{ $sector->title }}">
                                    <div class="portfolio-slide-title">
                                        {{ $sector->title }}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
