@if ($sliderShow->setting_value == '1')
    <!--CSS Dosyaları-->
    <link rel="stylesheet" href="../../../slider/rude/css/base.css">

    <link rel="stylesheet" href="../../../slider/rude/css/jquery.heroCarousel.css">

    <style>
        .slider-rude-button-container {
            display: flex;
            align-items: center;
            text-align: center;
            line-height: 1.6;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 15%;
            background-color: var(--two-color);
            padding: 10px;
            border: 1px solid var(--one-color);
            border-radius: 30px;
            box-sizing: content-box !important;
        }

        .slider-rude-button-container:hover {
            background-color: var(--one-color);
            color: var(--two-color) !important;
            /* Hover rengi */
        }
    </style>

    <!-- Rude Slider -->
    <section class="hero sliderrude">
        <div class="hero-carousel">
            @foreach ($slider_image as $index => $item)
                <article id="heroSlider{{ $index + 1 }}">
                    <img class="slider-image" src="../../../{{ $item->optional ?? '' }}" alt="slide 1" />
                    <div class="contents">
                        <h4 class="color-text">{{ $item->value }}</h4>
                        <p onclick="sliderButtonOnclick('{{ url($item->optional_2 ?? '') }}')"><span
                                class="slider-rude-button-container">
                                <span style="margin-left: 15%;">Şimdi İzle <i class="fa fa-angle-right"
                                        style="margin-left: 5px;"></span></span></i>
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <script src="../../../index/js/jquery_1.8.1.min.js"></script>
    <script src="../../../slider/rude/js/jquery.easing-1.3.js"></script>
    <script src="../../../slider/rude/js/hero/jquery.heroCarousel-1.3.js"></script>
    <script>
        $(function() {
            if ($('.hero-carousel').length > 0) {
                $('.hero-carousel').heroCarousel({
                    easing: 'easeOutExpo',
                    css3pieFix: true
                });
            }
        });

        function sliderButtonOnclick(url) {
            window.location.href = url;
        }
    </script>
@endif
