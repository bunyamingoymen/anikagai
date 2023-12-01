@extends("index.themes.animex.layouts.main")
@section('index_content')

<section class="anime-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="anime__video__player justify-content-center">
                    <div style="position: relative;">
                        <iframe id="myIframe" src="../../../{{$episode->file}}" style="width:1080px; height:640px;"
                            frameborder="0" allowfullscreen></iframe>
                        <button onclick="toggleFullScreen()">Tam Ekran</button>
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
                            <a href="{{url("webtoon/".$webtoon->short_name."/".$i."/".$item->episode_short)}}">
                                {{$i}} - {{$item->episode_short }}.Bölüm - {{$item->name}}
                            </a>
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
                                onclick="ReplyComment('AnswerMain{{$loop->index}}','{{$webtoon->code}}','1','1','{{$main_comment->code}}')">
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
                                onclick="ReplyComment('AnswerAltMain{{$loop->index}}','{{$webtoon->code}}','1','1','{{$main_comment->code}}')">
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
                            <input type="text" name="content_code" value="{{$webtoon->code}}">
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