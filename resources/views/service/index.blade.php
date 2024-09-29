@extends('layout.main')
@section('content')
    @include('layout.breadcrumb', ['title' => __("front/service.txt1"),"parent" => __("front/service.txt1")])
    <section class="service-box-area service-box-area-main pt-100 pb-80">
        <div class="container">
            <div class="row wow fadeInUp">
                @foreach ($categories as $category)
                    <div class="col-lg-3 col-md-6">
                        <div class="portfolio-slide-single p-relative mb-30">
                            <a href="{{ $category->url }}">
                                <img src="{{ $category->image }}" alt="{{ $category->title }}">
                                <div class="portfolio-slide-title">
                                    {{ $category->title }}
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
