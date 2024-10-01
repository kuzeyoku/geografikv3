<div class="brand-area pt-50 pb-50">
    <div class="container">
        <div class="row wow fadeInUp">
            <div class="col-12">
                <div class="swiper-container brand-active">
                    <div class="swiper-wrapper">
                        @foreach ($brands as $brand)
                            <div class="swiper-slide">
                                <div class="single-brand">
                                    <a onclick="return!window.open(this.href)" href="{{ $brand->url }}">
                                        <img src="{{ $brand->image }}" alt="{{ $brand->title }}">
                                    </a>
                                    <a onclick="return!window.open(this.href)" href="{{ $brand->url }}">
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
</div>

