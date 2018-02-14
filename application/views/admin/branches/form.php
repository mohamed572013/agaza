<?php
    if (isset($edit->parent_id)) {
        $parent_id = $edit->parent_id;
    } else {
        $parent_id = 0;
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
                        <li class="active"><a href="<?= \base_url('admin/branches/show') ?>"><?= $lang['branches']; ?></a></li>
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
                            <h3 class="panel-title"><?= $lang['add'] . " " . $lang['branches']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!empty($error)) { ?>
                                    <div class="alert alert-danger">
                                        <?= $error; ?>
                                    </div>
                                <?php } ?>
                            <!--Table Wrapper Start-->
                            <form  enctype="multipart/form-data"  action="<?= \base_url('admin/branches') . $action; ?>" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">


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
                                <!--								<div class="form-group">
                                                                                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['choose_branches']; ?></label>
                                                                                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                                                                <select class="form-control" name="parent_id" id="parent_id">
                                                                                                                        <option value="0"><?= $lang['choose_branches']; ?></option>
                                <?php
                                    foreach ($branches as $value) {
                                        $select = "";
                                        if ($parent_id == $value->id) {
                                            $select = "selected";
                                        }
                                        if ($value->id != $edit->id) {
                                            echo "<option value='" . $value->id . "' $select >$value->title_en   -   $value->title_ar</option>";
                                        }
                                    }
                                ?>
                                                                                                                </select>
                                                                                                        </div>
                                                                                                </div>-->





                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['code']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" maxlength="10" id="code" name="code" value="<?php if (isset($edit->code)) echo $edit->code;else if (isset($_POST['code'])) echo xss_clean($_POST['code']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['title_ar']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="<?php if (isset($edit->title_ar)) echo $edit->title_ar;else if (isset($_POST['title_ar'])) echo xss_clean($_POST['title_ar']); ?>">
                                    </div>
                                </div>

                                <!--                                <div class="form-group">
                                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">money limit</label>
                                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                        <input type="number" step="1" min="0" class="form-control" id="money_limit" name="money_limit" value="<?php if (isset($edit->money_limit)) echo $edit->money_limit;else if (isset($_POST['money_limit'])) echo xss_clean($_POST['money_limit']); ?>">
                                                                    </div>
                                                                </div>-->
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['email']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($edit->email)) echo $edit->email;else if (isset($_POST['email'])) echo xss_clean($_POST['email']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['phone']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php if (isset($edit->phone)) echo $edit->phone;else if (isset($_POST['phone'])) echo xss_clean($_POST['phone']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['address']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="address" name="address" value="<?php if (isset($edit->address)) echo $edit->address;else if (isset($_POST['address'])) echo xss_clean($_POST['address']); ?>">
                                    </div>
                                </div>
                                <?php if ($user_type == 'owner') { ?>
                                        <div class="form-group">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">رابط الموقع</label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <input type="text" class="form-control" id="site_url" name="site_url" value="<?php if (isset($edit->site_url)) echo $edit->site_url;else if (isset($_POST['site_url'])) echo xss_clean($_POST['site_url']); ?>">
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php if ($user_type == 'super admin') { ?>
                                        <div class="form-group pay-way-box">
                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">طريقة الدفع</label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                <select class="form-control" name="pay_way" id="pay_way">
                                                    <option value=""> اختر </option>
                                                    <?php foreach ($pay_ways as $pay_way) { ?>
                                                        <?php
                                                        if ($pay_way->id == $edit->pay_ways_id) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                        ?>
                                                        <option <?= $selected ?>  value="<?= $pay_way->id ?>"> <?= $pay_way->pay_way_name; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                        if (isset($edit->pay_ways_id) && $edit->pay_ways_id == 2) {
                                            $display = 'block';
                                        } else {
                                            $display = 'none';
                                        }
                                        ?>
                                        <div id="credit-box" style="display: <?= $display ?>;">
                                            <div class="form-group">
                                                <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">مبلغ الكريديت</label>
                                                <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                    <input type="text" class="form-control" id="credit_amount" name="credit_amount" value="<?= (isset($edit->credit_amount)) ? $edit->credit_amount : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">مبلغ الغرامة فى حالة الإلغاء</label>
                                                <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                    <input type="text" class="form-control" id="credit_mulct" name="credit_mulct" value="<?= (isset($edit->credit_mulct)) ? $edit->credit_mulct : ''; ?>">
                                                </div>
                                            </div>

                                        </div>
                                    <?php } ?>

                                <?php if (isset($edit->image) && $edit->image != "") {
                                        ?>
                                        <div class="form-group">

                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?></label>
                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                                <img src="<?php echo base_url('uploads/branches/' . $edit->image); ?>" width="200" height="100" />
                                            </div>
                                        </div>

                                    <?php }
                                ?>
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?></label>
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
                </div>
            </div>
            <!-- Main Content Element  End-->

        </div>
    </div>



</section>

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
            $("#pay_way").change(function () {
                var pay_way_id = $(this).val();
                if (pay_way_id == 2) {
                    $('#credit-box').slideDown(500);
                } else {
                    $('#credit-box').slideUp(500);
                }

            })
        });

</script>
