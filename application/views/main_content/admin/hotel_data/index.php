<!--Page main section start-->
<!-- Modal -->
<div class="modal fade" id="addEditHotelRooms" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHotelRoomsLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHotelRoomsForm"  enctype="multipart/form-data">
                    <input type="hidden" name="hotels_rooms_id" id="hotels_rooms_id" value="0">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">اختر الغرفة</label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <select class="form-control" name="room_id" id="room_id">
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
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الحد الأقصى للأطفال</label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <input type="number" class="form-control" id="number_of_child_extra" name="number_of_child_extra">
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الحد الأقصى للرضع</label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <input type="number" class="form-control" id="number_of_infant_extra" name="number_of_infant_extra">
                            <div class="help-block"></div>
                        </div>

                    </div>


                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        data-dismiss="modal">حفظ</button>
                <button type="button" class="btn btn-white"
                        data-dismiss="modal"><?= _lang("close") ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addEditHotelExtraServices" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHotelExtraServicesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHotelExtraServicesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="hotels_extra_services_id" id="hotels_extra_services_id" value="0">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">اختر الخدمة</label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <select class="form-control" name="extra_service_id" id="extra_service_id">
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
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">السعر للبالغين</label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <input type="number" class="form-control" id="price_for_adult" name="price_for_adult">
                            <div class="help-block"></div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">السعر للأطفال</label>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
                            <input type="number" class="form-control" id="price_for_child" name="price_for_child">
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
<div class="modal fade" id="addEditHotelRoomsPrices" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="addEditHotelRoomsPricesLabel"></h4>
            </div>

            <div class="modal-body">


                <form role="form" class="form-horizontal" id="addEditHotelRoomsPricesForm"  enctype="multipart/form-data">
                    <input type="hidden" name="hotels_rooms_prices_id" id="hotels_rooms_prices_id" value="0">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"> البلد</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control" name="country_id" id="country_id">
                                    <option disabled="disabled"
                                            selected>اختر</option>
                                            <?php if (!empty($countries)) { ?>
                                                    <?php foreach ($countries as $country) { ?>
                                                <option value="<?= $country->id ?>"><?= $country->title_ar ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                </select>
                                <div class="help-block"></div>
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"> الغرفة</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <select class="form-control" name="rooom_id" id="rooom_id">
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

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">من</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="date" class="form-control" id="from_date" name="from_date" value="">
                                <div class="help-block"></div>
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">الى</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="date" class="form-control" id="to_date" name="to_date" value="">
                                <div class="help-block"></div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize"> سعر الغرفة</label>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <input type="number" class="form-control" id="adult_price" name="adult_price">
                                <div class="help-block"></div>
                            </div>

                        </div>
                        <!--                        <div class="form-group col-md-6">
                                                    <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">السعر للأطفال</label>
                                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                                        <input type="number" class="form-control" id="child_price" name="child_price">
                                                        <div class="help-block"></div>
                                                    </div>

                                                </div>-->

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label text-capitalize">المتاح</label>
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <input type="number" class="form-control" id="number_of_room" name="number_of_room">
                                <div class="help-block"></div>
                            </div>

                        </div>
                    </div>



                </form>

            </div>

            <div class="modal-footer">
                <span class="margin-right-10 loading hide"><i class="fa fa-spin fa-spinner"></i></span>
                <button type="button" class="btn btn-info submit-form"
                        data-dismiss="modal">حفظ</button>
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
                        <li>الفنادق</li>
                        <li class="active"><a href="<?= base_url() ?>admin/hotel_data/show">بيانات الفندق</a></li>
                    </ol>
                    <!--Top breadcrumb start -->
                </div>
            </div>

                        <!--            <a class="btn btn-sm btn-info pull-right" href="" ><?= $lang['add_new']; ?> </a>-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">بيانات الفندق</h3>
                        </div>
                        <style>
                            .table-box.active{display:block!important;}
                            .table-box.disabled{display:none!important;}
                        </style>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 col-md-2 col-md-offset-2 col-lg-2 control-label text-capitalize">اختر الفندق</label>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <select class="form-control hotel-select-2" name="hotel_id" id="hotel_id">
                                        <option disabled="disabled"
                                                selected>اختر</option>
                                                <?php foreach ($all_hotels as $hotel) { ?>
                                                <option value="<?= $hotel->id ?>"><?= $hotel->title_ar ?></option>
                                            <?php } ?>
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div id="hotel-data-boxes" style="padding-top: 30px;margin-bottom: 30px;">
                                <div class="row">
                                 
                                    <div class="col-md-4 col-sm-6">
                                        <div class="ls-wizard  label-light-green">
                                            <h2> الغرف</h2>
                                            <a href="" class="hotel-data-box" data-type="rooms" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="ls-wizard  label-red">
                                            <h2> الخدمات الاضافية</h2>
                                            <a href="" class="hotel-data-box" data-type="extra_services" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="ls-wizard  label-lightBlue">
                                            <h2> اسعار الغرف</h2>
                                            <a href="" class="hotel-data-box" data-type="rooms_prices" style="text-decoration:none;color:#fff;"><span>اضغط هنا</span></a>

                                            <div class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="rooms_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Hotel_data.add_rooms(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('title_ar') ?></th>
                                            <th>الحد الأقصى للأطفال</th>
                                            <th>الحد الأقصى للرضع</th>
                                            <th>خيارات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="extra_services_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Hotel_data.add_extra_services(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('title_ar') ?></th>
                                            <th>السعر بالنسبة للبالغين</th>
                                            <th>السعر بالنسبة للأطفال</th>
                                            <th>خيارات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="ls-editable-table table-responsive ls-table table-box disabled" style="padding-top: 30px;" id="rooms_prices_table">
                                <a href="" class="btn btn-primary" style="margin:0 15px 30px;" onclick="Hotel_data.add_rooms_prices(); return false;">اضافة جديد</a>
                                <table class="table table-bordered table-striped table-bottomless dataTable">
                                    <thead>
                                        <tr>
                                            <th><?= _lang('المنطقة') ?></th>
                                            <th><?= _lang('نوع الغرفة') ?></th>
                                            <th>من</th>
                                            <th>الى</th>
                                            <th>سعر الغرفة</th>
<!--                                            <th>السعر بالنسبة للأطفال</th>-->
                                            <th>المتاح</th>
                                            <th>المحجوز</th>
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
            hotel_rooms_messages: {
                room_id: {
                    required: "اختر الغرفة"
                },
                number_of_child_extra: {
                    required: "ادخل عدد الأطفال"
                },
                number_of_infant_extra: {
                    required: "ادخل عدد الرضع"
                },
            },
            hotel_extra_services_messages: {
                extra_service_id: {
                    required: "اختر خدمة"
                },
                price_for_adult: {
                    required: "ادخل السعر بالنسبة للبالغين"
                },
                price_for_child: {
                    required: "ادخل السعر بالنسسبة للأطفال"
                },
                s_currency_id: {
                    required: "حدد العملة"
                },
            },
            hotel_rooms_prices_messages: {
                country_id: {
                    required: "اختر المنطقة"
                },
                rooom_id: {
                    required: "اختر الغرفة"
                },
                from_date: {
                    required: "حدد من تاريخ"
                },
                to_date: {
                    required: "حدد الى تاريخ"
                },
                adult_price: {
                    required: "ادخل السعر بالنسبة للبالغين"
                },
                
                number_of_room: {
                    required: "المتاح"
                },
                r_currency_id: {
                    required: "حدد العملة"
                },
            },
            chalets_others_prices_messages: {
                coountry_id: {
                    required: "المنطقة"
                },
                chalets_others_id: {
                    required: "اختر شاليه و أخرى"
                },
                froom_date: {
                    required: "حدد من تاريخ"
                },
                too_date: {
                    required: "حدد الى تاريخ"
                },
                price: {
                    required: "حدد السعر"
                },
                number_of_chalet: {
                    required: "المتاح"
                },
            },
        };
</script>
<?php
    global $_require;
    $_require['js'] = array('hotel_data.js');
?>