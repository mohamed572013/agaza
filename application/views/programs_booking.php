

<!-- Page Header
============================================================== -->
<div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?= base_url("assets/front/images/page-title-bg.jpg"); ?>'); background-size: cover ">
    <div class="page-head-wrap">
        <h1 class="page-head-title"><span><?= $program_detail->programs_seasons_title; ?></span></h1>
        <div class="page-head-subtitle"><?= $program_detail->title_ar; ?></div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- News Wrap
        ============================================================== -->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="news-wrap">
                <div class="row">



                    <div id="search_dates_result">
                        <?php
                            if (\count($program_dates) > 0) {
                                ?>
                                <div class="col-md-12">
                                    <h4>السعر حسب طبيعة الدور	</h4>
                                    <table class="table table-bordered table-hover">
                                        <thead class="alert-success">
                                            <tr>
                                                <th>تاريخ الرحلة</th>
                                                <th>المتاح طيران  </th>
                                                <th>المتاح حسب طبيعة الدور </th>

                                                <th>السعر حسب طبيعة الدور </th>
                                                <th>  سعر الطفل  </th>
                                                <th> سعر الرضيع</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $value = $program_dates[0];
                                            $avaliable = $value->no_of_beds - $value->no_of_beds_reserved;
                                            echo "<tr>
                                                <td>$value->going_date</td>
                                                <td>$value->flight_available</td>
                                                <td>$avaliable</td>
                                                <td>$value->price_for_bed</td>
                                                <td>$value->child_price</td>
                                                <td>$value->infant_price</td>
                                        </tr>";
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }
                        ?>
                        <?php
                            if (\count($program_dates) > 0 && \count($ProgramRooms_prices) > 0) {
                                ?>
                                <div class="col-md-12">
                                    <h4>سعر الفرد فى الغرفة</h4>
                                    <table class="table table-bordered table-hover">
                                        <thead class="alert-success">
                                            <tr>
                                                <th>تاريخ الرحلة</th>
                                                <th>  نوع الغرفة</th>
                                                <th>  السعر    </th>
                                                <th>   المتاح</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($ProgramRooms_prices as $value) {
                                                if ($value->going_date == $program_dates[0]->going_date) {
                                                    $avaliable_room = $value->number_of_rooms - $value->number_of_rooms_reserved;
                                                    echo "<tr>
                                                            <td>$value->going_date</td>
                                                            <td>$value->title_ar</td>
                                                            <td>$value->price</td>
                                                            <td>$avaliable_room</td>
                                                    </tr>";
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }
                        ?>
                    </div>


                </div>

                <?php if ($program_dates[0]->flight_available > 0) { ?>
                        <ul class="nav nav-tabs">
                            <li   class="active"><a data-toggle="tab" href="#sectiona">حجز مجموعات</a></li>
                            <li><a data-toggle="tab" href="#sectionB">حجز افراد</a></li>

                        </ul>
                        <div class="tab-content">

                            <div id="sectiona" class="tab-pane fade in active">
                                <form id="booking_groups_form" method="post">
                                    <h5>بيانات العميل</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>  الاسم :</label>
                                            <input type="text" name="head_booker_name" id="head_booker_name" required="required"/>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>  التليفون :</label>
                                            <input type="text" name="head_booker_phone" id="head_booker_phone"  />
                                        </div>
                                        <div class="col-lg-4">
                                            <label>   الايميل :</label>
                                            <input   name="head_booker_email" id="head_booker_email"  />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>  العنوان :</label>
                                            <input type="text" name="head_booker_address" id="head_booker_address"  />
                                        </div>
                                        <div class="col-lg-4">
                                            <label>  تاريخ الميلاد :</label>
                                            <input type='date'   name="head_booker_birthdate" id="head_booker_birthdate"  max="<?= date("Y-m-d"); ?>"  class="form-control" />

                                        </div>
                                    </div>
                                    <hr/>
                                    <h5>حجز حسب طبيعة الدور</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>  عدد الاسرة :</label>
                                            <input type="number" min="0" max="<?= $avaliable ?>" value="0" name="no_of_beds" id="no_of_beds" />
                                            <input type="number"  style="display: none" value="<?= $program_dates[0]->price_for_bed ?>" name="price_for_one_bed" id="price_for_one_bed" />
                                        </div>
                                        <div class="col-lg-4">
                                            <label>       رجال:</label>
                                            <input type="number" min="0" max="<?= $avaliable ?>" value="0" name="no_of_beds_men" id="no_of_beds_men" />
                                        </div>
                                        <div class="col-lg-4">
                                            <label>       نساء:</label>
                                            <input type="number" min="0" max="<?= $avaliable ?>" value="0" name="no_of_beds_weman" id="no_of_beds_weman" />
                                        </div>
                                    </div>
                                    <hr/>
                                    <h5>حجز اطفال ورضع</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>  عدد  الاطفال :</label>
                                            <input type="number" min="0"  value="0" name="no_of_child" id="no_of_child" />
                                            <input type="number"  style="display: none"  value="<?= $program_dates[0]->child_price ?>" name="child_price" id="child_price" />
                                        </div>
                                        <div class="col-lg-4">
                                            <label>       عدد الرضع:</label>
                                            <input type="number" min="0"   value="0" name="no_of_infant" id="no_of_infant" />
                                            <input type="number"  style="display: none"  value="<?= $program_dates[0]->infant_price ?>" name="infant_price" id="infant_price" />
                                        </div>
                                    </div>
                                    <hr/>
                                    <h5>حجز  غرف مغلقة  </h5>
                                    <div class="row">

                                        <?php
                                        if (\count($booking_room_details) > 0 && $booking_room_details[0]->hotel_rooms_id > 0) {
                                            $i = 0;
                                            foreach ($booking_room_details as $value) {
                                                if ($value->max_room_num > 0) {
                                                    $i++;
                                                    ?>
                                                    <div class="col-lg-12">

                                                        <div class="col-lg-4">
                                                            <label class="col-lg-12">  نوع الغرفة    :</label>
                                                            <select  class="col-lg-12 form-control" required="required"   name="programs_rooms_prices_id[]"  >
                                                                <option value="<?= $value->programs_rooms_prices_id; ?>"><?= $value->title_ar; ?></option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label>  عدد  الغرف  :</label>
                                                            <select  class="col-lg-12 form-control " required="required"   name="room_closed_number[]"  >
                                                                <?php
                                                                for ($index = 0; $index <= $value->max_room_num; $index++) {
                                                                    echo "<option value='$index'>$index</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-lg-4" style="display: none">
                                                            <label>  room id     :</label>
                                                            <input type="number"   name="hotel_rooms_bed[]" value="<?= $value->hotel_rooms_bed ?>"/>
                                                            <input type="number"   name="hotel_rooms_id[]" value="<?= $value->hotel_rooms_id ?>"/>
                                                            <input type="number"   name="hotel_rooms_price[]" value="<?= $value->price ?>"/>
                                                        </div>

                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <hr/>
                                                    <?php
                                                }
                                            }if ($i == 0) {
                                                echo "<li>لا يوجد غرف متاحة للحجز </li>";
                                            }
                                        } else {
                                            echo "<li>لا يوجد غرف متاحة للحجز </li>";
                                        }
                                        ?>

                                    </div>
                                    <?php
                                    if (\count($programs_extra_service_cards) > 0 && $programs_extra_service_cards[0]->programs_extra_service_id > 0) {
                                        ?>
                                        <h5>حجز حدمات اضافية على الاستمارة</h5>
                                        <div class="row">
                                            <?php
                                            $i = -1;
                                            foreach ($programs_extra_service_cards as $value) {
                                                $i++;
                                                ?>
                                                <div   class="pull-right col-xs-4 col-sm-4 col-md-4 col-lg-4 list-group-item padding-0-4">
                                                    <input type="checkbox"   value="<?= $value->programs_extra_service_id ?>" name="programs_extra_service_cards[]"/>
                                                    <?= $value->title_ar . "   السعر    : " . $value->price . " جنية " ?>
                                                    <input style="display: none" type="number" value="<?= $value->price ?>" id="programs_extra_service_cards_<?= $i; ?>"  name="programs_extra_service_price_card[]"/>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <hr/>
                                    <?php
                                    if (\count($programs_extra_service_person) > 0 && $programs_extra_service_person[0]->programs_extra_service_id > 0) {
                                        ?>
                                        <h5>حجز حدمات اضافية على الافراد</h5>
                                        <div class="row">
                                            <?php
                                            foreach ($programs_extra_service_person as $value) {
                                                ?>
                                                <div class="col-lg-12">
                                                    <div class="col-lg-4">
                                                        <label class="col-lg-12">   اسم الخدمه      :</label>
                                                        <select  class="col-lg-12 form-control" required="required"   name="programs_extra_service_person[]"  >
                                                            <option value="<?= $value->programs_extra_service_id; ?>"><?= $value->title_ar . "   السعر للفرد  : " . $value->price . " جنية "; ?></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>  عدد  الافراد  :</label>
                                                        <select  class="col-lg-12 form-control" required="required"   name="programs_extra_service_person_number[]"  >
                                                            <?php
                                                            for ($index = 0; $index <= $program_dates[0]->flight_available; $index++) {
                                                                echo "<option value='$index'>$index</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input style="display: none" type="number" value="<?= $value->price ?>" name="programs_extra_service_price_person[]"/>
                                                    </div>

                                                </div>
                                            <?php } ?>
                                        </div>
                                        <hr/>
                                        <table class="table table-bordered">
                                            <thead>
                                            <th>اجمالى سعر الاستمارة بالجنية</th>
                                            <th id="final_price_close_card">0</th>
                                            </thead>
                                        </table>

                                        <?php
                                    }
                                    ?>
                                    <hr/>
                                    <div class="col-lg-12">
                                        <label>   ملاحظات   :</label>
                                        <textarea cols="30" rows="5" name="note" ></textarea>

                                    </div>
                                    <hr/>

                                    <div class="col-lg-12" id="closed_booking_form_error"></div>
                                    <div class="col-lg-12">
                                        <input style="display: none" type="number" value="<?= $program_dates[0]->programs_flight_id ?>" name="programs_flight_id"/>
                                        <input style="display: none" type="number" value="<?= $program_id ?>" name="program_id"/>
                                        <input style="display: none" type="text" value="<?= $program_coude ?>" name="program_coude"/>
                                        <input style="display: none" type="number" value="<?= $flight_reservation_id ?>" name="flight_reservation_id"/>
                                        <button class="btn btn-success " type="submit">
                                            حفظ
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div id="sectionB" class="tab-pane fade">

                                <form id="booking_persons_form" method="post">
                                    <h5>بيانات المعتمرين</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>اجمالى عدد الافراد من بالغين واطفال ورضع</label>
                                            <input type="number" min="1" max="<?= $program_dates[0]->flight_available; ?>" name="traveller_number" id="traveller_number" required="required"/>
                                        </div>

                                    </div>

                                    <h5>حجز حسب طبيعة الدور</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>  عدد الاسرة :</label>
                                            <input type="number" min="0" max="<?= $avaliable >= 15 ? "15" : $avaliable ?>" value="0" name="no_of_beds_persons" id="no_of_beds_persons" />
                                            <input type="number"  style="display: none" value="<?= $program_dates[0]->price_for_bed ?>" name="price_for_one_bed_persons" id="price_for_one_bed_persons" />
                                        </div>
                                        <div class="col-lg-4">
                                            <label>       رجال:</label>
                                            <input type="number" min="0" max="<?= $avaliable ?>" value="0" name="no_of_beds_men_persons" id="no_of_beds_men_persons" />
                                        </div>
                                        <div class="col-lg-4">
                                            <label>       نساء:</label>
                                            <input type="number" min="0" max="<?= $avaliable ?>" value="0" name="no_of_beds_weman_persons" id="no_of_beds_weman_persons" />
                                        </div>
                                    </div>
                                    <hr/>
                                    <h5>حجز اطفال ورضع</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>  عدد  الاطفال :</label>
                                            <input type="number" min="0"  value="0" name="no_of_child_persons" id="no_of_child_persons" />
                                            <input type="number"  style="display: none"  value="<?= $program_dates[0]->child_price ?>" name="child_price_persons" id="child_price_persons" />
                                        </div>
                                        <div class="col-lg-4">
                                            <label>       عدد الرضع:</label>
                                            <input type="number" min="0"   value="0" name="no_of_infant_persons" id="no_of_infant_persons" />
                                            <input type="number"  style="display: none"  value="<?= $program_dates[0]->infant_price ?>" name="infant_price_persons" id="infant_price_persons" />
                                        </div>
                                    </div>
                                    <hr/>
                                    <h5>حجز  غرف مغلقة  </h5>
                                    <div class="row">

                                        <?php
                                        if (\count($booking_room_details) > 0 && $booking_room_details[0]->hotel_rooms_id > 0) {
                                            $i = 0;
                                            foreach ($booking_room_details as $value) {
                                                if ($value->max_room_num > 0) {
                                                    $i++;
                                                    ?>
                                                    <div class="col-lg-12">

                                                        <div class="col-lg-4">
                                                            <label class="col-lg-12">  نوع الغرفة    :</label>
                                                            <select  class="col-lg-12 form-control" required="required"   name="programs_rooms_prices_id_persons[]"  >
                                                                <option value="<?= $value->programs_rooms_prices_id; ?>"><?= $value->title_ar; ?></option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label>  عدد  الغرف  :</label>
                                                            <select  class="col-lg-12 form-control" required="required"   name="room_closed_number_persons[]"  >
                                                                <?php
                                                                for ($index = 0; $index <= $value->max_room_num; $index++) {
                                                                    echo "<option value='$index'>$index</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-lg-4" style="display: none">
                                                            <label>  room id     :</label>
                                                            <input type="number"   name="hotel_rooms_bed_persons[]" value="<?= $value->hotel_rooms_bed ?>"/>
                                                            <input type="number"   name="hotel_rooms_id_persons[]" value="<?= $value->hotel_rooms_id ?>"/>
                                                            <input type="number"   name="hotel_rooms_price_persons[]" value="<?= $value->price ?>"/>
                                                        </div>

                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <hr/>
                                                    <?php
                                                }
                                            }if ($i == 0) {
                                                echo "<li>لا يوجد غرف متاحة للحجز </li>";
                                            }
                                        } else {
                                            echo "<li>لا يوجد غرف متاحة للحجز </li>";
                                        }
                                        ?>

                                    </div>
                                    <?php
                                    if (\count($programs_extra_service_cards) > 0 && $programs_extra_service_cards[0]->programs_extra_service_id > 0) {
                                        ?>
                                        <h5>حجز حدمات اضافية على الاستمارة</h5>
                                        <div class="row">
                                            <?php
                                            foreach ($programs_extra_service_cards as $value) {
                                                ?>
                                                <div   class="pull-right col-xs-4 col-sm-4 col-md-4 col-lg-4 list-group-item padding-0-4">
                                                    <input type="checkbox"   value="<?= $value->programs_extra_service_id ?>" name="programs_extra_service_cards_persons[]"/>
                                                    <?= $value->title_ar . "   السعر    : " . $value->price . " جنية " ?>
                                                    <input style="display: none" type="number" value="<?= $value->price ?>"  name="programs_extra_service_price_card_persons[]"/>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <hr/>
                                    <?php
                                    if (\count($programs_extra_service_person) > 0 && $programs_extra_service_person[0]->programs_extra_service_id > 0) {
                                        ?>
                                        <h5>حجز حدمات اضافية على الافراد</h5>
                                        <div class="row">
                                            <?php
                                            foreach ($programs_extra_service_person as $value) {
                                                ?>
                                                <div class="col-lg-12">
                                                    <div class="col-lg-4">
                                                        <label class="col-lg-12">   اسم الخدمه      :</label>
                                                        <select  class="col-lg-12 form-control" required="required"   name="programs_extra_service_person_persons[]"  >
                                                            <option value="<?= $value->programs_extra_service_id; ?>"><?= $value->title_ar . "   السعر للفرد  : " . $value->price . " جنية "; ?></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label>  عدد  الافراد  :</label>
                                                        <select  class="col-lg-12 form-control" required="required"   name="programs_extra_service_person_number_persons[]"  >
                                                            <?php
                                                            $max_number = $program_dates[0]->flight_available;
                                                            if ($max_number > 15) {
                                                                $max_number = 15;
                                                            }
                                                            for ($index = 0; $index <= $max_number; $index++) {
                                                                echo "<option value='$index'>$index</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <input style="display: none" type="number" value="<?= $value->price ?>" name="programs_extra_service_price_person_persons[]"/>
                                                    </div>

                                                </div>
                                            <?php } ?>
                                        </div>
                                        <hr/>
                                        <h5> بيانات المعتمرين</h5>
                                        <div class="row" id="traveller_information">
                                        </div>
                                        <hr/>
                                        <table class="table table-bordered">
                                            <thead>
                                            <th>اجمالى سعر الاستمارة بالجنية</th>
                                            <th id="final_price_persons_card">0</th>
                                            </thead>
                                        </table>

                                        <?php
                                    }
                                    ?>
                                    <hr/>
                                    <div class="col-lg-12">
                                        <label>   ملاحظات   :</label>
                                        <textarea cols="30" rows="5" name="note_persons" ></textarea>

                                    </div>
                                    <hr/>

                                    <div class="col-lg-12" id="persons_booking_form_error"></div>
                                    <div class="col-lg-12">
                                        <input style="display: none" type="number" value="<?= $program_dates[0]->programs_flight_id ?>" name="programs_flight_id"/>
                                        <input style="display: none" type="number" value="<?= $program_id ?>" name="program_id"/>
                                        <input style="display: none" type="text" value="<?= $program_coude ?>" name="program_coude"/>
                                        <input style="display: none" type="number" value="<?= $flight_reservation_id ?>" name="flight_reservation_id"/>
                                        <button class="btn btn-success " type="submit">
                                            حفظ
                                        </button>
                                    </div>
                                </form>

                            </div>




                        </div>


                        <?php
                    } else {
                        echo '<li> لا يوجد تذاكر طيران لهذه الرحلة لذلك لا يمكنك الحجز </li>';
                    }
                ?>





            </div>
        </div>



        <!-- Sidebar
        ============================================================== -->
        <?php $this->load->view("components/side_bar"); ?>


    </div></div>


