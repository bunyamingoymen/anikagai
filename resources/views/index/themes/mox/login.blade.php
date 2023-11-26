@extends("index.themes.mox.layouts.main")
@section('index_content')
<!-- main-area -->
<main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg" data-background="../../../user/img/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Giriş Yap</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('index')}}">Anasayfa</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Giriş Yap</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- contact-area -->
    <section class="contact-area contact-bg" data-background="../../../user/img/bg/contact_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="contact-form-wrap">
                        <div class="widget-title mb-50">
                            <h5 class="title">Giriş Yap</h5>
                        </div>
                        <div class="contact-form">
                            <form action="{{route('login')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="email" id="email" placeholder="E-mail *">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="password" name="password" id="password" placeholder="Şifre *">
                                    </div>
                                </div>
                                <button class="btn">Giriş Yap</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="contact-form-wrap">
                        <div class="widget-title mb-50">
                            <h5 class="title">Üye Ol</h5>
                        </div>
                        <div class="contact-form">
                            <form action="{{route('register')}}" method="POST" id="registerSubmitForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <small>  </small>
                                        <input type="text" name="name" id="registerName" placeholder="İsim *">
                                    </div>
                                    <div class="col-md-6">
                                        <small id="controlUsernameText"> </small>
                                        <input type="text" name="username" id="registerUsername"
                                            placeholder="Kullanıcı Adı *" onchange="controlUsername()">

                                    </div>
                                </div>
                                <small id="controlEmailText"> </small>
                                <input type="email" name="email" id="registerEmail" placeholder="E-mail *"
                                    onchange="controlEmail()">
                                <input type="password" name="password" id="registerPassword" placeholder="Şifre *">
                                <input type="password" name="password_repeat" id="registerPassword_repeat"
                                    placeholder="Şifre Tekrarı *">
                                <p id="registerMessageText" style="color: red;"></p>
                                <button class="btn" type="button" onclick="registerSubmitFormButton()">Üye Ol</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->


</main>
<!-- main-area-end -->
<script>
    var controlIsUsername = false;
    var controlIsEmail = false;
    function controlUsername(){
        var username = document.getElementById('registerUsername').value;
        if(username.length < 3){
            document.getElementById('controlUsernameText').innerText = "Kullanılamaz";
            document.getElementById('controlUsernameText').style.color = "red";
            controlIsUsername = false;
        }else{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{route("index_control_username")}}',
                data:{ username:username},
                success: function(control) {
                    if(control.control){
                        document.getElementById('controlUsernameText').innerText = "Kullanılabilir"
                        document.getElementById('controlUsernameText').style.color = "green";
                    }
                    else{
                        document.getElementById('controlUsernameText').innerText = "Kullanılamaz";
                        document.getElementById('controlUsernameText').style.color = "red";
                    }

                    controlIsUsername = control.control;
                }
            });
        }
    }

    function controlEmail(){
        var email = document.getElementById('registerEmail');
        var value = email.value;
        if(!email.checkValidity() || value.length == 0){
            document.getElementById('controlEmailText').innerText = "Kullanılamaz";
            document.getElementById('controlEmailText').style.color = "red";
            controlIsUsername = false;
        }else{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                type: 'POST',
                url: '{{route("index_control_email")}}',
                data:{ email:value},
                success: function(control) {
                    if(control.control){
                        document.getElementById('controlEmailText').innerText = "Kullanılabilir"
                        document.getElementById('controlEmailText').style.color = "green";
                    }
                    else{
                        document.getElementById('controlEmailText').innerText = "Kullanılamaz";
                        document.getElementById('controlEmailText').style.color = "red";
                    }

                    controlIsEmail = control.control;
                }
            });
        }
    }

    function registerSubmitFormButton(){
        var name = document.getElementById('registerName').value;
        var username = document.getElementById('registerUsername').value;
        var email = document.getElementById('registerEmail').value;
        var password = document.getElementById('registerPassword').value;
        var password_repeat = document.getElementById('registerPassword_repeat').value;

        if(name.length == 0 || username.length == 0 || email.length == 0 || password.length == 0 || password_repeat.length == 0){
            document.getElementById('registerMessageText').innerText = "Lütfen Tüm gerekli alanları doldurunuz.";
        }else if(controlIsUsername && controlIsEmail){
            document.getElementById('registerSubmitForm').submit();
        }else{
            if (!controlIsUsername) {
                document.getElementById('registerMessageText').innerText = "Bu Kullanıcı adı alınamaz";
            } else {
                document.getElementById('registerMessageText').innerText = "Bu E-mail adresi alınamaz";
            }
        }

    }
</script>
@endsection