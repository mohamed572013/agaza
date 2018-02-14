<?php foreach ($hotels as $hotel) { ?>
        <div class="col-md-6 col-sm-12 hotel_item_container">
            <div class="hotel-item style-8 bg-white">
                <div class="table-view">
                    <div class="radius-top cell-view">
                        <?php $hotel_title_url = str_replace(' ', '-', $hotel->title_ar) ?>
                        <a href="<?= site_url('property/' . $hotel_title_url . '/' . $hotel->city . '/' . $hotel->country); ?>">   <img src="<?= base_url('uploads/maka_madina_hotels/' . $hotel->image) ?>" alt=""></a>

                    </div>
                    <div class="title hotel-middle clearfix cell-view">

                        <div class="rate-wrap">
                            <div class="rate">
                                <?php for ($x = 0; $x < $hotel->stars; $x++) { ?>
                                    <span class="fa fa-star color-yellow"></span>
                                <?php } ?>
                            </div>

                        </div>
                        <a href="<?= site_url('property/' . $hotel_title_url . '/' . $hotel->city . '/' . $hotel->country); ?>"> <h4><b><?= $hotel->title_ar ?></b></h4></a>
                        <p class="f-14"><?= $hotel->desc_ar ?></p>
                        <div class="hotel-icons-block grid-hidden">
                            <?php if (count($hotel->advantages) > 0) { ?>
                                <?php foreach ($hotel->advantages as $advantage) { ?>
                                    <img class="hotel-icon" src="<?= base_url('theme/features_image/' . $advantage->image); ?>" alt="<?= $advantage->title_ar ?>">
                                <?php } ?>
                            <?php } ?>
                            <?php $hotel_title_url = str_replace(' ', '-', $hotel->title_ar) ?>
        <!--                                                                                <a class="c-button b-26 bg-blue-8 grid-hidden fl" href="<?= base_url('property/' . $hotel_title_url . '/' . $hotel->city . '/' . $hotel->country); ?>">المزيد</a>-->
                        </div>


                    </div>

                </div>
            </div>
        </div>
    <?php } ?>