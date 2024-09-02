@extends('layout.main')
@section('content')
    @include('layout.slider')
    <section class="contact-three">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <div class="contact-two__single">
                        <div class="contact-two__icon">
                            @svg("fas-phone-alt")
                        </div>
                        <p>@lang("front/contact.txt8")</p>
                        <h3><a href="tel:{{ config("contact.phone") }}">{{ config("contact.phone") }}</a></h3>
                        <p></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="contact-two__single">
                        <div class="contact-two__icon">
                            @svg("fas-envelope")
                        </div>
                        <p>@lang("front/contact.txt9")</p>
                        <h3><a href="mailto:{{ config("contact.email") }}">{{ config("contact.email") }}</a></h3>
                        <p></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="contact-two__single">
                        <div class="contact-two__icon">
                            @svg("fas-map-marker-alt")
                        </div>
                        <p>@lang("front/contact.txt10")</p>
                        <h3>{{ config("contact.address") }}</h3>
                    </div>
                </div>
            </div>
            <div class="contact-three__inner">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="contact-three__left">
                            <iframe src="{{ config('contact.map') }}" class="google-map__one" allowfullscreen=""></iframe>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="contact-three__right">
                            <h3 class="contact-three__form-title">@lang('front/contact.txt1')</h3>
                            {{ html()->form()->route('contact.send')->open() }}
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="contact-three__input-box">
                                        {{ html()->text('name')->placeholder(__('front/contact.txt2'))->required() }}
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="contact-three__input-box">
                                        {{ html()->email('email')->placeholder(__('front/contact.txt3'))->required() }}
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="contact-three__input-box">
                                        {{ html()->text('phone')->placeholder(__('front/contact.txt4'))->required() }}
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="contact-three__input-box">
                                        {{ html()->text('subject')->placeholder(__('front/contact.txt5'))->required() }}
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="contact-three__input-box text-message-box">
                                        {{ html()->textarea('message')->placeholder(__('front/contact.txt6'))->required() }}
                                    </div>
                                    <div class="contact-three__btn-box">
                                        {{ html()->submit()->class('thm-btn contact-three__btn')->text(__('front/contact.txt7')) }}
                                    </div>
                                </div>
                            </div>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@include('common.alert')
@if (config('integration.recaptcha_status') == App\Enums\StatusEnum::Active->value)
    @push('script')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script>
            function onSubmit(token) {
                document.getElementById("contact-form").submit();
            }
        </script>
    @endpush
@endif
