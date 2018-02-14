 
<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_shop.jpg" data-natural-width="1400" data-natural-height="320">
    <div id="sub_content_in">
        <h1>اماكن التسوق و الترفية</h1>
    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>">الرئيسية</a></li>
            <li>اماكن التسوق و الترفية</li>
        </ul>
    </div>
</div>
<!-- End position -->

<div class="container margin_60_30">
    <div class="row">

       <aside class="col-md-3 col-md-push-9" id="sidebar">
             <div class="theiaStickySidebar ">

                <div id="filters_col">
                    ابحث عن اماكن التسوق و الترفية
                    <div >
                        <div id="panel-cities">
                            <div class="input-group col-md-12 mt20">
                                <input type="text" id="city-input" class="form-control input-lg" placeholder="ادخل اسم المدينة">
                            </div>
                            <div class="scroll mt20">
                                <div class="filter_type">
                                    <ul id="city-block">



 <?php if($shops_cities) { ?>
                                    <?php foreach ($shops_cities as $key => $value) { ?>
<?php $input_id = "city_id_" . $count ?>
                                    


   <li>
                                           <div class="checkbox">
                                                <label for="city_<?= $value->id ?>">
                                                    <input class="city-checkbox"  type="checkbox"  value="<?= $value->id ?>" id="city_<?= $value->id ?>" data-id="<?= $value->id ?>" data-title = "<?= $value->title_ar ?>">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                    <?= $value->title_ar ?>
                                                </label>
                                            </div>
                                            
                                        </li> 

                                        <?php } ?>
                                    <?php } ?>





                                    </ul>
                                </div>

                            </div>
                        </div>







                        <div id="panel-cities">
                            <div class="input-group col-md-12 mt20">
                                <input type="text" id="shop-input" class="form-control input-lg" placeholder="ادخل اسم االمطعم">
                            </div>
                            <div class="scroll mt20">
                                <div class="filter_type">
                                    <ul id="shop-block">




                                       <?php if($all_shops) { ?>
                                    <?php foreach ($all_shops as $key => $value) { ?>


   <li>
                                           <div class="checkbox">
                                                <label for="shop_<?= $value->id ?>">
                                                    <input class="shop-checkbox"  type="checkbox"  value="<?= $value->id ?>" id="shop_<?= $value->id ?>" data-id="<?= $value->id ?>" data-title = "<?= $value->title_ar ?>">
                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                    <?= $value->title_ar ?>
                                                </label>
                                            </div>
                                            
                                        </li> 

                                         <?php } ?>
                                    <?php } ?>





                                    </ul>
                                </div>

                            </div>
                        </div>






                        <div class="filter_type widget tags">
                            <h6>نوع المشتريات</h6>




<?php if($tags) {
                                foreach ($tags as $key => $value) {  ?>
                                    <a href="javascript:;" class="tags-items" data-id="<?= $value->id ?>" data-title="<?= $value->title_ar ?>" ><?= $value->title_ar ?></a>
                   <?php  } } ?>






                        </div>





                        
                    <!--End collapse -->
                </div>
                <!--End filters col-->
            </div>
                  </div>
            <!--End Sticky -->
        </aside>
        <!--End aside -->

        <div class="col-md-9 col-md-pull-3">
            <div class="programs-main-content">
                <div class="row">
                    <div class="programs-content">


<input type="hidden" id='shops-count' value="<?= $count ?>" name="">

<div class="active-shops">
                        
                        
                          
                               
                             <?php
                    if($shops) {
                        foreach ($shops as $key => $value) {
                            
                        ?>
                        <div class="single-shop col-md-4 pull-left">
                        <div class="img_wrapper">
                            <div class="img_container">
                            <?php $url = $value->id ."-".str_replace(" ", "-", $value->title_ar); ?>
                            <?php $image = substr($value->logo, strpos($value->logo, '_') + 1) ?>
                                <a href="<?= site_url()?>/shops/show/<?= $url ?>"> 
                                    <img src="<?= base_url() ?>/uploads/shops/l_<?= $image ?>" width="800" height="533" class="img-responsive" alt="">
                                    <div class="short_info">
                                      
                                        <h3><?= $value->title_ar ?></h3>
                                        <em><?= $value->place_title_ar ?></em>
                                        
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End img_wrapper -->
                    </div>
                        
                        
                        <?php
                   
                        }
                    }
                ?>
                           
                        
                       
</div>
                         
           
              
                        
                    </div>
                    <div class="row col-md-12 text-center">
                 <?php if(isset($count) && $count > 12) { ?>
<div class="text-center">
                <a href="javascript:;" id="show-more-shops" class="button_2">اكتشف المزيد اماكن التسوق و الترفية</a>
            </div>
            <?php } ?>
</div>
                </div>
                
            </div>



        </div>
        
        
        <!-- End col lg 9 -->
    </div>
    <!-- End row -->
</div>
<!-- End container -->
 








<?php
    global $_require;
    $_require['js'] = array('shops.js');
?>









































