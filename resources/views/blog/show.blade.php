@extends('layout.main')
@push('style')
    <link rel="stylesheet" href="{{ themeAsset('front', 'css/module-css/blog.css') }}" />
@endpush
@section('content')
    <section class="blog-details">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="blog-details__left">
                        <div class="blog-details__img">
                            <img src="{{ $blog->getFirstMediaUrl('cover') }}" alt="">
                            <div class="blog-details__date">
                                <p>{{ $blog->created_at->translatedFormat('d') }}<br>{{ $blog->created_at->translatedFormat('M') }}
                                </p>
                            </div>
                        </div>
                        <div class="blog-details__content">
                            <div class="blog-details__user-and-meta">
                                <ul class="blog-details__meta list-unstyled">
                                    <li>
                                        <a href="javascript:void();"><span
                                                class="icon-user"></span>{{ $blog->user->name }}</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void();"><span class="icon-speech-bubbles"></span>Comments
                                            ({{ $blog->comments->count() }})</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void();"><span
                                                class="icon-clock"></span>{{ $blog->created_at->diffForHumans() }}</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="blog-details__title">{{ $blog->title }}</h3>
                            {!! $blog->description !!}
                            <div class="blog-details__tag-and-share">
                                <div class="blog-details__tag">
                                    <h3 class="blog-details__tag-title">Tags :</h3>
                                    <ul class="blog-details__tag-list list-unstyled">
                                        @foreach ($blog->tags as $tag)
                                            <li>
                                                <a href="javascript:void();">{{ $tag }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="comment-one">
                                @foreach ($blog->comments as $comment)
                                    <div class="comment-one__single">
                                        <div class="comment-one__image">
                                            <img src="assets/images/blog/comment-1-1.jpg" alt="">
                                        </div>
                                        <div class="comment-one__content">
                                            <h3>{{ $comment->name }}</h3>
                                            <span>{{ $comment->created_at->diffForHumans() }}</span>
                                            <p>{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="comment-form">
                                <h3 class="comment-form__title">Leave A Comment</h3>
                                <p class="comment-form__text">By using form u agree with the message sorage, you can
                                    contact us directly now</p>
                                <form action="assets/inc/sendemail.php" class="comment-one__form contact-form-validated"
                                    novalidate="novalidate">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="comment-form__input-box">
                                                <input type="text" placeholder="Your Name" name="name">
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="comment-form__input-box">
                                                <input type="email" placeholder="Your Email" name="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="comment-form__input-box text-message-box">
                                                <textarea name="message" placeholder="Write your messege"></textarea>
                                            </div>
                                            <div class="comment-form__btn-box">
                                                <button type="submit" class="thm-btn comment-form__btn">submit
                                                    now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="result"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar">
                        <div class="sidebar__single sidebar__search">
                            <form action="#" class="sidebar__search-form">
                                <input type="search" placeholder="Search here">
                                <button type="submit"><i class="icon-search-interface-symbol"></i></button>
                            </form>
                        </div>
                        <div class="sidebar__single sidebar__all-category">
                            <h3 class="sidebar__title">Categories</h3>
                            <ul class="sidebar__all-category-list list-unstyled">
                                <li>
                                    <a href="#">Industrial service<span>(04)</span></a>
                                </li>
                                <li class="active">
                                    <a href="#">residential service<span>(06)</span></a>
                                </li>
                                <li>
                                    <a href="#">Commercial services<span>(02)</span></a>
                                </li>
                                <li>
                                    <a href="#">power solution<span>(04)</span></a>
                                </li>
                                <li>
                                    <a href="#">upgrade old wiring<span>(07)</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar__single sidebar__post">
                            <h3 class="sidebar__title">Our Latest Post</h3>
                            <ul class="sidebar__post-list list-unstyled">
                                <li>
                                    <div class="sidebar__post-image">
                                        <img src="assets/images/blog/lp-1-1.jpg" alt="">
                                    </div>
                                    <div class="sidebar__post-content">
                                        <p class="sidebar__post-date">02 June 2024</p>
                                        <h3>
                                            <a href="blog-details.html">Greater Pleasures or The Selection</a>
                                        </h3>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar__post-image">
                                        <img src="assets/images/blog/lp-1-2.jpg" alt="">
                                    </div>
                                    <div class="sidebar__post-content">
                                        <p class="sidebar__post-date">02 June 2024</p>
                                        <h3>
                                            <a href="blog-details.html">He pleasures to secure greater</a>
                                        </h3>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar__post-image">
                                        <img src="assets/images/blog/lp-1-3.jpg" alt="">
                                    </div>
                                    <div class="sidebar__post-content">
                                        <p class="sidebar__post-date">02 June 2024</p>
                                        <h3>
                                            <a href="blog-details.html">worse pains to the selection point.</a>
                                        </h3>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar__single sidebar__tags">
                            <h3 class="sidebar__title">Popular Tags</h3>
                            <div class="sidebar__tags-list">
                                <a href="#">Growth Accelerator</a>
                                <a href="#">Management</a>
                                <a href="#">Analysis</a>
                                <a href="#">Planning</a>
                                <a href="#">Advisory Service</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
