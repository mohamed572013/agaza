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
                                                <img src="<?= base_url() ?>uploads/news/<?= $value->image ?>"  class="img-responsive" alt="<?= $value->title_ar ?>" title="<?= $value->title_ar ?>">
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