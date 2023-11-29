@extends("index.themes.animex.layouts.main")
@section('index_content')
<style>
    /* Video konteynerini pozisyonlandırma */
    .video-container {
        position: relative;
    }

    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap');
    /* Roboto fontunu ekleyin veya
    kendi tercih ettiğiniz bir font kullanabilirsiniz */

    .overlay-button {
        position: absolute;
        bottom: 125px;
        /* Alt kenardan biraz yukarıda */
        right: 25px;
        /* Sağ kenardan biraz sola */
        padding: 4px 15px;
        background-color: #0b0c2a;
        /* Yarı şeffaf siyah arkaplan */
        color: white;
        border-radius: 8px;
        border: 2px solid rgba(255, 255, 255, 0.5);
        /* Beyaz yarı şeffaf sınır (border) */
        display: none;
        opacity: 0;
        transition: opacity 0.5s ease, transform 0.5s ease, border 0.5s ease;
        /* Border için de animasyon eklendi */
        box-shadow: 0 2px 10px #0b0c2a;
        /* Gölge efekti */
        font-family: 'Roboto', sans-serif;
        /* Kullanılan fontu ayarlayın */
        z-index: 99999999;
    }

    .overlay-button.show {
        display: block;
        opacity: 0.85;
        transform: translateY(-10px);
        /* Yavaşça yukarı kaydırma */
    }

    /* Butonun üzerine gelindiğinde göster */
    .video-container:hover .overlay-button {
        display: block;
    }
</style>

