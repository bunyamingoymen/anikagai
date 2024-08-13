@extends('admin.layouts.main')
@section('admin_content')
    @if ($list)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">Genel Ayarlar</h4>
                        <form action="{{route('admin_shop_general_settings')}}" method="POST">
                            @csrf
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="store_active" name="store_active" {{isset($storeActive) && $storeActive->value == "1" ? 'checked' : ''}}>
                                <label class="custom-control-label" for="store_active">Mağaza Aktif</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="new_seller_accept" name="new_seller_accept" {{isset($newSellerAccept) && $newSellerAccept->value == "1" ? 'checked' : ''}}>
                                <label class="custom-control-label" for="new_seller_accept">Yeni Satıcı Üye Olabilir</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="approw_not_required" name="approw_not_required" {{isset($approwNotRequired) && $approwNotRequired->value == "1" ? 'checked' : ''}}>
                                <label class="custom-control-label" for="approw_not_required">Satıcı yeni ürün eklediğinde onaylanmadan yayınlansın</label>
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
                        <form action="">
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="archive_date_approval" checked="">
                                <label class="custom-control-label" for="archive_date_approval">Ürün satılmaz ise belli bir süre sonra arşiv'e eklensin</label>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="archive_date">Arşiv Süresi <a class="mo-mb-2" data-toggle="tooltip" data-placement="right" title="" data-original-title="Bir ürün eklendikten sonra hiç satılmaz ise arşive alınma süresi" aria-describedby="archive_date">
                                    <i class="far fa-question-circle"></i>
                                </a>:</label>
                                <input type="number" class="form-control" name="archive_date" id="archive_date" placeholder="Gün sayısı giriniz">
                            </div>

                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="delete_date_approval" checked="">
                                <label class="custom-control-label" for="delete_date_approval">Ürün satılmaz ise belli bir süre sonra silinsin</label>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="archive_date">Silinme Süresi <a class="mo-mb-2" data-toggle="tooltip" data-placement="right" title="" data-original-title="Bir ürün eklendikten sonra hiç satılmaz ise silinme süresi" aria-describedby="delete_date">
                                    <i class="far fa-question-circle"></i>
                                </a>:</label>
                                <input type="number" class="form-control" name="delete_date" id="delete_date" placeholder="Gün sayısı giriniz">
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
                                <label class="custom-control-label" for="same_theme">Ana site ile aynı temaya sahip olsun</label>
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
