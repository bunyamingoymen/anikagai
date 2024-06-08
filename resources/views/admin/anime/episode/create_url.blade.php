@extends('admin.layouts.main')
@section('admin_content')
    @if ($create == 1)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" id="animeEpisodeUpdateForm" action="" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name">Bölüm Adı:</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ $anime_episode->name ?? '' }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="season_short">Bulunduğu Sezon:</label>
                                    <select name="season_short" id="season_short" class="form-control" required>
                                        <option value="1. Sezon">1. Sezon</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="episode_short">Bölüm Sırası:</label>
                                    <input type="number" id="episode_short" name="episode_short" class="form-control"
                                        value="{{ $anime_episode->episode_short ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="publish_date">Yayınlanma Tarihi:</label>
                                    <input type="date" id="publish_date" name="publish_date" class="form-control"
                                        value="{{ $anime_episode->publish_date ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="intro_start_time_min">İntro başlangıç zamanı dakikası:</label>
                                    <input type="number" id="intro_start_time_min" name="intro_start_time_min"
                                        class="form-control" placeholder="İntro Başlangıç Zamanı Dakikası (örn:0)"
                                        value="{{ $anime_episode->intro_start_time_min ?? '' }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="intro_start_time_sec">İntro başlangıç zamanı saniyesi:</label>
                                    <input type="number" id="intro_start_time_sec" name="intro_start_time_sec"
                                        class="form-control" placeholder="İntro Başlangıç Zamanı Saniyesi (örn:35)"
                                        value="{{ $anime_episode->intro_start_time_sec ?? '' }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="intro_end_time_min">İntro bitiş zamanı dakikası:</label>
                                    <input type="number" id="intro_end_time_min" name="intro_end_time_min"
                                        class="form-control" placeholder="İntro Bitiş Zamanı Saniyesi (örn:1)"
                                        value="{{ $anime_episode->intro_end_time_min ?? '' }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="intro_end_time_sec">İntro bitiş zamanı saniyesi:</label>
                                    <input type="number" id="intro_end_time_sec" name="intro_end_time_sec"
                                        class="form-control" placeholder="İntro Bitiş Zamanı Saniyesi (örn:45)"
                                        value="{{ $anime_episode->intro_end_time_sec ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom03">Açıklama:</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Açıklama">{{ $anime_episode->description ?? '' }}</textarea>
                                </div>
                            </div>
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
                    //document.getElementById('code').value = "{{ $anime_episode->code ?? '' }}";
                    document.getElementById('animeEpisodeUpdateForm').submit();
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
