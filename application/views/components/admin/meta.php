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
<title><?= $settings->site_title_ar ?></title>


<link rel="shortcut icon" href="<?= base_url() ?>img/favicon.ico" type="image/x-icon">

<?php
    if ($this->_settings->site_language == "arabic") {
        ?>
        <link rel="stylesheet" href="<?= base_url() ?>assets/admin/rtl/css/rtl-css/plugins/summernote-rtl.css">
        <!-- TODO: Add a favicon -->
        


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
        <link href="<?= base_url() ?>assets/admin/rtl/css/toastr.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/admin/rtl/css/jquery.dataTables.min.css" >
        <link href="<?php echo base_url(); ?>assets/admin/rtl/js/media/css/dataTables.bootstrap.css"  rel="stylesheet" type="text/css">
        <!-- <link href="<?php echo base_url(); ?>assets/admin/rtl/js/extensions/Editor/css/dataTables.editor.css" rel="stylesheet" type="text/css" >
        <link href="<?php echo base_url(); ?>assets/admin/rtl/js/extensions/ColReorder/css/dataTables.colReorder.min.css" >-->





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
<link rel="stylesheet" href="assets/admin/rtl/css/select2.min.css">
<link rel="stylesheet" href="assets/admin/rtl/css/jquery-confirm.min.css">
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