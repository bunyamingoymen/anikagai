@extends("admin.layouts.main")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" id="userCreateForm" action="{{route('admin_user_create')}}"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="name">İsim:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="İsim" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="surname">Soyisim:</label>
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Soyisim"
                                required>
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
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="user_type">Kullanıcı Grubu</label>
                            <select name="user_type" id="user_type" class="form-control">
                                @foreach ($users_groups as $group)
                                <option value="{{$group->code}}">{{$group->text}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="checkbox" name="admin" id="admin" checked>
                            <label for="admin">Yönetim Paneline Giriş Yetkisi</label>
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
        var password = document.getElementById("password").value;
        var password2 = document.getElementById("password2").value;
        if(password == password2)
            document.getElementById('userCreateForm').submit();
        else{
            Swal.fire({
                icon: "error",
                title: "Hata!",
                text: "Şifre ile Şifre Tekrarı uyuşmamaktadır.",
            });
        }
    }
</script>
@endsection