@extends('shop.themes.kidol.layouts.main')
@section('shop_body')
    <!--== Start Wishlist Area Wrapper ==-->
    <section class="product-area wishlist-page-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="section-title text-center">
                        <h2 class="title">Istek Listesi</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="wishlist-table-content">
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="width-remove"></th>
                                            <th class="width-thumbnail"></th>
                                            <th class="width-name">Ürün Ismi</th>
                                            <th class="width-price"> Ücret </th>
                                            <th class="width-stock-status"> Stok Durumu </th>
                                            <th class="width-wishlist-cart"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products['items'] as $product)
                                            @php
                                                $image_path = $product->image_path ?? '';
                                                $image_path = url($image_path);

                                                if ($product->priceType == 'USD') {
                                                    $priceType = '$';
                                                } elseif ($product->priceType == 'EUR') {
                                                    $priceType = '€';
                                                } else {
                                                    $priceType = '₺';
                                                }

                                                $cart_text =
                                                    isset($product->cart_product_code) &&
                                                    ($product->cart_product_code = $product->code)
                                                        ? 'Sepetten Çıkar'
                                                        : 'Sepete Ekle';
                                            @endphp
                                            <tr>
                                                <td class="product-remove"><a
                                                        href="{{ route('shop_add_whislist') }}?product_code={{ $product->code }}">×</a>
                                                </td>
                                                <td class="product-thumbnail">
                                                    <a
                                                        href="{{ route('shop_product_detail', ['code' => $product->code]) }}"><img
                                                            src="{{ url($image_path) }}" alt="Image"></a>
                                                </td>
                                                <td class="product-name">
                                                    <h5><a
                                                            href="{{ route('shop_product_detail', ['code' => $product->code]) }}">{{ $product->name }}</a>
                                                    </h5>
                                                </td>
                                                <td class="product-price"><span class="amount">{{ $product->price }}
                                                        {{ $priceType }}</span></td>
                                                <td class="stock-status">
                                                    <span><i class="fa fa-check"></i> Stokda</span>
                                                </td>
                                                <td class="wishlist-cart">
                                                    <a
                                                        href="{{ route('shop_add_cart') }}?product_code={{ $product->code }}">{{ $cart_text }}</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--== End Wishlist Area Wrapper ==-->
@endsection
