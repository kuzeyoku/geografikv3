@extends("layout.main")
@section("content")
    @include("layout.breadcrumb",["title" => __("front/blog.txt1"),"parent" => __("front/blog.txt1")])
    <div class="blog-main-area pt-150">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-lg-8">
                    <div class="blog-main">
                        @foreach($blogs as $blog)
                            <div class="blog-main-single mb-60">
                                <div class="bms-img mb-30">
                                    <a href="{{$blog->url}}">
                                        <img src="{{$blog->getFirstMediaUrl("cover")}}" alt="{{$blog->title}}">
                                    </a>
                                </div>
                                <div class="bms-content">
                                    <div class="fix mb-30">
                                        <div class="blog-date bms-date">
                                            <i class="fal fa-calendar-alt"></i>
                                            <span>{{$blog->created_at->translatedFormat("d")}}</span>
                                            <p>{{$blog->created_at->translatedFormat("M Y")}}</p>
                                        </div>
                                        <div class="bms-title">
                                            <ul class="project-like-view bms-lv">
                                                @if($blog->category)
                                                    <li>
                                                        <a href="{{$blog->category->url}}">
                                                            <i class="fas fa-folder-open"></i>{{$blog->category->title}}
                                                        </a>
                                                    </li>
                                                @endif
                                                <li>
                                                    <a href="{{$blog->url}}">
                                                        <i class="fas fa-comments-alt"></i>{{$blog->comments()->count()}} @lang("front/blog.txt5")
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{$blog->url}}">
                                                        <i class="fas fa-eye"></i>{{$blog->view_count}} @lang("front/blog.txt6")
                                                    </a>
                                                </li>
                                            </ul>
                                            <h4><a href="{{$blog->url}}">{{$blog->title}}</a></h4>
                                        </div>
                                    </div>
                                    <p>{{$blog->short_description}}</p>
                                    <div class="bms-btn mt-45">
                                        <a href="{{$blog->url}}"
                                           class="grb-border-btn st-1">@lang("front/blog.txt4")</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-30 d-flex align-items-center justify-content-center">
                        {{ $blogs->links("pagination::bootstrap-4") }}
                    </div>
                </div>
                <div class="col-lg-4">
                    @include("blog.sidebar")
                </div>
            </div>
        </div>
    </div>
@endsection
