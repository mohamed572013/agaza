<style>
    .help-block{
        margin-bottom: 0;
    }
</style>
<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditTransportations" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditTransportationsLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditTransportationsForm"  enctype="multipart/form-data">
                    <input type="hidden" name="transportation_id" id="transportation_id" value="0">









                    <div class="row">

                        <div class="form-group ">
                            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize text-right">إسم المكان</label>
                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                                <input type="text" class="form-control" id="title_ar" name="title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        

                    </div>
                    




                     <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">نوع السيارة</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="brand_id" id="brand_id" onchange="$('#default-brand').attr('disabled', 'disabled')" >
                                    <option value="0" id="default-brand" >اختر النوع</option>
                                    <?php foreach ($brands as $key => $value) { ?>                                        
                                        <option value="<?= $value->id ?>"><?= $value->title_ar ?></option>
                                    <?php } ?>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">رقم التليفون</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="phone" name="phone" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>













                 





                    <div class="row">

                        <div class="form-group ">
                            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize text-right">العنوان</label>
                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                                <input type="text" class="form-control" id="address_ar" name="address_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        

                    </div>
                    






                    <div class="row">

                        <div class="form-group">
                            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize text-right">رابط المكان</label>
                             <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                <input type="text" class="form-control" id="email" name="email" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        

                    </div>







                     <div class="row">


                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="file" class="form-control" id="logo" name="logo"  >
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
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">رابط الخريطة</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="map_url" id="map_url"></textarea>
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


                    <div class="row">
                        <div class="col-lg-12">
                            <label class=" control-label">كلمات دليلية</label><div>
                                <div class="col-lg-12">
                                    <?php if ($brands) { ?>
                                        <?php
                                        foreach ($brands as $value) {
                                           
                                            ?>
                                            <div class=" col-lg-3">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <input type='checkbox' name='transportation_tags_ids[]'  class="icheck-blue" id="<?= 'tag_' . $value->id ?>" value='<?= $value->id ?>'   style="float: right;margin: 11px;"/>
                                                           
                                                            <?= $value->title_ar; ?>
                                                        </td>
                                                    <tr>
                                                </table>
                                            </div>

                                        <?php } ?>
                                    <?php } ?>

                                </div>
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
<div class="modal fade" id="addEditTransportationsImages" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditTransportationsImagesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditTransportationsImagesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="transportation_id" id="transportation_id" value=""/>
                    <div class="form-group">

                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('images'); ?></label>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <input type="file" class="form-control" id="transportation_images" name="transportation_images[]"  multiple>
                            <div class="help-block"></div>
                        </div>
                    </div>



                </form>
                <div id="transportation-images-box">

                </div>
                <div class="clearfix"></div>
                <ul class="list-group" id="files-not-uploaded">

                </ul>
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
                        <li class="active"><a href="<?= \base_url('admin/transportations/show') ?>"><?= _lang('transportations'); ?></a></li>
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
                            <a href="javascript:;" class="panel-title hotel-data-box" data-type="hotels"><?= _lang('transportations'); ?></a>
                        </div>
                        <div class="panel-body">
                            <style>
                                .table-box.active{display:block!important;}
                                .table-box.disabled{display:none!important;}
                            </style>
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table table-box active" style="padding-top: 30px;" id="hotels_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Transportations.add_transportations(); return false;">اضافة جديد</a>
                                <table class="table dataTable table-bordered table-striped table-bottomless">
                                    <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            
                                            <th>الصورة الرئيسية</th>
                                             <th>الحالة</th>
                                            <th>الصور</th>
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
            places_id: {
                required: 'اختر المدينة'

            },
    
         
          
            keywords_ar: {
                required: 'ادخل الكلمات الدلالية'

            },
          
        }
    };
</script>
<?php
global $_require;
$_require['js'] = array('transportations.js');
?>
