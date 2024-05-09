@extends('admin.layouts.main')
@section('admin_content')
    @if ($create == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <form class="needs-validation" id="animeEpisodeCreateForm" action="" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-4">
                                    <div>
                                        <p>Kaydet butonuna basıldığında video kaydedilmeye başlanacaktır. Lütfen
                                            tamamlanmadan
                                            sayfayı kapatmayınız.</p>
                                    </div>
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
                                    <label for="">Bölüm(Video):</label>
                                    <small>Sadece video dosyası kabul edilmektedir.</small>
                                    <input type="file" class="form-control" id="video" placeholder="Dosya Seçiniz"
                                        accept="video/*" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="anime_code">Anime:</label>
                                    <select name="anime_code" id="anime_code" class="form-control" onchange="getSeason();"
                                        required>
                                        @foreach ($animes as $anime)
                                            <option value="{{ $anime->code }}">{{ $anime->name }}</option>
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
                                        @for ($i = 1; $i <= $animes->first()->season_count + 1; $i++)
                                            <option value="{{ $i }}">{{ $i }}.sezon</option>
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
                                <div class="col-md-3 mb-3">
                                    <label for="intro_start_time_min">İntro başlangıç zamanı dakikası:</label>
                                    <input type="number" id="intro_start_time_min" name="intro_start_time_min"
                                        class="form-control" placeholder="İntro Başlangıç Zamanı Dakikası (örn:0)" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="intro_start_time_sec">İntro başlangıç zamanı saniyesi:</label>
                                    <input type="number" id="intro_start_time_sec" name="intro_start_time_sec"
                                        class="form-control" placeholder="İntro Başlangıç Zamanı Saniyesi (örn:35)"
                                        required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="intro_end_time_min">İntro bitiş zamanı dakikası:</label>
                                    <input type="number" id="intro_end_time_min" name="intro_end_time_min"
                                        class="form-control" placeholder="İntro Bitiş Zamanı Saniyesi (örn:1)" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="intro_end_time_sec">İntro bitiş zamanı saniyesi:</label>
                                    <input type="number" id="intro_end_time_sec" name="intro_end_time_sec"
                                        class="form-control" placeholder="İntro Bitiş Zamanı Saniyesi (örn:45)" required>
                                </div>
                            </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom03">Açıklama:</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Açıklama"></textarea>
                            </div>
                        </div>
                        <div style="float: right;">
                            <button class="btn btn-primary" type="button" onclick="animeEpisodeCreate()"
                                id="animeEpisodeCreateSubmitButton">Kaydet</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <script>
            var is_submitted = false;
            var percent_value = 0;

            function animeEpisodeCreate() {
                var video = document.getElementById('video').value;
                var name = document.getElementById('name').value;
                var season_short = document.getElementById('season_short').value;
                var episode_short = document.getElementById('episode_short').value;
                var publish_date = document.getElementById('publish_date').value;

                var intro_start_time_min = document.getElementById('intro_start_time_min').value;
                var intro_start_time_sec = document.getElementById('intro_start_time_sec').value;
                var intro_end_time_min = document.getElementById('intro_end_time_min').value;
                var intro_end_time_sec = document.getElementById('intro_end_time_sec').value;

                if (video == "" || season_short == "" || episode_short == "" || publish_date == "" ||
                    intro_start_time_min == "" || intro_start_time_sec == "" || intro_end_time_min == "" ||
                    intro_end_time_sec == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Lütfen Gerekli Doldurunuz!',
                    })
                } else if (!is_submitted) {
                    animeEpsiodeCreateJustEpiosde();
                }
            }

            function animeEpsiodeCreateJustEpiosde() {
                is_submitted = true;
                document.getElementById("animeEpisodeCreateSubmitButton").disabled = true;
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
                    url: '{{ route('admin_anime_just_episode_create') }}', // Dosya yüklemeyi işleyen PHP dosyanızın yolunu belirtin.
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        var xhr = new XMLHttpRequest();

                        // İlerleme olayını dinle
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                percent_value += ((e.loaded / e.total) * 100) / 20
                                var percent = percent_value;
                                document.getElementById('percentValue').innerText = parseInt(percent) +
                                    "%"
                                document.getElementById('progress-bar-video').style.width = percent +
                                    "%"

                                document.getElementById('progress-bar-video').setAttribute(
                                    "aria-valuenow", percent);
                            }
                        }, false);

                        return xhr;
                    },
                    success: function(response) {
                        // Yükleme tamamlandığında yapılacak işlemler
                        console.log(JSON.stringify(response));
                        if (response.success) {
                            animeEpsiodeCreateUploadVideo(response.episode_code);
                        } else {
                            console.log("Aşama Bir de Hata");
                            Swal.fire({
                                title: "Error",
                                text: "Video yüklenirken bir hata meydana geldi.",
                                icon: "error"
                            });
                            getNormalButtons();
                        }

                    },
                    error: function(error) {
                        // Hata durumunda yapılacak işlemler
                        //console.log(error);
                        is_submitted = false;
                        document.getElementById("animeEpisodeCreateSubmitButton").disabled = false;
                        Swal.fire({
                            title: "Error",
                            text: "Video yüklenirken bir hata meydana geldi.",
                            icon: "error"
                        });

                        document.getElementById('percentValue').innerText = "Hata"
                        console.log('hata: ' + JSON.stringify(error));
                        getNormalButtons();
                    }
                });

            }

            function animeEpsiodeCreateUploadVideo(episode_code) {
                var fileInput = document.getElementById('video');
                var file = fileInput.files[0];
                var chunkSize = 10 * (1024 * 1024); // 10 MB

                var start = 0;
                var end = Math.min(chunkSize, file.size);
                var total_piece = Math.ceil(file.size / chunkSize);
                var percent_one_piece = parseInt(total_piece / 90);
                var order = 1;
                animeEpisdeCreateUploadVideoAjax(episode_code, file, chunkSize, start, end, total_piece, percent_one_piece,
                    order)
            }

            function animeEpisdeCreateUploadVideoAjax(episode_code, file, chunkSize, start, end, total_piece, percent_one_piece,
                order) {
                var chunk = file.slice(start, end);

                // AJAX ile sunucuya parçayı gönderme
                var formData2 = new FormData();
                formData2.append('chunk', chunk);
                formData2.append('episode_code', episode_code);
                formData2.append('order', order);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: '{{ route('admin_anime_upload_video_create') }}', // Dosya yüklemeyi işleyen PHP dosyanızın yolunu belirtin.
                    type: 'POST',
                    data: formData2,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        var xhr = new XMLHttpRequest();

                        // İlerleme olayını dinle
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                percent_value += ((e.loaded / e.total) * 100) / (100 / percent_one_piece)
                                var percent = percent_value;
                                document.getElementById('percentValue').innerText = parseInt(percent) +
                                    "%"
                                document.getElementById('progress-bar-video').style.width = percent +
                                    "%"

                                document.getElementById('progress-bar-video').setAttribute(
                                    "aria-valuenow", percent);
                            }
                        }, false);

                        return xhr;
                    },
                    success: function(response) {
                        // Yükleme tamamlandığında yapılacak işlemler
                        console.log(JSON.stringify(response));
                        // Sonraki parçayı işle
                        if (response.success) {
                            start = end;
                            end = Math.min(start + chunkSize, file.size);
                            order++;
                            if (start < file.size) {
                                animeEpisdeCreateUploadVideoAjax(episode_code, file, chunkSize, start, end,
                                    total_piece, percent_one_piece, order)
                            }

                        } else {
                            Swal.fire({
                                title: "Error",
                                text: "Video yüklenirken bir hata meydana geldi.",
                                icon: "error"
                            });
                            getNormalButtons();
                        }

                    },
                    error: function(error) {
                        // Hata durumunda yapılacak işlemler
                        //console.log(error);
                        is_submitted = false;
                        document.getElementById("animeEpisodeCreateSubmitButton").disabled = false;
                        Swal.fire({
                            title: "Error",
                            text: "Video yüklenirken bir hata meydana geldi.",
                            icon: "error"
                        });
                        document.getElementById('percentValue').innerText = "Hata"
                        console.log('hata: ' + JSON.stringify(error));
                        getNormalButtons();
                    }
                });
            }

            

            function getNormalButtons() {
                is_submitted = false;
                document.getElementById("animeEpisodeCreateSubmitButton").disabled = false;
            }

            function animeEpisodeCreateFormSubmit() {

                var video = document.getElementById('video').value;
                var name = document.getElementById('name').value;
                var season_short = document.getElementById('season_short').value;
                var episode_short = document.getElementById('episode_short').value;
                var publish_date = document.getElementById('publish_date').value;

                var intro_start_time_min = document.getElementById('intro_start_time_min').value;
                var intro_start_time_sec = document.getElementById('intro_start_time_sec').value;
                var intro_end_time_min = document.getElementById('intro_end_time_min').value;
                var intro_end_time_sec = document.getElementById('intro_end_time_sec').value;

                if (video == "" || season_short == "" || episode_short == "" || publish_date == "" ||
                    intro_start_time_min == "" || intro_start_time_sec == "" || intro_end_time_min == "" ||
                    intro_end_time_sec == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Lütfen Gerekli Doldurunuz!',
                    })
                } else if (!is_submitted) {

                    is_submitted = true;
                    document.getElementById("animeEpisodeCreateSubmitButton").disabled = true;

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
                        url: '{{ route('admin_anime_episodes_create') }}', // Dosya yüklemeyi işleyen PHP dosyanızın yolunu belirtin.
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        xhr: function() {
                            var xhr = new XMLHttpRequest();

                            // İlerleme olayını dinle
                            xhr.upload.addEventListener('progress', function(e) {
                                if (e.lengthComputable) {
                                    var percent = (e.loaded / e.total) * 100;
                                    document.getElementById('percentValue').innerText = parseInt(percent) +
                                        "%"
                                    document.getElementById('progress-bar-video').style.width = percent +
                                        "%"

                                    document.getElementById('progress-bar-video').setAttribute(
                                        "aria-valuenow", percent);
                                }
                            }, false);

                            return xhr;
                        },
                        success: function(response) {
                            // Yükleme tamamlandığında yapılacak işlemler
                            console.log(JSON.stringify(response));
                            is_submitted = false;
                            document.getElementById("animeEpisodeCreateSubmitButton").disabled = false;
                            Swal.fire({
                                title: "Başarılı",
                                text: "Video Başarılı Bir Şekilde Yüklendi. Sayfayı Kapatabilirsiniz.",
                                icon: "success"
                            });

                            document.getElementById('percentValue').innerText = "Tamamlandı"
                        },
                        error: function(error) {
                            // Hata durumunda yapılacak işlemler
                            //console.log(error);
                            is_submitted = false;
                            document.getElementById("animeEpisodeCreateSubmitButton").disabled = false;
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

            function getSeason() {
                var anime_code = document.getElementById('anime_code').value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin_anime_get_season') }}',
                    data: {
                        code: anime_code
                    },
                    success: function(season) {
                        var code = ``;
                        //console.log(JSON.stringify(season.season_count));
                        for (let i = 1; i <= season.season_count + 1; i++) {
                            code += `<option value="${i}">${i}.sezon</option>`;
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
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
