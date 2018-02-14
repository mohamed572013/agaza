<style>
    .main-wraper{
        position: relative;
    }
    .main-wraper .loading-div{
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color:rgba(255, 255, 255, 0.8);
    }
    .main-wraper .loading-div-img{
        position: relative;
        height: 100%;
        width: 100%;
        z-index: 50;
    }
    .main-wraper .loading-div-img img{
        position: absolute;
        top: 10%;
        left: 50%;
        margin-left:-66px;

    }
</style>
<div class="inner-banner style-6">
    <img class="center-image" src="<?= base_url('img/gallery/bg_1.jpg'); ?>" alt="">
    <div class="vertical-align">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <!--                    <ul class="banner-breadcrumb color-white clearfix">
                                            <li><a class="link-blue-2" href="#">البلد</a> /</li>
                                            <li><span>المزارات</span></li>
                                        </ul>-->
                    <h2 class="color-white">وجهات السفر</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TEAM -->
<div class="main-wraper padd-70-70 rtl">
    <div class="container">

        <div class="tour-item-grid row">
            <div class="text-center" style="margin-bottom: 30px;padding-right: 20px;">
                <label >
                    <input checked type="radio" class="in_out_egypt" name="in_out_egypt" id="in_out_egypt_1" value="all"> الكل
                </label>
                <label>
                    <input type="radio" class="in_out_egypt" name="in_out_egypt" id="in_out_egypt_2" value="in_egypt"> داخل مصر
                </label>
                <label>
                    <input type="radio" class="in_out_egypt" name="in_out_egypt" id="in_out_egypt_2" value="out_egypt"> خارج مصر
                </label>

            </div>
            <div id="destinations">
                <?php if ($cities) { ?>
                        <?php foreach ($cities as $city) { ?>
                            <div class="col-mob-12 col-xs-6 col-sm-4 col-md-3 hvr-pulse">
                                <?php
                                $country_title_url = str_replace(' ', '-', $city->country_name);
                                $city_title_url = str_replace(' ', '-', $city->title_ar);
                                ?>
                                <a href="<?= site_url('destinations/' . $city_title_url . '/' . $country_title_url); ?>"><div class="tour-item style-5 bg-grey-2">
                                        <div class="radius-top">
                                            <img src="<?= base_url('uploads/places/' . $city->image); ?>" alt="<?= $city->title_ar ?>">
                                        </div>
                                        <div class="tour-desc" style="height: 120px;">
                                            <h4 class="text-right"><?= $city->title_ar ?></h4>
                                            <div class="tour-text text-right color-grey-3"><?php echo mb_substr($city->desc_ar, 0, 50, "utf-8") . ' ....'; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>

            </div>



        </div>


    </div>
    <div class="loading-div" style="display:none;">
        <div class="loading-div-img">
            <img src="<?= base_url('uploads/loading.gif') ?>">
        </div>

    </div>
</div>
<?php
    global $_require;
    $_require['js'] = array('destinations.js');
?>
