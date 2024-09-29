@extends('layout.main')
@section('content')
    @include('layout.breadcrumb', ['title' => $service->title, 'parent' => __("front/service.txt1"), 'parent_url' => route('service.index')])
    <section class="service-details-area pt-70 pb-80">
        <div class="container">
            <div class="service-details-content wow fadeInUp">
                {!! $service->description !!}
            </div>
        </div>
    </section>
@endsection
