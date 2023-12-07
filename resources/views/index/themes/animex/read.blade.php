@extends("index.themes.animex.layouts.main")
@section('index_content')

<style>
    .overlay-button {
        position: absolute !important;
        bottom: 75px !important;
        /* Alt kenardan biraz yukarıda */
        right: 75px !important;
        /* Sağ kenardan biraz sola */
        padding: 4px 15px !important;
        background-color: #0b0c2a;
        /* Yarı şeffaf siyah arkaplan */
        color: white;
        border-radius: 8px;
        border: 2px solid rgba(255, 255, 255, 0);
        /* Beyaz yarı şeffaf sınır (border) */
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

    @media only screen and (max-width: 479px) {
        .overlay-button {
            opacity: 0;
            display: none;
        }
    }
</style>

<section class="anime-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="anime__details__review">
                    <div class="section-title" {{$webtoon->plusEighteen == "0" ? "hidden" : ""}}>
                        <h5 style="color:#e53637">+18</h5>
                    </div>
                </div>
                <div class="justify-content-center">
                    <div style="position: relative; justify-content-center">
                        @foreach ($files as $item)
                        @if ($item->file_type=="pdf")
                        <iframe id="myIframe" src="../../../{{$item->file}}"
                            style="max-width: 100%; min-width: 100%; height:800px;" frameborder="0"
                            allowfullscreen></iframe>
                        <button onclick="toggleFullScreen()" class="overlay-button">Tam Ekran</button>
                        @else
                        <img src="../../../{{$item->file}}" alt="{{$item->code}}"
                            style="max-width: 50%; position: relative; left:25%;">
                        @endif
                        @endforeach
                    </div>
                    <div id="document-viewer"></div>
                </div>
            </div>
            <div class="anime__details__episodes">
                @if ($webtoon->season_count > 0)
                @for ($i = $webtoon->season_count; $i>=1; $i--)
                <div class="">

                    <div class=" anime__details__episodes">
                        <div class="section-title">
                            <h5>{{$i}}.sezon</h5>
                        </div>
                        <div class="">
                            @foreach ($webtoon_episodes->where('season_short',$i) as $item)
                            @if ($item->season_short == $episode->season_short && $item->episode_short ==
                            $episode->episode_short)
                            <a class="a_selected" href="{{url("webtoon/".$webtoon->short_name."/".$i."/".$item->episode_short)}}">
                                {{$i}} - {{$item->episode_short }}.Bölüm - {{$item->name}}
                            </a>
                            @else
                            @if (count($watched) > 0 &&
                            count($watched->Where('anime_episode_code',$webtoon_episodes->code)->get())>1)
                            <a style="background-color: green;" class="a_selected" href="{{url("webtoon/".$webtoon->short_name."/".$i."/".$item->episode_short)}}">
                                {{$i}} - {{$item->episode_short }}.Bölüm - {{$item->name}}
                            </a>
                            @else
                            <a class="" href="{{url("webtoon/".$webtoon->short_name."/".$i."/".$item->episode_short)}}">
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
                    <h5>Herhangi bir bölüm mevcut değil.</h5>
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
                            <h6>
                                <a style="color:#fff;" href={{url('profile?username='.$main_comment->user_username)}}>
                                    {{$main_comment->user_name ?? ' not_found'}} </a>
                                    - <span>{{$main_comment->date}}</span>
                            </h6>
                            <p>{{$main_comment->message}}</p>

                            <a href="javascript:;" style="color:white; float:right;"
                                onclick="ReplyComment('AnswerMain{{$loop->index}}','{{$episode->code}}','0','1','{{$main_comment->code}}')">
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
                            <h6>
                                <a style="color:#fff;" href={{url('profile?username='.$alt_comment->user_username)}}>
                                    {{$alt_comment->user_name ?? ' not_found'}} </a>
                                    - <span>{{$alt_comment->date}}</span>
                            </h6>
                            <p>{{$alt_comment->message}}</p>

                            <a href="javascript:;" style="color:white; float:right;"
                                onclick="ReplyComment('AnswerAltMain{{$loop->index}}','{{$episode->code}}','0','1','{{$main_comment->code}}')">
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
                            <input type="text" name="webtoon_code" value="{{$webtoon->code}}">
                            <input type="text" name="content_code" value="{{$episode->code}}">
                            <input type="text" name="content_type" value="0">
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
                    @foreach ($trend_webtoons as $item)
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="product__item">
                            <a href="{{url('webtoon/'.$item->short_name)}}">
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
                                <h5><a href="{{url('webtoon/'.$item->short_name)}}">{{$item->name}}</a></h5>
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
    function toggleFullScreen() {
        var iframe = document.getElementById('myIframe');
        if (!document.fullscreenElement) {
            iframe.requestFullscreen();
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }
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
                                <input type="text" name="webtoon_code" value="{{$webtoon->code}}">
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