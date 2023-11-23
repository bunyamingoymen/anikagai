@extends("admin.layouts.main")
@section('admin_content')
@if ($update == 1)
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
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom03">Açıklama:</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"
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

                    <div style="float: right;">
                        <button class="btn btn-primary" type="submit">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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