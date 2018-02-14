


<img class="center-image" src="<?= base_url('img/special/bg-1.jpg') ?>" alt="">

<div class="container">
    <div class="login-fullpage">
        <div class="row">
            <div class="login-logo"><img class="center-image" src="<?= base_url('img/special/soon.jpg') ?>" alt=""></div>
            <div class="col-xs-12 col-sm-7">
                <div class="f-login-content register-box">
                    <div class="f-login-header">
                        <div class="f-login-title color-dr-blue-2">اهلا بيك معانا</div>
                        <div class="f-login-desc color-grey">يالا نسجل</div>
                        <br>
                        <br>
                        <div id="alert-message" class="f-login-desc color-grey alert-danger" style="display:none;"></div>
                        <div id="success-message" class="f-login-desc color-grey alert alert-success" style="display:none;"></div>
                    </div>
                    <form class="f-login-form" id="register-form">
                        <div class="form-group input-style-1 b-50 type-2 color-5">
                            <input type="text" class="form-control" placeholder="الاسم بالكامل" name="fullname" id="fullname">
                            <div class="help-block text-right" style="padding-right: 30px;"></div>
                        </div>
                        <div class="form-group input-style-1 b-50 type-2 color-5">
                            <input type="text" class="form-control" placeholder="البريد الاليكترونى " name="email" id="email">
                            <div class="help-block text-right" style="padding-right: 30px;"></div>
                        </div>
                        <div class="form-group input-style-1 b-50 type-2 color-5">
                            <input type="text" class="form-control" placeholder="تأكيد البريد الاليكترونى" name="email_confirmation" id="email_confirmation">
                            <div class="help-block text-right" style="padding-right: 30px;"></div>
                        </div>
                        <div class="form-group input-style-1 b-50 type-2 color-5">
                            <input type="password" class="form-control" placeholder="كلمة المرور" name="password" id="password">
                            <div class="help-block text-right" style="padding-right: 30px;"></div>
                        </div>

                        <div class="form-group input-style-1 b-50 type-2 color-5">
                            <input type="password" class="form-control" placeholder="تاكيد كلمة المرور" name="password_confirmation" id="password_confirmation">
                            <div class="help-block text-right" style="padding-right: 30px;"></div>
                        </div>

                        <input type="submit" class="login-btn c-button full b-60 bg-dr-blue-2 hv-dr-blue-2-o submit-form" value="التسجيل">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12">
                                <a href="#" class="c-button full b-60 bg-blue-7 hv-blue-7-o"><i class="fa fa-facebook"></i><span>تسجيل الدخول بالفيسبوك</span></a>
                            </div>

                        </div>

                    </form>
                </div>
                <div id="success-message" class="f-login-desc color-grey alert alert-success" style="display:none;"></div>
            </div>
        </div>
    </div>

</div>
<?php
    global $_require;
    $_require['js'] = array('register.js');
?>
