<style>
    .help-block{
        margin-bottom: 0;
    }
</style>
<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditCompanies" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditCompaniesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditCompaniesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="0">


                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('الحالة'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="active" id="active">
                                    <option value="1">مفعل</option>
                                    <option value="0">غير مفعل</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الكود</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="code" name="code" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الاسم بالعربية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="title_ar" name="title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الاسم بالإنجليزية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="title_en" name="title_en" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">التليفون</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="phone" name="phone" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="address" name="address" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('email') ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="email" name="email" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <?php if ($user_type == 'owner') { ?>
                                <div class="form-group row col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('site_url') ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <input type="text" class="form-control" id="site_url" name="site_url" value="">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            <?php } ?>
                    </div>
                    <div class="row">
                        <?php if ($user_type == 'super admin') { ?>
                                <div class="form-group col-md-12">
                                    <label class="col-xs-12 col-sm-4  control-label text-capitalize">طريقة الدفع</label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">

                                        <?php foreach ($pay_ways as $type) { ?>
                                            <label class="checkbox-inline"><input  type="radio" name="pay_ways_id" id="<?= 'pay_ways_' . $type->id ?>" value="<?= $type->id ?>"><?= $type->title_ar ?></label>
                                        <?php } ?>

                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <label class="col-xs-12 col-sm-4  control-label text-capitalize">القيمة</label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="pay_way_value" name="pay_way_value" value="<?= (isset($edit->pay_way_value)) ? $edit->pay_way_value : ''; ?>">
                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <label class="col-xs-12 col-sm-4  control-label text-capitalize"> الربحية</label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <?php foreach ($discount_types as $type) { ?>

                                            <label class="checkbox-inline"><input type="radio" name="discount_types_id" id="<?= 'discount_types_' . $type->id ?>" value="<?= $type->id ?>"><?= $type->title_ar ?></label>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-xs-12 col-sm-4  control-label text-capitalize">القيمة </label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="discount_value" name="discount_value" value="<?= (isset($edit->discount_value)) ? $edit->discount_value : ''; ?>">
                                    </div>
                                </div>

                            <?php } ?>
                    </div>



                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        >حفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addEditBranches" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditBranchesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditBranchesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="departments_id" id="departments_id" value="0">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('الحالة'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="d_active" id="d_active">
                                    <option value="1">مفعل</option>
                                    <option value="0">غير مفعل</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الاسم بالعربية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="d_title_ar" name="d_title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الاسم بالإنجليزية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="d_title_en" name="d_title_en" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        >حفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addEditEmployees" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditEmployeesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditEmployeesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="employees_id" id="employees_id" value="0">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('الحالة'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="e_active" id="e_active">
                                    <option value="1">مفعل</option>
                                    <option value="0">غير مفعل</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الاسم بالعربية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="e_title_ar" name="e_title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الاسم بالإنجليزية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="e_title_en" name="e_title_en" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">النوع</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="gender" id="gender">
                                    <option value="1">ذكر</option>
                                    <option value="0"> أنثى</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الوظيفة</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="job_title" name="job_title" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">البريد الإلكترونى</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="e_email" name="e_email" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">كلمة السر</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="password" class="form-control" id="password" name="password" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="e_address" name="e_address" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">تاريخ بدء العمل</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="date" class="form-control" id="start_working_date" name="start_working_date" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>



                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">رقم طوارئ أول</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="emergency_phone_1" name="emergency_phone_1" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الأسم</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="emergency_name_1" name="emergency_name_1" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">رقم طوارئ ثانى</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="emergency_phone_2" name="emergency_phone_2" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الأسم</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="emergency_name_2" name="emergency_name_2" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        >حفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>

<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <!--Top breadcrumb start -->
                    <ol class="breadcrumb">
                        <li> <i class="fa fa-home"></i> </li>
                        <li> <?php echo $lang['basic_data']; ?></li>
                        <li class="active">الشركات</li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

<!--            <a class="btn btn-sm btn-info pull-right" href="" onclick="Haj_umrah_programs.add(); return false;"><?= $lang['add_new']; ?> </a>-->
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                        </div>
                        <div class="panel-body">
                            <div id="data-boxes" style="padding-top: 30px;margin-bottom: 30px;">
                                <div class="row">
                                    <!--                                    <div class="col-sm-2">

                                                                        </div>-->
                                    <div class="col-sm-4">
                                        <div class="ls-wizard  label-light-green">
                                            <h2> الشركات</h2>
                                            <a href="" class="data-box" data-type="companies" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="ls-wizard  label-lightBlue">
                                            <h2> الفروع</h2>
                                            <a href="" class="data-box" data-type="branches" data-id="<?= $current_user_company->id ?>" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="ls-wizard  label-red">
                                            <h2> الموظفين</h2>
                                            <a href="" class="data-box" data-type="employees" data-branches-id="<?= $current_user_company->id ?>" data-departments-id="<?= $current_user_branch->id ?>" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                                    <div class="col-sm-2">

                                                                        </div>-->

                                </div>
                            </div>
                            <style>
                                .table-box.active{display:block!important;}
                                .table-box.disabled{display:none!important;}
                            </style>
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="companies_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Companies.add(); return false;">اضافة جديد</a>
                                <table class="table dataTable table-bordered table-striped table-bottomless" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>الكود</th>
                                            <th>العنوان بالعربية</th>
                                            <th>العنوان بالإنجليزية</th>
                                            <th>الفروع</th>
                                            <th>الحالة</th>
                                            <th><?= _lang('options'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="branches_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Companies.add_branches(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>العنوان بالعربية</th>
                                            <th>العنوان بالإنجليزية</th>
                                            <th>الموظفين</th>
                                            <th>الحالة</th>
                                            <th><?= _lang('options'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="employees_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Companies.add_employees(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>العنوان بالعربية</th>
                                            <th>العنوان بالإنجليزية</th>
                                            <th>البريد الإلكترونى</th>
                                            <th>الحالة</th>
                                            <th><?= _lang('options'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!--Table Wrapper Finish-->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



</section>
<script>
        var new_config = {
            user_type: '<?= $user_type ?>'
        }
        var new_lang = {
            'edit_user': 'تعديل مستخدم',
            messages: {
                code: {
                    required: 'هذا الحقل مطلوب'

                },
                title_ar: {
                    required: 'هذا الحقل مطلوب'

                },
                title_en: {
                    required: 'هذا الحقل مطلوب'

                },
                email: {
                    required: 'هذا الحقل مطلوب',
                    email: 'البريد الإلكترونى غير صحيح'

                },
                phone: {
                    required: 'هذا الحقل مطلوب',
                    number: 'ادخل ارقام فقط'

                },
                address: {
                    required: 'هذا الحقل مطلوب'

                },
            },
            employees_messages: {
                e_title_ar: {
                    required: 'هذا الحقل مطلوب',
                },
                e_title_en: {
                    required: 'هذا الحقل مطلوب',
                },
                gender: {
                    required: 'هذا الحقل مطلوب',
                },
                job_title: {
                    required: 'هذا الحقل مطلوب',
                },
                e_email: {
                    required: 'هذا الحقل مطلوب',
                    email: 'البريد الإلكترونى غير صحيح',
                },
                password: {
                    required: 'هذا الحقل مطلوب',
                },
                start_working_date: {
                    required: 'هذا الحقل مطلوب',
                },
                e_address: {
                    required: 'هذا الحقل مطلوب',
                },
                emergency_phone_1: {
                    required: 'هذا الحقل مطلوب',
                    number: 'ارقام فقط',
                },
                emergency_name_1: {
                    required: 'هذا الحقل مطلوب',
                },
                emergency_phone_2: {
                    required: 'هذا الحقل مطلوب',
                    number: 'ارقام فقط',
                },
                emergency_name_2: {
                    required: 'هذا الحقل مطلوب',
                },
            }
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('companies.js');
?>
