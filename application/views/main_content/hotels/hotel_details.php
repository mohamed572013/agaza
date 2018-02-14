

<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= $hotel->company_url . 'uploads/maka_madina_hotels/' . $hotel->image ?>" data-natural-width="1400" data-natural-height="420">
    <div id="sub_content_in">
        <div id="sub_content_in_left">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6 pull-left text-right">
                        <h1><?= $hotel->title_ar ?></h1>
                        <span><i class="icon_pin"></i><?= $hotel->title_ar ?></span>
                    </div>
                    <div class="col-md-4 col-sm-6 pull-left">

                        <div class="price_in pull-left">السعر للفرد يبداء من
                            <span><?= $lowest_adult_price ?><sup>جنيها</sup> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End sub_content_left -->
</div>
<!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="#">الرئيسية</a>
            </li>
            <li><a href="#">برامجنا</a>
            </li>
            <li><?= $hotel->title_ar ?></li>
        </ul>
    </div>
</div>
<!-- End position -->

<div class="container margin_60">
    <div class="row">
        <aside class="col-md-3 col-sm-3 hidden-xs" id="sidebar">
            <div class="theiaStickySidebar ">
                <a href="#"><img src="<?= base_url('img/ads.jpg') ?>" class="img-responsive m20"></a>

                <!--                <div class="box_info">
                                    <h3>هل تحتاج الى المساعدة ؟</h3>
                                    <p>
                                        تحتاج الى مساعدة يمكنك الاتصال بنا <br>

                                    </p>
                                    <ul>
                                        <li class="mb20"> <a class="help-phone" href="tel:0200059600"><i class="icon_set_1_icon-89"></i>020 00 59 600</a></li>
                                        <li>   <a class="help-mail" href="mailto:info@agazabook.com"><i class="icon_set_1_icon-84"></i>info@agazabook.com</a></li>
                                    </ul>-->
            </div>
            <div>


            </div>
            <!--End sticky -->
        </aside>
        <!--End aside -->
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="box_style_general add_bottom_30">


                <div class="row">
                    <div class="col-md12">
                        <div id="slider" class="flexslider">
                            <ul class="slides">
                                <?php if (!empty($hotel->images)) { ?>
                                        <?php foreach ($hotel->images as $key => $hotel_image) { ?>
                                            <li data-thumb="<?= $hotel->company_url . 'uploads/maka_madina_hotels_slider/' . $hotel_image->image ?>">
                                                <img src="<?= $hotel->company_url . 'uploads/maka_madina_hotels_slider/' . $hotel_image->image ?>">
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                <!-- items mirrored twice, total of 12 -->
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                <?php if (!empty($hotel->images)) { ?>
                                        <?php foreach ($hotel->images as $key => $hotel_image) { ?>
                                            <li data-thumb="<?= $hotel->company_url . 'uploads/maka_madina_hotels_slider/' . $hotel_image->image ?>">
                                                <img src="<?= $hotel->company_url . 'uploads/maka_madina_hotels_slider/' . $hotel_image->image ?>">
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                <!-- items mirrored twice, total of 12 -->
                            </ul>
                        </div>

                    </div>
                </div>


                <hr>
                <div class="row">
                    <h4 class="text-right">مميزات الفندق</h4>
                    <br>
                    <?php if (!empty($hotel->advantages)) { ?>
                            <?php foreach ($hotel->advantages as $hotel_advantage) { ?>
                                <div class="col-md-4 col-sm-4" style="float:right;">
                                    <ul class="list_option">
                                        <li><img style="margin-left:10px;" class="hotel-icon" src="<?= $hotel->company_url . 'theme/features_image/' . $hotel_advantage->image ?>" alt="<?= $hotel_advantage->title_ar ?>" style="  max-width: 24px; max-height: 24px"><?= $hotel_advantage->title_ar ?></li>

                                    </ul>
                                </div>
                            <?php } ?>
                        <?php } ?>
                </div>


                <hr>

                <div class="row">
                    <div class="col-md-12">


                        <!--  Tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab" aria-expanded="false">الوصف</a>
                            </li>
                            <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">المدينة</a>
                            </li>
                            <li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">خدمات اضافية</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                                <h3><?= $hotel->title_ar ?></h3>
                                <p><?= $hotel->desc_ar ?></p>

                            </div>
                            <div class="tab-pane" id="profile">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4 fr">
                                            <img class="right-img img-responsive"  src="<?= $hotel->company_url . 'uploads/places/' . $city->image ?>" alt="<?= $city->title_ar ?>">
                                        </div>
                                        <div class="col-md-8 fr">
                                            <h5 class="" style="margin-bottom:5px;"><?= $city->title_ar ?></h5>
                                            <p><?= $city->desc_ar ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings">

                                <div class="row">
                                    <?php if (!empty($hotel->extra_services)) { ?>
                                            <?php foreach ($hotel->extra_services as $extra_service) { ?>


                                                <div class="col-md-4 pull-left">
                                                    <ul class="list_ok">
                                                        <li><?= $extra_service->title_ar ?></li>
                                                    </ul>
                                                </div>

                                            <?php } ?>
                                        <?php } ?>
                                </div>
                            </div>

                        </div>
                        <style>
                            a.button_2{
                                background-color: #00a2ff;
                                padding: 4px 10px;
                            }
                            a.button_2, a.button_plan:hover {
                                background-color: #0a71ad;
                                color: #fff;
                            }

                        </style>
                        <div class="text-center">
                            <?php $hotel_title_url = str_replace(' ', '-', $hotel->title_ar) ?>
                            <a href="<?= site_url('redirect/' . $hotel_title_url . '-' . '2' . '-' . $hotel_id) ?>" class="col-md-12 button_2">الاسعار و الحجز</a>
                        </div>


                    </div>
                    <!-- End col-md-12-->
                </div>
            </div>
            <!-- End box_style_general -->

        </div>
        <!-- End col lg-9 -->
    </div>
    <!-- End row -->
</div>
<!-- End container -->
<?php
    global $_require;
    $_require['js'] = array('hotel_details.js');
?>