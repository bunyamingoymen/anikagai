@extends('admin.layouts.main')
@section('admin_content')
    @if ($create == 1)
        <style>
            .progress-bar {
                width: 100%;
                transition: width 0.5s, background-color 0.5s;
                /* Geçişler için süre ayarlandı */
            }
        </style>
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
                                        <div class="progress-bar progress-bar-striped bg-info progress-bar-animated"
                                            role="progressbar" id="progress-bar-video" aria-valuemax="100"> <span
                                                id="percentValue">Yüklenme
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
                                <label for="description">Açıklama:</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Açıklama"></textarea>
                            </div>
                        </div>
                        <div style="float: right;">
                            <button class="btn btn-primary" type="button" onclick=""
                                id="animeEpisodeCreateSubmitButton">Kaydet</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.0.3/resumable.min.js"
            integrity="sha512-OmtdY/NUD+0FF4ebU+B5sszC7gAomj26TfyUUq6191kbbtBZx0RJNqcpGg5mouTvUh7NI0cbU9PStfRl8uE/rw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            //Anime bölümü oluşturma komutları
            var is_submitted = false;
            var episode_code = 0;
            var fileName = "";

            $(document).ready(function() {
                let browseFile = $('#video')

                var resumable = new Resumable({
                    target: "{{ route('admin_anime_episodes_create') }}",
                    query: {
                        _token: '{{ csrf_token() }}',
                    },
                    headers: {
                        'Accept': 'application/json',
                    },
                    testChunks: false,
                    throttleProgressCallbacks: 1,
                })

                resumable.assignBrowse(browseFile[0]);

                resumable.on('fileAdded', function(file) {
                    //Dosya seçildiğinde yapılacak işlemler

                });

                resumable.on('fileProgress', function(file) {
                    animeEpisodeCreatePercent(file.progress() * 100)
                });

                resumable.on('fileSuccess', function(file, response) {
                    //Video yükleme bittiğinde ve başarılı olduğunda
                    console.log(JSON.stringify(response));

                    console.log(response);
                    console.log(response.split('path":')[1])
                    console.log('once fileName: ' + fileName);
                    fileName = response.split('path":')[1].split('",')[0].replaceAll('"', '').replaceAll('\\',
                        '').replaceAll('public/', '');
                    console.log('sonra fileName: ' + fileName);
                    animeEpsiodeCreateMergeVideo();
                });

                resumable.on('fileError', function(file, response) {
                    //Başarısız olduğunda yapılacak işlemler

                    console.log('başarısız');
                    console.log(JSON.stringify(response));

                    animeEpisodeCreateError();
                });

                $('#animeEpisodeCreateSubmitButton').click(function() {
                    if (resumable.files.length > 0) {
                        //resumable.opts.target += '?anime_code= ' + $('#anime_code').val();
                        //resumable.upload();
                        var name = document.getElementById('name').value;
                        var season_short = document.getElementById('season_short').value;
                        var episode_short = document.getElementById('episode_short').value;
                        var publish_date = document.getElementById('publish_date').value;
                        var intro_start_time_min = document.getElementById('intro_start_time_min').value;
                        var intro_start_time_sec = document.getElementById('intro_start_time_sec').value;
                        var intro_end_time_min = document.getElementById('intro_end_time_min').value;
                        var intro_end_time_sec = document.getElementById('intro_end_time_sec').value;
                        if (season_short == "" || episode_short == "" || publish_date == "" ||
                            intro_start_time_min == "" || intro_start_time_sec == "" || intro_end_time_min ==
                            "" || intro_end_time_sec == "") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Hata',
                                text: 'Lütfen Gerekli Doldurunuz!',
                            })
                        } else {
                            is_submitted = true;
                            document.getElementById("animeEpisodeCreateSubmitButton").disabled = true;
                            Swal.fire({
                                title: "Yükleniyor..!",
                                text: "Video Yüklenmeye Başladı. Lütfen Tamamlanana kadar bu sayfayı kapatmayınız!",
                                icon: "warning"
                            });

                            var formData = new FormData(document.getElementById('animeEpisodeCreateForm'));

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
                                success: function(response) {
                                    // Yükleme tamamlandığında yapılacak işlemler
                                    console.log(JSON.stringify(response));
                                    if (response.success) {
                                        resumable.upload();
                                        episode_code = response.episode_code;
                                    } else {
                                        console.log("Aşama Bir de Hata");
                                        animeEpisodeCreateError();
                                        getNormalButtons();
                                    }

                                },
                                error: function(error) {
                                    // Hata durumunda yapılacak işlemler
                                    //console.log(error);
                                    animeEpisodeCreateError();
                                    console.log('Aşama 1');
                                    console.log('hata: ' + JSON.stringify(error));
                                }
                            });
                        }

                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Lütfen ilk önce video yükleniyiz.",
                            icon: "error"
                        });
                    }
                });

            });

            function animeEpsiodeCreateMergeVideo() {
                console.log('Dosya Birleştirme başladı');
                var formData3 = new FormData();
                formData3.append('episode_code', episode_code);
                formData3.append('path', fileName);

                console.log('fileName: ' +
                    fileName);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: '{{ route('admin_anime_merge_video_create') }}', // Dosya yüklemeyi işleyen PHP dosyanızın yolunu belirtin.
                    type: 'POST',
                    data: formData3,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Yükleme tamamlandığında yapılacak işlemler
                        if (response.success) {
                            Swal.fire({
                                title: "Başarılı",
                                text: "Video Başarılı Bir Şekilde Yüklendi. Sayfayı Kapatabilirsiniz.",
                                icon: "success"
                            });
                            document.getElementById('progress-bar-video').classList.remove('bg-danger', 'bg-warning', 'bg-success', 'bg-info');

                            document.getElementById('progress-bar-video').classList.add('bg-info');

                            document.getElementById('percentValue').innerText = "Tamamlandı"
                            getNormalButtons();
                        } else {
                            console.log("Aşama üç de Hata");
                            animeEpisodeCreateError();
                        }

                        getNormalButtons();

                    },
                    error: function(error) {
                        animeEpisodeCreateError();
                        console.log('Aşama 3');
                        console.log('hata: ' + JSON.stringify(error));
                    }
                });

            }

            function animeEpisodeCreatePercent(percent) {
                if (percent > 100) percent = 100;
                else if (percent < 0) percent = 0;
                const progressBar = document.getElementById('progress-bar-video');
                progressBar.classList.remove('bg-danger', 'bg-warning', 'bg-success', 'bg-info');

                // Yeni sınıf ekleme
                if (percent < 33) {
                    progressBar.classList.add('bg-danger');
                } else if (percent >= 33 && percent < 66) { // %50'den %66'ya ayarlandı
                    progressBar.classList.add('bg-warning');
                } else {
                    progressBar.classList.add('bg-success');
                }

                document.getElementById('percentValue').innerText = parseFloat(percent).toFixed(2) +
                    "%"

                progressBar.style.width = percent + '%';
            }

            function animeEpisodeCreateError() {
                Swal.fire({
                    title: "Error",
                    text: "Video yüklenirken bir hata meydana geldi.",
                    icon: "error"
                });
                document.getElementById('percentValue').innerText = "Hata"

                progressBar.classList.remove('bg-danger', 'bg-warning', 'bg-success', 'bg-info');

                document.getElementById('progress-bar-video').classList.add('bg-danger');

                document.getElementById('progress-bar-video').style.width = 100;


                getNormalButtons();
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

            //Sezon getirme komutu
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

        <script>
            $(document).ready(function() {
                getSeason();
            });
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
