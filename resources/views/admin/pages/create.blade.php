@extends("admin.layouts.main")
@section('admin_content')

<!-- Summernote css -->
<link href="../../../admin/assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" id="pageCreateForm" action="{{route('admin_page_create')}}"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Sayfanın İsmi:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="name" required>
                            <input type="text" class="form-control" id="short_name" name="short_name" placeholder="name"
                                hidden required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="text">Sayfa İçeriği:</label>
                            <div id="summernote"></div>
                            <textarea class="form-control" name="text" id="text" cols="30" rows="10"
                                placeholder="Sayfa İçeriği" hidden required></textarea>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Açıklama:</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="3"
                                placeholder="Açıklama"></textarea>
                            <small>Bu açıklama sadece yönetici panelinde görünebilir. Normal kullanıcılar burayı
                                göremez</small>
                        </div>
                    </div>
                    <div style="float: right;">
                        <button class="btn btn-primary" type="button" onclick="createPageFormSubmit()">Kaydet</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="../../../admin/assets/libs/jquery/jquery.min.js"></script>
<script src="../../../admin/assets/libs/summernote/summernote-bs4.min.js"></script>

<script>
    $.getScript('../../../admin/assets/libs/summernote/summernote-bs4.min.js', function ()
    {
    $(document).ready(function () {
        $("#summernote").summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: !1,
        }),
        $("#summernote-inline").summernote({ airMode: !0 });
        });
    });
    function createPageFormSubmit(){
        document.getElementById('text').value =document.getElementsByClassName('note-editable')[0].innerHTML;

        var name = document.getElementById('name').value;

        var short_name = name.replace(/[ğĞüÜşŞıİöÖçÇ\s]/g, function(match) {
            return match === ' ' ? '-' : match.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        });

        var text =document.getElementById('text').value
        var description = document.getElementById('description').value;

        if(name == "" || text == ""){
            Swal.fire({
                icon: 'error',
                title: 'Hata',
                text: 'Lütfen Gerekli Doldurunuz!',
            })
        }else{
            document.getElementById('short_name').value = short_name;
            document.getElementById('pageCreateForm').submit();
        }
    }
</script>
@endsection