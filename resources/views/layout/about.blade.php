<section class="about__area pt-50">
    <div class="container">
        <div class="row wow fadeInUp">
            <div class="col-xl-5 col-lg-5">
                <div class="about__img p-relative mb-30">
                    <div class="about__img-inner">
                        <img src="@setting('asset','about_1')" alt="about1">
                    </div>
                    <div class="p-element">
                        <div class="ab-border d-none d-lg-block"></div>
                        <div class="ab-image">
                            <img src="@setting('asset','about_2')" alt="about2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7">
                <div class="about__content mb-30">
                    <div class="section-title mb-30">
                        <div class="border-left">
                            <p>@setting("general","title")</p>
                        </div>
                        <h2>@lang('front/about.txt1')</h2>
                    </div>
                    <p>@lang('front/about.txt2')</p>
                    <ul class="about-points">
                        <li>
                            <div class="points-heading">
                                <div class="p-icon">
                                    <i class="flaticon-team"></i>
                                </div>
                                <h5>@lang('front/about.txt3')</h5>
                            </div>
                            <p>@lang('front/about.txt4')</p>
                        </li>
                        <li>
                            <div class="points-heading">
                                <div class="p-icon">
                                    <i class="flaticon-creative-team"></i>
                                </div>
                                <h5>@lang('front/about.txt5')</h5>
                            </div>
                            <p>@lang('front/about.txt6')</p>
                        </li>
                    </ul>
                        <div class="about__btn st-1">
                            <a href="{{ $about }}" class="grb-btn st-1">@lang('front/about.txt7')<i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
