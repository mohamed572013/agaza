
<head>
    <title>طباعة الأستمارة</title>

    <link href="<?= base_url("assets/front") ?>/css/bootstrap-rtl.css" rel="stylesheet">
    <link href="<?= base_url("assets/front") ?>/css/style.css" rel="stylesheet">
    <link href="<?= base_url("assets/front") ?>/css/customs.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="page_print">

            <div class="subpage">

                <div class="header-image">
                    <img src="<?= base_url("assets/front") ?>/images/header_pdf2.jpg" class="img-responsive" style="width: 100%;height: 90px;" />
                </div>

                <div class="main-content rtl">
                    <div class="head-booker-info">
                        <h3 class="text-center mbt10"> بيانات العميل</h3>
                        <div class="row">
                            <div class="col-md-4 fr"><strong>الاسم :</strong> <?= $reservation_detail[0]->head_booker_name; ?></div>
                            <div class="col-md-4 fr"><strong>التليفون :</strong><?= $reservation_detail[0]->head_booker_phone; ?></div>
                            <div class="col-md-4 fr"><strong>البريد الإلكترونى :</strong><?= $reservation_detail[0]->head_booker_email; ?></div>
                            <div class="col-md-12 fr"><strong>العنوان :</strong><?= $reservation_detail[0]->head_booker_address; ?></div>

                        </div>

                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="flight-reservation-info">
                        <h3 class="text-center mbt10"> بيانات الرحلة</h3>

                        <div class="col-md-4 fr"><strong>رقم الإستمارة :</strong><?= ($reservation_detail[0]) ? $reservation_detail[0]->id : ''; ?></div>
                        <div class="col-md-4 fr"><strong>كود الإستمارة :</strong><?= ($reservation_detail[0]) ? $reservation_detail[0]->reservation_code : ''; ?></div>
                        <div class="col-md-4 fr"><strong>اسم الفندق :</strong><?= ($hotel_detail) ? $hotel_detail->title_ar : ''; ?></div>
                        <div class="col-md-6 fr"><strong>تاريخ الوصول :</strong><?= ($reservation_detail[0]) ? $reservation_detail[0]->arrive_date : ''; ?></div>
                        <div class="col-md-6 fr"><strong>تاريخ المغادرة :</strong><?= ($reservation_detail[0]) ? $reservation_detail[0]->departing_date : ''; ?></div>

                    </div>
                    <div class="clearfix"></div>
                    <hr>

                    <div class="clearfix"></div>
                    <hr>


                    <div class="reservation-rooms-reserved-info">

                        <h3 class="text-center mbt10">حجز الغرف</h3>
                        <?php
                            $rooms = array();
                            $total_price = 0;
                            $child_price = false;
                            if ($closed_room && !empty($closed_room)) {
                                foreach ($closed_room as $value) {
                                    $room_price = 0;
                                    $adult_price = $value->no_of_rooms * $value->no_of_bed * $value->adult_price;
                                    $rooms[$value->title_ar]['adult_price'][] = $adult_price;
                                    if ($value->no_of_childs > 0) {
                                        $child_price = $value->no_of_childs * $value->child_price;
                                        $rooms[$value->title_ar]['child_price'][] = $child_price;
                                    }



                                    $room_price = $adult_price + (($child_price) ? $child_price : 0);
                                    $total_price +=$room_price;
                                    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!--                                    <div class="col-md-3 fr"><strong>نوع الغرفة :</strong><?= ($value->title_ar) ? $value->title_ar : ''; ?></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="col-md-3 fr"><strong> التاريخ :</strong><?= ($value->date) ? $value->date : ''; ?></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="col-md-2 fr"><strong>عدد الغرف :</strong><?= ($value->no_of_rooms) ? $value->no_of_rooms : ''; ?></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="col-md-2 fr"><strong>السعر للبالغ :</strong><?= ($adult_price) ? $adult_price : ''; ?></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="col-md-2 fr"><strong>السعر للطفل :</strong><?= ($child_price) ? $child_price : ''; ?></div>-->
                                <?php } ?>
                            <?php } ?>
                        <?php if ($rooms && !empty($rooms)) { ?>
                                <?php foreach ($rooms as $key => $room) { ?>
                                    <div class="row">
                                        <div class="col-md-4 fr"><strong>نوع الغرفة :</strong><?= $key ?></div>
                                        <?php if (!empty($room['adult_price'])) { ?>
                                            <div class="col-md-4 fr"><strong>السعر للبالغ :</strong><?= array_sum($room['adult_price']); ?></div>
                                        <?php } ?>
                                        <?php if (!empty($room['child_price'])) { ?>
                                            <div class="col-md-4 fr"><strong>السعر للطفل :</strong><?= array_sum($room['child_price']); ?></div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <!--                                <div class="row">
                                                                    <div class="col-md-4 fl"><strong> الإجمالى :</strong><?= $total_price ?></div>
                                                                </div>-->
                            <?php } ?>

                    </div>
                    <div class="clearfix"></div>
                    <hr>

                    <div class="reservation-services-cards-info">
                        <h3 class="text-center mbt10"> الخدمات الأضافية على الغرف</h3>
                        <?php if ($reservation_extra_services_rooms && !empty($reservation_extra_services_rooms)) { ?>
                                <?php foreach ($reservation_extra_services_rooms as $value) { ?>
                                    <div class="row">
                                        <div class="col-md-4 fr"><strong>الاسم :</strong><?= ($value->title_ar) ? $value->title_ar : ''; ?></div>
                                        <?php if (!empty($value->number_of_adults) && $value->number_of_adults != 0) { ?>
                                            <div class="col-md-2 fr"><strong>عدد البالغين :</strong><?= $value->number_of_adults ?></div>
                                            <div class="col-md-2 fr"><strong>السعر للبالغ :</strong><?= ($value->price_for_adult * $value->number_of_adults) * $value->nights_no ?></div>
                                        <?php } ?>
                                        <?php if (!empty($value->number_of_childs) && $value->number_of_childs != 0) { ?>
                                            <div class="col-md-2 fr"><strong>عدد الاطفال :</strong><?= $value->number_of_childs ?></div>
                                            <div class="col-md-2 fr"><strong>السعر للطفل :</strong><?= ($value->price_for_child * $value->number_of_childs) * $value->nights_no ?></div>
                                        <?php } ?>

                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="col-md-4 fr"><strong>لا يوجد</strong></div>
                            <?php } ?>

                    </div>

                    <div class="clearfix"></div>
                    <hr>

                    <div class="reservation-services-persons-info">
                        <h3 class="text-center mbt10"> الخدمات الأضافية على الأفراد</h3>
                        <?php if ($reservation_extra_services_persons && !empty($reservation_extra_services_persons)) { ?>
                                <?php foreach ($reservation_extra_services_persons as $value) { ?>
                                    <div class="row">
                                        <div class="col-md-4 fr"><strong>الاسم :</strong><?= $value->title_ar ?></div>
                                        <?php if (!empty($value->number_of_adults) && $value->number_of_adults != 0) { ?>
                                            <div class="col-md-2 fr"><strong>عدد البالغين :</strong><?= $value->number_of_adults ?></div>
                                            <div class="col-md-2 fr"><strong>السعر للبالغ :</strong><?= ($value->price_for_adult * $value->number_of_adults) * $value->nights_no ?></div>
                                        <?php } ?>
                                        <?php if (!empty($value->number_of_childs) && $value->number_of_childs != 0) { ?>
                                            <div class="col-md-2 fr"><strong>عدد الاطفال :</strong><?= $value->number_of_childs ?></div>
                                            <div class="col-md-2 fr"><strong>السعر للطفل :</strong><?= ($value->price_for_child * $value->number_of_childs) * $value->nights_no ?></div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="col-md-4 fr"><strong>لا يوجد</strong></div>
                            <?php } ?>

                    </div>



                    <div class="clearfix"></div>
                    <hr>


                    <div class="reservation-prices">

                        <div class="col-md-12 fr"><strong>اجمالى سعر الحجز :</strong><?= $reservation_detail[0]->reservation_price; ?> جنية مصري فقط لاغير</div>

                    </div>
                    <div class="clearfix"></div>
                    <hr>

                    <div class="reservation-travellers-info">
                        <h3 class="text-center mbt10">افراد على الاستمارة</h3>

                        <div class="row">
                            <?php if (isset($reservation_traveller_first_table) && count($reservation_traveller_first_table) > 0) { ?>
                                    <div class="col-md-6 fr">


                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>الاسم</th>
                                                    <th>النوع</th>
                                                    <th>تاريخ الميلاد</th>


                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php foreach ($reservation_traveller_first_table as $value) { ?>
                                                    <tr>
                                                        <td><?= $value->name ?></td>
                                                        <td><?= $value->gender ?></td>
                                                        <td><?= $value->birthdate ?></td>

                                                    </tr>
                                                <?php } ?>





                                            </tbody>
                                        </table>
                                    </div>
                                <?php } ?>
                            <?php if (isset($reservation_traveller_second_table) && count($reservation_traveller_second_table) > 0) { ?>
                                    <div class="col-md-6 fr">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>الاسم</th>
                                                    <th>النوع </th>
                                                    <th>تاريخ الميلاد</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($reservation_traveller_second_table as $value) { ?>
                                                    <tr>
                                                        <td><?= $value->name ?></td>
                                                        <td><?= $value->gender ?></td>
                                                        <td><?= $value->birthdate ?></td>

                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>

                                    </div>
                                <?php } ?>
                        </div>
                    </div>



                </div>
                <div class="footer">
                    <div class="footer-image">
                        <img src="<?= base_url("assets/front") ?>/images/header_pdf2.jpg" style="width: 100%;height: 90px;" />
                    </div>
                </div>

            </div>
        </div>




        <?php if ($page_break) { ?>

                <div class="page_print">
                    <div class="subpage">
                        <div class="header-image">
                            <img src="<?= base_url("assets/front") ?>/images/header_pdf2.jpg" class="img-responsive" style="width: 100%;height: 100px;" />
                        </div>

                        <div class="main-content rtl">

                            <div class="reservation-travellers-info">
                                <h3 class="text-center mbt10">افراد على الاستمارة</h3>

                                <div class="row">

                                    <?php if (isset($reservation_traveller_third_table) && count($reservation_traveller_third_table) > 0) { ?>
                                        <div class="col-md-6 fr">


                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>نوع الأفراد</th>
                                                        <th>تاريخ الميلاد</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($reservation_traveller_third_table as $value) { ?>
                                                        <tr>
                                                            <td><?= $value->name ?></td>
                                                            <td><?= $value->gender ?></td>
                                                            <td><?= $value->birthdate ?></td>

                                                        </tr>
                                                    <?php } ?>



                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>
                                    <?php if (isset($reservation_traveller_fourth_table) && count($reservation_traveller_fourth_table) > 0) { ?>
                                        <div class="col-md-6 fr">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>النوع </th>
                                                        <th>تاريخ الميلاد</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($reservation_traveller_fourth_table as $value) { ?>
                                                        <tr>
                                                            <td><?= $value->name ?></td>
                                                            <td><?= $value->gender ?></td>
                                                            <td><?= $value->birthdate ?></td>

                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>

                                        </div>
                                    <?php } ?>
                                </div>
                            </div>



                        </div>

                        <div class="footer">
                            <div class="footer-image">
                                <img src="<?= base_url("assets/front") ?>/images/header_pdf2.jpg" class="img-responsive" style="width: 100%;height: 100px;" />
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>

    </div>

</body>
