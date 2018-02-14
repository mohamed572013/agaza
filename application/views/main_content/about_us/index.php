
<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_about.jpg" data-natural-width="1400" data-natural-height="320">
    <div id="sub_content_in">
        <h1>عن شركتنا</h1>

    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>">الرئيسية</a>
            </li>

            <li>عن شركتنا</li>
        </ul>
    </div>
</div>
<!-- End position -->


<div class="bg_white">
    <div class="container margin_60 bg_white">
        <div class="row">
            <div class="col-md-6 col-md-push-5">
                <div class="main_title_left">
                    <h3><?= $about_us->title_ar ?></h3>
                    <p style="font-size: 16px; text-align: justify; line-height: 2em;"><?= $about_us->desc_ar ?></p>
                    <span><em></em></span>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-1 col-md-pull-7 hidden-sm hidden-xs">
                <img src="<?= base_url('uploads/about_us/' . $about_us->image); ?>" alt="" class="img-responsive">
            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
</div>
<!-- End white_bg -->
