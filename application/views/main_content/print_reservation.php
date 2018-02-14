<head>
    <title> . </title>
    <link href="<?= base_url("assets/front") ?>/css/bootstrap-rtl.css" rel="stylesheet">
    <link href="<?= base_url("assets/front") ?>/style.css" rel="stylesheet">
    <link href="<?= base_url("assets/front") ?>/css/custom.css" rel="stylesheet">
</head>
<body style="direction: rtl">

    <div class="container print">
        <!--        <div class="row">
                    News Wrap
                    ==============================================================
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header-image">

                        </div>
                        <div class="phead">
                            <img src="images/header_ga.jpg" class="img-responsive" style="    width: 100%;height: 100px;" />
                        </div>

                        <h4 class="text-center">  <span> رقم الاستمارة : </span> <span> <?= $reservation_detail[0]->id ?></span>  </h4>
                        <h4 class="text-center">  <span > كود الاستمارة : </span> <span> <?= $reservation_detail[0]->reservation_code ?></span>  </h4>

                        <br>
                        <div class="row">
                            <div class="col-lg-4 pull-right"><strong>اسم البرنامج :</strong>    <?= $program_detail->title_ar ?> </div>

                            <div class="col-lg-4 pull-left"> <strong>  مدة الرحلة :</strong>   <?= $program_detail->nights + 1; ?> أيام / <?= $program_detail->nights; ?> ليالى | <?= $program_detail->stars; ?>نجوم  / <?= $program_detail->programs_levels_title; ?>
                            </div>
                            <div class="col-lg-4 pull-left"> <strong>تاريخ الرحلة :</strong> <?= $program_dates[0]->going_date ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 pull-right"><strong>كود البرنامج :</strong>    <?= $program_detail->our_code ?> </div>
                            <div class="col-lg-4 pull-right"> <strong>     فندق مكة :</strong> <?= $program_detail->maka_name . "  - " . $program_detail->maka_nights . " ليالي"; ?></div>

                            <div class="col-lg-4 pull-left  ">   <strong>  فندق المدينة   :</strong> <?= $program_detail->madina_name . "  - " . $program_detail->madina_nights . " ليالي"; ?> </div>
                        </div>
                        <hr>


                        <h4 class="text-center"> بيانات العميل</h4>
                        <br>

                        <div class="row">
                            <div class="col-lg-3 pull-right"><strong>الاسم :</strong> <?= $reservation_detail[0]->head_booker_name; ?> </div>
        <?php if ($reservation_detail[0]->head_booker_email != "") { ?>
                                                                                                                                    <div class="col-lg-3 pull-left"> <strong>البريد الاليكترونى :</strong>  <?= $reservation_detail[0]->head_booker_email; ?></div>
            <?php } ?>
        <?php if ($reservation_detail[0]->head_booker_address != "") { ?>
                                                                                                                                    <div class="col-lg-3 pull-right"><strong>العنوان :</strong>   <?= $reservation_detail[0]->head_booker_address; ?>   </div>
            <?php } ?>
        <?php if ($reservation_detail[0]->head_booker_phone != "") { ?>
                                                                                                                                    <div class="col-lg-3 pull-left"> <strong>تليفون :</strong>  <?= $reservation_detail[0]->head_booker_phone; ?></div>
            <?php } ?>
                        </div>

                        <br>

                        <br>
                        <h4 class="text-center"> حجز الاطفال والرضع        </h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr class="active">
                                            <th>عدد الاطفال</th>
                                            <th> سعر الطفل </th>
                                            <th>عدد الرضع</th>
                                            <th> سعر الرضيع </th>

                                        </tr>
                                        <tr class="success">
        <?php
            $total_price +=($program_dates[0]->infant_price * $reservation_detail[0]->no_of_infant ) + ($program_dates[0]->child_price * $reservation_detail[0]->no_of_child );
        ?>
                                            <td><?= $reservation_detail[0]->no_of_child ?></td>
                                            <td><?= $program_dates[0]->child_price ?></td>
                                            <td><?= $reservation_detail[0]->no_of_infant ?></td>
                                            <td><?= $program_dates[0]->infant_price ?></td>


                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>

                        <hr>

        <?php
            if (count($closed_room) > 0) {
                ?>
                                                                                                                                <h4 class="text-center">حجز الغرف</h4>
                                                                                                                                <br>

                <?php
                foreach ($closed_room as $value) {
                    $room_price = 0;
                    $room_price = $value->no_of_rooms * $value->no_of_bed * $value->price;
                    $total_price +=$room_price;
                    ?>

                                                                                                                                                                                    <div class="row">
                                                                                                                                                                                        <div class="col-lg-4 pull-right"><strong>نوع الغرفة :</strong> <?= $value->title_ar; ?> </div>

                                                                                                                                                                                        <div class="col-lg-4 pull-right"> <strong>عدد الغرف :</strong> <?= $value->no_of_rooms; ?></div>
                                                                                                                                                                                        <div class="col-lg-4 pull-right"> <strong>  اجمالى السعر     :</strong> <?= $room_price; ?></div>
                                                                                                                                                                                    </div>
                    <?php
                }
            }
        ?>


                        <br>
        <?php
            if (count($reservation_extra_services_card) > 0) {
                ?>
                                                                                                                                <h4 class="text-center">الخدمات الاضافية على الاستمارة</h4>
                                                                                                                                <br>
                <?php
                foreach ($reservation_extra_services_card as $value) {
                    $total_price +=$value->price;
                    ?>
                                                                                                                                                                                    <div class="row">
                                                                                                                                                                                        <div class="col-lg-6 pull-right"><strong>الاسم :</strong>        <?= $value->title_ar ?></div>

                                                                                                                                                                                        <div class="col-lg-6 pull-left"> <strong>السعر :</strong> <?= $value->price ?> جنية مصري</div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                    <hr>

                    <?php
                }
            }
        ?>
                        <br>
        <?php
            if (count($reservation_extra_services_persons) > 0) {
                ?>
                                                                                                                                <h4 class="text-center">الخدمات الاضافية على الافراد</h4>
                                                                                                                                <br>
                <?php
                foreach ($reservation_extra_services_persons as $value) {
                    $total_price +=$value->price * $value->number_of_traveller;
                    ?>
                                                                                                                                                                                    <div class="row">
                                                                                                                                                                                        <div class="col-lg-4 pull-right"><strong>الاسم :</strong>        <?= $value->title_ar ?></div>
                                                                                                                                                                                        <div class="col-lg-4 pull-right"><strong>عدد الافراد :</strong>        <?= $value->number_of_traveller ?></div>

                                                                                                                                                                                        <div class="col-lg-4 pull-left"> <strong>السعر :</strong> <?= $value->price * $value->number_of_traveller ?> جنية مصري</div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                    <hr>

                    <?php
                }
            }
        ?>
                        <br>
        <?php if ($reservation_detail[0]->note != "") { ?>
                                                                                                                                <div class="row">
                                                                                                                                    <div class="col-lg-12"><strong>ملاحظات :</strong> <?= $reservation_detail[0]->note ?>      </div>

                                                                                                                                </div>
            <?php } ?>

                        <hr>
                        <br>
        <?php
            if (count($reservation_traveller) > 0) {
                ?>
                                                                                                                                <h4 class="text-center">افراد على الاستمارة</h4>
                                                                                                                                <br>
                                                                                                                                <div class="row">
                                                                                                                                    <div class="col-lg-12">
                                                                                                                                        <table class="table table-bordered">
                                                                                                                                            <tbody>
                                                                                                                                                <tr class="active">
                                                                                                                                                    <th>مسلسل</th>
                                                                                                                                                    <th>اسم</th>
                                                                                                                                                    <th>نوع</th>
                                                                                                                                                    <th>تاريخ الميلاد</th>


                                                                                                                                                </tr>
                <?php
                $j = 0;
                foreach ($reservation_traveller as $value) {
                    $j++;
                    ?>
                                                                                                                                                                                                    <tr class="success">
                                                                                                                                                                                                        <td><?= $j ?></td>
                                                                                                                                                                                                        <td><?= $value->name ?></td>
                                                                                                                                                                                                        <td><?= $value->gender == "0" ? " ذكر" : " انثى" ?></td>
                                                                                                                                                                                                        <td><?= $value->birthdate ?></td>

                                                                                                                                                                                                    </tr>
                    <?php
                }
                ?>
                                                                                                                                            </tbody>
                                                                                                                                        </table>
                                                                                                                                    </div>
                <?php
            }
        ?>




                        </div>

                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-lg-6 pull-left"><strong>اجمالى السعر :</strong> <?= $total_price ?> جنهيا مصريا فط لاغير</div>


                        </div>





                        <div class="pfooter">
                            <img src="images/footer_ga.jpg" class="img-responsive" style="    width: 100%;height: 150px;" />
                        </div>



                    </div>




                </div>-->
    </div>

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
                <td colspan="2" class="text-left">الإجمالى</td>
                <td><?= $total_price ?></td>
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

</body>
