@extends('shop.themes.kidol.layouts.main')
@section('shop_body')
    @php
        $user = Auth::guard('shop_sellers')->user();
    @endphp
    <!--== Start My Account Wrapper ==-->
    <section class="my-account-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="section-title text-center">
                        <h2 class="title">My account</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <nav>
                                    <div class="myaccount-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="account-tab" data-bs-toggle="tab"
                                            data-bs-target="#account" type="button" role="tab" aria-controls="account"
                                            aria-selected="true">Hesabım</button>

                                        <button class="nav-link" id="products-tab" data-bs-toggle="tab"
                                            data-bs-target="#products" type="button" role="tab"
                                            aria-controls="products" aria-selected="false"> Ürünlerim</button>

                                        <button class="nav-link" id="add-new-tab" data-bs-toggle="tab"
                                            data-bs-target="#add-new" type="button" role="tab" aria-controls="add-new"
                                            aria-selected="false">Yeni Ürün Ekle</button>

                                        <button class="nav-link" id="account-info-tab" data-bs-toggle="tab"
                                            data-bs-target="#account-info" type="button" role="tab"
                                            aria-controls="account-info" aria-selected="false">Hesap Bilgilerimi
                                            Güncelle</button>

                                        <button class="nav-link" id="change-password-tab" data-bs-toggle="tab"
                                            data-bs-target="#change-password" type="button" role="tab"
                                            aria-controls="change-password" aria-selected="false">Şifremi Değiştir</button>

                                        <a class="nav-link" href="{{ route('shop_seller_logout') }}">Çıkış Yap</a>
                                    </div>
                                </nav>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="account" role="tabpanel"
                                        aria-labelledby="dashboad-tab">
                                        <div class="myaccount-content">
                                            <h3>Hesap Bilgilerim</h3>

                                            <div>
                                                <p>E-posta Adresim: {{ $user->email ?? 'Mevcut Değil' }}</p>
                                            </div>
                                            <br>
                                            <div>
                                                <p>Kullanıcı Adım: {{ $user->username ?? 'Mevcut Değil' }}</p>
                                            </div>
                                            <br>
                                            <div>
                                                <p>Telefonum: {{ $user->phone ?? 'Mevcut Değil' }}</p>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="products" role="tabpanel"
                                        aria-labelledby="products-tab">
                                        <div class="myaccount-content">
                                            <h3>Siparişlerim</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Sipariş</th>
                                                            <th>Tarih</th>
                                                            <th>Durum</th>
                                                            <th>Ücret</th>
                                                            <th>Görüntüle</th>
                                                            <th>Arşivle</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Aug 22, 2018</td>
                                                            <td>Pending</td>
                                                            <td>$3000</td>
                                                            <td>
                                                                <a href="shop-cart.html"
                                                                    class="check-btn sqr-btn mr-5">Görüntüle</a>
                                                            </td>
                                                            <td>

                                                                <a href="shop-cart.html"
                                                                    class="check-btn sqr-btn ">Arşivle</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>July 22, 2018</td>
                                                            <td>Approved</td>
                                                            <td>$200</td>
                                                            <td>
                                                                <a href="shop-cart.html"
                                                                    class="check-btn sqr-btn mr-5">Görüntüle</a>
                                                            </td>
                                                            <td>

                                                                <a href="shop-cart.html"
                                                                    class="check-btn sqr-btn ">Arşivle</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>June 12, 2017</td>
                                                            <td>On Hold</td>
                                                            <td>$990</td>
                                                            <td>
                                                                <a href="shop-cart.html"
                                                                    class="check-btn sqr-btn mr-5">Görüntüle</a>
                                                            </td>
                                                            <td>

                                                                <a href="shop-cart.html"
                                                                    class="check-btn sqr-btn ">Arşivle</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="add-new" role="tabpanel"
                                        aria-labelledby="download-tab">
                                        <div class="myaccount-content">
                                            <h3>Hesap Detayı</h3>
                                            <div class="account-details-form">
                                                <form action="{{ route('shop_user_change_user_information') }}"
                                                    method="POST">
                                                    @csrf
                                                    <fieldset>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="name" class="required">İsim</label>
                                                                    <input type="text" id="name" name="name"
                                                                        value="{{ $user->name }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="surname" class="required">Soyisim</label>
                                                                    <input type="text" id="surname" name="surname"
                                                                        value="{{ $user->surname }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="username" class="required">Kullanıcı
                                                                        Adı</label>
                                                                    <input type="text" id="username" name="username"
                                                                        value="{{ $user->username }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="show_name" class="required">Görünür
                                                                        İsim</label>
                                                                    <input type="text" id="show_name" name="show_name"
                                                                        value="{{ $user->show_name }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">E-mail Adresi</label>
                                                            <input type="email" id="email" name="email"
                                                                value="{{ $user->email }}" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="phone" class="required">Telefon
                                                                Numarası</label>
                                                            <input type="phone" id="phone" name="phone"
                                                                value="{{ $user->phone }}" />
                                                        </div>
                                                    </fieldset>
                                                    <fieldset>
                                                        <legend>Password change</legend>
                                                        <div class="single-input-item">
                                                            <label for="description" class="required">Açıklama</label>
                                                            <input type="email" id="description" name="description"
                                                                value="{{ $user->description }}" />
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item">
                                                        <button class="check-btn sqr-btn" type='submit'>Bilgileri
                                                            Değiştir</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="account-info" role="tabpanel"
                                        aria-labelledby="account-info-tab">
                                        <div class="myaccount-content">
                                            <h3>Hesap Detayı</h3>
                                            <div class="account-details-form">
                                                <form action="{{ route('shop_user_change_user_information') }}"
                                                    method="POST">
                                                    @csrf

                                                    <fieldset>
                                                        <legend>Temel Bilgiler</legend>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="username" class="required">Kullanıcı
                                                                        Adı</label>
                                                                    <input type="text" id="username" name="username"
                                                                        value="{{ $user->username ?? '' }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="show_name" class="required">Görünür
                                                                        İsim</label>
                                                                    <input type="text" id="show_name" name="show_name"
                                                                        value="{{ $user->show_name ?? '' }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">E-mail Adresi</label>
                                                            <input type="email" id="email" name="email"
                                                                value="{{ $user->email ?? '' }}" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="phone" class="required">Telefon
                                                                Numarası</label>
                                                            <input type="phone" id="phone" name="phone"
                                                                value="{{ $user->phone ?? '' }}" />
                                                        </div>
                                                    </fieldset>


                                                    <fieldset>
                                                        <legend>Açıklama</legend>
                                                        <div class="single-input-item">
                                                            <label for="description" class="required">Açıklama</label>
                                                            <input type="email" id="description" name="description"
                                                                value="{{ $user->description ?? '' }}" />
                                                        </div>
                                                    </fieldset>


                                                    <fieldset>
                                                        <legend>IBAN Bilgileri</legend>
                                                        <div class="single-input-item">
                                                            <label for="IBAN" class="required">IBAN</label>
                                                            <input type="email" id="IBAN" name="IBAN"
                                                                value="{{ $user->IBAN ?? '' }}" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="IBAN_Name" class="required">IBAN İsmi</label>
                                                            <input type="email" id="IBAN_Name" name="IBAN_Name"
                                                                value="{{ $user->IBAN_Name ?? '' }}" />
                                                        </div>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Sosyal Hesap Linklleri</legend>
                                                        <div class="single-input-item">
                                                            <label for="facebook" class="required">Facebook</label>
                                                            <input type="email" id="facebook" name="facebook"
                                                                value="{{ $user->facebook ?? '' }}" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="instagram" class="required">Instagram</label>
                                                            <input type="email" id="instagram" name="instagram"
                                                                value="{{ $user->instagram ?? '' }}" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="twitter" class="required">X (Twitter)</label>
                                                            <input type="email" id="twitter" name="twitter"
                                                                value="{{ $user->twitter ?? '' }}" />
                                                        </div>
                                                        <var>
                                                            <div class="single-input-item">
                                                                <label for="discord" class="required">Discord</label>
                                                                <input type="email" id="discord" name="discord"
                                                                    value="{{ $user->discord ?? '' }}" />
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="website" class="required">Website</label>
                                                                <input type="email" id="website" name="website"
                                                                    value="{{ $user->description ?? '' }}" />
                                                            </div>
                                                        </var>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Ayarlar</legend>
                                                        <div class="single-input-item">
                                                            <label for="description" class="required">Kaç TL üstü kargo
                                                                ücretsiz?: (Eğer 0 tl yazarsanız bu özellik otomatik olarak
                                                                devredışı olacaktır.)</label>
                                                            <input type="email" id="description" name="description"
                                                                value="{{ $user->description }}" />
                                                        </div>
                                                    </fieldset>

                                                    <div class="single-input-item">
                                                        <button class="check-btn sqr-btn" type='submit'>Bilgileri
                                                            Değiştir</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="change-password" role="tabpanel"
                                        aria-labelledby="account-info-tab">
                                        <div class="myaccount-content">
                                            <h3>Şifremi Değiştir</h3>
                                            <div class="account-details-form">
                                                <form action="{{ route('shop_user_change_password') }}" method="POST">
                                                    @csrf
                                                    <fieldset>
                                                        <div class="single-input-item">
                                                            <label for="current-pwd" class="required">Mevcut Şifre</label>
                                                            <input type="password" id="current-pwd"
                                                                name="current_password" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="new-pwd" class="required">Yeni
                                                                        Şifre</label>
                                                                    <input type="password" id="new-pwd"
                                                                        name="new_password" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="confirm-pwd" class="required">Yeni Şifre
                                                                        Tekrarı</label>
                                                                    <input type="password" id="confirm-pwd"
                                                                        name="new_password_repeat" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item">
                                                        <button class="check-btn sqr-btn" type="submit">Şifremi
                                                            Değiştir</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== End My Account Wrapper ==-->
    <script src="{{ url('shop_files/assets/js/jquery-main.js') }}"></script>
    <script></script>
@endsection
