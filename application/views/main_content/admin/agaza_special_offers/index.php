<style>
    .help-block{
        margin-bottom: 0;
    }
</style>
<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditAgazaSpecialOffers" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditAgazaSpecialOffersLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditAgazaSpecialOffersForm"  enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="0">


                    <div class="row">


                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الحالة</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="active" id="active">
                                    <option  selected value="1">مفعل</option>
                                    <option value="0">غر مفعل</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">مكانها فى اجازة بوك</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="section_type" id="section_type">
                                    <option  selected disabled>اختر</option>
                                    <option  value="1"><?= _lang('egypt_section') ?></option>
                                    <option value="2"><?= _lang('offers_section') ?></option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان بالعربية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="title_ar" name="title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان بالإنجليزية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="title_en" name="title_en" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الرابط</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="url" name="url" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">السعر</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="number" min="1"  class="form-control" id="price" name="price">
                                <div class="help-block"></div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="file" class="form-control" id="image" name="image"  >
                                <div class="help-block"></div>
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-md-offset-6 image_uploaded" style="margin-right: 22%;">


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
<div class="modal fade" id="addEditHajUmrahHotelsImages" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHajUmrahHotelsImagesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHajUmrahHotelsImagesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="hotel_id" id="hotel_id" value=""/>
                    <div class="form-group">

                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('images'); ?></label>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <input type="file" class="form-control" id="hotel_images" name="hotel_images[]"  multiple>
                            <div class="help-block"></div>
                        </div>
                    </div>



                </form>
                <div id="hotel-images-box">

                </div>
                <div class="clearfix"></div>
                <ul class="list-group" id="files-not-uploaded">

                </ul>
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
                        <li class="active"><a href="<?= \base_url('admin/haj_umrah_hotels') ?>"><?= _lang('haj_umrah_hotels'); ?></a></li>
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
                            <a href="" class="panel-title hotel-data-box" data-type="hotels"><?= _lang('haj_umrah_hotels'); ?></a>
                        </div>
                        <div class="panel-body">
                            <style>
                                .table-box.active{display:block!important;}
                                .table-box.disabled{display:none!important;}
                            </style>
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table table-box active" style="padding-top: 30px;">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Agaza_special_offers.add(); return false;">اضافة جديد</a>
                                <table class="table dataTable table-bordered table-striped table-bottomless">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('title_ar') ?></th>
                                            <th><?= _lang('title_en') ?></th>
                                            <th><?= _lang('price') ?></th>
                                            <th><?= _lang('image') ?></th>
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
                title_en: {
                    required: 'ادخل العنوان'

                },
                price: {
                    required: 'ادخل السعر'

                },
                url: {
                    required: 'ادخل الرابط'

                },
            }
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('agaza_special_offers.js');
?>
