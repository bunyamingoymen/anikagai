<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Movfix - Online Movies & TV Shows Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="../../../user/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="../../../user/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../user/css/animate.min.css">
    <link rel="stylesheet" href="../../../user/css/magnific-popup.css">
    <link rel="stylesheet" href="../../../user/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../../../user/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../../user/css/flaticon.css">
    <link rel="stylesheet" href="../../../user/css/odometer.css">
    <link rel="stylesheet" href="../../../user/css/aos.css">
    <link rel="stylesheet" href="../../../user/css/slick.css">
    <link rel="stylesheet" href="../../../user/css/default.css">
    <link rel="stylesheet" href="../../../user/css/style.css">
    <link rel="stylesheet" href="../../../user/css/responsive.css">
</head>

<body>

    @include("index.layouts.preloader")

    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    <header class="header-style-two">
        <div class="header-top-wrap">
            <div class="container custom-container">
                <div class="row align-items-center">
                    <div class="col-md-6 d-none d-md-block">
                    </div>
                    <div class="col-md-6">
                        <div class="header-top-link">
                            <ul class="quick-link">
                                <li><a href="#">Hakkımızda</a></li>
                                <li><a href="#">Discord</a></li>
                            </ul>
                            <ul class="header-social">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sticky-header" class="menu-area">
            <div class="container custom-container">
                <div class="row">
                    <div class="col-12">
                        <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                        <div class="menu-wrap">
                            <nav class="menu-nav show">
                                <div class="logo">
                                    <a href="index.html">
                                        <img src="../../../user/img/logo/logo.png" alt="Logo">
                                    </a>
                                </div>
                                <div class="navbar-wrap main-menu d-none d-lg-flex">
                                    <ul class="navigation">
                                        <li><a class="active" href="contact.html">Anasayfa</a></li>
                                        <li><a href="tv-show.html">Animeler</a></li>
                                        <li><a href="pricing.html">Webtoonlar</a></li>
                                        <li><a href="contact.html">İletişim</a></li>
                                    </ul>
                                </div>
                                <div class="header-action d-none d-md-block">
                                    <ul>
                                        <li class="d-none d-xl-block">
                                            <div class="footer-search">
                                                <form action="#">
                                                    <input type="text" placeholder="Arama Yap">
                                                    <button><i class="fas fa-search"></i></button>
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <!-- Mobile Menu  -->
                        <div class="mobile-menu">
                            <div class="close-btn"><i class="fas fa-times"></i></div>

                            <nav class="menu-box">
                                <div class="nav-logo"><a href="index.html"><img src="../../../user/img/logo/logo.png"
                                            alt="" title=""></a>
                                </div>
                                <div class="menu-outer">
                                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                                </div>
                                <div class="social-links">
                                    <ul class="clearfix">
                                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                        <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                        <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                        <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                        <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="menu-backdrop"></div>
                        <!-- End Mobile Menu -->

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area-end -->


    <!-- main-area -->
    <main>

        <!-- gallery-area -->
        <div class="gallery-area position-relative mb-2">
            <div class="gallery-bg"></div>
            <div class="container-fluid p-0 fix">
                <div class="row gallery-active">
                    <div class="col-12">
                        <div class="gallery-item">
                            <img src="../../../user/img/images/gallery_01.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="gallery-item">
                            <img src="../../../user/img/images/gallery_02.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="gallery-item">
                            <img src="../../../user/img/images/gallery_03.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="gallery-item">
                            <img src="../../../user/img/images/gallery_04.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-nav"></div>
        </div>
        <!-- gallery-area-end -->

        <!-- up-coming-movie-area -->
        <section class="ucm-area ucm-bg2" data-background="../../../user/img/bg/ucm_bg02.jpg">
            <div class="container">
                <div class="row align-items-end mb-55">
                    <div class="col-lg-6">
                        <div class="section-title title-style-three text-center text-lg-left">
                            <h2 class="title">İçerikler</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ucm-nav-wrap">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="webtoons-tab" data-toggle="tab" href="#webtoons"
                                        role="tab" aria-controls="webtoons" aria-selected="false">Webtoon</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="anime-tab" data-toggle="tab" href="#anime" role="tab"
                                        aria-controls="anime" aria-selected="false">Anime</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="webtoons" role="tabpanel" aria-labelledby="movies-tab">
                        <div class="ucm-active-two owl-carousel">
                            <div class="movie-item movie-item-two mb-30">
                                <div class="movie-poster">
                                    <a href="movie-details.html"><img src="../../../user/img/poster/s_ucm_poster06.jpg"
                                            alt=""></a>
                                </div>
                                <div class="movie-content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5 class="title"><a href="movie-details.html">Message in a Bottle</a></h5>
                                    <span class="rel">Adventure</span>
                                    <div class="movie-content-bottom">
                                        <ul>
                                            <li class="tag">
                                                <a href="#">HD</a>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="movie-item movie-item-two mb-30">
                                <div class="movie-poster">
                                    <a href="movie-details.html"><img src="../../../user/img/poster/s_ucm_poster07.jpg"
                                            alt=""></a>
                                </div>
                                <div class="movie-content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5 class="title"><a href="movie-details.html">The Parkar Legend</a></h5>
                                    <span class="rel">Adventure</span>
                                    <div class="movie-content-bottom">
                                        <ul>
                                            <li class="tag">
                                                <a href="#">HD</a>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="movie-item movie-item-two mb-30">
                                <div class="movie-poster">
                                    <a href="movie-details.html"><img src="../../../user/img/poster/s_ucm_poster08.jpg"
                                            alt=""></a>
                                </div>
                                <div class="movie-content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5 class="title"><a href="movie-details.html">The Tonoy 88 Bottle</a></h5>
                                    <span class="rel">Adventure</span>
                                    <div class="movie-content-bottom">
                                        <ul>
                                            <li class="tag">
                                                <a href="#">HD</a>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="movie-item movie-item-two mb-30">
                                <div class="movie-poster">
                                    <a href="movie-details.html"><img src="../../../user/img/poster/s_ucm_poster09.jpg"
                                            alt=""></a>
                                </div>
                                <div class="movie-content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5 class="title"><a href="movie-details.html">The Ackle Bottle</a></h5>
                                    <span class="rel">Adventure</span>
                                    <div class="movie-content-bottom">
                                        <ul>
                                            <li class="tag">
                                                <a href="#">HD</a>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="movie-item movie-item-two mb-30">
                                <div class="movie-poster">
                                    <a href="movie-details.html"><img src="../../../user/img/poster/s_ucm_poster02.jpg"
                                            alt=""></a>
                                </div>
                                <div class="movie-content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5 class="title"><a href="movie-details.html">Message in a Bottle</a></h5>
                                    <span class="rel">Adventure</span>
                                    <div class="movie-content-bottom">
                                        <ul>
                                            <li class="tag">
                                                <a href="#">HD</a>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="movie-item movie-item-two mb-30">
                                <div class="movie-poster">
                                    <a href="movie-details.html"><img src="../../../user/img/poster/s_ucm_poster01.jpg"
                                            alt=""></a>
                                </div>
                                <div class="movie-content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5 class="title"><a href="movie-details.html">The Dog Woof</a></h5>
                                    <span class="rel">Adventure</span>
                                    <div class="movie-content-bottom">
                                        <ul>
                                            <li class="tag">
                                                <a href="#">HD</a>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="anime" role="tabpanel" aria-labelledby="anime-tab">
                        <div class="ucm-active-two owl-carousel">
                            <div class="movie-item movie-item-two mb-30">
                                <div class="movie-poster">
                                    <a href="movie-details.html"><img src="../../../user/img/poster/s_ucm_poster01.jpg"
                                            alt=""></a>
                                </div>
                                <div class="movie-content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5 class="title"><a href="movie-details.html">Message in a Bottle</a></h5>
                                    <span class="rel">Adventure</span>
                                    <div class="movie-content-bottom">
                                        <ul>
                                            <li class="tag">
                                                <a href="#">HD</a>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="movie-item movie-item-two mb-30">
                                <div class="movie-poster">
                                    <a href="movie-details.html"><img src="../../../user/img/poster/s_ucm_poster02.jpg"
                                            alt=""></a>
                                </div>
                                <div class="movie-content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5 class="title"><a href="movie-details.html">The Parkar Legend</a></h5>
                                    <span class="rel">Adventure</span>
                                    <div class="movie-content-bottom">
                                        <ul>
                                            <li class="tag">
                                                <a href="#">HD</a>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="movie-item movie-item-two mb-30">
                                <div class="movie-poster">
                                    <a href="movie-details.html"><img src="../../../user/img/poster/s_ucm_poster03.jpg"
                                            alt=""></a>
                                </div>
                                <div class="movie-content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5 class="title"><a href="movie-details.html">The Tonoy 88 Bottle</a></h5>
                                    <span class="rel">Adventure</span>
                                    <div class="movie-content-bottom">
                                        <ul>
                                            <li class="tag">
                                                <a href="#">HD</a>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="movie-item movie-item-two mb-30">
                                <div class="movie-poster">
                                    <a href="movie-details.html"><img src="../../../user/img/poster/s_ucm_poster04.jpg"
                                            alt=""></a>
                                </div>
                                <div class="movie-content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5 class="title"><a href="movie-details.html">The Ackle Bottle</a></h5>
                                    <span class="rel">Adventure</span>
                                    <div class="movie-content-bottom">
                                        <ul>
                                            <li class="tag">
                                                <a href="#">HD</a>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="movie-item movie-item-two mb-30">
                                <div class="movie-poster">
                                    <a href="movie-details.html"><img src="../../../user/img/poster/s_ucm_poster05.jpg"
                                            alt=""></a>
                                </div>
                                <div class="movie-content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5 class="title"><a href="movie-details.html">Message in a Bottle</a></h5>
                                    <span class="rel">Adventure</span>
                                    <div class="movie-content-bottom">
                                        <ul>
                                            <li class="tag">
                                                <a href="#">HD</a>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="movie-item movie-item-two mb-30">
                                <div class="movie-poster">
                                    <a href="movie-details.html"><img src="../../../user/img/poster/s_ucm_poster06.jpg"
                                            alt=""></a>
                                </div>
                                <div class="movie-content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5 class="title"><a href="movie-details.html">The Dog Woof</a></h5>
                                    <span class="rel">Adventure</span>
                                    <div class="movie-content-bottom">
                                        <ul>
                                            <li class="tag">
                                                <a href="#">HD</a>
                                                <a href="#">English</a>
                                            </li>
                                            <li>
                                                <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- up-coming-movie-area-end -->

        <!-- top-rated-movie -->
        <section class="top-rated-movie tr-movie-bg2" data-background="../../../user/img/bg/tr_movies_bg.jpg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title title-style-three text-center mb-70">
                            <span class="sub-title">top rated movies</span>
                            <h2 class="title">Top Online Shows Watch</h2>
                        </div>
                    </div>
                </div>
                <div class="row movie-item-row">
                    <div class="custom-col-">
                        <div class="movie-item movie-item-two">
                            <div class="movie-poster">
                                <img src="../../../user/img/poster/s_ucm_poster01.jpg" alt="">
                                <ul class="overlay-btn">
                                    <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                            class="popup-video btn">Watch Now</a></li>
                                    <li><a href="movie-details.html" class="btn">Details</a></li>
                                </ul>
                            </div>
                            <div class="movie-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="title"><a href="movie-details.html">Message in a Bottle</a></h5>
                                <span class="rel">Adventure</span>
                                <div class="movie-content-bottom">
                                    <ul>
                                        <li class="tag">
                                            <a href="#">HD</a>
                                            <a href="#">English</a>
                                        </li>
                                        <li>
                                            <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-col-">
                        <div class="movie-item movie-item-two">
                            <div class="movie-poster">
                                <img src="../../../user/img/poster/s_ucm_poster02.jpg" alt="">
                                <ul class="overlay-btn">
                                    <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                            class="popup-video btn">Watch Now</a></li>
                                    <li><a href="movie-details.html" class="btn">Details</a></li>
                                </ul>
                            </div>
                            <div class="movie-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="title"><a href="movie-details.html">The Parkar Legend</a></h5>
                                <span class="rel">Adventure</span>
                                <div class="movie-content-bottom">
                                    <ul>
                                        <li class="tag">
                                            <a href="#">HD</a>
                                            <a href="#">English</a>
                                        </li>
                                        <li>
                                            <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-col-">
                        <div class="movie-item movie-item-two">
                            <div class="movie-poster">
                                <img src="../../../user/img/poster/s_ucm_poster03.jpg" alt="">
                                <ul class="overlay-btn">
                                    <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                            class="popup-video btn">Watch Now</a></li>
                                    <li><a href="movie-details.html" class="btn">Details</a></li>
                                </ul>
                            </div>
                            <div class="movie-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="title"><a href="movie-details.html">The Ackle Bottle</a></h5>
                                <span class="rel">Adventure</span>
                                <div class="movie-content-bottom">
                                    <ul>
                                        <li class="tag">
                                            <a href="#">HD</a>
                                            <a href="#">English</a>
                                        </li>
                                        <li>
                                            <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-col-">
                        <div class="movie-item movie-item-two">
                            <div class="movie-poster">
                                <img src="../../../user/img/poster/s_ucm_poster04.jpg" alt="">
                                <ul class="overlay-btn">
                                    <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                            class="popup-video btn">Watch Now</a></li>
                                    <li><a href="movie-details.html" class="btn">Details</a></li>
                                </ul>
                            </div>
                            <div class="movie-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="title"><a href="movie-details.html">The Speed 2</a></h5>
                                <span class="rel">Adventure</span>
                                <div class="movie-content-bottom">
                                    <ul>
                                        <li class="tag">
                                            <a href="#">HD</a>
                                            <a href="#">English</a>
                                        </li>
                                        <li>
                                            <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-col-">
                        <div class="movie-item movie-item-two">
                            <div class="movie-poster">
                                <img src="../../../user/img/poster/s_ucm_poster05.jpg" alt="">
                                <ul class="overlay-btn">
                                    <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                            class="popup-video btn">Watch Now</a></li>
                                    <li><a href="movie-details.html" class="btn">Details</a></li>
                                </ul>
                            </div>
                            <div class="movie-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="title"><a href="movie-details.html">The Legend Emo</a></h5>
                                <span class="rel">Adventure</span>
                                <div class="movie-content-bottom">
                                    <ul>
                                        <li class="tag">
                                            <a href="#">HD</a>
                                            <a href="#">English</a>
                                        </li>
                                        <li>
                                            <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-col-">
                        <div class="movie-item movie-item-two">
                            <div class="movie-poster">
                                <img src="../../../user/img/poster/s_ucm_poster06.jpg" alt="">
                                <ul class="overlay-btn">
                                    <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                            class="popup-video btn">Watch Now</a></li>
                                    <li><a href="movie-details.html" class="btn">Details</a></li>
                                </ul>
                            </div>
                            <div class="movie-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="title"><a href="movie-details.html">Envato Bottle 88</a></h5>
                                <span class="rel">Adventure</span>
                                <div class="movie-content-bottom">
                                    <ul>
                                        <li class="tag">
                                            <a href="#">HD</a>
                                            <a href="#">English</a>
                                        </li>
                                        <li>
                                            <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-col-">
                        <div class="movie-item movie-item-two">
                            <div class="movie-poster">
                                <img src="../../../user/img/poster/s_ucm_poster07.jpg" alt="">
                                <ul class="overlay-btn">
                                    <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                            class="popup-video btn">Watch Now</a></li>
                                    <li><a href="movie-details.html" class="btn">Details</a></li>
                                </ul>
                            </div>
                            <div class="movie-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="title"><a href="movie-details.html">Message Bottle II</a></h5>
                                <span class="rel">Adventure</span>
                                <div class="movie-content-bottom">
                                    <ul>
                                        <li class="tag">
                                            <a href="#">HD</a>
                                            <a href="#">English</a>
                                        </li>
                                        <li>
                                            <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-col-">
                        <div class="movie-item movie-item-two">
                            <div class="movie-poster">
                                <img src="../../../user/img/poster/s_ucm_poster08.jpg" alt="">
                                <ul class="overlay-btn">
                                    <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                            class="popup-video btn">Watch Now</a></li>
                                    <li><a href="movie-details.html" class="btn">Details</a></li>
                                </ul>
                            </div>
                            <div class="movie-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="title"><a href="movie-details.html">The Message B.</a></h5>
                                <span class="rel">Adventure</span>
                                <div class="movie-content-bottom">
                                    <ul>
                                        <li class="tag">
                                            <a href="#">HD</a>
                                            <a href="#">English</a>
                                        </li>
                                        <li>
                                            <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-col-">
                        <div class="movie-item movie-item-two">
                            <div class="movie-poster">
                                <img src="../../../user/img/poster/s_ucm_poster09.jpg" alt="">
                                <ul class="overlay-btn">
                                    <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                            class="popup-video btn">Watch Now</a></li>
                                    <li><a href="movie-details.html" class="btn">Details</a></li>
                                </ul>
                            </div>
                            <div class="movie-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="title"><a href="movie-details.html">Tiger World Q.</a></h5>
                                <span class="rel">Adventure</span>
                                <div class="movie-content-bottom">
                                    <ul>
                                        <li class="tag">
                                            <a href="#">HD</a>
                                            <a href="#">Bluray</a>
                                        </li>
                                        <li>
                                            <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="custom-col-">
                        <div class="movie-item movie-item-two">
                            <div class="movie-poster">
                                <img src="../../../user/img/poster/s_ucm_poster10.jpg" alt="">
                                <ul class="overlay-btn">
                                    <li><a href="https://www.youtube.com/watch?v=R2gbPxeNk2E"
                                            class="popup-video btn">Watch Now</a></li>
                                    <li><a href="movie-details.html" class="btn">Details</a></li>
                                </ul>
                            </div>
                            <div class="movie-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h5 class="title"><a href="movie-details.html">Avenger World IV</a></h5>
                                <span class="rel">Adventure</span>
                                <div class="movie-content-bottom">
                                    <ul>
                                        <li class="tag">
                                            <a href="#">HD</a>
                                            <a href="#">English</a>
                                        </li>
                                        <li>
                                            <span class="like"><i class="fas fa-thumbs-up"></i> 3.5</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tr-movie-btn text-center mt-25">
                    <a href="#" class="btn">BROWSE ALL MOVIES</a>
                </div>
            </div>
        </section>
        <!-- top-rated-movie-end -->

    </main>
    <!-- main-area-end -->


    <!-- footer-area -->
    <footer>
        <div class="footer-top-wrap">
            <div class="container">
                <div class="">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <div class="footer-logo">
                                <a href="index.html"><img src="../../../user/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row align-items-center">
                                <div class="col-md-10">
                                    <div class="quick-link-list">
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas illo animi
                                            dolore vitae nemo assumenda praesentium aperiam commodi, eum repellendus
                                            sint error, veritatis tempora unde maxime rerum corporis ipsum sunt.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-menu">
                                <nav>
                                    <div class="footer-social">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="copyright-text">
                            <p>Copyright &copy; 2023. All Rights Reserved By <a href="index.html">Anikagai</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area-end -->


    <!-- JS here -->
    <script src="../../../user/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="../../../user/js/popper.min.js"></script>
    <script src="../../../user/js/bootstrap.min.js"></script>
    <script src="../../../user/js/isotope.pkgd.min.js"></script>
    <script src="../../../user/js/imagesloaded.pkgd.min.js"></script>
    <script src="../../../user/js/jquery.magnific-popup.min.js"></script>
    <script src="../../../user/js/owl.carousel.min.js"></script>
    <script src="../../../user/js/jquery.odometer.min.js"></script>
    <script src="../../../user/js/jquery.appear.js"></script>
    <script src="../../../user/js/slick.min.js"></script>
    <script src="../../../user/js/ajax-form.js"></script>
    <script src="../../../user/js/wow.min.js"></script>
    <script src="../../../user/js/aos.js"></script>
    <script src="../../../user/js/plugins.js"></script>
    <script src="../../../user/js/main.js"></script>
</body>

</html>