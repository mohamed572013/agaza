


<!-- INNER-BANNER -->
<div class="inner-banner style-6">
    <img class="center-image" src="img/gallery/bg_1.jpg" alt="">
    <div class="vertical-align">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <!--                    <ul class="banner-breadcrumb color-white clearfix">
                                            <li><a class="link-blue-2" href="#">الرئيسية</a> /</li>
                                            <li><span>المزارات</span></li>
                                        </ul>-->
                    <h2 class="color-white">البلاد</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TEAM -->
<div class="main-wraper padd-70-70 rtl">
    <div class="container">
        <?php if ($new_countries) { ?>
                <?php foreach ($new_countries as $key => $country) { ?>
                    <div class="col-md-2 flag hvr-pulse">
                        <?php $country_title_url = str_replace(' ', '-', $country->title_ar) ?>
                        <a href="<?= base_url('destinations/' . $country_title_url); ?>">
                            <div class="flag-wrapper">
                                <div class="flag_title"><?= $country->title_ar ?></div>
                                <img class="flag" src="<?= base_url('flags/4x3/' . $country->code . '.svg'); ?>" alt="<?= $country->title_ar ?>">
                            </div>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>






    </div>
</div>

