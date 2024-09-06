@extends('layout.main')
@section('content')
    @include('layout.slider')
    @include('layout.brand')
    @include('layout.sector')
    @include('layout.about')
    {{--    @include('layout.service')--}}
    @include('layout.counter')
    @include('layout.principles')
    @include('layout.hire-area')
    @include('layout.project')
    @include('layout.testimonial')
    @include('layout.blog')
@endsection
