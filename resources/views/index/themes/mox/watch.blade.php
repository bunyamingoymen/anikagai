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
        position: absolute !important;
        bottom: 75px !important;
        /* Alt kenardan biraz yukarıda */
        right: 25px !important;
        /* Sağ kenardan biraz sola */
        padding: 4px 15px !important;
        background-color: #0b0c2a;
        /* Yarı şeffaf siyah arkaplan */
        color: white;
        border-radius: 8px;
        border: 2px solid rgba(255, 255, 255, 0);
        /* Beyaz yarı şeffaf sınır (border) */
        opacity: 0;
        transition: opacity 0.5s ease, transform 0.1s ease, border 0.1s ease;
        /* Border için de animasyon eklendi */
        box-shadow: 0 2px 10px #0b0c2a;
        /* Gölge efekti */
        font-family: 'Roboto', sans-serif !important;
        /* Kullanılan fontu ayarlayın */
        z-index: 99999999;
    }

    .overlay-button:hover {
        opacity: 1;
        border: 2px solid rgba(255, 255, 255, 0.5);
    }

    .video_size_class {
        max-width: 1280px !important;
        max-height: 550px !important;
    }


    /* Butonun üzerine gelindiğinde göster */
    .video-container:hover .overlay-button {
        display: block;
    }
</style>

<!-- main-area -->
<main>


    <!-- contact-area -->
    <section class="contact-area contact-bg" data-background="../../../user/mox/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="contact-form-wrap">
                        <div class="widget-title mb-50">
                            <h5 class="title">{{$anime->name}} <span style="color:#e53637" {{$anime->plusEighteen ==
                                    "0" ? "hidden" : ""}}>+18</span></h5>
                        </div>
                        <div class="anime__video__player justify-content-center">
                            <video id="anime-video-player-url" class="plyr video_size_class" controls crossorigin
                                playsinline poster="../../../{{$anime->image}}">
                                <source src="../../../{{$episode->video}}" type="video/mp4" size="720" />
                                <!-- Diğer çözünürlükleri buraya ekleyebilirsiniz -->
                                Your browser does not support the video tag.
                            </video>

                            @if ($next_episode_url != "none")
                            <button id="nextEpisodeButton" class="overlay-button" style="display:none;" hidden>Sonraki
                                bölüme
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
                                    onclick="ReplyComment('AnswerMain{{$loop->index}}','{{$episode->code}}','1','1','{{$main_comment->code}}')">Cevapla
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
                                    <input type="text" name="anime_code" value="{{$anime->code}}">
                                    <input type="text" name="content_code" value="{{$episode->code}}">
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

<!-- İzleme ile ilgili fonksiyonlar -->
<script>
    function watchAnime(anime_episode_code){
        var anime_code = `{{$anime->code}}`;
        @if (Auth::user())
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
            });
            $.ajax({
                type: "POST",
                url: '{{ route("index_watched_anime") }}',
                data: {
                    anime_episode_code: anime_episode_code,
                    anime_code: anime_code,
                    content_type: 1
                }
            })
            .done(function (response) {
                if (response.response === 0) {
                    console.log('İşlem İçin Giriş Yapılması Gerekmektedir.');
                } else if (response.response === 1) {
                    console.log("Bölüm izlendi olarak işaretlendi");
                } else if (response.response === 2) {
                    console.log("Bölüm izlenmedi olarak işaretlendi");
                } else {
                    console.log('Bölüm izlendi olarak işaretlenirken beklenmedik bir hata meydana geldi');
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                console.log('AJAX hatası: ' + textStatus + ' - ' + errorThrown + ' - ' + JSON.stringify(jqXHR));
            });
        @else
            alert("İlk Önce Giriş yapmanız gerekmektedir.")
            document.getElementById(id).checked = false;
        @endif
    }
</script>

