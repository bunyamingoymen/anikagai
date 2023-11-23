<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Anikagai | Admin </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Anikagai admin created by bunyamingoymen" name="description" />
    <meta content="Bünyamin Göymen" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../../../admin/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="../../../admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../../../admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../../../admin/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="../../../admin/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- alertifyjs Css -->
    <link href="../../../admin/assets/libs/alertifyjs/build/css/alertify.min.css" rel="stylesheet" type="text/css" />

    <!-- alertifyjs default themes  Css -->
    <link href="../../../admin/assets/libs/alertifyjs/build/css/themes/default.min.css" rel="stylesheet"
        type="text/css" />
</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">


        @include("admin.layouts.topbar")

        <!-- ========== Left Sidebar Start ========== -->
        @include("admin.layouts.sidebar")
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
                                <h4 class="mb-0 font-size-18">{{$title}}</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        @foreach ($pathName as $item)
                                        @unless($loop->last)
                                        <li class="breadcrumb-item"><a
                                                href="{{route($pathRoute[$loop->index])}}">{{$item}}</a></li>
                                        @endunless
                                        @endforeach
                                        <li class="breadcrumb-item active">{{end($pathName)}}</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div>
                        @yield("admin_content")
                    </div>

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            @include('admin.layouts.footer');
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <div id="hiddenDiv" hidden>

    </div>

    <!-- JAVASCRIPT -->
    <script src="../../../admin/assets/libs/jquery/jquery.min.js"></script>
    <script src="../../../admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../admin/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="../../../admin/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../../../admin/assets/libs/node-waves/waves.min.js"></script>

    <!-- alertifyjs js -->
    <script src="../../../admin/assets/libs/alertifyjs/build/alertify.min.js"></script>


    <!-- Sweet Alerts js -->
    <script src="../../../admin/assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script src="../../../admin/assets/js/app.js"></script>

    <script>
        @if (session('success'))
            alertify.success("{{session('success')}}");
        @endif

        @if (session('error'))
            alertify.error("{{session('error')}}");
        @endif

        @if (session('warning'))
            alertify.warning("{{session('warning')}}");
        @endif
    </script>



</body>

</html>
