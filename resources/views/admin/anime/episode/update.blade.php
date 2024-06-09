@extends('admin.layouts.main')
@section('admin_content')
    @if ($update == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" id="animeEpisodeUpdateForm" action="" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <!--code, anime_code, isim, sezon, bölüm sırası-->
                            <div class="row mb-3">
                                <div hidden>
                                    <input type="text" id='code' name='code' value="{{ $anime_episode->code }}">
                                    <input type="text" id='anime_code' name='anime_code' value="{{ $anime->code }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Bölüm Adı:</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ $anime_episode->name }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="season_short">Bulunduğu Sezon:</label>
                                    <select name="season_short" id="season_short" class="form-control" required>
                                        @for ($i = 1; $i <= $anime->season_count + 1; $i++)
                                            @if ($anime_episode->season_short == $i)
                                                <option value="{{ $i }}" selected>{{ $i }}.sezon
                                                </option>
                                            @else
                                                <option value="{{ $i }}">{{ $i }}.sezon</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="episode_short">Bölüm Sırası:</label>
                                    <input type="number" id="episode_short" name="episode_short" class="form-control"
                                        value="{{ $anime_episode->episode_short }}" required>
                                </div>
                            </div>

                            <!--Video Dakiası, Video Saniyesi, Yayınlanma tarihi-->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="video_minute">Video Dakikası: </label>
                                    <input type="text" id="video_minute" name="video_minute" class="form-control"
                                        placeholder="Video Kaç Dakika?" value="{{ $anime_episode->video_minute ?? '0' }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="video_second">Video Saniyesi: </label>
                                    <input type="text" id="video_second" name="video_second" class="form-control"
                                        placeholder="Video Kaç Saniye?" value="{{ $anime_episode->video_second ?? '0' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="publish_date">Yayınlanma Tarihi:</label>
                                    <input type="date" id="publish_date" name="publish_date" class="form-control"
                                        value="{{ $anime_episode->publish_date ?? Carbon\Carbon::now()->format('Y-m-d') }}"
                                        required>
                                </div>
                            </div>

                            <!--İntro zamanları-->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="intro_start_time_min">İntro başlangıç zamanı dakikası:</label>
                                    <input type="number" id="intro_start_time_min" name="intro_start_time_min"
                                        class="form-control" placeholder="İntro Başlangıç Zamanı Dakikası (örn:0)"
                                        value="{{ $anime_episode->intro_start_time_min ?? '0' }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="intro_start_time_sec">İntro başlangıç zamanı saniyesi:</label>
                                    <input type="number" id="intro_start_time_sec" name="intro_start_time_sec"
                                        class="form-control" placeholder="İntro Başlangıç Zamanı Saniyesi (örn:35)"
                                        value="{{ $anime_episode->intro_start_time_sec ?? '0' }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="intro_end_time_min">İntro bitiş zamanı dakikası:</label>
                                    <input type="number" id="intro_end_time_min" name="intro_end_time_min"
                                        class="form-control" placeholder="İntro Bitiş Zamanı Saniyesi (örn:1)"
                                        value="{{ $anime_episode->intro_end_time_min ?? '0' }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="intro_end_time_sec">İntro bitiş zamanı saniyesi:</label>
                                    <input type="number" id="intro_end_time_sec" name="intro_end_time_sec"
                                        class="form-control" placeholder="İntro Bitiş Zamanı Saniyesi (örn:45)"
                                        value="{{ $anime_episode->intro_end_time_sec ?? '0' }}" required>
                                </div>
                            </div>

                            <!--Sonraki Bölüm Zamanları-->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="next_episode_time_min">Sonraki Bölüm Butonu Başlangıç Dakikası:</label>
                                    <input type="text" id="next_episode_time_min" name="next_episode_time_min"
                                        placeholder="Sonraki Bölüm Butonu İçin Başlangıç Dakikası Giriniz"
                                        class="form-control" value="{{ $anime_episode->next_episode_time_min ?? '0' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="next_episode_time_sec">Sonraki Bölüm Butonu Başlangıç Saniyesi:</label>
                                    <input type="text" id="next_episode_time_sec" name="next_episode_time_sec"
                                        placeholder="Sonraki Bölüm Butonu İçin Başlangıç Saniyesini Giriniz"
                                        class="form-control" value="{{ $anime_episode->next_episode_time_sec ?? '0' }}">
                                </div>
                            </div>

                            <!-- URL/Embed-->
                            @if (isset($anime_episode->is_url) && ($anime_episode->is_url == 1 || $anime_episode->is_url == 2))
                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <div>
                                            <label for="video">URL/Embed Tipi <strong
                                                    style="color:red;">*</strong>:</label>
                                        </div>
                                        <div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="select_url" name="is_url" value="1"
                                                    class="custom-control-input"
                                                    {{ $anime_episode->is_url == 1 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="select_url">URL</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="select_embed" name="is_url" value="2"
                                                    class="custom-control-input"
                                                    {{ $anime_episode->is_url == 2 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="select_embed">Embed</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <label for="video">URL/Embed İçeriği <strong style="color:red;">*</strong>:
                                        </label>
                                        <input type="text" id="video" name="video" class="form-control"
                                            value="{{ $anime_episode->video }}">
                                    </div>
                                </div>
                            @endif

                            <!--Açıklama-->
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03">Açıklama:</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10"
                                        placeholder="Açıklama">{{ $anime_episode->description }}</textarea>
                                </div>
                            </div>

                            <!--İntroyu atla ve sonrkai bölüm checkbox'ları-->
                            <div class="mb-3">
                                <div>
                                    <input type="checkbox" id="show_intro_button" name="show_intro_button"
                                        {{ isset($anime_episode->show_intro_button) && $anime_episode->show_intro_button == 1 ? 'checked' : '' }}>
                                    <label for="show_intro_button">İntroyu Atla Butonunu Göster</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="show_next_episode_button" name="show_next_episode_button"
                                        {{ isset($anime_episode->show_next_episode_button) && $anime_episode->show_next_episode_button == 1 ? 'checked' : '' }}>
                                    <label for="show_next_episode_button">Sonraki Bölüme Geç Butonunu Göster</label>
                                </div>
                            </div>

                            <!--Buton-->
                            <div style="float: right;">
                                <button class="btn btn-primary" type="button"
                                    onclick="animeEpisodeUpdateFormSubmit()">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function animeEpisodeUpdateFormSubmit() {
                var name = document.getElementById('name').value;
                var season_short = document.getElementById('season_short').value;
                var episode_short = document.getElementById('episode_short').value;
                var publish_date = document.getElementById('publish_date').value;

                var intro_start_time_min = document.getElementById('intro_start_time_min').value;
                var intro_start_time_sec = document.getElementById('intro_start_time_sec').value;
                var intro_end_time_min = document.getElementById('intro_end_time_min').value;
                var intro_end_time_sec = document.getElementById('intro_end_time_sec').value;

                if (season_short == "" || episode_short == "" || publish_date == "" ||
                    intro_start_time_min == "" || intro_start_time_sec == "" || intro_end_time_min == "" ||
                    intro_end_time_sec == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Lütfen Gerekli Doldurunuz!',
                    })
                } else {
                    document.getElementById('code').value = "{{ $anime_episode->code }}";
                    document.getElementById('anime_code').value = "{{ $anime->code }}";
                    document.getElementById('animeEpisodeUpdateForm').submit();
                }
            }
        </script>
    @endif
    <script>
        // Sayfa yüklenmeden önce bu JavaScript kodu çalışacak
        window.addEventListener('DOMContentLoaded', (event) => {
            // Değişkenin değerini kontrol et
            @if ($update == 0)
                // Değişken doğru ise yönlendirme yap
                window.location.href = '{{ route('admin_index') }}';
            @endif
        });
    </script>
@endsection
