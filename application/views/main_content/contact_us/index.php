

<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_contact.jpg" data-natural-width="1400" data-natural-height="420">
    <div id="sub_content_in">
        <h1>اتصل بنا</h1>
        <p>
            "لا تترد فى الاتصال باي وسيلة بنا نحن نتشرف بخدمتكم"
        </p>
    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>">الرئيسية</a>
            </li>

            <li>اتصل بنا</li>
        </ul>
    </div>
</div>
<!-- End position -->

<div class="container margin_60_30">
    <div class="row">

        <div class="col-md-9">
            <div class="box_style_general">
                <div class="indent_title_in">
                    <i class="icon_pencil-edit"></i>

                </div>
                <div class="wrapper_indent">
                    <div id="message-contact"></div>
                    <form method="post" action="" id="contact_us_form">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 pull-left">
                                <div class="form-group">
                                    <label class="control-label">الأسم الاول</label>
                                    <input type="text" class="form-control styled" id="firstname" name="firstname" placeholder="الأسم الاول">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 pull-left">
                                <div class="form-group">
                                    <label class="control-label">الأسم الأخير</label>
                                    <input type="text" class="form-control styled" id="lastname" name="lastname" placeholder="الأسم الأخير">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 pull-left">
                                <div class="form-group">
                                    <label class="control-label">البريد الإلكترونى</label>
                                    <input type="email" id="email" name="email" class="form-control styled" placeholder="البريد الإلكترونى">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 pull-left">
                                <div class="form-group">
                                    <label class="control-label">رقم الموبايل</label>
                                    <input type="text" id="mobile" name="mobile" class="form-control styled" placeholder="رقم الموبايل">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pull-left">
                                <div class="form-group">
                                    <label class="control-label">الرسالة</label>
                                    <textarea rows="5" id="message" name="message" class="form-control styled" style="height:100px;" placeholder="الرسالة"></textarea>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pull-left">
                                <input type="submit" value="ارسال" class="button add_bottom_30 submit-form" id="submit-contact" />
                            </div>
                        </div>
                        <div class="col-sm-12 loading_image_div" style="text-align:center;display: none;position: relative;">

                        </div>
                        <div class="alert-message" style="display: none;color: #3c763d;text-align:center;padding: 5px 20px 20px;">

                        </div>
                    </form>
                </div>
                <!-- End wrapper_indent -->
            </div>
            <!-- End box style 1-->
        </div>
        <!-- End col lg 9 -->
        <aside class="col-md-3">
            <h3>اتصل بنا</h3>

            <div class="contact-info">
                <div class="contact-line color-white"><i class="icon-location"></i><span><?= (!empty($settings->address_ar)) ? $settings->address_ar : '' ?></span></div>
                <div class="contact-line color-white"><i class="icon-phone"></i><a href="#"><?= (!empty($settings->site_phone)) ? $settings->site_phone : '' ?></a></div>
                <div class="contact-line color-white"><i class="icon-mail-alt"></i><a href="mailto:<?= (!empty($settings->site_email)) ? $settings->site_email : '' ?>"><?= (!empty($settings->site_email)) ? $settings->site_email : '' ?></a></div>


            </div>

            <hr class="styled">

        </aside>
        <!--End aside -->
    </div>
    <!-- End row -->
</div>
<!-- End container -->

<?php
    global $_require;
    $_require['js'] = array('contact_us.js');
?>
