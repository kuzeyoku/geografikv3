@extends("layout.main")
@section("content")
    @include("layout.breadcrumb", ["title" => $page->title])
    <section class="about-details pt-100 pb-100">
    <div class="container">
        <div class="row wow fadeInUp align-items-center">
            {!! $page->description !!}
        </div>
    </div>
</section>
@endsection
