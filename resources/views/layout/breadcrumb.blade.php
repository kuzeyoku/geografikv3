<section class="page-title-area" data-background="@setting('asset','readcrumb')">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-content text-center">
                    <div class="page-title-heading">
                        <h1>{{ $title }}</h1>
                    </div>
                    <nav class="grb-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">@lang("front/breadcrumb.txt1")</a>
                            </li>
                            @isset($parent)
                                <li class="breadcrumb-item active" aria-current="page">{{$parent}}</li>
                            @endisset
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
