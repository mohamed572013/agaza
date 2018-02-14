<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditProgramCities" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditProgramCitiesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditProgramCitiesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="program_cities_id" id="program_cities_id" value="0">



                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('city'); ?></label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <select class="form-control"   name="country_id" id="country_id">
                                <option disabled="disabled"
                                        selected>اختر</option>
                                        <?php
                                            foreach ($places as $value) {
                                                $select = "";

                                                if ($city_val == $value->id) {
                                                    $select = "selected";
                                                }
                                                echo "<option value='" . $value->id . "' $select >   $value->title_ar</option>";
                                            }
                                        ?>
                            </select>
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('region'); ?></label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <select class="form-control"   name="city_id" id="city_id">
                                <option disabled="disabled"
                                        selected>اختر</option>

                            </select>
                            <div class="help-block"></div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= $lang['hotel']; ?></label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <select class="form-control"   name="hotel_id" id="hotel_id">
                                <option disabled="disabled"
                                        selected>اختر</option>

                            </select>
                            <div class="help-block"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">عدد الليالى</label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <input type="text" class="form-control" id="nights" name="nights">
                            <div class="help-block"></div>
                        </div>

                    </div>


                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        >خفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addEditProgramsFlights" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditProgramsFlightsLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditProgramsFlightsForm"  enctype="multipart/form-data">
                    <input type="hidden" name="program_flights_id" id="program_flights_id" value="0">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('flight_text'); ?></label>
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <select class="form-control" name="flight_reservation_id" id="flight_reservation_id">
                                <option disabled="disabled"
                                        selected>اختر</option>
                                        <?php
                                            if (!empty($allFlights)) {
                                                foreach ($allFlights as $allFlight) {
                                                    $flight_type = ($allFlight->flight_type == 1) ? 'جماعية' : 'فردية';
                                                    echo "<option data-flight-type='" . $allFlight->flight_type . "' data-going-date='" . $allFlight->going_date . "' data-return-date='" . $allFlight->return_date . "' value='" . $allFlight->id . "' >" . $allFlight->going_date . ' ==> ' . $allFlight->return_date . ' (' . $flight_type . ' )' . "</option>";
                                                }
                                            }
                                        ?>
                            </select>
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize">السعر للأطفال</label>
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <input type="text" class="form-control" id="child_price" name="child_price">
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize">السعر للرضع</label>
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <input type="text" class="form-control" id="infant_price" name="infant_price">
                            <div class="help-block"></div>
                        </div>

                    </div>


                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        >خفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addEditProgramsRoomsPrices" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditProgramsRoomsPricesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditProgramsRoomsPricesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="programs_rooms_prices_id" id="programs_rooms_prices_id" value="0">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"> الغرفة</label>
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <select class="form-control" name="hotel_rooms_id" id="hotel_rooms_id">
                                <option disabled="disabled"
                                        selected>اختر</option>
                                        <?php if (!empty($rooms)) { ?>
                                                <?php foreach ($rooms as $room) { ?>
                                            <option value="<?= $room->id ?>"><?= $room->title_ar ?></option>
                                        <?php } ?>
                                    <?php } ?>


                            </select>
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize">المتاح</label>
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <input type="number" class="form-control" id="number_of_rooms" name="number_of_rooms">
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize">السعر للبالغين</label>
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <input type="number" class="form-control" id="adult_price" name="adult_price">
                            <div class="help-block"></div>
                        </div>

                    </div>




                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        data-dismiss="modal">خفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addEditProgramsExtraServices" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditProgramsExtraServicesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditProgramsExtraServicesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="programs_extra_service_id" id="programs_extra_service_id" value="0">

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"> الخدمة</label>
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <select class="form-control" name="extra_services_id" id="extra_services_id">
                                <option disabled="disabled"
                                        selected>اختر</option>
                                        <?php if (!empty($extra_services)) { ?>
                                                <?php foreach ($extra_services as $extra_service) { ?>
                                            <option value="<?= $extra_service->id ?>"><?= $extra_service->title_ar ?></option>
                                        <?php } ?>
                                    <?php } ?>


                            </select>
                            <div class="help-block"></div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize">السعر </label>
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <input type="number" class="form-control" id="price" name="price">
                            <div class="help-block"></div>
                        </div>

                    </div>


                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        >حفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addEditProgramsAdvantages" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditProgramsAdvantagesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditProgramsAdvantagesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="programs_advantage_all_id" id="programs_advantage_all_id" value="0">

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"> الخدمة</label>
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <select class="form-control" name="programs_advantage_id" id="programs_advantage_id">
                                <option disabled="disabled"
                                        selected>اختر</option>
                                        <?php if (!empty($advantages)) { ?>
                                                <?php foreach ($advantages as $advantage) { ?>
                                            <option value="<?= $advantage->id ?>"><?= $advantage->title_ar ?></option>
                                        <?php } ?>
                                    <?php } ?>


                            </select>
                            <div class="help-block"></div>
                        </div>

                    </div>

                    <!--                    <div class="form-group">
                                            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize">السعر </label>
                                            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                                <input type="number" class="form-control" id="advantage_price" name="advantage_price">
                                                <div class="help-block"></div>
                                            </div>

                                        </div>-->


                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        >حفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <!--Top breadcrumb start -->
                    <ol class="breadcrumb">
                        <li> <i class="fa fa-home"></i> </li>
                        <li><?= _lang('visa_create'); ?></li>
                        <li class="active"><a href="<?= base_url('admin/visa_create'); ?>"><?= _lang('visa_create'); ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= _lang('visa_create') ?></h3>
                        </div>
                        <style>
                            .table-box.active{display:block!important;}
                            .table-box.disabled{display:none!important;}
                        </style>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 col-md-2 col-md-offset-2 col-lg-2 control-label text-capitalize"><?= _lang('choose_country'); ?></label>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <select class="form-control program-select-2" name="places_id" id="places_id">
                                        <option disabled="disabled"
                                                selected>اختر</option>
                                                <?php foreach ($places as $value) { ?>
                                                <option value="<?= $value->id ?>"><?= $value->title_ar ?></option>
                                            <?php } ?>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div id="visa-data-boxes" style="padding-top: 30px;margin-bottom: 30px;">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <div class="ls-wizard  label-light-green">
                                            <h2> <?= _lang('visa_types') ?></h2>
                                            <a href="" class="visa-data-box" data-type="visa_types" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="ls-wizard  label-lightBlue">
                                            <h2> <?= _lang('visa_periods') ?></h2>
                                            <a href="" class="visa-data-box" data-type="visa_periods" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="ls-wizard  label-red">
                                            <h2> <?= _lang('visa_jobs') ?></h2>
                                            <a href="" class="visa-data-box" data-type="visa_jobs" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>


                                    <!--                                    <div class="col-md-3 col-sm-6 ">
                                                                            <div class="ls-wizard  label-info">
                                                                                <h2>الصور</h2>
                                                                                <a href="" class="hotel-data-box" data-type="images" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                                                                <div class="icon">
                                                                                    <i class="fa fa-envelope"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>-->

                                </div>
                            </div>
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="visa_types_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Program_data.add_cities(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('city') ?></th>
                                            <th><?= _lang('hotel') ?></th>
                                            <th><?= _lang('no_of_nights') ?></th>
                                            <th><?= _lang('options') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="visa_jobs_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Program_data.add_flights(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('going_date') ?></th>
                                            <th><?= _lang('returning_date') ?></th>
                                            <th><?= _lang('room_prices') ?></th>
                                            <th><?= _lang('options') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="visa_periods_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Program_data.add_rooms_prices(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('room_type') ?></th>
                                            <th><?= _lang('number_of_rooms') ?></th>
                                            <th><?= _lang('number_of_rooms_reserved') ?></th>
                                            <th><?= _lang('price') ?></th>
                                            <th><?= _lang('options') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

