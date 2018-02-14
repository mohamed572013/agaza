<?php
    if (isset($edit->maka_madina_hotels_id)) {
        $maka_madina_hotels_id = $edit->maka_madina_hotels_id;
    } else {
        $maka_madina_hotels_id = \xss_clean($this->uri->segment(4));
    }
?>
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
                        <li class="active"><a href="<?= \base_url('admin/maka_madina_hotels_slider/show') ?>"><?= $lang['maka_madina_hotels_slider']; ?></a></li>
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
                            <h3 class="panel-title"><?= $lang['add'] . " " . $lang['maka_madina_hotels_slider']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!empty($error)) { ?>
                                    <div class="alert alert-danger">
                                        <?= $error; ?>
                                    </div>
                                <?php } ?>
                            <!--Table Wrapper Start-->
                            <form  enctype="multipart/form-data" action="<?= \base_url('admin/maka_madina_hotels_slider') . $action; ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">


                                <?php
                                    $active[0] = "  غير مفعل";
                                    $active[1] = "مفعل";
                                    if (!isset($edit->active)) {
                                        $active_val = 1;
                                    } else {
                                        $active_val = $edit->active;
                                    }
                                ?>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['state']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <?php echo form_dropdown('active', $active, $active_val, 'class="form-control"') ?>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['choose_hotel']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <select class="form-control" required="required" name="maka_madina_hotels_id" id="maka_madina_hotels_id">
                                            <option value=""><?= $lang['choose_hotel']; ?></option>
                                            <?php
                                                foreach ($hotels as $value) {
                                                    $select = "";
                                                    if ($maka_madina_hotels_id == $value->id) {
                                                        $select = "selected";
                                                    }
                                                    echo "<option value='" . $value->id . "' $select >$value->title_en   -   $value->title_ar</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['title_ar']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="<?php if (isset($edit->title_ar)) echo $edit->title_ar;else if (isset($_POST['title_ar'])) echo xss_clean($_POST['title_ar']); ?>">
                                    </div>
                                </div>


                                <?php if (isset($edit->image)) {
                                        ?>
                                        <div class="form-group">

                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                                <img src="<?php echo base_url('uploads/maka_madina_hotels_slider/' . $edit->image); ?>" width="200" height="100" />
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







                                <div class="form-group text-center">
                                    <button class="btn btn-sm btn-success" type="submit"><?= $lang['save_data']; ?></button>
                                </div>

                                <!--Table Wrapper Finish-->
                        </div>
                        </form>


                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['add'] . " " . $lang['multi_upload']; ?></h3>
                        </div>

                        <br>
                        <form  enctype="multipart/form-data" action="<?= \base_url('admin/maka_madina_hotels_slider/do_upload_images'); ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">

                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['choose_hotel']; ?></label>
                                <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                    <select class="form-control" required="required" name="maka_madina_hotels_id" id="maka_madina_hotels_id">
                                        <option value=""><?= $lang['choose_hotel']; ?></option>
                                        <?php
                                            foreach ($hotels as $value) {
                                                $select = "";
                                                if ($maka_madina_hotels_id == $value->id) {
                                                    $select = "selected";
                                                }
                                                echo "<option value='" . $value->id . "' $select >$value->title_en   -   $value->title_ar</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?>  : gif | jpeg | jpg | png</label>
                                <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                    <input type="file" name="images[]" multiple="multiple" class="form-control" id="image"   >
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-success" type="submit"><?= $lang['save_data']; ?></button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <!-- Main Content Element  End-->

        </div>
    </div>



</section>
