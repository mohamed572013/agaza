
<!--Page main section start-->
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <!--Top breadcrumb start -->
                    <ol class="breadcrumb">
                        <li> <i class="fa fa-home"></i> </li>
                        <li> <?php echo $lang['basic_data']; ?></li>
                        <li class="active"><a href="<?= \base_url('admin/hotels_reservation/show') ?>"><?= $lang['reservation']; ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['reservation']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table">
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('serial'); ?></th>
<!--                                            <th> كود الاستمارة</th>
                                            <th> كود البرنامج </th>-->
                                            <th> اسم البرنامج </th>
                                            <th> الشركة </th>
                                            <th>تأكيد الحجز</th>
                                            <th>إلغاء الحجز</th>
                                            <th> تاريخ الوصول </th>
                                            <th>تاريخ الرحيل </th>
                                            <th><?= _lang('options'); ?></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            <!--Table Wrapper Finish-->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</section>

<?php
    global $_require;
    $_require['js'] = array('hotels_reservation.js');
?>