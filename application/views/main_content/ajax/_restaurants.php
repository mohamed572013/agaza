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
        <div class="entry-summary"><?= $value->content_ar ?> </div>
       
        </div>    
         <div class="entry-additions"> <div class="star-rating" title="Rated <?= $value->stars ?> out of 5">
        <div class="rating">
            <?php  for($x = 0; $x < $value->stars; $x++) { ?><span> </span> <?php } ?>
                                        </div>
           </div>
 

<div class="entry-more"> <a href="<?= site_url('restaurants/show')?>/<?= $url ?>" class="more-link">تفاصيل اكثر</a></div></div>
        </div>
        <?php } }  ?>