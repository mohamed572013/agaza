<style>
    .help-block{
        margin-bottom: 0;
    }
</style>
<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditNews" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditNewsLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditNewsForm"  enctype="multipart/form-data">
                    <input type="hidden" name="news_id" id="news_id" value="0">



                    <div class="row">

                        <div class="form-group ">
                            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize">عنوان الخبر بالعربية</label>
                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                                <input type="text" class="form-control" id="title_ar" name="title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        



                    </div>


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
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['this_order']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="this_order" name="this_order">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>

                    
                    <div class="row">


                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="file" class="form-control" id="image" name="image"  >
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 image_uploaded">

                                <img src="<?php echo base_url('no-image.jpg'); ?>" width="150" height="80" />
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group ">
                            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['body_ar']; ?></label>
                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                                <textarea rows="5" class="form-control" name="body_ar" id="body_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        

                    </div>
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['desc_ar']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="desc_ar" id="desc_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['keywords_ar']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="keywords_ar" id="keywords_ar"></textarea>
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
                        <li class="active"><a href="<?= \base_url('admin/news/show') ?>" class="places_btn" data-id="0"><?= _lang('news'); ?></a></li>
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
                            <a href="" class="panel-title places_btn" data-id="0"><?= _lang('news'); ?></a>
                        </div>
                        <div class="panel-body">
                            <style>
                                .table-box.active{display:block!important;}
                                .table-box.disabled{display:none!important;}
                            </style>
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table table-box active" style="padding-top: 30px;" id="news_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="News.add_mews(); return false;">اضافة جديد</a>
                                <table class="table dataTable table-bordered table-striped table-bottomless">
                                    <thead>
                                        <tr>
                                            <th>عنوان الخبر</th>
                                            <th>صورة الخبر</th>
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
        var new_lang = {
            'edit_user': 'تعديل مستخدم',
            messages: {
                title_ar: {
                    required: 'ادخل العنوان بالعربية'

                },                
                this_order: {
                    required: 'ادخل الترتيب',
                    number: 'ادخل ارقام فقط'

                },
                body_ar: {
                    required: 'ادخل المحتوى بالعربية'

                },               
                desc_ar: {
                    required: 'ادخل الوصف بالعربية'

                },               
                keywords_ar: {
                    required: 'ادخل الكلمات الدلالية بالعربية'

                },
                image: {
                    required: 'ادخل صورة الخبر'

                },
            }
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('news.js');
?>
