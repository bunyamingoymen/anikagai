@extends('index.themes.mox.layouts.main')
@section('index_content')
    <!-- contact-area -->
    <section class="contact-area contact-bg" data-background="../../../user/mox/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="contact-form-wrap">
                        <div class="widget-title mb-50">
                            <h5 class="title">Takvim
                            </h5>
                        </div>
                        <div class="contact-form">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="tr-movie-menu-active text-center">
                                        @if ($data['anime_active']->value == 1)
                                            <button class="tab-favorite-anime-button active"
                                                data-filter=".tab-anime-calendar">Anime Takvimi</button>
                                        @endif
                                        @if ($data['webtoon_active']->value == 1)
                                            <button class="tab-favorite-webtoon-button"
                                                data-filter=".tab-webtoon-calendar">Webtoon
                                                Takvimi</button>
                                        @endif
                                    </div>
                                    <div class="row tr-movie-active">
                                        @if ($data['anime_active']->value == 1)
                                            <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-anime-calendar">
                                                <p>Anime takvimi</p>
                                            </div>
                                        @endif

                                        @if ($data['webtoon_active']->value == 1)
                                            <div class="col-xl-3 col-lg-4 col-sm-6 grid-item grid-sizer tab-webtoon-calendar"
                                                style="display:none;">
                                                <p>Webtoon takvimi</p>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

    <script>
        var webtoon_button = document.getElementsByClassName('tab-favorite-webtoon-button')[0];
        var webtoon_calendar = document.getElementsByClassName('tab-webtoon-calendar')[0];

        webtoon_button.addEventListener('click', () => {
            webtoon_calendar.style.display = 'block';
        });
    </script>
@endsection
