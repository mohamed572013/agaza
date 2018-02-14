<?php
    if (isset($edit->branches_id)) {
        $branches_id = $edit->branches_id;
    } else {
        $branches_id = \xss_clean($this->uri->segment(4));
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
                        <li class="active"><a href="<?= \base_url('admin/departments/show') ?>"><?= $lang['departments']; ?></a></li>
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
                            <h3 class="panel-title"><?= $lang['add'] . " " . $lang['departments']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!empty($error)) { ?>
                                    <div class="alert alert-danger">
                                        <?= $error; ?>
                                    </div>
                                <?php } ?>
                            <!--Table Wrapper Start-->
                            <form action="<?= \base_url('admin/departments') . $action; ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">


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


                                <?php
                                    $me_checled = 'checked';
                                    $other_checled = '';
                                    $display_value = 'none';
                                    if (isset($edit->branches_id)) {
                                        if ($current_user_company->id == $edit->branches_id) {
                                            $me_checled = 'checked';
                                        } else {
                                            $other_checled = 'checked';
                                            $display_value = 'block';
                                        }
                                    }
                                ?>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('add to') ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <label class="radio-inline">
                                            <input type="radio" name="add_to" id="add_to_my_company" value="me" class="addToTypeRadio" <?= $me_checled ?>> <?= _lang('my company') ?>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="add_to" id="add_to_other_company" value="other" class="addToTypeRadio" <?= $other_checled ?>> <?= _lang('other company') ?>
                                        </label>
                                    </div>

                                </div>



                                <div class="form-group branches-box" style="display:<?= $display_value ?>;">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['choose_branches']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <select class="form-control" name="branches_id" id="branches_id">
                                            <option value=""><?= $lang['choose_branches']; ?></option>
                                            <?php
                                                foreach ($branches as $value) {
                                                    $select = "";
                                                    if ($branches_id == $value->id) {
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
    global $_require;
    $_require['admin.js'] = array('departments.js');
?>