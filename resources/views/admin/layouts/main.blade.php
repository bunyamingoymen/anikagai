<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> {{ end($pathName) }} | {{ env('APP_NAME') }} | Admin </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Anikagai admin created by bunyamingoymen" name="description" />
    <meta content="Bünyamin Göymen" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('admin/assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ url('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ url('admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- alertifyjs Css -->
    <link href="{{ url('admin/assets/libs/alertifyjs/build/css/alertify.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- alertifyjs default themes  Css -->
    <link href="{{ url('admin/assets/libs/alertifyjs/build/css/themes/default.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- slick css -->
    <link href="{{ url('admin/assets/libs/slick-slider/slick/slick.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('admin/assets/libs/slick-slider/slick/slick-theme.css') }}" rel="stylesheet" type="text/css" />

    <!-- JAVASCRIPT -->
    <script src="{{ url('admin/assets/libs/jquery/jquery.min.js') }}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/styles/ag-grid.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/styles/ag-theme-quartz.css" />

    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/dist/ag-grid-community.min.js"></script>
</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">


        @include('admin.layouts.topbar')

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.layouts.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">{{ $title }}</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        @foreach ($pathName as $item)
                                            @unless ($loop->last)
                                                <li class="breadcrumb-item"><a
                                                        href="{{ route($pathRoute[$loop->index]) }}">{{ $item }}</a>
                                                </li>
                                            @endunless
                                        @endforeach
                                        <li class="breadcrumb-item active">{{ end($pathName) }}</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div>
                        @yield('admin_content')
                    </div>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            @include('admin.layouts.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <div id="hiddenDiv" hidden>

    </div>

    <script src="{{ url('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ url('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('admin/assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- alertifyjs js -->
    <script src="{{ url('admin/assets/libs/alertifyjs/build/alertify.min.js') }}"></script>


    <!-- Sweet Alerts js -->
    <script src="{{ url('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ url('admin/assets/js/app.js') }}"></script>

    <!--Uyarı Mesajları-->
    <script>
        @if (session('success'))
            alertify.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            alertify.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            alertify.warning("{{ session('warning') }}");
        @endif
    </script>
    <script>
        var alphabet = [
            'q', 'w', 'e', 'r', 't', 'y', 'u', 'ı', 'o', 'p', 'ğ', 'ü',
            'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'ş', 'i',
            'z', 'x', 'c', 'v', 'b', 'n', 'm', 'ö', 'ç'
        ];

        function makeShortName(name) {
            var shortName = '';
            for (var i = 0; i < name.length; i++) {
                var character = name[i].toLowerCase();
                if (alphabet.includes(character)) {
                    shortName += character;
                } else shortName += "-";
            }
            return shortName;
        }
    </script>
</body>

</html>
