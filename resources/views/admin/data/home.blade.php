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