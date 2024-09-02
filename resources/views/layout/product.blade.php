<section class="services-one">
    <div class="container-fluid">
        <div clasws="services-one__inner">
            <div class="row">
                {{-- @foreach ($product as $product)
                    <div class="col-lg custom-col">
                        <div class="product-container">
                            <a href="{{ $product->url }}">
                                <img width="300" height="300" class="product-image"
                                    src="{{ $product->getFirstMediaUrl('cover') }}" alt="">
                            </a>
                            <p class="product-title">{{ $product->title }}</p>
                        </div>
                    </div>
                @endforeach --}}
                @foreach ($product as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product-container">
                            <a href="{{ $product->url }}">
                                <img width="300" height="300" class="product-image"
                                    src="{{ $product->getFirstMediaUrl('cover') }}" alt="">
                            </a>
                            <p class="product-title">{{ $product->title }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
