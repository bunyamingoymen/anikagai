@extends("admin.layouts.main")
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
                <form class="needs-validation" id="webtoonCreateForm" action="{{route('admin_anime_update')}}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div hidden>
                            <input type="text" name="code" value="{{$anime->code}}">
                            <input type="text" id="short_name" name="short_name" value="{{$anime->short_name}}" hidden>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom01">İsim:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="İsim"
                                value="{{$anime->name}}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Resim:</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="Dosya Seçiniz">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="date">Yayınlanma Yılı:</label>
                            <input type="number" class="form-control" id="date" name="date" placeholder="Örn: 2015"
                                value="{{$anime->date}}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="average_min">Ortalama Süre(dk):</label>
                            <input type="number" class="form-control" id="average_min" name="average_min"
                                placeholder="Örn: 45" value="{{$anime->average_min}}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom03">Açıklama:</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="15"
                                placeholder="Açıklama">{{$anime->description}}</textarea>
                        </div>
                        <div class=" col-md-4 mb-3">
                            <div>
                                <label for="">Şu an yüklü resim:</label>
                            </div>
                            <div>
                                <img src="../../../{{$anime->image}}" alt="{{$anime->name}}"
                                    style="max-height:300px; max-width:300px; height:auto; width:auto;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="main_catogery">Ana Kategori:</label>
                            <select class="form-control js-seelct-multiple" name="main_catogery" id="main_catogery">
                                <option value="0">Seçiniz</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="catogery">Kategoriler:</label>
                            <select class="form-control js-seelct-multiple" name="catogery" id="catogery" multiple>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="tag">Etiketler:</label>
                            <select class="form-control js-seelct-multiple" name="tag" id="tag" multiple>
                                @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div style="float: right;">
                        <button class="btn btn-primary" type="button" onclick="updateAnimeSubmitForm()">Kaydet</button>
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

        var image = document.getElementById('image').value;

        if(name == "" || image == ""){
            Swal.fire({
                icon: 'error',
                title: 'Hata',
                text: 'Lütfen Gerekli Doldurunuz!',
            })
        }else{

        var short_name = name.replace(/[ğĞüÜşŞıİöÖçÇ\s]/g, function(match) {
            return match === ' ' ? '-' : match.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        });

        var short_name = short_name.toLowerCase();

        document.getElementById('short_name').value = short_name;
        document.getElementById('webtoonCreateForm').submit();
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
            window.location.href = '{{route("admin_index")}}';
        @endif
    });
</script>
@endsection