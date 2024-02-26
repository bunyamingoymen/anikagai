@extends('admin.layouts.main')
@section('admin_content')
    @if ($create == 1)
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- JAVASCRIPT -->
        <script src="{{ 'admin/assets/libs/jquery/jquery.min.js' }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" id="animeCreateForm" action="{{ route('admin_anime_create') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="text" id="short_name" name="short_name" hidden>
                                <div class="col-md-8 mb-3">
                                    <label for="name">İsim:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="İsim" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="image">Resim:</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Dosya Seçiniz" accept="image/*" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="date">Yayınlanma Yılı:</label>
                                    <input type="number" class="form-control" id="date" name="date"
                                        placeholder="Örn: 2015" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="average_min">Ortalama Süre(dk):</label>
                                    <input type="number" class="form-control" id="average_min" name="average_min"
                                        placeholder="Örn: 45" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="description">Açıklama:</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Açıklama"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="main_category">Ana Kategori:</label>
                                    <select class="form-control js-seelct-multiple" name="main_category[]"
                                        id="main_category"multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->code }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="catogery">Kategoriler:</label>
                                    <select class="form-control js-seelct-multiple" name="category[]" id="category"
                                        multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->code }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="tag">Etiketler:</label>
                                    <select class="form-control js-seelct-multiple" name="tag[]" id="tag" multiple>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->code }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="">Görünürlük Tipi:</label>
                                    <select name="showStatus" id="" class="form-control">
                                        <option value="0" selected>Herkes görebilir</option>
                                        <option value="1">Üye olanlar görebilir. Üye olmayanlar hiçbir şekilde göremez.
                                        </option>
                                        <option value="2">Üye olanlar görebilir. Üye olmayanlar sansürlü bir şekilde
                                            görebilir.
                                        </option>
                                        <option value="3">Sadece Link Üzerinden Erişilebilir.Listelemede çıkmaz.
                                        </option>
                                        <option value="4">Hiçkimse Göremez.Gizlidir.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 ">
                                    <input type="checkbox" id="plusEighteen" name="plusEighteen">
                                    <label for="plusEighteen">
                                        <span style="font-weight: bold;">+18:</span>
                                        Listelemede ya da aramalarda hiç görünmez. Sadece kendi kısmına görünür.
                                    </label>
                                </div>
                            </div>
                            <div style="float: right;">
                                <button class="btn btn-primary" type="button"
                                    onclick="createAnimeSubmitForm()">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(".js-seelct-multiple").select2({
                // templateSelection: fonksiyon //NOTE seçildiğinde işlme yapmak için
            });

            function createAnimeSubmitForm(params) {
                var name = document.getElementById('name').value;
                var image = document.getElementById('image').value;
                var date = document.getElementById('date').value;
                var average_min = document.getElementById('average_min').value;

                if (name == "" || image == "" || date == "" || average_min == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Lütfen Gerekli Doldurunuz!',
                    })
                } else {

                    var short_name = makeShortName(name);

                    document.getElementById('short_name').value = short_name;
                    document.getElementById('animeCreateForm').submit();
                }
            }
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if ($create == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
