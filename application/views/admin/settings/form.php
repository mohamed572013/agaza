<!--Page main page start-->
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!--Top header start-->
                    <h3 class="ls-top-header"><a href="<?= \base_url('admin/settings/home') ?>"><?= $lang['site_settings']; ?></a></h3>
                    <!--Top header end -->

                    <!--Top breadcrumb start -->
                    <ol class="breadcrumb">
                        <li><a href="<?= \base_url('admin/') ?>"><i class="fa fa-home"></i></a></li>
                        <li class="active"><a href="<?= \base_url('admin/settings/home') ?>"><?= $lang['site_settings']; ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <?php
                $action = '/add';
                if ($view_type != 'add') {
                    if (isset($_id)) {
                        $action = '/edit/' . $_id;
                    }
                }
            ?>

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
                            <?php if ($user_type == 'owner') { ?>
                                    <form action="<?= \base_url('admin/settings/home'); ?>" method="post" class="form-horizontal ls_form" id="form_masa">
                                        <!--<form   method="post" class="form-horizontal ls_form" id="form_masa">-->


                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-justified icon-tab">
                                            <li class="active text-capitalize"><a href="#site_settings_edit" data-toggle="tab"><i class="fa fa-home"></i> <span><?= $lang['site_settings_edit']; ?></span></a></li>
                                            <!--<li class=" text-capitalize"><a href="#smtp_setting" data-toggle="tab"><i class="fa fa-envelope-o"></i> <span><?= $lang['smtp_setting']; ?></span></a></li>-->
                                            <li class=" text-capitalize"><a href="#pages_settings" data-toggle="tab"><i class="fa fa-envelope-o"></i> <span><?= $lang['social_media']; ?></span></a></li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content tab-border container-fluid">
                                            <br>
                                            <br>

                                            <!-- Site Settings -->
                                            <div class="tab-pane fade active in" id="site_settings_edit">
                                                <div class="form-group row form-box">
                                                    <?php echo $msg; ?>
                                                </div>
                                                <!--										<div class="form-group row form-box">
                                                                                                                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['site_close']; ?></label>
                                                                                                                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 form-inline">
                                                                                                                                                <select class="form-control" id="site_close" name="site_close">
                                                                                                                                                        <option value="1"<?php if (isset($edit->site_close) && $edit->site_close == '1') echo 'selected=""'; ?>><?= $lang['yes']; ?></option>
                                                                                                                                                        <option value="0"<?php if (isset($edit->site_close) && $edit->site_close == '0') echo 'selected=""'; ?>><?= $lang['no']; ?></option>
                                                                                                                                                </select>
                                                                                                                                        </div>
                                                                                                                                </div>

                                                                                                                                <div class="form-group row form-box">
                                                                                                                                        <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['site_language']; ?></label>
                                                                                                                                        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 form-inline">
                                                                                                                                                <select class="form-control" id="site_language" name="site_language">
                                                <?php
                                                foreach ($lang_list as $key => $value) {
                                                    ?>
                                                                                                                                                                                                                    <option value="<?= $value ?>"<?php if (isset($edit->site_language) && $edit->site_language == $value) echo 'selected=""'; ?>><?= $key ?></option>
                                                    <?php
                                                }
                                                ?>
                                                                                                                                                </select>
                                                                                                                                        </div>
                                                                                                                                </div>-->


                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['site_name_ar']; ?></label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="<?php if (isset($edit->title_ar)) echo $edit->title_ar; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">site phone</label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                        <input type="text" class="form-control" id="site_phone" name="site_phone" value="<?php if (isset($edit->site_phone)) echo $edit->site_phone; ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['site_url']; ?></label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                        <input type="text" class="form-control" id="site_url" name="site_url" value="<?php if (isset($edit->site_url)) echo $edit->site_url; ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['site_mail']; ?></label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                        <input type="text" class="form-control" id="site_mail" name="site_mail" value="<?php if (isset($edit->site_mail)) echo $edit->site_mail; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">العنوان</label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                        <input type="text" class="form-control" id="address" name="address" value="<?php if (isset($edit->address)) echo $edit->address; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">عن الموقع </label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                        <input type="text" class="form-control" id="about_us_footer" name="about_us_footer" value="<?php if (isset($edit->about_us_footer)) echo $edit->about_us_footer; ?>">
                                                    </div>
                                                </div>



                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">About omera partner</label>
                                                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                        <textarea rows="5" class="form-control" name="about_omera_partner" required="required" id="about_omera_partner"><?php if (isset($edit->about_omera_partner)) echo $edit->about_omera_partner;else if (isset($_POST['about_omera_partner'])) echo xss_clean($_POST['about_omera_partner']); ?></textarea>
                                                    </div>
                                                </div>


                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['desc_ar']; ?></label>
                                                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                        <textarea rows="5" class="form-control" name="desc_ar" id="desc_ar"><?php if (isset($edit->desc_ar)) echo $edit->desc_ar; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['keywords_ar']; ?></label>
                                                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                        <textarea rows="5" class="form-control" name="keywords_ar" id="keywords_ar"><?php if (isset($edit->keywords_ar)) echo $edit->keywords_ar; ?></textarea>
                                                    </div>
                                                </div>




                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['site_msg']; ?></label>
                                                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                        <textarea rows="5" class="form-control" name="site_msg" id="site_msg"><?php if (isset($edit->site_msg)) echo $edit->site_msg; ?></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <!--				<div class="tab-pane fade" id="smtp_setting">



                                                                                    <div class="form-group row form-box">
                                                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['smtp_host']; ?></label>
                                                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                                                    <input type="text" class="form-control" id="smtp_host" name="smtp_host" value="<?php if (isset($edit->smtp_host)) echo $edit->smtp_host; ?>">
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="form-group row form-box">
                                                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['smtp_port']; ?></label>
                                                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                                                    <input type="text" class="form-control" id="smtp_port" name="smtp_port" value="<?php if (isset($edit->smtp_port)) echo $edit->smtp_port; ?>">
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="form-group row form-box">
                                                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['smtp_username']; ?></label>
                                                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                                                    <input type="text" class="form-control" id="smtp_username" name="smtp_username" value="<?php if (isset($edit->smtp_username)) echo $edit->smtp_username; ?>">
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="form-group row form-box">
                                                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['smtp_password']; ?></label>
                                                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                                                    <input type="text" class="form-control" id="smtp_password" name="smtp_password" value="<?php if (isset($edit->smtp_password)) echo $edit->smtp_password; ?>">
                                                                                            </div>
                                                                                    </div>

                                                                            </div>

                                            -->
                                            <div class="tab-pane fade" id="pages_settings">


                                                <div class="panel panel-default">
                                                    <div class="panel-heading label-red white">
                                                        <h3 class="panel-title text-capitalize"><?= $lang['site_contacts'] ?></h3>
                                                    </div>
                                                    <div class="panel-body">

                                                        <h2 class="text-center">Social Links</h2>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">FaceBook</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_facebook" name="site_contacts[facebook]" value="<?php if (isset($edit->site_contacts['facebook'])) echo $edit->site_contacts['facebook']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Twitter</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_twitter" name="site_contacts[twitter]" value="<?php if (isset($edit->site_contacts['twitter'])) echo $edit->site_contacts['twitter']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Google</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_google" name="site_contacts[google]" value="<?php if (isset($edit->site_contacts['google'])) echo $edit->site_contacts['google']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Pinterest</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_pinterest" name="site_contacts[pinterest]" value="<?php if (isset($edit->site_contacts['pinterest'])) echo $edit->site_contacts['pinterest']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Vimeo</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_vimeo" name="site_contacts[vimeo]" value="<?php if (isset($edit->site_contacts['vimeo'])) echo $edit->site_contacts['vimeo']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Linkedin</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_linkedin" name="site_contacts[linkedin]" value="<?php if (isset($edit->site_contacts['linkedin'])) echo $edit->site_contacts['linkedin']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Dribbble</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_dribbble" name="site_contacts[dribbble]" value="<?php if (isset($edit->site_contacts['dribbble'])) echo $edit->site_contacts['dribbble']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Youtube</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_youtube" name="site_contacts[youtube]" value="<?php if (isset($edit->site_contacts['youtube'])) echo $edit->site_contacts['youtube']; ?>">
                                                            </div>
                                                        </div>



                                                        <hr>





                                                    </div>
                                                </div>





                                            </div>


                                        </div>

                                        <br>
                                        <div class="col-lg-12" id="form_error">

                                        </div>


                                        <div class="form-group text-center">
                                            <button class="btn btn-sm btn-success" type="submit"><?= $lang['save_data']; ?></button>
                                        </div>

                                    </form>
                                <?php }else { ?>
                                    <form action="<?= \base_url('admin/settings/update_branches_settings'); ?>" method="post" class="form-horizontal ls_form" id="form_masa">
                                        <!--<form   method="post" class="form-horizontal ls_form" id="form_masa">-->


                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-justified icon-tab">
                                            <li class="active text-capitalize"><a href="#site_settings_edit" data-toggle="tab"><i class="fa fa-home"></i> <span><?= $lang['site_settings_edit']; ?></span></a></li>
                                            <!--<li class=" text-capitalize"><a href="#smtp_setting" data-toggle="tab"><i class="fa fa-envelope-o"></i> <span><?= $lang['smtp_setting']; ?></span></a></li>-->
                                            <li class=" text-capitalize"><a href="#pages_settings" data-toggle="tab"><i class="fa fa-envelope-o"></i> <span><?= $lang['social_media']; ?></span></a></li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content tab-border container-fluid">
                                            <br>
                                            <br>

                                            <!-- Site Settings -->
                                            <div class="tab-pane fade active in" id="site_settings_edit">
                                                <div class="form-group row form-box">
                                                    <?php echo $msg; ?>
                                                </div>

                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['site_name_ar']; ?></label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                        <input type="text" class="form-control" id="site_title" name="site_title" value="<?php if (isset($edit->site_title)) echo $edit->site_title; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">site phone</label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                        <input type="text" class="form-control" id="site_phone" name="site_phone" value="<?php if (isset($edit->site_phone)) echo $edit->site_phone; ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['site_mail']; ?></label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                        <input type="text" class="form-control" id="site_email" name="site_email" value="<?php if (isset($edit->site_email)) echo $edit->site_email; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">العنوان</label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                        <input type="text" class="form-control" id="address" name="address" value="<?php if (isset($edit->address)) echo $edit->address; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">عن الموقع </label>
                                                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                        <input type="text" class="form-control" id="about_us" name="about_us" value="<?php if (isset($edit->about_us)) echo $edit->about_us; ?>">
                                                    </div>
                                                </div>




                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['desc_ar']; ?></label>
                                                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                        <textarea rows="5" class="form-control" name="site_desc" id="site_desc"><?php if (isset($edit->site_desc)) echo $edit->site_desc; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['keywords_ar']; ?></label>
                                                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                        <textarea rows="5" class="form-control" name="keywords" id="keywords"><?php if (isset($edit->keywords)) echo $edit->keywords; ?></textarea>
                                                    </div>
                                                </div>




                                                <div class="form-group row form-box">
                                                    <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize"><?= $lang['site_msg']; ?></label>
                                                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                        <textarea rows="5" class="form-control" name="site_close_message" id="site_close_message"><?php if (isset($edit->site_close_message)) echo $edit->site_close_message; ?></textarea>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="tab-pane fade" id="pages_settings">


                                                <div class="panel panel-default">
                                                    <div class="panel-heading label-red white">
                                                        <h3 class="panel-title text-capitalize"><?= $lang['site_contacts'] ?></h3>
                                                    </div>
                                                    <div class="panel-body">

                                                        <h2 class="text-center">Social Links</h2>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">FaceBook</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_facebook" name="site_contacts[facebook]" value="<?php if (isset($site_contacts->facebook)) echo $site_contacts->facebook; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Twitter</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_twitter" name="site_contacts[twitter]" value="<?php if (isset($site_contacts->twitter)) echo $site_contacts->twitter; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Google</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_google" name="site_contacts[google]" value="<?php if (isset($site_contacts->google)) echo $site_contacts->google; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Pinterest</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_pinterest" name="site_contacts[pinterest]" value="<?php if (isset($site_contacts->pinterest)) echo $site_contacts->pinterest; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Vimeo</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_vimeo" name="site_contacts[vimeo]" value="<?php if (isset($site_contacts->vimeo)) echo $site_contacts->vimeo; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Linkedin</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_linkedin" name="site_contacts[linkedin]" value="<?php if (isset($site_contacts->linkedin)) echo $site_contacts->linkedin; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Dribbble</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_dribbble" name="site_contacts[dribbble]" value="<?php if (isset($site_contacts->dribbble)) echo $site_contacts->dribbble; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row form-box">
                                                            <label class="col-xs-12 col-sm-4 col-md-2 col-lg-2 control-label text-capitalize">Youtube</label>
                                                            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                                                                <input type="text" class="form-control" id="site_contacts_youtube" name="site_contacts[youtube]" value="<?php if (isset($site_contacts->youtube)) echo $site_contacts->youtube; ?>">
                                                            </div>
                                                        </div>



                                                        <hr>





                                                    </div>
                                                </div>





                                            </div>


                                        </div>

                                        <br>
                                        <div class="col-lg-12" id="form_error">

                                        </div>


                                        <div class="form-group text-center">
                                            <button class="btn btn-sm btn-success" type="submit"><?= $lang['save_data']; ?></button>
                                        </div>

                                    </form>
                                <?php } ?>
                            <!--Table Wrapper Finish-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Content Element  End-->

        </div>
    </div>


</section>
