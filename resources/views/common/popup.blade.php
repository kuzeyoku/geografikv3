@if ($popup)
@empty($_COOKIE['popup_view'])
    <div id="modal" style="display: none">
        @if ($popup->type == 'image')
            <a href="{{ $popup->url }}"><img class="w-100 img-fluid" src="{{ $popup->getFirstMediaUrl('cover') }}"></a>
        @elseif($popup->type == 'text')
            {!! $popup->description !!}
        @endif
    </div>
    @push('script')
        <link href="{{ themeAsset('common', 'css/iziModal.css') }}" rel="stylesheet">
        <script src="{{ themeAsset('common', 'js/iziModal.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var modalSettings = {
                    autoOpen: true,
                    title: '{{ $popup->title }}',
                    background: '{{ $popup->settings->color }}',
                    headerColor: '{{ $popup->settings->color }}',
                    closeOnEscape: {{ $popup->settings->closeOnEscape ? 'true' : 'false' }},
                    closeButton: {{ $popup->settings->closeButton ? 'true' : 'false' }},
                    fullscreen: {{ $popup->settings->fullScreenButton ? 'true' : 'false' }},
                    overlay: true,
                    iframe: {{ $popup->type == 'video' ? 'true' : 'false' }},
                    iframeURL: "{{ $popup->type == 'video' ? $popup->video : null }}",
                    overlayClose: {{ $popup->settings->overlayClose ? 'true' : 'false' }},
                    timeout: {{ $popup->settings->time * 1000 }},
                    timeoutProgressbar: {{ $popup->settings->time > 0 ? 'true' : 'false' }},
                    pauseOnHover: {{ $popup->settings->pauseOnHover ? 'true' : 'false' }},
                    width: {{ $popup->settings->width }},
                    borderBottom: false,
                }
                if ($.cookie("popup_view") === undefined) {
                    $("#modal").iziModal(modalSettings);
                }
            });

            $(document).on('closed', '#modal', function(e) {
                $.cookie("popup_view", "accepted", {
                    expires: 1,
                    path: '/'
                });
            });
        </script>
    @endpush
@endempty
@endif
