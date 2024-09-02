@extends('layout.main')
@push('style')
    <link rel="stylesheet" href="{{ themeAsset('front', 'css/module-css/blog.css') }}" />
    {{-- <link rel="stylesheet" href="{{ themeAsset('front', 'css/module-css/page-header.css') }}" /> --}}
@endpush
@section('content')
    {{-- <section class="page-header">
        <div class="container">
            <div class="page-header__inner p-5">
                <h3>Blog</h3>
                <div class="thm-breadcrumb__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html">Home</a></li>
                        <li><span class="icon-angle-right"></span></li>
                        <li>Blog List</li>
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="blog-list">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="blog-list__left">
                        @foreach ($posts as $post)
                            <div class="blog-list__single">
                                <div class="blog-list__img">
                                    <img src="{{ $post->getFirstMediaUrl('cover') }}" alt="">
                                    <div class="blog-list__date">
                                        <p>{{ $post->created_at->translatedFormat('d') }}<br>{{ $post->created_at->translatedFormat('M') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="blog-list__content">
                                    <div class="blog-list__user-and-meta">
                                        <ul class="blog-list__meta list-unstyled">
                                            <li>
                                                <a href="javascript:void();">
                                                    <span class="icon-user"></span> {{ $post->user->name }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void();">
                                                    <span class="icon-speech-bubbles"></span> Yorumlar
                                                    ({{ $post->comments->count() }})
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void();">
                                                    <span class="icon-clock"></span>
                                                    {{ $post->created_at->diffForHumans() }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-list__title"><a href="{{ $post->url }}">{{ $post->title }}</a>
                                    </h3>
                                    <p class="blog-list__text">{{ $post->short_description }}</p>
                                    <a href="{{ $post->url }}" class="blog-list__read-more">Detaylar<span
                                            class="icon-arrow-right"></span></a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar">
                        {{-- <div class="sidebar__single sidebar__all-category">
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
                        </div> --}}
                        <div class="sidebar__single sidebar__post">
                            <h3 class="sidebar__title">Popüler Konular</h3>
                            <ul class="sidebar__post-list list-unstyled">
                                @foreach ($popularPost as $post)
                                    <li>
                                        <div class="sidebar__post-image">
                                            <img src="{{ $post->getFirstMediaUrl('cover') }}" alt="">
                                        </div>
                                        <div class="sidebar__post-content">
                                            <p class="sidebar__post-date">
                                                {{ $post->created_at->translatedFormat('d M, Y') }}</p>
                                            <h3>
                                                <a href="{{ $post->url }}">{{ $post->title }}</a>
                                            </h3>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
