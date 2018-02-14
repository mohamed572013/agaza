<style>
    .help-block{
        margin-bottom: 0;
    }
</style>
<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditHajUmrahPrograms" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHajUmrahProgramsLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHajUmrahProgramsForm" name="user-form" enctype="multipart/form-data">
                    <input type="hidden" name="haj_umrah_program_id" id="haj_umrah_program_id" value="0">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الحالة</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control" name="active" id="active">
                                    <option disabled="disabled"
                                            selected>اختر</option>
                                    <option value="1">مفعل</option>
                                    <option value="0">غير مفعل</option>
                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">عدد الليالى</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="number" min="1"  class="form-control" id="no_of_nights" name="no_of_nights">

                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">عرض خاص</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control" name="special_offer" id="special_offer">
                                    <option disabled="disabled"
                                            selected>اختر</option>
                                    <option value="1">مفعل</option>
                                    <option value="0">غير مفعل</option>
                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['programs_levels']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control"  required="required"   name="programs_levels" id="programs_levels">
                                    <option disabled="disabled"
                                            selected>اختر</option>
                                            <?php
                                                foreach ($programs_levels as $value) {
                                                    $select = "";

                                                    if ($programs_levels_val == $value->id) {
                                                        $select = "selected";
                                                    }
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
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="title_ar" name="title_ar" value="<?= (!empty($about_us->title_ar)) ? $about_us->title_ar : ''; ?>">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">السعر يبدا من </label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="number" min="1"  class="form-control" id="price_start_from" name="price_start_from">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['this_order']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="number" min="1" class="form-control" id="this_order" name="this_order">
                                <div class="help-block"></div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <input type="file" class="form-control" id="program_image" name="program_image"  data-image="program-image-view">
                                <div class="help-block"></div>
                            </div>
                            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                <img id="program-image-view" class="im" src="<?= base_url('no-image.jpg'); ?>" style="height:40px;width: 100%;"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['program_include']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="program_include" id="program_include"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['program_not_include']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="program_not_include" id="program_not_include"></textarea>
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
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">عرض فى السلايدر</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control" name="show_in_slider" id="show_in_slider">
                                    <option disabled="disabled"
                                            selected>اختر</option>
                                    <option value="1">مفعل</option>
                                    <option value="0">غير مفعل</option>
                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6" id="slider-image-upload-box" style="display:none;">

                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('slider_image'); ?></label>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <input type="file" class="form-control" id="slider_image" name="slider_image"  data-image="slider-image-view">
                                <div class="help-block"></div>
                            </div>
                            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                <img id="slider-image-view" class="im" src="<?= base_url('no-image.jpg'); ?>" style="height:40px;width: 100%;"/>
                            </div>
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
<div class="modal fade" id="addEditHajUmrahProgramsImages" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHajUmrahProgramsImagesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHajUmrahProgramsImagesForm"  enctype="multipart/form-data" method="post">
                    <input type="hidden" name="program_id" id="program_id" value=""/>
                    <div class="form-group">

                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('images'); ?></label>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <input type="file" class="form-control" id="program_images" name="program_images[]"  multiple>
                            <div class="help-block"></div>
                        </div>
                    </div>



                </form>
                <div id="program-images-box">

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
                        <li class="active"><a href="<?= \base_url('admin/haj_umrah_programs') ?>"><?= $lang['haj_umrah_programs']; ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <a class="btn btn-sm btn-info pull-right" href="" onclick="Haj_umrah_programs.add(); return false;"><?= $lang['add_new']; ?> </a>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= _lang('haj_umrah_programs'); ?></h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table">
                                <table class="table dataTable table-bordered table-striped table-bottomless">
                                    <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th> السعر يبدا من</th>
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
                active: {
                    required: 'من فضلط حدد الحالة'

                },
                no_of_nights: {
                    required: 'من فضلك ادخل عدد الليالى '

                },
                program_view_in_home: {
                    required: 'من فضلك ادخل عرض فى القائمة الرئيسية'

                },
                special_offer: {
                    required: 'من فضلك ادخل عرض خاص'

                },
                programs_levels: {
                    required: 'من فضلك ادخل مستوى البرنامج'

                },
                title_ar: {
                    required: 'من فضلك ادخل العنوان'

                },
                price_start_from: {
                    required: 'من فضلك ادخل السعر يبدأ من'

                },
                this_order: {
                    required: 'من فضلك ادخل الترتيب'

                },
                program_image: {
                    required: 'من فضلك ادخل صورة البرنامج'

                },
                program_include: {
                    required: 'من فضلك ادخل البرنامج يشتمل على'

                },
                program_not_include: {
                    required: 'من فضلك ادخل البرنامج لا يشتمل على'

                },
                desc_ar: {
                    required: 'من فضلك ادخل الوصف'

                },
                keywords_ar: {
                    required: 'من فضلك ادخل الكلمات الدلالية'

                },
            }
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('haj_umrah_programs.js');
?>
