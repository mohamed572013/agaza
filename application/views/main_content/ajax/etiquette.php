 <?php
 if($all_etiquette) {
                foreach ($all_etiquette as $key => $value) {   ?>
                    <?php $url = $value->id . "-" . str_replace(" ", "-", $value->title_ar);  ?>
                    <div class="post list-item">
                    <?php $image = substr($value->image, strpos($value->image, '_') + 1) ?>
                        <a href="<?= site_url() ?>/etiquette/show/<?= $url ?>"><img src="<?= base_url() ?>/uploads/etiquette/l_<?= $image ?>" alt="" class="img-responsive">
                        </a>
                        <div class="post_info clearfix">
                            <div class="post-left">
                                <ul>

                                    <li><i class="icon-tags"></i>


                                    <?php 
                                    if($value->tags != "") {
                                    $tags = explode(",", $value->tags);
                                    if(!empty($tags)) {
                                        foreach ($tags as $k => $v) { ?>
                                            
                                    
                                    <a href="javascript:void(0);"><?= $v ?></a>, 
<?php 
                                        }
                                    }
                                    }
                                     ?>




                                    </li>
                                </ul>
                            </div>

                        </div>

                        <h2><?= $value->title_ar; ?>
                        </h2>
                        <p>
                            <?= $value->content_ar; ?>
                        </p>
                        <a href="<?= site_url() ?>/etiquette/show/<?= $url ?>" class="button">المزيد</a>
                    </div>
                    <!-- end post -->

                    <?php
                }
            }
            ?>


        </div>