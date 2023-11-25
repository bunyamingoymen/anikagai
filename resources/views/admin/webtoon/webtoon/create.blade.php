@extends("admin.layouts.main")
@section('admin_content')
@if ($create == 1)
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" id="webtoonCreateForm" action="{{route('admin_webtoon_create')}}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="text" id="short_name" name="short_name" hidden>
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom01">İsim:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="İsim" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Resim:</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="Dosya Seçiniz"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom03">Açıklama:</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                                placeholder="Açıklama"></textarea>
                        </div>
                    </div>
                    <div style="float: right;">
                        <button class="btn btn-primary" type="button"
                            onclick="createWebtoonSubmitForm()">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function  createWebtoonSubmitForm(params) {
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
            window.location.href = '{{route("admin_index")}}';
        @endif
    });
</script>
@endsection