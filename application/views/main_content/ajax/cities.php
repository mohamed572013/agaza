<?php if ($cities) { ?>
        <?php foreach ($cities as $city) { ?>
            <div class="col-mob-12 col-xs-6 col-sm-4 col-md-3 hvr-pulse">
                <?php
                $country_title_url = str_replace(' ', '-', $city->country_name);
                $city_title_url = str_replace(' ', '-', $city->title_ar);
                ?>
                <a href="<?= site_url('destinations/' . $city_title_url . '/' . $country_title_url); ?>"><div class="tour-item style-5 bg-grey-2">
                        <div class="radius-top">
                            <img src="<?= base_url('uploads/places/' . $city->image); ?>" alt="<?= $city->title_ar ?>">
                        </div>
                        <div class="tour-desc" style="height: 120px;">
                            <h4 class="text-right"><?= $city->title_ar ?></h4>
                            <div class="tour-text text-right color-grey-3"><?php echo mb_substr($city->desc_ar, 0, 50, "utf-8") . ' ....'; ?></div>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    <?php } ?>