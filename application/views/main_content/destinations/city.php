

<!-- INNER-BANNER -->
<div class="inner-banner style-3">
    <img class="center-image" src="<?= base_url('img/detail/bg_3.jpg') ?>" alt="">
    <div class="vertical-align">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">

                    <h1 class="color-white"><?= $city_name ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DETAIL WRAPPER -->
<div class="detail-wrapper">
    <div class="container">
        <div class="detail-header">
            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <h1 class="detail-title color-dark-2"><?= $city_name ?></h1>
                </div>

            </div>
       	</div>
       	<div class="row padd-40">
            <div class="col-xs-12 col-md-12">
                <div class="detail-content">
                    <div class="detail-top">

                        <div id="city_images">
                            <div class="detail-top slider-wth-thumbs style-1 arrows">
                                <div class="swiper-container" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                                    <div class="swiper-wrapper city_img">
                                        <div class="swiper-slide active" data-val="0">
                                            <img class="img-responsive img-full" src="<?= base_url('img/detail/m_slide_1.jpg') ?>" alt="">
                                        </div>
                                        <div class="swiper-slide" data-val="1">
                                            <img class="img-responsive img-full" src="<?= base_url('img/detail/m_slide_2.jpg') ?>" alt="">
                                        </div>
                                        <div class="swiper-slide" data-val="2">
                                            <img class="img-responsive img-full" src="<?= base_url('img/detail/m_slide_3.jpg') ?>" alt="">
                                        </div>
                                        <div class="swiper-slide" data-val="3">
                                            <img class="img-responsive img-full" src="<?= base_url('img/detail/m_slide_5.jpg') ?>" alt="">
                                        </div>
                                        <div class="swiper-slide" data-val="4">
                                            <img class="img-responsive img-full" src="<?= base_url('img/detail/m_slide_2.jpg') ?>" alt="">
                                        </div>
                                        <div class="swiper-slide" data-val="5">
                                            <img class="img-responsive img-full" src="<?= base_url('img/detail/m_slide_1.jpg') ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="pagination pagination-hidden poin-style-1"></div>
                                    <div class="arrow-wrapp arr-s-3">
                                        <div class="swiper-arrow-left sw-arrow"><span class="fa fa-angle-left"></span></div>
                                        <div class="swiper-arrow-right sw-arrow"><span class="fa fa-angle-right"></span></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="detail-content-block">
                        <div class="simple-tab color-1 tab-wrapper rtl">
                            <div class="tab-nav-wrapper">
                                <div  class="nav-tab  clearfix">
                                    <div class="nav-tab-item active">
                                        عن المدينة
                                    </div>
                                    <div class="nav-tab-item">
                                        الفنادق
                                    </div>
                                    <div class="nav-tab-item">
                                        البرامج
                                    </div>
                                    <div class="nav-tab-item">
                                        المزارات
                                    </div>
                                    <!--                                    <div class="nav-tab-item">
                                                                            التقيم
                                                                        </div>-->

                                </div>
                            </div>
                            <div class="tabs-content clearfix">
                                <div class="tab-info active">
                                    <p><?= $city->desc_ar; ?></p>


                                </div>
                                <div class="tab-info" id="hotels_container" style="max-height: 457px;overflow-y: auto;"> <!-- hotels-->
                                    <div class="row" >
                                        <div class="col-md-12">
                                            <div id="list-content" class="list-content clearfix" >
                                                <div class="list-item-entry">
                                                    <input type="hidden" name="city_id" id="city_id" value="<?= $city_id ?>"/>
                                                    <input type="hidden" name="all_hotels_count" id="all_hotels_count" value="<?= $all_hotels_count ?>"/>
                                                    <?php if (!empty($city->hotels)) { ?>
                                                            <?php foreach ($city->hotels as $hotel) { ?>
                                                                <div class="col-md-6 col-sm-12 hotel_item_container">
                                                                    <div class="hotel-item style-8 bg-white">
                                                                        <div class="table-view">
                                                                            <div class="radius-top cell-view">
                                                                                <?php $hotel_title_url = str_replace(' ', '-', $hotel->title_ar) ?>
                                                                                <a href="<?= site_url('property/' . $hotel_title_url . '/' . $hotel->city . '/' . $hotel->country); ?>">   <img src="<?= base_url('uploads/maka_madina_hotels/' . $hotel->image) ?>" alt=""></a>

                                                                            </div>
                                                                            <div class="title hotel-middle clearfix cell-view">


                                                                                <a href="<?= site_url('property/' . $hotel_title_url . '/' . $hotel->city . '/' . $hotel->country); ?>"> <h4><b><?= $hotel->title_ar ?></b></h4></a>
                                                                                <div class="rate-wrap">
                                                                                    <div class="rate">
                                                                                        <?php for ($x = 0; $x < $hotel->stars; $x++) { ?>
                                                                                            <span class="fa fa-star color-yellow"></span>
                                                                                        <?php } ?>
                                                                                    </div>

                                                                                </div>
                                                                                <p class="f-14"><?= mb_substr($hotel->desc_ar, 0, 50, "utf-8") . ' ....'; ?></p>
                                                                                <div class="hotel-icons-block grid-hidden">
                                                                                    <?php if (count($hotel->advantages) > 0) { ?>
                                                                                        <?php foreach ($hotel->advantages as $advantage) { ?>
                                                                                            <img class="hotel-icon" src="<?= base_url('theme/features_image/' . $advantage->image); ?>" alt="<?= $advantage->title_ar ?>">
                                                                                        <?php } ?>
                                                                                    <?php } ?>
                                                                                    <?php $hotel_title_url = str_replace(' ', '-', $hotel->title_ar) ?>
            <!--                                                                                <a class="c-button b-26 bg-blue-8 grid-hidden fl" href="<?= site_url('property/' . $hotel_title_url . '/' . $hotel->city . '/' . $hotel->country); ?>">المزيد</a>-->
                                                                                </div>


                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>


                                                </div>




                                            </div>




                                        </div>
                                    </div>


                                </div>


                                <div class="tab-info" id="programs_container" style="max-height: 457px;overflow-y: auto;"> <!-- programs-->
                                    <div class="row">
                                        <div id="tap_pro" class="grid-content clearfix programs-content">
                                            <input type="hidden" name="all_programs_count" id="all_programs_count" value="<?= $all_programs_count ?>"/>
                                            <?php if (!empty($city->programs)) { ?>
                                                    <?php foreach ($city->programs as $program) { ?>
                                                        <div class="col-md-4 program_item_container">
                                                            <div class="list-item-entry fr">
                                                                <div class="hotel-item style-3 bg-white">
                                                                    <div class="table-view">
                                                                        <div class="radius-top cell-view">
                                                                            <?php $program_title_url = str_replace(' ', '_', $program->program_title) ?>
                                                                            <a href="<?= site_url('programs/detail/' . $program_title_url . '-' . $program->program_id) ?>">  <img src="<?= base_url('uploads/programs/' . $program->image); ?>" alt=""></a>
                                                                        </div>
                                                                        <div class="title hotel-middle clearfix cell-view">

                                                                            <h4><b>  <a href="<?= site_url('programs/detail/' . $program_title_url . '-' . $program->program_id) ?>"><?= $program->program_title ?></a></b></h4>




                                                                            <div class="rate-wrap">
                                                                                <div class="date list-hidden fr"><strong><strong><?= $program->nights + 1; ?></strong>ايام <?= $program->nights ?></strong>ليال </div>
                                                                                <div class="rate fl">
                                                                                    <span class="fa fa-star color-yellow"></span>
                                                                                    <span class="fa fa-star color-yellow"></span>
                                                                                    <span class="fa fa-star color-yellow"></span>
                                                                                    <span class="fa fa-star color-yellow"></span>
                                                                                    <span class="fa fa-star color-yellow"></span>
                                                                                </div>

                                                                            </div>
                                                                            <p class="f-14 grid-hidden">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص</p>
                                                                        </div>
                                                                        <div class="title hotel-right clearfix cell-view">
                                                                            <div class="hotel-person color-dark-2">يبدا من <span class="color-blue"><?= $program->price_start_from ?></span>  جنيها</div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-info" id="shrines_container" style="max-height: 700px;overflow-y: auto;"><!-- shrines-->
                                    <div class="row rtl">
                                        <input type="hidden" name="all_shrines_count" id="all_shrines_count" value="<?= $all_shrines_count ?>"/>
                                        <?php if (!empty($city->shrines)) { ?>
                                                <?php foreach ($city->shrines as $shrine) { ?>
                                                    <div class="item tours gal-item style-3 col-mob-12 col-xs-6 col-sm-4 shrine_item_container">
                                                        <a class="black-hover" href="#">
                                                            <div class="gal-item-icon">
                                                                <img class="img-full img-responsive" src="<?= base_url('uploads/maka_madina_shrines/' . $shrine->image); ?>" alt="">
                                                                <div class="tour-layer delay-1"></div>
                                                                <div class="vertical-align">
                                                                    <span class="c-button small bg-white delay-2"><span>المزيد</span></span>
                                                                </div>
                                                            </div>
                                                            <div class="gal-item-desc delay-1">
                                                                <!--                                                            <h4><b>شرم الشيخ, مصر</b></h4>-->
                                                                <h5><?= $shrine->title_ar ?></h5>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>

                                    </div>
                                </div>
                                <div class="tab-info">
                                    <p>5</p>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
<?php
    global $_require;
    $_require['js'] = array('destinations.js');
?>


