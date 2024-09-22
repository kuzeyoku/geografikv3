@extends('layout.main')
@section('content')
    @include('layout.breadcrumb', ['title' => __('front/product.txt1'), 'parent' => __('front/product.txt1')])
    <section class="portfolio-main pt-120">
        <div class="container">
            <div class="row wow fadeInUp">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-sm-6">
                        <a href="{{ $category->url }}">
                            <div class="product-container mb-55">
                                <div class="product-image mb-75">
                                    <img src="{{ $category->getFirstMediaUrl() }}" alt="{{$category->title}}">
                                </div>
                                <div class="product-title">
                                    {{ $category->title }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
