

<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_florence_2.jpg" data-natural-width="1400" data-natural-height="420">
    <div id="sub_content_in">
        <h1>فنادقنا</h1>
    </div>
    <!-- End sub_content -->
</section>

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url(); ?>">الرئيسية</a></li>
            <li>فنادقنا</li>
        </ul>
    </div>
</div>
<!-- End position -->


<div class="container margin_60_30">
    <div class="row">
        <aside class="col-md-3 col-md-push-9" id="sidebar">
            <div class="theiaStickySidebar ">
                <a href="#"><img src="<?= base_url('img/ads.jpg') ?>" class="img-responsive m20"></a>

                <div class="box_info">
                    <h3>هل تحتاج الى المساعدة ؟</h3>
                    <p>
                        يمكنك الاتصال بنا <br>

                    </p>
                    <ul>
                        <li class="mb20"> <a class="help-phone" href="tel:0200059600"><i class="icon_set_1_icon-89"></i>020 00 59 600</a></li>
                        <li>   <a class="help-mail" href="mailto:info@agazabook.com"><i class="icon_set_1_icon-84"></i>info@agazabook.com</a></li>
                    </ul>
                </div>




            </div>
        </aside>
        <!--End aside -->

        <div class="col-md-9 col-md-pull-3">
            <div class="list-content">
                <?php if (!empty($hotels)) { ?>
                        <?php foreach ($hotels as $hotel) { ?>

                            <div class="strip_list wow fadeIn list-item-entry">
                                <div class="row">
                                    <div class="col-sm-6 pull-left">
                                        <div class="img_wrapper">

                                            <div class="tools_i">
                                                <div class="rating">
                                                    <?php for ($x = 1; $x <= $hotel->stars; $x++) { ?>
                                                        <span> </span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <!-- End tools i-->
                                            <div class="img_container">
                                                <?php $hotel_title_url = str_replace(' ', '-', $hotel->title_ar) ?>
                                                <a href="<?= site_url('property/' . $hotel_title_url . '-' . $hotel->id . '/' . $hotel->city . '-' . $hotel->city_id . '/' . $hotel->country . '-' . $hotel->country_id); ?>">
                                                    <img src="<?= $hotel->company_url . 'uploads/maka_madina_hotels/' . $hotel->image ?>" width="800" height="533" class="img-responsive" alt="<?= $hotel->title_ar ?>">
                                                    <div class="short_info">

                                                        <h1><?= $hotel->title_ar ?></h1>
                                                        <em><?= $hotel->city ?></em>

                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <!--End img_wrapper-->
                                    </div>
                                    <div class="col-sm-6 pull-left">
                                        <div class="desc">
                                            <h4><a href="<?= site_url('property/' . $hotel_title_url . '-' . $hotel->id . '/' . $hotel->city . '-' . $hotel->city_id . '/' . $hotel->country . '-' . $hotel->country_id); ?>"><?= $hotel->title_ar ?></a> </h4>
                                            <p><?= mb_substr($hotel->desc_ar, 0, 100) ?></p>

                                            <p class="hotel-adv">
                                                <?php if (count($hotel->advantages) > 0) { ?>
                                                    <?php foreach ($hotel->advantages as $advantage) { ?>
                                                        <img class="hotel-icon" src="<?= $hotel->company_url . 'theme/features_image/' . $advantage->image ?>" alt="<?= $advantage->title_ar ?>">
                                                    <?php } ?>
                                                <?php } ?>



                                            </p>

                                            <p class="text-left"><a href="<?= site_url('property/' . $hotel_title_url . '-' . $hotel->id . '/' . $hotel->city . '-' . $hotel->city_id . '/' . $hotel->country . '-' . $hotel->country_id); ?>" class="button small">المزيد...</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--End row -->
                            </div>
                            <!--End strip -->
                        <?php } ?>
                    <?php } ?>
                <?php if ($all_hotels_count > 4) { ?>
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
                            <a href="" class="col-md-12 button_2 show-more-hotels" data-city-id="<?= (isset($city_id)) ? $city_id : 'all'; ?>" data-all-hotels-count="<?= $all_hotels_count ?>" data-current-length="<?= count($hotels) ?>">المزيد</a>
                        </div>
                    <?php } ?>
            </div>


        </div>
        <!-- End col lg 9 -->
    </div>
    <!-- End Row-->
</div>
<!-- End container -->
<?php
    global $_require;
    $_require['js'] = array('hotels.js');
?>