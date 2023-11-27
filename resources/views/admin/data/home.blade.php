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
                <div class="mt-3">
                    <form action="">
                        <div class="col-lg-6">
                            <label for="">Listelemede Görünecek Sayı: </label>
                            <input type="number" class="form-control" id="listCount" name="listCount" value="8">
                        </div>
                    </form>
                </div>
                <div class="mt-3">
                    <form action="">
                        <div class="col-lg-6">
                            <label for="">Slider Görünürlük durumu: </label>
                            <select name="sliderShow" id="sliderShow" class="form-control">
                                <option value="1">Görünür</option>
                                <option value="0">Görünmez</option>
                            </select>
                        </div>
                    </form>
                </div>

                <div class="mt-3">
                    <form action="">
                        <div class="col-lg-6">
                            <label for="">Slider'daki veriler: </label>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


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