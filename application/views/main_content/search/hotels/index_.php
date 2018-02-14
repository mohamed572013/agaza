

<div class="inner-banner">
    <img class="center-image" src="img/tour_list/inner_banner_2.jpg" alt="">
    <div class="vertical-align">
        <div class="container">
            <ul class="banner-breadcrumb color-white clearfix">
                <li><a class="link-blue-2" href="#">الرئيسية</a> /</li>
                <li><span class="color-blue-2">الفنادق</span></li>
            </ul>
            <h2 class="color-white">الفنادق</h2>

        </div>
    </div>
</div>

<div class="list-wrapper bg-grey-2">
    <div class="container">
        <div class="row">
            <?php $this->load->view('components/hotels_search_sidebar'); ?>

            <div class="col-xs-12 col-sm-8 col-md-9">
                <div class="list-header clearfix">
                    <div class="drop-wrap drop-wrap-s-4 color-4 list-sort">
                        <div class="drop">
                            <b>ترتيب بالسعر</b>
                            <a href="#" class="drop-list"><i class="fa fa-angle-down"></i></a>
                            <span>
                                <a href="#">تصاعدي</a>
                                <a href="#">تنازلى</a>
                            </span>
                        </div>
                    </div>
                    <div class="drop-wrap drop-wrap-s-4 color-4 list-sort">
                        <div class="drop">
                            <b>ترتيب بالتاريخ</b>
                            <a href="#" class="drop-list"><i class="fa fa-angle-down"></i></a>
                            <span>
                                <a href="#">الاحدث</a>
                                <a href="#">الاقدم</a>
                            </span>
                        </div>
                    </div>

                </div>
                <div class="list-content clearfix">
                    <?php if (count($hotels) > 0) { ?>
                            <?php foreach ($hotels as $hotel) { ?>
                                <div class="list-item-entry hvr-float-shadow">
                                    <div class="hotel-item style-8 bg-white">
                                        <div class="table-view">
                                            <div class="radius-top cell-view">
                                                <img src="<?= base_url('uploads/maka_madina_hotels/' . $hotel->image) ?>" alt="">

                                            </div>
                                            <div class="title hotel-middle clearfix cell-view">

                                                <div class="rate-wrap">
                                                    <div class="rate">
                                                        <?php for ($x = 0; $x < $hotel->stars; $x++) { ?>
                                                            <span class="fa fa-star color-yellow"></span>
                                                        <?php } ?>
                                                    </div>

                                                </div>
                                                <h4><b><?= $hotel->title_ar ?></b></h4>
                                                <p class="f-14"><?= $hotel->desc_ar ?></p>
                                                <div class="hotel-icons-block grid-hidden">
                                                    <?php if (count($hotel->advantages) > 0) { ?>
                                                        <?php foreach ($hotel->advantages as $advantage) { ?>
                                                            <img class="hotel-icon" src="<?= base_url('theme/features_image/' . $advantage->image); ?>" alt="<?= $advantage->title_ar ?>">
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>

                                            </div>
                                            <div class="title hotel-right bg-dr-blue clearfix cell-view">
            <!--                                                <div class="hotel-person color-white"> يبدا من <span>1000 جنية</span></div>-->
                                                <?php $hotel_title_url = str_replace(' ', '-', $hotel->title_ar) ?>
                                                <a class="c-button b-40 bg-white color-dark-2 hv-dark-2-o grid-hidden" href="<?= base_url('property/' . $hotel_title_url . '/' . $hotel->city . '/' . $hotel->country); ?>">المزيد</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>



                </div>
                <?php if ($all_hotels_count > 2) { ?>
                        <a href="" class="btn btn-default col-md-12 show-more-hotels" style="background-color:#fff;" data-city-id="<?= (isset($city_id)) ? $city_id : 'all'; ?>" data-all-hotels-count="<?= $all_hotels_count ?>" data-current-length="<?= count($hotels) ?>">المزيد</a>
                    <?php } ?>

                <!--                <div class="c_pagination clearfix padd-120">
                                    <a href="#" class="c-button b-40 bg-blue-2 hv-blue-2-o fl">التالى</a>
                                    <a href="#" class="c-button b-40 bg-blue-2 hv-blue-2-o fr">السابق</a>
                                    <ul class="cp_content color-1">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">...</a></li>
                                        <li><a href="#">10</a></li>
                                    </ul>
                                </div>-->
            </div>
        </div>
    </div>
</div>
<?php
    global $_require;
    $_require['js'] = array('hotels.js');
?>


