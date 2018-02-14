
<!-- INNER-BANNER -->
<div class="inner-banner style-6">
    <img class="center-image" src="<?= base_url('img/detail/bg_3.jpg'); ?>" alt="">
    <div class="vertical-align">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <ul class="banner-breadcrumb color-white clearfix">
                        <li><a class="link-blue-2" href="#">الرئيسية</a> /</li>
                        <li><span>تفاصيل البرنامج</span></li>
                    </ul>
                    <h1 class="color-white"><?= $program_details->program_title ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DETAIL WRAPPER -->
<div class="detail-wrapper">
    <div class="container">
        <div class="detail-header">
            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <h1 class="detail-title color-dark-2"><?= $program_details->program_title ?> </h1>
                    <div class="detail-rate rate-wrap clearfix">
                        <div class="rate">
                            <span class="fa fa-star color-yellow"></span>
                            <span class="fa fa-star color-yellow"></span>
                            <span class="fa fa-star color-yellow"></span>
                            <span class="fa fa-star color-yellow"></span>
                            <span class="fa fa-star color-yellow"></span>
                        </div>
                        <i>485 Rewies</i>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <div class="detail-price color-dark-2">السعر يبداء من<span class="color-dr-blue"> <?= $program_details->price_start_from ?> جنيها </span> /للفرد</div>
                </div>
            </div>
       	</div>
        <?php //print_r($program_dates) ?>
       	<div class="row padd-40">
            <div class="col-xs-12 col-md-8">
                <div class="detail-content">
                    <div class="detail-top">
                        <div class="detail-top slider-wth-thumbs style-2">
                            <div class="swiper-container thumbnails-preview" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                                <div class="swiper-wrapper">
                                    <?php if ($program_images) { ?>
                                            <?php foreach ($program_images as $key => $program_image) { ?>
                                                <?php
                                                if ($key == 0) {
                                                    $class_active = 'active';
                                                } else {
                                                    $class_active = '';
                                                }
                                                ?>
                                                <div class="swiper-slide <?= $class_active ?>" data-val="<?= $key ?>">
                                                    <img class="img-responsive img-full" src="<?= base_url('uploads/haj_umrah_programs_slider/' . $program_image->image); ?>">
                                                </div>

                                            <?php } ?>
                                        <?php } ?>
                                </div>
                                <div class="pagination pagination-hidden"></div>
                            </div>
                            <div class="swiper-container thumbnails" data-autoplay="0"
                                 data-loop="0" data-speed="500" data-center="0"
                                 data-slides-per-view="responsive" data-xs-slides="3"
                                 data-sm-slides="5" data-md-slides="5" data-lg-slides="5"
                                 data-add-slides="5">
                                <div class="swiper-wrapper">
                                    <?php if ($program_images) { ?>
                                            <?php foreach ($program_images as $key => $program_image) { ?>
                                                <?php
                                                if ($key == 0) {
                                                    $class_active = 'current active';
                                                } else {
                                                    $class_active = '';
                                                }
                                                ?>
                                                <div class="swiper-slide <?= $class_active ?>" data-val="<?= $key ?>">
                                                    <img class="img-responsive img-full" src="<?= base_url('uploads/haj_umrah_programs_slider/' . $program_image->image); ?>" >
                                                </div>
                                            <?php } ?>
                                        <?php } ?>

                                </div>
                                <div class="pagination hidden"></div>
                            </div>
                        </div>
                    </div>

                    <div class="hotel-icons-block progde" id="details-box">
                        <h4 class="text-right">مميزات البرنامج</h4>
                        <hr>
                        <ul>
                            <?php if ($program_advantages) { ?>
                                    <?php foreach ($program_advantages as $program_advantage) { ?>
                                        <li>
                                            <img class="hotel-icon" src="<?= \base_url("theme/features_image/$program_advantage->image"); ?>" alt="<?= $program_advantage->title_ar ?>" style="  max-width: 24px; max-height: 24px">
            <!--                                            <i data-placement="top" data-toggle="tooltip" class="soap-icon-aircon circle" title="" data-original-title="<?= $program_advantage->title_ar ?>"></i>-->

                                            <span><?= $program_advantage->title_ar ?></span>
                                        </li>
                                    <?php } ?>
                                <?php } ?>

                        </ul>
                        <hr>
                    </div>


                    <div class="detail-content-block" >
                        <div class="simple-tab color-1 tab-wrapper rtl">
                            <div class="tab-nav-wrapper">
                                <div  class="nav-tab  clearfix">
                                    <div class="nav-tab-item active">
                                        الوصف
                                    </div>
                                    <div class="nav-tab-item">
                                        المدن
                                    </div>
                                    <div class="nav-tab-item">
                                        الفنادق
                                    </div>

                                    <div class="nav-tab-item">
                                        خدمات اضافية
                                    </div>
                                    <!--                                    <div class="nav-tab-item">
                                                                            التقيم
                                                                        </div>-->
                                    <div class="nav-tab-item" id="booking-prices-section">
                                        الاسعار و الحجز
                                    </div>

                                </div>
                            </div>
                            <div class="tabs-content clearfix">
                                <div class="tab-info active">
                                    <h3><?= $program_details->program_title ?></h3>
                                    <p><?= $program_details->program_desc ?></p>
                                    <img class="left-img" src="<?= base_url('uploads/haj_umrah_programs/' . $program_details->image); ?>" alt="<?= $program_details->program_title ?>">
                                    <div class="clearfix"></div>
                                    <!--                                    <h4>مميزات البرنامج</h4>
                                                                        <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها.</p>
                                                                        <ul>
                                                                            <li>مميزات مميزات مميزات</li>
                                                                            <li>مميزات مميزات مميزات</li>
                                                                            <li>مميزات مميزات مميزات</li>
                                                                            <li>مميزات مميزات مميزات</li>
                                                                        </ul>-->


                                </div>
                                <div class="tab-info">
                                    <div class="row">
                                        <?php if (!empty($cities)) { ?>
                                                <?php foreach ($cities as $city) { ?>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4 fr">
                                                            <img class="right-img img-responsive"  src="<?= base_url('uploads/places/' . $city->place_image); ?>" alt="">
                                                        </div>
                                                        <div class="col-md-8 fr">
                                                            <h5 class="" style="margin-bottom:5px;"><?= $city->place_title ?></h5>
                                                            <p><?= $city->place_desc_ar ?></p>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>


                                    </div>



                                </div>
                                <div class="tab-info">
                                    <div class="row">
                                        <?php if (!empty($hotels)) { ?>
                                                <?php foreach ($hotels as $hotel) { ?>
                                                    <div class="col-md-12" style="height:150px;margin-bottom: 20px;">
                                                        <a data-toggle="modal" data-target="#myModal_hotel">
                                                            <div class="col-md-4 fr">
                                                                <img class="img-responsive"  src="<?= base_url('uploads/haj_umrah_hotels/' . $hotel->hotel_image); ?>" alt="">
                                                            </div>

                                                            <div class="col-md-8 fr">
                                                                <div class="fr">
                                                                    <h5 class="fr m20"><?= $hotel->hotel_title ?></h5>
                                                                    <div class="rate fr mr20">
                                                                        <?php for ($x = 1; $x <= $hotel->hotel_stars; $x++) { ?>
                                                                            <span class="fa fa-star color-yellow"></span>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>

                                                                <p><?= $hotel->hotel_desc_ar ?></p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>


                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal_hotel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        ...
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>



                                </div>

                                <div class="tab-info">

                                    <ul>
                                        <?php if ($program_services) { ?>
                                                <?php foreach ($program_services as $program_service) { ?>
                                                    <li><?= $program_service->title_ar ?></li>
                                                <?php } ?>
                                            <?php } ?>
                                    </ul>



                                </div>
                                <!--                                <div class="tab-info">
                                                                    <div class="additional-block rtl">
                                                                        <h4 class="additional-title">تعليقات <span class="color-dr-blue-2">(1)</span></h4>
                                                                        <ul class="comments-block">
                                                                            <li class="comment-entry clearfix">
                                                                                <img class="commnent-img" src="img/detail/comment_1.jpg" alt="">
                                                                                <div class="comment-content clearfix">
                                                                                    <div class="tour-info-line">
                                                                                        <div class="tour-info">
                                                                                            <img src="img/calendar_icon_grey.png" alt="">
                                                                                            <span class="font-style-2 color-dark-2">03/07/2016</span>
                                                                                        </div>
                                                                                        <div class="tour-info">
                                                                                            <img src="img/people_icon_grey.png" alt="">
                                                                                            <span class="font-style-2 color-dark-2">بواسطة محمود رمضان</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="comment-text color-grey">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. </div>
                                                                                    <a class="comment-reply c-button b-26 bg-dr-blue-2 hv-dr-blue-2-o" href="#">Reply</a>
                                                                                </div>

                                                                            </li>

                                                                        </ul>
                                                                        <form>
                                                                            <div class="row">
                                                                                <div class="col-xs-12 col-sm-6">
                                                                                    <div class="form-block type-2 clearfix">
                                                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                                            <input type="text" required="" placeholder="الاسم">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-6">
                                                                                    <div class="form-block type-2 clearfix">
                                                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                                                            <input type="text" required="" placeholder="البريد الاليكترونى">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-xs-12">
                                                                                    <div class="form-block type-2 clearfix">
                                                                                        <textarea class="area-style-1 type-2 color-3" style="background: #fff;" required="" placeholder="اكتب تعلقك"></textarea>
                                                                                    </div>
                                                                                    <input type="submit" class="c-button b-40 fr bg-dr-blue-2 hv-dr-blue-2-o" value="ارسال">
                                                                                </div>

                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>-->
                                <div class="tab-info" >
                                    <div class="row margin-10-0 ">
                                        <div class="col-lg-12">
                                            <form action="#" method="post" id="booking_request_form">
                                                <div class="col-lg-8">
                                                    <label class="col-md-4 line40">تاريخ الرحلة :</label>
                                                    <div class="col-md-8">

                                                        <div class="form-group">
                                                            <input type="hidden" name="program_id" id="program_id" value="<?= $program_details->program_id ?>"/>
                                                            <input type="hidden" name="program_title" id="program_title" value="<?= $program_details->program_title ?>"/>
                                                            <select name="program_flight" class="form-control amr color-3" data-placeholder="اختار وجهتك" id="program_flight">
                                                                <option selected disabled>اختر</option>
                                                                <?php foreach ($program_dates as $program_date) { ?>
                                                                        <?php
                                                                        if ($program_flight_id == $program_date->programs_flight_id) {
                                                                            $selected = 'selected';
                                                                        } else {
                                                                            $selected = '';
                                                                        }
                                                                        ?>
                                                                        <option <?= $selected ?> value="<?= $program_date->programs_flight_id ?>"><?= arabicDate($program_date->going_date, true) ?></option>

                                                                    <?php } ?>
                                                            </select>
                                                            <div class="help-block"></div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <!--                                                <div class="col-lg-2">

                                                                                                    <input type="submit" class="btn  right mr30 btn_search_in_program_details c-button b-40   btn-warning"  value="بحث">
                                                                                                </div>-->
                                                <div class="col-lg-2">

                                                    <?php $program_title_url = str_replace(' ', '_', $program_details->program_title) ?>
                                                    <a  data-is-employee="" data-is-guest="" href="<?= site_url('programs/booking/' . $program_title_url . '-' . $program_details->program_flight_id) ?>" class="c-button b-40 bg-dr-blue-2  hv-dr-blue-2-o  booking-btn" onclick="return false;"><span>احجز الان</span></a>
                                                </div>

                                            </form>



                                        </div>

                                        <div id="search_dates_result">
                                            <div class="col-md-12">


                                            </div>
                                            <div class="col-md-12">
                                                <h4>سعر الفرد فى الغرفة</h4>
                                                <div id="program_flight_info">


                                                    <table class="table table-bordered table-hover">
                                                        <thead class="alert-success">
                                                            <tr>
                                                                    <!--<th>تاريخ الرحلة</th>-->
                                                                <th>  نوع الغرفة</th>
                                                                <th>  السعر    </th>
                                                                <th>   المتاح</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if (!empty($program_flight_info_prices->room_prices)) { ?>
                                                                    <?php foreach ($program_flight_info_prices->room_prices as $room) { ?>
                                                                        <tr>
                                                                            <td><?= $room->title_ar ?></td>
                                                                            <td><?= $room->price ?></td>
                                                                            <td><?= $room->number_of_rooms ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php } else { ?>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            <?php } ?>
                                                        </tbody>
                                                        <thead class="alert-success">
                                                            <tr>
                                                                    <!--<th>تاريخ الرحلة</th>-->
                                                                <th></th>
                                                                <th>  سعر الطفل  </th>
                                                                <th> سعر الرضيع</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td> </td>
                                                                <td><?= ($program_flight_info_prices->child_price) ? $program_flight_info_prices->child_price : ''; ?></td>
                                                                <td><?= ($program_flight_info_prices->infant_price) ? $program_flight_info_prices->infant_price : ''; ?></td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="right-sidebar">
                    <div class="detail-logo bg-grey-2">
                        <?php $program_title_url = str_replace(' ', '_', $program_details->program_title) ?>
                        <a style="width: 100%;font-size: 18px;" data-is-employee="" data-is-guest="" href="<?= site_url('programs/booking/' . $program_title_url . '-' . $program_details->program_flight_id) ?>" class="c-button b-40 bg-dr-blue-2  hv-dr-blue-2-o pulse booking-btn" onclick="return false;"><span>احجز الان</span></a>

                    </div>


                    <div class="popular-tours bg-grey-2 rtl">
                        <h4 class="color-dark-2">البرامج الاكثر مشاهدة</h4>
                        <?php foreach ($most_viewed as $viewed) { ?>
                                <div class="hotel-small style-2 clearfix">
                                    <?php $program_title_url = str_replace(' ', '_', $viewed->program_title) ?>
                                    <a class="hotel-img black-hover" href="<?= site_url('programs/detail/' . $program_title_url . '-' . $viewed->program_flight_id . '-' . $viewed->program_id) ?>">
                                        <img class="img-responsive radius-0" src="<?= base_url('uploads/programs/' . $viewed->image); ?>" alt="">
                                        <div class="tour-layer delay-1"></div>
                                    </a>
                                    <div class="hotel-desc">

                                        <h4><?= $viewed->program_title ?></h4>
                                        <h5><span class="color-dark-2"><strong><?= $viewed->price_start_from ?></strong>جنية</span></h5>
                                        <div class="hotel-loc tt"><strong><?= arabicDate($viewed->going_date) ?> - <?= arabicDate($viewed->return_date) ?> / <?= $viewed->nights ?></strong> ليالى</div>
                                    </div>
                                </div>
                            <?php } ?>

                    </div>



                    <div class="help-contact bg-grey-2 rtl">
                        <h4 class="color-dark-2">هل تحتاج الى المساعدة ؟</h4>
                        <p class="color-grey-2">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأه</p>
                        <a class="help-phone color-dark-2 link-dr-blue-2" href="tel:0200059600"><img src="<?= base_url('img/detail/phone24-dark-2.png'); ?>" alt="">020 00 59 600</a>
                        <a class="help-mail color-dark-2 link-dr-blue-2" href="mailto:info@agazabook.com"><img src="<?= base_url('img/detail/letter-dark-2.png'); ?>" alt="">info@agazabook.com</a>
                    </div>
                </div>
            </div>
       	</div>
        <!--       	<div class="may-interested ">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="second-title">
                                <h2>عروض مشابهة</h2>
                                <p class="color-grey">استمتع باخر العروض المقدمة من شركتنا</p>
                            </div>
                        </div>
                        <div class="col-mob-12 col-xs-6 col-sm-6 col-md-3">
                            <div class="hotel-item style-6">
                                <div class="radius-top">
                                    <img src="img/home_9/tour_1.jpg" alt="">
                                </div>
                                <div class="title">
                                    <div class="tour-info-line clearfix">
                                        <div class="tour-info fl">
                                            <img src="img/calendar_icon_grey.png" alt="">
                                            <span class="font-style-2 color-grey-3">July <strong>19th 2015</strong></span>
                                        </div>
                                        <div class="tour-info fl">
                                            <img src="img/loc_icon_small_grey.png" alt="">
                                            <span class="font-style-2 color-grey-3">alaska</span>
                                        </div>
                                    </div>
                                    <h4><b>ALASKA LAND cruise</b></h4>
                                    <div class="rate-wrap">
                                        <div class="rate">
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                        </div>
                                        <i>485 rewies</i>
                                    </div>
                                    <h5>from <strong>$860</strong> / person</h5>
                                    <p class="f-14 color-grey-3">San Juan, Charlotte Amalie, Philipsburg, Castries, Basseterre, Ponta Delgada, Southampton.</p>
                                    <a href="#" class="c-button b-50 bg-grey-3-t1 hv-grey-3-t">detail</a>
                                    <a href="#" class="c-button bg-dr-blue-2 hv-dr-blue-2-o fr">book now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-mob-12 col-xs-6 col-sm-6 col-md-3">
                            <div class="hotel-item style-6">
                                <div class="radius-top">
                                    <img src="img/home_9/tour_2.jpg" alt="">
                                </div>
                                <div class="title">
                                    <div class="tour-info-line clearfix">
                                        <div class="tour-info fl">
                                            <img src="img/calendar_icon_grey.png" alt="">
                                            <span class="font-style-2 color-grey-3">July <strong>19th 2015</strong></span>
                                        </div>
                                        <div class="tour-info fl">
                                            <img src="img/loc_icon_small_grey.png" alt="">
                                            <span class="font-style-2 color-grey-3">alaska</span>
                                        </div>
                                    </div>
                                    <h4><b>ASIA & AFRICA CRUISES</b></h4>
                                    <div class="rate-wrap">
                                        <div class="rate">
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                        </div>
                                        <i>485 rewies</i>
                                    </div>
                                    <h5>from <strong>$600</strong> / person</h5>
                                    <p class="f-14 color-grey-3">San Juan, Charlotte Amalie, Philipsburg, Castries, Basseterre, Ponta Delgada, Southampton.</p>
                                    <a href="#" class="c-button b-50 bg-grey-3-t1 hv-grey-3-t">detail</a>
                                    <a href="#" class="c-button bg-dr-blue-2 hv-dr-blue-2-o fr">book now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-mob-12 col-xs-6 col-sm-6 col-md-3">
                            <div class="hotel-item style-6">
                                <div class="radius-top">
                                    <img src="img/home_9/tour_3.jpg" alt="">
                                </div>
                                <div class="title">
                                    <div class="tour-info-line clearfix">
                                        <div class="tour-info fl">
                                            <img src="img/calendar_icon_grey.png" alt="">
                                            <span class="font-style-2 color-grey-3">July <strong>19th 2015</strong></span>
                                        </div>
                                        <div class="tour-info fl">
                                            <img src="img/loc_icon_small_grey.png" alt="">
                                            <span class="font-style-2 color-grey-3">alaska</span>
                                        </div>
                                    </div>
                                    <h4><b>NEW ENGLAND CRUISES</b></h4>
                                    <div class="rate-wrap">
                                        <div class="rate">
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                        </div>
                                        <i>485 rewies</i>
                                    </div>
                                    <h5>from <strong>$455</strong> / person</h5>
                                    <p class="f-14 color-grey-3">San Juan, Charlotte Amalie, Philipsburg, Castries, Basseterre, Ponta Delgada, Southampton.</p>
                                    <a href="#" class="c-button b-50 bg-grey-3-t1 hv-grey-3-t">detail</a>
                                    <a href="#" class="c-button bg-dr-blue-2 hv-dr-blue-2-o fr">book now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-mob-12 col-xs-6 col-sm-6 col-md-3">
                            <div class="hotel-item style-6">
                                <div class="radius-top">
                                    <img src="img/home_9/tour_4.jpg" alt="">
                                </div>
                                <div class="title">
                                    <div class="tour-info-line clearfix">
                                        <div class="tour-info fl">
                                            <img src="img/calendar_icon_grey.png" alt="">
                                            <span class="font-style-2 color-grey-3">July <strong>19th 2015</strong></span>
                                        </div>
                                        <div class="tour-info fl">
                                            <img src="img/loc_icon_small_grey.png" alt="">
                                            <span class="font-style-2 color-grey-3">alaska</span>
                                        </div>
                                    </div>
                                    <h4><b>PACIFIC COAST CRUISES</b></h4>
                                    <div class="rate-wrap">
                                        <div class="rate">
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                            <span class="fa fa-star color-yellow"></span>
                                        </div>
                                        <i>485 rewies</i>
                                    </div>
                                    <h5>from <strong>$990</strong> / person</h5>
                                    <p class="f-14 color-grey-3">San Juan, Charlotte Amalie, Philipsburg, Castries, Basseterre, Ponta Delgada, Southampton.</p>
                                    <a href="#" class="c-button b-50 bg-grey-3-t1 hv-grey-3-t">detail</a>
                                    <a href="#" class="c-button bg-dr-blue-2 hv-dr-blue-2-o fr">book now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
    </div>
</div>
<?php
    //global $_require;
    //$_require['js'] = array('program_details.js');
?>