<div class="portfolio-area-slide grey-bg pt-70 pb-50">
    <div class="container">
        <div class="row wow fadeInUp justify-content-center">
            <div class="col-lg-8">
                <div class="section-title mb-55 text-center">
                    <h2>Coğrafi Çözümlerimiz</h2>
                </div>
            </div>
        </div>
        <div class="portfolio-slide-wrapper p-relative">
            <div
                class="swiper-container portfolio-slide swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                <div class="swiper-wrapper" aria-live="off">
                    @foreach ($service_categories as $category)
                        <div class="swiper-slide">
                            <div class="portfolio-slide-single p-relative mb-30">
                                <a href="{{ $category->url }}">
                                    <img src="{{ $category->getFirstMediaUrl('cover') }}" alt="{{$category->title}}">
                                    <div class="portfolio-slide-title">
                                        {{ $category->title }}
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
        </div>
    </div>
</div>
