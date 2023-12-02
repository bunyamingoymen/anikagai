@extends("admin.layouts.main")
@section('admin_content')
@if ($create == 1)
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <form class="needs-validation" id="webtoonEpisodeCreateForm" action="" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3 mt-4">
                            <div class="progress" style="height: 30px;">
                                <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated"
                                    role="progressbar" id="progress-bar-video" style="width: 25%;" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"> <span id="percentValue">Yüklenme
                                        Başlamadı</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="">Bölüm(PDF):</label>
                            <small>Sadece PDF Kabul edilmektedir.</small>
                            <input type="file" class="form-control" id="video" name="video" placeholder="Dosya Seçiniz"
                                accept=".pdf" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="webtoon_code">Webtoon:</label>
                            <select name="webtoon_code" id="webtoon_code" class="form-control" onchange="getSeason();"
                                required>
                                @foreach ($webtoons as $webtoon)
                                <option value="{{$webtoon->code}}">{{$webtoon->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="name">Bölüm Adı:</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label for="season_short">Bulunduğu Sezon:</label>
                            <select name="season_short" id="season_short" class="form-control">
                                @for ($i = 1; $i <= $webtoons->first()->season_count + 1; $i++)
                                    <option value="{{$i}}">{{$i}}.sezon</option>
                                    @endfor
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="episode_short">Bölüm Sırası:</label>
                            <input type="number" id="episode_short" name="episode_short" class="form-control">
                        </div>
                        <div class="col-md-8 mb-3">
                            <label for="publish_date">Yayınlanma Tarihi:</label>
                            <input type="date" id="publish_date" name="publish_date" class="form-control">
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
                            onclick="webtoonEpisodeCreateFormSubmit()">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function webtoonEpisodeCreateFormSubmit(){
        var video = document.getElementById('video').value;
        var name = document.getElementById('name').value;
        var season_short = document.getElementById('season_short').value;
        var episode_short = document.getElementById('episode_short').value;
        var publish_date = document.getElementById('publish_date').value;

        if(video == "" || name == "" || season_short == "" || episode_short == "" || publish_date==""){
            Swal.fire({
                icon: 'error',
                title: 'Hata',
                text: 'Lütfen Gerekli Doldurunuz!',
            })
        }else{

            var formData = new FormData(document.getElementById('webtoonEpisodeCreateForm'));

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
                url: '{{route("admin_webtoon_episodes_create")}}', // Dosya yüklemeyi işleyen PHP dosyanızın yolunu belirtin.
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
    }

    function getSeason(){
        var webtoon_code = document.getElementById('webtoon_code').value;
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
        });
        $.ajax({
        type: 'POST',
        url: '{{route("admin_webtoon_get_season")}}',
        data:{ code:webtoon_code},
        success: function(season) {
        var code = ``;
        //console.log(JSON.stringify(season.season_count));
        for(let i = 1; i<=season.season_count + 1; i++){ code +=`<option value="${i}">${i}.sezon</option>`;
            }

            document.getElementById('season_short').innerHTML = code;
            }
            });
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