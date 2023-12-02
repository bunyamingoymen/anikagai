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


                <div class="anime__video__player justify-content-center">
                    <video id="my-video" class="plyr" controls crossorigin playsinline
                        poster="../../../{{$anime->image}}"
                        style="max-width: 1280px !important; max-height: 550px !important;">
                        <source src="../../../{{$episode->video}}" type="video/mp4" size="720" />
                        <source src="../../../{{$episode->video}}" type="video/mp4" size="480" />
                        <!-- Diğer çözünürlükleri buraya ekleyebilirsiniz -->
                        Your browser does not support the video tag.
                    </video>

                    <!-- Buton -->
                    <button id="introButton" class="overlay-button">İntroyu atla</button>
                    @if ($next_episode_url != "none")
                    <button id="nextEpisodeButton" class="overlay-button" style="display:none;">Sonraki bölüme
                        geç</button>
                    @endif

                </div>
            </div>
            <div class="anime__details__episodes">
                @if ($anime->season_count > 0)
                @for ($i = $anime->season_count; $i>=1; $i--)
                <div class="">

                    <div class=" anime__details__episodes">
                        <div class="section-title">
                            <h5>{{$i}}.sezon</h5>
                        </div>
                        <div class="">
                            @foreach ($anime_episodes->where('season_short',$i) as $item)
                            @if ($item->season_short == $episode->season_short && $item->episode_short ==
                            $episode->episode_short)
                            <a class="a_selected" href="{{url("anime/".$anime->short_name."/".$i."/".$item->episode_short)}}">
                                {{$i}} - {{$item->episode_short }}.Bölüm - {{$item->name}}
                            </a>
                            @else
                            @if (count($watched) > 0 && ($watched->Where('anime_episode_code',$item->code)->first()))
                            <a style="background-color: green;" class="a_selected" href="{{url("anime/".$anime->short_name."/".$i."/".$item->episode_short)}}">
                                {{$i}} - {{$item->episode_short }}.Bölüm - {{$item->name}}
                            </a>
                            @else
                            <a class="" href="{{url("anime/".$anime->short_name."/".$i."/".$item->episode_short)}}">
                                {{$i}} - {{$item->episode_short }}.Bölüm - {{$item->name}}
                            </a>
                            @endif
                            @endif

                            @endforeach
                        </div>
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
                        <h5>Yorumlar</h5>
                    </div>
                    @if (count($comments_main)>0)
                    @foreach ($comments_main as $main_comment)
                    <div class="anime__review__item">
                        <div class="anime__review__item__pic">
                            <img src="../../../{{$main_comment->user_image ?? 'user/img/profile/default.png'}}" alt="">
                        </div>
                        <div class="anime__review__item__text">
                            <h6>{{$main_comment->user_name ?? 'not_found'}} - <span>{{$main_comment->date}}</span></h6>
                            <p>{{$main_comment->message}}</p>

                            <a href="javascript:;" style="color:white; float:right;"
                                onclick="ReplyComment('AnswerMain{{$loop->index}}','{{$anime->code}}','1','1','{{$main_comment->code}}')">
                                <i class="fa fa-reply" aria-hidden="true"></i> Reply
                            </a>
                        </div>
                    </div>
                    <div id="AnswerMain{{$loop->index}}"></div>
                    @foreach ($comments_alt->Where('comment_top_code',$main_comment->code) as $alt_comment)
                    <div class="blog__details__comment__item blog__details__comment__item--reply">
                        <div class="anime__review__item__pic">
                            <img src="../../../{{$alt_comment->user_image ?? 'user/img/profile/default.png'}}" alt="">
                        </div>
                        <div class="anime__review__item__text">
                            <h6>{{$alt_comment->user_name ?? 'not_found'}} - <span>{{$alt_comment->date}}</span>
                            </h6>
                            <p>{{$alt_comment->message}}</p>

                            <a href="javascript:;" style="color:white; float:right;"
                                onclick="ReplyComment('AnswerAltMain{{$loop->index}}','{{$anime->code}}','1','1','{{$main_comment->code}}')">
                                <i class="fa fa-reply" aria-hidden="true"></i> Reply
                            </a>
                        </div>
                    </div>
                    <div id="AnswerAltMain{{$loop->index}}"></div>
                    @endforeach
                    @endforeach
                    @else
                    <p style="color: white;">İlk yorum atan siz olun!</p>
                    @endif

                </div>
                @if (Auth::user())
                <div class="anime__details__form">
                    <div class="section-title">
                        <h5>Yorum Yaz</h5>
                    </div>
                    <form action="{{route('addNewComment')}}" method="POST">
                        @csrf
                        <div hidden>
                            <input type="text" name="content_code" value="{{$anime->code}}">
                            <input type="text" name="content_type" value="1">
                            <input type="text" name="comment_type" value="0">
                            <input type="text" name="comment_top_code" value="0">
                        </div>
                        <textarea name="message" placeholder="Yorumunuz"></textarea>
                        <button type="submit"><i class="fa fa-location-arrow"></i> Gönder</button>
                    </form>
                </div>
                @else
                <div class="anime__details__form">
                    <div class="section-title">
                        <h5>Yorum Yapabilmeniz İçin Giriş Yapmalısınız.</h5>
                    </div>
                </div>
                @endif
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
                                    <div class="comment"><i class="fa fa-comments"></i> {{$item->comment_count}}</div>
                                    <div class="view"><i class="fa fa-eye"></i> {{$item->click_count}} </div>
                                </div>
                            </a>
                            <div class="product__item__text">
                                <ul>
                                    <li>{{$item->main_category_name ?? 'Genel'}}</li>
                                </ul>
                                <h5><a href="{{url('anime/'.$item->short_name)}}">{{$item->name}}</a></h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Ayarları -->
