@extends('admin.layouts.main')
@section('admin_content')
    @if ($update == 1)
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- JAVASCRIPT -->
        <script src="../../../admin/assets/libs/jquery/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" id="animeUpdateForm" action="{{ route('admin_anime_update') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div hidden>
                                    <input type="text" name="code" value="{{ $anime->code }}">
                                    <input type="text" id="short_name" name="short_name" value="{{ $anime->short_name }}"
                                        hidden>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="validationCustom01">İsim:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="İsim" value="{{ $anime->name }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="">Resim:</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Dosya Seçiniz" accept="image/*">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="date">Yayınlanma Yılı:</label>
                                    <input type="number" class="form-control" id="date" name="date"
                                        placeholder="Örn: 2015" value="{{ $anime->date }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="average_min">Ortalama Süre(dk):</label>
                                    <input type="number" class="form-control" id="average_min" name="average_min"
                                        placeholder="Örn: 45" value="{{ $anime->average_min }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="validationCustom03">Açıklama:</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="15" placeholder="Açıklama">{{ $anime->description }}</textarea>
                                </div>
                                <div class=" col-md-4 mb-3">
                                    <div>
                                        <label for="">Şu an yüklü resim:</label>
                                    </div>
                                    <div>
                                        <img src="../../../{{ $anime->image }}" alt="{{ $anime->name }}"
                                            style="max-height:300px; max-width:300px; height:auto; width:auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="main_catogery">Ana Kategori:</label>
                                    <select class="form-control js-seelct-multiple" name="main_category" id="main_category">
                                        <option value="0">Seçiniz</option>
                                        @foreach ($categories as $category)
                                            @if (count($selectedCategories->where('is_main', 1)) > 0 &&
                                                    $selectedCategories->Where('category_code', $category->code)->where('is_main', 1)->first())
                                                <option value="{{ $category->code }}" selected>{{ $category->name }}
                                                </option>
                                            @else
                                                <option value="{{ $category->code }}">{{ $category->name }}</option>
                                            @endif
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
                                            @if (count($selectedCategories->where('is_main', 0)) > 0 &&
                                                    $selectedCategories->Where('category_code', $category->code)->where('is_main', 0)->first())
                                                <option value="{{ $category->code }}" selected>{{ $category->name }}
                                                </option>
                                            @else
                                                <option value="{{ $category->code }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="tag">Etiketler:</label>
                                    <select class="form-control js-seelct-multiple" name="tag[]" id="tag" multiple>
                                        @foreach ($tags as $tag)
                                            @if (count($selectedTags) > 0 && $selectedTags->Where('tag_code', $tag->code)->first())
                                                <option value="{{ $tag->code }}" selected>{{ $tag->name }}</option>
                                            @else
                                                <option value="{{ $tag->code }}">{{ $tag->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="">Görünürlük Tipi:</label>
                                    <select name="showStatus" id="" class="form-control">
                                        <option value="0" {{ $anime->showStatus == 0 ? 'selected' : '' }}>Herkes
                                            görebilir
                                        </option>
                                        <option value="1" {{ $anime->showStatus == 1 ? 'selected' : '' }}>Üye olanlar
                                            görebilir.
                                            Üye
                                            olmayanlar hiçbir şekilde göremez.</option>
                                        <option value="2" {{ $anime->showStatus == 2 ? 'selected' : '' }}>Üye olanlar
                                            görebilir.
                                            Üye
                                            olmayanlar sansürlü bir şekilde görebilir.
                                        </option>
                                        <option value="3" {{ $anime->showStatus == 3 ? 'selected' : '' }}>Sadece Link
                                            Üzerinden
                                            Erişilebilir.Listelemede çıkmaz.</option>
                                        <option value="4" {{ $anime->showStatus == 4 ? 'selected' : '' }}>Hiçkimse
                                            Göremez.Gizlidir.
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 ">
                                    <input type="checkbox" id="plusEighteen" name="plusEighteen"
                                        {{ $anime->plusEighteen == 1 ? 'checked' : '' }}>
                                    <label for="plusEighteen">
                                        <span style="font-weight: bold;">+18:</span>
                                        Listelemede ya da aramalarda hiç görünmez. Sadece kendi kısmına görünür.
                                    </label>
                                </div>
                            </div>
                            <div style="float: right;">
                                <button class="btn btn-primary" type="button"
                                    onclick="updateAnimeSubmitForm()">Kaydet</button>
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

            function updateAnimeSubmitForm(params) {
                var name = document.getElementById('name').value;
                var date = document.getElementById('date').value;
                var average_min = document.getElementById('average_min').value;

                if (name == "" || date == "" || average_min == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Lütfen Gerekli Doldurunuz!',
                    })
                } else {

                    var short_name = name.replace(/[ğĞüÜşŞıİöÖçÇ\s]/g, function(match) {
                        return match === ' ' ? '-' : match.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                    });

                    var short_name = short_name.toLowerCase();
                    document.getElementById('code').value = "{{ $anime->code }}"
                    document.getElementById('short_name').value = short_name;
                    document.getElementById('animeUpdateForm').submit();
                }
            }
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if ($update == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
