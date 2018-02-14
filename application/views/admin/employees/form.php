<?php
    if (isset($edit->departments_id)) {
        $departments_id = $edit->departments_id;
    } else {
        $departments_id = \xss_clean($this->uri->segment(4));
    }
    if ($departments_id > 0) {
        $cond_emp['id'] = $departments_id;
        $branches_of_dept = $this->employees->GetWhere("departments", "id", "ASC", $cond_emp);
        $branch_selected = $branches_of_dept[0]->branches_id;
    } else {
        $branch_selected = '';
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
                        <li class="active"><a href="<?= \base_url('admin/employees/show') ?>"><?= $lang['employees']; ?></a></li>
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
                            <h3 class="panel-title"><?= $lang['add'] . " " . $lang['employees']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!empty($error)) { ?>
                                    <div class="alert alert-danger">
                                        <?= $error; ?>
                                    </div>
                                <?php } ?>
                            <!--Table Wrapper Start-->
                            <form enctype="multipart/form-data" action="<?= \base_url('admin/employees') . $action; ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">

                                <input type="hidden" name="current_user_company_id" id="current_user_company_id" value="<?= $current_user_company->id ?>"/>
                                <?php
                                    $active[0] = "  غير مفعل";
                                    $active[1] = "مفعل";
                                    if (!isset($edit->active)) {
                                        $active_val = 1;
                                    } else {
                                        $active_val = $edit->active;
                                    }
                                    $gender[0] = $lang['Male'];
                                    $gender[1] = $lang['Female'];
                                    if (!isset($edit->gender)) {
                                        $gender_val = 1;
                                    } else {
                                        $gender_val = $edit->gender;
                                    }
                                ?>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['state']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <?php echo form_dropdown('active', $active, $active_val, 'class="form-control"') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['gender']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <?php echo form_dropdown('gender', $gender, $gender_val, 'class="form-control"') ?>
                                    </div>
                                </div>
                                <?php if ($user_type != 'admin') { ?>
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
                                                <select class="form-control"   name="branches_id" id="branches_id">
                                                    <option value=""><?= $lang['choose_branches']; ?></option>
                                                    <?php
                                                    foreach ($branches as $value) {
                                                        $select = "";

                                                        if ($branch_selected == $value->id) {
                                                            $select = "selected";
                                                        }
                                                        echo "<option value='" . $value->id . "' $select >$value->title_en   -   $value->title_ar</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['choose_departments']; ?>   <span style="color:red">*</span></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <select class="form-control" required="required" name="departments_id" id="departments_id">
                                                    <option value=""><?= $lang['choose_departments']; ?></option>
                                                    <?php
                                                    foreach ($departments as $value) {
                                                        $select = "";
                                                        if ($departments_id == $value->id) {
                                                            $select = "selected";
                                                        }
                                                        echo "<option value='" . $value->id . "' $select >$value->title_en   -   $value->title_ar</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>


                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['code']; ?> <span style="color:red">*</span></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="title_ar" name="code" value="<?php if (isset($edit->code)) echo $edit->code;else if (isset($_POST['code'])) echo xss_clean($_POST['code']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['title_ar']; ?> <span style="color:red">*</span></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="<?php if (isset($edit->title_ar)) echo $edit->title_ar;else if (isset($_POST['title_ar'])) echo xss_clean($_POST['title_ar']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['title_en']; ?> <span style="color:red">*</span></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="title_en" name="title_en" value="<?php if (isset($edit->title_en)) echo $edit->title_en;else if (isset($_POST['title_en'])) echo xss_clean($_POST['title_en']); ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['job_title']; ?> <span style="color:red">*</span></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="job_title" name="job_title" value="<?php if (isset($edit->job_title)) echo $edit->job_title;else if (isset($_POST['job_title'])) echo xss_clean($_POST['job_title']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['password']; ?> <span style="color:red">*</span></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="password" class="form-control" id="password" name="password" value="<?php if (isset($edit->password)) echo $edit->password;else if (isset($_POST['password'])) echo xss_clean($_POST['password']); ?>">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['email']; ?> <span style="color:red">*</span></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($edit->email)) echo $edit->email;else if (isset($_POST['email'])) echo xss_clean($_POST['email']); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['phone']; ?> <span style="color:red">*</span></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php if (isset($edit->phone)) echo $edit->phone;else if (isset($_POST['phone'])) echo xss_clean($_POST['phone']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['address']; ?> <span style="color:red">*</span></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="address" name="address" value="<?php if (isset($edit->address)) echo $edit->address;else if (isset($_POST['address'])) echo xss_clean($_POST['address']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['start_working_date']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="date" class="form-control" id="start_working_date" name="start_working_date" value="<?php if (isset($edit->start_working_date)) echo $edit->start_working_date;else if (isset($_POST['start_working_date'])) echo xss_clean($_POST['start_working_date']); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['emergency_phone_1']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="emergency_phone_1" name="emergency_phone_1" value="<?php
                                            if (isset($edit->emergency_phone_1))
                                                echo $edit->emergency_phone_1;else if (isset($_POST['emergency_phone_1']))
                                                echo xss_clean($_POST['emergency_phone_1']);
                                        ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['emergency_name_1']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="emergency_name_1" name="emergency_name_1" value="<?php
                                            if (isset($edit->emergency_name_1))
                                                echo $edit->emergency_name_1;else if (isset($_POST['emergency_name_1']))
                                                echo xss_clean($_POST['emergency_name_1']);
                                        ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['emergency_relationship_1']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="emergency_relationship_1" name="emergency_relationship_1" value="<?php
                                            if (isset($edit->emergency_relationship_1))
                                                echo $edit->emergency_relationship_1;else if (isset($_POST['emergency_relationship_1']))
                                                echo xss_clean($_POST['emergency_relationship_1']);
                                        ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['emergency_phone_2']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="emergency_phone_2" name="emergency_phone_2" value="<?php
                                            if (isset($edit->emergency_phone_2))
                                                echo $edit->emergency_phone_2;else if (isset($_POST['emergency_phone_2']))
                                                echo xss_clean($_POST['emergency_phone_2']);
                                        ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['emergency_name_2']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="emergency_name_2" name="emergency_name_2" value="<?php
                                            if (isset($edit->emergency_name_2))
                                                echo $edit->emergency_name_2;else if (isset($_POST['emergency_name_2']))
                                                echo xss_clean($_POST['emergency_name_2']);
                                        ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['emergency_relationship_2']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="emergency_relationship_2" name="emergency_relationship_2" value="<?php
                                            if (isset($edit->emergency_relationship_2))
                                                echo $edit->emergency_relationship_2;else if (isset($_POST['emergency_relationship_2']))
                                                echo xss_clean($_POST['emergency_relationship_2']);
                                        ?>">
                                    </div>
                                </div>

                                <?php if (isset($edit->image) && $edit->image != "") {
                                        ?>
                                        <div class="form-group">

                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['Personal_image']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                                <img src="<?php echo base_url('uploads/employees/' . $edit->image); ?>" width="200" height="100" />
                                            </div>
                                        </div>

                                    <?php }
                                ?>
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['Personal_image']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="file" class="form-control" id="image" name="image"  >
                                    </div>
                                </div>

                                <?php if (isset($edit->national_num_img) && $edit->national_num_img != "") {
                                        ?>
                                        <div class="form-group">

                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['national_num_img']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                                <img src="<?php echo base_url('uploads/employees/' . $edit->national_num_img); ?>" width="200" height="100" />
                                            </div>
                                        </div>

                                    <?php }
                                ?>
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['national_num_img']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="file" class="form-control" id="national_num_img" name="national_num_img"  >
                                    </div>
                                </div>


                                <?php if (isset($edit->gradution_img) && $edit->gradution_img != "") {
                                        ?>
                                        <div class="form-group">

                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['gradution_img']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                                <img src="<?php echo base_url('uploads/employees/' . $edit->gradution_img); ?>" width="200" height="100" />
                                            </div>
                                        </div>

                                    <?php }
                                ?>
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['gradution_img']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="file" class="form-control" id="gradution_img" name="gradution_img"  >
                                    </div>
                                </div>



                                <?php if (isset($edit->birthdate_img) && $edit->birthdate_img != "") {
                                        ?>
                                        <div class="form-group">

                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['birthdate_img']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                                <img src="<?php echo base_url('uploads/employees/' . $edit->birthdate_img); ?>" width="200" height="100" />
                                            </div>
                                        </div>

                                    <?php }
                                ?>
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['birthdate_img']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="file" class="form-control" id="birthdate_img" name="birthdate_img"  >
                                    </div>
                                </div>


                                <?php if (isset($edit->army_img) && $edit->army_img != "") {
                                        ?>
                                        <div class="form-group">

                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['army_img']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                                <img src="<?php echo base_url('uploads/employees/' . $edit->army_img); ?>" width="200" height="100" />
                                            </div>
                                        </div>

                                    <?php }
                                ?>
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['army_img']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="file" class="form-control" id="army_img" name="army_img"  >
                                    </div>
                                </div>



                                <?php if (isset($edit->criminal_case_img) && $edit->criminal_case_img != "") {
                                        ?>
                                        <div class="form-group">

                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['criminal_case_img']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                                <img src="<?php echo base_url('uploads/employees/' . $edit->criminal_case_img); ?>" width="200" height="100" />
                                            </div>
                                        </div>

                                    <?php }
                                ?>
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['criminal_case_img']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="file" class="form-control" id="criminal_case_img" name="criminal_case_img"  >
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

<script type="text/javascript" src="assets/admin/ltr/js/lib/jquery-1.11.min.js"></script>



<script>
        $(document).ready(function () {

            //			$.confirm({
            //				title: '<span style="color:#333">هل انت متاكد من انك تريد مسح هذا العنصر</span>',
            //				content: '<span style="color:#333">لديك 6 ثوانى للاختيار</span>',
            //				autoClose: 'cancel|6000',
            //				rtl: true,
            //				confirmButton: 'نعم متاكد',
            //				confirmButtonClass: 'btn-danger',
            //				cancelButton: 'الغاء',
            //				confirm: function () {
            //					alert(4)
            //				}
            //
            //			});
            //			$.amaran({
            //				content: {
            //					message: '<b> efefefef   </b>',
            //					size: '    ',
            //					file: ' ',
            //					icon: 'fa fa-times'
            //				},
            //				theme: 'default error ',
            //				position: 'top right',
            //				inEffect: 'slideLeft',
            //				outEffect: 'slideRight',
            //				closeButton: true,
            //				delay: 7000
            //			});
            $("#branches_id").change(function () {
                var branches_id = $("#branches_id").val();
                $.ajax({
                    type: "post",
                    url: "<?= base_url("Ajax/gatBranchesDepartments") ?>",
                    data: {branches_id: branches_id},
                    success: function (data) {
                        $("#departments_id").html(data);
                    }
                });
            });

        });
</script>

<?php
    global $_require;
    $_require['admin.js'] = array('departments.js');
?>