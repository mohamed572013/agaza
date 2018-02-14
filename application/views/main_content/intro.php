<!DOCTYPE html>
<html lang="en-US" class="no-js">

    <head>

        <title>AL-Wesam</title>

        <!-- Meta Data -->
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="#">

        <!-- CSS Global Compulsory -->
        <link href="<?= base_url('assets/front/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= base_url('assets/front/css/intro/style.css') ?>">

        <!-- CSS Implementing Plugins -->
        <link href="<?= base_url('assets/front/css/font-awesome.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/front/css/intro/animate.min.css') ?>" type="text/css">
        <link rel="stylesheet" href="<?= base_url('assets/front/css/intro/flexslider.css') ?>" type="text/css">
        <link rel="stylesheet" href="<?= base_url('assets/front/css/intro/vegas.min.css') ?>" type="text/css">
        <link rel="stylesheet" href="<?= base_url('assets/front/css/intro/custom.css') ?>">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <script src="js/respond.min.js"></script>
        <![endif]-->

        <!--[if lt IE 11]>
                <link rel="stylesheet" type="text/css" href="css/ie.css">
        <![endif]-->

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i%7CRoboto:100,300,400,500,700,900' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lemonada" rel="stylesheet">

        <!-- JS -->
        <script type="text/javascript" src="<?= base_url('assets/front/js/intro/modernizr.js') ?>"></script>

        <!-- Faviconss -->
        <link rel="shortcut icon" href="<?= base_url('img/intro/favicon.ico'); ?>">
        <script>
                var config = {
                    base_url: '<?php echo base_url(); ?>'
                };
        </script>

    </head>
    <body class="slideshow-background">

        <div id="preloader">
            <div id="loading-animation"></div>
        </div>

        <div class="main-container">

            <!-- Main Header -->
            <header class="main-header">
                <div class="header-block">
                    <!-- Header Logo -->
                    <a class="header-logo load-content" href="#">
                        <img src="<?= base_url('img/intro/logo.png') ?>" alt="" class="logo-light">
                        <img src="<?= base_url('img/intro/logo-dark.png') ?>" alt="" class="logo-dark">
                    </a>
                    <button type="button" class="nav-toggle">
                        <span></span>
                    </button>
                </div>
                <!-- Header Nav -->
                <nav class="header-nav">
                    <ul class="nav">
                        <li><a href="<?= site_url('domestic_tourism'); ?>" class="">سياحة خارجية</a></li>
                        <li><a href="<?= site_url('domestic_tourism'); ?>" class="">سياحة داخلية</a></li>
                        <li><a href="<?= site_url('haj_umrah'); ?>" class="">سياحة دينية</a></li>
                        <li><a href="#" class="" onclick="return false;">فنادق</a></li>
                        <li><a href="#" class="" onclick="return false;">طيران</a></li>
                        <li><a href="#" class="" onclick="return false;">ليموزين</a></li>
                    </ul>
                </nav>
            </header>

            <!-- Home Side -->
            <div class="home-side">

                <!-- Section - Home -->
                <section id="home" class="section fullscreen-element sm-pt-180 sm-pb-180">
                    <div class="overlay">
                        <div class="overlay-wrapper">
                            <div class="overlay-inner background-dark-5 opacity-40"></div>
                        </div>
                    </div>
                    <div class="table-container">
                        <div class="table-content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="bt-flexslider flexslider animated onstart" data-animation="fadeInUp" data-animation-delay="300" data-effect="fade" data-pagination="false" data-directionnav="false">
                                            <div class="slides">
                                                <div class="flex-slide">
                                                    <h1 class="text-white heading-uppercase">الوسام للسياحه <br/> لأنك_تستحق</h1>
                                                </div>
                                                <div class="flex-slide">
                                                    <h1 class="text-white heading-uppercase">أرخص تذكرة طيران <br/> وأسرع حجز في مصر</h1>
                                                </div>
                                                <div class="flex-slide">
                                                    <h1 class="text-white heading-uppercase">استمتع معنا <br/>بافضل عروض الحج و العمرة</h1>
                                                </div>
                                                <div class="flex-slide">
                                                    <h1 class="text-white heading-uppercase"> مع الوسام للسياحه  <br/> حقق اللي نفسك فيه و سافر</h1>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>


            <!-- Footer -->
            <footer class="site-footer">
                <div class="container-fluid">
                    <p class="copyright">© 2016 AlWesam - All Rights Reserved <a target="_blank" href="http://www.mv-is.com/">Powered By MASTER VISION Integrated Solutions </a></p>
                    <nav class="socials-icons">
                        <ul>
                            <li><a href="#" class="social-icon"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="social-icon"><i class="fa fa-twitter"></i></a></li>

                        </ul>
                    </nav>
                </div>
            </footer><!-- .site-footer end -->


        </div>
        <script type="text/javascript" src="<?= base_url('assets/front/js/intro/jquery.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/front/js/intro/bootstrap.min.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/front/js/intro/plugins.js') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/front/js/intro/main.js') ?>"></script>

    </body>


</html>