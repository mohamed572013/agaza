 
<!-- SubHeader =============================================== -->
<section class="parallax_window_in" data-parallax="scroll" data-image-src="<?= base_url() ?>img/sub_header_florence_car.jpg" data-natural-width="1400" data-natural-height="320">
    <div id="sub_content_in">
        <h1>النقل السياحى</h1>
    </div>
    <!-- End sub_content -->
</section>
<!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="<?= site_url() ?>">الرئيسية</a></li>
            <li>النقل السياحى</li>
        </ul>
    </div>
</div>
<!-- End position -->

<div class="container margin_60_30">
    <div class="row">

       
        <!--End aside -->

        <div class="col-md-12">
            <div class="programs-main-content">
                <div class="row">
                        <input type="hidden" name="transports-count" id="transports-count" value="<?= $count ?>">
                    <div class="programs-content active-transports">
                        
                             <?php if($all_active_transportations) { ?>
                             <?php foreach ($all_active_transportations as $key => $value) { ?>
                    <div class="col-md-3 col-xs-12 pull-left list-item single-transport">
                    <div class="trans_block">
                        <?php  $transport_url = $value->id . "-" . str_replace(" ", "-", $value->title_ar); ?>
                        <div class="img-trans">
                      <a href="<?= site_url()."/transports/show/".$transport_url ?>">   <img src="<?= base_url() ?>/uploads/transportations/<?= $value->logo ?>" width="100%" height="100%" alt=""></a>
                        </div>
                        <div class="dete_trans">
                        <h3><a href="<?= site_url()."/transports/show/".$transport_url ?>"> <?= $value->title_ar ?></a></h3>
<!--
                            <p>
                            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز 
                            </p>
-->
                        </div>
                        
                        </div>
                        </div>
                        
                         <?php
                    }
                    ?>
            <?php } ?>
                        
    
                      </div>  
                        
                    </div>
                   <div class="row">
                     <?php if(isset($count) && $count > 12) { ?>
                           <div class="col-md-12 col-xs-12 text-center mb20">
<div class="text-center">
                <a href="javascript:;" id="show-more-transports" class="button_2">اكتشف المزيد من النقل السياحى</a>
            </div></div>
                <?php }
                ?>
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
    $_require['js'] = array('transports.js');
?>
