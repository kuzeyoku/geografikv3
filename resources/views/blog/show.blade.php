@extends("layout.main")
@section("content")
    @include("layout.breadcrumb",["title" => $blog->title, "parent" => __("front/blog.txt1"),"parent_url" => route("blog.index")])
    <div class="blog-main-area pt-150">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-lg-8">
                    <div class="blog-main">
                        <div class="blog-main-single bm-details">
                            <div class="bms-img mb-20">
                                <img src="{{$blog->image}}"
                                     alt="{{$blog->title}}">
                            </div>
                            <div class="bms-title">
                                <h4>{{$blog->title}}</h4>
                            </div>
                            <div class="bms-content">
                                {!! $blog->description !!}
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="bms-tags">
                                            <span>@lang("front/blog.txt9") :</span>
                                            @foreach($blog->tagstoarray as $tag)
                                                <a>{{$tag}},</a>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="article-nav">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if($blog->previous)
                                                <div class="article-nav-content pr-100">
                                                    <span>@lang("front/blog.txt10")</span>
                                                    <h6>
                                                        <a href="{{$blog->previous->url}}">
                                                            {{$blog->previous->title}}
                                                        </a>
                                                    </h6>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            @if($blog->next)
                                                <div class="article-nav-content next-article pl-100">
                                                    <span>@lang("front/blog.txt11")</span>
                                                    <h6>
                                                        <a href="{{$blog->next->url}}">
                                                            {{$blog->next->title}}
                                                        </a>
                                                    </h6>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @if($blog->comments)
                                    <div class="post-comments">
                                        <div class="post-comment-title mb-40">
                                            <h3>{{$blog->comments->count()}} @lang("front/blog.txt5")</h3>
                                        </div>
                                        <div class="latest-comments">
                                            <ul>
                                                @foreach($blog->comments as $comment)
                                                    <li>
                                                        <div class="comments-box">
                                                            <div class="comments-avatar">
                                                                <img src="{{$comment->gavatarUrl}}"
                                                                     alt="{{$comment->email}}">
                                                            </div>
                                                            <div class="comments-text">
                                                                <div class="avatar-name">
                                                                    <h5>{{$comment->name}}</h5>
                                                                    <span
                                                                        class="post-date">{{$comment->created_at->translatedFormat("d M Y")}}</span>
                                                                </div>
                                                                <p>{{$comment->comment}}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                <div class="post-comment-form mb-30">
                                    <h4>@lang("front/blog.txt12") </h4>
                                    {{html()->form()->route("blog.comment_store",$blog)->id("comment-form")->open()}}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="post-input">
                                                {{html()->input("name")->placeholder(__("front/blog.txt13"))->required()}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="post-input">
                                                {{html()->email("email")->placeholder(__("front/blog.txt14"))->required()}}
                                            </div>
                                        </div>
                                        <div class="post-input">
                                            {{html()->textarea("comment")->placeholder(__("front/blog.txt15"))->required()}}
                                        </div>
                                    </div>
                                    {{html()->button(__('front/blog.txt16'))->class("grb-btn comment-btn g-recaptcha")->data("sitekey",setting("integration","recaptcha_site_key"))->data("callback","onSubmit")->data("action","submit")}}
                                    {{html()->form()->close()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include("blog.sidebar")
                </div>
            </div>
        </div>
    </div>
@endsection
@include('common.alert')
@if (setting("integration","recaptcha_status") == App\Enums\StatusEnum::Active->value)
    @push('script')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script>
            function onSubmit(token) {
                const form = document.getElementById("comment-form");
                if (form.checkValidity()) {
                    form.submit();
                } else {
                    form.reportValidity();
                }
                document.getElementById("comment-form").submit();
            }
        </script>
    @endpush
@endif
