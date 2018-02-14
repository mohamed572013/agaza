<style>
    .help-block{
        margin-bottom: 0;
    }
</style>
<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditHomeSlider" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHomeSliderLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHomeSliderForm"  enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="0">


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
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان الأول بالعربية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="first_title_ar" name="first_title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان الأول بالإنجليزية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="first_title_en" name="first_title_en" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان الثانى بالعربية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="second_title_ar" name="second_title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان الثانى بالإنجليزية</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="second_title_en" name="second_title_en" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الرابط</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="url" name="url" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>


                    </div>
                    <div class="row">


                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="file" class="form-control" id="home_slider_image" name="home_slider_image"  >
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
                        <li> <?= _lang('basic_data'); ?></li>
                        <li class="active"><a href="javascript:;"><?= _lang('hom_slider'); ?></a></li>
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
                            <a href="" class="panel-title places_btn" data-id="0"><?= _lang('home_slider'); ?></a>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->

                            <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Home_slider.add(); return false;">اضافة جديد</a>
                            <table class="table dataTable table-bordered table-striped table-bottomless">
                                <thead>
                                    <tr>
                                        <th><?= _lang('first_title_en'); ?></th>
                                        <th><?= _lang('second_title_en'); ?></th>
                                        <th><?= _lang('image'); ?></th>
                                        <th><?= _lang('status'); ?></th>
                                        <th><?= _lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

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
            'add_home_slider': lang.add_home_slider,
            'edit_home_slider': lang.edit_home_slider,
            messages: {
                first_title_en: {
                    required: lang.required
                },
                second_title_en: {
                    required: lang.required
                },
                desc_en: {
                    required: lang.required

                },
                this_order: {
                    required: lang.required

                }
            }
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('home_slider.js');
?>
