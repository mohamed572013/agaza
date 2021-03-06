<style>
    .help-block{
        margin-bottom: 0;
    }
</style>
<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditRestaurants" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditRestaurantsLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditRestaurantsForm"  enctype="multipart/form-data">
                    <input type="hidden" name="restaurant_id" id="restaurant_id" value="0">





                     <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">إسم المطعم</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="title_ar" name="title_ar" value="">
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

                        <div class="form-group col-md-12">
                            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize text-right">عناون المطعم</label>
                            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                <input type="text" class="form-control" id="address_ar" name="address_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        

                    </div>
                    






                    <div class="row">

                        <div class="form-group col-md-12">
                            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize text-right">رابط المطعم</label>
                             <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
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

                                <img id="default-image" src="<?php echo base_url('no-image.jpg'); ?>" width="150" height="80" />
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
                        

                    </div>







                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">النجوم</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control" name="stars" id="stars">

                                    <option disabled="disabled" value="0"  selected>اختر</option>
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
                            <label class=" control-label"><?= $lang['restaurants_advantage'] ?></label><div>
                                <div class="col-lg-12">
                                    <?php if ($restaurants_advantages) { ?>
                                        <?php
                                        foreach ($restaurants_advantages as $value) {
                                           
                                            ?>
                                            <div class=" col-lg-3">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <input type='checkbox' name='restaurant_advantages_ids[]'  class="icheck-blue" id="<?= 'advantage_' . $value->id ?>" value='<?= $value->id ?>'   style="float: right;margin: 11px;"/>
                                                           
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



                    <div class="row">
                        <div class="col-lg-12">
                            <label class=" control-label">كلمات دليلية</label><div>
                                <div class="col-lg-12">
                                    <?php if ($restaurants_tags) { ?>
                                        <?php
                                        foreach ($restaurants_tags as $value) {
                                           
                                            ?>
                                            <div class=" col-lg-3">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <input type='checkbox' name='restaurant_tags_ids[]'  class="icheck-blue" id="<?= 'tag_' . $value->id ?>" value='<?= $value->id ?>'   style="float: right;margin: 11px;"/>
                                                           
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
<div class="modal fade" id="addEditRestaurantsImages" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditRestaurantsImagesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditRestaurantsImagesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="restaurant_id" id="restaurant_id" value=""/>
                    <div class="form-group">

                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('images'); ?></label>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <input type="file" class="form-control" id="restaurant_images" name="restaurant_images[]"  multiple>
                            <div class="help-block"></div>
                        </div>
                    </div>



                </form>
                <div id="restaurant-images-box">

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
                        <li class="active"><a href="<?= \base_url('admin/restaurants/show') ?>"><?= _lang('restaurants'); ?></a></li>
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
                            <a href="javascript:void(0);" class="panel-title hotel-data-box" data-type="hotels"><?= _lang('restaurants'); ?></a>
                        </div>
                        <div class="panel-body">
                            <style>
                                .table-box.active{display:block!important;}
                                .table-box.disabled{display:none!important;}
                            </style>
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table table-box active" style="padding-top: 30px;" id="hotels_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Restaurants.add_restaurants(); return false;">اضافة جديد</a>
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
            title_en: {
                required: 'ادخل العنوان'

            },
            stars: {
                required: 'ادخل عدد النجوم'

            },
            currency_id: {
                required: 'حدد العملة المستخدمة'

            },
            the_order: {
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
$_require['js'] = array('restaurants.js');
?>
