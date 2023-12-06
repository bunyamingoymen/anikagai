@extends("admin.layouts.main")
@section('admin_content')
@if (Auth::guard('admin')->user()->code == $user->code || $update == 1)
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" id="userUpdateForm" action="{{route('admin_user_update')}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div hidden>
                            <input type="text" name="code" id="code" value="{{$user->code}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="name">İsim:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="İsim"
                                value="{{$user->name}}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="surname">Soyisim:</label>
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Soyisim"
                                value="{{$user->surname}}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-Mail"
                                value="{{$user->email}}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="image">Resim:</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="Dosya Seçiniz"
                                accept="image/*">
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="user_type">Kullanıcı Grubu</label>
                            <select name="user_type" id="user_type" class="form-control">
                                @foreach ($users_groups as $group)
                                @if ($user->user_type == $group->code)
                                <option value="{{$group->code}}" selected>{{$group->text}}</option>
                                @else
                                <option value="{{$group->code}}">{{$group->text}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="description">Açıklama:</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="10"
                                placeholder="Açıklama">{{$user->description}}</textarea>
                        </div>
                    </div>
                    @if (Auth::guard('admin')->user()->code == $user->code || $update == 1)
                    <div class="row">
                        <div class="col-lg-6">
                            @if ($user->admin == 1)
                            <input type="checkbox" name="admin" id="admin" checked>
                            @else
                            <input type="checkbox" name="admin" id="admin">
                            @endif

                            <label for="admin">Yönetim Paneline Giriş Yetkisi</label>
                        </div>
                    </div>
                    <div class="row">
                        <h5>Sosyal Medya Linkleri</h5>
                        <div class="col-md-12 mb-3">
                            <label for="facebook-link">Facebook:</label>
                            <input type="text" name="facebook" id="facebook-link" class="form-control"
                                placeholder="Facebook Linki" value="{{$user->facebook ?? ''}}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="twitter-link">Twitter:</label>
                            <input type="text" name="twitter" id="twitter-link" class="form-control"
                                placeholder="Twitter Linki" value="{{$user->twitter ?? ''}}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="instagram-link">İnstagram:</label>
                            <input type="text" name="instagram" id="instagram-link" class="form-control"
                                placeholder="İnstagram Linki" value="{{$user->instagram ?? ''}}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="discord-link">Discord:</label>
                            <input type="text" name="discord" id="discord-link" class="form-control"
                                placeholder="Discord Linki" value="{{$user->discord ?? ''}}">
                        </div>
                    </div>
                    @endif
                    <div style="float: right;">

                        <button class="btn btn-primary" type="submit">Kaydet</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
<script>
    // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
    window.addEventListener('DOMContentLoaded', (event) => {
        // Değişkenin değerini kontrol et
        @if (Auth::guard('admin')->user()->code != $user->code && $update == 0)
            // Değişken doğru ise yönlendirme yap
            window.location.href = '{{route("admin_index")}}';
        @endif
    });
</script>

@endsection