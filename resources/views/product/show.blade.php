@extends("layout.main")
@section("content")
    @include("layout.breadcrumb",["title" => $product->title])
    {!! $product->description !!}
@endsection
@push("style")
    <link rel="stylesheet" href="{{ themeAsset("front","css/product.css") }}">
@endpush
