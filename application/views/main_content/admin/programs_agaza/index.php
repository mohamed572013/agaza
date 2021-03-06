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


                        <div class="form-group  ">

                            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize">اختر التصنيف</label>
                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                                <select class="form-control"    name="agaza_category" id="agaza_category">
                                    <option value="0">سياحة داخلية</option>
                                    <option value="1">سياحة خارجية</option>
                                    
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







                    
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان بالعربية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="agaza_title_ar" name="title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان بالإنجليزية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="agaza_title_en" name="title_en" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('program_include_ar'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="program_include_ar" id="agaza_program_include_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('program_include_en'); ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="program_include_en" id="agaza_program_include_en"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['desc_ar']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="desc_ar" id="agaza_desc_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['desc_en']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="desc_en" id="agaza_desc_en"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['keywords_ar']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="keywords_ar" id="agaza_keywords_ar"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['keywords_en']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <textarea rows="5" class="form-control" name="keywords_en" id="agaza_keywords_en"></textarea>
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['this_order']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" min="1" class="form-control" id="agaza_this_order" name="this_order">
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
                    <!--<div class="form-group">

                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('images'); ?></label>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <input type="file" class="form-control" id="program_images" name="program_images[]"  multiple>
                            <div class="help-block"></div>
                        </div>
                    </div>
-->


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

           
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['programs']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table table-box active" style="padding-top: 30px;" id="programs_table">
                                
                                <table class="table dataTable table-bordered table-striped table-bottomless">
                                    <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الصورة الرئيسية</th>
                                            <th>الصور</th>
                                            <th>اسم الشركة</th>
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
$_require['js'] = array('programs_agaza.js');
?>