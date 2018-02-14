
<div class="col-xs-12 col-sm-4 col-md-3">
    <div class="sidebar bg-white clearfix">
        <div class="sidebar-block">
            <div class="search-inputs">





                <h6 class="sidebar-title2 color-dark-2" style="border-top:none;">السعر فى حدود</h6>
                <!--                <div class="slider-range color-4 clearfix" data-counter="Egp" data-position="start" data-from="0" data-to="1500" data-min="0" data-max="20000">
                                    <div class="range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="slider-range-0"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 0%;"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 25%;"></span>
                                    </div>
                                    <input type="text" class="amount-start" id="amount-start" readonly="" value="$0" >
                                    <input type="text" class="amount-end" id="amount-end" readonly="" value="$1500" >
                                </div>-->


                <div id="slider-range" class="color-4"></div>
                <div>
                    <div style="float:left;width: 40%;text-align: left;">
                        <input type="text" id="price_start" readonly style="border:0; color:#222; font-weight:bold;text-align: left;
                               width: 50%;
                               font-size: 12px;">
                    </div>
                    <div  style="float:right;width: 40%;">
                        <input type="text" id="price_end" readonly style="border:0; color:#222; font-weight:bold;font-size: 12px;">
                    </div>
                </div>
                <div class="clearfix"></div>
                <h4 class="sidebar-title2 color-dark-2">النجوم</h4>
                <div class="sidebar-score">
                    <?php for ($x = 1; $x <= 5; $x++) { ?>
                            <?php
                            $input__name_id = 'star_' . $x;
                            ?>
                            <div class="input-entry type-2 color-8">
                                <input class="checkbox-form" id="<?= $input__name_id ?>" type="checkbox" name="<?= $input__name_id ?>" value="<?= $x ?>">
                                <label class="clearfix" for="<?= $input__name_id ?>">
                                    <span class="checkbox-text">
                                        <?= $x; ?>
                                        <span class="rate">
                                            <span class="fa fa-star color-yellow"></span>
                                        </span>
                                    </span>
                                    <span class="sp-check"><i class="fa fa-check"></i></span>
                                </label>
                            </div>
                        <?php } ?>
                </div>







            </div>
<!--            <input type="submit" class="c-button b-40 bg-blue-2 hv-blue-2-o" value="ابحث">-->
        </div>
        <!--        <div class="sidebar-block">
                    <h4 class="sidebar-title color-dark-2">اقسام اخري</h4>
                    <ul class="sidebar-category color-1">
                        <li class="active">
                            <a class="cat-drop" href="#">برامج<span class="fl">(68)</span></a>
                            <ul>
                                <li><a href="#">رحلات شرم الشيخ (785)</a></li>
                                <li><a href="#">رحلات الغردقة (85)</a></li>
                                <li><a href="#">رحلات الاقصر و اسوان (125)</a></li>
                                <li><a href="#">رحلات دهب (70)</a></li>
                                <li><a href="#">رحلات خليج نعمة (159)</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="cat-drop" href="#">الفنادق <span class="fl">(125)</span></a>
                            <ul>
                                <li><a href="#">فنادق شرم الشيخ (785)</a></li>
                                <li><a href="#">فنادق الغردقة (85)</a></li>
                                <li><a href="#">فنادق مرسى مطروح (125)</a></li>
                                <li><a href="#">فنادق الاقصر (70)</a></li>
                                <li><a href="#">فنادق اسوان (159)</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="cat-drop" href="#">رحلات خارجية <span class="fr">(75)</span></a>
                            <ul>
                                <li><a href="#">تركيا (785)</a></li>
                                <li><a href="#">الامارات (85)</a></li>
                                <li><a href="#">اسبانيا (125)</a></li>
                                <li><a href="#">ايطاليا (70)</a></li>
                                <li><a href="#">فرنسا (159)</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>-->
        <div class="sidebar-block">
            <div class="top-baner dotes">
                <div class="swiper-container" data-autoplay="3000" data-loop="1" data-speed="1000" data-center="0" data-slides-per-view="1" id="tour-slide-2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img class="img-responsive" src="<?= base_url('img/soon.jpg'); ?>" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img class="img-responsive" src="<?= base_url('img/login.jpg'); ?>" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img class="img-responsive" src="<?= base_url('img/personal2.jpg'); ?>" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img class="img-responsive" src="<?= base_url('img/soon.jpg'); ?>" alt="">
                        </div>
                    </div>
                    <div class="pagination pagination-hidden poin-style-1"></div>
                </div>

            </div>
        </div>



    </div>
</div>

