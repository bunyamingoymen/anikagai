<!DOCTYPE html>
<!--
* OOPS - Perfect 404 pages Pack
* Build Date: October 2016
* Last Update: October 2016
* Author: Madeon08 for ThemeHelite
* Copyright (C) 2016 ThemeHelite
* This is a premium product available exclusively here : http://themeforest.net/user/Madeon08/portfolio
* -->
<html lang="en-us" class="no-js">

<head>
    <meta charset="utf-8">
    <title>OOPS 404 - İstediğiniz Sayfa Bulunamadı</title>
    <meta name="description" content="OOPS 404 - İsteidğiniz Sayfa Bulunamadı">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Bünyamin Göymen">
    <meta name="author" content="bgoymen">

    <!-- ================= Favicons ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="{{ $index_icon->value }}">
    <!-- Retina iPad Touch Icon-->

    <!-- ============== Resources style ============== -->
    <link rel="stylesheet" type="text/css" href="../../../error/404/css/style.css" />
</head>

<body>

    <canvas id="dotty"></canvas>

    <!-- Your logo on the top left -->
    <a href="{{ route('index') }}" class="logo-link" title="back home">

        <img src="../../../{{ $logo->value }}" class="logo" alt="Company's logo" />

    </a>

    <div class="content">

        <div class="content-box">

            <div class="big-content">

                <!-- Main squares for the content logo in the background -->
                <div class="list-square">
                    <span class="square"></span>
                    <span class="square"></span>
                    <span class="square"></span>
                </div>

                <!-- Main lines for the content logo in the background -->
                <div class="list-line">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>

                <!-- The animated searching tool -->
                <i class="fa fa-search" aria-hidden="true"></i>

                <!-- div clearing the float -->
                <div class="clear"></div>

            </div>

            <!-- Your text -->
            <h1>Hata 404!</h1>

            <p>İstediğiniz Sayfa Bulunamadı<br>
                İster Geri dönebilirsiniz, isterseniz de anasayfaya gidebilirsiniz.</p>

        </div>

    </div>

    <footer class="light">

        <ul>
            <li><a href="{{ route('index') }}">Anaysafa</a></li>

            <li><a href="{{ redirect()->back()->getTargetUrl() }}">Geri Dön</a></li>
        </ul>

    </footer>

    <!-- ///////////////////\\\\\\\\\\\\\\\\\\\ -->
    <!-- ********** jQuery Resources ********** -->
    <!-- \\\\\\\\\\\\\\\\\\\/////////////////// -->

    <!-- * Libraries jQuery and Bootstrap - Be careful to not remove them * -->
    <script src="../../../error/404/js/jquery.min.js"></script>
    <script src="../../../error/404/js/bootstrap.min.js"></script>

    <!-- Mozaic plugin -->
    <script src="../../../error/404/js/mozaic.js"></script>

</body>

</html>
