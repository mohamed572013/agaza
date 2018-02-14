
<!--Layout Script start -->
<script type="text/javascript" src="assets/admin/ltr/js/color.js"></script>
<script type="text/javascript" src="assets/admin/ltr/js/lib/jquery-1.11.min.js"></script>
<script type="text/javascript" src="assets/admin/ltr/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/admin/ltr/js/multipleAccordion.js"></script>
<link rel="stylesheet" href="assets/admin/ltr/css/plugins/accordion.css">

<!--jqueryui for table start-->
<script src="assets/admin/ltr/js/jquery-ui.min.js"></script>
<!--jqueryui for table end-->


<!--easing Library Script Start -->
<script src="assets/admin/ltr/js/lib/jquery.easing.js"></script>
<!--easing Library Script End -->

<!--Nano Scroll Script Start -->
<script src="assets/admin/ltr/js/jquery.nanoscroller.min.js"></script>
<!--Nano Scroll Script End -->

<!--switchery Script Start -->
<script src="assets/admin/ltr/js/switchery.min.js"></script>
<!--switchery Script End -->

<!--bootstrap switch Button Script Start-->
<script src="assets/admin/ltr/js/bootstrap-switch.js"></script>
<!--bootstrap switch Button Script End-->

<!--easypie Library Script Start -->
<script src="assets/admin/ltr/js/jquery.easypiechart.min.js"></script>
<!--easypie Library Script Start -->

<!--bootstrap-progressbar Library script Start-->
<script src="assets/admin/ltr/js/bootstrap-progressbar.min.js"></script>
<!--bootstrap-progressbar Library script End-->

<!--Layout Script End -->

<script type="text/javascript" src="assets/admin/rtl/js/pages/layout.js"></script>


<!--Drag & Drop & Sort  table start-->
<script src="assets/admin/ltr/js/tsort.js"></script>
<script src="assets/admin/ltr/js/jquery.tablednd.js"></script>
<script src="assets/admin/ltr/js/jquery.dragtable.js"></script>
<!--Drag & Drop & Sort table end-->

<!--Editable-table Start-->
<!--<script src="assets/admin/ltr/js/editable-table/jquery.dataTables.js"></script>-->
<script src="assets/admin/ltr/js/editable-table/jquery.validate.js"></script>
<script src="assets/admin/ltr/js/editable-table/jquery.jeditable.js"></script>
<!--<script src="assets/admin/ltr/js/editable-table/jquery.dataTables.editable.js"></script>-->
<!--Editable-table Finish -->

<script src="assets/admin/ltr/js/bootstrap-progressbar.min.js"></script>

<!--Demo table script start-->
<script src="assets/admin/ltr/js/pages/table.js"></script>
<script src="assets/admin/ltr/js/jquery-extend.js"></script>
<script src="assets/admin/ltr/js/admin.js"></script>
<!--Demo table script end-->
<script src="assets/admin/ltr/js/selectize.min.js"></script>
<script src="assets/admin/ltr/js/pages/selectTag.js"></script>



<link href="assets/admin/shared/css/rtl-css/plugins/amaranjs/jquery.amaran-rtl.css" rel="stylesheet">
<link href="assets/admin/shared/css/rtl-css/plugins/amaranjs/theme/awesome-rtl.css" rel="stylesheet">
<link href="assets/admin/shared/css/rtl-css/plugins/amaranjs/theme/all-themes-rtl.css" rel="stylesheet">
<link href="assets/admin/shared/css/rtl-css/plugins/amaranjs/theme/default-rtl.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/admin/shared/css/jquery-confirm.css" />
<script src="assets/admin/shared/js/jquery.amaran.js"></script>
<script type="text/javascript" src="assets/admin/shared/js/jquery-confirm.js"></script>
<script type="text/javascript" src="assets/admin/rtl/js/bootbox.min.js"></script>
<script type="text/javascript" src="assets/admin/rtl/js/bootstrap-confirmation.min.js"></script>

<!--<script type="text/javascript" src="assets/admin/rtl/js/dataTables.bootstrap.js"></script>-->
<script type="text/javascript" src="assets/admin/rtl/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/admin/rtl/js/select2.min.js"></script>
<script type="text/javascript" src="assets/admin/rtl/js/toastr.js"></script>
<script type="text/javascript" src="assets/admin/rtl/js/app.js"></script>
<script type="text/javascript" src="assets/admin/rtl/js/jquery-confirm.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/admin/notifications/getLastNotifications",
                success: function(msg) {
                    $("#notifications-block").html(msg);
                }
        });
        setInterval(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/admin/notifications/getLastNotifications",
                success: function(msg) {
                    $("#notifications-block").html(msg);
                }
            });
        }, 10000);
    });
</script>


<style>
    .serial{
        width: 20px;
    }
</style>
</body>
</html>


<!--<script type="text/javascript">
        CKEDITOR.replace('body_ar');
</script>
<script type="text/javascript">
        CKEDITOR.replace('about_omera_partner');
</script>-->

<?php
    global $_require;
    if (!empty($_require)) {
        foreach ($_require as $key => $value) {
            if ($key == 'js') {
                $path = 'assets/admin/rtl/js';
            }
            if ($key == 'css') {
                $path = 'assets/admin/rtl/css';
            }
            foreach ($value as $file) {
                echo '<script src="' . base_url($path . '/' . $file) . '"></script>';
            }
        }
    }
?>