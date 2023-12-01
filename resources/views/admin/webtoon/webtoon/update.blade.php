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

                <form class="needs-validation" id="webtoonUpdateForm" action="{{route('admin_webtoon_update')}}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div hidden>
                            <input type="text" name="code" value="{{$webtoon->code}}">
                            <input type="text" id="short_name" name="short_name" value="{{$webtoon->short_name}}"
                                hidden>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom01">İsim:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="İsim"
                                value="{{$webtoon->name}}" required>
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
                                value="{{$webtoon->date}}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="average_min">Ortalama Süre(dk):</label>
                            <input type="number" class="form-control" id="average_min" name="average_min"
                                placeholder="Örn: 45" value="{{$webtoon->average_min}}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom03">Açıklama:</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="15"
                                placeholder="Açıklama">{{$webtoon->description}}</textarea>
                        </div>
                        <div class=" col-md-4 mb-3">
                            <div>
                                <label for="">Şu an yüklü resim:</label>
                            </div>
                            <div>
                                <img src="../../../{{$webtoon->image}}" alt="{{$webtoon->name}}"
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
                                <option value="{{$category->code}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="catogery">Kategoriler:</label>
                            <select class="form-control js-seelct-multiple" name="category[]" id="category" multiple>
                                @foreach ($categories as $category)
                                <option value="{{$category->code}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="tag">Etiketler:</label>
                            <select class="form-control js-seelct-multiple" name="tag" id="tag" multiple>
                                @foreach ($tags as $tag)
                                <option value="{{$tag->code}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        @if ($webtoon->onlyUsers)
                        <input type="checkbox" id="onlyUsers" name="onlyUsers" checked>
                        @else
                        <input type="checkbox" id="onlyUsers" name="onlyUsers">
                        @endif
                        <label for="onlyUsers">Herkes Görebilir.(Seçili olmaz ise sadece üyeler görebilir.)</label>
                    </div>
                    <div style="float: right;">
                        <button class="btn btn-primary" type="button"
                            onclick="updateWebtoonSubmitForm()">Kaydet</button>
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
    function updateWebtoonSubmitForm(params) {
        var name = document.getElementById('name').value;

        if(name == ""){
            Swal.fire({
                icon: 'error',
                title: 'Hata',
                text: 'Lütfen Gerekli Doldurunuz!',
            })
        }else{

        var short_name = name.replace(/[ğĞüÜşŞıİöÖçÇ\s]/g, function(match) {
            return match === ' ' ? '-' : match.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        });

        document.getElementById('short_name').value = short_name;
        document.getElementById('webtoonUpdateForm').submit();
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