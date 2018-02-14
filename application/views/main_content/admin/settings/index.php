<!--Page main page start-->
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!--Top header start-->
                    <h3 class="ls-top-header"><a href="<?= \base_url('admin/settings') ?>"><?= $lang['site_settings']; ?></a></h3>
                    <!--Top header end -->

                    <!--Top breadcrumb start -->
                    <ol class="breadcrumb">
                        <li><a href="<?= \base_url('admin/') ?>"><i class="fa fa-home"></i></a></li>
                        <li class="active"><a href="<?= \base_url('admin/settings') ?>"><?= $lang['site_settings']; ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-capitalize"><?= $lang['site_settings_edit']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php if (!empty($error)) { ?>
                                    <div class="alert alert-danger">
                                        <?= $error; ?>
                                    </div>
                                <?php } ?>
                            <!--Table Wrapper Start-->

                            <form action="" method="post" class="form-horizontal ls_form" id="settings_form">
                                <!--<form   method="post" class="form-horizontal ls_form" id="form_masa">-->


                                <!-- Nav tabs -->
                                <!--                                <ul class="nav nav-tabs nav-justified icon-tab">
                                                                    <li class="active text-capitalize settings_edit_tab"><a href="#site_settings_edit" id="site_settings_edit_tab" data-toggle="tab"><i class="fa fa-home"></i> <span><?= $lang['site_settings_edit']; ?></span></a></li>
                                                                    <li class=" text-capitalize"><a href="#smtp_setting" data-toggle="tab"><i class="fa fa-envelope-o"></i> <span><?= $lang['smtp_setting']; ?></span></a></li>
                                                                    <li class=" text-capitalize settings_edit_tab"><a href="#pages_settings" id="pages_settings_tab" data-toggle="tab"><i class="fa fa-envelope-o"></i> <span><?= $lang['social_media']; ?></span></a></li>
                                                                </ul>-->

                                <!-- Tab panes -->
                                <div class="tab-content tab-border container-fluid">


                                    <!-- Site Settings -->



                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">اسم الموقع بالعربية</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="site_title_ar" name="site_title_ar" value="<?php if (isset($settings->site_title_ar)) echo $settings->site_title_ar; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">اسم الموقع بالإنجليزية</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="site_title_en" name="site_title_en" value="<?php if (isset($settings->site_title_en)) echo $settings->site_title_en; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">الموبايل</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="site_phone" name="site_phone" value="<?php if (isset($settings->site_phone)) echo $settings->site_phone; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">البريد الإلكترونى</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="site_email" name="site_email" value="<?php if (isset($settings->site_email)) echo $settings->site_email; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">العنوان بالعربية</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="address_ar" name="address_ar" value="<?php if (isset($settings->address_ar)) echo $settings->address_ar; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">العنوان بالإنجليزية</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="address_ar" name="address_en" value="<?php if (isset($settings->address_en)) echo $settings->address_en; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['desc_ar']; ?></label>
                                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                            <textarea rows="5" class="form-control" name="site_desc_ar" id="site_desc_ar"><?php if (isset($settings->site_desc_ar)) echo $settings->site_desc_ar; ?></textarea>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['desc_en']; ?></label>
                                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                            <textarea rows="5" class="form-control" name="site_desc_en" id="site_desc_en"><?php if (isset($settings->site_desc_en)) echo $settings->site_desc_en; ?></textarea>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['keywords_ar']; ?></label>
                                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                            <textarea rows="5" class="form-control" name="keywords_ar" id="keywords_ar"><?php if (isset($settings->keywords_ar)) echo $settings->keywords_ar; ?></textarea>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['keywords_en']; ?></label>
                                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                            <textarea rows="5" class="form-control" name="keywords_en" id="keywords_en"><?php if (isset($settings->keywords_en)) echo $settings->keywords_en; ?></textarea>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>




                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">رسالة اغلاق الموقع بالعربية</label>
                                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                            <textarea rows="5" class="form-control" name="site_close_message_ar" id="site_close_message_ar"><?php if (isset($settings->site_close_message_ar)) echo $settings->site_close_message_ar; ?></textarea>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">رسالة اغلاق الموقع بالإنجليزية</label>
                                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                            <textarea rows="5" class="form-control" name="site_close_message_en" id="site_close_message_en"><?php if (isset($settings->site_close_message_en)) echo $settings->site_close_message_en; ?></textarea>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">FaceBook</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="site_contacts_facebook" name="site_contacts[facebook]" value="<?php if (isset($settings->site_contacts->facebook)) echo $settings->site_contacts->facebook; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Twitter</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="site_contacts_twitter" name="site_contacts[twitter]" value="<?php if (isset($settings->site_contacts->twitter)) echo $settings->site_contacts->twitter; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Google</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="site_contacts_google" name="site_contacts[google]" value="<?php if (isset($settings->site_contacts->google)) echo $settings->site_contacts->google; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Pinterest</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="site_contacts_pinterest" name="site_contacts[pinterest]" value="<?php if (isset($settings->site_contacts->pinterest)) echo $settings->site_contacts->pinterest; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Vimeo</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="site_contacts_vimeo" name="site_contacts[vimeo]" value="<?php if (isset($settings->site_contacts->vimeo)) echo $settings->site_contacts->vimeo; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Linkedin</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="site_contacts_linkedin" name="site_contacts[linkedin]" value="<?php if (isset($settings->site_contacts->linkedin)) echo $settings->site_contacts->linkedin; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Dribbble</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="site_contacts_dribbble" name="site_contacts[dribbble]" value="<?php if (isset($settings->site_contacts->dribbble)) echo $settings->site_contacts->dribbble; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row form-box">
                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Youtube</label>
                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                            <input type="text" class="form-control" id="site_contacts_youtube" name="site_contacts[youtube]" value="<?php if (isset($settings->site_contacts->youtube)) echo $settings->site_contacts->youtube; ?>">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    <div class="form-group text-center">
                                        <button class="btn btn-sm btn-success submit-form" type="submit"><?= $lang['save_data']; ?></button>
                                    </div>




                                </div>

                                <br>
                                <div class="col-lg-12" id="form_error">

                                </div>



                            </form>

                            <!--Table Wrapper Finish-->
                        </div>
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
                site_title_ar: {
                    required: 'ادخل اسم الموقع بالعربية'

                },
                site_title_en: {
                    required: 'ادخل اسم الموقع بالإنجليزية'

                },
                site_phone: {
                    required: 'ادخل رقم التليفون'

                },
                site_email: {
                    required: 'ادخل البريد الإلكترونى'

                },
                address_ar: {
                    required: 'ادخل العنوان بالعربية'

                },
                address_en: {
                    required: 'ادخل العنوان بالإنجليزية'

                },
                site_desc_ar: {
                    required: 'ادخل الوصف بالعربية'

                },
                site_desc_en: {
                    required: 'ادخل الوصف بالإنجليزية'

                },
                keywords_ar: {
                    required: 'ادخل الكلمات الدلالية بالعربية'

                },
                keywords_en: {
                    required: 'ادخل الكلمات الدلالية بالإنجليزية'

                },
                site_close_message_ar: {
                    required: 'ادخل رسالة اغلاق الموقع بالعربية'

                },
                site_close_message_en: {
                    required: 'ادخل رسالة اغلاق الموقع بالإنجليزية'

                },
            }
        }
</script>
<?php
    global $_require;
    $_require['js'] = array('settings.js');
?>