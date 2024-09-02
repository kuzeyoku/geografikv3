@extends('layout.main')
@section('content')
    <embed src="{{ $project->model3D }}" width="100%" height="750" />
    <section class="project-one">
        <div class="container">
            <div class="project-one__top">
                <div class="section-title text-left">
                    <div class="section-title__title-box sec-title-animation animation-style2">
                        <h2 class="section-title__title title-animation" style="perspective: 400px;">
                            Diğer Projeler
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($otherProjects as $project)
                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInLeft animated" data-wow-delay="300ms">
                        <div class="project-one__single">
                            <div class="project-one__img-box">
                                <div class="project-one__img">
                                    {{ $project->getFirstMedia('cover') }}
                                    <div class="project-one__arrow">
                                        <a href="{{ $project->url }}"><span class="icon-arrow-right"></span></a>
                                    </div>
                                </div>
                                <div class="project-one__content">
                                    <p class="project-one__sub-title"><a class="text-dark"
                                            href="{{ $project->url }}">{{ $project->title }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
