<div class="brand-area pt-100 pb-100 d-none d-lg-block">
    <div class="container">
        <div class="wow fadeInUp">
            <div class="swiper-container brand-active">
                <div class="swiper-wrapper">
                    @foreach ($brands as $brand)
                        <div class="swiper-slide">
                            <div class="single-brand">
                                <a href="{{ $brand->url }}">
                                    <img src="{{ $brand->image }}" alt="{{ $brand->title }}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
