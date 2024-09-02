<section class="counter">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="800">
                <h2>
                    @lang('front/counter.txt1')
                </h2>
                <h3>
                    @lang('front/counter.txt2')
                </h3>
                <div class="counter-content">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <span>@lang('front/counter.txt3')</span>
                            <p>@lang('front/counter.txt4')</p>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <span>@lang('front/counter.txt5')</span>
                            <figure>+</figure>
                            <p>@lang('front/counter.txt6')</p>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <span>@lang('front/counter.txt7')</span>
                            <figure>+</figure>
                            <p>@lang('front/counter.txt8')</p>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <span>@lang('front/counter.txt9')</span>
                            <figure>+</figure>
                            <p>@lang('front/counter.txt10')</p>
                        </div>
                    </div>
                </div>
                <h2 class="b_border">
                    @lang('front/counter.txt11')
                </h2>
                <p>@lang('front/counter.txt12') {{ config('contact.phone') }}</p>
                <p>@lang('front/counter.txt13') {{ config('contact.email') }}</p>
                <p>@lang('front/counter.txt14') {{ config('contact.address') }}</p>
            </div>
            <div class="col-lg-6 counter-banner wow fadeInRight" data-wow-delay="800">
                <img src="https://cdn-cloudflare.meidianbang.cn/comdata/81833/202109/202109271834187d5196.jpg"
                    alt="">
            </div>
        </div>
    </div>
</section>
