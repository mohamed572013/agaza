<style>
    .help-block{
        margin-bottom: 0;
    }
</style>
<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditHotels" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHotelsLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHotelsForm"  enctype="multipart/form-data">
                    <input type="hidden" name="hotel_id" id="hotel_id" value="0">


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
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize">العملة المستخدمة</label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <select class="form-control"  required="required"   name="currency_id" id="currency_id">
                                    <option selected disabled>اختر</option>
                                    <?php
                                    foreach ($currency as $value) {
                                        echo "<option value='" . $value->id . "' $select >      $value->title_ar</option>";
                                    }
                                    ?>
                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('country'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="country_id" id="country_id">
                                    <option disabled="disabled"
                                            selected>اختر</option>
                                            <?php
                                            foreach ($countries as $value) {
                                                echo "<option value='" . $value->id . "' >   $value->title_ar</option>";
                                            }
                                            ?>
                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('city'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="places_id" id="places_id">
                                    <option disabled="disabled"
                                            selected>اختر</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">النجوم</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control" name="stars" id="stars">
                                    <option disabled="disabled"
                                            selected>اختر</option>
                                            <?php
                                            for ($x = 1; $x <= 5; $x++) {
                                                ?>
                                        <option value="<?= $x ?>"> <?= $x ?></option>
                                    <?php } ?>
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

                    </div>
                    <div class="row">


                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="file" class="form-control" id="hotel_image" name="hotel_image"  >
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

                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['body_ar']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="body_ar" id="body_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['body_en']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="body_en" id="body_en"></textarea>
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
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['desc_en']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="desc_en" id="desc_en"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['keywords_ar']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="keywords_ar" id="keywords_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['keywords_en']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="keywords_en" id="keywords_en"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('show_in_agazabook'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="show_in_agazabook" id="show_in_agazabook">
                                    <option value="0" selected>غير مفعل</option>
                                    <option value="1">مفعل</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label class=" control-label"><?= $lang['hotels_advantage'] ?></label><div>
                                <div class="col-lg-12">
                                    <?php if ($hotels_advantages) { ?>
                                        <?php
                                        foreach ($hotels_advantages as $value) {
                                            $image = $value->image;
                                            ?>
                                            <div class=" col-lg-3">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <input type='checkbox' name='hotel_advantages_ids[]'  class="icheck-blue" id="<?= 'advantage_' . $value->id ?>" value='<?= $value->id ?>'   style="float: right;margin: 11px;"/>
                                                            <img src="<?= base_url("theme/features_image/$image"); ?>" class="max-image-40" style="  max-width: 24px; max-height: 24p">
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
<div class="modal fade" id="addEditHotelsImages" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHotelsImagesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHotelsImagesForm"  enctype="multipart/form-data">
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
                        <li class="active"><a href="<?= \base_url('admin/hotels/show') ?>"><?= _lang('hotels'); ?></a></li>
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
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Hotels.add_hotels(); return false;">اضافة جديد</a>
                                <table class="table dataTable table-bordered table-striped table-bottomless">
                                    <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>المدينة</th>
                                            <th>الصورة الرئيسية</th>
                                            <th>الصور</th>
                                            <th><?= _lang('options'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="hotels_images_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Haj_umrah_hotels.add_hotels_images(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('travel_way') ?></th>
                                            <th><?= _lang('transporter_company') ?></th>
                                            <th><?= _lang('going') ?></th>
                                            <th><?= _lang('returning') ?></th>
                                            <th><?= _lang('room_prices') ?></th>
                                            <th><?= _lang('options') ?></th>
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
            stars: {
                required: 'ادخل عدد النجوم'

            },
            currency_id: {
                required: 'حدد العملة المستخدمة'

            },
            this_order: {
                required: 'ادخل الترتيب',
                number: 'ادخل ارقام فقط'

            },
            places_id: {
                required: 'اختر المدينة'

            },
            body_ar: {
                required: 'ادخل المحتوى'

            },
            body_en: {
                required: 'ادخل المحتوى'

            },
            desc_ar: {
                required: 'ادخل الوصف'

            },
            desc_en: {
                required: 'ادخل الوصف'

            },
            keywords_ar: {
                required: 'ادخل الكلمات الدلالية'

            },
            keywords_en: {
                required: 'ادخل الكلمات الدلالية'

            },
        }
    };
</script>
<?php
global $_require;
$_require['js'] = array('hotels.js');
?>
