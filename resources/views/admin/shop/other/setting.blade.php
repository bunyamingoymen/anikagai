@extends('admin.layouts.main')
@section('admin_content')
    @if ($list)
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

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Satıcı Ayarları</h4>
                        <form action="">
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="free_cargo"
                                    onchange="changeFreeCargo()">
                                <label class="custom-control-label" for="free_cargo"> Belli bir ücretin üstü kargo ücretsiz
                                    olsun. </label>
                            </div>
                            <div id="FreeCargoDiv" class="col-md-2 mb-3 mr-3 ml-3" style="display:none">
                                <div>
                                    <label for="archive_date">Ücret: <a class="mo-mb-2" data-toggle="tooltip"
                                            data-placement="right" title=""
                                            data-original-title="Müşteri bu ücretin üstüne çıkarsa kargo ücretsiz olsun"
                                            aria-describedby="free_cargo_price">
                                            <i class="far fa-question-circle"></i>
                                        </a>:</label>
                                    <input type="number" class="form-control" name="free_cargo_price" id="free_cargo_price"
                                        placeholder="Ücret giriniz" value="">
                                </div>

                                <div class="custom-control custom-checkbox mb-2 mt-2">
                                    <input type="checkbox" class="custom-control-input" id="different_seller_free_cargo"
                                        onchange="changeDifferentSellerFreeCargo()">
                                    <label class="custom-control-label" for="different_seller_free_cargo"> Farklı satıcılar
                                        bile olsa bu
                                        ücreti geçtiğinde ücretsiz olsun.
                                        <a class="mo-mb-2" data-toggle="tooltip" data-placement="right" title=""
                                            data-original-title="Bunu seçerseniz satıcılar kendi istedikleri ücretleri belirleyemezler. Bu seçilmez ise sipariş esnasında en yüksek kargo ücretine bakılır. Ona göre kargo ücretsiz olur."
                                            aria-describedby="different_seller_free_cargo">
                                            <i class="far fa-question-circle"></i>
                                        </a>
                                    </label>
                                </div>

                                <div class="custom-control custom-checkbox mb-2 mt-2" id="DifferentSellerFreeCargoDiv">
                                    <input type="checkbox" class="custom-control-input"
                                        id="other_sellers_change_free_cargo">
                                    <label class="custom-control-label" for="other_sellers_change_free_cargo">Diğer
                                        satıcılar de kendi ücretsiz
                                        kargo ücretini belirleyebilsin. <a class="mo-mb-2" data-toggle="tooltip"
                                            data-placement="right" title=""
                                            data-original-title="Bunu seçerseniz diğer satıcılar da kendi belirledikleri ücretsiz kargo ücreti sınırını belirleyebilir."
                                            aria-describedby="other_sellers_change_free_cargo">
                                            <i class="far fa-question-circle"></i>
                                        </a> </label>
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

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Arşiv Ve Silinme Ayarları</h4>
                        <form action="{{ route('admin_shop_archive_and_delete_settings') }}" method="POST">
                            @csrf
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="add_archive" name="add_archive"
                                    {{ isset($addArchive) && $addArchive->value == 1 ? 'checked' : '' }}
                                    onchange="changeAddArchive()">
                                <label class="custom-control-label" for="add_archive">Ürün satılmaz ise belli bir süre
                                    sonra
                                    arşiv'e eklensin</label>
                            </div>
                            <div id="archiveTimeDiv" class="col-md-2 mb-3"
                                style="{{ isset($addArchive) && $addArchive->value == 1 ? '' : 'display:none' }}">
                                <label for="archive_date">Arşiv Süresi <a class="mo-mb-2" data-toggle="tooltip"
                                        data-placement="right" title=""
                                        data-original-title="Bir ürün eklendikten sonra hiç satılmaz ise arşive alınma süresi"
                                        aria-describedby="archive_date">
                                        <i class="far fa-question-circle"></i>
                                    </a>:</label>
                                <input type="number" class="form-control" name="archive_time" id="archive_time"
                                    placeholder="Gün sayısı giriniz" value="{{ $archiveTime ?? '' }}">
                            </div>

                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="delete_automatic"
                                    name="delete_automatic"
                                    {{ isset($deleteAutomatic) && $deleteAutomatic->value == 1 ? 'checked' : '' }}
                                    onchange="changeDeleteAutomatic()">
                                <label class="custom-control-label" for="delete_automatic">Ürün satılmaz ise belli bir
                                    süre
                                    sonra silinsin</label>
                            </div>
                            <div id="deleteAutomaticDiv" class="col-md-2 mb-3"
                                style="{{ isset($deleteAutomatic) && $deleteAutomatic->value == 1 ? '' : 'display:none' }}">
                                <label for="archive_date">Silinme Süresi <a class="mo-mb-2" data-toggle="tooltip"
                                        data-placement="right" title=""
                                        data-original-title="Bir ürün eklendikten sonra hiç satılmaz ise silinme süresi"
                                        aria-describedby="delete_date">
                                        <i class="far fa-question-circle"></i>
                                    </a>:</label>
                                <input type="number" class="form-control" name="delete_date" id="delete_date"
                                    placeholder="Gün sayısı giriniz" value="{{ $deleteTime ?? '' }}">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Tema Ayarları</h4>
                        <form action="">
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="same_theme" checked="">
                                <label class="custom-control-label" for="same_theme">Ana site ile aynı temaya sahip
                                    olsun</label>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Logo Ayarları</h4>
                        <form action="">
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="same_theme" checked="">
                                <label class="custom-control-label" for="same_theme">Ana site ile aynı logoya sahip
                                    olsun</label>
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
        <script>
            function changeAddArchive() {
                var check = document.getElementById('add_archive').checked;
                if (check) $('#archiveTimeDiv').slideDown();
                else $('#archiveTimeDiv').slideUp();
            }

            function changeDeleteAutomatic() {
                var check = document.getElementById('delete_automatic').checked;
                if (check) $('#deleteAutomaticDiv').slideDown();
                else $('#deleteAutomaticDiv').slideUp();
            }

            function changeFreeCargo() {
                var check = document.getElementById('free_cargo').checked;
                if (check) $('#FreeCargoDiv').slideDown();
                else $('#FreeCargoDiv').slideUp();
            }

            function changeDifferentSellerFreeCargo() {
                var check = document.getElementById('different_seller_free_cargo').checked;
                if (!check) $('#DifferentSellerFreeCargoDiv').slideDown();
                else $('#DifferentSellerFreeCargoDiv').slideUp();
            }
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
