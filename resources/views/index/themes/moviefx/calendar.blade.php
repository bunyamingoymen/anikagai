@extends('index.themes.moviefx.layouts.main')
@section('index_content')
    <style>
        .unknown_content {
            filter: blur(3px);
        }
    </style>
    <div data-gets data-type="hdr"></div>
    <h1 class="page-title pt-sm pb-lg">Takvim</h1>


    <section class="user-profile bg-cover-faker">
        <div class="ui grid">
            <div id="profile-content" class="floated sixteen wide tablet twelve wide computer column">
                <!--Tab butonları-->
                <div class="ui top tabular menu">
                    @if ($data['anime_active']->value == 1 && $showAnime == 1)
                        <a id="tabButtonAnimeCalendar" class="item tabButton active" href="javascript:;"
                            onclick="changeTab('tabButtonAnimeCalendar', 'anime-calendar-tab')">
                            Anime Takvimi</a>
                    @endif
                    @if ($data['webtoon_active']->value == 1 && $showWebtoon == 1)
                        <a id="tabButtonWebtoonCalendar" class="item tabButton" href="javascript:;"
                            onclick="changeTab('tabButtonWebtoonCalendar', 'webtoon-calendar-tab')">
                            Webtoon Takvimi</a>
                    @endif
                </div>

                <!--Anime Takvimi-->
                <div class="ui bottom attached tab segment active" id="anime-calendar-tab">
                    @foreach ($groupedAnimeCalendarLists as $date => $group)
                        <div class="calendar-item">
                            <div class="date specialDates">
                                <div hidden class="specialDatesFull">{{ $date }}</div>
                                <span class="specialDatesDayName"></span>
                                <strong class="specialDatesDay"></strong>
                                <span class="specialDatesMonthName"></span>
                            </div>
                            <div class="calendar-item-list">
                                <div class="dark-segment">
                                    <ul class="clearfix">
                                        @foreach ($group as $item)
                                            @if ($item->anime_show_status == 0 || (Auth::user() && ($item->anime_show_status == 1 || $item->anime_show_status == 2)))
                                                <li class="segment-poster-sm tv-season-new">
                                                    <div class="poster poster-xs">
                                                        <a href="{{ url('anime/' . $item->anime_short_name) }}">
                                                            <div class="poster-subject">
                                                                <h2 class="truncate">{{ $item->anime_name }}</h2>
                                                                <p class="poster-meta">
                                                                    <span
                                                                        class="episode-no">{{ $item->anime_calendar_description }}</span>
                                                                </p>
                                                            </div>
                                                            <img class="" alt="{{ $item->anime_name }}"
                                                                src="../../../{{ $item->anime_image }}">
                                                        </a>
                                                    </div>
                                                </li>
                                            @else
                                                <li class="segment-poster-sm tv-season-new">
                                                    <div class="poster poster-xs">
                                                        <a href="javascript:;">
                                                            <div class="poster-subject">
                                                                <h2 class="truncate">Bilinmiyor</h2>
                                                                <p class="poster-meta">
                                                                    <span class="episode-no"></span>
                                                                </p>
                                                            </div>
                                                            <img class="unknown_content" alt="Bilinmiyor"
                                                                src="../../../{{ $item->anime_image }}">
                                                        </a>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!--Webtoon Takvimi-->
                <div class="ui bottom attached tab segment" id="webtoon-calendar-tab">
                    @foreach ($groupedWebtoonCalendarLists as $date => $group)
                        <div class="calendar-item">
                            <div class="date specialDates">
                                <div hidden class="specialDatesFull">{{ $date }}</div>
                                <span class="specialDatesDayName"></span>
                                <strong class="specialDatesDay"></strong>
                                <span class="specialDatesMonthName"></span>
                            </div>
                            <div class="calendar-item-list">
                                <div class="dark-segment">
                                    <ul class="clearfix">
                                        @foreach ($group as $item)
                                            @if (
                                                $item->webtoon_show_status == 0 ||
                                                    (Auth::user() && ($item->webtoon_show_status == 1 || $item->webtoon_show_status == 2)))
                                                <li class="segment-poster-sm tv-season-new">
                                                    <div class="poster poster-xs">
                                                        <a href="{{ url('webtoon/' . $item->webtoon_short_name) }}">
                                                            <div class="poster-subject">
                                                                <h2 class="truncate">{{ $item->webtoon_name }}</h2>
                                                                <p class="poster-meta">
                                                                    <span
                                                                        class="episode-no">{{ $item->webtoon_calendar_description }}</span>
                                                                </p>
                                                            </div>
                                                            <img alt="{{ $item->webtoon_name }}"
                                                                src="../../../{{ $item->webtoon_image }}">
                                                        </a>
                                                    </div>
                                                </li>
                                            @else
                                                <li class="segment-poster-sm tv-season-new">
                                                    <div class="poster poster-xs">
                                                        <a href="javascript:;">
                                                            <div class="poster-subject">
                                                                <h2 class="truncate">Bilinmiyor</h2>
                                                                <p class="poster-meta">
                                                                    <span class="episode-no"></span>
                                                                </p>
                                                            </div>
                                                            <img class="unknown_content" alt="Bilinmiyor"
                                                                src="../../../{{ $item->anime_image }}">
                                                        </a>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>

    <!--Tab değiştirme scripti-->
    <script>
        var activeTabID = "anime-calendar-tab";
        var activeButtonID = "tabButtonAnimeCalendar";

        function changeTab(clickButtonID, tabSectionID) {
            document.getElementById(activeTabID).classList.remove("active");
            document.getElementById(activeButtonID).classList.remove("active");

            document.getElementById(tabSectionID).classList.add("active");
            document.getElementById(clickButtonID).classList.add("active");

            activeTabID = tabSectionID;
            activeButtonID = clickButtonID;
        }
    </script>

    <!--Tarih Ayarları-->
    <script>
        var specialDates = document.getElementsByClassName('specialDates');

        for (let i = 0; i < specialDates.length; i++) {
            var fullDate = specialDates[i].getElementsByClassName("specialDatesFull")[0].innerText;

            var monthName = getMonth(fullDate.split("-")[1]);
            var day = fullDate.split("-")[2];
            var dayName = getDay(new Date(fullDate).getDay());

            specialDates[i].getElementsByClassName("specialDatesDayName")[0].innerText = dayName;
            specialDates[i].getElementsByClassName("specialDatesDay")[0].innerText = day;
            specialDates[i].getElementsByClassName("specialDatesMonthName")[0].innerText = monthName;
        }


        function getMonth(month) {
            if (month == 1) return "Ocak";
            else if (month == 2) return "Şubat";
            else if (month == 3) return "Mart";
            else if (month == 4) return "Nisan";
            else if (month == 5) return "Mayıs";
            else if (month == 6) return "Haziran";
            else if (month == 7) return "Temmuz";
            else if (month == 8) return "Ağustos";
            else if (month == 9) return "Eylül";
            else if (month == 10) return "Ekim";
            else if (month == 11) return "Kasım";
            else if (month == 12) return "Aralık";
            else return "HATA";
        }

        function getDay(day) {
            console.log("day: " + day);
            if (day == 0) return "Pazar";
            else if (day == 1) return "Pazartesi";
            else if (day == 2) return "Salı";
            else if (day == 3) return "Çarşamba";
            else if (day == 4) return "Perşembe";
            else if (day == 5) return "Cuma";
            else if (day == 6) return "Cumartesi";
            else return "HATA";
        }
    </script>
@endsection
