@extends('admin.layouts.main')
@section('admin_content')
    @php
        use Illuminate\Support\Facades\Route;

        $currentRouteName = Route::currentRouteName();

        $auth = $currentRouteName == 'admin_shop_category_create' ? $create : $update;
    @endphp
    @if ($auth == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <form class="needs-validation" id="EditForm" action="{{ route('admin_shop_seller_save') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($item))
                                <div hidden>
                                    <input type="text" id="code" name="code" value="{{ $item->code }}" required>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="show_name">Görünür İsim:</label>
                                    <input type="text" class="form-control" id="show_name" name="show_name"
                                        placeholder="Görünür İsim" value="{{ $item->show_name ?? '' }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="username">Kullanıcı Adı:</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Kullanıcı Adı" value="{{ $item->username ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="E-Mail" value="{{ $item->email ?? '' }}" required>
                                </div>
                            </div>
                            @if (!isset($item))
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password">Şifre:</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Şifre" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password2">Şifre Tekrarı:</label>
                                        <input type="password" class="form-control" id="password2" name="password2"
                                            placeholder="Şifre Tekrarı" required>
                                    </div>
                                </div>
                            @endif
                            <div>
                                <div class="col-md-12 mb-3">
                                    <label for="description">Açıklama:</label>
                                    <textarea class="form-control" id="description" name="description" cols="30" rows="10">{{ $item->description ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="phone">Telefon Numarası:</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Telefon Numarası" value="{{ $item->phone ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="facebook">Facebook:</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook"
                                        placeholder="Facebook" value="{{ $item->facebook ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="instagram">Instagram:</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram"
                                        placeholder="Telefon Numarası" value="{{ $item->instagram ?? '' }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="twitter">X (Twitter)</label>
                                    <input type="text" class="form-control" id="twitter" name="twitter"
                                        placeholder="X (Twitter)" value="{{ $item->twitter ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="discord">Discord:</label>
                                    <input type="text" class="form-control" id="discord" name="discord"
                                        placeholder="Discord" value="{{ $item->discord ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="website">Website:</label>
                                    <input type="text" class="form-control" id="website" name="website"
                                        placeholder="Website" value="{{ $item->website ?? '' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="image">Resim:</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Dosya Seçiniz" accept="image/*">
                                </div>
                            </div>

                            @if (isset($item) && isset($item->image) && $item->image != '')
                                <div class="row mb-5">
                                    <div class="col-md-4 mb-3">
                                        <div>
                                            <label for="">Aktif Resim:</label>
                                        </div>
                                        <div>
                                            <img src="{{ url($item->image ?? '') }}" alt="$item->code"
                                                style="max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div style="float: right;">

                                <button class="btn btn-primary" type="button"
                                    onclick="createSubmitForm()">Kaydet</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function createSubmitForm() {
                var show_name = document.getElementById("show_name").value;
                var username = document.getElementById("username").value;
                var email = document.getElementById("email").value;
                @if (isset($item))
                    var password = "1";
                    var password2 = "1";
                @else
                    var password = document.getElementById("password").value;
                    var password2 = document.getElementById("password2").value;
                @endif

                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (show_name == "" || username == "" || email == "" || password == "" || password2 == "") {
                    Swal.fire({
                        icon: "error",
                        title: "Hata!",
                        text: "Lütfen Bütün yerleri doldurunuz.",
                    });
                } else {
                    if (password == password2 && emailPattern.test(email))
                        document.getElementById('EditForm').submit();
                    else if (!emailPattern.test(email)) {
                        Swal.fire({
                            icon: "error",
                            title: "Hata!",
                            text: "Lütfen geçerli bir mail adresi giriniz.",
                        });
                    } else if (password != password2) {
                        Swal.fire({
                            icon: "error",
                            title: "Hata!",
                            text: "Şifre ile Şifre Tekrarı uyuşmamaktadır.",
                        });
                    } else {
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
            @if ($auth == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
