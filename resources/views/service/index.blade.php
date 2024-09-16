@extends('layout.main')
@section('content')
    @include('layout.breadcrumb', ['title' => __("front/service.txt1"),"parent" => __("front/service.txt1")])
    <section class="service-box-area service-box-area-main pt-150 pb-80">
        <div class="container">
            <div class="row wow fadeInUp">
                @foreach ($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <div class="single__service">
                            <img src="{{ $service->getFirstMediaUrl('cover') }}" alt="{{ $service->title }}">
                            <div class="single__service-content">
                                <h4><a href="{{ $service->url }}">{{ $service->title }}</a></h4>
                                <p>{{ $service->short_description }}</p>
                                <a href="{{ $service->url }}" class="service__btn">
                                    <i class="fas fa-plus"></i>@lang("front/service.txt2")
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
