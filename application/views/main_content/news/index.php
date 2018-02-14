<style type="text/css">
    #news-page {
        background-image: url(<?= base_url() ?>Spinner.gif);
        background-repeat: no-repeat;
        background-position: center center;
        z-index: 9999;
        background-size: contain;
        position: fixed;
        top: 30%;
        right: 0;
        margin: 0 auto;
        width: 100%;
        left: 0;
        height: 300px;
    }
    .loader-container { z-index: 9999;   width: 100%;    background: rgba(255, 255, 255, 0.58);    height: 100%;    position: fixed;    top: 0;}

</style>

<div class="loader-container" id="loader-container" style="display: none;" >
    <div id="news-page"></div>
    </div>
</div>

<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_news.jpg" data-natural-width="1400" data-natural-height="320">
    <div id="sub_content_in">
        <h1><?= _lang("latest_news") ?></h1>
    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>"><?= _lang("home") ?></a></li>
            <li><?= _lang("latest_news") ?></li>
        </ul>
    </div>
</div>



<div class="container margin_60_30"  >
    <div class="row">
   <aside class="col-md-3 hidden-sm hidden-xs" id="sidebar">
            <div class="theiaStickySidebar ">
                <a href="http://mv-is.com" target="_blank"><img src="<?= base_url() ?>/adsss.jpg" class="img-responsive m20"></a>

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



        <div id="loader-block">
        <div class="col-md-9 col-sm-12 col-xs-12 newss">
            <input type="hidden" id="count" value="<?= $news_count ?>" name="">

            <?php if($news):  ?>
                <?php foreach ($news as $key => $value): ?>
                        <div class="strip_list wow fadeIn news-item">
                            <div class="row">
                                  <div class="col-sm-7 col-xs-8">
                                    <div class="desc">
                                        <?php $url = $value->id . "-" . str_replace(" ", "-", $value->title_ar);  ?>
                                        <h4><a href="<?= site_url() ?>/news/show/<?= $url ?>"><?= $value->title_ar ?></a></h4>
                                        <p><?= mb_substr($value->body_ar, 0, 200); ?><a href="<?= site_url() ?>/news/show/<?= $url ?>"> [ ... ]</a></p>
                            
                                    </div>
                                </div>
                                <div class="col-sm-5 col-xs-4">
                                    <div class="img_wrapper">
                               
                                       
                                        <!-- End tools i-->
                                        <div class="img_container">
                                            <?php $url = $value->id . "-" . str_replace(" ", "-", $value->title_ar);  ?>
                                            <a href="<?= site_url() ?>/news/show/<?= $url ?>">
												<?php $image = substr($value->image, strpos("_", $value->image) + 1); ?>
                                                <img src="<?= base_url() ?>uploads/news/l<?=$image ?>"  class="img-responsive" alt="<?= $value->title_ar ?>" title="<?= $value->title_ar ?>">
                                                <div class="short_info">
                                                    <small><?= arabicDate($value->created) ?></small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!--End img_wrapper-->
                                </div>
                              
                                
                            </div>
                            <!--End row -->
                        </div> 
                    
                <?php endforeach;  ?>
            <?php endif; ?>
        </div>

        <?php if(isset($news_count) && $news_count > 9) { ?>
        <div class="text-center">
                <a href="javascript:;" id="show-more-news" class="button_2">اكتشف المزيد من الأخبار </a>
            </div>
            <?php } ?>
        </div>

</div>






        <!-- End col-md-9-->

     




        <!-- End aside -->

    </div>

<!-- End container -->

<!-- End container -->





<?php
    global $_require;
    $_require['js'] = array('news.js');
?>