<section class="anime-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Plyr CSS -->
                <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />

                <!-- Plyr JS -->
                <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>

                <div class="anime__video__player justify-content-center">
                    <video id="my-video" class="plyr" controls crossorigin playsinline
                        poster="../../../{{$anime->image}}">
                        <source src="../../../{{$episode->video}}" type="video/mp4" size="720" />
                        <source src="../../../{{$episode->video}}" type="video/mp4" size="480" />
                        <!-- Diğer çözünürlükleri buraya ekleyebilirsiniz -->
                        Your browser does not support the video tag.
                    </video>

                    <!-- Buton -->
                    <button id="introButton" class="overlay-button">İntroyu atla</button>
                    <button id="nextEpisodeButton" class="overlay-button" style="display:none;">Sonraki bölüme
                        geç</button>
                </div>
            </div>
            <div class="anime__details__episodes">
                @if ($anime->season_count > 0)
                @for ($i = $anime->season_count; $i>=1; $i--)
                <div class="col-lg-8 col-md-8">

                    <div class="col-lg-12 col-md-12 anime__details__episodes">
                        <div class="section-title">
                            <h5>{{$i}}.sezon</h5>
                        </div>
                        @foreach ($anime_episodes->where('season_short',$i) as $item)
                        <a href="{{url("anime/".$anime->short_name."/".$i."/".$item->episode_short)}}">
                            {{$i}} - {{$item->episode_short }}.Bölüm - {{$item->name}}
                        </a>
                        @endforeach

                    </div>
                </div>
                @endfor
                @else
                <div class="col-lg-12 col-md-12 section-title">
                    <h5>Herhani gib bölüm mevcut değil.</h5>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">

                <div class="anime__details__review">
                    <div class="section-title">
                        <h5>Reviews</h5>
                    </div>
                    <div class="anime__review__item">
                        <div class="anime__review__item__pic">
                            <img src="../../../user/animex/img/anime/review-1.jpg" alt="">
                        </div>
                        <div class="anime__review__item__text">
                            <h6>Chris Curry - <span>1 Hour ago</span></h6>
                            <p>whachikan Just noticed that someone categorized this as belonging to the genre
                                "demons" LOL</p>
                        </div>
                    </div>
                    <div class="anime__review__item">
                        <div class="anime__review__item__pic">
                            <img src="../../../user/animex/img/anime/review-2.jpg" alt="">
                        </div>
                        <div class="anime__review__item__text">
                            <h6>Lewis Mann - <span>5 Hour ago</span></h6>
                            <p>Finally it came out ages ago</p>
                        </div>
                    </div>
                    <div class="anime__review__item">
                        <div class="anime__review__item__pic">
                            <img src="../../../user/animex/img/anime/review-3.jpg" alt="">
                        </div>
                        <div class="anime__review__item__text">
                            <h6>Louis Tyler - <span>20 Hour ago</span></h6>
                            <p>Where is the episode 15 ? Slow update! Tch</p>
                        </div>
                    </div>
                    <div class="anime__review__item">
                        <div class="anime__review__item__pic">
                            <img src="../../../user/animex/img/anime/review-4.jpg" alt="">
                        </div>
                        <div class="anime__review__item__text">
                            <h6>Chris Curry - <span>1 Hour ago</span></h6>
                            <p>whachikan Just noticed that someone categorized this as belonging to the genre
                                "demons" LOL</p>
                        </div>
                    </div>
                    <div class="anime__review__item">
                        <div class="anime__review__item__pic">
                            <img src="../../../user/animex/img/anime/review-5.jpg" alt="">
                        </div>
                        <div class="anime__review__item__text">
                            <h6>Lewis Mann - <span>5 Hour ago</span></h6>
                            <p>Finally it came out ages ago</p>
                        </div>
                    </div>
                    <div class="anime__review__item">
                        <div class="anime__review__item__pic">
                            <img src="../../../user/animex/img/anime/review-6.jpg" alt="">
                        </div>
                        <div class="anime__review__item__text">
                            <h6>Louis Tyler - <span>20 Hour ago</span></h6>
                            <p>Where is the episode 15 ? Slow update! Tch</p>
                        </div>
                    </div>
                </div>
                <div class="anime__details__form">
                    <div class="section-title">
                        <h5>Your Comment</h5>
                    </div>
                    <form action="#">
                        <textarea placeholder="Your Comment"></textarea>
                        <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 justify-content-end">
                <div class="anime__details__sidebar">
                    <div class="section-title">
                        <h5>Benzer İçerikler</h5>
                    </div>
                    @foreach ($trend_animes as $item)
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="product__item">
                            <a href="anime/{{$item->short_name}}">
                                <div class="product__item__pic set-bg" data-setbg="../../../{{$item->image}}">
                                    <div class="ep">{{$item->score}} / 5</div>
                                    <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                    <div class="view"><i class="fa fa-eye"></i> {{$item->click_count}} </div>
                                </div>
                            </a>
                            <div class="product__item__text">
                                <ul>
                                    <li>{{$item->main_category_name ?? 'Genel'}}</li>
                                </ul>
                                <h5><a href="webtoon/{{$item->short_name}}">{{$item->name}}</a></h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const player = new Plyr('#my-video');
        var showIntroButtonTime = 60 * 0 + 5; // Başlangıç zamanı
        var showNextEpisodeButtonTime = null; // Video süresinin son 10 saniyesi
        var restartRequired = false; // Video restart gerekli mi?

        // Video başlatıldığında
        player.on('play', function () {
            showNextEpisodeButtonTime = player.duration - 10;
        });

        // Video oynatıldığında
        player.on('timeupdate', function (event) {
            var currentTime = event.detail.plyr.currentTime; // Geçerli video zamanını al

            // Bitiş süreleri
            var endIntro1 = 0;
            var endIntro2 = 32;

            // Belirli bir sürede iseniz
            if (currentTime >= showIntroButtonTime && currentTime <= endIntro1 * 60 + endIntro2) {
                // Butonu göster
                showButton('introButton');

                // Video restart gerekli
                restartRequired = true;
            }else {
                // Butonları gizle
                hideButton('introButton');
                // Video restart gerekli değil
                restartRequired = false;
            }

            if (showNextEpisodeButtonTime !== null && currentTime >= showNextEpisodeButtonTime) {
                // Yeni butonu göster
                showButton('nextEpisodeButton');

                // Video restart gerekli değil
                restartRequired = false;
            } else {
                hideButton('nextEpisodeButton');

                // Video restart gerekli değil
                restartRequired = false;
            }
        });

        // Video restart olduğunda
        player.on('restart', function () {
            if (restartRequired) {
                var endIntro1 = 0;
                var endIntro2 = 32;
                var targetTime = endIntro1 * 60 + endIntro2;

                // Belirli bir süreye atla
                player.currentTime = targetTime;

                // Videoyu oynat
                player.play();

                // Video restart gerekli değil
                restartRequired = false;
            }
        });

        // Butonlara tıklandığında
        var introButton = document.getElementById('introButton');
        var nextEpisodeButton = document.getElementById('nextEpisodeButton');

        if (introButton) {
            introButton.addEventListener('click', function () {
                // Videoyu restart et
                player.restart();
            });
        }

        if (nextEpisodeButton) {
            nextEpisodeButton.addEventListener('click', function () {
                // Belirlediğiniz linke git
                window.location.href = 'https://example.com/next-episode'; // Değiştirin
            });
        }

        // Butonu göster
        function showButton(buttonId) {
            var button = document.getElementById(buttonId);
            if (button) {
                button.style.display = 'block';
                setTimeout(function () {
                    button.classList.add('show');
                }, 10); // Küçük bir gecikme ekleyerek yavaşça göster
            }
        }

        // Butonu gizle
        function hideButton(buttonId) {
            var button = document.getElementById(buttonId);
            if (button) {
                setTimeout(function () {
                    button.style.display = 'none';
                }, 500); // Gösterme animasyonunun tamamlanması için bir gecikme ekleyebilirsiniz
            }
        }
    });
</script>
@endsection