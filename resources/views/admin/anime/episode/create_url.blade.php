@extends('admin.layouts.main')
@section('admin_content')
    @if ($create == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" id="animeEpisodeCreateURLForm"
                            action="{{ route('admin_anime_episodes_create_url') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!--Bölüm Adı, Anime, Bulunduğu Sezon-->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="name">Bölüm Adı:</label>
                                    <input type="text" id="name" name="name" class="form-control" value="">
                                </div>
                                <div class="col-md-3">
                                    <label for="anime_code">Anime <strong style="color:red;">*</strong>:</label>
                                    <select name="anime_code" id="anime_code" class="form-control" onchange="getSeason();"
                                        required>
                                        @foreach ($animes as $anime)
                                            <option value="{{ $anime->code }}">{{ $anime->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="season_short">Bulunduğu Sezon <strong style="color:red;">*</strong>:</label>
                                    <select name="season_short" id="season_short" class="form-control">
                                        @for ($i = 1; $i <= $animes->first()->season_count + 1; $i++)
                                            <option value="{{ $i }}">{{ $i }}.sezon</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="episode_short">Bölüm Sırası <strong style="color:red;">*</strong>:</label>
                                    <input type="number" id="episode_short" name="episode_short" class="form-control"
                                        value="1" required>
                                </div>
                            </div>

                            <!--Video Dakikası, Video Saniyesi, Yayınlanma Tarihi-->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="video_minute">Video Dakikası: </label>
                                    <input type="text" id="video_minute" name="video_minute" class="form-control"
                                        placeholder="Video Kaç Dakika?" value="0">
                                </div>
                                <div class="col-md-3">
                                    <label for="video_second">Video Saniyesi: </label>
                                    <input type="text" id="video_second" name="video_second" class="form-control"
                                        placeholder="Video Kaç Saniye?" value="0">
                                </div>
                                <div class="col-md-6 ">
                                    <label for="publish_date">Yayınlanma Tarihi <strong
                                            style="color:red;">*</strong>:</label>
                                    <input type="date" id="publish_date" name="publish_date" class="form-control"
                                        value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
                                </div>
                            </div>

                            <!--İntro Zamanları-->
                            <div class="row mb-3">
                                <div class="col-md-3 ">
                                    <label for="intro_start_time_min">İntro başlangıç zamanı dakikası:</label>
                                    <input type="number" id="intro_start_time_min" name="intro_start_time_min"
                                        class="form-control" placeholder="İntro Başlangıç Zamanı Dakikası (örn:0)"
                                        value="0" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="intro_start_time_sec">İntro başlangıç zamanı saniyesi:</label>
                                    <input type="number" id="intro_start_time_sec" name="intro_start_time_sec"
                                        class="form-control" placeholder="İntro Başlangıç Zamanı Saniyesi (örn:35)"
                                        value="0" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="intro_end_time_min">İntro bitiş zamanı dakikası:</label>
                                    <input type="number" id="intro_end_time_min" name="intro_end_time_min"
                                        class="form-control" placeholder="İntro Bitiş Zamanı Saniyesi (örn:1)"
                                        value="0" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="intro_end_time_sec">İntro bitiş zamanı saniyesi:</label>
                                    <input type="number" id="intro_end_time_sec" name="intro_end_time_sec"
                                        class="form-control" placeholder="İntro Bitiş Zamanı Saniyesi (örn:45)"
                                        value="0" required>
                                </div>
                            </div>

                            <!--Sonraki Bölüm Zamanları-->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="next_episode_time_min">Sonraki Bölüm Butonu Başlangıç Dakikası:</label>
                                    <input type="text" id="next_episode_time_min" name="next_episode_time_min"
                                        placeholder="Sonraki Bölüm Butonu İçin Başlangıç Dakikası Giriniz"
                                        class="form-control" value="0">
                                </div>
                                <div class="col-md-6">
                                    <label for="next_episode_time_sec">Sonraki Bölüm Butonu Başlangıç Saniyesi:</label>
                                    <input type="text" id="next_episode_time_sec" name="next_episode_time_sec"
                                        placeholder="Sonraki Bölüm Butonu İçin Başlangıç Saniyesini Giriniz"
                                        class="form-control" value="0">
                                </div>
                            </div>

                            <!-- URL/Embed-->
                            <div class="row mb-3">
                                <div class="col-lg-2">
                                    <div>
                                        <label for="video">URL/Embed Tipi <strong
                                                style="color:red;">*</strong>:</label>
                                    </div>
                                    <div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="select_url" name="is_url" value="1"
                                                class="custom-control-input" checked>
                                            <label class="custom-control-label" for="select_url">URL</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="select_embed" name="is_url" value="2"
                                                class="custom-control-input">
                                            <label class="custom-control-label" for="select_embed">Embed</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <label for="video">URL/Embed İçeriği <strong style="color:red;">*</strong>:
                                    </label>
                                    <input type="text" id="video" name="video" class="form-control">
                                </div>
                            </div>

                            <!--Açıklama-->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="validationCustom03">Açıklama:</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                                        placeholder="Açıklama"></textarea>
                                </div>
                            </div>

                            <!--İntroyu atla ve sonrkai bölüm checkbox'ları-->
                            <div class="mb-3">
                                <div>
                                    <input type="checkbox" id="show_intro_button" name="show_intro_button" checked>
                                    <label for="show_intro_button">İntroyu Atla Butonunu Göster</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="show_next_episode_button" name="show_next_episode_button"
                                        checked>
                                    <label for="show_next_episode_button">Sonraki Bölüme Geç Butonunu Göster</label>
                                </div>
                            </div>

                            <!--Buton-->
                            <div style="float: right;">
                                <button class="btn btn-primary" type="button"
                                    onclick="animeEpisodeCreateURLFormSubmit()">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var season_counts = {};
            @foreach ($animes as $item)
                season_counts['{{ $item->code }}'] = {{ $item->season_count }};
            @endforeach

            //Sezon getirme komutu
            function getSeason() {
                var anime_code = document.getElementById('anime_code').value;
                var code = ``;
                for (let i = 1; i <= season_counts[anime_code] + 1; i++)
                    code += `<option value="${i}">${i}.sezon</option>`;

                document.getElementById('season_short').innerHTML = code;
            }

            function animeEpisodeCreateURLFormSubmit() {
                var anime_code = document.getElementById('anime_code').value;
                var season_short = document.getElementById('season_short').value;
                var episode_short = document.getElementById('episode_short').value;
                var publish_date = document.getElementById('publish_date').value;

                var video = document.getElementById('video').value;

                if (anime_code == "" || season_short == "" || episode_short == "" || publish_date == "" || video == "") {
                    var empty = "Boş olan alanlar: ";
                    if (anime_code == "") empty += 'Anime, ';
                    if (season_short == "") empty += 'Bulunduğu Sezon, ';
                    if (season_short == "") empty += 'Bölüm Sırası, ';
                    if (publish_date == "") empty += 'Yayınlandığı tarih, ';
                    if (video == "") empty += 'Video Linki ';
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Lütfen Gerekli Doldurunuz!' + empty,
                    })
                } else {
                    document.getElementById('animeEpisodeCreateURLForm').submit();
                }
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
