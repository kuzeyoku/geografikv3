<div class="brand-area pt-50 pb-50">
    <div class="container">
        <div class="row wow fadeInUp">
            <div class="col-12">
                <div class="swiper-container brand-active">
                    <div class="swiper-wrapper">
                        @foreach($references as $reference)
                            <div class="swiper-slide">
                                <div class="single-brand">
                                    <a href="{{$reference->url}}"><img src="{{$reference->image}}" alt="{{$reference->title}}"></a>
                                    <a href="{{$reference->url}}"><img src="{{$reference->image}}" alt="{{$reference->title}}"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
