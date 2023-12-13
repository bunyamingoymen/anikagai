@extends('index.themes.moviefx.layouts.main')
@section('index_content')
    <style>
        .comment-input {
            background-color: #111216;
            font-size: 13px;
            line-height: 1.9;
            color: #fff;
            font-family: circular, -apple-system, BlinkMacSystemFont, segoe ui, helvetica neue, Arial, sans-serif;
            border: 1px solid #1e2029;
            padding: 10px 15px;
            border-radius: 2px;
            box-shadow: none;
            display: block;
            height: auto;
            overflow: auto;
            cursor: text;
            margin-bottom: 1em;
            padding-right: 40px;
            width: 100%;
        }

        .comment-text {
            font-size: 14px;
        }
    </style>
    <div class="inner-content container" id="page-profile">
        <div id="router-view">
            <section class="user-profile bg-cover-faker">
                <div class="ui grid">
                    <div id="profile-content" class="floated sixteen wide tablet twelve wide computer column">
                        <div class="dark-segment">
                            <div class="alert alert-danger" role="alert">
                                <form action="{{ route('contact') }}" method="POST">
                                    @csrf
                                    <div style="padding-bottom: 100px;">
                                        <!--İsim-->
                                        <div>
                                            <small for="name" class="comment-text" style="color: white;">
                                                İsim:</small>
                                            <div>
                                                <input type="text" name="name" id="name" class="comment-input"
                                                    placeholder="İsim *" value="">
                                            </div>
                                        </div>

                                        <!--E-mail-->
                                        <div style="margin-top: 10px;">
                                            <small for="username" style="color: white;" class="comment-text">
                                                E-mail:</small>
                                            <div>
                                                <input type="email" name="email" id="email" class="comment-input"
                                                    placeholder="E-mail *">
                                                <small id="controlEmailText" class="comment-text"></small>
                                            </div>
                                        </div>

                                        <!--Konu-->
                                        <div>
                                            <small for="name" class="comment-text" style="color: white;">
                                                Konu:</small>
                                            <div>
                                                <input type="text" name="subject" id="subject" placeholder="Konu *"
                                                    class="comment-input">
                                            </div>
                                        </div>

                                        <!--Mesaj-->
                                        <div style="margin-top: 10px;">
                                            <small for="message" style="color: white;" class="comment-text">
                                                Mesajınız:</small>
                                            <div>
                                                <textarea name="message" placeholder="Mesaj Giriniz..." cols="30" rows="10" class="comment-input"></textarea>
                                                <small id="controlEmailText" class="comment-text"></small>
                                            </div>
                                        </div>

                                        <!--Buton-->
                                        <div style="margin-top: 10px; float: right;">
                                            <button type="submit" class="ui button primary">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i> Gönder
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        @if (session('success'))
            Swal.fire({
                title: "Başarılı!",
                text: "{{ session('success') }}",
                type: "success"
            });
        @endif
    </script>
@endsection
