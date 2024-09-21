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
                                            <h3>Ürünlerim</h3>
                                            <div class="product-tab-content">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist" data-aos="fade-up"
                                                    data-aos-duration="1000">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="all-products-tab"
                                                            data-bs-toggle="tab" data-bs-target="#all-products"
                                                            type="button" role="tab" aria-controls="all-products"
                                                            aria-selected="true">Tüm Ürünler</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="on-sales-tab" data-bs-toggle="tab"
                                                            data-bs-target="#on-sales" type="button" role="tab"
                                                            aria-controls="on-sales" aria-selected="false">Satışda</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="archive-products-tab"
                                                            data-bs-toggle="tab" data-bs-target="#archive-products"
                                                            type="button" role="tab"
                                                            aria-controls="archive-products"
                                                            aria-selected="false">Arşivlenmiş</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="not-approved-tab"
                                                            data-bs-toggle="tab" data-bs-target="#not-approved"
                                                            type="button" role="tab" aria-controls="not-approved"
                                                            aria-selected="false">Onaylanmamış</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent" data-aos="fade-up"
                                                    data-aos-duration="1300">
                                                    <div class="tab-pane fade show active" id="all-products"
                                                        role="tabpanel" aria-labelledby="all-products-tab">

                                                        <div class="row">
                                                            <div class="col-sm-6 col-md-4">
                                                                <!-- Start Product Item -->
                                                                <div class="product-item">
                                                                    <div class="product-thumb">
                                                                        <img src="assets/img/shop/1.png" alt="Image">
                                                                        <div class="product-action">
                                                                            <a class="action-quick-view"
                                                                                href="shop-cart.html"><i
                                                                                    class="ion-ios-cart"></i></a>
                                                                            <a class="action-quick-view"
                                                                                href="javascript:void(0)"><i
                                                                                    class="ion-arrow-expand"></i></a>
                                                                            <a class="action-quick-view"
                                                                                href="shop-wishlist.html"><i
                                                                                    class="ion-heart"></i></a>
                                                                            <a class="action-quick-view"
                                                                                href="shop-compare.html"><i
                                                                                    class="ion-shuffle"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <div class="rating">
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                        </div>
                                                                        <h4 class="title"><a
                                                                                href="shop-single-product.html">Funskool
                                                                                Teddy</a></h4>
                                                                        <div class="prices">
                                                                            <span class="price">$190.12</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Product Item -->
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <!-- Start Product Item -->
                                                                <div class="product-item">
                                                                    <div class="product-thumb">
                                                                        <img src="assets/img/shop/1.png" alt="Image">
                                                                        <div class="product-action">
                                                                            <a class="action-quick-view"
                                                                                href="shop-cart.html"><i
                                                                                    class="ion-ios-cart"></i></a>
                                                                            <a class="action-quick-view"
                                                                                href="javascript:void(0)"><i
                                                                                    class="ion-arrow-expand"></i></a>
                                                                            <a class="action-quick-view"
                                                                                href="shop-wishlist.html"><i
                                                                                    class="ion-heart"></i></a>
                                                                            <a class="action-quick-view"
                                                                                href="shop-compare.html"><i
                                                                                    class="ion-shuffle"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <div class="rating">
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                        </div>
                                                                        <h4 class="title"><a
                                                                                href="shop-single-product.html">Funskool
                                                                                Teddy</a></h4>
                                                                        <div class="prices">
                                                                            <span class="price">$190.12</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Product Item -->
                                                            </div>
                                                            <div class="col-sm-6 col-md-4">
                                                                <!-- Start Product Item -->
                                                                <div class="product-item">
                                                                    <div class="product-thumb">
                                                                        <img src="assets/img/shop/1.png" alt="Image">
                                                                        <div class="product-action">
                                                                            <a class="action-quick-view"
                                                                                href="shop-cart.html"><i
                                                                                    class="ion-ios-cart"></i></a>
                                                                            <a class="action-quick-view"
                                                                                href="javascript:void(0)"><i
                                                                                    class="ion-arrow-expand"></i></a>
                                                                            <a class="action-quick-view"
                                                                                href="shop-wishlist.html"><i
                                                                                    class="ion-heart"></i></a>
                                                                            <a class="action-quick-view"
                                                                                href="shop-compare.html"><i
                                                                                    class="ion-shuffle"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-info">
                                                                        <div class="rating">
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                        </div>
                                                                        <h4 class="title"><a
                                                                                href="shop-single-product.html">Funskool
                                                                                Teddy</a></h4>
                                                                        <div class="prices">
                                                                            <span class="price">$190.12</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- End Product Item -->
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="on-sales" role="tabpanel"
                                                        aria-labelledby="on-sales-tab">
                                                        <p>tab 2</p>
                                                    </div>
                                                    <div class="tab-pane fade" id="archive-products" role="tabpanel"
                                                        aria-labelledby="archive-products-tab">
                                                        <p>tab 3</p>
                                                    </div>
                                                    <div class="tab-pane fade" id="not-approved" role="tabpanel"
                                                        aria-labelledby="not-approved-tab">
                                                        <p>tab 4</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="add-new" role="tabpanel"
                                        aria-labelledby="download-tab">
                                        <div class="myaccount-content">
                                            <h3>Yeni Ürün Ekle</h3>
                                            <div class="account-details-form">
                                                <form action="{{ route('shop_user_change_user_information') }}"
                                                    method="POST">
                                                    @csrf
                                                    <fieldset>
                                                        <legend>Temel Bilgiler</legend>
                                                        <div class="single-input-item">
                                                            <label for="product_name" class="required">Ürün İsmi</label>
                                                            <input type="email" id="product_name" name="name"
                                                                value="" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="product_description"
                                                                class="required">Açıklama</label>
                                                            <textarea name="description" id="product_description" cols="75" rows="10"></textarea>
                                                        </div>
                                                        <div class="single-input-item row">
                                                            <label for="product_price" class="required">Ücret</label>
                                                            <input type="number" id="product_price"
                                                                class="product_price" name="price" value="" />
                                                            <select name="priceType" id="product_price_type"
                                                                class="product_price">
                                                                <option value="TRY">TRY</option>
                                                                <option value="USD">USD</option>
                                                                <option value="EUR">EUR</option>
                                                            </select>
                                                        </div>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Resimler</legend>
                                                        <div class="single-input-item">
                                                            <label for="product_main_image" class="required">Ana
                                                                Resim:</label>
                                                            <input type="file" id="product_main_image"
                                                                name="main_image" value="" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="product_images" class="required">Diğer
                                                                Resimler:</label>
                                                            <input type="file" id="product_images" name="images[]"
                                                                value="" multiple />
                                                        </div>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Kargo Bilgileri</legend>
                                                        <div class="single-input-item">
                                                            <label for="product_name" class="required">Kargo
                                                                Firması</label>
                                                            <select name="priceType" id="product_price_type"
                                                                class="product_price">
                                                                <option value="TRY">TRY</option>
                                                                <option value="USD">USD</option>
                                                                <option value="EUR">EUR</option>
                                                            </select>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="product_description" class="required">Kargo
                                                                Süresi(Kaç iş Günü?)</label>
                                                            <input type="number" id="product_images" name="images[]"
                                                                value="" multiple />
                                                        </div>
                                                        <div class="single-input-item row">
                                                            <label for="product_price" class="required">Kargo
                                                                Ücreti:</label>
                                                            <input type="number" id="product_price"
                                                                class="product_price" name="price" value="" />
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
                                                <form action="{{ route('shop_seller_change_seller_information') }}"
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
                                                            <label for="email" class="required">E-mail
                                                                Adresi</label>
                                                            <input type="text" id="email" name="email"
                                                                value="{{ $user->email ?? '' }}" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="phone" class="required">Telefon
                                                                Numarası</label>
                                                            <input type="text" id="phone" name="phone"
                                                                value="{{ $user->phone ?? '' }}" />
                                                        </div>
                                                    </fieldset>


                                                    <fieldset>
                                                        <legend>Açıklama</legend>
                                                        <div class="single-input-item">
                                                            <label for="description" class="required">Açıklama</label>
                                                            <input type="text" id="description" name="description"
                                                                value="{{ $user->description ?? '' }}" />
                                                        </div>
                                                    </fieldset>


                                                    <fieldset>
                                                        <legend>IBAN Bilgileri</legend>
                                                        <div class="single-input-item">
                                                            <label for="IBAN" class="required">IBAN</label>
                                                            <input type="text" id="IBAN" name="IBAN"
                                                                value="{{ $user->IBAN ?? '' }}" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="IBAN_Name" class="required">IBAN İsmi</label>
                                                            <input type="text" id="IBAN_Name" name="IBAN_Name"
                                                                value="{{ $user->IBAN_Name ?? '' }}" />
                                                        </div>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Sosyal Hesap Linklleri</legend>
                                                        <div class="single-input-item">
                                                            <label for="facebook" class="required">Facebook</label>
                                                            <input type="text" id="facebook" name="facebook"
                                                                value="{{ $user->facebook ?? '' }}" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="instagram" class="required">Instagram</label>
                                                            <input type="text" id="instagram" name="instagram"
                                                                value="{{ $user->instagram ?? '' }}" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="twitter" class="required">X (Twitter)</label>
                                                            <input type="text" id="twitter" name="twitter"
                                                                value="{{ $user->twitter ?? '' }}" />
                                                        </div>
                                                        <var>
                                                            <div class="single-input-item">
                                                                <label for="discord" class="required">Discord</label>
                                                                <input type="text" id="discord" name="discord"
                                                                    value="{{ $user->discord ?? '' }}" />
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="website" class="required">Website</label>
                                                                <input type="text" id="website" name="website"
                                                                    value="{{ $user->website ?? '' }}" />
                                                            </div>
                                                        </var>
                                                    </fieldset>

                                                    <fieldset>
                                                        <legend>Ayarlar</legend>
                                                        <div class="single-input-item">
                                                            <label for="max_cargo_price" class="required">Kaç TL üstü
                                                                kargo
                                                                ücretsiz?: (Eğer 0 tl yazarsanız bu özellik otomatik
                                                                olarak
                                                                devredışı olacaktır.)</label>
                                                            <input type="number" id="max_cargo_price"
                                                                name="max_cargo_price"
                                                                value="{{ $user->max_cargo_price }}" />
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
                                                <form action="{{ route('shop_seller_change_password') }}" method="POST">
                                                    @csrf
                                                    <fieldset>
                                                        <div class="single-input-item">
                                                            <label for="current-pwd" class="required">Mevcut
                                                                Şifre</label>
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
                                                                    <label for="confirm-pwd" class="required">Yeni
                                                                        Şifre
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
