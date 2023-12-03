@extends("index.themes.animex.layouts.main")
@section('index_content')

<!-- Login Section Begin -->
<section class="login spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="login__form login__form">
                    <h3>Resim:</h3>
                    <img src="../../../{{$user->image ?? 'user/img/profile/default.png'}}" alt=""
                        style="max-height: 200px; min-height: 200px;">
                    <form action="{{route('change_profile_image')}}" id="changeProfileImageForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="imageInput" name="image" onchange="changeImageFileForm()"
                            accept="image/*" hidden>
                        <button class="site-btn" type="button" onclick="changeImageFile()">Resmi Değiştir</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="login__form">
                    <h3>Bilgiler</h3>
                    <form action="{{route('change_profile_settings')}}" method="POST" id="changeProfileForm">
                        @csrf
                        <div class="input__item">
                            <input type="text" name="name" id="registerName" placeholder="İsim *"
                                value="{{$user->name}}">
                            <span class="icon_profile"></i></span>
                        </div>
                        <div class="input__item">

                            <div>
                                <input type="text" name="username" id="registerUsername" placeholder="Kullanıcı Adı *"
                                    onchange="controlUsername()" value="{{$user->username}}">
                                <span class="icon_profile"></span>
                            </div>
                            <small id="controlUsernameText"></small>
                        </div>
                        <div class="input__item">
                            <div>
                                <input type="email" name="email" id="registerEmail" placeholder="E-mail *"
                                    onchange="controlEmail()" value="{{$user->email}}">
                                <span class="icon_mail"></span>
                            </div>
                            <small id="controlEmailText"></small>
                        </div>
                        <button class="site-btn" type="button" onclick="changeProfileFormButton()">Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login Section End -->

<!-- Js Plugins -->
<script src="../../../user/animex/js/jquery-3.3.1.min.js"></script>

<script>
    var controlIsUsername = true;
    var controlIsEmail = true;

    function controlUsername() {
        var username = document.getElementById("registerUsername").value;
        var code = "{{$user->code}}";
        if (username.length < 3) {
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
                url: '{{route("index_control_username")}}',
                data: { username: username, code:code },
                success: function (control) {
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
        var code = "{{$user->code}}";
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
                url: '{{route("index_control_email")}}',
                data: { email: value , code: code},
                success: function (control) {
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
        }else {
            if (!controlIsUsername) {
                document.getElementById("controlEmailText").innerText =
                    "Bu Kullanıcı adı alınamaz";
            }  else {
                document.getElementById("controlEmailText").innerText =
                    "Bu E-mail adresi alınamaz";
            }
        }
    }

</script>
<!-- resim değiştirme işlemleri -->
<script>
    function changeImageFile(){
        document.getElementById('imageInput').click();
    }

    function changeImageFileForm(){
        document.getElementById('changeProfileImageForm').submit();
    }
</script>

@endsection