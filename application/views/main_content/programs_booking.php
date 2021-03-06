


<!-- INNER-BANNER -->
<div class="inner-banner style-1">
    <img class="center-image" src="<?= base_url('img/detail/bg_5.jpg'); ?>" alt="">
    <div class="vertical-align">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <ul class="banner-breadcrumb color-white clearfix">
                        <li><a class="link-blue-2" href="#">الرئيسية</a> /</li>
                        <li><span>حجز برنامج</span></li>
                    </ul>
                    <h2 class="color-white">حجز برنامج</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DETAIL WRAPPER -->
<div class="detail-wrapper">
    <div class="container rtl">
       	<div class="row padd-90">
            <div class="col-xs-12 col-md-9">

                <div class="row">
                    <section>
                        <div class="wizard">
                            <div class="wizard-inner">
                                <div class="connecting-line"></div>
                                <ul class="nav nav-tabs" role="tablist">

                                    <li role="presentation" class="active" id="li-client">
                                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="بيانات العميل">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-user"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled" id="li-travellers">
                                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="بيانات اعداد المسافرين">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled" id="li-rooms">
                                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="حجز غرف">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-bed"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled">
                                        <a href="#step4" data-toggle="tab" aria-controls="#step4" role="tab" title="حجز خدمات اضافية">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-plus"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled">
                                        <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab" title="بيانات المسافرين">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-list-alt"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled">
                                        <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="تم">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-ok"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                            <div class="tab-content">
                                <!--                                <form action="" method="post" id="form-client">-->
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <div class="step1">
                                        <form action="" method="post" id="form-client">
                                            <input type="hidden" name="program_id" id="program_id" value="<?= $program_id ?>"/>
                                            <input type="hidden" name="program_flight_id" id="program_flight_id" value="<?= $program_flight_id ?>"/>
                                            <?php if ($program_room_prices) { ?>
                                                    <?php foreach ($program_room_prices as $program_room_price) { ?>
                                                        <input type="hidden" name="program_room_prices_ids[<?= $program_room_price->hotel_rooms_id ?>]" value="<?= $program_room_price->id ?>">
                                                        <input type="hidden" name="<?= $program_room_price->title_en . '_all' ?>" id="<?= $program_room_price->title_en . '_all' ?>" value="<?= $program_room_price->number_of_rooms ?>"/>
                                                        <input type="hidden" name="<?= $program_room_price->title_en . '_reserved' ?>" id="<?= $program_room_price->title_en . '_reserved' ?>" value="<?= $program_room_price->number_of_rooms_reserved ?>"/>
                                                        <input type="hidden" name="<?= $program_room_price->title_en . '_price' ?>" id="<?= $program_room_price->title_en . '_price' ?>" value="<?= $program_room_price->price ?>"/>
                                                    <?php } ?>
                                                <?php } ?>
                                            <h3 class="small-title">بيانات العميل</h3>
                                            <div class="row nmarg">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-4">
                                                        <div class="form-group form-block type-2 clearfix">
                                                            <div class="control-label form-label color-dark-2">الاسم:</div>
                                                            <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                <input class="form-control" type="text" placeholder="الاسم " name="username" id="username">
                                                            </div>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4">
                                                        <div class="form-group form-block type-2 clearfix">
                                                            <div class="control-label form-label color-dark-2">التليفون</div>
                                                            <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                <input class="form-control" type="number" placeholder="التليفون" name="phone" id="phone">
                                                            </div>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4">
                                                        <div class="form-group form-block type-2 clearfix">
                                                            <div class="control-label form-label color-dark-2">البريد الاليكترونى</div>
                                                            <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                <input class="form-control" type="email" placeholder="البريد الاليكترونى" name="email" id="email">
                                                            </div>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-8">
                                                        <div class="form-group form-block type-2 clearfix">
                                                            <div class="control-label form-label color-dark-2">العنوان</div>
                                                            <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                <input class="form-control" type="text" placeholder="العنوان" name="address" id="address">
                                                            </div>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>
                                                    <!--                                                    <div class="col-xs-12 col-sm-4">
                                                                                                            <div class="form-group form-block type-2 clearfix">
                                                                                                                <div class="control-label form-label color-dark-2">تاريخ الميلاد</div>
                                                                                                                <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                                                                    <img src="<?= base_url('img/calendar_icon_grey.png'); ?>" alt="">
                                                                                                                    <input class="form-control datepicker" type="text" placeholder="تاريخ الميلاد" name="birthdate" id="birthdate">
                                                                                                                </div>
                                                                                                                <div class="help-block"></div>
                                                                                                            </div>
                                                                                                        </div>-->
                                                    <div class="col-xs-12 col-sm-4">
                                                        <div class="form-group form-block type-2 clearfix">
                                                            <div class="control-label form-label color-dark-2">تاريخ الميلاد</div>
                                                            <div class='input-group date input-style-1 color-3 b-50 brd-0 type-2 ' >
                                                                <input type='text' class="form-control in_out_date" name="birthdate" id="birthdate"/>
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                            </div>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>

                                        </form>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="next-step submit-form next-step submit-form c-button b-40 bg-dr-blue-2  hv-dr-blue-2-o" data-form-type="form-client" data-current-tab="step1" data-current-li="li-client" data-next-tab="step2" data-next-li="li-travellers">حفظ و متابعة</button></li>
                                    </ul>
                                </div>
                                <!--</form>-->

                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <!--                                    <form action="" method="post" id="form-travellers">-->
                                    <div class="step2">
                                        <form action="" method="post" id="form-travellersnum">
                                            <h3 class="small-title">بيانات اعداد المسافرين</h3>
                                            <div class="row">

                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-group form-block type-2 clearfix">
                                                        <div class="control-label form-label color-dark-2">عدد البالغين</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input class="form-control" type="number" placeholder="عدد البالغين" min="1" name="adult_num" id="adult_num">
                                                        </div>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-group form-block type-2 clearfix">
                                                        <div class="control-label form-label color-dark-2">عدد الاطفال</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input class="form-control" type="number" placeholder="عدد الاطفال" min="1" name="childs_num" id="childs_num" data-child-price="<?= $program_flight->child_price ?>">
                                                        </div>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-group form-block type-2 clearfix">
                                                        <div class="control-label form-label color-dark-2">عدد الرضع</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input class="form-control" type="number" placeholder="عدد الرضع" min="1"  name="infant_num" id="infant_num" data-infant-price="<?= $program_flight->infant_price ?>">
                                                        </div>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>




                                            </div>
                                        </form>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="prev-step submit-form c-button b-40 bg-dr-blue-2  hv-dr-blue-2-o prev-step">السابق</button></li>
                                        <li><button type="button" class="next-step submit-form c-button b-40 bg-dr-blue-2  hv-dr-blue-2-o next-step submit-form"  data-form-type="form-travellersnum" data-current-tab="step2" data-current-li="li-travellers" data-next-tab="step3" data-next-li="li-rooms">حفظ و متابعة</button></li>
                                    </ul>
                                    <!--                                    </form>-->
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="step3">
                                        <form action="" method="post" id="form-rooms">
                                            <h3 class="small-title">حجز غرف</h3>
                                            <div class="rooms-box">
                                                <div class="row">
                                                    <?php $index = 1; ?>
                                                    <?php if ($program_room_prices) { ?>
                                                            <?php foreach ($program_room_prices as $program_room_price) { ?>

                                                                <div class="col-xs-12 col-sm-5">
                                                                    <div class="form-group form-block type-2 clearfix">
                                                                        <div class="control-label form-label color-dark-2">نوع الغرفة</div>
                                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                            <?php $room_type_id = 'room_type_' . $index ?>
                                                                            <select class="form-control amr color-3" data-placeholder="" name="room_type[]" id="<?= $room_type_id ?>" data-room-price="<?= $program_room_price->price ?>" data-type-room="<?= $program_room_price->title_en ?>">

                                                                                <option value="<?= $program_room_price->hotel_rooms_id ?>"><?= $program_room_price->title_ar ?></option>

                                                                            </select>
                                                                        </div>
                                                                        <div class="help-block"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-5">
                                                                    <div class="form-group form-block type-2 clearfix">
                                                                        <div class="control-label form-label color-dark-2">عدد الغرف</div>
                                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                            <?php $room_num_id = 'room_num_' . $index ?>
                                                                            <select class="form-control amr color-3 room_num" data-placeholder="" name="room_num[]" id="<?= $room_num_id ?>" data-type-room="<?= $program_room_price->title_en ?>" data-room-type-ar="<?= $program_room_price->title_ar ?>" data-no-of-bed="<?= $program_room_price->no_of_bed; ?>">

                                                                                <?php
                                                                                $room_max = $program_room_price->number_of_rooms - $program_room_price->number_of_rooms_reserved;
                                                                                for ($x = 0; $x <= $room_max; $x++) {
                                                                                    ?>
                                                                                    <option value="<?= $x ?>"><?= $x; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="help-block"></div>
                                                                    </div>
                                                                </div>
                                                                <?php $index ++; ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                </div>
                                                <div class="alert-message" style="display:none;"></div>
                                                <br>
                                            </div>

                                        </form>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="prev-step submit-form c-button b-40 bg-dr-blue-2  hv-dr-blue-2-o prev-step">السابق</button></li>
                                        <li><button type="button" class="next-step submit-form c-button b-40 bg-dr-blue-2  hv-dr-blue-2-o next-step" data-form-type="form-rooms">حفظ و متابعة</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <div class="step4">
                                        <form action="" method="post" id="form-services">
                                            <h3 class="small-title">حجز خدمات اضافية على الاستمارة</h3>
                                            <div class="row">
                                                <?php if (count($programs_extra_service_cards) > 0) { ?>
                                                        <?php $y = 1; ?>
                                                        <?php foreach ($programs_extra_service_cards as $cards) { ?>
                                                            <div class="confirm-terms col-md-6">
                                                                <div class="input-entry color-3">
                                                                    <input class="form-control checkbox-form" data-service-title="<?= $cards->title_ar ?>" data-service-price="<?= $cards->price; ?>" id="<?= 'extra_services_for_cards_' . $y ?>" type="checkbox" name="extra_services_for_cards[]" value="<?= $cards->programs_extra_service_id ?>">
                                                                    <label class="clearfix" for="<?= 'extra_services_for_cards_' . $y ?>">
                                                                        <span class="sp-check"><i class="fa fa-check"></i></span>
                                                                        <span class="checkbox-text"><?= $cards->title_ar ?>: <?= $cards->price; ?> جنية</span>
                                                                    </label>
                                                                </div>
                                                                <div class="help-block"></div>
                                                            </div>
                                                            <?php $y++; ?>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <p class="text-center">لا يوجد</p>
                                                    <?php } ?>


                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                            <h3 class="small-title">حجز خدمات اضافية على الافراد</h3>
                                            <?php //print_r(count($programs_extra_service_person));     ?>
                                            <input type="hidden" name="extra_service_for_person_count" id="extra_service_for_person_count" value="<?= count($programs_extra_service_person) ?>"/>
                                            <?php //for ($x = 1; $x <= count($programs_extra_service_person); $x++) { ?>

                                            <!--                                                    <div class="row">

                                                                                                    <div class="col-xs-12 col-sm-6">
                                                                                                        <div class="form-group form-block type-2 clearfix">
                                                                                                            <div class="control-label form-label color-dark-2">اسم الخدمه </div>
                                                                                                            <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                                                                <select name="extra_service_for_person_ids[]" id="<?= 'extra_service_for_person_' . $x ?>" class="form-control amr color-3" data-placeholder="">
                                            <?php if (count($programs_extra_service_person) > 0) { ?>
                                                                                                                                                                                                                                                                                                                                                                                <option selected value="اختر">اختر</option>
                                                    <?php foreach ($programs_extra_service_person as $person) { ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="<?= $person->extra_service_id ?> " data-service-title="<?= $person->title_ar; ?>" data-service-price="<?= $person->price; ?>" class="<?= 'option_' . $person->extra_service_id ?>"><?= $person->title_ar ?>  : <?= '<span class="price">' . $person->price . '</span>' ?>  جنية </option>
                                                    <?php } ?>
                                                <?php } ?>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                            <div class="help-block"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-xs-12 col-sm-6">
                                                                                                        <div class="form-group form-block type-2 clearfix">
                                                                                                            <div class="control-label form-label color-dark-2">عدد الافراد</div>
                                                                                                            <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                                                                <input class="form-control" min="1" readonly="true" type="number" id="<?= 'extra_service_for_person_num_' . $x ?>" placeholder="عدد الافراد" name="extra_service_for_person_num[]">
                                                                                                            </div>
                                                                                                            <div class="help-block"></div>
                                                                                                        </div>
                                                                                                    </div>





                                                                                                </div>-->


                                            <?php //} ?>
                                            <?php if (count($programs_extra_service_person) > 0) { ?>
                                                    <div id="extra-services-person-box">
                                                        <input type="hidden" name="programs_extra_service_person_count" id="programs_extra_service_person_count" value="<?= count($programs_extra_service_person) ?>"/>
                                                        <div class="row row-extra-services-person">

                                                            <div class="col-xs-12 col-sm-5">
                                                                <div class="form-group form-block type-2 clearfix">
                                                                    <div class="control-label form-label color-dark-2">اسم الخدمه </div>
                                                                    <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                        <select name="extra_service_for_person_ids[]" id="extra_service_for_person_1" class="form-control amr color-3" data-placeholder="">
                                                                            <option selected value="اختر">اختر</option>
                                                                            <?php foreach ($programs_extra_service_person as $person) { ?>

                                                                                <option value="<?= $person->extra_service_id ?> " data-service-title="<?= $person->title_ar; ?>" data-service-price="<?= $person->price; ?>" class="<?= 'option_' . $person->extra_service_id ?>"><?= $person->title_ar ?>  : <?= '<span class="price">' . $person->price . '</span>' ?>  جنية </option>
                                                                            <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                    <div class="help-block"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-5">
                                                                <div class="form-group form-block type-2 clearfix">
                                                                    <div class="control-label form-label color-dark-2">عدد الافراد</div>
                                                                    <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                        <input class="form-control" min="1"  type="number" readonly id="extra_service_for_person_num_1" placeholder="عدد الافراد" name="extra_service_for_person_num[0]">
                                                                    </div>
                                                                    <div class="help-block"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-2" style="padding-top:35px;">
                                                                <a class="btn btn-primary" id="add-more-extra-services-person">+</a>

                                                            </div>

                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <p class="text-center">لا يوجد</p>
                                                <?php } ?>


                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="prev-step submit-form c-button b-40 bg-dr-blue-2  hv-dr-blue-2-o prev-step">السابق</button></li>
                                                <li><button type="button" class="next-step submit-form c-button b-40 bg-dr-blue-2  hv-dr-blue-2-o next-step" data-form-type="form-services">حفظ و متابعة</button></li>
                                            </ul>
                                        </form>
                                    </div>
                                </div>

                                <div class="tab-pane" role="tabpanel" id="step5">
                                    <div class="step5">
                                        <h3 class="small-title">بيانات المسافرين</h3>
                                        <form action="" method="post" id="form-travellersinfo">
                                            <div id="traveller-info-box-adult"></div>
                                            <div id="traveller-info-box-childs"></div>
                                            <div id="traveller-info-box-infant"></div>


                                            <ul class="error-message list-group" style="dispaly:none;">


                                            </ul>

                                            <button type="button" class="next-step submit-form c-button b-40 bg-dr-blue-2  hv-dr-blue-2-o next-step" data-form-type="form-travellersinfo">تأكيد الحجز</button>


                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="complete">
                                    <div class="complete">

                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="success-message">


                                                </div>
                                                <form action="<?= base_url('programs/print_reservation') ?>" id="print-form" method="post">
                                                    <input type="hidden" name="reservation_id" id="reservation_id"/>
                                                    <button type="button" class="btn btn-info print-btn">طباعة الإستمارة</button>
                                                </form>

                                                <div id="print-content" style="display:none;">
                                                    <!--بيانات الحجز-->

                                                    <!--بيانات اعداد المسافرين-->
                                                    <!--بيانات الغرف المحجوزة-->
                                                    <!--الخدمات المضافة على الاستمارة-->
                                                    <!--الخدمات المضافة على الفرد-->
                                                    <!--اجمالى سعر الاستمارة-->
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </section>
                </div>





            </div>
            <div class="col-xs-12 col-md-3">
                <div class="right-sidebar">

                    <div class="popular-tours bg-grey-2 bookinf">
                        <h4 class="color-dark-2">بيانات الحجز</h4>
                        <div class="hotel-small style-2 clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">اسم البرنامج:</span></h6><h6 class="pull-right">برنامج شرم الشيخ</h6>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">تاريخ الرحلة:</span></h6><h6 class="pull-right">26/12/2016</h6>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">تقيم البرنامج:</span></h6>
                                    <div class="rate">
                                        <span class="fa fa-star color-yellow"></span>
                                        <span class="fa fa-star color-yellow"></span>
                                        <span class="fa fa-star color-yellow"></span>
                                        <span class="fa fa-star color-yellow"></span>
                                        <span class="fa fa-star color-yellow"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="popular-tours bg-grey-2 bookinf">
                        <h4 class="color-dark-2">بيانات اعداد المسافرين</h4>
                        <div class="hotel-small style-2 clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">عدد البالغين:</span></h6>
                                    <h6 class="pull-right"><span id="adult_num_span">0</span> افراد</h6>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">عدد الاطفال:</span></h6>
                                    <h6 class="pull-right"><span id="childs_num_span">0</span> اطفال</h6>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">عدد الرضع:</span></h6>
                                    <h6 class="pull-right"><span id="infant_num_span">0</span> رضيع</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="popular-tours bg-grey-2 bookinf">
                        <h4 class="color-dark-2">الغرف المحجوزة</h4>
                        <div class="hotel-small style-2 clearfix room-reserved-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="pull-right"><span class="booktit">النوع:</span></h6>

                                </div>
                                <div class="col-md-6">
                                    <h6 class="pull-right"><span class="booktit">العدد :</span></h6>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="popular-tours bg-grey-2 bookinf">
                        <h4 class="color-dark-2">الخدمات الاضافية على الاستمارة</h4>
                        <div class="hotel-small style-2 clearfix">
                            <div class="row" id="extra-services-cards-box-left-bar">
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">اسم الخدمة:</span></h6>
                                    <h6 class="pull-right"></h6>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="popular-tours bg-grey-2 bookinf">
                        <h4 class="color-dark-2">الخدمات الاضافية على الافراد</h4>
                        <div class="hotel-small style-2 clearfix">
                            <div class="row" id="extra-services-persons-box-left-bar">


                                <!--                                <div class="col-md-12">
                                                                    <h6 class="pull-right"><span class="booktit">اسم الخدمة:</span></h6>
                                                                    <h6 class="pull-right"></h6>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <h6 class="pull-right"><span class="booktit">عدد الافراد:</span></h6>
                                                                    <h6 class="pull-right"></h6>
                                                                </div>-->

                            </div>
                        </div>
                    </div>

                    <div class="sidebar-text-label bg-dr-blue-2 color-white"><h6><span class="booktit">اجمالى المبلغ :</span> <span id="booking-price">0</span> جنيها</h6></div>




                </div>
            </div>
        </div>
    </div>
</div>
<?php
    global $_require;
    $_require['js'] = array('programs_booking.js');
?>
