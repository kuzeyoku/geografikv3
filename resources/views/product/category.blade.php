@extends('layout.main')
@section('content')
    @include('layout.breadcrumb', ['title' => __('front/product.txt1')])
    <style>
        .product-container {
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
        }

        .product-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            position: absolute;
            bottom: 0;
            width: 100%;
            transition: bottom 0.5s;
            padding: 10px;
            border-top: 1px solid #9b9b9b;
        }

        .product-image::after {
            content: "";
            /* Pseudo-element içeriği */
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            top: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0));
            /* Alttan yukarı doğru gradient */
            border-radius: 5px;
            /* .product-image ile aynı border-radius değerini kullanın */
        }

        .product-container:hover .product-title {
            bottom: 20px;
            background-color: rgba(255, 255, 255, 0.4);
            border: none;
            /* Hover durumunda yukarı taşı */
        }

        .category-description p {
            margin-bottom: 10px;
        }

        .category-description ul {
            padding-left: 20px;
            margin-bottom: 20px;
        }

        .category-description ul li {
            list-style: disc;
        }
    </style>
    <section class="portfolio-main pt-120">
        <div class="container">
            <div class="row wow fadeInUp grid portfolio-main-items">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-sm-6 grid-item">
                        <a href="{{ $product->url }}">
                            <div class="product-container mb-55">
                                <div class="product-image">
                                    <img src="{{ $product->getFirstMediaUrl('cover') }}" alt="">

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
