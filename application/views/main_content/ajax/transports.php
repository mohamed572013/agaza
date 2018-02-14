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