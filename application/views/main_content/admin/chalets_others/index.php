<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditHotelChaletsOthers" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHotelChaletsOthersLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHotelChaletsOthersForm"  enctype="multipart/form-data">
                    <input type="hidden" name="chalets_others_id" id="chalets_others_id" value="0">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">العنوان</label>
                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                            <input type="text" class="form-control" id="title_ar" name="title_ar" value="<?= (!empty($about_us->title_ar)) ? $about_us->title_ar : ''; ?>">
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
                        data-dismiss="modal">خفظ</button>
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
                        <li class="active"><a href="">شاليهات و أخرى</a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <a class="btn btn-sm btn-info pull-right" href="" onclick="Chalets_others.add(); return false;"><?= $lang['add_new']; ?> </a>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">شاليهات و أخرى</h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table">
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('title_ar') ?></th>
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
                    required: "ادخل العنوان"
                }
            }
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('chalets_others.js');
?>
