<!--Page main page start-->
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!--Top header start-->
                    <!--Top header end -->

                    <!--Top breadcrumb start -->
                    <ol class="breadcrumb">
                        <li> <i class="fa fa-home"></i> </li>
                        <li> <?php echo $lang['basic_data']; ?></li>
                        <li class="active"><a href="<?= \base_url('admin/haj_umrah_programs') ?>"><?= _lang('haj_umrah_programs'); ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['add'] . " " . _lang('haj_umrah_programs'); ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!empty($error)) { ?>
                                    <div class="alert alert-danger">
                                        <?= $error; ?>
                                    </div>
                                <?php } ?>
                            <!--Table Wrapper Start-->
                            <form  enctype="multipart/form-data"  action="<?= \base_url('admin/haj_umrah_programs/add'); ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">


                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified icon-tab">
                                    <li class="active text-capitalize"><a href="#site_settings_edit" onclick="return false;" data-toggle="tab"><i class="fa fa-home"></i> <span> بيانات اساسية </span></a></li>
                                    <li class=" text-capitalize"><a href="#pages_settings" data-toggle="tab"><i class="fa fa-envelope-o"></i> <span>بيانات اخرى للحجز</span></a></li>
                                    <li class=" text-capitalize"><a href="#smtp_setting" data-toggle="tab"><i class="fa fa-envelope-o"></i> <span>بيانات  الظهور</span></a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content tab-border container-fluid">
                                    <br>
                                    <br>
                                    <div class="tab-pane fade active in" id="site_settings_edit">
                                        <!--                                        <div class="form-group">
                                                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('program_type') ?></label>
                                                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                                        <label class="radio-inline">
                                                                                            <input type="radio" name="program_type" id="domestic_tourism" value="domestic_tourism" class="programTypeRadio" checked> <?= _lang('domestic_tourism') ?>
                                                                                        </label>
                                                                                        <label class="radio-inline">
                                                                                            <input type="radio" name="program_type" id="haj_umrah" value="haj_umrah" class="programTypeRadio"> <?= _lang('haj_umrah') ?>
                                                                                        </label>

                                                                                    </div>

                                                                                </div>-->
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['state']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">الاسم لدينا</label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <input type="text" class="form-control" required="required" id="title_ar" name="title_ar" value="<?php
                                                    if (isset($_POST['title_ar']))
                                                        echo xss_clean($_POST['title_ar']);
                                                    else if (isset($edit->title_ar))
                                                        echo $edit->title_ar;
                                                ?>">
                                            </div>
                                        </div>
                                        <!--                                        <div class="form-group">
                                                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['branches']; ?></label>
                                                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                                        <select class="form-control"  required="required"   name="branches" id="branches">
                                                                                            <option value=""><?= $lang['branches']; ?></option>
                                        <?php
                                            foreach ($branches as $value) {
                                                $select = "";

                                                if ($branches_val == $value->id) {
                                                    $select = "selected";
                                                }
                                                echo "<option value='" . $value->id . "' $select >      $value->title_ar</option>";
                                            }
                                        ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>-->




                                        <!--                                        <div class="form-group">
                                                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">كود البرنامج لدى الشركة</label>
                                                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                                        <input type="text" class="form-control"  required="required"  id="our_code" name="our_code" value="<?php
                                            if (isset($_POST['our_code']))
                                                echo xss_clean($_POST['our_code']);
                                            else if (isset($edit->our_code))
                                                echo $edit->our_code;
                                        ?>">
                                                                                    </div>
                                                                                </div>-->
                                        <!--                                        <div class="form-group">
                                                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['programs_seasons']; ?></label>
                                                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                                        <select class="form-control"  required="required"   name="programs_seasons" id="programs_seasons">
                                                                                            <option value=""><?= $lang['programs_seasons']; ?></option>
                                        <?php
                                            foreach ($programs_seasons as $value) {
                                                $select = "";

                                                if ($programs_seasons_val == $value->id) {
                                                    $select = "selected";
                                                }
                                                echo "<option value='" . $value->id . "' $select >      $value->title_ar</option>";
                                            }
                                        ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>-->
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['programs_levels']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <select class="form-control"  required="required"   name="programs_levels" id="programs_levels">
                                                    <option value=""><?= $lang['programs_levels']; ?></option>
                                                    <?php
                                                        foreach ($programs_levels as $value) {
                                                            $select = "";

                                                            if ($programs_levels_val == $value->id) {
                                                                $select = "selected";
                                                            }
                                                            echo "<option value='" . $value->id . "' $select >      $value->title_ar</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>







                                        <!--										<div class="form-group">
                                                                                                                                <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">الطيران</label>
                                                                                                                                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                                                                                                                        <select class="form-control demo-code-language selectized form-control" required="required" name="flight_reservation_id" id="flight_reservation_id">
                                        <?php
                                            foreach ($flights as $page) {
                                                $select = "";
                                                if ($flight_reservation_id == $page->id) {
                                                    $select = "selected";
                                                }
                                                echo "<option value='" . $page->id . "' $select > " . $page->going_date . "( " . $page->name_from_city . " ==> " . $page->name_to_city . " ) // " . $page->return_date . "( " . $page->return_name_from_city . " ==> " . $page->return_name_to_city . " ) ( " . $page->passenger_num . "  راكب)</option>";
                                            }
                                        ?>
                                                                                                                                        </select>
                                                                                                                                </div>
                                                                                                                        </div>-->




                                    </div>
                                    <div class="tab-pane fade " id="smtp_setting">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">عرض فى الرئيسية</label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <?php echo form_dropdown('program_view_in_home', $active, $program_view_in_home_val, 'class="form-control"') ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">عرض   خاص</label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <?php echo form_dropdown('special_offer', $active, $special_offer_val, 'class="form-control"') ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['this_order']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <input type="number" min="1" required="required" class="form-control" id="this_order" name="this_order" value="<?php
                                                    if (isset($_POST['this_order']))
                                                        echo xss_clean($_POST['this_order']);
                                                    else if (isset($edit->this_order))
                                                        echo $edit->this_order;
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">السعر يبدا من </label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <input type="number" min="1"  required="required" class="form-control" id="price_start_from" name="price_start_from" value="<?php
                                                    if (isset($_POST['price_start_from']))
                                                        echo xss_clean($_POST['price_start_from']);
                                                    else if (isset($edit->price_start_from))
                                                        echo $edit->price_start_from;
                                                ?>">
                                            </div>
                                        </div>
                                        <?php if (isset($edit->image)) {
                                                ?>
                                                <div class="form-group">

                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?></label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                                        <img src="<?php echo base_url('uploads/programs/' . $edit->image); ?>" width="200" height="100" />
                                                    </div>
                                                </div>

                                            <?php }
                                        ?>
                                        <div class="form-group">

                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?>  : gif | jpeg | jpg | png</label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <input type="file" class="form-control" id="image" name="image"  >
                                            </div>
                                        </div>
                                        <div class="form-group row form-box">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['program_include']; ?></label>
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <textarea rows="5" class="form-control" name="program_include" id="program_include"><?php if (isset($edit->program_include)) echo $edit->program_include;else if (isset($_POST['program_include'])) echo xss_clean($_POST['program_include']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row form-box">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['program_not_include']; ?></label>
                                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                <textarea rows="5" class="form-control" name="program_not_include" id="program_not_include"><?php if (isset($edit->program_not_include)) echo $edit->program_not_include;else if (isset($_POST['program_not_include'])) echo xss_clean($_POST['program_not_include']); ?></textarea>
                                            </div>
                                        </div>




                                        <div class="form-group row form-box">
                                            <div class="form-group row form-box">
                                                <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['desc_ar']; ?></label>
                                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                    <textarea rows="5" class="form-control" name="desc_ar" id="desc_ar"><?php if (isset($edit->desc_ar)) echo $edit->desc_ar;else if (isset($_POST['desc_ar'])) echo xss_clean($_POST['desc_ar']); ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row form-box">
                                                <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['keywords_ar']; ?></label>
                                                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                    <textarea rows="5" class="form-control" name="keywords_ar" id="keywords_ar"><?php if (isset($edit->keywords_ar)) echo $edit->keywords_ar;else if (isset($_POST['keywords_ar'])) echo xss_clean($_POST['keywords_ar']); ?></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade  " id="pages_settings">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('stars'); ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <input type="number" min="1"  required="required" class="form-control" id="stars" name="stars" value="<?php
                                                    if (isset($_POST['stars']))
                                                        echo xss_clean($_POST['stars']);
                                                    else if (isset($edit->stars))
                                                        echo $edit->stars;
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('hotel'); ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <select class="form-control"  required="required"   name="maka_hotel_id" id="maka_hotel_id">
                                                    <option value=""><?= $lang['maka_hotel']; ?></option>
                                                    <?php
                                                        foreach ($maka_hotels as $value) {
                                                            $select = "";

                                                            if ($maka_hotel_id_val == $value->id) {
                                                                $select = "selected";
                                                            }
                                                            echo "<option value='" . $value->id . "' $select >    $value->title_ar</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"> <?= _lang('nights number'); ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <input type="number" class="form-control"  required="required"   id="maka_nights" name="maka_nights" value="<?php
                                                    if (isset($_POST['maka_nights']))
                                                        echo xss_clean($_POST['maka_nights']);
                                                    else if (isset($edit->maka_nights))
                                                        echo $edit->maka_nights;
                                                ?>">
                                            </div>
                                        </div>



                                        <!--                                        <div class="form-group">
                                                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['madina_hotel']; ?></label>
                                                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                                        <select class="form-control"   required="required"   name="madina_hotel_id" id="madina_hotel_id">
                                                                                            <option value=""><?= $lang['madina_hotel']; ?></option>
                                        <?php
                                            foreach ($madina_hotels as $value) {
                                                $select = "";

                                                if ($madina_hotel_id_val == $value->id) {
                                                    $select = "selected";
                                                }
                                                echo "<option value='" . $value->id . "' $select >    $value->title_ar</option>";
                                            }
                                        ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>-->
                                        <!--                                        <div class="form-group">
                                                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"> عدد الليالي فى المدينة</label>
                                                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                                        <input type="number" class="form-control"  required="required"   id="madina_nights" name="madina_nights" value="<?php
                                            if (isset($_POST['madina_nights']))
                                                echo xss_clean($_POST['madina_nights']);
                                            else if (isset($edit->madina_nights))
                                                echo $edit->madina_nights;
                                        ?>">
                                                                                    </div>
                                                                                </div>-->


                                    </div>

                                </div>



                                <div class="form-group text-center">
                                    <button class="btn btn-sm btn-success" type="submit"><?= $lang['save_data']; ?></button>
                                </div>

                                <!--Table Wrapper Finish-->
                        </div>
                        </form>
                    </div>
                    <hr>





                </div>
            </div>
            <!-- Main Content Element  End-->

        </div>
    </div>



</section>



<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
                                            CKEDITOR.replace('program_include');
                                            CKEDITOR.replace('program_not_include');
</script>