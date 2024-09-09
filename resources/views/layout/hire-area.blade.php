<section class="hire-area" data-background="{{ config('asset.hire_area') }}">
    <div class="container">
        <div class="row wow fadeInUp justify-content-center">
            <div class="col-lg-8 col-md-11">
                <div class="hire-content text-center">
                    <div class="section-title mb-55">
                        <h2 class="white-color">@lang('front/hirearea.txt1')</h2>
                    </div>
                    <div class="hire-btn d-inline-block">
                        <a href="{{ route('product.index') }}" class="grb-btn st-3">@lang('front/hirearea.button1')</a>
                    </div>
                    <div class="hire-btn d-inline-block">
                        <a href="{{ route('service.index') }}" class="grb-btn st-3">@lang('front/hirearea.button2')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
