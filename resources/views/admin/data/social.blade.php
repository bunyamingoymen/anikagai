@extends("admin.layouts.main")
@section('admin_content')
@if ($social == 1)
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4>Sosyal Medya Linkleri: </h4>
                <p>
                    Meta etiketlerini buradan güncelleyip değiştirebilirsiniz. Yeni Meta etiketi ekleyebilirsiniz
                </p>
                <div class="mt-3">
                    <div class="row col-lg-12">
                        <div class="col-lg-9 ml-2">
                            <div class="float-right">
                                <button class="btn btn-primary" onclick="createNewMeta()">+ Yeni Meta Etiketi
                                    Ekle</button>
                            </div>
                        </div>
                    </div>
                    <div id="metaDiv">
                        @foreach ($meta as $item)
                        <div class="mt-2" style="border: solid 1px #555956a7; border-radius: 10px;">
                            <form action="{{route('admin_data_social_update')}}" method="POST">
                                @csrf
                                <input type="text" name="code" id="code" hidden value="{{$item->code}}">
                                <div class="row m-3">
                                    <div class="col-lg-3">
                                        <label for="menu">Sosyal Medya Sitesi: </label>
                                        <input type="text" class="form-control" name="social" id="social"
                                            value="{{$item->value}}">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="url">Link: </label>
                                        <input type="text" class="form-control" name="url" id="url"
                                            value="{{$item->optional}}">
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-primary" type="submit">Değiştir</button>
                                        <button class="btn btn-danger" type="button"
                                            onclick="deleteSocial({{$item->code}})">Sil</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    var social_count = parseInt("{{count($meta)}}");
    function createNewMeta() {
        social_count += 1;
        html=`<div id="social_count`+social_count+`" class="mt-2" style="border: solid 1px #555956a7; border-radius: 10px;">
            <form action="{{route('admin_data_social_add')}}" method="POST">
                @csrf
                <div class="row m-3">
                    <div class="col-lg-3">
                        <label for="menu">Sosyal Medya Sitesi: </label>
                        <input type="text" class="form-control" name="social" id="social">
                    </div>
                    <div class="col-lg-3">
                        <label for="url">Link: </label>
                        <input type="text" class="form-control" name="url" id="url">
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit">Değişikliği Kaydet</button>
                        <button class="btn btn-danger" type="button" onclick="deleteHTML('social_count`+social_count+`')">Vazgeç</button>
                    </div>
                </div>
            </form>
        </div>`
        $("#metaDiv").append(html);
    }

    function deleteHTML(html){
        document.getElementById(html).remove();
    }

    function deleteSocial(code){
        var form =`<form action="{{route('admin_data_social_delete')}}" method="POST" id="socialDeleteForm">
            @csrf
            <input type="text" name="code" value="`+code+`">
        </form>`

        $("#hiddenDiv").append(form);

        document.getElementById('socialDeleteForm').submit();
    }
</script>
@endif
<script>
    // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
    window.addEventListener('DOMContentLoaded', (event) => {
        // Değişkenin değerini kontrol et
        @if ($social == 0)
            // Değişken doğru ise yönlendirme yap
            window.location.href = '{{route("admin_index")}}';
        @endif
    });
</script>
@endsection
