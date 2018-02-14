<style>
    .help-block{
        margin-bottom: 0;
    }
</style>
<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditEtiquette" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditEtiquetteLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditEtiquetteForm"  enctype="multipart/form-data">
                    <input type="hidden" name="etiquette_id" id="etiquette_id" value="0">





                     <div class="row">

                        <div class="form-group ">
                            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize">إسم المكان</label>
                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                                <input type="text" class="form-control" id="title_ar" name="title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                  

                    </div>







                     <div class="row">


                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="file" class="form-control" id="image" name="image" onchange="readImage()"  >
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
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('الحالة'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="is_active" id="is_active">
                                    <option value="1">مفعل</option>
                                    <option value="0">غير مفعل</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['this_order']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="the_order" name="the_order">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    



                   
                    <div class="row">

                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['body_ar']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="content_ar" id="content_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                         <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الكلمات الدليلية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="tags" id="tags"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                     

                    </div>
                
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">SEO Keywords</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="keywords_ar" id="keywords_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">SEO description</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="description_ar" id="description_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
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
                        <li class="active"><a href="<?= \base_url('admin/shops/show') ?>"><?= _lang('shops'); ?></a></li>
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
                            <a href="" class="panel-title hotel-data-box" data-type="hotels"><?= _lang('hotels'); ?></a>
                        </div>
                        <div class="panel-body">
                            <style>
                                .table-box.active{display:block!important;}
                                .table-box.disabled{display:none!important;}
                            </style>
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table table-box active" style="padding-top: 30px;" id="hotels_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Etiquette.add_etiquette(); return false;">اضافة جديد</a>
                                <table class="table dataTable table-bordered table-striped table-bottomless">
                                    <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            
                                            <th>الصورة الرئيسية</th>
                                            <th>تاريخ الإضافة</th>
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
                required: 'ادخل العنوان'

            },
           
            the_order: {
                required: 'ادخل الترتيب',
                number: 'ادخل ارقام فقط'

            },
           
            content_ar: {
                required: 'ادخل المحتوى'

            },
          
            image: {
                required: 'ادخل الوصف'

            },
          
            
          
        }
    };
</script>
<?php
global $_require;
$_require['js'] = array('etiquette.js');
?>


<script type="text/javascript">
    
    function readImage() {

                //alert($(this)[0].files.length);
                for (var i = 0; i < $("#image")[0].files.length; i++) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.image_uploaded').html('<img style="height:80px;width:150px;" id="image_upload_preview" src="' + e.target.result + '" alt="your image" />');
                    }

                    reader.readAsDataURL($("#image")[0].files[i]);
                }

                //readURL(this);
           

    }

</script>