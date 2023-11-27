@extends("admin.layouts.main")
@section('admin_content')
@if ($homeData == 1)
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <p>Sitede gözüken bütün logo ve ikonları buradan değiştirebilirsiniz.</p>
                <hr>
                <p>Sitenin Teması:</p>
                <form action="{{route('admin_data_home')}}" method="POST">
                    @csrf
                    <div class="row">
                        @foreach ($themes as $item)
                        <div class="form-check m-2">
                            <div class="">
                                @if ($selected_theme->value == $item->code)
                                <input class="form-check-input" type="radio" name="selected_theme"
                                    id="flexRadioDefault{{$loop->index}}" value={{$item->code}} checked>
                                @else
                                <input class="form-check-input" type="radio" name="selected_theme"
                                    id="flexRadioDefault{{$loop->index}}" value={{$item->code}}>
                                @endif

                                <label class="form-check-label" for="flexRadioDefault{{$loop->index}}">
                                    <img src="../../../{{$item->images}}" alt="" style="max-height: 150px;">
                                    <h4 class="text-center">{{$item->themeName}}</h4>
                                </label>
                            </div>

                        </div>
                        @endforeach
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Kaydet</button>
                    </div>
                </form>

                <hr>
                <p>Tema Ayarları:</p>
                <div>
                    <form action="{{route('admin_data_show_content')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Anime Görünürlük: </label>
                                <select name="animeShow" id="animeShow" class="form-control">
                                    @if ($animeActive->value == 1)
                                    <option value="1" selected>Görünür</option>
                                    <option value="0">Görünmez</option>
                                    @else
                                    <option value="1">Görünür</option>
                                    <option value="0" selected>Görünmez</option>
                                    @endif

                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="">Webtoon Görünürlük: </label>
                                <select name="webtoonShow" id="webtoonShow" class="form-control">
                                    @if ($webtoonActive->value == 1)
                                    <option value="1" selected>Görünür</option>
                                    <option value="0">Görünmez</option>
                                    @else
                                    <option value="1">Görünür</option>
                                    <option value="0" selected>Görünmez</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="mt-1">
                            <button class="btn btn-primary" type="submit">Kaydet</button>
                        </div>
                    </form>
                </div>
                <hr>
                <form action="{{route('admin_data_change_theme_settings')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <label for="">Listelemede Görünecek Sayı: </label>
                            <input type="number" class="form-control" id="listCount" name="listCount"
                                value="{{$listCount->setting_value}}">
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label for="">Slider Görünürlük durumu: </label>
                            <select name="sliderShow" id="sliderShow" class="form-control">
                                @if ($sliderShow->setting_value == 1)
                                <option value="1" selected>Görünür</option>
                                <option value="0">Görünmez</option>
                                @else
                                <option value="1">Görünür</option>
                                <option value="0" selected>Görünmez</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mt-1">
                        <button class="btn btn-primary" type="submit">Kaydet</button>
                    </div>
                </form>
                <hr>

                <div class="mt-3">

                    <div class="col-lg-12">
                        <label for="">Slider'daki veriler: </label>
                        @foreach ($slider_images as $item)
                        <div class="mt-5">
                            <form action="{{route('admin_data_change_slider_images')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="">
                                        <p>{{$loop->index + 1}} - </p>
                                    </div>
                                    <div hidden>
                                        <input type="text" name="code" id="code" value="{{$item->code}}">
                                    </div>
                                    <div class="col-lg-3">
                                        <img src="../../../{{$item->optional}}" alt="" style="max-height: 155px;">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Yazı:</label>
                                        <input type="text" class="form-control" name="value" id="value"
                                            value="{{$item->value}}">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Link:</label>
                                        <input type="text" class="form-control" name="optional_2" id="optional_2"
                                            value="{{$item->optional_2}}">
                                    </div>
                                    <div class="col-lg-2 mt-3">
                                        <button class="btn btn-primary" type="submit">Değiştir</button>
                                        <button class="btn btn-danger" type="button"
                                            onclick="deleteSlider('{{$item->code}}')">Sil</button>
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
    function deleteSlider(code){
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
        var html = `<form action='{{route("admin_anime_delete")}}' method="POST" id="deleteSliderForm"> @csrf`;
            html += `<input type="text" name="code" value='`+code+`'>`;
            html += `</form>`

        document.getElementById('hiddenDiv').innerHTML = html;

        document.getElementById('deleteSliderForm').submit();
        }
        })
        }

</script>

@endif

<script>
    // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
    window.addEventListener('DOMContentLoaded', (event) => {
        // Değişkenin değerini kontrol et
        @if ($homeData == 0)
            // Değişken doğru ise yönlendirme yap
            window.location.href = '{{route("admin_index")}}';
        @endif
    });
</script>


@endsection
