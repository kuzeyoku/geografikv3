<section class="main-slider">
    <div class="main-slider__carousel owl-carousel owl-theme">

        @foreach ($slider as $slider)
            <div class="item">
                <img src="{{ $slider->getFirstMediaUrl('cover') }}" alt="">
            </div>
        @endforeach
    </div>
</section>
