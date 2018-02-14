
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
                        <li class="active"><a href="<?= \base_url("admin/places/show") ?>"><?= $lang['places']; ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['add_new_page']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!empty($error)) { ?>
                                    <div class="alert alert-danger">
                                        <?= $error; ?>
                                    </div>
                                <?php } ?>
                            <!--Table Wrapper Start-->
                            <form  enctype="multipart/form-data"   action="<?= \base_url('admin/places/' . $action); ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">

                                <?php
                                    $city_val = "";
                                    $country_val = "";
                                    $country_name = "";
                                    $cities_name = "";
                                    if (isset($edit->place_id)) {
                                        $city_val = $edit->place_id;
                                        $country_val = $edit->place_id;
                                    }


                                    if (\count($cities) > 0) {
                                        $cities_name = "place_id";
                                    } else if (\count($countries) > 0) {
                                        $country_name = "place_id";
                                    }
                                    if (\count($countries) > 0) {
                                        ?>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['choose_country']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <select class="form-control" required="required" name="<?= $country_name; ?>"   id="country_id"  >
                                                    <option value=""><?= $lang['choose_country']; ?></option>
                                                    <?php
                                                    foreach ($countries as $value) {
                                                        $select = "";
                                                        if ($edit->place_id == $value->id) {
                                                            $select = "selected";
                                                        }
                                                        if ($value->id == $_id) {
                                                            $select = "selected";
                                                        }
                                                        echo "<option value='" . $value->id . "' $select >   $value->title_ar</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                    }

                                    if (\count($cities) > 0) {
                                        ?>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['becomeopm_country']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <select class="form-control" required="required" name="<?= $city_val ?>" id="city_id">
                                                    <?php
                                                    foreach ($cities as $value) {
                                                        $select = "";
                                                        if ($edit->place_id == $value->id) {
                                                            $select = "selected";
                                                        }
                                                        echo "<option value='" . $value->id . "' $select >     $value->title_ar</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>
                                <?php
                                    $active[0] = "  غير مفعل";
                                    $active[1] = "مفعل";
                                    if (!isset($edit->show_home)) {
                                        $active_val = 1;
                                    } else {
                                        $active_val = $edit->show_home;
                                    }
                                ?>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['state']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <?php echo form_dropdown('show_home', $active, $active_val, 'class="form-control"') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['title_ar']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="<?php if (isset($edit->title_ar)) echo $edit->title_ar;else if (isset($_POST['title_ar'])) echo xss_clean($_POST['title_ar']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['title_en']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="title_en" name="title_en" value="<?php if (isset($edit->title_en)) echo $edit->title_en;else if (isset($_POST['title_en'])) echo xss_clean($_POST['title_en']); ?>">
                                    </div>
                                </div>



                                <?php if (isset($edit->image)) {
                                        ?>
                                        <div class="form-group">

                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                                <img src="<?php echo base_url('uploads/places/' . $edit->image); ?>" width="200" height="100" />
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
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['body_ar']; ?></label>
                                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                        <textarea rows="5" class="form-control" name="body_ar" id="body_ar"><?php if (isset($edit->body_ar)) echo $edit->body_ar; ?></textarea>
                                    </div>
                                </div>



                                <div class="form-group row form-box">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['desc_ar']; ?></label>
                                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                        <textarea rows="5" class="form-control" name="desc_ar" id="desc_ar"><?php if (isset($edit->desc_ar)) echo $edit->desc_ar; ?></textarea>
                                    </div>
                                </div>


                                <div class="form-group row form-box">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['keywords_ar']; ?></label>
                                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                        <textarea rows="5" class="form-control" name="keywords_ar" id="keywords_ar"><?php if (isset($edit->keywords_ar)) echo $edit->keywords_ar; ?></textarea>
                                    </div>
                                </div>






                                <div class="form-group text-center">
                                    <button class="btn btn-sm btn-success" type="submit"><?= $lang['save_data']; ?></button>
                                </div>

                                <!--Table Wrapper Finish-->
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Main Content Element  End-->

        </div>
    </div>



</section>

<?php
    if (\count($cities) > 0) {
        ?>
        <script type="text/javascript" src="assets/admin/ltr/js/lib/jquery-1.11.min.js"></script>

        <script>
                $(document).ready(function () {

                    //********** getsub categery products ********
                    $("#country_id").change(function () {
                        var country_id = $("#country_id").val();
                        $.ajax({
                            type: "post",
                            url: "<?= base_url("Ajax/gatCountryCities") ?>",
                            data: {country_id: country_id},
                            success: function (data) {
                                $("#city_id").html(data);
                            }
                        });
                    });
                });
        </script>
    <?php } ?>
