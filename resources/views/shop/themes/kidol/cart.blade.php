@extends('shop.themes.kidol.layouts.main')
@section('shop_body')
    <!--== Start Cart Area Wrapper ==-->
    <section class="product-area cart-page-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="section-title text-center">
                        <h2 class="title">Cart</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table-wrap">
                        <div class="cart-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="width-thumbnail"></th>
                                        <th class="width-name">Ürün</th>
                                        <th class="width-price"> Fiyat</th>
                                        <th class="width-quantity">Adet</th>
                                        <th class="width-subtotal">Toplam Fiyat</th>
                                        <th class="width-remove"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cargoPrice = 0;
                                        $totalPriceTRY = 0;
                                        $totalPriceUSD = 0;
                                        $totalPriceEUR = 0;
                                    @endphp
                                    @foreach ($products['items'] as $product)
                                        @php
                                            $image_path = $product->image_path ?? '';
                                            $image_path = url($image_path);

                                            if ($product->priceType == 'USD') {
                                                $totalPriceTRY += $product->price;
                                                $priceType = '$';
                                            } elseif ($product->priceType == 'EUR') {
                                                $totalPriceEUR += $product->price;
                                                $priceType = '€';
                                            } else {
                                                $totalPriceUSD += $product->price;
                                                $priceType = '₺';
                                            }

                                            $cart_text =
                                                isset($product->cart_product_code) &&
                                                ($product->cart_product_code = $product->code)
                                                    ? 'Sepetten Çıkar'
                                                    : 'Sepete Ekle';
                                        @endphp
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="{{ route('shop_product_detail', ['code' => $product->code]) }}"><img
                                                        src="{{ url($image_path) }}" alt="Image"></a>
                                            </td>
                                            <td class="product-name">
                                                <h5><a
                                                        href="{{ route('shop_product_detail', ['code' => $product->code]) }}">{{ $product->name }}</a>
                                                </h5>
                                            </td>
                                            <td class="product-price"><span class="amount">{{ $product->price }}
                                                    {{ $priceType }}</span></td>
                                            <td class="cart-quality">
                                                <div class="product-details-quality">
                                                    <input type="number" class="input-text qty text" step="1"
                                                        min="1" max="100" name="quantity" value="1"
                                                        title="Qty" placeholder="">
                                                </div>
                                            </td>
                                            <td class="product-total"><span>{{ $product->price }} {{ $priceType }}</span>
                                            </td>
                                            <td class="product-remove"><a
                                                    href="{{ route('shop_add_cart') }}?product_code={{ $product->code }}"><i
                                                        class="ion-ios-trash-outline"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="cart-shiping-update-wrapper">
                        <div class="cart-shiping-btn continure-btn">
                            <a class="btn btn-link" href="shop.html"><i class="ion-ios-arrow-left"></i>Alışverişe devam
                                et</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="cart-calculate-discount-wrap mb-40">
                        <h4>Kupon Kodu </h4>
                        <div class="calculate-discount-content">
                            <p>Mevcut Kupon Kodunuzu Giriniz.</p>
                            <div class="input-style">
                                <input type="text" placeholder="Coupon code">
                            </div>
                            <div class="calculate-discount-btn">
                                <a class="btn btn-link" href="#/">Kupon Kodu</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="grand-total-wrap">
                        <div class="grand-total-content">
                            @php
                                $totalPrice = $totalPriceTRY + $totalPriceUSD + $totalPriceEUR;
                            @endphp
                            <h3>Ürünlerin Toplam Ücreti: <span>{{ $totalPrice }} ₺</span></h3>
                            <div class="grand-shipping">
                                <ul>
                                    @if ($cargoPrice == 0)
                                        <li><i class="fa fa-check"></i><label>Ücretsiz Kargo</label></li>
                                    @else
                                        <li><i class="fa fa-check"></i><label>Kargo Bedeli: {{ $cargoPrice }}</label>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="grand-total">
                                <h4>Toplam Ücret: <span>{{ $totalPrice + $cargoPrice }} ₺</span></h4>
                            </div>
                        </div>
                        <div class="grand-total-btn">
                            <a class="btn btn-link" href="shop-checkout.html">Siparişi Onayla</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== End Cart Area Wrapper ==-->
@endsection
