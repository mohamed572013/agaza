
<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_ete.jpg" data-natural-width="1400" data-natural-height="320">
    <div id="sub_content_in">
        <h1><?= $etiquette_details->title_ar ?></h1>
    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>">الرئيسية</a></li>
            <li><a href="<?= site_url() ?>/etiquette">الإتيكيت والبروتوكول السياحى</a></li>
            <li><?= $etiquette_details->title_ar ?></li>
        </ul>
    </div>
</div>

<div class="container margin_60_30">
    <div class="row">
        <form>
            <div class="col-md-8 col-md-offset-2">

                <div class="post">
                <?php $image = substr($etiquette_details->image, strpos($etiquette_details->image, '_') + 1) ?>
                    <img src="<?= base_url() ?>/uploads/etiquette/l_<?= $image  ?>" alt="<?= $etiquette_details->title_ar ?>" class="img-responsive">

                    <h2><?= $etiquette_details->title_ar ?></h2>
                    <p>
                        <?= $etiquette_details->content_ar ?>


                    </p>
                       <div class="row">
                      <hr>
                    <div class="sharethis-inline-share-buttons"></div>
                                 <div class="col-md-12"><div class="sharethis-inline-reaction-buttons"></div></div>
                    </div>
                </div>
            </div>
        </form>
        
             
    </div>
 
    <!-- End row -->
</div>
<!-- End container -->

<!-- End container -->




