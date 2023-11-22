@extends("admin.layouts.main")
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="">
                    <div class="float-right">
                        <a class="btn btn-primary"
                            href="{{route('admin_page_update_screen')}}?code={{$page->code}}">Düzenle</a>
                        <a class="btn btn-danger" href="javascript:;" onclick="deletePage({{$page->code}})">Sil</a>
                    </div>
                    <div class="row">
                        <p>Sayfa İsmi: </p>
                        <h5>{{$page->name}}</h5>
                    </div>
                </div>
                <div class="m-5">
                    <h4>Sayfa İçeriği: </h4>
                    <div style="coverflow-y: auto; border: 1px solid #ccc; padding: 10px;">
                        {!! $page->text !!}
                    </div>
                </div>

                <div class="m-5">
                    <h4>Özel Açıklama</h4>
                    <small>Bu Açıklama sadece yönetici panelinden görülebilir.</small>
                    <div style="coverflow-y: auto; border: 1px solid #ccc; padding: 10px;">
                        {{$page->description}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function deletePage(code){
        Swal.fire({
            title: 'Emin Misin?',
            text: 'Bu Veriyi Silmek İstiyor musunuz(ID: '+code+')?',
            icon: 'warning',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Onayla',
            denyButtonText: `Vazgeç`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                var html = `<form action='{{route('admin_page_delete')}}' method="POST" id="deletePageForm"> @csrf`;
                    html += `<input type="text" name="code" value='`+code+`'>`;
                    html += `</form>`

                document.getElementById('hiddenDiv').innerHTML = html;

                document.getElementById('deletePageForm').submit();
            }
        })
    }
</script>

@endsection