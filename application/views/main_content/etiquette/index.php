<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_ete.jpg" data-natural-width="1400" data-natural-height="320">
    <div id="sub_content_in">
        <h1>الإتيكيت والبروتوكول السياحى</h1>
    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>">الرئيسية</a></li>
            <li>الإتيكيت والبروتوكول السياحى</li>
        </ul>
    </div>
</div>



<div class="container margin_60_30">
    <div class="row">

        <div class="col-md-9">
        <div class="active-etiquette">
        <input type="hidden" id="etiquette-count" value="<?= $count ?>" name="">
            <?php

                foreach ($all_etiquette as $key => $value) {   ?>
                    <?php $url = $value->id . "-" . str_replace(" ", "-", $value->title_ar);  ?>
                    <div class="post list-item">
                    <?php $image = substr($value->image, strpos($value->image, '_') + 1) ?>
                        <a href="<?= site_url() ?>/etiquette/show/<?= $url ?>"><img src="<?= base_url() ?>/uploads/etiquette/l_<?= $image ?>" alt="" class="img-responsive">
                        </a>
                      

                        <h2><?= $value->title_ar; ?>
                        </h2>
                        <p>
                            <?= mb_substr($value->content_ar, 0, 150); ?> ...
                        </p>
                        <a href="<?= site_url() ?>/etiquette/show/<?= $url ?>" class="button">المزيد</a>
                    </div>
                    <!-- end post -->

                    <?php
                }
            ?>

</div>

    <?php if(isset($count) && $count > 12) { ?>
        <div class="text-center">
                <a href="javascript:;" id="show-more-et" class="button_2">اكتشف المزيد الإتيكيت السياحى </a>
            </div>
            <?php } ?>

        </div>
        <!-- End col-md-9-->

        <aside class="col-md-3 col-sm-3 hidden-xs" id="sidebar">
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




        <!-- End aside -->

    </div>
</div>
<!-- End container -->

<!-- End container -->





<?php
    global $_require;
    $_require['js'] = array('etiquette.js');
?>
