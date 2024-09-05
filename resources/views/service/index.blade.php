@extends('layout.main')
@section('content')
    @include('layout.breadcrumb', ['title' => 'Hizmetlerimiz'])
    <section class="service-box-area service-box-area-main pt-150 pb-80">
        <div class="container">
            <div class="row wow fadeInUp">
                @foreach ($service as $service)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-box-single mb-40">
                            <div class="service-box-content">
                                <img src="{{ $service->getFirstMediaUrl('cover') }}" alt="">
                                <div class="service-box-content-text">
                                    <h4><a href="{{ $service->url }}">{{ $service->title }}</a></h4>
                                    <p>{{ $service->short_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
