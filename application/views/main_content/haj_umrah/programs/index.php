<script>
        var price = {
            min: <?= $min_price ?>,
            max: <?= $max_price ?>

        };
</script>

<div class="inner-banner">
    <img class="center-image" src="<?= base_url('img/tour_list/inner_banner_1.jpg'); ?>" alt="">
    <div class="vertical-align">
        <div class="container">
            <ul class="banner-breadcrumb color-white clearfix">
                <li><a class="link-blue-2" href="#">الرئيسية</a> /</li>
                <li><span class="color-blue-2">البرامج</span></li>
            </ul>
            <h2 class="color-white">البرامج</h2>
            <span class="total_pages" style="display: none;"><?php echo $pages ?></span>

        </div>
    </div>
</div>

<div class="list-wrapper bg-grey-2">
    <div class="container">
        <div class="programs-main-content">

            <div class="row">
                <?php $this->load->view('components/side_bar'); ?>

                <div class="col-xs-12 col-sm-8 col-md-9 programs-main-content">
                    <div class="list-header clearfix">
                        <div class="drop-wrap drop-wrap-s-4 color-4 list-sort">
                            <div class="drop">
                                <b>ترتيب بالسعر</b>
                                <a href="#" class="drop-list"><i class="fa fa-angle-down"></i></a>
                                <span>
                                    <a href="#" class="sort" data-sort-type="price_start_from" data-sort-value="ASC">تصاعدي</a>
                                    <a href="#" class="sort" data-sort-type="price_start_from" data-sort-value="DESC">تنازلى</a>
                                </span>
                            </div>
                        </div>
                        <!--                        <div class="drop-wrap drop-wrap-s-4 color-4 list-sort">
                                                    <div class="drop">
                                                        <b>ترتيب بالنجوم</b>
                                                        <a href="#" class="drop-list"><i class="fa fa-angle-down"></i></a>
                                                        <span>
                                                            <a href="#" class="sort" data-sort-type="stars" data-sort-value="ASC">تصاعدي</a>
                                                            <a href="#" class="sort" data-sort-type="stars" data-sort-value="DESC">تنازلى</a>
                                                        </span>
                                                    </div>
                                                </div>-->

                    </div>
                    <div class="grid-content clearfix programs-content">
                        <?php if ($all_programs) { ?>
                                <?php foreach ($all_programs as $all_program) { ?>
                                    <div class="list-item-entry hvr-float-shadow fr">
                                        <div class="hotel-item style-3 bg-white">
                                            <div class="table-view">
                                                <div class="radius-top cell-view">
                                                    <?php $program_title_url = str_replace(' ', '_', $all_program->program_title) ?>
                                                    <a href="<?= site_url('haj_umrah_programs/detail/' . $program_title_url . '-' . $all_program->program_id) ?>">  <img src="<?= base_url('uploads/programs/' . $all_program->image); ?>" alt=""></a>
                                                </div>
                                                <div class="title hotel-middle clearfix cell-view">

                                                    <h4><b>  <a href="<?= site_url('haj_umrah_programs/detail/' . $program_title_url . '-' . $all_program->program_id) ?>"><?= $all_program->program_title ?></a></b></h4>




                                                    <div class="rate-wrap">
                                                        <div class="date list-hidden fr"><strong><strong><?= $all_program->nights + 1; ?></strong>ايام <?= $all_program->nights ?></strong>ليال </div>
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
                                                    <div class="hotel-person color-dark-2 fr">يبدا من <span class="color-blue"><?= $all_program->price_start_from ?></span>  جنيها</div>

                                                    <a href="<?= site_url('haj_umrah_programs/detail/' . $program_title_url . '-' . $all_program->program_id) ?>" class="c-button m-right bg-3 b-40 pro fl">  المزيد ...</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>


                    </div>

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
                    <?php if ($all_programs && $pages != 1) { ?>
                            <div class="pagy">
                                <?php echo '<a href="' . $url . '/page-' . $next_page . '" class="next">next</a>'; ?>
                                <?php
                                for ($x = 1; $x <= $pages; $x++) {
                                    ?>
                                    <a  href="<?php echo $url . '/page-' . $x; ?>"  class="page <?php
                                    if ($x == $current_page) {
                                        echo "active";
                                    }
                                    ?>"><?php echo $x; ?></a>
                                    <?php } ?>
                                    <?php echo '<a href="' . $url . '/page-' . $prev_page . '" class="prev">prev</a>'; ?>


                            </div>
                        <?php } ?>
                </div>
            </div>
            <div class="loading-div" style="display:none;">
                <div class="loading-div-img">
                    <img src="<?= base_url('uploads/loading.gif') ?>">
                </div>

            </div>
        </div>
    </div>
</div>
<?php
    global $_require;
    $_require['js'] = array('haj_umrah_programs.js');
?>