@extends('layout.main')
@section('content')
    @include('layout.breadcrumb', ['title' => $category->title,"parent" => __("front/service.txt2"), "parent_url" => route("service.index")])
    <section class="service-box-area service-box-area-main pt-100 pb-80">
        <div class="container">
            <div class="row wow fadeInUp">
                @foreach ($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-slide-single p-relative mb-30">
                            <a href="{{ $service->url }}">
                                <img src="{{ $service->image }}" alt="{{ $service->title }}">
                                <div class="portfolio-slide-title">
                                    {{ $service->title }}
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="hire-area" data-background="{{ config('asset.hire_area') }}">
        <div class="container">
            <div class="row wow fadeInUp justify-content-center">
                <div class="col-lg-9 col-md-12">
                    <div class="hire-content text-center">
                        <div class="section-title mb-55">
                            <h2 class="white-color">@lang('front/service.txt4')</h2>
                        </div>
                        <div class="hire-btn d-inline-block">
                            <a href="{{ route('contact.index') }}" class="grb-btn st-3">@lang('front/contact.txt1')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
