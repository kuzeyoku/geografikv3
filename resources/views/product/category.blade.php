@extends('layout.main')
@section('content')
    @include('layout.breadcrumb', ['title' => __('front/product.txt1'), "parent" => __('front/product.txt1'), "parent_url" => route('product.index')])
    <section class="portfolio-main pt-120">
        <div class="container">
            <div class="row wow fadeInUp">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-sm-6">
                        <a href="{{ $product->url }}">
                            <div class="product-container mb-55">
                                <div class="product-image">
                                    <img src="{{ $product->image }}" alt="{{ $product->title }}">
                                </div>
                                <div class="product-title">
                                    {{ $product->title }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="category-description mb-55">
                    {!! $category->description !!}
                </div>
            </div>
        </div>
    </section>
@endsection
