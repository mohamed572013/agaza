
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

                        <div class="col-md-3 fr"><strong>رقم الإستمارة :</strong><?= ($reservation_detail[0]) ? $reservation_detail[0]->id : ''; ?></div>
                        <div class="col-md-2 fr"><strong>كود الإستمارة :</strong><?= ($reservation_detail[0]) ? $reservation_detail[0]->reservation_code : ''; ?></div>
                        <div class="col-md-5 fr"><strong>اسم البرنامج :</strong><?= ($program_detail) ? $program_detail->title_ar : ''; ?></div>
                        <div class="col-md-2 fr"><strong>كود البرنامج :</strong><?= ($program_detail) ? $program_detail->our_code : ''; ?></div>
                        <div class="col-md-4 fr"><strong>الفندق :</strong><?= ($program_detail) ? $program_detail->our_code : ''; ?></div>
                        <div class="col-md-4 fr"><strong>مدة الرحلة :</strong><?= ($program_detail) ? $program_detail->nights + 1 : ''; ?></div>
                        <div class="col-md-4 fr"><strong>تاريخ الرحلة :</strong><?= ($program_dates) ? $program_dates[0]->going_date : ''; ?></div>

                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="reservation-traverllers-number-info">
                        <h3 class="text-center mbt10">حجز الأطفال و الرضع</h3>


                        <?php if ($reservation_detail && !empty($reservation_detail[0]->no_of_child) && $reservation_detail[0]->no_of_child != 0) { ?>
                                <div class="col-md-3 fr"><strong>عدد الأطفال :</strong><?= $reservation_detail[0]->no_of_child ?></div>
                                <div class="col-md-3 fr"><strong>السعر  :</strong><?= $program_dates[0]->child_price * $reservation_detail[0]->no_of_child ?></div>
                            <?php } ?>
                        <?php if ($reservation_detail && !empty($reservation_detail[0]->no_of_infant) && $reservation_detail[0]->no_of_infant != 0) { ?>
                                <div class="col-md-3 fr"><strong>عدد الرضع :</strong><?= $reservation_detail[0]->no_of_infant ?></div>
                                <div class="col-md-3 fr"><strong>السعر  :</strong><?= $program_dates[0]->infant_price * $reservation_detail[0]->no_of_infant ?></div>
                            <?php } ?>

                    </div>

                    <div class="clearfix"></div>
                    <hr>


                    <div class="reservation-rooms-reserved-info">

                        <h3 class="text-center mbt10">حجز الغرف</h3>
                        <?php
                            $total_price = 0;
                            if ($closed_room && !empty($closed_room)) {
                                foreach ($closed_room as $value) {
                                    $room_price = 0;
                                    $room_price = $value->no_of_rooms * $value->no_of_bed * $value->price;
                                    $total_price +=$room_price;
                                    ?>
                                    <div class="col-md-4 fr"><strong>نوع الغرفة :</strong><?= ($value->title_ar) ? $value->title_ar : ''; ?></div>
                                    <div class="col-md-4 fr"><strong>عدد الغرف :</strong><?= ($value->no_of_rooms) ? $value->no_of_rooms : ''; ?></div>
                                    <div class="col-md-4 fr"><strong>السعر :</strong><?= ($room_price) ? $room_price : ''; ?></div>
                                <?php } ?>
                            <?php } ?>

                    </div>
                    <div class="clearfix"></div>
                    <hr>

                    <div class="reservation-services-cards-info">
                        <h3 class="text-center mbt10"> الخدمات الأضافية على الأستمارة</h3>
                        <?php if ($reservation_extra_services_card && !empty($reservation_extra_services_card)) { ?>
                                <?php foreach ($reservation_extra_services_card as $value) { ?>
                                    <div class="col-md-6 fr"><strong>الاسم :</strong><?= ($value->title_ar) ? $value->title_ar : ''; ?></div>
                                    <div class="col-md-6 fr"><strong>السعر :</strong><?= ($value->price) ? $value->price : ''; ?></div>
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
                                    <div class="col-md-4 fr"><strong>الاسم :</strong><?= $value->title_ar ?></div>
                                    <div class="col-md-4 fr"><strong>عدد الأفراد :</strong><?= $value->number_of_traveller ?></div>
                                    <div class="col-md-4 fr"><strong>السعر :</strong><?= $value->price * $value->number_of_traveller ?></div>

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
