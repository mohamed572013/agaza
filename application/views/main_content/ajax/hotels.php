<?php if (!empty($hotels)) { ?>
        <?php foreach ($hotels as $hotel) { ?>

            <div class="strip_list wow fadeIn list-item-entry">
                <div class="row">
                    <div class="col-sm-6 pull-left">
                        <div class="img_wrapper">

                            <div class="tools_i">
                                <div class="rating">
                                    <?php for ($x = 1; $x <= $hotel->stars; $x++) { ?>
                                        <span> </span>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- End tools i-->
                            <div class="img_container">
                                <?php $hotel_title_url = str_replace(' ', '-', $hotel->title_ar) ?>
                                <a href="<?= site_url('property/' . $hotel_title_url . '-' . $hotel->id . '/' . $hotel->city . '-' . $hotel->city_id . '/' . $hotel->country . '-' . $hotel->country_id); ?>">
                                    <img src="<?= $hotel->company_url . 'uploads/maka_madina_hotels/' . $hotel->image ?>" width="800" height="533" class="img-responsive" alt="<?= $hotel->title_ar ?>">
                                    <div class="short_info">

                                        <h1><?= $hotel->title_ar ?></h1>
                                        <em><?= $hotel->city ?></em>

                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--End img_wrapper-->
                    </div>
                    <div class="col-sm-6 pull-left">
                        <div class="desc">
                            <h4><a href="<?= site_url('property/' . $hotel_title_url . '-' . $hotel->id . '/' . $hotel->city . '-' . $hotel->city_id . '/' . $hotel->country . '-' . $hotel->country_id); ?>"><?= $hotel->title_ar ?></a> </h4>
                            <p><?= mb_substr($hotel->desc_ar, 0, 100) ?></p>

                            <p class="hotel-adv">
                                <?php if (count($hotel->advantages) > 0) { ?>
                                    <?php foreach ($hotel->advantages as $advantage) { ?>
                                        <img class="hotel-icon" src="<?= $hotel->company_url . 'theme/features_image/' . $advantage->image ?>" alt="<?= $advantage->title_ar ?>">
                                    <?php } ?>
                                <?php } ?>



                            </p>

                            <p class="text-left"><a href="<?= site_url('property/' . $hotel_title_url . '-' . $hotel->id . '/' . $hotel->city . '-' . $hotel->city_id . '/' . $hotel->country . '-' . $hotel->country_id); ?>" class="button small">المزيد...</a>
                            </p>
                        </div>
                    </div>
                </div>
                <!--End row -->
            </div>
            <!--End strip -->
        <?php } ?>
    <?php } ?>
<?php if ($all_hotels_count > 4) { ?>
        <style>
            a.button_2{
                background-color: #00a2ff;
                padding: 4px 10px;
            }
            a.button_2, a.button_plan:hover {
                background-color: #0a71ad;
                color: #fff;
            }

        </style>
        <div class="text-center">
            <a href="" class="col-md-12 button_2 show-more-hotels" data-city-id="<?= (isset($city_id)) ? $city_id : 'all'; ?>" data-all-hotels-count="<?= $all_hotels_count ?>" data-current-length="<?= count($hotels) ?>">المزيد</a>
        </div>
    <?php } ?>