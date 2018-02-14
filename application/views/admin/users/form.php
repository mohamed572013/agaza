<!--Page main user start-->
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!--Top header start-->
                    <h3 class="ls-top-header"><a href="<?= \base_url('admin/users/show') ?>"><?= $lang['users']; ?></a></h3>
                    <!--Top header end -->

                    <!--Top breadcrumb start -->
                    <ol class="breadcrumb">
                        <li> <i class="fa fa-home"></i> </li>
                        <li> <?php echo $lang['basic_data']; ?></li>
                        <li class="active"><a href="<?= \base_url('admin/users/show') ?>"><?= $lang['users']; ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <?php
                $action = '/add';
                if ($view_type != 'add') {
                    if (isset($_id)) {
                        $action = '/edit/' . $_id;
                    }
                }
            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['add_new_users']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!empty($error)) { ?>
                                    <div class="alert alert-danger">
                                        <?= $error; ?>
                                    </div>
                                <?php } ?>
                            <!--Table Wrapper Start-->
                            <form action="<?= \base_url('admin/users') . $action; ?>" method="post" class="form-horizontal ls_form">

                                <input type="hidden" name="user_type" id="user_type" value="<?= $user_type ?>"/>
                                <input type="hidden" name="current_user_company_id" id="current_user_company_id" value="<?= $current_user_company->id ?>"/>
                                <?php
                                    $active[0] = "  غير مفعل";
                                    $active[1] = "مفعل";
                                    if (!isset($edit->show_all_branches_report)) {
                                        $show_all_branches_report_val = 0;
                                    } else {
                                        $show_all_branches_report_val = $edit->show_all_branches_report;
                                    }
                                    $admin_or_reservarion[0] = "Adminstration";
                                    $admin_or_reservarion[1] = "Reservation";
                                    if (!isset($edit->admin_or_reservarion)) {
                                        $admin_or_reservarion_val = 0;
                                    } else {
                                        $admin_or_reservarion_val = $edit->admin_or_reservarion;
                                    }
                                ?>


                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['user_name']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="user_name" name="user_name" value="<?php if (isset($edit->user_name)) echo $edit->user_name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['user_group_id']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <select id="user_group_id" name="user_group_id" class="form-control">
                                            <option selected disabled>اختر</option>
                                            <?php foreach ($group_list as $key => $value) { ?>
                                                    <option <?php if (isset($edit->user_group_id) && $edit->user_group_id == $value->group_id) echo 'selected=""'; ?> value="<?= $value->group_id ?>"><?= $value->group_name ?></option>
                                                <?php } ?>
                                        </select>
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
                                            <input type="radio" name="add_to" id="add_to_my_company" value="me" class="addToTypeRadio" <?php echo $me_checled ?>> <?= _lang('my company') ?>
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="add_to" id="add_to_other_company" value="other" class="addToTypeRadio" <?php echo $other_checled ?>> <?= _lang('other company') ?>
                                        </label>
                                    </div>

                                </div>

                                <div class="form-group branches-box" style="display:<?= $display_value ?>;">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['choose_branches']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <select class="form-control"  name="branches_id" id="branches_id">
                                            <option value=""><?= $lang['choose_branches']; ?></option>
                                            <?php
                                                foreach ($branches as $value) {
                                                    $select = "";
                                                    if (isset($edit)) {
                                                        if ($value->id == $edit->branches_id) {
                                                            $select = "selected";
                                                        }
                                                    }
                                                    echo "<option value='" . $value->id . "' $select >$value->title_en   -   $value->title_ar</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                    $departments_box_display = 'block';
                                ?>

                                <div class="form-group departments-box" style="display:<?= $departments_box_display ?>;">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['choose_departments']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <select class="form-control"   name="departments_id" id="departments_id">
                                            <option value=""><?= $lang['choose_departments']; ?></option>
                                            <?php
                                                if (!empty($departments)) {
                                                    foreach ($departments as $value) {
                                                        $select = "";
                                                        if (isset($edit)) {
                                                            if ($edit->departments_id == $value->id) {
                                                                $select = "selected";
                                                            }
                                                        }

                                                        echo "<option value='" . $value->id . "' $select >$value->title_en   -   $value->title_ar</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['user_email']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="user_email" name="user_email" value="<?php if (isset($edit->user_email)) echo $edit->user_email; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['user_password']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="password" class="form-control" id="user_password" name="user_password" value="">
                                        <br/><a style=" cursor: pointer; "  id="creat_password" ><?= $this->lang->line("creat_password") ?></a>
                                        <input id="show_password" type="checkbox" /> <?= $this->lang->line("show_password") ?>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['confirm_password']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['user_full_address']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="user_full_address" name="user_full_address" value="<?php if (isset($edit->user_full_address)) echo $edit->user_full_address; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['user_phone']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?php if (isset($edit->user_phone)) echo $edit->user_phone; ?>">
                                    </div>
                                </div>


                                <div class="form-group text-center">
                                    <button class="btn btn-sm btn-success" type="submit"><?= $lang['save_data']; ?></button>
                                </div>
                            </form>
                            <!--Table Wrapper Finish-->
                        </div>
                    </div>
                </div>
                <!-- Main Content Element  End-->

            </div>
        </div>



</section>

<script type="text/javascript" src="assets/admin/ltr/js/lib/jquery-1.11.min.js"></script>



<script>
        $(document).ready(function () {


            $("#branches_id").change(function () {
                //alert('here');
                var branches_id = $("#branches_id").val();
                if (branches_id == '') {
                    branches_id = $("#current_user_company_id").val();
                }
                $.ajax({
                    type: "post",
                    url: config.base_url + "ajax/gatBranchesDepartments",
                    data: {branches_id: branches_id},
                    success: function (data) {
                        $("#departments_id").html(data);

                    }
                });

            });
            $("#departments_id").change(function () {
                var departments_id = $("#departments_id").val();
                $.ajax({
                    type: "post",
                    url: config.base_url + "Ajax/gatDepartmentsEmployees",
                    data: {departments_id: departments_id},
                    success: function (data) {
                        $("#employees_id").html(data);
                    }
                });
            });
            $('#show_password').change(function () {
                if ($('#show_password').is(":checked")) {
                    $("#user_password").attr("type", "text");

                } else {
                    $("#user_password").attr("type", "password");

                }
            });
            $('#creat_password').click(function () {
                $('[id^="user_password"]').val(randomPassword(8));
            })
        });</script>
<script>
        function randomPassword(string_length)
        {
            var chars = "0123456789!@#$%^&*abcdefghijklmnopqrstuvwxtzABCDEFGHIJKLMNOPQRSTUVWXTZ!@#$%^&*";
            var myrnd = [], pos;

            // loop as long as string_length is > 0
            while (string_length--) {
                // get a random number between 0 and chars.length - see e.g. http://www.shawnolson.net/a/789/make-javascript-mathrandom-useful.html
                pos = Math.floor(Math.random() * chars.length);
                // add the character from the base string to the array
                // myrnd.push(chars.substr(pos, 1));
                myrnd += chars.substr(pos, 1);
            }

            // join the array using '' as the separator, which gives us back a string
            // myrnd.join('');
            return myrnd;
        }

</script>
<?php
    global $_require;
    $_require['admin.js'] = array('users.js');
?>
