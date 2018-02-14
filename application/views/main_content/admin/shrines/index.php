<!--Page main section start-->
<div class="modal fade" id="addEditShrines" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditShrinesLabel"></h4>
            </div>

            <div class="modal-body">

                <form  enctype="multipart/form-data"  action="" id="addEditShrinesForm" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form">
                    <input type="hidden" name="id" id="id" value="0"/>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['state']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <select class="form-control"   name="active" id="active">
                                    <option value="1" selected>مفعل</option>
                                    <option value=0">غير مفعل</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['choose_country']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <select class="form-control"   name="country_id" id="country_id">
                                    <option selected disabled><?= $lang['choose_country']; ?></option>
                                    <?php
                                        foreach ($countries as $value) {
                                            $select = "";
                                            echo "<option value='" . $value->id . "' $select >   $value->title_ar</option>";
                                        }
                                    ?>
                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize">اختر المدينة   </label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <select class="form-control"  name="places_id" id="places_id">
                                    <option selected disabled>اختر</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4  control-label text-capitalize"><?= $lang['this_order']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <input type="text"  class="form-control" id="this_order" name="this_order" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['title_ar']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <input type="text" class="form-control" id="title_ar" name="title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['title_en']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <input type="text" class="form-control" id="title_en" name="title_en" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group row form-box col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['body_ar']; ?></label>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <textarea rows="5" class="form-control" name="body_ar" id="body_ar"></textarea>
                            </div>
                        </div>
                        <div class="form-group row form-box col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['body_en']; ?></label>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <textarea rows="5" class="form-control" name="body_en" id="body_en"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group row form-box col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['desc_ar']; ?></label>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <textarea rows="5" class="form-control" name="desc_ar" id="desc_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row form-box col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['desc_en']; ?></label>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <textarea rows="5" class="form-control" name="desc_en" id="desc_en"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group row form-box col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['keywords_ar']; ?></label>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <textarea rows="5" class="form-control" name="keywords_ar" id="keywords_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row form-box col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['keywords_en']; ?></label>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <textarea rows="5" class="form-control" name="keywords_en" id="keywords_en"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <input type="file" class="form-control" id="image" name="image"  >
                            </div>
                        </div>
                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"></label>
                            <div class="image_uploaded col-xs-12 col-sm-8 col-md-8">

                            </div>
                        </div>
                    </div>

                </form>
                <!--Table Wrapper Finish-->
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
<div class="modal fade" id="addEditShrinesImages" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditShrinesImagesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditShrinesImagesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="shrine_id" id="shrine_id" value=""/>
                    <div class="form-group">

                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('images'); ?></label>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <input type="file" class="form-control" id="shrine_images" name="shrine_images[]"  multiple>
                            <div class="help-block"></div>
                        </div>
                    </div>



                </form>
                <div id="shrines-images-box">

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
                        <li class="active"><a href="<?= \base_url('admin/maka_madina_shrines/show') ?>"><?= $lang['maka_madina_shrines']; ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <a class="btn btn-sm btn-info pull-left" onclick="Shrines.add();return false;"><?= $lang['add_new']; ?> </a>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['maka_madina_shrines']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table">
                                <table class="table table-bordered dataTable table-striped table-bottomless">
                                    <thead>
                                        <tr>
                                            <th><?= $lang['title_ar']; ?></th>
                                            <th><?= $lang['city']; ?></th>
                                            <th><?= _lang('image'); ?></th>
                                            <th><?= _lang('gallery'); ?></th>
                                            <th><?= $lang['controll']; ?></th>
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


<script type="text/javascript" src="assets/admin/ltr/js/lib/jquery-1.11.min.js"></script>

<style>
    .switchery,.switchery > small{
        height: 20px  !important;
    }
    .switchery{
        width: 30px  !important;
    }
    .switchery > small{
        width: 15px !important;
    }
</style>

