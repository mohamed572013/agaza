<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_florence_6.jpg" data-natural-width="1400" data-natural-height="420">
    <div id="sub_content_in">
        <h1>شركاؤنا</h1>
 <p>
               شركاؤنا في النجاح علي مدار اكثر من 11 عام
            </p>
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

            <li>شركاؤنا</li>
        </ul>
    </div>
</div>
<!-- End position -->

 

    <div class="container margin_60">
     
        <!-- End main_title -->
        <div class="row magnific-gallery">
                <?php
                    if($all_clients) {
                        foreach ($all_clients as $key => $value) {  ?>
            <div class="col-md-3 col-sm-6 col-xs-12 pull-left">
                <div class="img_wrapper">
                    <div class="img_container">
                    <?php $image = substr($value->image, strpos($value->image, '_') + 1) ?>
                        <a href="<?= base_url() ?>/uploads/clients/l_<?= $image ?>" title="<?= $value->title_ar ?>">
                           
                            <img src="<?= base_url() ?>/uploads/clients/l_<?= $image ?>" width="800" height="533" class="img-responsive" alt="">
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
        <!-- End row -->
        
    </div>
    <!-- End container -->
 
<!-- End white_bg -->
