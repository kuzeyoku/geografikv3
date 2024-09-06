@extends("layout.main")
@section("content")
    @include("layout.breadcrumb",["title" => __("front/project.txt1")])
    <section class="portfolio-main pt-150">
        <div class="container">
            <div class="row wow fadeInUp grid portfolio-main-items">
                @foreach($projects as $project)
                    <div class="col-lg-4 col-sm-6 grid-item">
                        <div class="portfolio-item mb-30">
                            <div class="portfolio-item-img p-relative">
                                <img src="{{ $project->getFirstMediaUrl("cover") }}" alt="{{ $project->title }}">
                                <div class="portfolio-hover-contnet">
                                    <div class="portfolio-hover-inner text-center">
                                        <a class="p-h-icon pm-s" href="{{$project->url}}">
                                            <i class="fas fa-paper-plane"></i>
                                            @lang("front/project.txt4")
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="project-meta">
                                <div class="project-name">
                                    <h5>{{$project->title}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
