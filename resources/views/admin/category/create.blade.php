@extends("admin.layouts.main")
@section('admin_content')
@if ($create == 1)
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" id="categoryCreateForm" action="{{route('admin_category_create')}}"
                    method="POST">
                    @csrf
                    <div hidden>
                        <input type="text" class="form-control" id="short_name" name="short_name" required>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">İsim:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="İsim" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom03">Açıklama:</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                                placeholder="Açıklama"></textarea>

                        </div>
                    </div>
                    <div style="float: right;">
                        <button class="btn btn-primary" type="button"
                            onclick="categoryCreatesubmitForm()">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function categoryCreatesubmitForm(){
        alert("dsafsdf");
        var name = document.getElementById('name').value;
        if(name == ""){
            Swal.fire({
                title: "Hata",
                text: "Lütfen Gerekli Yerleri Doldurunuz.",
                icon: "error"
            });
        }else{
            var short_name = name.replace(/[ğĞüÜşŞıİöÖçÇ\s]/g, function(match) {
                return match === ' ' ? '-' : match.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            });

            var short_name = short_name.toLowerCase();

            document.getElementById('short_name').value = short_name;
            document.getElementById('categoryCreateForm').submit();
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