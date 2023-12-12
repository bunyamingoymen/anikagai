@extends('index.themes.moviefx.layouts.main')
@section('index_content')
    <div class="inner-content container" id="page-series">
        <div id="router-view">
            <div class="bg-cover-faker">
                <div class="ui grid">
                    <div class="left floated sixteen wide tablet nine wide computer column">
                        <a href="#">
                            <h1 class="page-title">{{ $anime->name }}<span class="light-title">({{ $anime->date }})</span>
                            </h1>
                        </a>
                    </div>
                    <div class="right aligned floated sixteen wide tablet seven wide computer column"
                        id="series-action-buttons">
                        @if (Auth::user())
                            <div class="button-group">
                                @if ($followed)
                                    <button class="ui primary button fnc_addFollow" onclick="unfollowAnime()">+ Takip
                                        Ediliyor</button>
                                @else
                                    <button class="ui secondary button fnc_addFollow" onclick="followAnime()">+ Takip
                                        Et</button>
                                @endif
                                @if ($liked)
                                    <button class="ui primary button fnc_addFollow" onclick="dislikeAnime()"> <i
                                            class="fa-solid fa-heart"></i>
                                        Beğenildi</button>
                                @else
                                    <button class="ui secondary button fnc_addFollow" onclick="likeAnime()"> <i
                                            class="fa-solid fa-heart"></i>
                                        Beğen</button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div id="series-tabs" class="ui pointing secondary menu">
                    <a class="item active" data-tab="first">Genel Bakış</a>
                </div>
                <div class="ui tab tab-segment active" data-tab="first">
                    <div class="ui items">
                        <div class="item" id="series-profile-wrapper">
                            <a class="ui image" id="series-profile-image-wrapper">
                                <img class="series-profile-thumb" src="../../../{{ $anime->image }}"
                                    alt="{{ $anime->name }}" style="min-width: 300px; max-width: 300px;" />
                            </a>
                            <div class="content" id="series-profile-content-wrapper">
                                <article class="series-summary">
                                    <div class="series-summary-wrapper">
                                        <h2 class="section-heading">Genel Bakış</h2>
                                        <p id="tv-series-desc">
                                            {{ $anime->description }}
                                        </p>
                                    </div>
                                    <div class="ui list">
                                        <div class="item">
                                            <span class="label">Kategori:</span>
                                            <!--TODO Kategori arama yap-->
                                            <a
                                                href="{{ url('search?query=' . $anime->main_category_name ?? 'Genel') }}"title="{{ $anime->main_category_name ?? 'Genel' }}">
                                                {{ $anime->main_category_name ?? 'Genel' }}
                                            </a>,
                                            @foreach ($categories as $item)
                                                <a href="#"title="{{ $item->name }}">{{ $item->name }}</a>,
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="media-meta">
                                        <table class="ui unstackable single line celled table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div>Süre</div>
                                                        <div>{{ $anime->average_min }} dk</div>
                                                    </td>
                                                    <td>
                                                        <div>Görüntülenme</div>
                                                        <div>{{ $anime->click_count }}</div>
                                                    </td>
                                                    <td>
                                                        <div>Puanı</div>
                                                        <div class="color-imdb">{{ $anime->score }} / 5 </div>
                                                    </td>
                                                    <td>
                                                        <div>Yapım Yılı</div>
                                                        <div class="truncate">{{ $anime->date }}</div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div {{ $firstEpisodeUrl != 'none' ? 'class="first_and_last"' : 'hidden' }}>
                                        <a id="movie_episode" title="{{ $anime->name }} İlk Bölümü izle"
                                            href="{{ url($firstEpisodeUrl) }}">
                                            <div>

                                            </div>
                                            <div>
                                                <span style="margin-right:5%;"><i class="fa-solid fa-play"></i></span>
                                                <span>İlk Bölümü İzle</span>
                                            </div>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>

                    <div class="common-lists pt-sm">
                        <div class="ui column">
                            <div class="sixteen wide tablet eleven wide computer column">
                                <h4 class="sidebar-heading" id="season-episode-list-title"> {{ $anime->name }} Bölümleri
                                </h4>
                                <section class="episodes-box">
                                    @if ($anime->season_count == 0)
                                        <p>Bu Animeye Ait Herhangi Bir Bölüm Mevcut Değil</p>
                                    @else
                                        <div class="ui grid">
                                            <div class="sixteen wide tablet three wide computer column" id="seasons-menu">
                                                <div class="ui vertical fluid tabular menu">
                                                    @for ($i = $anime->season_count; $i >= 1; $i--)
                                                        <a href="javascript:;" class="item {{ $i == 1 ? 'active' : '' }}"
                                                            id="season_{{ $i }}_tab_button"
                                                            onclick="changeSeason('season_{{ $i }}_tab_button', 'season_{{ $i }}_tab')">
                                                            {{ $i }}.sezon
                                                        </a>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div
                                                class="sixteen wide tablet thirteen wide stretched computer column season-list-column">

                                                @for ($i = $anime->season_count; $i >= 1; $i--)
                                                    <div id="season_{{ $i }}_tab"
                                                        class="ui tab {{ $i == 1 ? 'active' : '' }}">
                                                        <div class="tabular-content">
                                                            <div class="episodes-list">
                                                                <div class="ui list">
                                                                    @if (count($anime_episodes->where('season_short', $i)) == 0)
                                                                        <div class="alert alert-danger" role="alert">
                                                                            {{ $i . 'sezona ait bir bölüm mevcut değil' }}
                                                                        </div>
                                                                    @else
                                                                        @foreach ($anime_episodes->where('season_short', $i) as $item)
                                                                            <div class="item season_{{ $i }}">
                                                                                <table class="ui basic unstackable table">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td
                                                                                                class="collapsing table-episode-check">
                                                                                                <div class="ordilabel">
                                                                                                    <a href="#"
                                                                                                        data-navigo>
                                                                                                        {{ $item->episode_short }}.Bölüm</a>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td id="table-episodes-title"
                                                                                                class="table-episodes-title">
                                                                                                <h6 class="truncate">
                                                                                                    <a
                                                                                                        href="{{ url('anime/' . $anime->short_name . '/' . $i . '/' . $item->episode_short) }}">
                                                                                                        {{ $item->name }}
                                                                                                    </a>
                                                                                                </h6>
                                                                                            </td>
                                                                                            <td class="episode-date">
                                                                                                {{ $item->publish_date }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor

                                            </div>
                                        </div>
                                    @endif
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-cover-bg"><img src="../../../{{ $anime->image }}" />
            </div>
        </div>
        <div class="dark-segment">
            <div class="segment-title">Benzerleri</div>
            <ul class="clearfix new-tvseries">
                @foreach ($trend_animes as $item)
                    <li class="segment-poster-sm">
                        <div class="poster poster-xs">
                            <a href="{{ url('anime/' . $item->short_name) }}" title="{{ $item->name }}">
                                <img class="lazy-wide" src="../../../{{ $item->image }}" alt="{{ $item->name }}"
                                    data-src="../../../{{ $item->image }}">
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div id="hiddenDiv">

    </div>

    <!--Takip Ve Beğenmelerle ilgili fonksiyonlar-->
    <script>
        const authMessage = "Lütfen İlk Önce Giriş Yapınız!"

        function followAnime() {
            @if (Auth::user())
                var code = `<form action="{{ route('followAnime') }}" method="POST" id="followAnimeForm">
                            @csrf
                            <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                            <input type="text" name="anime_code" value="{{ $anime->code }}">
                        </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('followAnimeForm').submit();
            @else
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }

        function unfollowAnime() {
            @if (Auth::user())
                var code = `<form action="{{ route('unfollowAnime') }}" method="POST" id="unfollowAnimeForm">
                @csrf
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="anime_code" value="{{ $anime->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('unfollowAnimeForm').submit();
            @else
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }

        function likeAnime() {
            @if (Auth::user())
                var code = `<form action="{{ route('likeAnime') }}" method="POST" id="likeAnimeForm">
                @csrf
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="anime_code" value="{{ $anime->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('likeAnimeForm').submit();
            @else
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }

        function dislikeAnime() {
            @if (Auth::user())
                var code = `<form action="{{ route('unlikeAnime') }}" method="POST" id="unlikeAnimeForm">
                @csrf
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="anime_code" value="{{ $anime->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('unlikeAnimeForm').submit();
            @else
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }
    </script>

    <!--Sezon değiştirme fonksiyonları-->
    <script>
        var active_season_tab_button_id = "season_1_tab_button";
        var active_season_tab_id = "season_1_tab";

        function changeSeason(new_season_tab_button_id, new_season_tab_id) {
            document.getElementById(active_season_tab_button_id).classList.remove("active");
            document.getElementById(active_season_tab_id).classList.remove("active");

            document.getElementById(new_season_tab_button_id).classList.add("active");
            document.getElementById(new_season_tab_id).classList.add("active");

            active_season_tab_button_id = new_season_tab_button_id;
            active_season_tab_id = new_season_tab_id;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var publish_dates = document.getElementsByClassName('episode-date')

            for (let i = 0; i < publish_dates.length; i++) {
                const date = publish_dates[i].innerText
                if (date.split('-').length == 3) {
                    publish_dates[i].innerText = getTurkishDate(date.split('-')[0], date.split('-')[1], date.split(
                        '-')[2])
                } else {
                    console.log('hatalı')
                }
            }
        })

        function getTurkishDate(year, month, day) {
            return day + " " + getTurkishMont(month) + " " + year;
        }

        function getTurkishMont(month) {
            if (month === "1" || month === "01") return "Ocak";
            else if (month === "2" || month === "02") return "Şubat";
            else if (month === "3" || month === "03") return "Mart";
            else if (month === "4" || month === "04") return "Nisan";
            else if (month === "5" || month === "05") return "Mayıs";
            else if (month === "6" || month === "06") return "Haziran";
            else if (month === "7" || month === "07") return "Temmuz";
            else if (month === "8" || month === "08") return "Ağustos";
            else if (month === "9" || month === "09") return "Eylül";
            else if (month === "10") return "Ekim";
            else if (month === "11") return "Kasım";
            else if (month === "12") return "Aralık";
            else return "Not";
        }
    </script>
@endsection
