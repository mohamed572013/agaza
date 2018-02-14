<div class="modal fade" id="addEditflightReservation" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditflightReservationLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditflightReservationForm"  enctype="multipart/form-data">

                    <input type="hidden" name="id" id="id" value="0"/>
                    <div class="row">
                        <h1 class="text-center">حدد نوع الرحلة</h1>
                        <br>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-5">
                            <label>
                                <input type="radio" name="flight_type" data-type="collective" value="1" id="flight_type_collective">جماعى
                            </label>
                        </div>
                        <div  class="col-md-5">
                            <label>
                                <input type="radio" name="flight_type"  data-type="individual" id="flight_type_individual" value="2">فردى
                            </label>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row" id="individual-box-period" style="display: none;">
                        <!--                        <div class="form-group col-md-6">
                                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">من</label>
                                                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                                                        <input type="date" class="form-control" id="from_date" name="from_date">
                                                        <div class="help-block"></div>
                                                    </div>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الى</label>
                                                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                                                        <input type="date" class="form-control" id="to_date" name="to_date">
                                                        <div class="help-block"></div>
                                                    </div>

                                                </div>-->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('status'); ?></label>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <select class="form-control" name="individual_active" id="individual_active">
                                        <option value="1" selected>مفعل</option>
                                        <option value=0">غير مفعل</option>

                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الذهاب من</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <select class="form-control" name="individual_going_from_place" id="individual_going_from_place">
                                            <?php
                                                foreach ($places as $value) {
                                                    ?>
                                                    <option value="<?= $value->id ?>"><?= $value->title_ar; ?></option>
                                                <?php } ?>

                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الذهاب الى </label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <select class="form-control" name="individual_going_to_place" id="individual_going_to_place">
                                            <?php
                                                foreach ($places as $value) {
                                                    ?>
                                                    <option value="<?= $value->id ?>"><?= $value->title_ar; ?></option>
                                                <?php } ?>

                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">


                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">تاريخ الذهاب</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <input type="date" class="form-control" id="individual_going_date" name="individual_going_date">
                                        <div class="help-block"></div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العودة من</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <select class="form-control" name="individual_return_from_place" id="individual_return_from_place">
                                            <?php
                                                foreach ($places as $value) {
                                                    ?>
                                                    <option value="<?= $value->id ?>"><?= $value->title_ar; ?></option>
                                                <?php } ?>

                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العودة الى</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <select class="form-control" name="individual_return_to_place" id="individual_return_to_place">
                                            <?php
                                                foreach ($places as $value) {
                                                    ?>
                                                    <option value="<?= $value->id ?>"><?= $value->title_ar; ?></option>
                                                <?php } ?>

                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">


                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">تاريخ العوده</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <input type="date" class="form-control" id="individual_return_date" name="individual_return_date">
                                        <div class="help-block"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="collective-box-period" style="display: none;">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('status'); ?></label>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <select class="form-control" name="active" id="active">
                                        <option value="1" selected>مفعل</option>
                                        <option value=0">غير مفعل</option>

                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">اسم الشركة الناقلة</label>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <input type="text" class="form-control" id="flight_company_name" name="flight_company_name">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">وسيلة السفر</label>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <select class="form-control" name="travel_way_id" id="travel_way_id">
                                        <?php
                                            foreach ($travel_way as $value) {
                                                ?>
                                                <option value="<?= $value->id ?>"><?= $value->title_ar; ?></option>
                                            <?php } ?>

                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">عدد المسافرين</label>
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <input type="text" min="1" class="form-control" id="passenger_num" name="passenger_num">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الذهاب من</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <select class="form-control" name="going_from_place" id="going_from_place">
                                            <?php
                                                foreach ($places as $value) {
                                                    ?>
                                                    <option value="<?= $value->id ?>"><?= $value->title_ar; ?></option>
                                                <?php } ?>

                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الذهاب الى </label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <select class="form-control" name="going_to_place" id="going_to_place">
                                            <?php
                                                foreach ($places as $value) {
                                                    ?>
                                                    <option value="<?= $value->id ?>"><?= $value->title_ar; ?></option>
                                                <?php } ?>

                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">


                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">تاريخ الذهاب</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <input type="date" class="form-control" id="going_date" name="going_date">
                                        <div class="help-block"></div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العودة من</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <select class="form-control" name="return_from_place" id="return_from_place">
                                            <?php
                                                foreach ($places as $value) {
                                                    ?>
                                                    <option value="<?= $value->id ?>"><?= $value->title_ar; ?></option>
                                                <?php } ?>

                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">العودة الى</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <select class="form-control" name="return_to_place" id="return_to_place">
                                            <?php
                                                foreach ($places as $value) {
                                                    ?>
                                                    <option value="<?= $value->id ?>"><?= $value->title_ar; ?></option>
                                                <?php } ?>

                                        </select>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">


                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">تاريخ العوده</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <input type="date" class="form-control" id="return_date" name="return_date">
                                        <div class="help-block"></div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        >حفظ</button> </a>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
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
                        <li class="active"><a href="<?= \base_url('admin/flight_reservation/show') ?>"><?= $lang['flight_reservation']; ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

            <a href="" class="btn btn-primary" onclick="Flight_reservation.add(); return false;">اضافة جديد</a>

            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $lang['flight_reservation']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <!--Table Wrapper Start-->
                            <div class="ls-editable-table table-responsive ls-table">
                                <table class="table dataTable table-bordered table-striped table-bottomless">
                                    <thead>
                                        <tr>
                                            <th> الذهاب</th>
                                            <th> العوده</th>
                                            <th> نوع الرحلة</th>

                                            <th><?= $lang['controll']; ?></th>
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
<script>
        var new_lang = {
            'edit_user': 'تعديل مستخدم',
            collective_messages: {
                flight_company_name: {
                    required: 'هذا الحقل مطلوب'
                },
                travel_way_id: {
                    required: 'هذا الحقل مطلوب'
                },
                passenger_num: {
                    required: 'هذا الحقل مطلوب'
                },
                going_from_place: {
                    required: 'هذا الحقل مطلوب'
                },
                going_to_place: {
                    required: 'هذا الحقل مطلوب'
                },
                going_date: {
                    required: 'هذا الحقل مطلوب'
                },
                return_from_place: {
                    required: 'هذا الحقل مطلوب'
                },
                return_to_place: {
                    required: 'هذا الحقل مطلوب'
                },
                return_date: {
                    required: 'هذا الحقل مطلوب'
                },
            }
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('flight_reservation.js');
?>