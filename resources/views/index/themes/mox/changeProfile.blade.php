@extends("index.themes.mox.layouts.main")
@section('index_content')
<!-- main-area -->
<main>

    <!-- contact-area -->
    <section class="contact-area contact-bg" data-background="../../../user/mox/img/bg/contact_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-4">
                    <div class="contact-form-wrap">
                        <div class="widget-title mb-50">
                            <h5 class="title">Resim Değiştir</h5>
                        </div>
                        <div class="contact-form">
                            <div class="../../../user/mox/movie-details-img">
                                <img src="../../../{{$user->image ?? 'user/img/profile/default.png'}}" alt=""
                                    style="min-width: 303px;  max-width: 303px;">
                                <div class="mt-5">
                                    <form action="{{route('change_profile_image')}}" id="changeProfileImageForm"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" id="imageInput" name="image" onchange="changeImageFileForm()"
                                            accept="image/*" hidden>
                                        <button class="btn" type="button" onclick="changeImageFile()">Resmi
                                            Değiştir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="contact-form-wrap">
                        <div class="widget-title mb-50">
                            <h5 class="title">Bilgileri Değiştir</h5>
                        </div>
                        <div class="contact-form">
                            <form action="{{route('change_profile_settings')}}" method="POST" id="changeProfileForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <small>  </small>
                                        <input type="text" name="name" id="registerName" placeholder="İsim *"
                                            value="{{$user->name}}">
                                    </div>
                                    <div class="col-md-12">
                                        <small id="controlUsernameText"> </small>
                                        <input type="text" name="username" id="registerUsername"
                                            placeholder="Kullanıcı Adı *" onchange="controlUsername()"
                                            value="{{$user->username}}">

                                    </div>
                                    <div class="col-md-12">
                                        <small id="controlEmailText"> </small>
                                        <input type="email" name="email" id="registerEmail" placeholder="E-mail *"
                                            onchange="controlEmail()" value="{{$user->email}}">

                                    </div>
                                </div>

                                <p id="controlEmailText" style="color: red;"></p>
                                <button class="btn" type="button" onclick="changeProfileFormButton()">Bilgileri
                                    Değiştir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->
</main>

<!-- JS here -->
<script src="../../../user/mox/js/vendor/jquery-3.6.0.min.js"></script>

<script>
    var controlIsUsername = true;
    var controlIsEmail = true;

    function controlUsername() {
        var username = document.getElementById("registerUsername").value;
        var code = "{{$user->code}}";
        var regex = /^[a-zA-Z0-9]+$/;
        if (username.length < 3) {
            document.getElementById("controlUsernameText").innerText =
                "Kullanılamaz";
            document.getElementById("controlUsernameText").style.color = "red";
            controlIsUsername = false;
        }else if(!regex.test(username)){
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