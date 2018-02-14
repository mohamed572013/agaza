<?php if (!empty($shrines)) { ?>
        <?php foreach ($shrines as $shrine) { ?>
            <div class="item tours gal-item style-3 col-mob-12 col-xs-6 col-sm-4 shrine_item_container">
                <a class="black-hover" href="#">
                    <div class="gal-item-icon">
                        <img class="img-full img-responsive" src="<?= base_url('uploads/maka_madina_shrines/' . $shrine->image); ?>" alt="">
                        <div class="tour-layer delay-1"></div>
                        <div class="vertical-align">
                            <span class="c-button small bg-white delay-2"><span>المزيد</span></span>
                        </div>
                    </div>
                    <div class="gal-item-desc delay-1">
                        <h5><?= $shrine->title_ar ?></h5>
                    </div>
                </a>
            </div>
        <?php } ?>
    <?php } ?>
