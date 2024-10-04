@if (setting('information','cookie_notification_status') == App\Enums\StatusEnum::Active->value)
    @empty($_COOKIE['cookie_notification'])
        <div class="cookie" id="cookie-notification" style="display:none">
            <img src="{{ themeAsset('common', 'images/cookie.svg') }}" alt="cookie">
            <div class="title">
                {{ __('front/cookie.txt1') }}
            </div>
            <div class="description">
                {!! __('front/cookie.txt2', [
                    'url' => $cookie_policy_page_url,
                ]) !!}
            </div>
            <button class="cookie-btn" id="cookie-accept">{{ __('front/cookie.txt3') }}</button>
        </div>
        <script>
            $(document).ready(function () {
                $("#cookie-notification").show("slow");
            });

            $(document).on("click", "#cookie-accept", function () {
                $.cookie("cookie_notification", "accepted", {
                    expires: 1,
                    path: "/"
                });
                $("#cookie-notification").hide("slow");
            });
        </script>
    @endempty
@endif
