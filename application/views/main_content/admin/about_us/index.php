<!--Page main page start-->
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!--Top header start-->
                    <!--Top header end -->

                    <!--Top breadcrumb start -->
                    <ol class="breadcrumb">
                        <li> <i class="fa fa-home"></i> </li>
                        <li> <?php echo $lang['basic_data']; ?></li>
                        <li class="active"><a href="">من نحن</a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">من نحن</h3>
                        </div>
                        <form  enctype="multipart/form-data"  action="" method="post" class="form-horizontal ls_form form-horizontal ls_form bv-form" id="about_us_form">
                            <div class="panel-body">

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">العنوان بالعربية</label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="<?= (!empty($about_us->title_ar)) ? $about_us->title_ar : ''; ?>">
                                        <div class="help-block"></div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">العنوان بالإنجليزية</label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="title_en" name="title_en" value="<?= (!empty($about_us->title_en)) ? $about_us->title_en : ''; ?>">
                                        <div class="help-block"></div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">الوصف بالعربية</label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <textarea class="form-control" rows="5" name="desc_ar" id="desc_ar"><?= (!empty($about_us->desc_ar)) ? $about_us->desc_ar : ''; ?></textarea>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">الوصف بالإنجليزية</label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <textarea class="form-control" rows="5" name="desc_en" id="desc_en"><?= (!empty($about_us->desc_en)) ? $about_us->desc_en : ''; ?></textarea>
                                        <div class="help-block"></div>
                                    </div>
                                </div>


                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['image']; ?></label>
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                        <input type="file" class="form-control" id="about_us_image" name="about_us_image"  >
                                        <div class="help-block"></div>
                                    </div>

                                </div>
                                <div class="image_uploaded col-xs-offset-4 col-offset-sm-4 col-offset-md-4 col-offset-lg-4">
                                    <?php $image = (!empty($about_us->image)) ? base_url('uploads/about_us/' . $about_us->image) : base_url('no-image.jpg'); ?>
                                    <img src="<?= $image ?>" style="width: 170px;height: 170px;" class="about_us_image"/>
                                </div>
                                <br>


                                <div class="form-group text-center">
                                    <button class="btn btn-sm btn-success submit-form" type="submit"><?= $lang['save_data']; ?></button>
                                </div>

                                <!--Table Wrapper Finish-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Main Content Element  End-->

        </div>
    </div>



</section>
<script>
        var new_lang = {
            messages: {
                title_ar: {
                    required: 'ادخل العنوان بالعربية'

                },
                title_en: {
                    required: 'ادخل العنوان بالإنجليزية'

                },
                desc_ar: {
                    required: 'ادخل الوصف بالعربية'

                },
                desc_en: {
                    required: 'ادخل الوصف بالإنجليزية'

                }
            }
        }
</script>
<?php
    global $_require;
    $_require['js'] = array('about_us.js');
?>

