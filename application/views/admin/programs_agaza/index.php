<div class="modal fade" id="addEditPrograms" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditProgramsLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditProgramsForm"  enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="0">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"> <?= _lang('nights number'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <input type="text" class="form-control"  required="required"   id="maka_nights" name="maka_nights" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['programs_levels']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <select class="form-control"  required="required"   name="programs_levels" id="programs_levels">
                                    <option selected disabled>اختر</option>
                                    <?php
                                        foreach ($programs_levels as $value) {
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
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= _lang('main_categories'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <select class="form-control"  required="required"   name="parent_category_id" id="parent_category_id">
                                    <option selected disabled>اختر</option>
                                    <?php
                                        foreach ($program_categories as $value) {
                                            echo "<option value='" . $value->id . "' $select >      $value->title_ar</option>";
                                        }
                                    ?>
                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= _lang('sub_categories'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <select class="form-control"  required="required"   name="category_id" id="category_id">
                                    <option selected disabled>اختر</option>
                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= \_lang('price_start_from'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" min="1" class="form-control" id="price_start_from" name="price_start_from">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= _lang('currency'); ?></label>
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
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('status'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control" name="active" id="active">
                                    <option value="1" selected>مفعل</option>
                                    <option value=0">غير مفعل</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('special_offer'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="special_offer" id="special_offer">
                                    <option value="0" selected>غير مفعل</option>
                                    <option value="1">مفعل</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('show_in_slider'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"   name="show_in_slider" id="show_in_slider">
                                    <option value="0" selected>غير مفعل</option>
                                    <option value="1" >مفعل</option>

                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
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


                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="file" class="form-control" id="prog_main_image" name="prog_main_image"  >
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
                    <div class="row" id="slider-image-upload-box" style="display:none;">
                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= _lang('slider_image'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <input type="file" class="form-control" id="prog_slider_image" name="prog_slider_image"  >
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 slider_image_uploaded">

                                <img src="<?php echo base_url('no-image.jpg'); ?>" width="150" height="80" />
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

                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('program_include_ar'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="program_include_ar" id="program_include_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('program_include_en'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="program_include_en" id="program_include_en"></textarea>
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
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['this_order']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" min="1" class="form-control" id="this_order" name="this_order">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>



                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form">حفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addEditProgramsImages" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditProgramsImagesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditProgramsImagesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="program_id" id="program_id" value=""/>
                    <div class="form-group">

                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('images'); ?></label>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <input type="file" class="form-control" id="program_images" name="program_images[]"  multiple>
                            <div class="help-block"></div>
                        </div>
                    </div>



                </form>
                <div id="programs-images-box">

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
<div class="modal fade" id="determineProgramType" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="determineProgramTypeLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="determineProgramTypeForm"  enctype="multipart/form-data">


                    <div class="row">
                        <h1 class="text-center">حدد نوع البرنامج</h1>
                        <br>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-5">
                            <label>
                                <input type="radio" name="program_type" data-type="collective" value="1" id="program_type_collective" checked>جماعى
                            </label>
                        </div>
                        <div  class="col-md-5">
                            <label>
                                <input type="radio" name="program_type"  data-type="individual" id="program_type_individual" value="2">فردى
                            </label>
                        </div>
                    </div>

                    <div class="row" id="individual-box-period" style="display: none;">
                        <h1 class="text-center">حدد الفترة</h1>
                        <br>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">من</label>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                                <input type="date" class="form-control" id="from_date" name="from_date">
                                <div class="help-block"></div>
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الى</label>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                                <input type="date" class="form-control" id="to_date" name="to_date">
                                <div class="help-block"></div>
                            </div>

                        </div>
                    </div>





                </form>
                <div id="programs-images-box">

                </div>
                <div class="clearfix"></div>
                <ul class="list-group" id="files-not-uploaded">

                </ul>
            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <a href="#addEditPrograms" data-toggle="modal" data-dismiss="modal" class="btn btn-info submit-form">حفظ ومتابعة </a>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>

<!--Page main section start-->
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <!--Top breadcrumb start -->
                    <ol class="breadcrumb">
                        <li> <i class="fa fa-home"></i> </li>
                        <li> <?php echo $lang['basic_data']; ?></li>
                        <li class="active"><a href="<?= \base_url('admin/programs/show') ?>"><?= $lang['programs']; ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <a class="btn btn-sm btn-info pull-right" href="<?= \base_url("admin/programs/add") ?>"><?= $lang['add_new']; ?> </a>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['programs']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table table-box active" style="padding-top: 30px;" id="programs_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Programs.add_programs(); return false;">اضافة جديد</a>
                                <table class="table dataTable table-bordered table-striped table-bottomless">
                                    <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الصورة الرئيسية</th>
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
                price_start_from: {
                    required: 'ادخل السعر',
                    number: 'ادخل ارقام فقط'

                },
                currency_id: {
                    required: 'ادخل العملة',
                },
                parent_category_id: {
                    required: 'ادخل تصنيف البرنامج الرئيسى',
                },
                category_id: {
                    required: 'ادخل تصنيف البرنامج الفرعى',
                },
                maka_nights: {
                    required: 'ادخل عدد الليالى'

                },
                programs_levels: {
                    required: 'ادخل مستوى البرنامج'

                },
                this_order: {
                    required: 'ادخل الترتيب',
                    number: 'ادخل ارقام فقط'

                },
                program_include_ar: {
                    required: 'ادخل البرنامج يشمل بالعربية'

                },
                program_include_en: {
                    required: 'ادخل البرنامج يشمل بالإنجليزية'

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
    $_require['js'] = array('programs.js');
?>