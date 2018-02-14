<!-- Slider -->
<div id="full-slider-wrapper">
    <div id="layerslider" style="width:100%;height:667px;">
        <!-- first slide -->
        <?php if (!empty($home_slider)) { ?>
                <?php foreach ($home_slider as $one) { ?>
                    <?php $image = substr($one->image, strpos($one->image, '_') + 1) ?>
                    <?php // $program_title_url = str_replace(' ', '-', $slider_program->program_title) ?>
                    <?php // $image = substr($slider_program->program_slider_image, strpos($slider_program->program_slider_image, '_') + 1) ?>
                    <div class="ls-slide" data-ls="slidedelay: 5000; transition2d:5;">
                        <?php
                        $url_segment = $this->uri->segment(1);
                        $first_title = "first_title_" . $url_segment;
                        $second_title = "second_title_" . $url_segment;
                        ?>
                        <img src="<?= base_url('uploads/home_slider/l_' . $image) ?>" class="ls-bg" alt="<?= $one->$first_title ?>" width="1600" height="667">

                        <h3 class="ls-l slide_typo" style="top: 40%; left: 50%;" data-ls="offsetxin:0;durationin:2000;delayin:1000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotatexout:90;transformoriginout:50% bottom 0;"><?= $one->$first_title ?></h3>
                        <p class="ls-l slide_typo_2 text-center" style="top:60%; left:50%;" data-ls="durationin:2000;delayin:1000;easingin:easeOutElastic;">
                            <span class="days_back"><?= $one->$second_title ?></span>
                            <br><br><br>
                            <?php
                            if (isset($one->url) && $one->url != "" && $one->url != "#") { ?>
                            <a target="_blank" href="<?php
                            if (isset($one->url) && $one->url != "") {
                                echo $one->url;
                            }
                            ?>" class="button_2">المزيد</a>
                            <?php }
                            ?>
                        </p>
                    </div>
                <?php } ?>
            <?php } ?>


    </div>
</div>
<!-- End layerslider -->



<div class="pattern_dots">
    <div class="container margin_60_45">
        <div class="main_title">
            <h2><strong>ما هو </strong> اجازة بوك </h2>

            <span><em></em></span>
            <!--
                           <div class="col-md-12">

                                                     <script src="http://hotels.agazabook.com/SearchBox/366371"></script>

                                                </div>
            -->
        </div>
        <!-- End main_title -->

        <div class="row">
            <div class="col-md-12">
                <p style="font-size: 16px; text-align: justify; line-height: 2em;"><?= $about_us->desc_ar ?></p>
            </div>

        </div>
    </div>
    <div class="pattern_dots">
        <div class="container margin_60_30 fix_mobile">
            <div class="main_title">
                <h2><strong>اكتشف</strong> كل ما تهتم به</h2>

                <span><em></em></span>
            </div>

            <div class="row box_cat">
                <div class="col-md-3 col-sm-6 pull-left">
                    <a href="<?= site_url('shrines') ?>">
<!--                        <span>240</span>-->
                        <i class=" icon_set_1_icon-1"></i>
                        <h3>المزارات</h3>
                        <p>
                            تعرف على المزارات الهامة في كل البلاد
                        </p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 pull-left">
                    <a href="<?= site_url('programs') ?>">
<!--                        <span>340</span>-->
                        <i class="icon_set_1_icon-41"></i>
                        <h3>رحلات</h3>
                        <p>
                            افضل عروض الرحلات و السفر لقضاء الاجازات
                        </p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 pull-left">
                    <a href="http://hotels.agazabook.com" target="_blank">
<!--                        <span>1200</span>-->
                        <i class="icon_set_1_icon-6"></i>
                        <h3>الفنادق </h3>
                        <p>
                            عروض من افضل الفنادق بافضل الاسعار
                        </p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 pull-left">
                    <a href="<?= site_url('restaurants') ?>">
<!--                        <span>430</span>-->
                        <i class="icon_set_1_icon-58"></i>
                        <h3>المطاعم</h3>
                        <p>
                            تعرف على افضل المطاعم
                        </p>
                    </a>
                </div>
            </div>
            <!-- End row -->

            <div class="row box_cat">
                <div class="col-md-3 col-sm-6 pull-left">
                    <a href="<?= site_url('shops') ?>">
<!--                        <span>240</span>-->
                        <i class="icon_set_1_icon-20"></i>
                        <h3>ترفية</h3>
                        <p>
                       تعرف علي اجمل اماكن الترفيه                 </p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 pull-left">
                    <a href="<?= site_url('shops') ?>">
<!--                        <span>340</span>-->
                        <i class="icon_set_1_icon-50"></i>
                        <h3>تسوق</h3>
                        <p>
                                                    تعرف علي افضل اماكن التسوق
                        </p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 pull-left">
                    <a href="<?= site_url('transports') ?>">
