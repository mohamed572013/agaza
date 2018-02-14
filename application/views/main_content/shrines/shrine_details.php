

<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_mzar.jpg" data-natural-width="1400" data-natural-height="420">
    <div id="sub_content_in">
        <h1><?= $shrine->title_ar ?></h1>
        <p>"كل ما تحتاجة للسفر ... ستجد الأماكن، والاتجاهات، والمعلومات ...."
        </p>
    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>">الرئيسية</a></li>
            <li>مزارات</li>
            <li><?= $shrine->title_ar ?></li>
        </ul>
    </div>
</div>
<!-- End position -->
<div class="container margin_60_30">
    <div class="row">

        <div class="col-md-12">
            <div class="post">
                <div class="row">
                    <div class="col-md12">

                        <div id="slider" class="flexslider">
                            <ul class="slides">
                                <?php if ($shrine->images) { ?>
                                    <?php foreach ($shrine->images as $image) { ?>
                                        <li>
                                            <img src="<?= base_url('uploads/shrines_slider/' . $image->image) ?>" />
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                <?php if ($shrine->images) { ?>
                                    <?php foreach ($shrine->images as $image) { ?>
                                        <li>
                                            <?php $image_name = substr($image->image, strpos($image->image, '_') + 1) ?>
                                            <img src="<?= base_url('uploads/shrines_slider/s_' . $image_name) ?>" />
                                        </li>
                                    <?php } ?>
                                <?php } ?>

                            </ul>
                        </div>




                    </div>
                </div>


                <h2><?= $shrine->title_ar ?></h2>
                <p><?= $shrine->desc_ar ?></p>
                <p><?= $shrine->body_ar ?></p>
                     <div class="row">
                      <hr>
                    <div class="sharethis-inline-share-buttons"></div>
                                 <div class="col-md-12"><div class="sharethis-inline-reaction-buttons"></div></div>
                    </div>
            </div>
            <!-- end post -->


        </div>
        <!-- End col-md-9-->



    </div>
</div>
<!-- End container -->
<!-- End container -->

