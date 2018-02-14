
<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="<?php echo \base_url(); ?>">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="HandheldFriendly" content="true" />
		<meta name="MobileOptimized" content="320" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black" />
		<link rel="apple-touch-icon-precomposed" href="assets/admin/ltr/images/ios/fickle-logo-72.png" />
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/admin/ltr/images/ios/fickle-logo-72.png" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/admin/ltr/images/ios/fickle-logo-114.png" />
		<link rel="shortcut icon" href="assets/admin/ltr/images/ico/fab.ico">
		<link rel="stylesheet" href="assets/admin/ltr/css/plugins/pace.css">
		<script src="assets/admin/ltr/js/pace.min.js"></script>
		<link href="assets/admin/ltr/css/bootstrap.css" rel="stylesheet">
		<link href="assets/admin/ltr/css/plugins/bootstrap-switch.min.css" rel="stylesheet">
		<link href="assets/admin/ltr/css/plugins/ladda-themeless.min.css" rel="stylesheet">
		<link href="assets/admin/ltr/css/plugins/humane_themes/bigbox.css" rel="stylesheet">
		<link href="assets/admin/ltr/css/plugins/humane_themes/libnotify.css" rel="stylesheet">
		<link href="assets/admin/ltr/css/plugins/humane_themes/jackedup.css" rel="stylesheet">
		<link href="assets/admin/ltr/css/style.css" rel="stylesheet">
		<link href="assets/admin/ltr/css/responsive.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/admin/rtl/css/rtl-css/custom.css">

		<title><?= $lang['login']; ?></title>
	</head>
	<body class="login-screen">
		<section>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="login-box">
							<?php if (isset($error)) { ?>
									<div class="alert alert-danger">
										<?= $error; ?>
									</div>
								<?php } ?>
							<div class="login-content">
<!--
								<div class="login-user-icon">
									<i class="glyphicon glyphicon-user"></i>

								</div>
-->
                                
                                <img src="assets/admin/rtl/images/maslogo.png" alt="mas" class="img-responsive">
								<h3><?= $lang['login']; ?></h3>
							</div>



							<div class="login-form">
								<form id="form-login" action="admin/login" method="post" class="form-horizontal ls_form">
									<div class="input-group ls-group-input">
										<input class="form-control" name="user_name" type="text" placeholder="<?= $lang['user_name']; ?>">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
									</div>

									<div class="input-group ls-group-input">
										<input type="password" placeholder="<?= $lang['user_password']; ?>" name="user_password" class="form-control" value="">
										<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									</div>

<!--									<div class="remember-me">
										<input class="switchCheckBox" type="checkbox" checked data-size="mini" data-on-text="<i class='fa fa-check'><i>" data-off-text="<i class='fa fa-times'><i>">
										<span><?= $lang['remember_me']; ?></span>
									</div>-->

									<div class="input-group ls-group-input login-btn-box">
										<button class="btn ls-dark-btn ladda-button col-md-12 col-sm-12 col-xs-12" data-style="slide-down">
											<span class="ladda-label"><i class="fa fa-key"></i></span>
										</button>

										<!--<a class="forgot-password" href="javascript:void(0)"><?= $lang['forgot_password']; ?></a>-->
									</div>
								</form>
							</div>
							<div class="forgot-pass-box">
								<form action="#" class="form-horizontal ls_form">
									<div class="input-group ls-group-input">
										<input class="form-control" type="text" placeholder="someone@mail.com">
										<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
									</div>
									<div class="input-group ls-group-input login-btn-box">
										<button class="btn ls-dark-btn col-md-12 col-sm-12 col-xs-12">
											<i class="fa fa-rocket"></i> Send
										</button>

										<a class="login-view" href="javascript:void(0)"><?= $lang['login']; ?></a>

									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
            
            
           



            
			<p class="copy-right big-screen hidden-xs hidden-sm">
                <a target="_blank" href="http://www.mv-is.com/">Powered By MASTER VISION Integrated Solutions <span>&#169;</span> Master Vision <span class="footer-year">2016</span></a> <a target="_blank" href="http://www.mv-is.com"><img src="assets/copyrightlogoblack.png" alt="" title=""></a>
				
			</p>
		</section>
	</body>
	<script src="assets/admin/ltr/js/lib/jquery-2.1.1.min.js"></script>
	<script src="assets/admin/ltr/js/lib/jquery.easing.js"></script>
	<script src="assets/admin/ltr/js/bootstrap-switch.min.js"></script>
	<!--Script for notification start-->
	<script src="assets/admin/ltr/js/loader/spin.js"></script>
	<script src="assets/admin/ltr/js/loader/ladda.js"></script>
	<script src="assets/admin/ltr/js/humane.min.js"></script>
	<!--Script for notification end-->
	<script src="assets/admin/ltr/js/pages/login.js"></script>
</html>