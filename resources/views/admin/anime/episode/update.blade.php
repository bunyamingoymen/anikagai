@extends("admin.layouts.main")
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Yeni Anime Ekle</h4>
                <p></p>
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
                            <label for="anime_code">Bölüm Adı:</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{$anime_episode->name}}">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="anime_code">Bulunduğu Sezon:</label>
                            <input type="number" id="season_short" name="season_short" class="form-control"
                                value="{{$anime_episode->season_short}}">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="anime_code">Bölüm Sırası:</label>
                            <input type="number" id="episode_short" name="episode_short" class="form-control"
                                value="{{$anime_episode->episode_short}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="anime_code">Yayınlanma Tarihi:</label>
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
    function animeEpisodeCreateFormSubmit(){
        var formData = new FormData(document.getElementById('animeEpisodeCreateForm'));

        Swal.fire({
            title: "Yükleniyor..!",
            text: "Video Yüklenmeye Başladı. Lütfen Tamamlanana kadar bu sayfayı kapatmayınız!",
            icon: "warning"
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        $.ajax({
            url: '{{route("admin_anime_episodes_create")}}', // Dosya yüklemeyi işleyen PHP dosyanızın yolunu belirtin.
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function () {
            var xhr = new XMLHttpRequest();

            // İlerleme olayını dinle
            xhr.upload.addEventListener('progress', function (e) {
            if (e.lengthComputable) {
            var percent = (e.loaded / e.total) * 100;
                document.getElementById('percentValue').innerText = parseInt(percent) + "%"
                document.getElementById('progress-bar-video').style.width = percent + "%"

                document.getElementById('progress-bar-video').setAttribute("aria-valuenow", percent);
            }
            }, false);

            return xhr;
            },
            success: function (response) {
                // Yükleme tamamlandığında yapılacak işlemler
                //console.log(response);
                Swal.fire({
                    title: "Başarılı",
                    text: "Video Başarılı Bir Şekilde Yüklendi. Sayfayı Kapatabilirsiniz.",
                    icon: "success"
                });

                document.getElementById('percentValue').innerText = "Tamamlandı"
            },
            error: function (error) {
                // Hata durumunda yapılacak işlemler
                //console.log(error);
                Swal.fire({
                    title: "Error",
                    text: "Video yüklenirken bir hata meydana geldi.",
                    icon: "error"
                });

                document.getElementById('percentValue').innerText = "Hata"
                console.log('hata: ' + JSON.stringify(error));
            }
        });
    }
</script>
@endsection
