@extends('layout.main')
@section('content')
    @include('layout.breadcrumb', ['title' => __("front/service.txt1"),"parent" => __("front/service.txt1")])
    <section class="service-box-area service-box-area-main pt-150 pb-80">
        <div class="container">
            <div class="row wow fadeInUp">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6">
                        <div class="single__service">
                            <img src="{{ $category->getFirstMediaUrl() }}" alt="{{ $category->title }}">
                            <div class="single__service-content text-center">
                                <h4><a href="{{ $category->url }}">{{ $category->title }}</a></h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
