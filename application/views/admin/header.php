<!DOCTYPE html>
<html>
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
        <title>Alwesam Tours</title>




        <?php
            if ($this->_settings->site_language == "arabic") {
                ?>
                <link rel="stylesheet" href="<?= base_url() ?>assets/admin/rtl/css/rtl-css/plugins/summernote-rtl.css">
                <!-- TODO: Add a favicon -->
                <link rel="shortcut icon" href="<?= base_url() ?>images/favicon.png" />


                <!--Page loading plugin Start -->
                <link rel="stylesheet" href="<?= base_url() ?>assets/admin/rtl/css/rtl-css/plugins/pace-rtl.css">
                <script src="<?= base_url() ?>theme/assets/js/pace.min.js"></script>
                <!--Page loading plugin End   -->

                <!-- Plugin Css Put Here -->
                <link href="<?= base_url() ?>theme/assets/css/bootstrap-rtl.css" rel="stylesheet">
                <link href="<?= base_url() ?>assets/admin/rtl/css/rtl-css/style-rtl.css" rel="stylesheet">


                <!--				 Plugin Css End
                                                 Custom styles Style -->
                <link href="<?= base_url() ?>assets/admin/rtl/css/rtl-css/style-rtl.css" rel="stylesheet">
                <!--Custom styles Style End-->

                <link rel="stylesheet" href="<?= base_url() ?>assets/admin/rtl/css/rtl-css/plugins/jquery.minicolors-rtl.css">
                <link rel="stylesheet" href="<?= base_url() ?>assets/admin/rtl/css/rtl-css/plugins/jquery.datetimepicker-rtl.css">

                <!--Responsive Style For-->
                <link href="<?= base_url() ?>assets/admin/rtl/css/rtl-css/responsive-rtl.css" rel="stylesheet">
                <link rel="stylesheet" href="<?= base_url() ?>theme/assets/css/plugins/icheck/skins/all.css">
                <!--Responsive Style For-->
                <link href="<?= base_url() ?>assets/admin/rtl/css/rtl-css/plugins/amaranjs/jquery.amaran-rtl.css" rel="stylesheet">
                <link href="<?= base_url() ?>assets/admin/rtl/css/rtl-css/plugins/amaranjs/theme/all-themes-rtl.css" rel="stylesheet">
                <link href="<?= base_url() ?>assets/admin/rtl/css/rtl-css/plugins/amaranjs/theme/awesome-rtl.css" rel="stylesheet">
                <link href="<?= base_url() ?>assets/admin/rtl/css/rtl-css/plugins/amaranjs/theme/default-rtl.css" rel="stylesheet">
                <link href="<?php echo base_url(); ?>assets/admin/rtl/js/media/css/dataTables.bootstrap.css"  rel="stylesheet" type="text/css">
        <!--                <link href="<?php echo base_url(); ?>assets/admin/rtl/js/extensions/Editor/css/dataTables.editor.css" rel="stylesheet" type="text/css" >
                <link href="<?php echo base_url(); ?>assets/admin/rtl/js/extensions/ColReorder/css/dataTables.colReorder.min.css" >-->
                <link href="<?php echo base_url(); ?>assets/admin/rtl/css/jquery.dataTables.min.css" >



            <?php } else {
                ?>
                <link rel="shortcut icon" href="assets/admin/ltr/images/ico/fab.ico">


                <link rel="stylesheet" href="assets/admin/ltr/css/plugins/pace.css">
                <script src="assets/admin/ltr/js/pace.min.js"></script>

                <link href="assets/admin/ltr/css/bootstrap.css" rel="stylesheet">

                <link rel="stylesheet" href="assets/admin/ltr/css/plugins/bootstrap-progressbar-3.1.1.css">
                <link rel="stylesheet" href="assets/admin/ltr/css/plugins/dndTable.css">
                <link rel="stylesheet" href="assets/admin/ltr/css/plugins/tsort.css">

                <link href="assets/admin/ltr/css/style.css" rel="stylesheet">

                <link href="assets/admin/ltr/css/responsive.css" rel="stylesheet">

            <?php } ?>
        <link rel="stylesheet" href="assets/admin/ltr/css/plugins/selectize.bootstrap3.css">
        <link rel="stylesheet" href="assets/admin/rtl/css/rtl-css/custom.css">
        <script>
                var config = {
                    base_url: '<?php echo base_url(); ?>',
                    admin_url: '<?php echo base_url('admin'); ?>',
                };
                var lang = {
                    add_new_room_class: '<?= _lang('add_new_room_class'); ?>',
                    alert_message: '<?= _lang('alert_message'); ?>',
                    confirm_message_title: '<?= _lang('are you sure !?'); ?>',
                    deleting_cancelled: '<?= _lang('deleting_cancelled'); ?>',
                    yes: '<?= _lang('yes'); ?>',
                    no: '<?= _lang('no'); ?>',
                    error: '<?= _lang('error'); ?>',
                    try_again: '<?= _lang('try_again'); ?>',
                };

                // alert(config.lang);
        </script>
    </head>
    <body class="blue-color">
        <!--Navigation Top Bar Start-->
        <nav class="navigation">
            <div class="container-fluid">
                <!--Logo text start-->
                <div class="header-logo">
                    <a href="<?= site_url() ?>" target="_blank">
                        <h4>Best Roots</h4>
                    </a>
                </div>
                <!--Logo text End-->
                <div class="top-navigation">
                    <!--Collapse navigation menu icon start -->
                    <div class="menu-control hidden-xs">
                        <a href="javascript:void(0)">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>


                    <!--Collapse navigation menu icon end -->
                    <!--Top Navigation Start-->

                    <ul>

                        <!--						<li class="dropdown">
                                                                                Notification drop down start
                                                                                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                                                                                        <span class="fa fa-bell-o"></span>
                                                                                        <span class="badge badge-red">6</span>
                                                                                </a>

                                                                                <div class="dropdown-menu right top-notification">
                                                                                        <h4>Notification</h4>
                                                                                        <ul class="ls-feed">
                                                                                                <li>
                                                                                                        <a href="javascript:void(0)">
                                                                                                                <span class="label label-red">
                                                                                                                        <i class="fa fa-check white"></i>
                                                                                                                </span>
                                                                                                                You have 4 pending tasks.
                                                                                                                <span class="date">Just now</span>
                                                                                                        </a>
                                                                                                </li>
                                                                                                <li>
                                                                                                        <a href="javascript:void(0)">
                                                                                                                <span class="label label-light-green">
                                                                                                                        <i class="fa fa-bar-chart-o"></i>
                                                                                                                </span>
                                                                                                                Finance Report for year 2013
                                                                                                                <span class="date">30 min</span>
                                                                                                        </a>
                                                                                                </li>
                                                                                                <li>
                                                                                                        <a href="javascript:void(0)">
                                                                                                                <span class="label label-lightBlue">
                                                                                                                        <i class="fa fa-shopping-cart"></i>
                                                                                                                </span>
                                                                                                                New order received with
                                                                                                                <span class="date">45 min</span>
                                                                                                        </a>
                                                                                                </li>
                                                                                                <li>
                                                                                                        <a href="javascript:void(0)">
                                                                                                                <span class="label label-lightBlue">
                                                                                                                        <i class="fa fa-user"></i>
                                                                                                                </span>
                                                                                                                5 pending membership
                                                                                                                <span class="date">50 min</span>
                                                                                                        </a>
                                                                                                </li>
                                                                                                <li>
                                                                                                        <a href="javascript:void(0)">
                                                                                                                <span class="label label-red">
                                                                                                                        <i class="fa fa-bell"></i>
                                                                                                                </span>
                                                                                                                Server hardware upgraded
                                                                                                                <span class="date">1 hr</span>
                                                                                                        </a>
                                                                                                </li>
                                                                                                <li>
                                                                                                        <a href="javascript:void(0)">
                                                                                                                <span class="label label-blue">
                                                                                                                        <i class="fa fa-briefcase"></i>
                                                                                                                </span>
                                                                                                                IPO Report for
                                                                                                                <span class="lightGreen">2014</span>
                                                                                                                <span class="date">5 hrs</span>
                                                                                                        </a>
                                                                                                </li>
                                                                                                <li class="only-link">
                                                                                                        <a href="javascript:void(0)">View All</a>
                                                                                                </li>
                                                                                        </ul>
                                                                                </div>
                                                                                Notification drop down end
                                                                        </li>-->

                        <li>
                            <a href="<?= \base_url('admin/logout') ?>">
                                <i class="fa fa-power-off"></i>
                            </a>
                        </li>

                    </ul>
                    <ul class="breadcrumb hidden-xs" style="background: none !important;">
                        <li><a href="<?= base_url('admin') ?>"><i class="fa fa-home"></i></a></li>


                        <li>
                            <span style="color: #333">  <?= $lang['branches_name']; ?>: </span>
                            <span><?= $current_user_company->title_ar; ?></span>

                        </li>
                        <li>
                            <span style="color: #333">  <?= $lang['departments_name']; ?>: </span>
                            <span><?= $current_user_branch->title_ar; ?></span>

                        </li>
                        <li>
                            <span style="color: #333">  <?= $lang['user_name']; ?>: </span>
                            <span><?= $user_data->user_name; ?></span>

                        </li>
                    </ul>
                    <!--Top Navigation End-->
                </div>
            </div>
        </nav>

        <!--Navigation Top Bar End-->
        <section id="main-container">