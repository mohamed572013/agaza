<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= $program_details->agaza_image_url . 'uploads/programs/' . $program_details->agaza_image ?>" data-natural-width="1400" data-natural-height="420">
    <div id="sub_content_in">
        <div id="sub_content_in_left">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12 pull-left text-right">
                        <h1><?= $program_details->program_title ?></h1>
                        <span><i class="icon_pin"></i><?= $program_details->program_title ?></span>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 pull-left">

                        <div class="price_in pull-left">السعر للفرد يبدأ من
                            <span><?= $program_details->price_start_from ?><sup>جنيها</sup> </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End sub_content_left -->
 
<!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>">الرئيسية</a>
            </li>
            <li><a href="<?= site_url() ?>/programs">برامجنا</a>
            </li>
            <li><?= $program_details->program_title ?></li>
        </ul>
    </div>
</div>
<!-- End position -->

<div class="container margin_60">
    <div class="row">
        <aside class="col-md-3 col-sm-3 hidden-xs" id="sidebar">
            <div class="theiaStickySidebar ">
                <a href="http://www.3omra-online.com" target="_blank"><img src="<?= base_url() ?>/imgpsh_fullsize (3).jpg" class="img-responsive m20"></a>

                <div class="box_info">
                    <h3>هل تحتاج الى المساعدة ؟</h3>
                    <p>
                        يمكنك الاتصال بنا <br>

                    </p>
                    <ul>
                        <li class="mb20"> <a class="help-phone" href="tel:0222616436"><i class="icon_set_1_icon-89"></i>0222616436</a></li>
                        <li>   <a class="help-mail" href="mailto:info@agazabook.com"><i class="icon_set_1_icon-84"></i>info@agazabook.com</a></li>
                    </ul>
                </div>




            </div>
            <!--End sticky -->
        </aside>
        <!--End aside -->
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="box_style_general add_bottom_30">

                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div id="slider" class="flexslider">
                            <ul class="slides">
                                <?php if ($program_images) { ?>
                                        <?php foreach ($program_images as $key => $program_image) { ?>
                                            <?php $image = substr($program_image->image, strpos($program_image->image, '_') + 1) ?>
                                            <li data-thumb="<?= $program_details->agaza_slider_url . 'uploads/programs_slider/l_' . $image ?>">
                                                <img src="<?= $program_details->agaza_slider_url . 'uploads/programs_slider/l_' . $image ?>">
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                <!-- items mirrored twice, total of 12 -->
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                <?php if ($program_images) { ?>
                                        <?php foreach ($program_images as $key => $program_image) { ?>
                                            <?php $image = substr($program_image->image, strpos($program_image->image, '_') + 1) ?>
                                            <li data-thumb="<?= $program_details->agaza_slider_url . 'uploads/programs_slider/s_' . $image ?>">
                                                <img src="<?= $program_details->agaza_slider_url . 'uploads/programs_slider/s_' . $image ?>">
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                <!-- items mirrored twice, total of 12 -->
                            </ul>
                        </div>

                    </div>
                </div>



                <hr>
                <div class="row">
                    <h4 class="text-right">مميزات البرنامج</h4>
                    <br>
                    <?php if ($program_advantages) { ?>
                            <?php foreach ($program_advantages as $program_advantage) { ?>
                                <div class="col-md-4 col-sm-4" style="float:right;">
                                    <ul class="list_option">
                                        <li><img style="margin-left:10px;" class="hotel-icon" src="<?= $program_details->agaza_slider_url . 'theme/features_image/' . $program_advantage->image ?>" alt="<?= $program_advantage->title_ar ?>" style="  max-width: 24px; max-height: 24px"><?= $program_advantage->title_ar ?></li>

                                    </ul>
                                </div>
                            <?php } ?>
                        <?php } ?>
                </div>


                <hr>
         
                <div class="row">
                    
                    <div class="col-md-12 col-xs-12">


                        <!--  Tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab" aria-expanded="false">الوصف</a>
								
                            </li>
							<li class=""><a href="#inc" data-toggle="tab" aria-expanded="false">البرنامج يشمل</a>
								
                            </li>
                            <li class=""><a href="#profile" data-toggle="tab" aria-expanded="false">المدن</a>
                            </li>
                            <li class=""><a href="#messages" data-toggle="tab" aria-expanded="false">الفنادق</a>
                            </li>
                            <li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">خدمات اضافية</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                                <h3><?= $program_details->program_title ?></h3>
                                <p><?= $program_details->program_desc ?></p>

                            </div>
							<div class="tab-pane active" id="inc">
                                <p><?= $program_details->program_include_ar ?></p>

                            </div>
                            <div class="tab-pane" id="profile">
                                <?php if ($cities) { ?>
                                        <?php foreach ($cities as $city) { ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-4 fr">
                                                        <img class="right-img img-responsive"  src="<?= $program_details->agaza_url . 'uploads/places/' . $city->place_image ?>" alt="<?= $city->place_title ?>">
                                                    </div>
                                                    <div class="col-md-8 fr">
                                                        <h5 class="" style="margin-bottom:5px;"><?= $city->place_title ?></h5>
                                                        <p><?= $city->place_desc_ar ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                            </div>
                            <div class="tab-pane" id="messages">
                                <?php if ($hotels) { ?>
                                        <?php foreach ($hotels as $hotel) { ?>
                                            <div class="row">
<!--                                                <div class="col-md-12" style="height:150px;margin-bottom: 20px;">    -->
                                                    <div class="col-md-12 col-xs-12">
                                                    <a data-toggle="modal" data-target="#myModal_hotel">
                                                        <div class="col-md-4 col-xs-12 fr">
                                                            <img style="height: 140px; width: 90%;"  src="<?= $program_details->agaza_url . 'uploads/maka_madina_hotels/' . $hotel->hotel_image ?>" alt="">
                                                        </div>

                                                        <div class="col-md-8 col-xs-12 fr">
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
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                            </div>
                            <div class="tab-pane" id="settings">

                                <div class="row">
                                    <?php if ($program_services) { ?>
                                            <?php foreach ($program_services as $program_service) { ?>


                                                <div class="col-md-4 pull-left">
                                                    <ul class="list_ok">
                                                        <li><?= $program_service->title_ar ?></li>
                                                    </ul>
                                                </div>

                                            <?php } ?>
                                        <?php } ?>
                                </div>
                            </div>


                        </div>
                        <style>
                            a.button_2{
                                background-color: #00a2ff;
                                padding: 4px 10px;
                            }
                            a.button_2, a.button_plan:hover {
                                background-color: #0a71ad;
                                color: #fff;
                            }

                        </style>
                        
                        
                        
                            


                        <?php if($program_details->agaza_branch_id == 14) { ?>
                             <div class="step">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
                                <div class="form-group">
                                    <label>الاسم الاول</label>
                                    <input type="text" class="form-control" id="fname" name="fname">
                                    <div class="help-block-fname"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12  pull-left">
                                <div class="form-group">
                                    <label>الاسم الاخير</label>
                                    <input type="text" class="form-control" id="lname" name="lname">
                                    <div class="help-block-lname"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
                                <div class="form-group">
                                    <label>البريد الالكترونى</label>
                                    <input type="email" id="email" name="email" class="form-control">
                                    <div class="help-block-email"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
                                <div class="form-group add_bottom_0">
                                    <label>رقم الهاتف</label>
                                    <input type="text" id="phone" name="phone" class="form-control">
                                    <div class="help-block-phone"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 pull-left">
                                <div class="form-group add_bottom_0">
                                    <label>رسالة</label>
                                     <textarea rows="5" id="message" name="message" class="form-control styled" style="height:100px;" placeholder="الرسالة"></textarea>
                                     <div class="help-block-message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                            <a style="width: 270px;margin-bottom: 15px;" href="javascript:void(0);" id="reserve-form" class="button_2">احجز ألأن</a>
                        </div>
                    <?php } else { ?>








                        <div class="text-center">
                            <?php $program_title_url = str_replace(' ', '-', $program_details->program_title) ?>
                            <a style="width: 270px;margin-bottom: 15px;" href="<?= site_url('redirect/' . $program_title_url . '-' . $program_details->program_id) ?>" class="button_2">احجز ألأن</a>
                        </div>
                        <?php } ?>
                        <input type="hidden" id="program_id" value="<?= $program_details->program_id ?>" name="">
                    </div>
                    <!-- End col-md-12-->
           
                </div>
				
				  <div class="row">
                      
                    <div class="sharethis-inline-share-buttons"></div>
                                 <div class="col-md-12"><div class="sharethis-inline-reaction-buttons"></div></div>
                    </div>
            </div>
            <!-- End box_style_general -->

        </div>
        <!-- End col lg-9 -->
    </div>
    <!-- End row -->
</div>
<!-- End container -->
<?php
    global $_require;
    $_require['js'] = array('program_details.js');
?>

 <script src="http://agazabook.com/assets/front/plugins/jquery/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#reserve-form").click(function() {
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var email = $("#email").val();
            var phone = $("#phone").val();
            var program_id = $("#program_id").val();
            var message = $("#message").text();
            if(fname == "" || lname == "" || email == "" || phone == "") {
                if(fname == "") {
                    $(".help-block-fname").text("من فضلك ادخل الإسم الأول").css("color", "red");
                }
                if(lname == "") {
                    $(".help-block-lname").text("من فضلك ادخل الإسم الأخير").css("color", "red");
                }
                if(email == "") {
                    $(".help-block-email").text("من فضلك ادخل البريج الإلكتورنى").css("color", "red");
                }
                if(phone == "") {
                    $(".help-block-phone").text("من فضلك ادخل رقم التليفون").css("color", "red");
                }
            } else {
                $.ajax({
                    type: "POST",
                    url: config.admin_url+"agaza_reserve/add",
                    data: {
                        "fname": fname,
                        "lname": lname,
                        "email": email,
                        "phone": phone,
                        "message": message,
                        "program_id": program_id
                    },
                    success: function(msg) {
                        $("#reserve-form").attr("disabled", "disabled");
                        $("#reserve-form").text("تم التسجيل بنجاح");
                        $(".help-block-fname").text("");
                        $(".help-block-lname").text("");
                        $(".help-block-email").text("");
                        $(".help-block-phone").text("");
                    }
                });
            }
            


        });
    });
</script>