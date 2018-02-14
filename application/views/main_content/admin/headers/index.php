<style>
    .help-block{
        margin-bottom: 0;
    }
</style>
<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditHeaderImage" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHeaderImageLabel">Header Image</h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHeaderImageForm"  enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="0">


                    <div class="row">


                        <div class="form-group ">
                            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize">الصفحة</label>
                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                                <select class="form-control"   name="page" id="page">
                                    <option selected disabled>اختر الصفحة </option>
                                    <option <?php
                                    if (!empty($pages_array) && in_array("restaurants", $pages_array)) {
                                        echo 'disabled';
                                    }
                                    ?> value="restaurants">المطاعم</option>
                                    <option  <?php
                                    if (!empty($pages_array) && in_array("shops", $pages_array)) {
                                        echo 'disabled';
                                    }
                                    ?>  value="shops">التسوق والترفية</option>
                                    <option  <?php
                                    if (!empty($pages_array) && in_array("programs", $pages_array)) {
                                        echo 'disabled';
                                    }
                                    ?>  value="programs">البرامج</option>
                                    <option  <?php
                                    if (!empty($pages_array) && in_array("destinations", $pages_array)) {
                                        echo 'disabled';
                                    }
                                    ?> value="destinations">المزارات</option>
                                    <option  <?php
                                    if (!empty($pages_array) && in_array("clients", $pages_array)) {
                                        echo 'disabled';
                                    }
                                    ?> value="clients">شركاؤنا</option>
                                    <option <?php
                                    if (!empty($pages_array) && in_array("etiquette", $pages_array)) {
                                        echo 'disabled';
                                    }
                                    ?>  value="etiquette">الإتيكيت</option>
                                    <option <?php
                                    if (!empty($pages_array) && in_array("news", $pages_array)) {
                                        echo 'disabled';
                                    }
                                    ?>  value="news">الأخبار</option>
                                    <option  <?php
                                    if (!empty($pages_array) && in_array("contact", $pages_array)) {
                                        echo 'disabled';
                                    }
                                    ?> value="contact">اتصل بنا</option>
                                    <option <?php
                                    if (!empty($pages_array) && in_array("about", $pages_array)) {
                                        echo 'disabled';
                                    }
                                    ?>  value="about">من نحن</option>
                                    <option <?php
                                    if (!empty($pages_array) && in_array("transportations", $pages_array)) {
                                        echo 'disabled';
                                    }
                                    ?>  value="transportations">النقل السياحى</option>


                                </select>
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان الأول </label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="first_title_ar" name="first_title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العنوان الثانى </label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="text" class="form-control" id="second_title_ar" name="second_title_ar" value="">
                                <div class="help-block"></div>
                            </div>
                        </div>


                    </div>

                    <div class="row">


                        <div class="form-group col-md-6">

                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['image']; ?></label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="file" class="form-control" id="header_image" name="header_image"  >
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
                        <li class="active"><a href="javascript:;"><?= _lang('header_image'); ?></a></li>
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
                            <a href="" class="panel-title places_btn" data-id="0"><?= _lang('header_image'); ?></a>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->

                            <?php if (count($pages_array) < 10) { ?><a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="header_image.add(); return false;">اضافة جديد</a><?php } ?>
                            <table class="table dataTable table-bordered table-striped table-bottomless">
                                <thead>
                                    <tr>
                                        <th>العنوان الأول</th>
                                        <th>العنوان الثانى</th>
                                        <th><?= _lang('page'); ?></th>
                                        <th><?= _lang('image'); ?></th>
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

<?php
global $_require;
$_require['js'] = array('header_image.js');
?>
