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
                        <!--Tab butonları-->
                        <div class="ui top tabular menu">
                            <a id="tabButtonInfo" class="item tabButton active" href="javascript:;"
                                onclick="changeTab('tabButtonInfo', 'profile-info')">
                                Bilgiler</a>
                            <a id="tabButtonProfilePicture" class="item tabButton" href="javascript:;"
                                onclick="changeTab('tabButtonProfilePicture', 'profile-profile-picture')">
                                Profil Fotoğrafı</a>

                            <a id="tabButtonPassword" class="item tabButton" href="javascript:;"
                                onclick="changeTab('tabButtonPassword', 'profile-password')">
                                Şifre</a>
                        </div>

                        <!--Bilgiler-->
                        <div class="ui bottom attached tab segment active" id="profile-info">
                            <div class="dark-segment">
                                <div class="alert alert-danger" role="alert">
                                    <form action="{{ route('change_profile_settings') }}" method="POST"
                                        id="changeProfileForm">
                                        @csrf
                                        <div style="padding-bottom: 100px;">
                                            <!--İsim-->
                                            <div>
                                                <small for="username" class="comment-text" style="color: white;">
                                                    İsim:</small>
                                                <div>
                                                    <input type="text" name="name" id="registerName"
                                                        class="comment-input" placeholder="İsim *"
                                                        value="{{ $user->name }}">
                                                </div>
                                            </div>

                                            <!--Kullanıcı Adı-->
                                            <div style="margin-top: 10px;">
                                                <small for="username" class="comment-text" style="color: white;"> Kullanıcı
                                                    Adı:</small>
                                                <div>
                                                    <input type="text" name="username" id="registerUsername"
                                                        class="comment-input" placeholder="Kullanıcı Adı *"
                                                        onchange="controlUsername()" value="{{ $user->username }}">
                                                    <small id="controlUsernameText" class="comment-text"></small>
                                                </div>
                                            </div>

                                            <!--E-mail-->
                                            <div style="margin-top: 10px;">
                                                <small for="username" style="color: white;" class="comment-text">
                                                    E-mail:</small>
                                                <div>
                                                    <input type="email" name="email" id="registerEmail"
                                                        class="comment-input" placeholder="E-mail *"
                                                        onchange="controlEmail()" value="{{ $user->email }}">
                                                    <small id="controlEmailText" class="comment-text"></small>
                                                </div>
                                            </div>

                                            <!--Buton-->
                                            <div style="margin-top: 10px; float: right;">
                                                <button class="ui button primary" type="button"
                                                    onclick="changeProfileFormButton()">Güncelle</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--Profil Fotoğrafı-->
                        <div class="ui bottom attached tab segment" id="profile-profile-picture">
                            <div class="dark-segment">
                                <div class="alert alert-danger" role="alert">
                                    <img src="../../../{{ $user->image ?? 'user/img/profile/default.png' }}" alt=""
                                        style="max-height: 200px; min-height: 200px;">
                                    <form action="{{ route('change_profile_image') }}" id="changeProfileImageForm"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" id="imageInput" name="image"
                                            onchange="changeImageFileForm()" accept="image/*" hidden>
                                        <button class="ui button primary" style="margin-top: 10px;" type="button"
                                            onclick="changeImageFile()">Resmi
                                            Değiştir</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--Şifre-->
                        <div class="ui bottom attached tab segment" id="profile-password">
                            <div class="dark-segment">
                                <div class="alert alert-danger" role="alert">
                                    <form action="{{ route('change_profile_password') }}" method="POST"
                                        id="changePasswordForm">
                                        @csrf
                                        <span style="color:red;" id="ErrorTextMessage"></span>
                                        <div style="padding-bottom: 100px;">
                                            <!--İsim-->
                                            <div>
                                                <small for="old_password" class="comment-text" style="color: white;">
                                                    Eski Şifre:</small>
                                                <div>
                                                    <input type="password" name="old_password" id="old_password"
                                                        class="comment-input" placeholder="Eski Şifre *">
                                                </div>
                                            </div>

                                            <!--Kullanıcı Adı-->
                                            <div style="margin-top: 10px;">
                                                <small for="password" class="comment-text" style="color: white;">
                                                    Şifre:</small>
                                                <div>
                                                    <input type="password" name="password" id="password"
                                                        class="comment-input" placeholder="Yeni Şifre *">
                                                </div>
                                            </div>

                                            <!--E-mail-->
                                            <div style="margin-top: 10px;">
                                                <small for="password_repeat" style="color: white;" class="comment-text">
                                                    Şifre Tekrarı:</small>
                                                <div>
                                                    <input type="password" name="password_repeat" id="password_repeat"
                                                        class="comment-input" placeholder="Yeni Şifre Tekrarı *">
                                                    <small id="controlEmailText" class="comment-text"></small>
                                                </div>
                                            </div>

                                            <!--Buton-->
                                            <div style="margin-top: 10px; float: right;">
                                                <button class="ui button primary" type="button"
                                                    onclick="changePasswordFormButton()">Güncelle</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>

    <!--Tab değiştirme scripti-->
    <script>
        var activeTabID =
            "profile-info";
        var activeButtonID =
            "tabButtonInfo";

        function changeTab(clickButtonID, tabSectionID) {
            document.getElementById(activeTabID).classList.remove("active");
            document.getElementById(activeButtonID).classList.remove("active");

            document.getElementById(tabSectionID).classList.add("active");
            document.getElementById(clickButtonID).classList.add("active");

            activeTabID = tabSectionID;
            activeButtonID = clickButtonID;
        }
    </script>

    <!--E-mail ya da şifre değiştirme-->
    <script>
        var controlIsUsername = true;
        var controlIsEmail = true;

        function controlUsername() {
            var username = document.getElementById("registerUsername").value;
            var code = "{{ $user->code }}";
            var regex = /^[a-zA-Z0-9]+$/;
            if (username.length < 3) {
                document.getElementById("controlUsernameText").innerText =
                    "Kullanılamaz";
                document.getElementById("controlUsernameText").style.color = "red";
                controlIsUsername = false;
            } else if (!regex.test(username)) {
                document.getElementById("controlUsernameText").innerText =
                    "Kullanılamaz";
                document.getElementById("controlUsernameText").style.color = "red";
                controlIsUsername = false;
            } else {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                });
                $.ajax({
                    type: "POST",
                    url: '{{ route('index_control_username') }}',
                    data: {
                        username: username,
                        code: code
                    },
                    success: function(control) {
                        if (control.control) {
                            document.getElementById("controlUsernameText").innerText =
                                "Kullanılabilir";
                            document.getElementById("controlUsernameText").style.color =
                                "green";
                        } else {
                            document.getElementById("controlUsernameText").innerText =
                                "Kullanılamaz";
                            document.getElementById("controlUsernameText").style.color =
                                "red";
                        }

                        controlIsUsername = control.control;
                    },
                });
            }
        }

        function controlEmail() {
            var email = document.getElementById("registerEmail");
            var code = "{{ $user->code }}";
            var value = email.value;
            if (!email.checkValidity() || value.length == 0) {
                document.getElementById("controlEmailText").innerText = "Kullanılamaz";
                document.getElementById("controlEmailText").style.color = "red";
                controlIsUsername = false;
            } else {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                });
                $.ajax({
                    type: "POST",
                    url: '{{ route('index_control_email') }}',
                    data: {
                        email: value,
                        code: code
                    },
                    success: function(control) {
                        if (control.control) {
                            document.getElementById("controlEmailText").innerText =
                                "Kullanılabilir";
                            document.getElementById("controlEmailText").style.color =
                                "green";
                        } else {
                            document.getElementById("controlEmailText").innerText =
                                "Kullanılamaz";
                            document.getElementById("controlEmailText").style.color =
                                "red";
                        }

                        controlIsEmail = control.control;
                    },
                });
            }
        }

        function changeProfileFormButton() {
            var name = document.getElementById("registerName").value;
            var username = document.getElementById("registerUsername").value;
            var email = document.getElementById("registerEmail").value;
            if (
                name.length == 0 ||
                username.length == 0 ||
                email.length == 0
            ) {
                document.getElementById("controlEmailText").innerText =
                    "Lütfen Tüm gerekli alanları doldurunuz.";
            } else if (controlIsUsername && controlIsEmail) {
                document.getElementById("changeProfileForm").submit();
            } else {
                if (!controlIsUsername) {
                    document.getElementById("controlEmailText").innerText =
                        "Bu Kullanıcı adı alınamaz";
                } else {
                    document.getElementById("controlEmailText").innerText =
                        "Bu E-mail adresi alınamaz";
                }
            }
        }
    </script>

    <!-- resim değiştirme işlemleri -->
    <script>
        function changeImageFile() {
            document.getElementById('imageInput').click();
        }

        function changeImageFileForm() {
            document.getElementById('changeProfileImageForm').submit();
        }
    </script>

    <!--Şifre-->
    <script>
        @if (session('error'))
            Swal.fire({
                title: "Hata!",
                text: "{{ session('error') }}",
                type: "error"
            });
        @endif
        function changePasswordFormButton() {
            var old_password = document.getElementById("old_password").value;
            var password = document.getElementById("password").value;
            var password_repeat = document.getElementById("password_repeat").value;

            if (
                old_password.length == 0 ||
                password.length == 0 ||
                password_repeat.length == 0
            ) {

                Swal.fire({
                    title: "Hata!",
                    text: "Lütfen Tüm gerekli alanları doldurunuz.",
                    type: "error"
                });
            } else if (password == password_repeat) {
                document.getElementById("changePasswordForm").submit();
            } else {
                document.getElementById("ErrorTextMessage2").innerText =
                    Swal.fire({
                        title: "Hata!",
                        text: "Şifre İle Şifre Tekrarı Uyuşmamaktadır.",
                        type: "error"
                    });
            }
        }
    </script>
@endsection
