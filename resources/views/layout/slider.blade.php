<section class="slider-area p-relative fix">
    <div class="slider-active swiper-container">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
                <div class="single-slider slider-height swiper-slide slider-overlay" data-swiper-autoplay="5000">
                    <div class="slide-bg" data-background="{{ $slider->getFirstMediaUrl('cover') }}"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="hero-content">
                                    <div class="hero-bg-shape" data-animation="fadeInUp" data-delay=".3s">
                                        <div class="hero-s-1">
                                            <img src="{{ themeAsset('front', 'img/shape/hero-s-1.png') }}"
                                                alt="">
                                        </div>
                                        <div class="hero-s-2">
                                            <img src="{{ themeAsset('fron', 'img/shape/hero-s-2.png') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <p data-animation="fadeInUp" data-delay=".6s">{{ $slider->title }}</p>
                                    <h1 data-animation="fadeInUp" data-delay=".9s">{{ $slider->description }}</h1>
                                    @if ($slider->button)
                                        <div class="hero-btn" data-animation="fadeInUp" data-delay="1.2s">
                                            <a href="{{ $slider->button }}" class="btn">Detaylar</a>
                                        </div>
                                    @endif
                                    @if ($slider->video)
                                        <div class="hero-video-btn" data-animation="fadeInUp" data-delay="1.2s">
                                            <a class="grb-video popup-video" href="{{ $slider->video }}">
                                                <i class="fas fa-play"></i>
                                            </a>
                                            <p>Video İzle</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="slider-nav">
            <div class="swiper-button-prev"><i class="far fa-arrow-left"></i></div>
            <div class="swiper-button-next"><i class="far fa-arrow-right"></i></div>
        </div>
    </div>
</section>