<!-- Video Ayarları -->
<script>
    var intro_start_time_min = {{$episode->intro_start_time_min ?? 0}}; // intr başlama zamanı dakikası
    var intro_start_time_sec = {{$episode->intro_start_time_sec ?? 0}}; // intro başlama saniyesi
    var showIntroButtonTime = 60 * intro_start_time_min + intro_start_time_sec; // İntro Başlangıç zamanı
    var intro_end_time_min = {{$episode->intro_end_time_min ?? 0}}; //intro bitiş zamanı dakikası
    var intro_end_time_sec = {{$episode->intro_end_time_sec ?? 1}}; //intro bitiş zamanı saniyesi
    var endIntroButtonTime = 60 * intro_end_time_min + intro_end_time_sec; // intro bitiş zamanı

    var is_show_intro_button = false; //Daha önce intryo atla butonu gösterildi mi?
    var is_hide_intro_button = false; //Daha önce introyu atla butonu gizlendi mi?

    var is_show_next_episode_button = false; //Daha önce bir sonraki bölüme atla butonu gösteirldi mi?

    //plyr de gösterilecek kontroller
    var controls = [
        'play-large', // ortadaki büyük başlat tuşu
        'play', // alttaki başlat tuşu
        'progress', // İlerleme Bölümü
        'current-time', // Şu anki zaman
        'duration', // Toplam zaman
        'mute', // Ses kapatma
        'volume', // Ses kontrol
        'settings', // Ayarler menüsü
        'fullscreen', // fullscreen tuşu
    ];

    var settings = [
        'play',
        'captions',
        'quality',
        'speed',
        'loop'
    ];

    var tooltips = { controls: false, seek: true };

    //plyr kütüphanesi elemanları
    document.addEventListener('DOMContentLoaded', function () {


        var player = new Plyr('#anime-video-player-url',{
            controls: controls,
            settings: settings,
            tooltips: tooltips,
        });

        //introButton oluşturuluyor
        var introButton = document.createElement('button');
        introButton.type = 'button';
        introButton.id = 'introButton';
        introButton.className = 'plyr__controls__item overlay-button'; // Plyr kontrol sınıfını ekleyin
        introButton.innerHTML = 'İntroyu Atla';
        introButton.hidden = true;
        document.getElementsByClassName('plyr__controls')[0].appendChild(introButton);

        //bir sonraki bölüm varsa. Sonraki bölüme atla butonu oluşturuluyor.
        @if ($next_episode_url != "none")
            var nextButton = document.createElement('button');
            nextButton.type = 'button';
            nextButton.id = 'nextEpisodeButton';
            nextButton.className = 'plyr__controls__item overlay-button'; // Plyr kontrol sınıfını ekleyin
            nextButton.innerHTML = 'Sonraki Bölüme Geç';
            nextButton.hidden = true;
            nextButton.style.display = "none";
            document.getElementsByClassName('plyr__controls')[0].appendChild(nextButton);
        @endif

        var showNextEpisodeButtonTime = null; // Video süresinin son 10 saniyesi
        var isFullScreen = false; //video tam ekranda mı?

        // Video başlatıldığında / durdurulup-başlatıldığında
        player.on('play', function () {
            showNextEpisodeButtonTime = player.duration - 60;
        });

        // Video oynatılırken
        player.on('timeupdate', function (event) {
            var currentTime = event.detail.plyr.currentTime; // Geçerli video zamanını al

            // İntro başlangıç zamanı ile bitiş zamanı arassında ise ve daha önce intro butonu gözükmediyse
            if ((currentTime >= showIntroButtonTime && currentTime <= endIntroButtonTime) && !is_show_intro_button) {
                // İntroyu atla butonunu göster
                showButton('introButton');
                is_show_intro_button = true;

                //intro Atla butonunun aktif olduğunu göstermek için control'ü gösteriyoruz. ve 3 saniye sonra gizliyoruz.
                document.getElementsByClassName('plyr--video')[0].classList.remove('plyr--hide-controls');
                controlsTimeout = setTimeout(() => {
                    document.getElementsByClassName('plyr--video')[0].classList.add('plyr--hide-controls');
                }, 3000); // 3000 milisaniye (3 saniye) sonra gizle
            }

            //introyu atla butonu daha önce gizlenmediyse ve şu anki zaamn introyu atla zamanını geçtiyse butonu gizler
            if (currentTime > endIntroButtonTime && !is_hide_intro_button) {
                // İntroyu atla butonunu gizle
                hideButton('introButton');
                is_hide_intro_button = true;
            }

            //bir sonraki bölüm varsa son saniyeler buton gözükür.

                //Video son 10 saniyesinde ve daah önce sonraki bölüme geç butonu gösterilmediyse
                if (showNextEpisodeButtonTime !== null && showNextEpisodeButtonTime <= currentTime && !is_show_next_episode_button) {

                    //Eğer Kullanıcı girşi yapmışsa otomatik olarak izlendi olarak işaretleniyor
                    @if (Auth::user() && count($watched->Where('anime_episode_code',$episode->code)) == 0)
                        watchAnime("{{$episode->code}}");
                    @endif

                    @if ($next_episode_url != "none")
                        showButton('nextEpisodeButton');
                        is_show_next_episode_button = true;

                        //Sonraki Bölüme Atla butonunun aktif olduğunu göstermek için control'ü gösteriyoruz. ve 3 saniye sonra gizliyoruz.
                        document.getElementsByClassName('plyr--video')[0].classList.remove('plyr--hide-controls');
                        controlsTimeout = setTimeout(() => {
                            document.getElementsByClassName('plyr--video')[0].classList.add('plyr--hide-controls');
                        }, 3000); // 3000 milisaniye (3 saniye) sonra gizle
                    @endif
                }


        });

        //video tam ekran butonuna basıldığında
        player.on('fullscreenchange', (event) => {
            if(isFullScreen){
                //tam ekrandan çıkıyor
                isFullScreen = false;
                document.getElementById('anime-video-player-url').classList.add('video_size_class');

            }
            else{
                //tam ekrana giriyor
                isFullScreen = true;
                document.getElementById('anime-video-player-url').classList.remove('video_size_class');

            }
        });

        //video yeniden başlatıldğında
        player.on('restart', function () {
            //Video yeniden başlatılırsa introyu atla ve sonraki bölüme atla değerleri sıfırlanması gerekmektedir.
            var is_show_intro_button = false;
            var is_hide_intro_button = false;
            var is_show_next_episode_button = false;

            hideButton('introButton');
            @if ($next_episode_url != "none")
                hideButton('nextEpisodeButton');
            @endif
        });

        //sayfa tamamen yüklendiğin
        $(document).ready(function () {
           // Butonlara tıklandığında
            var introButton = document.getElementById('introButton');

            //introButton tuşu varsa ve ona basılırsa
            if (introButton) {
                introButton.addEventListener('click', function () {
                    player.currentTime =endIntroButtonTime;
                });
            }

            //bir sonraki bölüm varsa ve ona basılırsa
            @if ($next_episode_url != "none")
                var nextEpisodeButton = document.getElementById('nextEpisodeButton');
                if (nextEpisodeButton) {
                    nextEpisodeButton.addEventListener('click', function () {
                        // Belirlediğiniz linke git
                        window.location.href = '{{url($next_episode_url)}}'; // bir sonraki bölüm url'i
                    });
                }
            @endif
        })

        // Butonu göster
        function showButton(buttonId) {
            var button = document.getElementById(buttonId);
            if (button) {
                opacity = 0;
                count = 0;
                button.hidden = false;
                button.style.display = "block";
                var old_opacity = button.style.opacity;
                if(old_opacity == 0){
                    var animationInterval = setInterval(function() {
                        if (count < 8)
                        {
                            count++; button.style.display='block' ;
                            opacity +=0.1; button.style.opacity=opacity;
                        } else {
                            clearInterval(animationInterval);
                        }
                    }, 10);
                }

            }
        }

        // Butonu gizle
        function hideButton(buttonId) {
            var button = document.getElementById(buttonId);
            if (button) {
                button.hidden = true;
                button.style.display = "none";
                button.opacity = 0;
            }
        }
    });

</script>

<!-- Yorum ayarları -->
<script>
    function ReplyComment(commentDiv, content_code, content_type, comment_type, comment_top_code){
        var commentDiv = document.getElementById(commentDiv);
        if(commentDiv.innerHTML == ""){
            var html = `<li class="comment-reply"> <div class="contact-form">
                        <form action="{{route('addNewComment')}}" method="POST">
                            @csrf
                            <div hidden>
                                <input type="text" name="anime_code" value="{{$anime->code}}">
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