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

                <div id="filters_col">
                    ابحث عن برنامجك
                    <div >
                        <div id="panel-cities">
                            <div class="input-group col-md-12 col-xs-12 mt20">
                                <input type="text" class="form-control input-lg" id="city-input" placeholder="<?= _lang('enter_country_name') ?>">
                            </div>
                            <div class="scroll mt20">
                                <div class="filter_type">
                                    <ul class="scroll" id="city-block">


<?php $count = 1; ?>
                            <?php if ($cities) { ?>
                                <?php foreach ($cities as $value) { ?>
                                   
                                     <?php $input_id = "city_id_" . $count ?>

                                         <li>
                                           <div class="checkbox">
                                                <label for="city_<?= $value->id ?>">
                                                    <input class="city-checkbox"  type="checkbox"  value="<?= $value->id ?>" id="city_<?= $value->id ?>" data-id="<?= $value->id ?>" data-title = "<?= $value->title_ar ?>">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                    <?= $value->title_ar ?>
                                                </label>
                                            </div>
                                            
                                        </li>
                         <?php $count++; ?>
                                <?php } ?>
                            <?php } ?>





                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div id="panel-cities">
                            <div class="input-group col-md-12 col-xs-12 mt20">
                                <input type="text" class="form-control input-lg" id="program-input" placeholder="ادخل اسم البرنامج">
                            </div>
                            <div class="scroll mt20">
                                <div class="filter_type">
                                    <ul id="program-block">
                                        
<?php $count = 1; ?>
                            <?php if ($slidebar_programs) { ?>
                                <?php foreach ($slidebar_programs as $value) { ?>
                                   
                                     <?php $input_id = "program_id_" . $count ?>

                                         <li>




                                           <div class="checkbox">
                                                <label for="program_<?= $value->id ?>">
                                                    <input class="program-checkbox"  type="checkbox"  value="<?= $value->id ?>" id="program_<?= $value->id ?>" data-id="<?= $value->id ?>" data-title = "<?= $value->title_ar ?>">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                    <?= $value->title_ar ?>
                                                </label>
                                            </div>
                                            
                                        </li>
                         <?php $count++; ?>
                                <?php } ?>
                            <?php } ?>

                                    </ul>
                                </div>

                            </div>
                        </div>






                        

                    </div>
                    <!--End collapse -->
                </div>
                <!--End filters col-->
            </div>
            <!--End Sticky -->
        </aside>
        <!--End aside -->

        <div class="col-md-9 col-md-pull-3 col-xs-12">
            <div class="programs-main-content">
                <div class="row">
                    <div class="programs-content">

                        <?php if (!empty($all_programs)) { ?>
                    <input type="hidden" value="<?= $programs_count ?>" id="programs_count" name="">
                                <?php foreach ($all_programs as $all_program) { ?>

                                    <div class="col-sm-6 col-xs-12 pull-left wow fadeIn program-item" data-wow-delay="0.1s">
                                        <div class="img_wrapper">


                                            <!-- End tools i-->
                                            <div class="img_container"  style="height: 250px;width:100%;">
                                                <?php $program_title_url = str_replace(' ', '_', $all_program->program_title) ?>
                                                <a href="<?= site_url('programs/detail/' . $program_title_url . '-' . $all_program->program_flight_id . '-' . $all_program->program_id) ?>">
                                                    <img style="height: 100%;width:100%;" src="<?= $all_program->agaza_programs_image_url . 'uploads/programs/' . $all_program->agaza_image ?>" width="800" height="533" class="img-responsive" alt="<?= $all_program->program_title ?>">
																										
<?php if ($all_program->special_offer == 1): ?>
                                                    <div class="ribbon">
                                                        <span>عرض خاص</span>
                                                    </div>
                                                <?php endif; ?>
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
                      
                     
                        
                    </div>

                </div>
                <div class="loading-div" style="display:none;">
                    <div class="loading-div-img">
                        <img src="<?= base_url('uploads/loading.gif') ?>" style="width: 34px;height:34px;">
                    </div>

                </div>
            </div>




        </div>
        <?php if(isset($programs_count) && $programs_count > 12) { ?>
<div class="text-center">
                <a href="javascript:;" id="show-more-programs" class="button_2">عرض المزيد من البرامج</a>
            </div>
            <?php } ?>
        <!-- End col lg 9 -->
    </div>
    <!-- End row -->
</div>
<!-- End container -->

<?php
    global $_require;
    $_require['js'] = array('programs.js');
?>




