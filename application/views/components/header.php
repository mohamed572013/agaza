<!--[if lte IE 8]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
        <![endif]-->

<div class="layer"></div>
<!-- Menu mask -->

<!-- Header ================================================== -->
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-8">
                <div id="logo_home">
                    <h1><a href="<?= site_url(); ?>" title="Agazabook">Agazabook</a></h1>
                </div>

            </div>
            <nav class="col-md-9 col-sm-8 col-xs-4">
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">

                                <h4 class="modal-title" id="myModalLabel">البحث عن فندق</h4>
                            </div>

                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <div class="row">
                                    <div class="col-sm-12">

                                        <script src="http://hotels.agazabook.com/SearchBox/366371"></script>

                                    </div>


                                </div>
                            </div>
                            <div class="modal-footer">
                                <!--                                <button type="button" class="btn btn-primary">ابحث</button>-->
                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title" id="myModalLabel">البحث عن رحلة طيران</h4>
                            </div>
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>


                                <form action="http://flights.agazabook.com/" method="GET">
                                    <div class="row">


                                        <div class="col-sm-12 pull-left">
                                            <div class="form-group">
                                                <label for="destination1">من</label>
                                                <input type="text" class="form-control" placeholder="اسم المدينة" id="a1" name="a1"/>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 pull-left">
                                            <div class="form-group">
                                                <label for="destination1">الى</label>
                                                <input type="text" class="form-control" placeholder="اسم المدينة" id="a2" name="a2"/>
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-sm-6 pull-left">
                                            <div class="form-group">
                                                <label>تاريخ الوصول</label>
                                                <input class="date-pick form-control" type="text" id="d1" name="d1" placeholder="تاريخ الوصول">
                                                <span class="input-icon-2"><i class="icon-calendar"></i></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 pull-left">
                                            <div class="form-group">
                                                <label>تاريخ المغادرة</label>
                                                <input class="date-pick form-control" type="text" id="d2" name="d2" placeholder="تاريخ المغادرة">
                                                <span class="input-icon-2"><i class="icon-calendar"></i></span>
                                            </div>
                                        </div>

                                    </div>
                            </div>
                            <div class="modal-footer">

                                <button type="submit" value="Search"  class="btn btn-primary">ابحث</button>
                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">اغلاق</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="<?= base_url() ?>/img/logo.png" alt="img" data-retina="true" width="170" height="30">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
                    <ul>
                        <li class="submenu"><a href="<?= site_url(); ?>">الرئيسية</a></li>
                        <li class="submenu"><a href="<?= site_url('programs'); ?>">برامج</a></li>
                        <li class="submenu"><a data-toggle="modal" data-target="#myModal">فنادق</a></li>
                        <li class="submenu"><a data-toggle="modal" data-target="#myModal2">طيران</a></li>
                        <li class="submenu"><a href="<?= site_url('restaurants'); ?>">المطاعم</a></li>
                        <li class="submenu"><a href="<?= site_url('shops'); ?>">تسوق و ترفية</a></li>
                        <li class="submenu"><a href="<?= site_url('transports'); ?>">النقل السياحى</a></li>
                        <li class="submenu"><a href="<?= site_url('shrines') ?>">المزارات</a></li>
                        <li class="submenu"><a href="<?= site_url('clients') ?>">شركاؤنا</a></li>
                        <li class="submenu"><a href="<?= site_url('etiquette') ?>">الإتيكيت</a></li>
						<li class="submenu"><a href="<?= site_url('news') ?>">الأخبار</a></li>
                        <li class="submenu"><a href="<?= site_url('about_us'); ?>">من نحن</a></li>
                        <li class="submenu"><a href="<?= site_url('contact_us'); ?>">اتصل بنا</a></li>

                    </ul>
                </div>
                <!-- End main-menu -->
            </nav>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
</header>