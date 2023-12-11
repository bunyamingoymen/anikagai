@extends('admin.layouts.main')
@section('admin_content')
    <!-- JAVASCRIPT -->
    <script src="../../../admin/assets/libs/jquery/jquery.min.js"></script>

    <script src="../../../admin/assets/libs/slick-slider/slick/slick.min.js"></script>

    <!--Üst kısım Toplam Sayılar-->
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="font-size-14">Toplam Üye Sayısı</h5>
                        </div>
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="dripicons-user"></i>
                            </span>
                        </div>
                    </div>
                    <h4 class="m-0 align-self-center">{{ $totalData['total_index_user'] ?? '0' }}</h4>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="font-size-14">Toplam İzleme Sayısı</h5>
                        </div>
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="dripicons-monitor"></i>
                            </span>
                        </div>
                    </div>
                    <h4 class="m-0 align-self-center">{{ $totalData['total_watch'] ?? '0' }}</h4>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="font-size-14">Toplam Okuma Sayısı</h5>
                        </div>
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="dripicons-align-left"></i>
                            </span>
                        </div>
                    </div>
                    <h4 class="m-0 align-self-center">{{ $totalData['total_read'] ?? '0' }}</h4>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="font-size-14">Toplam Yorum Sayısı</h5>
                        </div>
                        <div class="avatar-xs">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="dripicons-message"></i>
                            </span>
                        </div>
                    </div>
                    <h4 class="m-0 align-self-center">{{ $totalData['total_comment'] ?? '0' }}</h4>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

    <!--Grafikler-->
    <div class="row">
        <!--Toplam İzleme/Okuma Sayısı-->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Toplam İzleme/Okuma Sayısı</h4>
                    <div id="revenue-chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>

        <!--Zamanlara Göre Yeni Üye Sayısı-->
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Yeni Üye Sayıları</h4>

                    <div dir="ltr">

                        <div class="slick-slider slider-for hori-timeline-desc pt-0">
                            <div>
                                <p class="font-size-16">Bugün</p>
                                <h4 class="mb-4">{{ $totalData['index_user_today'] ?? '0' }} Üye</h4>
                                <div id="earning-day-chart" class="apex-charts"></div>
                            </div>
                            <div>
                                <p class="font-size-16">Bu Hafta</p>
                                <h4 class="mb-4">{{ $totalData['index_user_week'] ?? '0' }} Üye</h4>
                                <div id="earning-weekly-chart" class="apex-charts"></div>
                            </div>
                            <div>
                                <p class="font-size-16">Bu Ay</p>
                                <h4 class="mb-4">{{ $totalData['index_user_month'] ?? '0' }} Üye </h4>
                                <div id="earning-monthly-chart" class="apex-charts"></div>
                            </div>
                            <div>
                                <p class="font-size-16">Bu Yıl</p>
                                <h4 class="mb-4">{{ $totalData['index_user_year'] }} Üye</h4>
                                <div id="earning-yearly-chart" class="apex-charts"></div>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <div class="col-lg-11">
                                <div class="slick-slider slider-nav hori-timeline-nav">
                                    <div class="slider-nav-item">
                                        <h5 class="nav-title font-size-14 mb-0">Bugün</h5>
                                    </div>
                                    <div class="slider-nav-item">
                                        <h5 class="nav-title font-size-14 mb-0">Bu Hafta</h5>
                                    </div>
                                    <div class="slider-nav-item">
                                        <h5 class="nav-title font-size-14 mb-0">Bu Ay</h5>
                                    </div>
                                    <div class="slider-nav-item">
                                        <h5 class="nav-title font-size-14 mb-0">Bu Yıl</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!--Son Yorum Tablosu-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Son Yorumlar</h4>

                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        ID
                                    </th>
                                    <th scope="col" style="width: 60px;"></th>
                                    <th scope="col">İsim</th>
                                    <th scope="col">Tarih</th>
                                    <th scope="col">Yorum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <img src="../../../{{ $item->user_image }}" alt="user"
                                                class="avatar-xs rounded-circle" />
                                        </td>
                                        <td>
                                            <p class="mb-1 font-size-12">{{ '@' . $item->user_username }}</p>
                                            <h5 class="font-size-15 mb-0">{{ $item->user_name }}</h5>
                                        </td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->message }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const yearReadData = [
            {{ $totalData['read_in_year'][0] ?? '0' }}, {{ $totalData['read_in_year'][1] ?? '0' }},
            {{ $totalData['read_in_year'][2] ?? '0' }}, {{ $totalData['read_in_year'][3] ?? '0' }},
            {{ $totalData['read_in_year'][4] ?? '0' }}, {{ $totalData['read_in_year'][5] ?? '0' }},
            {{ $totalData['read_in_year'][6] ?? '0' }}, {{ $totalData['read_in_year'][7] ?? '0' }},
            {{ $totalData['read_in_year'][8] ?? '0' }}, {{ $totalData['read_in_year'][9] ?? '0' }},
            {{ $totalData['read_in_year'][10] ?? '0' }}, {{ $totalData['read_in_year'][11] ?? '0' }}
        ];

        const yearWatchData = [
            {{ $totalData['watch_in_year'][0] ?? '0' }}, {{ $totalData['watch_in_year'][1] ?? '0' }},
            {{ $totalData['watch_in_year'][2] ?? '0' }}, {{ $totalData['watch_in_year'][3] ?? '0' }},
            {{ $totalData['watch_in_year'][4] ?? '0' }}, {{ $totalData['watch_in_year'][5] ?? '0' }},
            {{ $totalData['watch_in_year'][6] ?? '0' }}, {{ $totalData['watch_in_year'][7] ?? '0' }},
            {{ $totalData['watch_in_year'][8] ?? '0' }}, {{ $totalData['watch_in_year'][9] ?? '0' }},
            {{ $totalData['watch_in_year'][10] ?? '0' }}, {{ $totalData['watch_in_year'][11] ?? '0' }}
        ];
        //Güne göre üye olan kullanıcı oranı
        @if ($totalData['index_user_today'] && $totalData['total_index_user'])
            const today_index_user_count = "{{ ($totalData['index_user_today'] / $totalData['total_index_user']) * 100 }}"
        @else
            const today_index_user_count = "0";
        @endif

        //haftaya göre üye olan kullanıcı oranı
        @if ($totalData['index_user_week'] && $totalData['total_index_user'])
            const week_index_user_count = "{{ ($totalData['index_user_week'] / $totalData['total_index_user']) * 100 }}"
        @else
            const week_index_user_count = "0";
        @endif

        //Aya göre üye olan kullanıcı oranı
        @if ($totalData['index_user_month'] && $totalData['total_index_user'])
            const month_index_user_count = "{{ ($totalData['index_user_month'] / $totalData['total_index_user']) * 100 }}"
        @else
            const month_index_user_count = "0";
        @endif

        //Yıla göre üye olan kullanıcı oranı
        @if ($totalData['index_user_year'] && $totalData['total_index_user'])
            const year_index_user_count = "{{ ($totalData['index_user_year'] / $totalData['total_index_user']) * 100 }}"
        @else
            const year_index_user_count = "0";
        @endif
    </script>

    <!-- apexcharts -->
    <script src="../../../admin/assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="../../../admin/assets/js/pages/dashboard.init.js"></script>
@endsection