<!--                        <span>430</span>-->
                        <i class="icon_set_1_icon-25"></i>
                        <h3>نقل سياحى</h3>
                        <p>
                          افضل شركات النقل السياحي والليموزين
                        </p>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 pull-left">
                    <a href="<?= site_url('etiquette') ?>">
<!--                        <span>120</span>-->
                        <i class="icon_set_1_icon-9"></i>
                        <h3>الاتيكيت</h3>
                        <p>
                           تعرف علي اصول وقواعد الإتيكيت والبروتوكول السياحي
                        </p>
                    </a>
                </div>
            </div>
            <!-- End row -->
        </div>
    </div>

    <div class="pattern_dots">
        <div class="container margin_60_45">
            <div class="main_title">
                <h2><strong>البرامج الأكثر زيارة </strong>فى اجازة بوك </h2>

                <span><em></em></span>
            </div>
            <!-- End main_title -->

            <div class="row">
                <?php if (!empty($programs) && !empty($programs['first'])) { ?>
                        <div class="col-md-8 col-sm-12 col-xs-12 pull-left">
                            <div class="img_wrapper_grid">
                                <!-- End tools i-->
                                <div class="img_container_grid" style="height: 437px;">
                                    <?php $program_title_url = str_replace(' ', '_', $programs['first']->program_title) ?>
                                    <a href="<?= site_url('programs/detail/' . $program_title_url . '-' . $programs['first']->program_id) ?>">
                                        <?php $image = substr($programs['first']->agaza_image, strpos($programs['first']->image, '_') + 1) ?>
                                        <img src="<?= $programs['first']->agaza_programs_image_url . 'uploads/programs/m_' . $image ?>" width="100%" height="100%" alt="<?= $programs['first']->program_title ?>">
                                        <div class="short_info_grid">
                                            <small><strong><?= arabicDate($programs['first']->going_date) . ' الى ' . arabicDate($programs['first']->return_date); ?></strong></small>
                                            <h1><?= $programs['first']->program_title ?></h1>
                                            <em><strong><strong><?= $programs['first']->nights + 1; ?></strong>ايام <?= $programs['first']->nights ?></strong>ليال </em>
                                            <em>  تبدأ من <?= $programs['first']->price_start_from ?> <?= $programs['first']->currency_sign ?></em>

                                            <p>
                                                المزيد
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- End img_wrapper_grid -->
                        </div>
                    <?php } ?>
                <?php if (!empty($programs) && !empty($programs['second'])) { ?>
                        <div class="col-md-4 col-sm-12 col-xs-12 pull-left">
                            <?php foreach ($programs['second'] as $programs_second) { ?>
                                <div class="img_wrapper_grid">
                                    <!-- End tools i-->
                                    <div class="img_container_grid">
                                        <?php $program_title_url = str_replace(' ', '_', $programs_second->program_title) ?>
                                        <a href="<?= site_url('programs/detail/' . $program_title_url . '-' . $programs_second->program_id) ?>">
                                            <?php $image = substr($programs_second->agaza_image, strpos($programs_second->image, '_') + 1) ?>
                                            <img src="<?= $programs_second->agaza_programs_image_url . 'uploads/programs/m_' . $image ?>" width="800" height="468" class="img-responsive" alt="<?= $programs_second->program_title ?>">
                                            <div class="ribbon">
                                                <span>عرض خاص</span>
                                            </div>
                                            <div class="short_info_grid">
                                                <small><strong><?= arabicDate($programs_second->going_date) . ' الى ' . arabicDate($programs_second->return_date); ?></strong></small>
                                                <h1><?= $programs_second->program_title ?></h1>
                                                <em><strong><strong><?= $programs_second->nights + 1; ?></strong>ايام <?= $programs_second->nights ?></strong>ليال </em>
                                                <em>  تبدأ من <?= $programs_second->price_start_from ?>  <?= $programs_second->currency_sign ?></em>

                                                <p>
                                                    المزيد
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- End img_wrapper_grid -->
                        </div>
                    <?php } ?>

            </div>
            <!-- End row -->
            <div class="row">
                <?php if (!empty($programs) && !empty($programs['third'])) { ?>

                        <?php foreach ($programs['third'] as $programs_third) { ?>
                            <div class="col-md-4 col-sm-12 col-xs-12 pull-left">
                                <div class="img_wrapper_grid">
                                    <!-- End tools i-->
                                    <div class="img_container_grid">
                                        <?php $program_title_url = str_replace(' ', '_', $programs_third->program_title) ?>
                                        <a href="<?= site_url('programs/detail/' . $program_title_url . '-' . $programs_third->program_id) ?>">
                                            <?php $image = substr($programs_third->agaza_image, strpos($programs_third->image, '_') + 1) ?>
                                            <img src="<?= $programs_third->agaza_programs_image_url . 'uploads/programs/m_' . $image ?>" width="800" height="468" class="img-responsive" alt="<?= $programs_third->program_title ?>">
                                            <div class="short_info_grid">
                                                <small><strong><?= arabicDate($programs_third->going_date) . ' الى ' . arabicDate($programs_third->return_date); ?></strong></small>
                                                <h1><?= $programs_third->program_title ?></h1>
                                                <em><strong><strong><?= $programs_third->nights + 1; ?></strong>ايام <?= $programs_third->nights ?></strong>ليال </em>
                                                <em>  تبدأ من <?= $programs_third->price_start_from ?> <?= $programs_third->currency_sign ?></em>

                                                <p>
                                                    المزيد
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- End img_wrapper_grid -->

                    <?php } ?>

            </div>
            <div class="text-center">
                <a style="width: 300px;" href="<?= site_url() ?>/programs" class="button_2">اكتشف المزيد من البرامج</a>
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </div>
    <!-- End pattern dots -->
    <div class="pattern_dots">
        <div class="container margin_60_45">
            <div class="main_title">
                <h2><strong>العروض الخاصة </strong>من اجازة بوك </h2>

                <span><em></em></span>
            </div>
            <!-- End main_title -->

            <div class="row">
                <div class="carousel ltr">
                    <?php if (count($special_offers) > 0) { ?>
                            <?php for ($x = 0; $x < count($special_offers); $x++) { ?>
                                <?php $items = $special_offers[$x] ?>
                                <div>
                                    <?php foreach ($items as $item) { ?>
                                        <div class="img_wrapper">
                                            <div class="img_container">
                                                <a href="<?= $item->url ?>" target="_blank">
                                                    <?php $image = substr($item->image, strpos($item->image, '_') + 1) ?>
                                                    <img src="<?= base_url('uploads/agaza_special_offers/m_' . $image) ?>" width="800" height="533" class="img-responsive" alt="">
                                                    <div class="short_info">
                                                        <small> تبدأ من <?= $item->price ?> جنيها</small>
                                                        <h3><?= $item->title_ar ?></h3>
                                                        <em><?= $item->country_ar ?></em>

                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>

                </div>

            </div>

            <!-- End row -->

            <!-- End row -->
        </div>
        <!-- End container -->
    </div>
    <!-- End pattern dots -->

    <div class="pattern_dots">
        <div class="container margin_60_45">
            <div class="main_title">
                <h2><strong>مصر </strong>فى اجازة بوك </h2>

                <span><em></em></span>
            </div>
            <!-- End main_title -->

            <div class="row">
                <?php if (!empty($new_in_egypt) && !empty($new_in_egypt['first'])) { ?>
                        <div class="col-md-8 pull-left">
                            <div class="img_wrapper_grid">


                                <!-- End tools i-->
                                <div class="img_container_grid">
                                    <a href="<?= $new_in_egypt['first']->url ?>" target="_blank">
                                        <?php $image = substr($new_in_egypt['first']->image, strpos($new_in_egypt['first']->image, '_') + 1) ?>
                                        <img src="<?= base_url('uploads/agaza_special_offers/l_' . $image) ?>" width="800" height="480" class="img-responsive" alt="<?= $new_in_egypt['first']->title_ar ?>">
                                        <div class="short_info_grid">

                                            <h1> <?= $new_in_egypt['first']->country_ar ?></h1>

                                            <em>  تبدأ من <?= $new_in_egypt['first']->price ?> جنيها</em>
                                            <p>
                                                المزيد
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- End img_wrapper_grid -->
                        </div>
                    <?php } ?>
                <?php if (!empty($new_in_egypt) && !empty($new_in_egypt['second'])) { ?>

                        <div class="col-md-4 pull-left">
                            <?php foreach ($new_in_egypt['second'] as $second) { ?>
                                <div class="img_wrapper_grid">


                                    <!-- End tools i-->
                                    <div class="img_container_grid">
                                        <a href="<?= $second->url ?>" target="_blank">
                                            <?php $image = substr($second->image, strpos($second->image, '_') + 1) ?>
                                            <img src="<?= base_url('uploads/agaza_special_offers/s_' . $image) ?>" width="800" height="468" class="img-responsive" alt="<?= $second->title_ar ?>">
                                            <div class="short_info_grid">
                                                <h1> <?= $second->country_ar ?></h1>

                                                <em>  تبدأ من <?= $second->price ?> جنيها</em>

                                                <p>
                                                    المزيد
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
            </div>
            <!-- End row -->
            <?php if (!empty($new_in_egypt) && !empty($new_in_egypt['third'])) { ?>
                    <div class="row">

                        <?php foreach ($new_in_egypt['third'] as $third) { ?>
                            <div class="col-md-4 pull-left">

                                <div class="img_wrapper_grid">


                                    <!-- End tools i-->
                                    <div class="img_container_grid">
                                        <a href="<?= $third->url ?>" target="_blank">
                                            <?php $image = substr($third->image, strpos($third->image, '_') + 1) ?>
                                            <img src="<?= base_url('uploads/agaza_special_offers/s_' . $image) ?>" width="800" height="468" class="img-responsive" alt="<?= $third->title_ar ?>">
                                            <div class="short_info_grid">
                                                <h1> <?= $third->country_ar ?></h1>

                                                <em>  تبدأ من <?= $third->price ?> جنيها</em>

                                                <p>
                                                    المزيد
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <!-- End row -->
        </div>
        <!-- End container -->
    </div>

    <div class="pattern_dots">
        <div class="container margin_60_45">
            <div class="main_title">
                <h2><strong>الفنادق الأكثر زيارة </strong>فى اجازة بوك </h2>

                <span><em></em></span>
            </div>
            <!-- End main_title -->

            <div class="row">

                <?php if (!empty($hotels)) { ?>
                        <?php foreach ($hotels as $hotel) { ?>
                            <div class="col-md-4 pull-left">
                                <div class="img_wrapper_grid">
                                    <div class="img_container_grid">
                                        <?php $hotel_title_url = str_replace(' ', '-', $hotel->title_ar) ?>
                                        <a href="<?= site_url('property/' . $hotel_title_url . '-' . $hotel->id . '/' . $hotel->city . '-' . $hotel->city_id . '/' . $hotel->country . '-' . $hotel->country_id); ?>">
                                            <div class="tools_i">
                                                <div class="rating">
                                                    <?php for ($x = 1; $x <= $hotel->stars; $x++) { ?>
                                                        <span> </span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <img src="<?= $hotel->company_url . 'uploads/maka_madina_hotels/' . $hotel->image ?>" width="800" height="468" class="img-responsive" alt="<?= $hotel->title_ar ?>">
                                            <div class="short_info_grid">
                                                <h1><?= $hotel->title_ar ?></h1>
                                                <!--                                            <div id="stars-existing" class="starrr" data-rating='4'></div>-->

                                                <p>
                                                    المزيد
                                                </p>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                                <!-- End img_wrapper_grid -->
                            </div>

                        <?php } ?>
                    <?php } ?>



            </div>
            <div class="text-center">
                <a href="<?= site_url('hotels'); ?>" class="button_2">اكتشف المزيد من الفنادق</a>
            </div>
            <!-- End row -->

            <!-- End row -->
        </div>
        <!-- End container -->
    </div>



    <section class="parallax_window_home bright">
        <div class="container">
            <div class="main_title">
                <h3>كيف يعمل <strong>اجازة بوك</strong></h3>
            </div>
            <div class="row features add_bottom_45">
                <div class="col-md-4 col-sm-12 col-xs-12 pull-left">
                    <div id="feat_2">
                        <a href="<?= site_url('about_us'); ?>" class="bt_info">المزيد</a>
                        <h3>البحث</h3>
                        <p>
                            ابحث عن كل ماتريدة من رحلات او فنادق او رحلات طيران
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12  pull-left">
                    <div id="feat_1">
                        <a href="<?= site_url('about_us'); ?>" class="bt_info">المزيد</a>
                        <h3>اتبع خطوات الحجز</h3>
                        <p>
                            بعد اختيارك للرحلة اتبع خطوات الحجز خطوة بخطوة
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12  pull-left">
                    <div id="feat_3">
                        <a href="<?= site_url('about_us'); ?>" class="bt_info">المزيد</a>
                        <h3>استمتع برحلتك</h3>
                        <p>
                            استمتع برحلتك بعد الحجز و اطبع الاستمارة الخاصة بالحجز
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->

    </section>
    <!-- End section -->


    <section class="">
        <div class="container margin_60_45">
            <div class="main_title">
                <h3>شركاء<strong> اجازة بوك</strong></h3>
            </div>
            <!-- <div class="carousel_3 box_cat small ltr">-->
            <div id="owl-demo" class="owlCarousel   ltr">





                <?php if($clients) {
                    foreach ($clients as $key => $value) { ?>
                <div>
                    <a href="javascript:;"><img class="img-responsive" src="<?= base_url(); ?>/uploads/clients/<?= $value->image ?>" alt=""></a>
                </div>
                <?php } }  ?>






            </div>
        </div>
    </section>



    <?php
        global $_require;
        $_require['js'] = array('home.js');
    ?>