<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditHajUmrahProgramCities" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHajUmrahProgramCitiesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHajUmrahProgramCitiesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="haj_umrah_program_cities_id" id="haj_umrah_program_cities_id" value="0">



                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('city'); ?></label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <select class="form-control"   name="city_id" id="city_id">
                                <option disabled="disabled"
                                        selected>اختر</option>
                                        <?php
                                            foreach ($cities as $value) {
                                                $select = "";

                                                if ($city_val == $value->id) {
                                                    $select = "selected";
                                                }
                                                echo "<option value='" . $value->id . "' $select >   $value->title_ar</option>";
                                            }
                                        ?>
                            </select>
                            <div class="help-block">ssss</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"><?= _lang('region'); ?></label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <select class="form-control"   name="region_id" id="region_id">
                                <option disabled="disabled"
                                        selected>اختر</option>
                                        <?php
                                            foreach ($cities as $value) {
                                                $select = "";

                                                if ($city_val == $value->id) {
                                                    $select = "selected";
                                                }
                                                echo "<option value='" . $value->id . "' $select >   $value->title_ar</option>";
                                            }
                                        ?>
                            </select>
                            <div class="help-block">ssss</div>
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
                            <input type="number" class="form-control" id="nights" name="nights">
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الترتيب</label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <input type="number" class="form-control" id="this_order" name="this_order">
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
<div class="modal fade" id="addEditHajUmrahProgramsFlights" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHajUmrahProgramsFlightsLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHajUmrahProgramsFlightsForm"  enctype="multipart/form-data">
                    <input type="hidden" name="haj_umrah_programs_flights_id" id="haj_umrah_program_flights_id" value="0">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize"><?= _lang('flight_text'); ?></label>
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <select class="form-control" name="flight_reservation_id" id="flight_reservation_id">
                                <option disabled="disabled"
                                        selected>اختر</option>
                                        <?php
                                            if (!empty($allFlights)) {
                                                foreach ($allFlights as $allFlight) {
                                                    echo "<option data-going-date='" . $allFlight->going_date . "' data-return-date='" . $allFlight->return_date . "' value='" . $allFlight->id . "' > $allFlight->travel_way  / " . $allFlight->going_date . "( " . $allFlight->name_from_city . " ==> " . $allFlight->name_to_city . " ) // " . $allFlight->return_date . "( " . $allFlight->return_name_from_city . " ==> " . $allFlight->return_name_to_city . " ) ( " . $allFlight->passenger_num . "  راكب)</option>";
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
                            <input type="number" class="form-control" id="child_price" name="child_price">
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize">السعر للرضع</label>
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <input type="number" class="form-control" id="infant_price" name="infant_price">
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
<div class="modal fade" id="addEditHajUmrahProgramsRoomsPrices" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHajUmrahProgramsRoomsPricesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHajUmrahProgramsRoomsPricesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="haj_umrah_program_rooms_prices_id" id="haj_umrah_program_rooms_prices_id" value="0">
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
<div class="modal fade" id="addEditHajUmrahProgramsExtraServices" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHajUmrahProgramsExtraServicesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHajUmrahProgramsExtraServicesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="haj_umrah_program_extra_services_id" id="haj_umrah_program_extra_services_id" value="0">

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
                        data-dismiss="modal">خفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addEditHajUmrahProgramsAdvantages" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHajUmrahProgramsAdvantagesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHajUmrahProgramsAdvantagesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="haj_umrah_program_advantages_id" id="haj_umrah_program_advantages_id" value="0">

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

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label text-capitalize">السعر </label>
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <input type="number" class="form-control" id="advantage_price" name="advantage_price">
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
<section id="min-wrapper">
    <div id="main-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <!--Top breadcrumb start -->
                    <ol class="breadcrumb">
                        <li> <i class="fa fa-home"></i> </li>
                        <li><?= _lang('haj_umrah_programs'); ?></li>
                        <li class="active"><a href="<?= base_url('admin/haj_umrah_program'); ?>"><?= _lang('haj_umrah_program'); ?></a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

                        <!--            <a class="btn btn-sm btn-info pull-right" href="" ><?= $lang['add_new']; ?> </a>-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= _lang('haj_umrah_program') ?></h3>
                        </div>
                        <style>
                            .table-box.active{display:block!important;}
                            .table-box.disabled{display:none!important;}
                        </style>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 col-md-2 col-md-offset-2 col-lg-2 control-label text-capitalize"><?= _lang('choose_program'); ?></label>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <select class="form-control program-select-2" name="haj_umrah_program_id" id="haj_umrah_program_id">
                                        <option disabled="disabled"
                                                selected>اختر</option>
                                                <?php foreach ($all_haj_umrah_programs as $program) { ?>
                                                <option value="<?= $program->id ?>"><?= $program->title_ar ?></option>
                                            <?php } ?>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div id="hotel-data-boxes" style="padding-top: 30px;margin-bottom: 30px;">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="ls-wizard  label-light-green">
                                            <h2> <?= _lang('program_cities') ?></h2>
                                            <a href="" class="program-data-box" data-type="program_cities" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="ls-wizard  label-lightBlue">
                                            <h2> <?= _lang('program_flights') ?></h2>
                                            <a href="" class="program-data-box" data-type="program_flights" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="ls-wizard  label-red">
                                            <h2> <?= _lang('program_extra_services') ?></h2>
                                            <a href="" class="program-data-box" data-type="program_extra_services" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="ls-wizard  label-lightBlue">
                                            <h2> <?= _lang('program_advantages') ?></h2>
                                            <a href="" class="program-data-box" data-type="program_advantages" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

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
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="program_cities_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Haj_umrah_program.add_cities(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('city') ?></th>
                                            <th><?= _lang('region') ?></th>
                                            <th><?= _lang('hotel') ?></th>
                                            <th><?= _lang('no_of_nights') ?></th>
                                            <th><?= _lang('options') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="program_flights_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Haj_umrah_program.add_flights(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('travel_way') ?></th>
                                            <th><?= _lang('transporter_company') ?></th>
                                            <th><?= _lang('going') ?></th>
                                            <th><?= _lang('returning') ?></th>
                                            <th><?= _lang('room_prices') ?></th>
                                            <th><?= _lang('options') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="program_rooms_prices_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Haj_umrah_program.add_rooms_prices(); return false;">اضافة جديد</a>
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
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="program_extra_services_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Haj_umrah_program.add_extra_services(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('title_ar') ?></th>
                                            <th>فرد او استمارة</th>
                                            <th>السعر</th>
                                            <th>خيارات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="program_advantages_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Haj_umrah_program.add_advantages(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>السعر</th>
                                            <th>خيارات</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="chalets_others_prices_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Hotel_data.add_chalets_others_prices(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('المنطقة') ?></th>
                                            <th><?= _lang('اسم') ?></th>
                                            <th>من</th>
                                            <th>الى</th>
                                            <th>السعر</th>
                                            <th>المتاح</th>
                                            <th>المحجوز</th>
                                            <th>خيارات</th>
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
                region_id: {
                    required: 'اختر المنطقة'

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
                    required: 'حدد سعر الطفل'

                },
                infant_price: {
                    required: 'حدد سعر الرضيع'

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
    $_require['js'] = array('haj_umrah_program.js');
?>
<!--<script type="text/javascript" src="assets/admin/ltr/js/lib/jquery-1.11.min.js"></script>

<script>
        $(document).ready(function () {

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        //$('#image-div').attr('src', e.target.result);
                        $('#image-div').append('<img id="image_upload_preview" src="' + e.target.result + '" alt="your image" />');
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image").change(function () {
                //alert($(this)[0].files.length);
                for (var i = 0; i < $(this)[0].files.length; i++) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#image-div .row').append('<div class="col-md-3" style="height:100px;"><img style="height:100%;width:100%;" id="image_upload_preview" src="' + e.target.result + '" alt="your image" /></div>');
                    }

                    reader.readAsDataURL($(this)[0].files[i]);
                }

                //readURL(this);
            });

        });

</script>-->