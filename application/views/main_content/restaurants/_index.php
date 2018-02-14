 
<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_rest.jpg" data-natural-width="1400" data-natural-height="320">
    <div id="sub_content_in">
        <h1>المطاعم</h1>
    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>">الرئيسية</a></li>
            <li>المطاعم</li>
        </ul>
    </div>
</div>
<!-- End position -->

<div class="container margin_60_30">
    <div class="row">

       <aside class="col-md-3 col-md-push-9" id="sidebar">
             <div class="theiaStickySidebar ">

                <div id="filters_col">
                    ابحث عن مطعم
                    <div >



















                        <div id="panel-cities">
                            <div class="input-group col-md-12 mt20">
                                <input type="text" id="city-input" class="form-control input-lg" placeholder="ادخل اسم المدينة">
                            </div>
                            <div class="scroll mt20">
                                <div class="filter_type">
                                    <ul id="city-block">




                                    <?php if($restaurants_cities) { ?>
                                    <?php foreach ($restaurants_cities as $key => $value) { ?>

                                     

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
                                <input type="text" id="res-input" class="form-control input-lg" placeholder="ادخل اسم االمطعم">
                            </div>
                            <div class="scroll mt20">
                                <div class="filter_type">
                                    <ul id="res-block">







                                    <?php if($all_restaurants) { ?>
                                    <?php foreach ($all_restaurants as $key => $value) { ?>

                                       

                                     <li>
                                           <div class="checkbox">
                                                <label for="restaurant_<?= $value->id ?>">
                                                    <input class="restaurant-checkbox"  type="checkbox"  value="<?= $value->id ?>" id="restaurant_<?= $value->id ?>" data-id="<?= $value->id ?>" data-title = "<?= $value->title_ar ?>">
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
                            <h6>نوع الاكل</h6>



                            <?php if($tags) {
                                foreach ($tags as $key => $value) {  ?>
                                   <a href="javascript:;" class="tags-items" data-id="<?= $value->id ?>" data-title="<?= $value->title_ar ?>" ><?= $value->title_ar ?></a>
                            <?php  } } ?>


                        </div>
                        

                    </div>
                    <!--End collapse -->
                </div>
                <!--End filters col-->
            </div>
            <!--End Sticky -->
        </aside>
        <!--End aside -->

        <div class="col-md-9 col-md-pull-3">
            <div class="programs-main-content">
                <div class="row">
                    <div class="programs-content">
                        
<input type="hidden" id='restaurants-count' value="<?= $count ?>" name="">

<div class="active-restaurants">



                        <?php if($restaurants) {

                            foreach ($restaurants as $key => $value) { ?>
                            <div class="single-restaurant entry list-profile post-72 azl_profile type-azl_profile status-publish has-post-thumbnail hentry delivery-type-pickup">
                   <div class="entry-thumbnail">
                   <?php $url = $value->id . "-" . str_replace(" ", "-", $value->title_ar); ?>
    <a href="<?= site_url('restaurants/show')?>/<?= $url ?>">
         <div class="image " style="background-image: url(<?= base_url() ?>/uploads/restaurants/<?= $value->logo ?>); height: 108px;" data-width="108" data-height="108"></div>
    </a>
                    </div>
        <div class="entry-data">
        <div class="entry-header"><h2 class="entry-title"><a href="<?= site_url('restaurants/show')?>/<?= $url ?>" rel="bookmark"><?= $value->title_ar ?> </a></h2></div>
        <div class="entry-summary"><?= mb_substr($value->content_ar,0,80); ?> ...  </div>
       
        </div>    
         <div class="entry-additions"> <div class="star-rating" title="Rated <?= $value->stars ?> out of 5">
        <div class="rating">
            <?php  for($x = 0; $x < $value->stars; $x++) { ?><span> </span> <?php } ?>
                                        </div>
           </div>
 

<div class="entry-more"> <a href="<?= site_url('restaurants/show')?>/<?= $url ?>" class="more-link">تفاصيل اكثر</a></div></div>
        </div>
        <?php } }  ?>
                        
                         
                       

</div>
                         
            <?php if(isset($count) && $count > 12) { ?>
<div class="text-center">
                <a href="javascript:;" id="show-more-res" class="button_2">اكتشف المزيد من المطاعم</a>
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
    $_require['js'] = array('restaurants.js');
?>
