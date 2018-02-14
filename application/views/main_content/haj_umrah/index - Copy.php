<div class="alert_custom" style="display: none;">
    <!--    <button type="button" class="close" data-dismiss="alert" style="float:right;">✖</button>-->
    <strong style="font-size:24px;">رسالــــــة تنبيـــــه</strong><br>
    <div class="alert-msg"></div>
</div>
<!-- TOP BANNER -->
<div class="top-baner bg-blue">
    <div class="row no-margin">
        <div class="swiper-container main-slider-4 slideUp" data-autoplay="5000" data-loop="1" data-speed="800" data-center="0" data-slides-per-view="1">
            <div class="swiper-wrapper">
                <?php if ($slider_programs) { ?>
                        <?php foreach ($slider_programs as $key => $slide) { ?>

                            <div class="swiper-slide <?= ($key == 0) ? 'active' : ''; ?>" data-val="<?= $key ?>">
                                <div class="hover-blue black-hover h_100">
                                    <div class="clip">
                                        <div class="bg bg-bg-chrome act" style="background-image:url(<?= base_url('uploads/haj_umrah_programs_slider/' . $slide->slider_image) ?>)"></div>
                                    </div>


                                    <div class="vertical-align">
                                        <div class="item-block style-4">
                                            <div class="vertical-align">
                                                <h4>تبدأ من<b><?= $slide->price_start_from ?> جنيها</b></h4>
                                                <!--                                                <div class="rate">
                                                                                                    <span class="fa fa-star color-yellow"></span>
                                                                                                    <span class="fa fa-star color-yellow"></span>
                                                                                                    <span class="fa fa-star color-yellow"></span>
                                                                                                    <span class="fa fa-star color-yellow"></span>
                                                                                                    <span class="fa fa-star color-yellow"></span>
                                                                                                </div>-->
                                                <?php $program_title_url = str_replace(' ', '_', $slide->program_title) ?>
                                                <a href="<?= site_url('haj_umrah_programs/detail/' . $program_title_url . '-' . $slide->program_flight_id . '-' . $slide->program_id) ?>"><h1 class="hover-it"><?= $slide->program_title ?></h1></a>
                                                <div class="main-date"><?= arabicDate($slide->going_date) . ' الى ' . arabicDate($slide->return_date); ?></div>
            <!--                                    <p>عرض خاص من شركتنا اغتنم الفرصة الان و احجز مكانك</p>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>

            </div>
            <div class="pagination poin-style-1"></div>
        </div>

        <div class="find-form no-padding col-xs-12 col-md-3 slideDown" style="background: #217872!important;">




            <div class="">
                <div class="text-center">
                    <div class="drop-tabs">
                        <b>hotels</b>
                        <a href="#" class="arrow-down"><i class="fa fa-angle-down"></i></a>
                        <ul class="nav-tabs tpl-tabs tabs-style-1">
                            <li class="active click-tabs"><a href="#one" data-toggle="tab" aria-expanded="false">برامج</a></li>
                            <li class="click-tabs"><a href="#two" data-toggle="tab" aria-expanded="false">فنادق</a></li>
                            <li class="click-tabs"><a href="#three" data-toggle="tab" aria-expanded="false">طيران</a></li>


                        </ul>
                    </div>
                </div>
                <div class="tab-content tpl-tabs-cont section-text t-con-style-1">
                    <div class="tab-pane active in" id="one">
                        <div>
                            <h2 class="ff_title">دور على رحلتك</h2>

                            <!--                            <div class="form-group">
                                                            <select class="country-select-2 form-control amr">
                                                                <option value="">اختار البلد</option>
                                                            </select>


                                                        </div>-->
                            <form id="p-search-form" method="post">

                                <div class="form-group">

                                    <select name="p_city"  id="p_city" class="city-select-2 form-control amr">

                                        <option value="اختر" selected disabled>اسم المدينة</option>
                                        <?php foreach ($cities as $city) { ?>
                                                <option value="<?= $city->title_ar ?>" data-country-id="<?= $city->id ?>"><?= $city->title_ar ?></option>
                                            <?php } ?>

                                    </select>

                                </div>

                                <div class="form-group">

                                    <select name="p_hotel"  id="p_hotel" class="form-control hotel-select-2 amr">
                                        <option value="اختر" selected disabled>اسم الفندق</option>
                                        <?php foreach ($hotels as $hotel) { ?>
                                                <option value="<?= $hotel->title_ar ?>"><?= $hotel->title_ar ?></option>
                                            <?php } ?>
                                    </select>

                                </div>


                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="form-group form-block type-2 clearfix">

                                            <div class='input-group date input-style-1 b-50 brd-0 type-2 ' >
                                                <input type='text' class="form-control" name="p_arrive_date" id="p_arrive_date" placeholder='تاريخ الوصول' />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="form-group form-block type-2 clearfix">

                                            <div class='input-group date input-style-1 b-50 brd-0 type-2 ' >
                                                <input type='text' class="form-control" name="p_departing_date" id="p_departing_date" placeholder='تاريخ المغادرة' />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <input type="submit" class="c-button bg-white search-btn"  value="ابحث الان" data-search-type="programs">
                            </form>
                        </div>
                    </div>
                    <style>
                        .auto-country-hotel{
                            position: absolute;
                            top: 120px;
                            right:0px;    border-radius: 10px;
                            background-color: #fff;
                            max-height: 300px;
                            width: 100%;
                            overflow-y: auto;
                            z-index: 1000;
                        }
                        .auto-country-hotel p {
                            font-weight: bold;

                            background: #f0f0f0;
                            color: #2d2d2d;
                            text-align: right;
                            padding-right: 10px;
                        }

                        .auto-country-hotel ul {
                            padding: 5px 6px;
                        }

                        .auto-country-hotel {
                            padding: 10px 0;
                        }

                        .auto-country-hotel ul li {
                            border-bottom: 1px solid #f5f5f5;
                            font-size: 13px;
                            cursor: pointer;

                        }
                        /*for arrows keys
                        .auto-country-hotel ul li.active {
                                                       background: #1c8dbb;color: #fff;

                                                }*/
                        .auto-country-hotel ul li:hover{
                            background: #1c8dbb;color: #fff;

                        }
                    </style>
                    <div class="tab-pane" id="two">
                        <div>

                            <!--                            <h2 class="ff_title">دور على فندقك</h2>-->


                            <!--                            <div class="form-group">

                                                            <select  class="form-control country-select-2 amr">
                                                                <option value="">اختار البلد</option>
                                                            </select>

                                                        </div>-->
                            <!--                            <form id="h-search-form" method="post">

                                                            <div class="form-group">
                                                                <div class="input-style-1 b-50 brd-0 type-2" style="margin-bottom: 20px;">
                                                                    <input class="form-control" type="text" placeholder="مدينة او  فندق  محدد " name="country_hotel" id="country_hotel" style="background-color:transparent;">
                                                                </div>
                                                                <div class="auto-country-hotel" style="display:none;">

                                                                </div>
                                                            </div>

                                                                                            <div class="form-group">

                                                                                                <select  class="form-control city-select-2 amr">
                                                                                                    <option value="اختر" selected >اسم المدينة</option>
                            <?php foreach ($cities as $city) { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <option value="<?= $city->title_ar ?>"><?= $city->title_ar ?></option>
                                <?php } ?>

                                                                                                </select>

                                                                                            </div>

                                                                                            <div class="form-group">

                                                                                                <select class="form-control hotel-select-2 amr">
                                                                                                    <option value="اختر" selected >اسم الفندق</option>
                            <?php foreach ($hotels as $hotel) { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <option value="<?= $hotel->title_ar ?>"><?= $hotel->title_ar ?></option>
                                <?php } ?>
                                                                                                </select>

                                                                                            </div>


                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-12">
                                                                    <div class="form-group form-block type-2 clearfix">

                                                                        <div class='input-group date input-style-1 b-50 brd-0 type-2 ' >
                                                                            <input disabled type='text' class="form-control" name="h_arrive_date" id='h_arrive_date' placeholder='تاريخ الوصول' />
                                                                            <span class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12">
                                                                    <div class="form-group form-block type-2 clearfix">

                                                                        <div class='input-group date input-style-1 b-50 brd-0 type-2 ' >
                                                                            <input disabled type='text' class="form-control" name="h_departing_date" id='h_departing_date' placeholder='تاريخ المغادرة' />
                                                                            <span class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>




                                                            <input type="submit" class="c-button bg-white  h-search-btn" value="ابحث الان" data-search-type="hotels">
                                                        </form>-->

                            <script src="http://hotels.agazabook.com/SearchBox/366371" ></script>
                        </div>
                    </div>
                    <div class="tab-pane" id="three">
                        <iframe id="iframeId" src='http://www.dohop.com/widget/2/?forms=flights&target=_blank&tabs=top&orientation=vertical&border_color=808080&text_color=202020&background_color=D0D0D0&form_border_color=808080&form_border_width=0&form_border_radius=0&form_text_color=000&form_background_color=transparent&button_border_color=ffffff&button_background_color=ffffff&button_font_size=&button_font_weight=&button_font_color=23b0e8&button_border_radius=100&width=100%&flang=ar&whitelabel=http://flights.agazabook.com/' width='NaN 'height='316' frameborder='0' style='text-align:right;border:none; overflow: hidden;' allowtransparency='true'></iframe>
<!--                        <iframe name="flights_iframe" src='http://www.dohop.com/widget/2/?forms=flights&target=_blank&tabs=top&orientation=horizontal&border_color=808080&text_color=202020&background_color=D0D0D0&form_border_color=808080&form_text_color=000&form_background_color=FAFAFA&width=370&flang=en&whitelabel=http://flights.agazabook.com/' width='370 'height='195' frameborder='0' style='border:none; overflow: hidden;' allowtransparency='true'></iframe><div style='text-align: right; width: 370px; margin-top:-10px;'><a href='http://www.dohop.com' style='text-align:right;font-size:10px;text-decoration:none;color:#007BA4;'>Cheap flights by Dohop</a></div>-->

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>



<div class="main-wraper">
    <div class="container">


        <div class="row">
            <div class="col-md-12 pt40">
                <div class="hometabs">
                    <div class="text-center">
                        <div class="drop-tabs">
                            <b>الاكثر حجزا</b>
                            <a href="#" class="arrow-down"><i class="fa fa-angle-down"></i></a>
                            <ul class="nav-tabs tpl-tabs tabs-style-1">
                                <li class="active click-tabs click-tabs-mahmoud"  title="m1"><a href="#tabsone" data-toggle="tab" aria-expanded="false">اخر برامجنا
                                    </a></li>
                                <li class="click-tabs click-tabs-mahmoud"  title="m2"><a href="#tabstwo" data-toggle="tab" aria-expanded="false"> الاكثر مشاهدة</a></li>
                                <li class="click-tabs click-tabs-mahmoud"  title="m3"><a href="#tabsthree" data-toggle="tab" aria-expanded="false">   الاكثر حجزا</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="tab-content tpl-tabs-cont section-text t-con-style-1">
                        <div class="tab-pane m1 active in" id="tabsone">
                            <div class="row">



                                <?php if ($last_added) { ?>
                                        <?php foreach ($last_added as $last) { ?>
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 hvr-shrink offre">
                                                <?php $program_title_url = str_replace(' ', '_', $last->program_title) ?>
                                                <a href="<?= site_url('haj_umrah_programs/detail/' . $program_title_url . '-' . $last->program_flight_id . '-' . $last->program_id) ?>">

                                                    <div class="hotel-item style-5">
                                                        <div class="radius-top">
                                                            <img src="<?= base_url('uploads/haj_umrah_programs/' . $last->image); ?>" alt="">
                            <!--	          	 	     	 	<div class="price price-s-2 green tt"><span class=" "><?= $last->price_start_from ?></span>  جنيها</div> -->
                                                        </div>
                                                        <div class="title">
                                                            <div class="date">
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                <span class="font-style-2 "><?= arabicDate($last->going_date) . ' الى ' . arabicDate($last->return_date); ?></span></div>
                                                            <h4><b><?= $last->program_title; ?></b></h4>

                                                            <div class="tour-info">
                                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                <span class="font-style-2 "><?= $last->hotel_title; ?></span>

                                                                <div class="rate fl">
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                </div>

                                                            </div>
                                                            <ul class="offers-info">
                                                                <li><b class="color-blue"><?= $last->nights + 1 ?></b> ايام</li>
                                                                <li><b class="color-blue"><?= $last->nights ?></b>ليالى</li>
                                                                <li class="fl"><b class="color-blue"><?= $last->price_start_from ?></b>  جنيها</li>

                                                            </ul>
                        <!--                     <div class="hotel-person color-dark-2 fr">يبدا من <span class="color-blue"><?= $last->price_start_from ?></span>  جنيها</div>-->

                                                            <!--		            <a href="#" class="c-button transparent color-grey-3 hv-o fl">المزيد ..</a>-->
                                                        </div>
                                                    </div>


                                                </a>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>

                            </div>
                        </div>
                        <div class="tab-pane m2" id="tabstwo">
                            <div class="row">
                                <?php if ($most_viewed) { ?>
                                        <?php foreach ($most_viewed as $viewed) { ?>
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 hvr-shrink offre">
                                                <?php $program_title_url = str_replace(' ', '_', $last->program_title) ?>
                                                <a href="<?= site_url('haj_umrah_programs/detail/' . $program_title_url . '-' . $last->program_flight_id . '-' . $last->program_id) ?>">

                                                    <div class="hotel-item style-5">
                                                        <div class="radius-top">
                                                            <img src="<?= base_url('uploads/haj_umrah_programs/' . $viewed->image); ?>" alt="">
                            <!--	          	 	     	 	<div class="price price-s-2 green tt"><span class=" "><?= $viewed->price_start_from ?></span>  جنيها</div> -->
                                                        </div>
                                                        <div class="title">
                                                            <div class="date">
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                <span class="font-style-2 "><?= arabicDate($viewed->going_date) . ' الى ' . arabicDate($viewed->return_date); ?></span></div>
                                                            <h4><b><?= $viewed->program_title; ?></b></h4>

                                                            <div class="tour-info">
                                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                <span class="font-style-2 "><?= $viewed->hotel_title; ?></span>

                                                                <div class="rate fl">
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                </div>

                                                            </div>
                                                            <ul class="offers-info">
                                                                <li><b class="color-blue"><?= $viewed->nights + 1 ?></b> ايام</li>
                                                                <li><b class="color-blue"><?= $viewed->nights ?></b>ليالى</li>
                                                                <li class="fl"><b class="color-blue"><?= $viewed->price_start_from ?></b>  جنيها</li>

                                                            </ul>
                        <!--                     <div class="hotel-person color-dark-2 fr">يبدا من <span class="color-blue"><?= $last->price_start_from ?></span>  جنيها</div>-->

                                                            <!--		            <a href="#" class="c-button transparent color-grey-3 hv-o fl">المزيد ..</a>-->
                                                        </div>
                                                    </div>


                                                </a>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>

                            </div>
                        </div>
                        <div class="tab-pane m3" id="tabsthree">
                            <div class="row">
                                <?php if ($most_reserved) { ?>
                                        <?php foreach ($most_reserved as $reserved) { ?>
                                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 hvr-shrink offre">
                                                <?php $program_title_url = str_replace(' ', '_', $last->program_title) ?>
                                                <a href="<?= site_url('haj_umrah_programs/detail/' . $program_title_url . '-' . $reserved->program_flight_id . '-' . $reserved->program_id) ?>">

                                                    <div class="hotel-item style-5">
                                                        <div class="radius-top">
                                                            <img src="<?= base_url('uploads/haj_umrah_programs/' . $reserved->image); ?>" alt="">
                            <!--	          	 	     	 	<div class="price price-s-2 green tt"><span class=" "><?= $viewed->price_start_from ?></span>  جنيها</div> -->
                                                        </div>
                                                        <div class="title">
                                                            <div class="date">
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                <span class="font-style-2 "><?= arabicDate($reserved->going_date) . ' الى ' . arabicDate($reserved->return_date); ?></span></div>
                                                            <h4><b><?= $reserved->program_title; ?></b></h4>

                                                            <div class="tour-info">
                                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                <span class="font-style-2 "><?= $reserved->hotel_title; ?></span>

                                                                <div class="rate fl">
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                    <span class="fa fa-star color-yellow"></span>
                                                                </div>

                                                            </div>
                                                            <ul class="offers-info">
                                                                <li><b class="color-blue"><?= $reserved->nights + 1 ?></b> ايام</li>
                                                                <li><b class="color-blue"><?= $reserved->nights ?></b>ليالى</li>
                                                                <li class="fl"><b class="color-blue"><?= $reserved->price_start_from ?></b>  جنيها</li>

                                                            </ul>
                        <!--                     <div class="hotel-person color-dark-2 fr">يبدا من <span class="color-blue"><?= $last->price_start_from ?></span>  جنيها</div>-->

                                                            <!--		            <a href="#" class="c-button transparent color-grey-3 hv-o fl">المزيد ..</a>-->
                                                        </div>
                                                    </div>


                                                </a>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>

                            </div>
                        </div>


                    </div>
                </div>
            </div>




        </div>



    </div>
</div>

<div class="main-wraper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="second-title pt0">
                    <h2>العروض الخاصة</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="top-baner arrows">
                <div class="swiper-container offers-slider" data-autoplay="5000" data-loop="1" data-speed="500" data-slides-per-view="responsive" data-mob-slides="1" data-xs-slides="2" data-sm-slides="2" data-md-slides="4" data-lg-slides="4" data-add-slides="<?= $special_offers_count ?>">
                    <div class="swiper-wrapper">
                        <?php if ($special_offers) { ?>
                                <?php foreach ($special_offers as $special_offer) { ?>
                                    <div class="swiper-slide" data-val="0">
                                        <div class="offers-block radius-mask">
                                            <div class="clip">
                                                <div class="bg bg-bg-chrome act" style="background-image:url(<?= base_url('uploads/haj_umrah_programs/' . $special_offer->image); ?>)">
                                                </div>
                                            </div>
                                            <div class="tour-layer delay-1"></div>
                                            <div class="vertical-top">
                                                <div class="rate">
                                                    <span class="fa fa-star color-yellow"></span>
                                                    <span class="fa fa-star color-yellow"></span>
                                                    <span class="fa fa-star color-yellow"></span>
                                                    <span class="fa fa-star color-yellow"></span>
                                                    <span class="fa fa-star color-yellow"></span>
                                                </div>
                                                <h3><?= $special_offer->program_title; ?></h3>
                                            </div>
                                            <div class="vertical-bottom">
                                                <ul class="offers-info">
                                                    <li><b><?= $special_offer->nights + 1; ?></b> ايام</li>
                                                    <li><b><?= $special_offer->nights; ?></b>ليالى</li>

                                                </ul>
                                                <p><?= $special_offer->offer_description; ?></p>
                                                <?php $program_title_url = str_replace(' ', '_', $special_offer->program_title) ?>
                                                <a href="<?= site_url('haj_umrah_programs/detail/' . $program_title_url . '-' . $special_offer->program_flight_id . '-' . $special_offer->program_id) ?>" class="c-button bg-aqua hv-aqua-o b-40 fl"><span>المزيد</span></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                        <div class="pagination  poin-style-1 pagination-hidden"></div>
                    </div>
                    <div class="swiper-arrow-left offers-arrow"><span class="fa fa-angle-left"></span></div>
                    <div class="swiper-arrow-right offers-arrow"><span class="fa fa-angle-right"></span></div>
                </div>
            </div>
        </div>
    </div>


    <div class="main-wraper pt40">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="second-title pt0">
                        <h2>ِشركائنا فى النجاح</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="swiper-container" data-autoplay="5000" data-loop="1" data-speed="1000" data-center="0" data-slides-per-view="responsive" data-mob-slides="1" data-xs-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5" data-add-slides="6">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="partner-entry">
                            <a href="#"><img class="img-responsive" src="<?= base_url('uploads/clints/clin1.jpg'); ?>" alt=""></a>
                        </div>
                    </div>
                    <div class="swiper-slide text-center">
                        <div class="partner-entry">
                            <a href="#"><img class="img-responsive" src="<?= base_url('uploads/clints/clin2.jpg'); ?>" alt=""></a>
                        </div>
                    </div>
                    <div class="swiper-slide text-center">
                        <div class="partner-entry">
                            <a href="#"><img class="img-responsive" src="<?= base_url('uploads/clints/clin3.jpg'); ?>" alt=""></a>
                        </div>
                    </div>
                    <div class="swiper-slide text-center">
                        <div class="partner-entry">
                            <a href="#"><img class="img-responsive" src="<?= base_url('uploads/clints/clin4.jpg'); ?>" alt=""></a>
                        </div>
                    </div>
                    <div class="swiper-slide text-center">
                        <div class="partner-entry">
                            <a href="#"><img class="img-responsive" src="<?= base_url('uploads/clints/clin4.jpg'); ?>" alt=""></a>
                        </div>
                    </div>
                    <div class="swiper-slide text-center">
                        <div class="partner-entry">
                            <a href="#"><img class="img-responsive" src="uploads/clints/clin6.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="pagination pagination-hidden"></div>
            </div>
        </div>

    </div>

    <?php
        global $_require;
        $_require['js'] = array('home.js');
    ?>