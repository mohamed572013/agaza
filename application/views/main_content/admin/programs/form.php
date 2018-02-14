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
                        <li class="active"><a href="<?= \base_url('admin/programs/show') ?>"><?= $lang['programs']; ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <?php
                $action = "/add";
                if ($view_type != 'add') {
                    if (isset($_id)) {
                        $action = "/edit/$_id";
                    }
                }
            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['edit'] . " " . $lang['programs']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!empty($error)) { ?>
                                    <div class="alert alert-danger">
                                        <?= $error; ?>
                                    </div>
                                <?php } ?>
                            <!--Table Wrapper Start-->
                            <form  enctype="multipart/form-data"  action="<?= \base_url('admin/programs') . $action; ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">


                                <?php
                                    $active_show[0] = "  غير مفعل";
                                    $active_show[1] = "مفعل";

                                    if (isset($edit->special_offer)) {
                                        $special_offer_val = $edit->special_offer;
                                    } else {
                                        $special_offer_val = 0;
                                    }
                                    if (isset($edit->show_in_slider)) {
                                        $show_in_slider = $edit->show_in_slider;
                                    } else {
                                        $show_in_slider = 0;
                                    }
                                    if (isset($edit->show_in_agazabook)) {
                                        $show_in_agazabook = $edit->show_in_agazabook;
                                    } else {
                                        $show_in_agazabook = 0;
                                    }
                                    $active[0] = "  غير مفعل";
                                    $active[1] = "مفعل";
                                    if (isset($_POST['active']) && $_POST['active'] >= 0) {
                                        $active_val = $_POST['active'];
                                        $programs_levels_val = $_POST['programs_levels'];
                                    } else
                                    if (!isset($edit->active)) {
                                        $active_val = 1;
                                        $programs_levels_val = "";
                                    } else {
                                        $active_val = $edit->active;
                                        $programs_levels_val = $edit->programs_levels;
                                    }
                                ?>

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-justified icon-tab">
                                    <li class="active text-capitalize"><a href="#site_settings_edit" data-toggle="tab"><i class="fa fa-home"></i> <span> بيانات اساسية </span></a></li>
<!--                                    <li class=" text-capitalize"><a href="#pages_settings" data-toggle="tab"><i class="fa fa-envelope-o"></i> <span>بيانات اخرى للحجز</span></a></li>-->
                                    <li class=" text-capitalize"><a href="#smtp_setting" data-toggle="tab"><i class="fa fa-envelope-o"></i> <span>بيانات  الظهور</span></a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content tab-border container-fluid">
                                    <br>
                                    <br>
                                    <div class="tab-pane fade active in" id="site_settings_edit">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['state']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <?php echo form_dropdown('active', $active, $active_val, 'class="form-control"') ?>
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




                                    </div>
                                    <div class="tab-pane fade " id="smtp_setting">
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">عرض فى السلايدر</label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <?php echo form_dropdown('show_in_slider', $active, $show_in_slider, 'class="form-control" id="show_in_slider"') ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">عرض فى اجازة بوك</label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <?php echo form_dropdown('show_in_agazabook', $active, $show_in_agazabook, 'class="form-control" id="show_in_agazabook"') ?>
                                            </div>
                                        </div>

                                        <div class="form-group" id="slider-image-upload-box" style="display:<?= (isset($edit->slider_image)) ? 'block' : 'none'; ?>;">

                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('slider_image'); ?>  : gif | jpeg | jpg | png</label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <input type="file" class="form-control" id="slider_image" name="slider_image"  >
                                            </div>
                                        </div>
                                        <?php if (isset($edit->slider_image)) {
                                                ?>
                                                <div class="form-group">

                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?></label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                                        <img src="<?php echo base_url('uploads/programs_slider/' . $edit->slider_image); ?>" width="200" height="100" />
                                                    </div>
                                                </div>

                                            <?php }
                                        ?>
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
<?php
    global $_require;
    $_require['admin.js'] = array('programs.js');
?>