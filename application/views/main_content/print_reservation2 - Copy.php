
<head>
    <title>طباعة الأستمارة</title>
    <link href="<?= base_url("assets/front") ?>/css/bootstrap-rtl.css" rel="stylesheet">
    <link href="<?= base_url("assets/front") ?>/css/style.css" rel="stylesheet">
    <link href="<?= base_url("assets/front") ?>/css/customs.css" rel="stylesheet">
</head>
<body>
    <div class="container print">


        <div class="header-image">
            <img src="images/header_ga.jpg" class="img-responsive" style="    width: 100%;height: 100px;" />
        </div>
        <div class="main-content">
            <div class="head-booker-info">
                <h3 class="text-center"> بيانات العميل</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>البريد الإلكترونى</th>
                            <th>العنوان</th>
                            <th>التليفون</th>
                            <th>تاريخ الميلاد</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $reservation_detail[0]->head_booker_name; ?></td>
                            <td><?= $reservation_detail[0]->head_booker_email; ?></td>
                            <td><?= $reservation_detail[0]->head_booker_address; ?></td>
                            <td><?= $reservation_detail[0]->head_booker_phone; ?></td>
                            <td><?= $reservation_detail[0]->head_booker_birthdate; ?></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="flight-reservation-info">
                <h3 class="text-center"> بيانات الرحلة</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>رقم الإستمارة</th>
                            <th>كود الإستمارة</th>
                            <th>اسم البرنامج</th>
                            <th>كود البرنامج</th>
                            <th>الفندق</th>
                            <th>مدة الرحلة</th>
                            <th>تاريخ الرحلة</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $reservation_detail[0]->id; ?></td>
                            <td><?= $reservation_detail[0]->reservation_code; ?></td>
                            <td><?= $program_detail->title_ar ?></td>
                            <td><?= $program_detail->our_code ?></td>
                            <td><?= $program_detail->our_code ?></td>
                            <td><?= $program_detail->nights + 1 ?></td>
                            <td><?= $program_dates[0]->going_date ?></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="reservation-traverllers-number-info" style="width:60%;margin: auto;">
                <h3 class="text-center">حجز الأطفال و الرضع</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>عدد الأطفال</th>
                            <th>يعر الطفل</th>
                            <th>عدد الرضع</th>
                            <th>سعر الرضيع</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td><?= $reservation_detail[0]->no_of_child ?></td>
                            <td><?= $program_dates[0]->child_price ?></td>
                            <td><?= $reservation_detail[0]->no_of_infant ?></td>
                            <td><?= $program_dates[0]->infant_price ?></td>

                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="reservation-rooms-reserved-info" style="width:60%;margin: auto;">

                <h3 class="text-center">حجز الغرف</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>نوع الغرفة</th>
                            <th>عدد الغرف</th>
                            <th> السعر</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $total_price = 0;
                            foreach ($closed_room as $value) {
                                $room_price = 0;
                                $room_price = $value->no_of_rooms * $value->no_of_bed * $value->price;
                                $total_price +=$room_price;
                                ?>
                                <tr>
                                    <td><?= $value->title_ar ?></td>
                                    <td><?= $value->no_of_rooms ?></td>
                                    <td><?= $room_price ?></td>


                                </tr>
                            <?php } ?>
<!--                <td colspan="2" class="text-left">الإجمالى</td>
<td></td>-->
                    </tbody>
                </table>

            </div>
            <div class="reservation-services-cards-info" style="width:60%;margin: auto;">
                <h3 class="text-center"> الخدمات الأضافية على الأستمارة</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>السعر</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservation_extra_services_card as $value) { ?>
                                <tr>
                                    <td><?= $value->title_ar ?></td>
                                    <td><?= $value->price ?></td>

                                </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="reservation-services-persons-info" style="width:60%;margin: auto;">
                <h3 class="text-center"> الخدمات الأضافية على الأستمارة</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>عدد الأفراد</th>
                            <th>السعر</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservation_extra_services_persons as $value) { ?>
                                <tr>
                                    <td><?= $value->title_ar ?></td>
                                    <td><?= $value->number_of_traveller ?></td>
                                    <td><?= $value->price * $value->number_of_traveller ?></td>

                                </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="reservation-travellers-info" style="width:60%;margin: auto;">
                <h3 class="text-center">افراد على الاستمارة</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>عدد الأفراد</th>
                            <th>السعر</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservation_traveller as $value) { ?>
                                <tr>
                                    <td><?= $value->name ?></td>
                                    <td><?= $value->gender ?></td>
                                    <td><?= $value->birthdate ?></td>

                                </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="footer-image">
            <img src="images/footer_ga.jpg" class="img-responsive" style="    width: 100%;height: 150px;" />
        </div>


    </div>
</body>