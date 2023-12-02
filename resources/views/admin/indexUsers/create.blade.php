@extends("admin.layouts.main")
@section('admin_content')
@if($create == 1)
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" id="indexUserCreateForm" action="{{route('admin_indexuser_create')}}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="name">İsim:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="İsim" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="username">Kullanıcı Adı::</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Kullanıcı" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="password">Şifre:</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Şifre">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="password2">Şifre Tekrarı:</label>
                            <input type="password" class="form-control" id="password2" name="password2"
                                placeholder="Şifre Tekrarı">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="image">Resim:</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="Dosya Seçiniz">
                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="description">Açıklama:</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"
                                placeholder="Açıklama"></textarea>
                        </div>
                    </div>
                    <div style="float: right;">

                        <button class="btn btn-primary" type="button" onclick="createSubmitForm()">Kaydet</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function createSubmitForm(){
        var name = document.getElementById("name").value;
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var password2 = document.getElementById("password2").value;
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(name == "" || username == "" || email == "" || password == "" || password2 == ""){
            Swal.fire({
                icon: "error",
                title: "Hata!",
                text: "Lütfen Bütün yerleri doldurunuz.",
            });
        }
        else{
            if(password == password2 && emailPattern.test(email))
                document.getElementById('indexUserCreateForm').submit();
            else if(!emailPattern.test(email)){
                Swal.fire({
                    icon: "error",
                    title: "Hata!",
                    text: "Lütfen geçerli bir mail adresi giriniz.",
                });
            }else if(password != password2){
                Swal.fire({
                    icon: "error",
                    title: "Hata!",
                    text: "Şifre ile Şifre Tekrarı uyuşmamaktadır.",
                });
            }else{
                Swal.fire({
                    icon: "error",
                    title: "Hata!",
                    text: "Bir Hata Meydana Geldi. Error: 0x00018",
                });
            }
        }
    }
</script>
@endif
<script>
    // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
    window.addEventListener('DOMContentLoaded', (event) => {
        // Değişkenin değerini kontrol et
        @if ($create == 0)
            // Değişken doğru ise yönlendirme yap
            window.location.href = '{{route("admin_index")}}';
        @endif
    });
</script>


@endsection