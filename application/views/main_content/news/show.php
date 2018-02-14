<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_news.jpg" data-natural-width="1400" data-natural-height="320">
    <div id="sub_content_in">
        <h1><?= $details->title_ar ?></h1>
    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>"><?= _lang("home"); ?></a></li>
            <li><a href="<?= site_url() ?>/news"><?= _lang("news"); ?></a></li>
            <li><?= $details->title_ar ?></li>
        </ul>
    </div>
</div>

 <div class="container margin_60_30">
        <div class="row">
  <aside class="col-md-3 col-sm-12 col-xs-12" id="sidebar">

       
                <div class="widget">
                    <h4><?= _lang("latest_news"); ?></h4>
                    <ul class="recent_post">



                        <?php if($latest_news): ?>
                            <?php foreach($latest_news as $value): ?>
                                <?php $url = $value->id . "-" . str_replace(" ", "-", $value->title_ar);  ?>
                                <li>
                                    <i class="icon-calendar-empty"></i> <?= arabicDate($value->created) ?>
                                    <div><a href="<?= site_url() ?>/news/show/<?= $url ?>"><?= $value->title_ar ?></a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        




                    </ul>
                </div>
                <!-- End widget -->
                
                <!-- End widget -->
<div class="widget"><a href="http://mv-is.com" target="_blank"><img src="http://agazabook.com//adsss.jpg" class="img-responsive m20"></a>
     </div>
            </aside>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="post">
                    <?php $image = substr($details->image, strpos("_", $details->image) + 1); ?>
                    <img src="<?= base_url() ?>uploads/news/l<?=$image ?>" alt="<?= $details->title_ar ?>" title="<?= $details->title_ar ?>" class="img-responsive">
                    <div class="post_info clearfix">
                        <div class="post-left">
                            <ul>
                                <li><i class="icon-calendar-empty"></i><?= arabicDate($details->created) ?></li> 
                            </ul>
                        </div>
                        
                    </div>
                    <h2><?= $details->title_ar ?></h2>
                    <p><?= $details->body_ar ?></p>
                    
                </div>
                <!-- end post -->
 
            </div>
            <!-- End col-md-9-->

          
            <!-- End aside -->

        </div>
    </div>
<!-- End container -->

<!-- End container -->




