<?php
if (isset($edit->places_id)) {
    $places_val = $edit->places_id;
    $cond_emp['id'] = $places_val;
    $country = $this->maka_madina_shrines->GetWhere("places", "id", "ASC", $cond_emp);
    $country_val = $country[0]->place_id;
} else {
    $places_val = 0;
    $country_val = 0;
}
?><!--Page main page start-->
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
                        <li class="active"><a href="<?= \base_url('admin/maka_madina_shrines/show') ?>"><?= $lang['maka_madina_shrines']; ?></a></li>
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
                            <h3 class="panel-title"><?= $lang['edit'] . " " . $lang['maka_madina_shrines']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!empty($error)) { ?>
                                <div class="alert alert-danger">
                                    <?= $error; ?>
                                </div>
                            <?php } ?>
                            <!--Table Wrapper Start-->
                            <form  enctype="multipart/form-data"  action="<?= \base_url('admin/maka_madina_shrines') . $action; ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">


                                <?php
                                
                                 $stars[1] = 1;
                                $stars[2] = 2;
                                $stars[3] = 3;
                                $stars[4] = 4;
                                $stars[5] = 5;
                                $active_show[0] = "  غير مفعل";
                                $active_show[1] = "مفعل";
                                if (isset($edit->stars)) {
                                    $stars_val =$edit->stars;
                                } else {
                                    $stars_val = 5;
                                }
                                
                                $active[0] = "  غير مفعل";
                                $active[1] = "مفعل";
                                if (!isset($edit->active)) {
                                    $active_val = 1;
                                } else {
                                    $active_val = $edit->active;
                                }
                                $maka_or_madina[0] = $lang["makkah_shrines"];
                                $maka_or_madina[1] = $lang["madina_shrines"];
                                if (!isset($edit->maka_or_madina)) {
                                    $maka_or_madina_val = "";
                                } else {
                                    $maka_or_madina_val = $edit->maka_or_madina;
                                }
                                ?>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['state']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <?php echo form_dropdown('active', $active, $active_val, 'class="form-control"') ?>
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['choose_country']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <select class="form-control"   name="country_id" id="country_id">
                                            <option value=""><?= $lang['choose_country']; ?></option>
                                            <?php
                                            foreach ($countries as $value) {
                                                $select = "";

                                                if ($country_val == $value->id) {
                                                    $select = "selected";
                                                }
                                                echo "<option value='" . $value->id . "' $select >   $value->title_ar</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">اختر المدينة   </label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <select class="form-control"  name="places_id" id="places_id">
                                            <option value="">اختر</option>
                                            <?php
                                            foreach ($cities as $value) {
                                                $select = "";
                                                if ($places_val == $value->id) {
                                                    $select = "selected";
                                                }
                                                echo "<option value='" . $value->id . "' $select >   $value->title_ar</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                   <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['this_order']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="number" min="1" required="required" class="form-control" id="this_order" name="this_order" value="<?php if (isset($edit->this_order)) echo $edit->this_order;else if (isset($_POST['this_order'])) echo xss_clean($_POST['this_order']); ?>">
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

                                            <img src="<?php echo base_url('uploads/maka_madina_shrines/' . $edit->image); ?>" width="200" height="100" />
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
                                        <textarea rows="5" class="form-control" name="body_ar" id="body_ar"><?php if (isset($edit->body_ar)) echo $edit->body_ar;else if (isset($_POST['body_ar'])) echo xss_clean($_POST['body_ar']); ?></textarea>
                                    </div>
                                </div>

                               

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


<script type="text/javascript" src="assets/admin/ltr/js/lib/jquery-1.11.min.js"></script>


<script>
    $(document).ready(function () {

        $("#country_id").change(function () {
            var country_id = $("#country_id").val();
            $.ajax({
                type: "post",
                url: "<?= base_url("admin/maka_madina_shrines/gatCountryCities") ?>",
                data: {country_id: country_id},
                success: function (data) {
                    $("#places_id").html(data);
                }
            });
        });

    });
</script>


