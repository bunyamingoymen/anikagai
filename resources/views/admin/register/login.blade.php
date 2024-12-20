<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | Anikagai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Anikagai admin login" name="description" />
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

</head>

<body class="bg-primary bg-pattern">
    <div class="home-btn d-none d-sm-block">
        <a href="{{ route('admin_index') }}"><i class="mdi mdi-home-variant h2 text-white"></i></a>
    </div>

    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <a href="{{ route('admin_index') }}" class="logo"><img
                                src="{{ url('admin/assets/images/logo-dark.png') }}" height="55" alt="logo"></a>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-2">
                                <h5 class="mb-5 text-center">Giriş Yap</h5>
                                <form class="form-horizontal" action="{{ route('admin_login') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="username">E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="E-mail Adresi">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="userpassword">Şifre</label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="Şifre">
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success btn-block waves-effect waves-light"
                                                    type="submit">Giriş Yap</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end Account pages -->

    <!-- JAVASCRIPT -->
    <script src="{{ url('admin/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ url('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('admin/assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ url('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ url('admin/assets/js/app.js') }}"></script>

    <script>
        @if (session('error'))
            Swal.fire({
                title: "Hata",
                text: "{{ session('error') }}",
                icon: "error"
            });
        @endif

        @if (session('success'))
            Swal.fire({
                title: "Başarılı",
                text: "{{ session('success') }}",
                icon: "success"
            });
        @endif
    </script>

</body>

</html>
