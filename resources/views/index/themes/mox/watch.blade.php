@extends("index.themes.mox.layouts.main")
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

<!-- Plyr CSS -->
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />

<!-- Plyr JS -->
<script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>

<!-- main-area -->
<main>


    <!-- contact-area -->
    <section class="contact-area contact-bg" data-background="../../../user/mox/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="contact-form-wrap">
                        <div class="widget-title mb-50">
                            <h5 class="title">{{$anime->name}}</h5>
                        </div>
                        <div class="contact-form">
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
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

    <section class="blog-details-area blog-bg" data-background="../../../user/mox/img/bg/blog_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-comment mb-80">
                        <div class="widget-title mb-45">
                            <h5 class="title">Yorumlar</h5>
                        </div>
                        @if (count($comments_main)>0)
                        <ul>
                            @foreach ($comments_main as $main_comment)
                            <li>
                                <div class="single-comment">
                                    <div class="comment-avatar-img">
                                        <img src="../../../{{$main_comment->user_image ?? 'user/img/profile/default.png'}}"
                                            alt="img">
                                    </div>
                                    <div class="comment-text">
                                        <div class="comment-avatar-info">
                                            <h5>{{$main_comment->user_name ?? 'not_found'}} <span
                                                    class="comment-date">{{$main_comment->date}}</span>
                                            </h5>
                                        </div>

                                        <p>{{$main_comment->message}}</p>
                                    </div>

                                </div>
                                <a href="javascript:;" class="comment-reply-link"
                                    onclick="ReplyComment('AnswerMain{{$loop->index}}','{{$anime->code}}','1','1','{{$main_comment->code}}')">Cevapla
                                    <i class="fas fa-reply-all"></i></a>
                            </li>

                            <div id="AnswerMain{{$loop->index}}"></div>

                            @foreach ($comments_alt->Where('comment_top_code',$main_comment->code) as $alt_comment)
                            <li class="comment-reply">
                                <div class="single-comment">
                                    <div class="comment-avatar-img">
                                        <img src="../../../{{$alt_comment->user_image ?? 'user/img/profile/default.png'}}"
                                            alt="img">
                                    </div>
                                    <div class="comment-text">
                                        <div class="comment-avatar-info">
                                            <h5>{{$alt_comment->user_name ?? 'not_found'}} <span
                                                    class="comment-date">{{$alt_comment->date}}</span></h5>
                                        </div>
                                        <p>{{$alt_comment->message}}</p>
                                    </div>
                                </div>
                                <a href="javascript:;" class="comment-reply-link"
                                    onclick="ReplyComment('AnswerAltMain{{$loop->index}}','{{$anime->code}}','1','1','{{$main_comment->code}}')">Cevapla
                                    <i class="fas fa-reply-all"></i></a>
                            </li>
                            <div id="AnswerAltMain{{$loop->index}}"></div>
                            @endforeach
                            @endforeach
                        </ul>
                        @else
                        <p style="color:white;">İlk Yorum Yapan Siz Olun</p>
                        @endif
                    </div>
                    @if (Auth::user())
                    <div class="contact-form-wrap">
                        <div class="widget-title mb-50">
                            <h5 class="title">Yorum Yaz</h5>
                        </div>
                        <div class="contact-form">
                            <form action="{{route('addNewComment')}}" method="POST">
                                @csrf
                                <div hidden>
                                    <input type="text" name="content_code" value="{{$anime->code}}">
                                    <input type="text" name="content_type" value="1">
                                    <input type="text" name="comment_type" value="0">
                                    <input type="text" name="comment_top_code" value="0">
                                </div>
                                <textarea name="message" placeholder="Yorum..."></textarea>
                                <button class="btn" type='submit'>Gönder</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="contact-form-wrap">
                        <div class="widget-title mb-50">
                            <h5 class="title">Yorum Yazmak İçin İlk Önce Giriş Yapmalısınız</h5>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>


</main>
<!-- main-area-end -->
<script>
    @if (session('success'))
        document.getElementById('successMessage').innerText = "{{session('success')}}"
    @endif
</script>

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
        alert(commentDiv);
        if(commentDiv.innerHTML == ""){
            var html = `<li class="comment-reply"> <div class="contact-form">
                        <form action="{{route('addNewComment')}}" method="POST">
                            @csrf
                            <div hidden>
                                <input type="text" name="content_code" value="`+content_code+`">
                                <input type="text" name="content_type" value="`+content_type+`">
                                <input type="text" name="comment_type" value="`+comment_type+`">
                                <input type="text" name="comment_top_code" value="`+comment_top_code+`">
                            </div>
                            <textarea name="message" placeholder="Yorumunuz"></textarea>
                            <button class="btn" type='submit'>Gönder</button>
                        </form>
                </div> </li>` ;

            commentDiv.innerHTML = html;
        }else{
            commentDiv.innerHTML = "";
        }

    }
</script>
@endsection