@extends("admin.layouts.main")
@section('admin_content')
@if ($update == 1)
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" id="categoryUpdateForm" action="{{route('admin_category_update')}}"
                    method="POST">
                    @csrf
                    <div hidden>
                        <input type="text" name="code" id="code" value="{{$category->code}}" hidden>
                        <input type="text" class="form-control" id="short_name" name="short_name"
                            value="{{$category->short_name}}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">İsim:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="İsim" required
                                value="{{$category->name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom03">Açıklama:</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                                placeholder="Açıklama">{{$category->description ?? ''}}</textarea>

                        </div>
                    </div>
                    <div style="float: right;">
                        <button class="btn btn-primary" type="button"
                            onclick="categoryUpdatesubmitForm()">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function categoryUpdatesubmitForm(){
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
            document.getElementById('categoryUpdateForm').submit();
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