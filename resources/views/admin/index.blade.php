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
                    <h4 class="m-0 align-self-center">{{ $totalData['total_index_user'] }}</h4>
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
                    <h4 class="m-0 align-self-center">{{ $totalData['total_watch'] }}</h4>
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
                    <h4 class="m-0 align-self-center">{{ $totalData['total_read'] }}</h4>
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
                    <h4 class="m-0 align-self-center">{{ $totalData['total_comment'] }}</h4>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

    <!--Grafikler-->
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Toplam İzleme/Okuma Sayısı</h4>
                    <div id="revenue-chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Yeni Üye Sayıları</h4>

                    <div dir="ltr">

                        <div class="slick-slider slider-for hori-timeline-desc pt-0">
                            <div>
                                <p class="font-size-16">Bugün</p>
                                <h4 class="mb-4">50 Üye</h4>
                                <div id="earning-day-chart" class="apex-charts"></div>
                            </div>
                            <div>
                                <p class="font-size-16">Bu Hafta</p>
                                <h4 class="mb-4">800 Üye</h4>
                                <div id="earning-weekly-chart" class="apex-charts"></div>
                            </div>
                            <div>
                                <p class="font-size-16">Bu Ay</p>
                                <h4 class="mb-4">1.000 Üye </h4>
                                <div id="earning-monthly-chart" class="apex-charts"></div>
                            </div>
                            <div>
                                <p class="font-size-16">Bu Yıl</p>
                                <h4 class="mb-4">1.500 Üye</h4>
                                <div id="earning-yearly-chart" class="apex-charts"></div>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <div class="col-lg-11">
                                <div class="slick-slider slider-nav hori-timeline-nav">
                                    <div class="slider-nav-item">
                                        <h5 class="nav-title font-size-14 mb-0">Day</h5>
                                    </div>
                                    <div class="slider-nav-item">
                                        <h5 class="nav-title font-size-14 mb-0">Week</h5>
                                    </div>
                                    <div class="slider-nav-item">
                                        <h5 class="nav-title font-size-14 mb-0">Month</h5>
                                    </div>
                                    <div class="slider-nav-item">
                                        <h5 class="nav-title font-size-14 mb-0">Year</h5>
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
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheckall">
                                            <label class="custom-control-label" for="customCheckall"></label>
                                        </div>
                                    </th>
                                    <th scope="col" style="width: 60px;"></th>
                                    <th scope="col">ID & Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="assets/images/users/avatar-2.jpg" alt="user"
                                            class="avatar-xs rounded-circle" />
                                    </td>
                                    <td>
                                        <p class="mb-1 font-size-12">#AP1234</p>
                                        <h5 class="font-size-15 mb-0">David Wiley</h5>
                                    </td>
                                    <td>02 Nov, 2019</td>
                                    <td>$ 1,234</td>
                                    <td>1</td>

                                    <td>
                                        $ 1,234
                                    </td>
                                    <td>
                                        <i class="mdi mdi-checkbox-blank-circle text-success mr-1"></i> Confirm
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                W
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1 font-size-12">#AP1235</p>
                                        <h5 class="font-size-15 mb-0">Walter Jones</h5>
                                    </td>
                                    <td>04 Nov, 2019</td>
                                    <td>$ 822</td>
                                    <td>2</td>

                                    <td>
                                        $ 1,644
                                    </td>
                                    <td>
                                        <i class="mdi mdi-checkbox-blank-circle text-success mr-1"></i> Confirm
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                                            <label class="custom-control-label" for="customCheck3"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="assets/images/users/avatar-3.jpg" alt="user"
                                            class="avatar-xs rounded-circle" />
                                    </td>
                                    <td>
                                        <p class="mb-1 font-size-12">#AP1236</p>
                                        <h5 class="font-size-15 mb-0">Eric Ryder</h5>
                                    </td>
                                    <td>05 Nov, 2019</td>
                                    <td>$ 1,153</td>
                                    <td>1</td>

                                    <td>
                                        $ 1,153
                                    </td>
                                    <td>
                                        <i class="mdi mdi-checkbox-blank-circle text-danger mr-1"></i> Cancel
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck4">
                                            <label class="custom-control-label" for="customCheck4"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="assets/images/users/avatar-6.jpg" alt="user"
                                            class="avatar-xs rounded-circle" />
                                    </td>
                                    <td>
                                        <p class="mb-1 font-size-12">#AP1237</p>
                                        <h5 class="font-size-15 mb-0">Kenneth Jackson</h5>
                                    </td>
                                    <td>06 Nov, 2019</td>
                                    <td>$ 1,365</td>
                                    <td>1</td>

                                    <td>
                                        $ 1,365
                                    </td>
                                    <td>
                                        <i class="mdi mdi-checkbox-blank-circle text-success mr-1"></i> Confirm
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck5">
                                            <label class="custom-control-label" for="customCheck5"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                R
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1 font-size-12">#AP1238</p>
                                        <h5 class="font-size-15 mb-0">Ronnie Spiller</h5>
                                    </td>
                                    <td>08 Nov, 2019</td>
                                    <td>$ 740</td>
                                    <td>2</td>

                                    <td>
                                        $ 1,480
                                    </td>
                                    <td>
                                        <i class="mdi mdi-checkbox-blank-circle text-warning mr-1"></i> Pending
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-sm">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var okumaData = [{{ '45' }}, {{ '52' }}, {{ '38' }}, {{ '24' }},
            {{ '33' }}, {{ '56' }}, {{ '42' }}, {{ '20' }}, {{ '6' }},
            {{ '18' }}, {{ '22' }}, {{ '10' }}
        ]
    </script>

    <!-- apexcharts -->
    <script src="../../../admin/assets/libs/apexcharts/apexcharts.min.js"></script>

    <script src="../../../admin/assets/js/pages/dashboard.init.js"></script>
@endsection
