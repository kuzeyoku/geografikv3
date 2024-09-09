@extends('layout.main')
@section('content')
    @include('layout.breadcrumb', ['title' => $service->title])
    <section class="service-details-area pt-70 pb-80">
        <div class="container">
            <div class="service-details-img wow fadeInUp">
                <div class="service-details-single-img">
                    <img src="{{ $service->getFirstMediaUrl('cover') }}" alt="{{$service->title}}">
                </div>
            </div>
            <div class="service-details-content wow fadeInUp">
                {!! $service->description !!}
            </div>
        </div>
    </section>
@endsection
