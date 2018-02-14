<style>
    .programs-main-content{
        position: relative;
    }
    .programs-main-content .loading-div{
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.8);
    }
    .programs-main-content .loading-div-img{
        position: relative;
        height: 100%;
        width: 100%;
        z-index: 50;
    }
    .programs-main-content .loading-div-img img{
        position: absolute;
        top: 15px;
        left: 50%;
        margin-left: -34px;

    }
</style>
<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_florence_2.jpg" data-natural-width="1400" data-natural-height="420">
    <div id="sub_content_in">
        <h1>برامجنا</h1>
    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>">الرئيسية</a></li>
            <li>برامجنا</li>
        </ul>
    </div>
</div>
<!-- End position -->

<div class="container margin_60_30">
    <div class="row">

        <aside class="col-md-3 col-md-push-9" id="sidebar">
            <div class="theiaStickySidebar ">
<!--
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
-->

                <div id="filters_col">
                    ابحث عن برنامجك
                    <div>
                        <div id="panel-cities">
                            <div class="input-group col-md-12 mt20">
                                <input type="text" class="form-control input-lg" placeholder="ادخل اسم المدينة">
                            </div>
                            <div class="scroll mt20">
                                <div class="filter_type">
                                    <ul>
                                        <li>
                                            <label>القاهرة</label>
                                            <input type="checkbox" class="js-switch" checked="" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="background-color: rgb(172, 211, 115); border-color: rgb(172, 211, 115); box-shadow: rgb(172, 211, 115) 0px 0px 0px 11px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s;"><small style="left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>الكويت</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>مرسى مطروح</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>شرم الشيخ</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>الاقصر</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>اسوان</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>الغردقة</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>العين السخنة</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>الأسكندرية</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>الساحل الشمالي</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>

                                        <li>
                                            <label>راس سدر</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>الجونة</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>مكة</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>لبنان</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>العزيزية</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div id="panel-cities">
                            <div class="input-group col-md-12 mt20">
                                <input type="text" class="form-control input-lg" placeholder="ادخل اسم الفندق">
                            </div>
                            <div class="scroll mt20">
                                <div class="filter_type">
                                    <ul>
                                        <li>
                                            <label> فندق سينا واى لاجون</label>
                                            <input type="checkbox" class="js-switch" checked="" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="background-color: rgb(172, 211, 115); border-color: rgb(172, 211, 115); box-shadow: rgb(172, 211, 115) 0px 0px 0px 11px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s;"><small style="left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>بانوراما بانجلوس ريزورت الجونة</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>فندق جلوريا</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>فندق كاسيلز البرشاء</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>فندق ذا أدريس داون تاون</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>فندق دار التوحيد انتركونتينتال</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>فندق سويس اوتيل مكة</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>
                                        <li>
                                            <label>فندق برج ساعة مكة فيرمونت</label>
                                            <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                        </li>

                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="filter_type">
                            <h6>تصفية حسب السعر</h6>
                            <span class="irs js-irs-0"><span class="irs"><span class="irs-line" tabindex="-1"><span class="irs-line-left"></span><span class="irs-line-mid"></span><span class="irs-line-right"></span></span><span class="irs-min" style="display: none; visibility: visible;">0</span><span class="irs-max" style="display: none; visibility: visible;">1</span><span class="irs-from" style="visibility: visible; left: 12.5112%;">Min. 60</span><span class="irs-to" style="visibility: visible; left: 54.4843%;">Min. 130</span><span class="irs-single" style="visibility: hidden; left: 22.9596%;">Min. 60 — Min. 130</span></span><span class="irs-grid"></span><span class="irs-bar" style="left: 22.1525%; width: 43.3184%;"></span><span class="irs-shadow shadow-from" style="display: none;"></span><span class="irs-shadow shadow-to" style="display: none;"></span><span class="irs-slider from" style="left: 18.565%;"></span><span class="irs-slider to type_last" style="left: 61.8834%;"></span></span><input type="text" id="range" name="range" value="" class="irs-hidden-input" readonly="">
                        </div>
                        <div class="filter_type">
                            <h6>تصفية حسب المستوي</h6>
                            <ul>
                                <li>
                                    <label>
                                        <div class="rating">
                                            <span> </span><span> </span><span> </span><span> </span><span> </span>
                                        </div>
                                        نجوم</label>
                                    <input type="checkbox" class="js-switch" checked="" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="background-color: rgb(172, 211, 115); border-color: rgb(172, 211, 115); box-shadow: rgb(172, 211, 115) 0px 0px 0px 11px inset; transition: border 0.4s, box-shadow 0.4s, background-color 1.2s;"><small style="left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s, left 0.2s;"></small></span>
                                </li>
                                <li>
                                    <label>
                                        <div class="rating">
                                            <span> </span><span> </span><span> </span><span> </span>
                                        </div>
                                        نجوم
                                    </label>
                                    <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                </li>
                                <li>
                                    <label>
                                        <div class="rating">
                                            <span> </span><span> </span><span> </span>
                                        </div>
                                        نجوم
                                    </label>
                                    <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                </li>
                                <li>
                                    <label>
                                        <div class="rating">
                                            <span> </span><span> </span>
                                        </div>
                                        نجوم
                                    </label>
                                    <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                </li>
                                <li>
                                    <label>
                                        <div class="rating">
                                            <span> </span>
                                        </div>
                                        نجوم
                                    </label>
                                    <input type="checkbox" class="js-switch" data-switchery="true" style="display: none;"><span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s, box-shadow 0.4s;"><small style="left: 0px; transition: background-color 0.4s, left 0.2s;"></small></span>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!--End collapse -->
                </div>



            </div>
        </aside>
        <!--End aside -->

        <div class="col-md-9 col-md-pull-3">
            <div class="programs-main-content">
                <div class="row">
                    <div class="programs-content">

                        <?php if ($all_programs) { ?>
                                <?php foreach ($all_programs as $all_program) { ?>

                                    <div class="col-sm-6 pull-left wow fadeIn" data-wow-delay="0.1s">
                                        <div class="img_wrapper">


                                            <!-- End tools i-->
                                            <div class="img_container"  style="height: 250px;width:100%;">
                                                <?php $program_title_url = str_replace(' ', '_', $all_program->program_title) ?>
                                                <a href="<?= site_url('programs/detail/' . $program_title_url . '-' . $all_program->program_flight_id . '-' . $all_program->program_id) ?>">
                                                    <img style="height: 100%;width:100%;" src="<?= $all_program->company_url . 'uploads/programs/' . $all_program->image ?>" width="800" height="533" class="img-responsive" alt="<?= $all_program->program_title ?>">
                                                    <div class="short_info_grid">
                                                        <small><strong><?= arabicDate($all_program->going_date) . ' الى ' . arabicDate($all_program->return_date); ?></strong></small>
                                                        <h1><?= $all_program->program_title ?></h1>
                                                        <em><?= $all_program->nights + 1 ?> ايام | <?= $all_program->nights ?> ليالى</em>
                                                        <em>  تبدأ من <?= $all_program->price_start_from ?> <?= $all_program->currency_sign ?></em>

                                                        <p>
                                                            المزيد
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- End img_wrapper -->
                                    </div>
                                    <!-- End col-md-6 -->
                                <?php } ?>
                            <?php } ?>
                        <div class="clearfix"></div>
                        <span class="total_pages" style="display: none;"><?php echo $pages ?></span>
                        <nav class="text-center">
                            <?php if ($all_programs && $total > 8) { ?>
                                    <div class="pagy main-pagy">
                                        <?php
                                        if ($current_page >= $pages) {
                                            echo '<a  style="display:none;" href="' . $url . '/page-' . $next_page . '" class="next">next</a>';
                                        } else {
                                            echo '<a href="' . $url . '/page-' . $next_page . '" class="next">next</a>';
                                        }
                                        ?>
                                        <?php
                                        for ($x = 1; $x <= $pages; $x++) {
                                            ?>
                                            <a  href="<?php echo $url . '/page-' . $x; ?>"  class="page <?php
                                            if ($x == $current_page) {
                                                echo "active";
                                            }
                                            ?>"><?php echo $x; ?></a>
                                            <?php } ?>
                                            <?php
                                            if ($current_page == 1) {
                                                echo '<a style="display:none;" href="' . $url . '/page-' . $prev_page . '" class="prev">prev</a>';
                                            } else {
                                                echo '<a href="' . $url . '/page-' . $prev_page . '" class="prev">prev</a>';
                                            }
                                            ?>
                                    </div>
                                <?php } ?>
                        </nav>
                    </div>
                </div>
                <div class="loading-div" style="display:none;">
                    <div class="loading-div-img">
                        <img src="<?= base_url('uploads/loading.gif') ?>" style="width: 34px;height:34px;">
                    </div>

                </div>
            </div>



        </div>
        <!-- End col lg 9 -->
    </div>
    <!-- End row -->
</div>
<!-- End container -->

<?php
    global $_require;
    $_require['js'] = array('programs.js');
?>