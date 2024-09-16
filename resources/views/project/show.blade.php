@extends("layout.main")
@section("content")
    @include("layout.breadcrumb", ["title" => $project->title, "parent" => __("front/project.txt1"), "parent_url" => route("project.index")])
    <section class="portfolio-details-area pt-150 pb-80">
        <div class="container">
            <div class="portfolio-details-content">
                <div class="wow fadeInUp">
                    <div class="portfolio-details-title mb-25">
                        <h4>{{$project->title}}</h4>
                    </div>
                </div>
                <div class="portfolio-details-img">
                    <div class="row wow fadeInUp">
                        <div class="col-lg-8">
                            <div class="portfolio-details-img-left">
                                <div class="portfolio-details-single-img">
                                    <img src="{{$project->getFirstMediaUrl("cover")}}" alt="{{$project->title}}">
                                </div>
                            </div>
                            {!! $project->description !!}
                        </div>
                        <div class="col-lg-4">
                            <div class="portfolio-sidebar">
                                <div class="p-sidebar-widget mb-30">
                                    <table class="table table-responsive">
                                        <thead class="bg-primary text-center text-white">
                                        <tr>
                                            <td colspan="2">
                                                @lang("front/project.txt5")
                                            </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($project->feature as $key => $value)
                                            <tr>
                                                <td>
                                                    {{$key}} :
                                                </td>
                                                <td>
                                                    {{$value}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <a onclick="return!window.open(this.href)" href="{{$project->model3D}}"
                                       class="btn btn-block btn-primary w-100">
                                        <i class="fas fa-eye"></i> @lang("front/project.txt6")
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
