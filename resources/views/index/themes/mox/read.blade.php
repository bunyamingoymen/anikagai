@extends("index.themes.mox.layouts.main")
@section('index_content')
<!-- main-area -->
<main>


    <!-- contact-area -->
    <section class="contact-area contact-bg" data-background="../../../user/mox/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="contact-form-wrap">
                        <div class="widget-title mb-50">
                            <h5 class="title">{{$webtoon->name}}</h5>
                        </div>
                        <div class="contact-form">
                            <div style="position: relative;">
                                <iframe id="myIframe" src="../../../{{$episode->file}}"
                                    style="width:100%; height:640px;" frameborder="0" allowfullscreen></iframe>
                                <button onclick="toggleFullScreen()">Tam Ekran</button>
                            </div>
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
                                    onclick="ReplyComment('AnswerMain{{$loop->index}}','{{$webtoon->code}}','0','1','{{$main_comment->code}}')">Cevapla
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
                                    onclick="ReplyComment('AnswerAltMain{{$loop->index}}','{{$webtoon->code}}','0','1','{{$main_comment->code}}')">Cevapla
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
                                    <input type="text" name="content_code" value="{{$webtoon->code}}">
                                    <input type="text" name="content_type" value="0">
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