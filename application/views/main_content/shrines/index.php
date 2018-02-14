
<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_mzar.jpg" data-natural-width="1400" data-natural-height="320">
    <div id="sub_content_in">
        <h1>المزارات</h1>

    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="#">الرئيسية</a></li>
            <li>مزارات</li>
        </ul>
    </div>
</div>
<!-- End position -->

<div class="container margin_60_30">
    <div class="row">



        <div class="col-md-12">
            <div class="row mb20">
                <div class="col-md-6 col-sm-12 col-xs-12 center_loc">
                <form id="shrinesSearchFrom">
                    <div class="col-md-8 pull-left">
                        <div class="styled-select">
                            <select class="form-control" name="city_id" id="city_id">
                                <option disabled selected>اختر المدينة</option>
                                <?php if ($cities) { ?>
                                    <?php foreach ($cities as $city) { ?>
                                        <option value="<?= $city->id ?>"><?= $city->title_ar ?></option>
                                    <?php } ?>
                                <?php } ?>

                            </select>
                        </div>

                    </div>

                    <div class="col-md-2 pull-left">
                        <input type="submit" value="ابحث" class="button submit-form">
                    </div>
                </form>
            </div>
                </div>
            <div class="row" id="shrines-content">

                <?php if ($shrines) { ?>
                    <?php foreach ($shrines as $shrine) { ?>

                        <div class="shrine col-md-4 col-sm-6 col-xs-12 pull-left wow fadeIn" data-wow-delay="0.1s">
                            <div class="img_wrapper">


                                <!-- End tools i-->
                                <div class="img_container">
                                    <?php $shrine_title_url = str_replace(' ', '-', $shrine->shrine_title_ar) ?>
                                    <a href="<?= site_url('shrines/details/' . $shrine_title_url . '-' . $shrine->shrine_id) ?>">
                                        <img src="<?= base_url('uploads/maka_madina_shrines/' . $shrine->shrine_image) ?>" width="800" height="533" class="img-responsive" alt="">
                                        <div class="short_info_grid">

                                            <h3><?= $shrine->shrine_title_ar ?></h3>
                                            <em> <?= $shrine->city_title_ar ?></em>
                                            <p>
                                                المزيد
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- End col-md-6 -->

                    <?php } ?>
                <?php } ?>


            </div>
            <div id="show-more-btn-box">

            </div>

            <!--            <nav class="text-center">
                            <ul class="pagination">
                                <li class="disabled Previous"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                                </li>

                                <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a>
                                </li>
                                <li><a href="#">2</a>
                                </li>
                                <li><a href="#">3</a>
                                </li>
                                <li><a href="#">4</a>
                                </li>
                                <li><a href="#">5</a>
                                </li>

                                <li class="Next">
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>

                            </ul>
                        </nav>-->
        </div>
        <!-- End col lg 9 -->
    </div>
    <!-- End row -->
</div>
<!-- End container -->

<?php
global $_require;
$_require['js'] = array('shrines.js');
?>

