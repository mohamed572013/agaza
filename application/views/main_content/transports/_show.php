 
<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_florence_car.jpg" data-natural-width="1400" data-natural-height="320">
    <div id="sub_content_in">
        <h1>النقل السياحى</h1>
    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>">الرئيسية</a></li>
            <li><a href="<?= site_url() ?>/transports">النقل السياحى</a></li> 
            <li><?= $transportation_details->title_ar ?></li>
        </ul>
    </div>
</div>
<!-- End position -->
 <div class="container margin_60">
        <div class="row">
            <aside class="col-md-3 col-md-push-9" id="sidebar">
                <div class="theiaStickySidebar ">
                    <ul id="tools_2">
                        <li>
                            <div class="res_img">
                            <img src="<?= base_url() ?>/uploads/transportations/<?= $transportation_details->logo ?>" width="100%" height="100%" alt="ssss">
                        </div>
                        
                        </li>
                        
                        <?php if($transportation_details->map_url != "") { ?>
                        <li>
                            <a target="_blank" href="<?= $transportation_details->map_url ?>">احصل على العنوان <i class="icon_compass_alt"></i></a>
                            
                        </li>
                        <?php } ?>


<!--
                        <?php $first_image_name = substr($transportation_details->images[0]->image, strpos($transportation_details->images[0]->image, '_') + 1) ?>
                        <li class="magnific-gallery"><a href="<?= base_url() ?>/uploads/transportations_slider/l_<?= $first_image_name ?>" title="<?= $transportation_details->title_ar ?>"><i class="icon_images"></i>معرض الصور</a>

                        <?php foreach ($transportation_details->images as $key => $value) { ?>
                            <?php $image_name = substr($value->image, strpos($value->image, '_') + 1) ?>
                            <a href="<?= base_url() ?>/uploads/transportations_slider/l_<?= $image_name ?>" title="<?= $transportation_details->title_ar ?>" class="hidden"></a>
                        <?php } ?>

                        </li>
-->
                         
                    </ul>
                </div>
                <!--End sticky -->
            </aside>
            <!--End aside -->
            <div class="col-md-9 col-md-pull-3">
                   <div class=" ">
                    <div class="col-md12">




                        <div class="flexslider">
                            <ul class="slides">

                                 <?php if($transportation_details->images) { ?>
                            <?php foreach ($transportation_details->images as $key => $value) { ?>
                            <?php $image_name = substr($value->image, strpos($value->image, '_') + 1) ?>
                                <li>
                                    <img src="<?= base_url() ?>/uploads/transportations_slider/l_<?= $image_name ?>" />
                                </li>
                               <?php }
                               } ?>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="box_style_general add_bottom_30">
                
                    <h2><?= $transportation_details->title_ar ?></h2>
                    <p class="">
                        <?= $transportation_details->content_ar ?>

                    </p>
                   
                    <hr>
                        <div class="row">
                        <div class="col-md-6 pull-left">
                            <div class="box_info">
                                <h3>العنوان</h3>
                                <ul>
                                   
                                    <li><i class=" icon-location-outline"></i><?= $transportation_details->address_ar ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 pull-left">
                            <div class="box_info">
                                <h3>بيانات الاتصال</h3>
                                <ul>
                                    <li><strong>التليفون:</strong> <a href="#" class="ltr"><?= $transportation_details->phone ?></a>
                                    </li>
                                    <li><strong>الموقع الالكترونى:</strong> <a href="#" target="_blank"><?= $transportation_details->email ?></a>
                                    </li>
                                </ul>
                               
                            </div>
                        </div>
                    </div>
                    <!--End row -->
                    <hr>
     <div class="row">
                   
                    <div class="sharethis-inline-share-buttons"></div>
                                 <div class="col-md-12"><div class="sharethis-inline-reaction-buttons"></div></div>
                    </div>
        <hr>              
                <!-- End carousel -->
            </div>
            <!-- End col lg-9 -->
        </div>
        <!-- End row -->
    </div></div>