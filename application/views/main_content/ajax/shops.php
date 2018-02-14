         <?php
                    if($shops) {
                        foreach ($shops as $key => $value) {
                            
                        ?>
                        <div class="single-shop col-md-4 col-xs-12 pull-left">
                        <div class="img_wrapper">
                            <div class="img_container">
                            <?php $url = $value->id ."-".str_replace(" ", "-", $value->title_ar); ?>
                            <?php $image = substr($value->logo, strpos($value->logo, '_') + 1) ?>
                                <a href="<?= site_url()?>/shops/show/<?= $url ?>"> 
                                    <img src="<?= base_url() ?>/uploads/shops/l_<?= $image ?>" width="800" height="533" class="img-responsive" alt="">
                                    <div class="short_info">
                                      
                                        <h3><?= $value->title_ar ?></h3>
                                        <em><?= $value->place_title_ar ?></em>
                                        
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- End img_wrapper -->
                    </div>
                        
                        
                        <?php
                   
                        }
                    }
                ?>