<!--                            <input type='file' id="image" multiple="true" />
                            <div id="image-div">
                                <div class="row">

                                </div>-->
                        </div>


                    </div>

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
            cities_messages: {
                city_id: {
                    required: 'اختر المدينة'

                },
                country_id: {
                    required: 'اختر البلد'

                },
                hotel_id: {
                    required: 'اختر الفندق'

                },
                nights: {
                    required: 'حدد عدد الليالى'

                },
            },
            flights_messages: {
                flight_reservation_id: {
                    required: 'اختر الرحلة'

                },
                child_price: {
                    required: 'حدد سعر الطفل',
                    number: 'يجب ادخال ارقام فقط'

                },
                infant_price: {
                    required: 'حدد سعر الرضيع',
                    number: 'يجب ادخال ارقام فقط'

                },
            },
            rooms_prices_messages: {
                hotel_rooms_id: {
                    required: 'اختر الغرفة'

                },
                number_of_rooms: {
                    required: 'حدد عدد الغرف المتاحة'

                },
                adult_price: {
                    required: 'حدد سعر البالغ'

                },
            },
            extra_services_messages: {
                extra_services_id: {
                    required: 'ادخل الخدمة'

                },
                price: {
                    required: 'ادخل السعر'

                },
            },
            advantages_messages: {
                programs_advantage_id: {
                    required: 'ادخل ميزة'

                },
                price: {
                    required: 'ادخل السعر'

                },
            },
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('program_data.js');
?>