<script>
    var intro_start_time_min = {{$episode->intro_start_time_min ?? 0}};
    var intro_start_time_sec = {{$episode->intro_start_time_sec ?? 0}};
    var intro_end_time_min = {{$episode->intro_end_time_min ?? 0}};
    var intro_end_time_sec = {{$episode->intro_end_time_sec ?? 1}};

    document.addEventListener('DOMContentLoaded', function () {
        const player = new Plyr('#my-video');
        var showIntroButtonTime = 60 * intro_start_time_min + intro_start_time_sec; // Başlangıç zamanı
        var showNextEpisodeButtonTime = null; // Video süresinin son 10 saniyesi
        var restartRequired = false; // Video restart gerekli mi?

        // Video başlatıldığında
        player.on('play', function () {
            showNextEpisodeButtonTime = player.duration - 10;
        });

        // Video oynatıldığında
        player.on('timeupdate', function (event) {
            var currentTime = event.detail.plyr.currentTime; // Geçerli video zamanını al

            // Belirli bir sürede iseniz
            if (currentTime >= showIntroButtonTime && currentTime <= intro_end_time_min * 60 + intro_end_time_sec) {
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
                @if ($next_episode_url != "none")
                    showButton('nextEpisodeButton');
                @endif


                // Video restart gerekli değil
                restartRequired = false;
            } else {
                @if ($next_episode_url != "none")
                    hideButton('nextEpisodeButton');
                @endif


                // Video restart gerekli değil
                restartRequired = false;
            }
        });

        // Video restart olduğunda
        player.on('restart', function () {
            if (restartRequired) {

                var targetTime = intro_end_time_min * 60 + intro_end_time_sec;

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


        if (introButton) {
            introButton.addEventListener('click', function () {
                // Videoyu restart et
                player.restart();
            });
        }
        @if ($next_episode_url != "none")
            var nextEpisodeButton = document.getElementById('nextEpisodeButton');
                if (nextEpisodeButton) {
                    nextEpisodeButton.addEventListener('click', function () {
                    // Belirlediğiniz linke git
                    window.location.href = '{{url($next_episode_url)}}'; // bir sonraki bölüm url'i
                });
            }
        @endif


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

<!-- Yorum ayarları -->
<script>
    function ReplyComment(commentDiv, content_code, content_type, comment_type, comment_top_code){
    var commentDiv = document.getElementById(commentDiv);
    if(commentDiv.innerHTML == ""){
        var html = `<div class="blog__details__comment__item blog__details__comment__item--reply">
                <div class="anime__details__form">
                    <form action="{{route('addNewComment')}}" method="POST">
                        @csrf
                        <div hidden>
                            <input type="text" name="content_code" value="`+content_code+`">
                            <input type="text" name="content_type" value="`+content_type+`">
                            <input type="text" name="comment_type" value="`+comment_type+`">
                            <input type="text" name="comment_top_code" value="`+comment_top_code+`">
                        </div>
                        <textarea name="message" placeholder="Yorumunuz"></textarea>
                        <button style="float:right;" type="submit"><i class="fa fa-location-arrow"></i>
                            Gönder</button>
                    </form>
                </div>
            </div>`;

    commentDiv.innerHTML = html;
    }else{
        commentDiv.innerHTML = "";
    }

}
</script>
@endsection