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
                        <li class="active"><a href="<?= \base_url('admin/hotel_rooms/show') ?>"><?= $lang['hotel_rooms']; ?></a></li>
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
                            <h3 class="panel-title"><?= $lang['add'] . " " . $lang['hotel_rooms']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!empty($error)) { ?>
                                    <div class="alert alert-danger">
                                        <?= $error; ?>
                                    </div>
                                <?php } ?>
                            <!--Table Wrapper Start-->
                            <form action="<?= \base_url('admin/hotel_rooms') . $action; ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">


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
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['title_ar']; ?></label>
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
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['title_en']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" required="required" id="title_en" name="title_en" value="<?php
                                            if (isset($_POST['title_en']))
                                                echo xss_clean($_POST['title_en']);
                                            else if (isset($edit->title_en))
                                                echo $edit->title_en;
                                        ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['no_of_bed']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="number" min="1" class="form-control" required="required" id="no_of_bed" name="no_of_bed" value="<?php
                                            if (isset($_POST['no_of_bed']))
                                                echo xss_clean($_POST['no_of_bed']);
                                            else if (isset($edit->no_of_bed))
                                                echo $edit->no_of_bed;
                                        ?>">
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
