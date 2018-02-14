


<!-- INNER-BANNER -->
<div class="inner-banner style-6">
    <img class="center-image" src="img/gallery/bg_1.jpg" alt="">
    <div class="vertical-align">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <ul class="banner-breadcrumb color-white clearfix">
                        <li><a class="link-blue-2" href="#">الرئيسية</a> /</li>
                        <li><span>المزارات</span></li>
                    </ul>
                    <h2 class="color-white">المزارات</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TEAM -->
<div class="main-wraper padd-70-70 rtl">
    <div class="container">
        <div class="filter style-2">
            <ul class="filter-nav">
                <li class="selected"><a href="#all" data-filter="*">الكل</a></li>
                <?php foreach ($new_cities as $city) { ?>
                        <li><a href="<?= '#' . $city->title_ar ?>" data-filter="<?= '.' . $city->title_ar ?>"><?= $city->title_ar ?></a></li>
                    <?php } ?>

            </ul>
        </div>
        <div class="filter-content row">
            <div class="grid-sizer col-mob-12 col-xs-6 col-sm-4"></div>
            <?php foreach ($new_cities as $city) { ?>
                    <?php if (!empty($city->shrines)) { ?>
                        <?php foreach ($city->shrines as $key => $shrine) { ?>
                            <div class="item <?= $city->title_ar ?> gal-item col-mob-12 col-xs-6 col-sm-4">
                                <?php $shrine_title_url = str_replace(' ', '-', $shrine->title_ar) ?>
                                <?php $city_title_url = str_replace(' ', '-', $city->title_ar) ?>
                                <a class="black-hover" href="<?= base_url('shrines/' . $shrine_title_url . '/' . $city_title_url); ?>">
                                    <img class="img-full img-responsive" src="<?= base_url('uploads/maka_madina_shrines/' . $shrine->image); ?>" alt="<?= $shrine->title_ar; ?>">
                                    <div class="tour-layer delay-1"></div>
                                    <div class="vertical-align">
                                        <h3 class="color-white"><b><?= $shrine->title_ar; ?></b></h3>
                                        <h5 class="color-white"><?= $shrine->desc_ar; ?></h5>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>


        </div>
    </div>
</div>

