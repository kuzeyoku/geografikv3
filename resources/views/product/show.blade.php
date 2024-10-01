@extends("layout.main")
@section("content")
    @include("layout.breadcrumb",["title" => $product->title, "parent" => __("front/product.txt1"),"parent_url" => route("product.index")])
    {!! $product->description !!}
    <section class="hire-area pd-hire-area" data-background="@setting("asset","hire_area")">
        <div class="pd-hire-inner">
            <div class="row wow fadeInUp justify-content-center">
                <div class="col-lg-8 col-md-11">
                    <div class="hire-content text-center">
                        <div class="section-title mb-55">
                            <h2>@lang("front/product.txt2")</h2>
                        </div>
                        <div class="hire-btn pd-hire-btn">
                            <a href="{{route("home")}}" class="grb-btn st-1">@lang("front/product.txt3")</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($otherProducts->isNotEmpty())
        <div class="container">
            <div class="related-shots-inner">
                <h3>@lang("front/product.txt4")</h3>
            </div>
            <div class="portfolio-inner">
                <div  class="swiper-container portfolio-active swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events">
                    <div class="swiper-wrapper">
                        @foreach($otherProducts as $item)
                            <div class="swiper-slide">
                                <a href="{{ $item->url }}">
                                    <div class="product-container mb-55">
                                        <div class="product-image">
                                            <img src="{{ $item->image }}" alt="{{ $item->title }}">
                                        </div>
                                        <div class="product-title">
                                            {{ $item->title }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push("style")
    <link rel="stylesheet" href="{{ themeAsset("front","css/product.css") }}">
@endpush
