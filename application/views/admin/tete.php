
<nav class="navbar-bottom">
    <div class="container-fluid">
        <h5 style="text-align: center;line-height: 45px;direction: ltr;font-size: 14px; color:#fff; margin: 0;">
            Copyright © 2016 , Powered By <a target="_blank" href="http://www.mv-is.com" title="Master Vision"><img src="<?php echo \base_url() ?>/assets/copyrightlogoblack.png" style="width: 10%;"> <span style="color: #F6921B;"> Master Vision</span>   </a>  Integrated Solutions All rights reserved.
        </h5>
        <!--<h2 style="display: none; text-align: center;line-height: 45px;direction: ltr;font-size: 14px; color:#fff;">Developed by Mahmoud Ramadan Awad </h2>-->
    </div>
</nav>
<!--Page main section end -->
<!--Right hidden  section start-->

<!--Right hidden  section end -->
<!--<div id="change-color">
        <div id="change-color-control">
                <a href="javascript:void(0)"><i class="fa fa-magic"></i></a>
        </div>
        <div class="change-color-box">
                <ul>
                        <li class="default active"></li>
                        <li class="red-color"></li>
                        <li class="blue-color"></li>
                        <li class="light-green-color"></li>
                        <li class="black-color"></li>
                        <li class="deep-blue-color"></li>
                </ul>
        </div>
</div>-->
</section>



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
<script src="assets/admin/ltr/js/editable-table/jquery.dataTables.js"></script>
<script src="assets/admin/ltr/js/editable-table/jquery.validate.js"></script>
<script src="assets/admin/ltr/js/editable-table/jquery.jeditable.js"></script>
<script src="assets/admin/ltr/js/editable-table/jquery.dataTables.editable.js"></script>
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
<style>
    .serial{
        width: 20px;
    }
</style>
</body>
</html>



<script type="text/javascript">



        var oTable = $('#data-table').dataTable({
            "order": [[0, "desc"]],
            "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
            "oTableTools": {
                "sSwfPath": "<?php echo base_url() ?>theme/assets/js/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
            },
            "fnDrawCallback": function () {
                if ($("#insert_btn").length > 0) {
                    reclick();
                }
                if ($(".edit-btn").length > 0) {
                    edit_model();
                }
                delete_action();
            },
        });

        $('.data-table').dataTable({
            "order": [[0, "desc"]],
            "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
            "oTableTools": {
                "sSwfPath": "<?php echo base_url() ?>theme/assets/js/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
            }
        });

        $('#data-table-2').dataTable({
            //"aoColumns": [{ "bSortable": false },{ "bSortable": false }],
            "order": [[0, "desc"]],
            "sPaginationType": "full_numbers",
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [0]}
            ],
            "aLengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "الكل"]],
            "iDisplayLength": 10,
            "fnDrawCallback": function () {
                $('input.icheck-blue').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue',
                    increaseArea: '20%' // optional
                });

                //When unchecking the checkbox
                $("#check-all").on('ifUnchecked', function (event) {
                    //Uncheck all checkboxes
                    $(".select_pil").iCheck("uncheck");
                });

                //When checking the checkbox
                $("#check-all").on('ifChecked', function (event) {
                    //Check all checkboxes
                    $(".select_pil").iCheck("check");
                });
            }

        });

        $('#data-table-part-2').dataTable({
            "order": [[0, "desc"]],
            "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
            "oTableTools": {
                "sSwfPath": "<?php echo base_url() ?>theme/assets/js/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
            }
        });

        $('#data-table-part-3').dataTable({
            "order": [[0, "desc"]],
            "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
            "oTableTools": {
                "sSwfPath": "<?php echo base_url() ?>theme/assets/js/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
            }
        });

        if ($('[data-toggle="tooltip"]').length > 0) {
            $('[data-toggle="tooltip"]').tooltip();
        }






</script>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
        CKEDITOR.replace('body_ar');
</script>
<script type="text/javascript">
        CKEDITOR.replace('about_omera_partner');
</script>
<script type="text/javascript">
        var Users = function () {

            var handleChangeCompany = function () {
                $('#branches_id').on('change', function () {
                    var company_id = $(this).val();
                    var action = config.admin_url + '/users/getBranches';
                    $.ajax({
                        url: action,
                        async: false,
                        data: {company_id: company_id},
                        success: function (data) {
                            console.log(data);
                            var html = '';
                            if (data.type == 'success') {

                                for (var x = 0; x < data.data.length; x++) {
                                    html += '<option value="' + data.data[x].id + '">' + data.data[x].title_ar + '</option>'
                                }

                            } else {
                                alert('npo');
                                html += '<option vlaue="ss">ssss</option>';

                            }
                            $('departments_id').html('<option vlaue="ss">ssss</option>');
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            bootbox.dialog({
                                message: xhr.responseText,
                                title: 'alert',
                                buttons: {
                                    danger: {
                                        label: 'close',
                                        className: "red"
                                    }
                                }
                            });
                        },
                        dataType: "json",
                        type: "POST"
                    });

                });
            }

            return{
                init: function () {
                    // handleChangeCompany();
                }

            };
        }();
        $(document).ready(function () {
            Users.init();
        });
        var Departments = function () {

            var handleChangeAddToRadio = function () {
                $('.addToTypeRadio').on('change', function () {
                    alert($(this).val());
                    var type = $(this).val();
                    if (type == 'other') {


                        if ($('#user_type').val() == 'super admin') {
                            $('.branches-box').slideDown(500);
                        }
                        if ($('#user_type').val() == 'owner') {
                            $('.branches-box').slideDown(500, function () {

                                $('.departments-box').slideDown(500);
                            });
                        }
                    }
                    if (type == 'me') {
                        var branches_id = $("#current_user_company_id").val();
                        $.ajax({
                            type: "post",
                            url: "<?= base_url("Ajax/gatBranchesDepartments") ?>",
                            data: {branches_id: branches_id},
                            success: function (data) {
                                $("#departments_id").html(data);

                            }
                        });
                        if ($('#user_type').val() == 'super admin') {
                            $('.branches-box').slideUp(500);
                        }
                        if ($('#user_type').val() == 'owner') {
                            $('.branches-box').slideUp(500, function () {

                                $('.departments-box').slideDown(500);
                            });
                        }


//                        if ($('#user_type').val() == 'super admin') {
//                            $('.branches-box').slideUp(500, function () {
//
//                                $('.departments-box').slideDown(500);
//
//                            });
//                        }
//                        if ($('#user_type').val() == 'owner') {
//                            $('.branches-box').slideDown(500);
//                        }
                    }
                });
            }

            return{
                init: function () {
                    handleChangeAddToRadio();
                }

            };
        }();
        $(document).ready(function () {
            Departments.init();
        });
</script>