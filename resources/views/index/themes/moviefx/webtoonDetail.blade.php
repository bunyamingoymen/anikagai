@extends('index.themes.moviefx.layouts.main')
@section('index_content')
    <div class="inner-content container" id="page-series">
        <div id="router-view">
            <div class="bg-cover-faker">
                <div class="ui grid">
                    <div class="left floated sixteen wide tablet nine wide computer column">
                        <a href="#">
                            <h1 class="page-title">{{ $webtoon->name }}<span class="light-title">({{ $webtoon->date }})</span>
                            </h1>
                        </a>
                    </div>
                    <div class="right aligned floated sixteen wide tablet seven wide computer column"
                        id="series-action-buttons">
                        @if (Auth::user())
                            <div class="button-group">
                                @if ($followed)
                                    <button class="ui primary button fnc_addFollow" onclick="unfollowWebtoon()">+ Takip
                                        Ediliyor</button>
                                @else
                                    <button class="ui secondary button fnc_addFollow" onclick="followWebtoon()">+ Takip
                                        Et</button>
                                @endif
                                @if ($liked)
                                    <button class="ui primary button fnc_addFollow" onclick="dislikeWebtoon()"> <i
                                            class="fa-solid fa-heart"></i>
                                        Beğenildi</button>
                                @else
                                    <button class="ui secondary button fnc_addFollow" onclick="likeWebtoon()"> <i
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
                                <img class="series-profile-thumb" src="../../../{{ $webtoon->image }}"
                                    alt="{{ $webtoon->name }}" width="300" height="451" />
                            </a>
                            <div class="content" id="series-profile-content-wrapper">
                                <article class="series-summary">
                                    <div class="series-summary-wrapper">
                                        <h2 class="section-heading">Genel Bakış</h2>
                                        <p id="tv-series-desc">
                                            {{ $webtoon->description }}
                                        </p>
                                    </div>
                                    <div class="ui list">
                                        <div class="item">
                                            <span class="label">Kategori:</span>
                                            <!--TODO Kategori arama yap-->
                                            <a href="#"title="{{ $webtoon->main_category_name ?? 'Genel' }}">
                                                {{ $webtoon->main_category_name ?? 'Genel' }}
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
                                                        <div>{{ $webtoon->average_min }} dk</div>
                                                    </td>
                                                    <td>
                                                        <div>Görüntülenme</div>
                                                        <div>{{ $webtoon->click_count }}</div>
                                                    </td>
                                                    <td>
                                                        <div>Puanı</div>
                                                        <div class="color-imdb">{{ $webtoon->score }} / 5 </div>
                                                    </td>
                                                    <td>
                                                        <div>Yapım Yılı</div>
                                                        <div class="truncate">{{ $webtoon->date }}</div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div {{ $firstEpisodeUrl != 'none' ? 'class="first_and_last"' : 'hidden' }}>
                                        <a id="movie_episode" title="{{ $webtoon->name }} İlk Bölümü izle"
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
                                <h4 class="sidebar-heading" id="season-episode-list-title"> {{ $webtoon->name }} Bölümleri
                                </h4>
                                <section class="episodes-box">
                                    @if ($webtoon->season_count == 0)
                                        <p>Bu Webtoon'a Ait Herhangi Bir Bölüm Mevcut Değil</p>
                                    @else
                                        <div class="ui grid">
                                            <div class="sixteen wide tablet three wide computer column" id="seasons-menu">
                                                <div class="ui vertical fluid tabular menu">
                                                    @for ($i = $webtoon->season_count; $i >= 1; $i--)
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

                                                @for ($i = $webtoon->season_count; $i >= 1; $i--)
                                                    <div id="season_{{ $i }}_tab"
                                                        class="ui tab {{ $i == 1 ? 'active' : '' }}">
                                                        <div class="tabular-content">
                                                            <div class="episodes-list">
                                                                <div class="ui list">
                                                                    @if (count($webtoon_episodes->where('season_short', $i)) == 0)
                                                                        <div class="alert alert-danger" role="alert">
                                                                            {{ $i . 'sezona ait bir bölüm mevcut değil' }}
                                                                        </div>
                                                                    @else
                                                                        @foreach ($webtoon_episodes->where('season_short', $i) as $item)
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
                                                                                                        href="{{ url('webtoon/' . $webtoon->short_name . '/' . $i . '/' . $item->episode_short) }}">
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
            <div class="bg-cover-bg"><img src="../../../{{ $webtoon->image }}" />
            </div>
        </div>
        <div class="dark-segment">
            <div class="segment-title">Benzerleri</div>
            <ul class="clearfix new-tvseries">
                @foreach ($trend_webtoons as $item)
                    <li class="segment-poster-sm">
                        <div class="poster poster-xs">
                            <a href="{{ url('webtoon/' . $item->short_name) }}" title="{{ $item->name }}">
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

        function followWebtoon() {
            @if (Auth::user())
                var code = `<form action="{{ route('followWebtoon') }}" method="POST" id="followWebtoonForm">
                            @csrf
                            <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                            <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
                        </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('followWebtoonForm').submit();
            @else
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }

        function unfollowWebtoon() {
            @if (Auth::user())
                var code = `<form action="{{ route('unfollowWebtoon') }}" method="POST" id="unfollowWebtoonForm">
                @csrf
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('unfollowWebtoonForm').submit();
            @else
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }

        function likeWebtoon() {
            @if (Auth::user())
                var code = `<form action="{{ route('likeWebtoon') }}" method="POST" id="likeWebtoonForm">
                @csrf
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('likeWebtoonForm').submit();
            @else
                Swal.fire({
                    title: "Hata",
                    text: authMessage,
                    color: "#fff",
                    icon: "error"
                });
            @endif
        }

        function dislikeWebtoon() {
            @if (Auth::user())
                var code = `<form action="{{ route('unlikeWebtoon') }}" method="POST" id="unlikeWebtoonForm">
                @csrf
                <input type="text" name="user_code" value="{{ Auth::user()->code }}">
                <input type="text" name="webtoon_code" value="{{ $webtoon->code }}">
            </form>`;
                document.getElementById('hiddenDiv').innerHTML = code;
                document.getElementById('unlikeWebtoonForm').submit();
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
