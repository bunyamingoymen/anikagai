@extends("admin.layouts.main")
@section('admin_content')
@if ($update == 1)
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form class="needs-validation" id="animeEpisodeCreateForm" action="" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div hidden>
                            <input type="text" id='code' name='code' value="{{$anime_episode->code}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="anime_code">Anime:</label>
                            <select name="anime_code" id="anime_code" class="form-control" required>
                                @foreach ($animes as $anime)
                                @if ($anime_episode->anime_code == $anime->code)
                                <option value="{{$anime->code}}" selected>{{$anime->name}}</option>
                                @else
                                <option value="{{$anime->code}}">{{$anime->name}}</option>
                                @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="name">Bölüm Adı:</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{$anime_episode->name}}">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="season_short">Bulunduğu Sezon:</label>
                            <input type="number" id="season_short" name="season_short" class="form-control"
                                value="{{$anime_episode->season_short}}">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="episode_short">Bölüm Sırası:</label>
                            <input type="number" id="episode_short" name="episode_short" class="form-control"
                                value="{{$anime_episode->episode_short}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="publish_date">Yayınlanma Tarihi:</label>
                            <input type="date" id="publish_date" name="publish_date" class="form-control"
                                value="{{$anime_episode->publish_date}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom03">Açıklama:</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                                placeholder="Açıklama">{{$anime_episode->description}}</textarea>
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
<script>
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