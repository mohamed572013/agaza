<style>
    #panel-cities #city_name,#panel-hotels #hotel_name{
        border:1px solid #ccc;
        box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
        color: rgba(0,0,0,.75);
        display: block;
        height: 30px;
        padding: 5px;
        width: 100%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        margin-bottom: 5px;
    }
    #panel-cities .scroll,#panel-hotels .scroll{
        max-height: 230px;
        overflow: hidden;
    }
    #panel-cities .scroll:hover,#panel-hotels .scroll:hover{
        overflow-y: auto;
    }
</style>
<div class="col-xs-12 col-sm-4 col-md-3">
    <div class="sidebar bg-white clearfix">
        <div class="sidebar-block">
            <div class="search-inputs">



                <h4 class="sidebar-title color-dark-2">التصفية حسب:</h4>
                <!--                <h6 class="sidebar-title2 color-dark-2">السعر</h6>
                                <div class="slider-range color-4 clearfix" data-counter="Egp" data-position="start" data-from="0" data-to="1500" data-min="0" data-max="20000">
                                    <div class="range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="slider-range-0"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 0%;"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 25%;"></span>
                                    </div>
                                    <input type="text" class="amount-start" readonly="" value="$0" id="amount-start-0">
                                    <input type="text" class="amount-end" readonly="" value="$1500" id="amount-end-0">
                                </div>-->


                <ul class="sidebar-category color-1">
                    <li class="active">
                        <a class="cat-drop" href="#"><i class="fa fa-chevron-down" aria-hidden="true"></i> مستوي الفندق</a>
                        <ul>
                            <li>
                                <div class="sidebar-score m20">
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
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="cat-drop" href="#"><i class="fa fa-chevron-down" aria-hidden="true"></i>مميزات الفندق </a>
                        <ul>
                            <?php $count = 1; ?>
                            <?php foreach ($hotels_advantages as $hotel_advantages) { ?>
                                    <?php $input__name_id = 'advantage_' . $count ?>
                                    <li>
                                        <a href="#">
                                            <div class="input-entry color-7">
                                                <input class="checkbox-form" id="<?= $input__name_id ?>" type="checkbox" name="<?= $input__name_id ?>" value="<?= $hotel_advantages->id ?>">
                                                <label class="clearfix" for="<?= $input__name_id ?>">
                                                    <span class="sp-check"><i class="fa fa-check"></i></span>
                                                    <span class="checkbox-text"><img class="hotel-icon" style="width:30px;height:20px;" src="<?= base_url('theme/features_image/' . $hotel_advantages->image); ?>" alt=""> <?= $hotel_advantages->title_ar ?></span>
                                                </label>
                                            </div>
                                        </a>
                                    </li>
                                    <?php $count++; ?>
                                <?php } ?>

                        </ul>
                    </li>
                    <!--                    <li>
                                            <a class="cat-drop" href="#"> <i class="fa fa-chevron-down" aria-hidden="true"></i> الوجبات</a>
                                            <ul>
                                                <li><a href="#"><div class="input-entry color-7">
                                                            <input class="checkbox-form" id="text-20" type="checkbox" name="checkbox" value="climat control">
                                                            <label class="clearfix" for="text-20">
                                                                <span class="sp-check"><i class="fa fa-check"></i></span>
                                                                <span class="checkbox-text">شامل الإفطار</span>
                                                            </label>
                                                        </div></a></li>

                                                <li><a href="#"><div class="input-entry color-7">
                                                            <input class="checkbox-form" id="text-21" type="checkbox" name="checkbox" value="climat control">
                                                            <label class="clearfix" for="text-21">
                                                                <span class="sp-check"><i class="fa fa-check"></i></span>
                                                                <span class="checkbox-text">إقامة مع وجبتين </span>
                                                            </label>
                                                        </div></a></li>

                                                <li><a href="#"><div class="input-entry color-7">
                                                            <input class="checkbox-form" id="text-22" type="checkbox" name="checkbox" value="climat control">
                                                            <label class="clearfix" for="text-22">
                                                                <span class="sp-check"><i class="fa fa-check"></i></span>
                                                                <span class="checkbox-text">إقامة مع 3 وجبات</span>
                                                            </label>
                                                        </div></a></li>

                                                <li><a href="#"><div class="input-entry color-7">
                                                            <input class="checkbox-form" id="text-23" type="checkbox" name="checkbox" value="climat control">
                                                            <label class="clearfix" for="text-23">
                                                                <span class="sp-check"><i class="fa fa-check"></i></span>
                                                                <span class="checkbox-text">شامل كليا</span>
                                                            </label>
                                                        </div></a></li>

                                                <li><a href="#"><div class="input-entry color-7">
                                                            <input class="checkbox-form" id="text-24" type="checkbox" name="checkbox" value="climat control">
                                                            <label class="clearfix" for="text-24">
                                                                <span class="sp-check"><i class="fa fa-check"></i></span>
                                                                <span class="checkbox-text">إعداد الوجبات ذاتيا</span>
                                                            </label>
                                                        </div></a></li>


                                            </ul>
                                        </li>-->
                    <!--                    <li>
                                            <a class="cat-drop" href="#"> <i class="fa fa-chevron-down" aria-hidden="true"></i> نوع مكان الإقامة</a>
                                            <ul>
                                                <li><a href="#"><div class="input-entry color-7">
                                                            <input class="checkbox-form" id="text-25" type="checkbox" name="checkbox" value="climat control">
                                                            <label class="clearfix" for="text-25">
                                                                <span class="sp-check"><i class="fa fa-check"></i></span>
                                                                <span class="checkbox-text">منتجعات </span>
                                                            </label>
                                                        </div></a></li>

                                                <li><a href="#"><div class="input-entry color-7">
                                                            <input class="checkbox-form" id="text-26" type="checkbox" name="checkbox" value="climat control">
                                                            <label class="clearfix" for="text-26">
                                                                <span class="sp-check"><i class="fa fa-check"></i></span>
                                                                <span class="checkbox-text">شقق </span>
                                                            </label>
                                                        </div></a></li>

                                                <li><a href="#"><div class="input-entry color-7">
                                                            <input class="checkbox-form" id="text-27" type="checkbox" name="checkbox" value="climat control">
                                                            <label class="clearfix" for="text-27">
                                                                <span class="sp-check"><i class="fa fa-check"></i></span>
                                                                <span class="checkbox-text">فيلات </span>
                                                            </label>
                                                        </div></a></li>

                                                <li><a href="#"><div class="input-entry color-7">
                                                            <input class="checkbox-form" id="text-28" type="checkbox" name="checkbox" value="climat control">
                                                            <label class="clearfix" for="text-28">
                                                                <span class="sp-check"><i class="fa fa-check"></i></span>
                                                                <span class="checkbox-text">فنادق </span>
                                                            </label>
                                                        </div></a></li>

                                                <li><a href="#"><div class="input-entry color-7">
                                                            <input class="checkbox-form" id="text-29" type="checkbox" name="checkbox" value="climat control">
                                                            <label class="clearfix" for="text-29">
                                                                <span class="sp-check"><i class="fa fa-check"></i></span>
                                                                <span class="checkbox-text">شاليهات </span>
                                                            </label>
                                                        </div></a></li>


                                            </ul>
                                        </li>-->

                </ul>







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