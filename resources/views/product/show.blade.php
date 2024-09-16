@extends("layout.main")
@section("content")
    @include("layout.breadcrumb",["title" => $product->title, "parent" => __("front/product.txt1"),"parent_url" => route("product.index")])
    {!! $product->description !!}
@endsection
@push("style")
    <link rel="stylesheet" href="{{ themeAsset("front","css/product.css") }}">
@endpush
