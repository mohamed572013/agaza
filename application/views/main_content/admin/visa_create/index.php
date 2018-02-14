<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditVisaCreate" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditVisaCreateLabel"></h4>
            </div>

            <div class="modal-body">
                <style>
                    input[type="checkbox"] {
                        margin: 4px 10px 0;
                    }
                </style>

                <form role="form" class="form-horizontal" id="addEditVisaCreateForm" enctype="multipart/form-data">
                    <input type="hidden" name="code" id="code" value="0">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3  control-label text-capitalize">حالة التأشيرة</label>
                        <div class="col-xs-12 col-sm-6">
                            <select class="form-control" name="active" id="active">
                                <option value="1" selected>مفعل</option>
                                <option value="0" >غير مفعل</option>
                            </select>
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3  control-label text-capitalize">حالة الباسبور</label>
                        <div class="col-xs-12 col-sm-6">
                            <select class="form-control" name="passport_status" id="passport_status">
                                <option value="0" selected>غير مطلوب</option>
                                <option value="1">مطلوب</option>
                            </select>
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label text-capitalize">الدولة</label>
                        <div class="col-xs-12 col-sm-6">
                            <select class="form-control" name="places_id" id="places_id">
                                <option  disabled selected>اختر</option>
                                <?php foreach ($places as $value) { ?>
                                        <option  value="<?= $value->id ?>"><?= $value->title_ar ?></option>
                                    <?php } ?>

                            </select>
                            <div class="help-block"></div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3  control-label text-capitalize">نوع التأشيرة</label>
                        <div class="col-xs-12 col-sm-9 col-md-8" id="visa_types">
                            <?php $count = 1; ?>
                            <?php if ($visa_types) { ?>
                                    <?php foreach ($visa_types as $value) { ?>
                                        <label class="col-md-4"><input name="visa_types[]" id="<?= 'visa_types_' . $count ?>" type="checkbox" value="<?= $value->id ?>"><?= $value->title_ar ?></label>
                                        <?php $count++; ?>
                                    <?php } ?>
                                <?php } ?>
                            <div class="help-block col-md-12" style="color:#bf3333;text-align: left"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3  control-label text-capitalize">فترة التأشيرة</label>
                        <div class="col-xs-12 col-sm-9 col-md-8" id="visa_periods">
                            <?php $count = 1; ?>
                            <?php if ($visa_periods) { ?>
                                    <?php foreach ($visa_periods as $value) { ?>
                                        <label class="col-md-4"><input name="visa_periods[]" id="<?= 'visa_periods_' . $count ?>" type="checkbox" value="<?= $value->id ?>"><?= $value->period ?></label>
                                        <?php $count++; ?>
                                    <?php } ?>
                                <?php } ?>
                            <div class="help-block col-md-12" style="color:#bf3333;text-align: left"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3  control-label text-capitalize">الوظائف</label>
                        <div class="col-xs-12 col-sm-9 col-md-8" id="visa_jobs">
                            <?php $count = 1; ?>
                            <?php if ($visa_jobs) { ?>
                                    <?php foreach ($visa_jobs as $value) { ?>
                                        <label class="col-md-4"><input name="visa_jobs[]" id="<?= 'visa_jobs_' . $count ?>" type="checkbox" value="<?= $value->id ?>"><?= $value->title_ar ?></label>
                                        <?php $count++; ?>
                                    <?php } ?>
                                <?php } ?>
                            <div class="help-block col-md-12" style="color:#bf3333;text-align: left"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3  control-label text-capitalize">المستندات</label>
                        <div class="col-xs-12 col-sm-9 col-md-8" id="visa_documents">
                            <?php $count = 1; ?>
                            <?php if ($visa_documents) { ?>
                                    <?php foreach ($visa_documents as $value) { ?>
                                        <label class="col-md-4"><input name="visa_documents[]" id="<?= 'visa_documents_' . $count ?>" type="checkbox" value="<?= $value->id ?>"><?= $value->title_ar ?></label>
                                        <?php $count++; ?>
                                    <?php } ?>
                                <?php } ?>
                            <div class="help-block col-md-12" style="color:#bf3333;text-align: left"></div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3  control-label text-capitalize">السعر</label>
                        <div class="col-xs-12 col-sm-3">
                            <input type="text" class="form-control" id="price" name="price">
                            <div class="help-block"></div>
                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        >خفظ</button>
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
                        <li> <?= _lang('visa_create'); ?></li>
                        <li class="active"><a href="<?= base_url('admin/visa_create'); ?>"><?= _lang('visa_create'); ?></a></li>
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
                            <h3 class="panel-title"><?= _lang('visa_create'); ?></h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <a class="btn btn-sm btn-info pull-left" style="margin-bottom: 40px;" href="" onclick="Visa_create.add(); return false;"><?= $lang['add_new']; ?> </a>
                            <div class="ls-editable-table table-responsive ls-table">
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('country_title_ar') ?></th>
                                            <th><?= _lang('type_title_ar') ?></th>
                                            <th><?= _lang('job_title_ar') ?></th>
                                            <th><?= _lang('period') ?></th>
                                            <th>تاريخ الانشاء</th>
                                            <th>الحالة</th>
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
                places_id: {
                    required: "اختر الدولة"
                },
                price: {
                    required: "ادخل السعر"
                }
            }
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('visa_create.js');
?>
