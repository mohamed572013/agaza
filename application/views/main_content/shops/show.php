 
<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_shop.jpg" data-natural-width="1400" data-natural-height="320">
    <div id="sub_content_in">
        <h1><?= $shop_details->title_ar ?></h1>
    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>">الرئيسية</a></li>
            <li><a href="<?= site_url() ?>/shops">تسوق</a></li> 
            <li><?= $shop_details->title_ar ?></li>
        </ul>
    </div>
</div>
<!-- End position -->
 <div class="container margin_60">
        <div class="row">
            <aside class="col-md-3 col-md-push-9 col-xs-12" id="sidebar">
                <div class="theiaStickySidebar ">
                    <ul id="tools_2">
                        <li>
                            <div class="res_img">
                            <img src="<?= base_url() ?>/uploads/shops/<?= $shop_details->logo ?>" width="100%" height="100%" alt="<?= $shop_details->title_ar ?>">
                        </div>
                        
                        </li>
                         <?php if($shop_details->map_url != "") { ?>
                        <li>
                            <a target="_blank" href="<?= $shop_details->map_url ?>">احصل على العنوان <i class="icon_compass_alt"></i></a>
                            
                        </li>
                        <?php } ?>

              


                        <?php if($shop_details->video) { ?>
                         <li class="magnific-gallery"><a href="<?= $shop_details->video ?>" class="video" title="<?= $shop_details->title_ar ?>"><i class="icon_film"></i>فيديو</a>
                        </li>
<?php } ?>
                         
                    </ul>
                </div>
                <!--End sticky -->
            </aside>
            <!--End aside -->
            <div class="col-md-9 col-md-pull-3 col-xs-12">
                <div class="box_style_general add_bottom_30">
                        <div class=" ">
                    <div class="col-md12">




                        <div class="flexslider">
                            <ul class="slides">

                                 <?php if($shop_details->slider) { ?>
                            <?php foreach ($shop_details->slider as $key => $value) { ?>
                            <?php $image_name = substr($value->image, strpos($value->image, '_') + 1) ?>
                                <li>
                                    <img src="<?= base_url() ?>/uploads/shop_slider/l_<?= $image_name ?>" />
                                </li>
                               <?php }
                               } ?>
                            </ul>
                        </div>

                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12 pull-left">
                            <div class="box_info">
                                <h3>العنوان</h3>
                                <ul>
                                   
                                    <li><i class=" icon-location-outline"></i><?= $shop_details->address_ar ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 pull-left">
                            <div class="box_info">
                                <h3>بيانات الاتصال</h3>
                                <ul>
                                    <li><strong>التليفون:</strong> <a href="javascript:;" class="ltr"><?= $shop_details->phone ?></a>
                                    </li>
                                    <li><strong>الموقع الالكترونى:</strong> <a href="javascript:;" target="_blank"><?= $shop_details->email ?></a>
                                    </li>
                                </ul>
                               
                            </div>
                        </div>
                    </div>
                    <!--End row -->
                    <hr>
                    <h2><?= $shop_details->title_ar ?></h2>
                    <p class="">
                       <?= $shop_details->content_ar ?>


                    </p>
                    
                    <div class="row">
                        <h3>انواع المحلات</h3>
                        <hr>

                        <?php if($shop_details->features) { ?>
                        <?php foreach ($shop_details->features as $key => $value) { ?>
                       <?php if($key % 2 == 0) { ?>
                        <div class="col-sm-6">
                            <ul class="list_style_1">
                                <li><?= $value->title_ar ?></li>
                            </ul>
                        </div>
                        <?php } else { ?>
                        <div class="col-sm-6">
                            <ul class="list_style_1">
                              <li><?= $value->title_ar ?></li>                              
                            </ul>
                        </div>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>
                    </div>
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