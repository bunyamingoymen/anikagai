@extends('admin.layouts.main')
@section('admin_content')
    @if ($list)
        <!--Genel Ayarlar-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Genel Ayarlar</h4>
                        <form action="{{ route('admin_shop_general_settings') }}" method="POST">
                            @csrf
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="store_active" name="store_active"
                                    {{ isset($storeActive) && $storeActive->value == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="store_active">Mağaza Aktif</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="new_seller_accept"
                                    name="new_seller_accept"
                                    {{ isset($newSellerAccept) && $newSellerAccept->value == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="new_seller_accept">Yeni Satıcı Üye Olabilir</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="approw_not_required"
                                    name="approw_not_required"
                                    {{ isset($approwNotRequired) && $approwNotRequired->value == '1' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="approw_not_required">Satıcı yeni ürün eklediğinde
                                    onaylanmadan yayınlansın</label>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Satıcı Ayarları-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Satıcı Ayarları</h4>
                        <form action="{{ route('admin_shop_seller_settings') }}" method="POST">
                            @csrf

                            <!--Komisyon oranları-->
                            <div class="CommissionTopDiv mb-5">
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" id="active_commission"
                                        name="active_commission" onchange="changeDiv('active_commission', 'CommissionDiv');"
                                        {{ (isset($active_commission) && $active_commission->value == '1') || !isset($active_commission) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="active_commission">
                                        Satıcılardan Komisyon ücreti alınsın
                                    </label>
                                </div>

                                <div id="CommissionDiv" class="col-md-6 mb-3 mr-3 ml-3">
                                    <div>
                                        <label for="commission_rate">Komisyon Oranı: <a class="mo-mb-2"
                                                data-toggle="tooltip" data-placement="right" title=""
                                                data-original-title="Yüzde şeklinde hesaplanacaktır."
                                                aria-describedby="commission_rate">
                                                <i class="far fa-question-circle"></i>
                                            </a>:</label>
                                        <input type="number" class="form-control" name="commission_rate"
                                            id="commission_rate" placeholder="Oran giriniz"
                                            value="{{ isset($commission_rate) && isset($commission_rate->value) ? $commission_rate->value : '' }}">
                                    </div>

                                </div>
                            </div>

                            <!--Kargo Ücretleri-->
                            <div class="FreeCargoTopDiv mb-5">
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" id="active_free_cargo"
                                        name="active_free_cargo" onchange="changeDiv('active_free_cargo', 'FreeCargoDiv');"
                                        {{ (isset($active_free_cargo) && $active_free_cargo->value == '1') || !isset($active_free_cargo) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="active_free_cargo">
                                        Belli bir ücretin üstü kargo ücretsiz olsun.
                                    </label>
                                </div>

                                <div id="FreeCargoDiv" class="col-md-6 mb-3 mr-3 ml-3">
                                    <div>
                                        <label for="free_cargo_price">Ücret: <a class="mo-mb-2" data-toggle="tooltip"
                                                data-placement="right" title=""
                                                data-original-title="Müşteri bu ücretin üstüne çıkarsa kargo ücretsiz olur. Mod 1 aktifse tüm satıcılarda, diğer modlar aktifse sadece Anikagai satıcısına uygulanır."
                                                aria-describedby="free_cargo_price">
                                                <i class="far fa-question-circle"></i>
                                            </a>:</label>
                                        <input type="number" class="form-control" name="free_cargo_price"
                                            id="free_cargo_price" placeholder="Ücret giriniz"
                                            value="{{ isset($free_cargo_price) && isset($free_cargo_price->value) ? $free_cargo_price->value : '' }}">
                                    </div>

                                    <div class="custom-control custom-checkbox mb-2 mt-2" id="DifferentSellerFreeCargoDiv">
                                        <input type="checkbox" class="custom-control-input"
                                            name="other_sellers_change_free_cargo" id="other_sellers_change_free_cargo"
                                            {{ (isset($other_sellers_change_free_cargo) && $other_sellers_change_free_cargo->value == '1') || !isset($other_sellers_change_free_cargo) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="other_sellers_change_free_cargo">Diğer
                                            satıcılar de kendi ücretsiz
                                            kargo ücretini belirleyebilsin. <a class="mo-mb-2" data-toggle="tooltip"
                                                data-placement="right" title=""
                                                data-original-title="Bunu seçerseniz diğer satıcılar da kendi belirledikleri ücretsiz kargo ücreti sınırını belirleyebilir. Sadece Mod 2 ve Mod 3 de aktif olur"
                                                aria-describedby="other_sellers_change_free_cargo">
                                                <i class="far fa-question-circle"></i>
                                            </a> </label>
                                    </div>
                                </div>
                            </div>

                            <!--Modlar-->
                            <div class="ModesDiv container mt-5">
                                <div class="">
                                    <label for="">Mağaza Tipi: </label>
                                </div>
                                <div>
                                    @foreach ($shopModes as $mode)
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="ShopMode_{{ $mode->code }}"
                                                name="active_shop_mode" class="custom-control-input"
                                                value="{{ $mode->value }}"
                                                {{ isset($active_shop_mode) && $active_shop_mode->value == $mode->value ? 'checked' : '' }}>
                                            <label class="custom-control-label"
                                                for="ShopMode_{{ $mode->code }}">{{ $mode->optional }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="ModesDescriptions mt-5">
                                    @foreach ($shopModes as $mode)
                                        <div class="alert alert-warning" role="alert">
                                            <strong>{{ $mode->optional }}: </strong>{{ $mode->optional_2 }}
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                            <!--Buton-->
                            <div class="mt-3">
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Kaydet</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Arşiv Ve Silme Ayarları-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <h4 class="header-title mb-4">Arşiv Ve Silinme Ayarları</h4>

                        <form action="{{ route('admin_shop_archive_and_delete_settings') }}" method="POST">
                            @csrf

                            <!--Arşiv Süresi-->
                            <div id="archiveTimeTopDiv">
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" id="add_archive"
                                        name="add_archive"
                                        {{ isset($addArchive) && $addArchive->value == 1 ? 'checked' : '' }}
                                        onchange="changeDiv('add_archive', 'archiveTimeDiv')">
                                    <label class="custom-control-label" for="add_archive">
                                        Ürün satılmaz ise belli bir süre sonra arşiv'e eklensin
                                    </label>
                                </div>
                                <div id="archiveTimeDiv" class="col-md-2 mb-3">
                                    <label for="archive_date">Arşiv Süresi <a class="mo-mb-2" data-toggle="tooltip"
                                            data-placement="right" title=""
                                            data-original-title="Bir ürün eklendikten sonra hiç satılmaz ise arşive alınma süresi"
                                            aria-describedby="archive_date">
                                            <i class="far fa-question-circle"></i>
                                        </a>:</label>
                                    <input type="number" class="form-control" name="archive_time" id="archive_time"
                                        placeholder="Gün sayısı giriniz" value="{{ $archiveTime->value ?? '' }}">
                                </div>
                            </div>

                            <!--Silme Süresi-->
                            <div id="deleteAutomaticTopDiv">
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" id="delete_automatic"
                                        name="delete_automatic"
                                        {{ isset($deleteAutomatic) && $deleteAutomatic->value == 1 ? 'checked' : '' }}
                                        onchange="changeDiv('delete_automatic', 'deleteAutomaticDiv');">
                                    <label class="custom-control-label" for="delete_automatic">
                                        Ürün satılmaz ise belli bir süre sonra silinsin
                                    </label>
                                </div>
                                <div id="deleteAutomaticDiv" class="col-md-2 mb-3">
                                    <label for="archive_date">Silinme Süresi <a class="mo-mb-2" data-toggle="tooltip"
                                            data-placement="right" title=""
                                            data-original-title="Bir ürün eklendikten sonra hiç satılmaz ise silinme süresi"
                                            aria-describedby="delete_date">
                                            <i class="far fa-question-circle"></i>
                                        </a>:</label>
                                    <input type="number" class="form-control" name="delete_date" id="delete_date"
                                        placeholder="Gün sayısı giriniz" value="{{ $deleteTime->value ?? '' }}">
                                </div>
                            </div>

                            <!--Buton-->
                            <div class="mt-3">
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Kaydet</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        <!--Tema Ayarları-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Tema Ayarları</h4>
                        <form action="{{ route('admin_shop_theme_settings') }}" method="POST"
                            enctype="multipart/form-data" id="themeChangeSubmitForm">
                            @csrf

                            <!--Renk Ayarları-->
                            <div id="themeColorTopDiv">

                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" id="use_same_color"
                                        name="use_same_color" onchange="changeDiv('use_same_color', 'themeColorDiv');"
                                        {{ isset($use_same_color) && $use_same_color->value == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="use_same_color">
                                        Ana site ile farklı renge sahip olsun
                                    </label>
                                </div>

                                <div id="themeColorDiv">
                                    @if ($colors_code)
                                        <div class="col-lg-8">
                                            @foreach ($colors_code as $item)
                                                @php
                                                    $different_color = null;
                                                    if (count($colors_different->where('optional', $item->code)) > 0) {
                                                        $different_color = $colors_different
                                                            ->where('optional', $item->code)
                                                            ->first();
                                                    }

                                                    if (isset($different_color) && isset($different_color->value)) {
                                                        $hexColor =
                                                            strpos($different_color->value, '#') === 0
                                                                ? $different_color->value
                                                                : '#' . $different_color->value;
                                                    } else {
                                                        $hexColor =
                                                            strpos($item->setting_value, '#') === 0
                                                                ? $item->setting_value
                                                                : '#' . $item->setting_value;
                                                        $hexColor = '#' . $item->setting_value;
                                                    }
                                                @endphp
                                                <div class="row mt-3">
                                                    <div class="col-lg-2">
                                                        <label for="">{{ $loop->index + 1 }}.Renk:</label>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <input type="color" id="colorpicker{{ $loop->index }}"
                                                            name="color" class="form-control"
                                                            pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                                            value="{{ $hexColor }}">
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <input type="text" class="form-control hexcolors"
                                                            pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$"
                                                            name="hexcolors[{{ $item->code }}]"
                                                            value="{{ $hexColor }}"
                                                            id="hexcolor{{ $loop->index }}"></input>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <button type="button" class="btn btn-info"
                                                            onclick="defaultColor({{ $loop->index }})">
                                                            Varsayılan Olarak Renk Ayarla
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div id="themeLogoTopDiv">
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" id="use_same_logo"
                                        name="use_same_logo" onchange="changeDiv('use_same_logo', 'themeLogoDiv');"
                                        {{ isset($use_same_logo) && $use_same_logo->value == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="use_same_logo">
                                        Ana site ile farklı logoya sahip olsun
                                    </label>
                                </div>

                                <div id="themeLogoDiv">
                                    <div class="row">
                                        <div style="background-color: black;">
                                            <img src="{{ isset($shop_logo) ? url($shop_logo->value) : '' }}"
                                                alt="logo" style="max-height: 155px;">
                                        </div>
                                        <div class="ml-5">
                                            <button type="button" class="btn btn-primary"
                                                onclick="logoChangeButton()">Değiştir</button>
                                            <div hidden>
                                                <input type="file" name="logo" id="logoChangeInput"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mt-3">
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ url('admin/assets/libs/jquery/jquery.min.js') }}"></script>

        <!--Renk Ayarları-->
        <script>
            @foreach ($colors_code as $item)
                $('#colorpicker{{ $loop->index }}').on('input', function() {
                    $('#hexcolor{{ $loop->index }}').val(this.value);
                });
            @endforeach

            function defaultColor(color_number) {

                var defaultValue = @json($colors_code_defaults->nth(1));

                $('#hexcolor' + color_number).val(
                    '#' + (defaultValue[color_number] ? defaultValue[color_number].setting_value : 'fff')
                );

                $('#colorpicker' + color_number).val(
                    '#' + (defaultValue[color_number] ? defaultValue[color_number].setting_value : 'fff')
                );
            }
        </script>

        <!--Logo ayarları-->
        <script>
            function logoChangeButton() {
                document.getElementById('logoChangeInput').click();
            }

            document.getElementById('logoChangeInput').addEventListener('change', function() {
                document.getElementById('themeChangeSubmitForm').submit();
            });
        </script>

        <!--Görünüş Ayarları-->
        <script>
            function changeDiv(checkboxID, DivID) {
                var check = document.getElementById(checkboxID).checked;
                if (check) $('#' + DivID).slideDown();
                else $('#' + DivID).slideUp();
            }

            $(document).ready(function() {
                changeDiv('add_archive', 'archiveTimeDiv');
                changeDiv('delete_automatic', 'deleteAutomaticDiv');
                changeDiv('active_free_cargo', 'FreeCargoDiv');
                changeDiv('active_commission', 'CommissionDiv');
                changeDiv('use_same_color', 'themeColorDiv');
                changeDiv('use_same_logo', 'themeLogoDiv');
            });
        </script>
    @endif

    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if (!$list)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
