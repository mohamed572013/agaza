<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditProgramsAdvantages" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditProgramsAdvantagesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditProgramsAdvantagesForm" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="0">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 control-label text-capitalize">العنوان بالعربية</label>
                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control" id="title_ar" name="title_ar">
                                <div class="help-block"></div>
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4  control-label text-capitalize">العنوان بالإنجليزية</label>
                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control" id="title_en" name="title_en">
                                <div class="help-block"></div>
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4  control-label text-capitalize">الحالة</label>
                            <div class="col-xs-12 col-sm-8">
                                <select class="form-control" name="active" id="active">
                                    <option value="1" selected>نشط</option>
                                    <option value="0">غير نشط</option>
                                </select>
                                <div class="help-block"></div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-10">
                                <?php foreach ($features_image as $value) { ?>
                                        <label class="col-xs-4 col-sm-1 col-md-1 col-lg-1 pull-right">
                                            <input type="radio" required="required" name="image" value="<?= $value->image ?>">
                                            <img src="<?= base_url("theme/features_image/$value->image"); ?>" class="max-image-40" style="  max-width: 24px; max-height: 24p">
                                        </label>
                                    <?php } ?>
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
                        <li> <?= _lang('programs'); ?></li>
                        <li class="active"><a href="<?= base_url('admin/programs_advantage'); ?>"><?= _lang('programs_advantage'); ?></a></li>
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
                            <h3 class="panel-title"><?= _lang('programs_advantage'); ?></h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <a class="btn btn-sm btn-info pull-left" style="margin-bottom: 40px;" href="" onclick="Programs_advantages.add(); return false;"><?= $lang['add_new']; ?> </a>
                            <div class="ls-editable-table table-responsive ls-table">
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('title_ar') ?></th>
                                            <th><?= _lang('title_en') ?></th>
                                            <th><?= _lang('image') ?></th>
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
                title_ar: {
                    required: "ادخل العنوان بالعربية"
                },
                title_en: {
                    required: "ادخل العنوان بالإنجليزية"
                },
                image: {
                    required: "حدد الصورة"
                }
            }
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('programs_advantages.js');
?>
