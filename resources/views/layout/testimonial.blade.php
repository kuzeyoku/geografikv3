<section class="testimonial-area pt-50 pb-50" data-background="{{ themeAsset('front', 'img/bg/bg-shape.png') }}">
    <div class="container">
        <div class="row wow fadeInUp">
            <div class="col-lg-12">
                <div class="section-title mb-55 text-center">
                    <div class="border-c-bottom">
                        <p>Yorumlar</p>
                    </div>
                    <h2>Müşterilerimiz Ne Diyor ?</h2>
                </div>
            </div>
        </div>
        <div class="row wow fadeInUp justify-content-center">
            <div class="col-lg-10">
                <div class="testimonial-wrapper p-relative">
                    <div class="testimonial-content-inner">
                        <div class="swiper-container testimonial-active">
                            <div class="swiper-wrapper">
                                @foreach ($testimonial as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="testimonial-single st-1 text-center">
                                            <div class="testimonial-img">
                                                <img src="{{ $testimonial->getFirstMediaUrl('cover') }}" alt="">
                                            </div>
                                            <p class="mb-30">{{ $testimonial->message }}</p>
                                            <div class="testimonial-name">
                                                <h5>{{ $testimonial->name }}</h5>
                                                <p>{{ $testimonial->position }}</p>
                                            </div>
                                            <ul class="testimonial-review">
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="testimonial-nav-1 testimonial-nav-arrow">
                        <div class="testimonial1-button-prev"><i class="far fa-arrow-left"></i></div>
                        <div class="testimonial1-button-next"><i class="far fa-arrow-right"></i></div>
                    </div>
                    <div class="testimonial-quote">
                        <i class="fal fa-quote-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
