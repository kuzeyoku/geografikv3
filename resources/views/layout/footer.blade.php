<footer>
    <section class="footer-area pt-80 pb-40">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget mb-40">
                        <div class="question-area">
                            <div class="question-icon">
                                <i class="flaticon-support"></i>
                            </div>
                            <div class="question-text">
                                <p>@lang("front/footer.txt1")</p>
                                <span>
                                    <a href="tel:@setting('contact','phone')">@setting('contact','phone')</a>
                                </span>
                            </div>
                        </div>
                        <div class="footer-address">
                            <h5>@lang("front/footer.txt2")</h5>
                            <p>@setting("contact","address")</p>
                        </div>
                        <div class="grb__social footer-social">
                            <ul>
                                @foreach (setting("social") as $key => $value)
                                    @if (setting("social",$key))
                                        <li>
                                            <a onclick="return!window.open(this.href)"
                                               href="{{setting("social",$key)}}">
                                                <i class="fab fa-{{ $key }}"></i>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget mb-40 cat-m">
                        <div class="footer-widget-title">
                            <h4>@lang("front/footer.txt3")</h4>
                        </div>
                        <ul class="footer-list">
                            @foreach($footer["product_categories"] as $category)
                                <li>
                                    <a href="{{ route('product.category',[$category,$category->slug])}}">{{$category->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-widget-title">
                            <h4>@lang("front/footer.txt4")</h4>
                        </div>
                        <ul class="footer-list">
                            @foreach ($footer['quickLinks'] as $quicklink)
                                <li><a href="{{ $quicklink->url }}">{{ $quicklink->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="copyright-area">
        <div class="container">
            <div class="row wow fadeInUp align-items-center">
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="copyright-logo logo-shape">
                        <a href="{{ route('home') }}">
                            <img src="@setting('asset','logo_light')" alt="@setting('general','title')">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="copyright-text">
                        <p>@lang('front/footer.copyright', ['year' => date('Y'), 'title' => setting("general","title")])</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <ul class="copyright-list f-right">
                        <li><a onclick="return!window.open(this.href)" href="{{ route('sitemap.index') }}">@lang('front/footer.sitemap')</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
