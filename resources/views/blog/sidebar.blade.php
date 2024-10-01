<div class="blog-sidebar">
    @if($categories->isNotEmpty())
        <div class="bs-widget mb-30">
            <div class="bs-widget-title mb-40">
                <h5>@lang("front/blog.txt7")</h5>
            </div>
            <ul class="bs-category-list">
                @foreach($categories as $category)
                    <li>
                        <a href="{{$category->url}}">
                            <p>{{$category->title}}</p><span>({{$category->blogs()->count()}})</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if($popularPosts->isNotEmpty())
        <div class="bs-widget mb-30">
            <div class="bs-widget-title mb-40">
                <h5>@lang("front/blog.txt8")</h5>
            </div>
            <ul class="bs-post">
                @foreach($popularPosts as $post)
                    <li class="bs-post-single">
                        <div class="bs-post-img">
                            <a href="{{$post->url}}">
                                <img src="{{$post->image}}" alt="{{$post->title}}">
                            </a>
                        </div>
                        <div class="bs-post-content">
                            <h6><a href="{{$post->url}}">{{$post->title}}</a></h6>
                            <span>{{$post->created_at->translatedFormat("d M Y")}} </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
