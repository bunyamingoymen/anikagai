@extends('shop.themes.kidol.layouts.main')
@section('shop_body')
    @php
        $user = Auth::guard('shop_users')->user();
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

                                        <button class="nav-link" id="orders-tab" data-bs-toggle="tab"
                                            data-bs-target="#orders" type="button" role="tab" aria-controls="orders"
                                            aria-selected="false"> Siparişlerim</button>

                                        <button class="nav-link" id="addresses-tab" data-bs-toggle="tab"
                                            data-bs-target="#addresses" type="button" role="tab"
                                            aria-controls="addresses" aria-selected="false">Adreslerim</button>

                                        <button class="nav-link" id="account-info-tab" data-bs-toggle="tab"
                                            data-bs-target="#account-info" type="button" role="tab"
                                            aria-controls="account-info" aria-selected="false">Hesap Bilgilerimi
                                            Güncelle</button>

                                        <button class="nav-link" id="change-password-tab" data-bs-toggle="tab"
                                            data-bs-target="#change-password" type="button" role="tab"
                                            aria-controls="change-password" aria-selected="false">Şifremi Değiştir</button>

                                        <button class="nav-link" onclick="window.location.href='login-register.html'"
                                            type="button">Çıkış Yap</button>
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

                                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
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

                                    <div class="tab-pane fade" id="addresses" role="tabpanel"
                                        aria-labelledby="download-tab">
                                        <div class="myaccount-content">
                                            <h3>Adreslerim</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Adress Adı</th>
                                                            <th>Adress</th>
                                                            <th>Güncelle</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Kidol - Kids Toys Store eCommerce Template</td>
                                                            <td>Aug 22, 2022</td>
                                                            <td><a href="#/" class="check-btn sqr-btn"><i
                                                                        class="fa fa-edit"></i> Adresi Güncelle</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>HasTech - Profolio Business Template</td>
                                                            <td>Sep 12, 2022</td>
                                                            <td><a href="#/" class="check-btn sqr-btn"><i
                                                                        class="fa fa-edit"></i> Adresi Güncelle</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <a href="#/" class="check-btn sqr-btn"><i class="fa fa-edit"></i>
                                                    Adres Ekle</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="account-info" role="tabpanel"
                                        aria-labelledby="account-info-tab">
                                        <div class="myaccount-content">
                                            <h3>Hesap Detayı</h3>
                                            <div class="account-details-form">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="name" class="required">İsim</label>
                                                                <input type="text" id="name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="surname" class="required">Soyisim</label>
                                                                <input type="text" id="surname" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="username" class="required">Kullanıcı Adı</label>
                                                        <input type="text" id="username" />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="email" class="required">E-mail Adresi</label>
                                                        <input type="email" id="email" />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="phone" class="required">Telefon Numarası</label>
                                                        <input type="phone" id="phone" />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <button class="check-btn sqr-btn">Bilgileri Değiştir</button>
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
                                                <form action="#">
                                                    <fieldset>
                                                        <div class="single-input-item">
                                                            <label for="current-pwd" class="required">Current
                                                                Password</label>
                                                            <input type="password" id="current-pwd" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="new-pwd" class="required">New
                                                                        Password</label>
                                                                    <input type="password" id="new-pwd" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="confirm-pwd" class="required">Confirm
                                                                        Password</label>
                                                                    <input type="password" id="confirm-pwd" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item">
                                                        <button class="check-btn sqr-btn">Şifremi Değiştir</button>
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
@endsection
