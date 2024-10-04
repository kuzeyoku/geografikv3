@extends("layout.main")
@section("content")
    @include("layout.breadcrumb",["title" =>__("front/contact.title"),"parent" => __("front/contact.title")])
    <div class="contact-area pt-145 pb-120">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-lg-4">
                    <div class="contact-address">
                        <div class="contact-heading">
                            <h4>@lang("front/contact.txt1")</h4>
                        </div>
                        <ul class="contact-address-list">
                            <li>
                                <div class="contact-list-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="contact-list-text">
                                    <span>
                                        <a href="tel:@setting("contact","phone")">@setting("contact","phone")</a>
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="contact-list-icon st-3">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-list-text">
                                    <span>
                                        <a href="mailto:@setting("contact","email")"><span>@setting("contact","email")</span></a>
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="contact-list-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-list-text">
                                    <span><a href="#">@setting("contact","address")</a></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="get-in-touch">
                        <div class="contact-heading">
                            <h4>@lang("front/contact.txt2")</h4>
                        </div>
                        {{html()->form()->route("contact.send")->class("contact-form")->id("contact-form")->open()}}
                        <div class="row">
                            <div class="col-lg-6 mb-30">
                                {{html()->text("name")->placeholder(__("front/contact.txt3"))->required()}}
                                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-6 mb-30">
                                {{html()->email("email")->placeholder(__("front/contact.txt4"))->required()}}
                                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-6 mb-30">
                                {{html()->text("phone")->placeholder(__("front/contact.txt5"))->required()}}
                                @error('phone')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-lg-6 mb-30">
                                {{html()->text("subject")->placeholder(__("front/contact.txt6"))->required()}}
                                @error('subject')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 mb-30">
                                {{html()->textarea("message")->placeholder(__("front/contact.txt7"))->required()}}
                                @error('message')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                {{html()->button(__("front/contact.txt8"))->class("g-recaptcha")->data("sitekey",setting("integration","recaptcha_site_key"))->data("callback","onSubmit")->data("action","submit")}}
                            </div>
                        </div>
                        {{html()->form()->close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-map-area">
        <iframe src="@setting("contact","map")"></iframe>
    </div>
@endsection
@include('common.alert')
@if (setting("integration","recaptcha_status") == App\Enums\StatusEnum::Active->value)
    @push('script')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script>
            function onSubmit(token) {
                const form = document.getElementById("contact-form");
                if (form.checkValidity()) {
                    form.submit();
                } else {
                    form.reportValidity();
                }
            }
        </script>
    @endpush
@endif
