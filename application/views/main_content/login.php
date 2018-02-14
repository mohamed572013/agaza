


<img class="center-image" src="<?= base_url('img/special/bg-1.jpg') ?>" alt="">

<div class="container">
    <div class="login-fullpage">
        <div class="row">
            <div class="login-logo"><img class="center-image" src="<?= base_url('img/special/login.jpg'); ?>" alt=""></div>
            <div class="col-xs-12 col-sm-7">
                <div class="f-login-content">
                    <div class="f-login-header">
                        <div class="f-login-title color-dr-blue-2">مرحبــــــــــــا</div>
                        <div class="f-login-desc color-grey">تفضل بالدخول</div>
                        <br>
                        <br>
                        <div id="alert-message" class="f-login-desc color-grey alert-danger" style="display:none;"></div>
                    </div>
                    <form class="f-login-form" id="login-form">
                        <div class="form-group input-style-1 b-50 type-2 color-5">
                            <input type="text" class="form-control" placeholder="البريد الاليكترونى " name="email" id="email">
                            <div class="help-block text-right" style="padding-right: 30px;"></div>
                        </div>
                        <div class="form-group input-style-1 b-50 type-2 color-5">
                            <input type="password" class="form-control" placeholder="كلمة المرور" name="password"  id="password" required>
                            <div class="help-block text-right" style="padding-right: 30px;"></div>
                        </div>
                        <!--                        <div class="checkbox-group">

                                                    <div class="input-entry color-3">
                                                        <input class="checkbox-form" id="remember" type="checkbox" name="remember" value="climat control">
                                                        <label class="clearfix" for="remember">
                                                            <span class="sp-check"><i class="fa fa-check"></i></span>
                                                            <span class="checkbox-text">تذكرنى</span>
                                                        </label>
                                                    </div>
                                                </div>-->
                        <input type="submit" class="login-btn c-button full b-60 bg-dr-blue-2 hv-dr-blue-2-o submit-form" value="تسجيل الدخول">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <a href="#" class="c-button full b-60 bg-blue-7 hv-blue-7-o"><i class="fa fa-facebook"></i><span>تسجيل الدخول بالفيسبوك</span></a>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <a href="<?= base_url('register') ?>" class="c-button full b-60 bg-blue-8 hv-blue-8-o"><i class="fa fa-user-plus"></i><span>حساب جديد</span></a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
    global $_require;
    $_require['js'] = array('login.js');
?>

