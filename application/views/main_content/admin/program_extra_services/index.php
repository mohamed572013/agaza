<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditProgramExtraServices" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditProgramExtraServicesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditProgramExtraServicesForm" name="user-form" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="0">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">العنوان بالعربية</label>
                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                            <input type="text" class="form-control" id="title_ar" name="title_ar" value="<?= (!empty($about_us->title_ar)) ? $about_us->title_ar : ''; ?>">
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">العنوان بالإنجليزية</label>
                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                            <input type="text" class="form-control" id="title_en" name="title_en" value="">
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">نوع الخدمة</label>
                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                            <select class="form-control" name="person_or_card" id="person_or_card">
                                <option disabled="disabled"
                                        selected>اختر</option>
                                <option value="1">استمارة</option>
                                <option value="0">شخص</option>
                            </select>
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">الحالة</label>
                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                            <select class="form-control" name="active" id="active">
                                <option value="1" selected>نشط</option>
                                <option value="0">غير نشط</option>
                            </select>
                            <div class="help-block"></div>
                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        data-dismiss="modal">حفظ</button>
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
                        <li class="active"><a href=""><?= _lang('program_extra_services'); ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>


            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= _lang('program_extra_services'); ?></h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <a class="btn btn-sm btn-info pull-left" style="margin-bottom: 40px;" href="" onclick="Program_extra_services.add(); return false;"><?= $lang['add_new']; ?> </a>
                            <div class="ls-editable-table table-responsive ls-table">

                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('title_ar') ?></th>
                                            <th><?= _lang('title_en') ?></th>
                                            <th>الحالة</th>
                                            <th>نوع الخدمة</th>
                                            <th>خيارات</th>
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
        var new_lang = {
            'edit_user': 'تعديل مستخدم',
            messages: {
                title_ar: {
                    required: "ادخل العنوان بالعربية"
                },
                title_en: {
                    required: "ادخل العنوان بالإنجليزية"
                },
                person_or_card: {
                    required: "اختر نوع الخدمة"
                }
            }
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('program_extra_services.js');
?>