<script>

                    function delete_action_masa(title, id) {
                        $.confirm({
                            title: '<span style="color:#333">هل انت متاكد من انك تريد مسح هذا العنصر</span>',
                            content: '<span style="color:#333">لديك 6 ثوانى للاختيار</span>',
                            autoClose: 'cancel|6000',
                            rtl: true,
                            confirmButton: 'نعم متاكد',
                            confirmButtonClass: 'btn-danger',
                            cancelButton: 'الغاء',
                            confirm: function () {
                                delete_item_masa(title, id);
                            }

                        });
                    }

                    function delete_item_masa(title, id) {
                        $('.amaran').remove();
                        $.ajax({
                            type: "post",
                            url: "<?= base_url("admin/maka_madina_shrines/delete") ?>" + "/" + id,
                            success: function (data) {
                                if (data == "yes") {
                                    $('#ls-editable-table').DataTable().row('#tr_' + id).remove().draw();
                                    $.amaran({
                                        content: {
                                            message: '<b>تم الحذف</b>',
                                            size: 'العنصر   #' + title,
                                            file: '<b>تم حذف جميع البيانات المتعلقة بالعنصر</b>',
                                            icon: 'glyphicon glyphicon-ok'
                                        },
                                        theme: 'default green',
                                        position: 'top right',
                                        inEffect: 'slideLeft',
                                        outEffect: 'slideTop',
                                        closeButton: true,
                                        delay: 7000
                                    });

                                } else if (data == "pemision_denied") {
                                    $.amaran({
                                        content: {
                                            message: '<b> فشل فى  حذف العنصر</b>',
                                            size: title,
                                            file: '<b> غير مصرح لك بامكانية الحذف</b>',
                                            icon: 'fa fa-times'
                                        },
                                        theme: 'default error',
                                        position: 'top right',
                                        inEffect: 'slideLeft',
                                        outEffect: 'slideTop',
                                        closeButton: true,
                                        delay: 7000
                                    });
                                } else {
                                    $.amaran({
                                        content: {
                                            message: '<b> فشل فى  حذف المزار</b>',
                                            size: title,
                                            file: '<b>لا يمكن حذف هذا العنصر لوجود عناصر متعلقة به</b>',
                                            icon: 'fa fa-times'
                                        },
                                        theme: 'default error',
                                        position: 'top right',
                                        inEffect: 'slideLeft',
                                        outEffect: 'slideTop',
                                        closeButton: true,
                                        delay: 7000
                                    });
                                }
                            }

                        });

                    }
                    function state_action_masa(title, id) {
                        $('.amaran').remove();
                        $.ajax({
                            type: "post",
                            url: "<?= base_url("admin/maka_madina_shrines/status") ?>" + "/" + id,
                            success: function (data) {
                                if (data == "yes") {
                                    $.amaran({
                                        content: {
                                            message: '<b>تم  تعديل حالة </b>',
                                            size: 'المزار   #' + title,
                                            file: '<b> </b>',
                                            icon: 'glyphicon glyphicon-ok'
                                        },
                                        theme: 'default green',
                                        position: 'top right',
                                        inEffect: 'slideLeft',
                                        outEffect: 'slideTop',
                                        closeButton: true,
                                        delay: 7000
                                    });

                                } else if (data == "pemision_denied") {
                                    var state = $("#tr_" + id + " .js-switch").val();
                                    var nonactive = "border-color: rgb(223, 223, 223); box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; transition: border 0.4s, box-shadow 0.4s; background-color: rgb(255, 255, 255);";
                                    var active = "box-shadow: rgb(100, 189, 99) 0px 0px 0px 16px inset; border-color: rgb(100, 189, 99); transition: border 0.4s, box-shadow 0.4s, background-color 1.2s; background-color: rgb(100, 189, 99);";

                                    if (state == 1) {

                                        $("#tr_" + id + " .switchery").attr("style", active)
                                        $("#tr_" + id + " small").css("left", "15px")
                                    }
                                    if (state == 0) {

                                        $("#tr_" + id + " .switchery").attr("style", nonactive)
                                        $("#tr_" + id + " small").css("left", "0px")
                                    }
                                    $.amaran({
                                        content: {
                                            message: '<b> فشل فى تعديل الحالة للعنصر     </b>',
                                            size: title,
                                            file: '<b> غير مصرح لك بامكانية التعديل</b>',
                                            icon: 'fa fa-times'
                                        },
                                        theme: 'default error',
                                        position: 'top right',
                                        inEffect: 'slideLeft',
                                        outEffect: 'slideTop',
                                        closeButton: true,
                                        delay: 7000
                                    });
                                } else {
                                    var state = $("#tr_" + id + " .js-switch").val();
                                    var nonactive = "border-color: rgb(223, 223, 223); box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; transition: border 0.4s, box-shadow 0.4s; background-color: rgb(255, 255, 255);";
                                    var active = "box-shadow: rgb(100, 189, 99) 0px 0px 0px 16px inset; border-color: rgb(100, 189, 99); transition: border 0.4s, box-shadow 0.4s, background-color 1.2s; background-color: rgb(100, 189, 99);";

                                    if (state == 1) {

                                        $("#tr_" + id + " .switchery").attr("style", active)
                                        $("#tr_" + id + " small").css("left", "15px")
                                    }
                                    if (state == 0) {

                                        $("#tr_" + id + " .switchery").attr("style", nonactive)
                                        $("#tr_" + id + " small").css("left", "0px")
                                    }
                                    $.amaran({
                                        content: {
                                            message: '<b> فشل فى  تغيير حالة  المزار</b>',
                                            size: title,
                                            file: '<b> </b>',
                                            icon: 'fa fa-times'
                                        },
                                        theme: 'default error',
                                        position: 'top right',
                                        inEffect: 'slideLeft',
                                        outEffect: 'slideTop',
                                        closeButton: true,
                                        delay: 7000
                                    });
                                }
                            }

                        });

                    }
                    var new_lang = {
                        'edit_user': 'تعديل مستخدم',
                        messages: {
                            this_order: {
                                required: 'ادخل الترتيب',
                                number: 'ادخل ارقام فقط'

                            },
                            country_id: {
                                required: 'اختر الدولة'

                            },
                            places_id: {
                                required: 'اختر المدينة'

                            },
                            title_ar: {
                                required: 'ادخل العنوان'

                            },
                            title_en: {
                                required: 'ادخل العنوان'

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
    $_require['js'] = array('shrines.js');
?>
