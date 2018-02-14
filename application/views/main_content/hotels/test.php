<?php include('header.php') ?>


<!-- INNER-BANNER -->
<div class="inner-banner style-1">
    <img class="center-image" src="img/detail/bg_5.jpg" alt="">
    <div class="vertical-align">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <ul class="banner-breadcrumb color-white clearfix">
                        <li><a class="link-blue-2" href="#">الرئيسية</a> /</li>
                        <li><span>حجز فندق</span></li>
                    </ul>
                    <h2 class="color-white">حجز فندق</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DETAIL WRAPPER -->
<div class="detail-wrapper">
    <div class="container rtl">
       	<div class="row padd-90">
            <div class="col-xs-12 col-md-8">

                <div class="accordion-filter row">
                    <div class="col-xs-12">
                        <div class="accordion style-5">
                            <form class="simple-from">
                                <div class="acc-panel features">
                                    <div class="acc-title active"><span class="acc-icon"></span>تفاصيل الحجز
                                    </div>
                                    <div class="acc-body first">

                                        <div class="simple-group">
                                            <h3 class="small-title"></h3>

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">المنطقة</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <select name="destination" class="form-control amr color-3" data-placeholder="">
                                                                <option value="">مصر</option>
                                                                <option value="0">سعودية</option>
                                                                <option value="">لبيا</option>
                                                                <option value="0">سوريا</option>


                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">تاريخ الوصول</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <img src="img/calendar_icon_grey.png" alt="">
                                                            <input type="text" placeholder="تاريخ الوصول" class="datepicker">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">عدد اليالى</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="number" placeholder="عدد اليالى">
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr/>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="acc-panel sliders">
                                    <div class="acc-title"><span class="acc-icon"></span>بيانات اعداد المسافرين</div>
                                    <div class="acc-body">

                                        <div class="simple-group">
                                            <div class="row">

                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">عدد البالغين</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="number" placeholder="عدد البالغين">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">عدد الاطفال</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="number" placeholder="عدد الاطفال">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">عدد الرضع</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="number" placeholder="عدد الرضع">
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>



                                        </div>


                                    </div>
                                </div>
                                <div class="acc-panel requests">
                                    <div class="acc-title"><span class="acc-icon"></span>حجز غرف</div>
                                    <div class="acc-body">
                                        <div class="simple-group">
                                            <div class="row">

                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">نوع الغرفة</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <select name="destination" class="form-control amr color-3" data-placeholder="">
                                                                <option value="">ثنائى</option>
                                                                <option value="0">ثلاثى</option>


                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">عدد الغرف</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="number" placeholder="عدد الغرف">
                                                        </div>
                                                    </div>
                                                </div>





                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <div class="acc-panel reservations">
                                    <div class="acc-title"><span class="acc-icon"></span>حجز خدمات اضافية على الاستمارة</div>
                                    <div class="acc-body">
                                        <div class="simple-group">
                                            <div class="confirm-terms col-md-6">
                                                <div class="input-entry color-3">
                                                    <input class="checkbox-form" id="text-4" type="checkbox" name="checkbox" value="climat control">
                                                    <label class="clearfix" for="text-4">
                                                        <span class="sp-check"><i class="fa fa-check"></i></span>
                                                        <span class="checkbox-text">نصف إقامة : 30 جنية</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="confirm-terms col-md-6">
                                                <div class="input-entry color-3">
                                                    <input class="checkbox-form" id="text-5" type="checkbox" name="checkbox" value="climat control">
                                                    <label class="clearfix" for="text-5">
                                                        <span class="sp-check"><i class="fa fa-check"></i></span>
                                                        <span class="checkbox-text">إقامة كاملة: 200 جنية</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> </div>
                                <div class="acc-panel results">
                                    <div class="acc-title"><span class="acc-icon"></span>بيانات العميل</div>
                                    <div class="acc-body">
                                        <div class="simple-group">
                                            <h3 class="small-title"></h3>

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">الاسم:</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="text" placeholder="الاسم ">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">النوع</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <select name="destination" class="form-control amr color-3" data-placeholder="">
                                                                <option value="0"> ذكر</option>
                                                                <option value="1">انثى</option>


                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">تاريخ الميلاد</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <img src="img/calendar_icon_grey.png" alt="">
                                                            <input type="text" placeholder="تاريخ الميلاد" class="datepicker">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">التليفون</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="number" placeholder="التليفون">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">البريد الاليكترونى</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="email" placeholder="البريد الاليكترونى">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">الجنسية</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="text" placeholder="الجنسية">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">البلد</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="text" placeholder="البلد">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">المدينة</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="text" placeholder="المدينة">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">كود المدينة</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="number" placeholder="كود المدينة">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-12">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">العنوان</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="text" placeholder="العنوان">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-12">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">ملاحظات</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <textarea class="area-style-1 color-3" name="fields[text]" required="" placeholder="ملاحظات"></textarea>
                                                        </div>
                                                    </div>
                                                </div>







                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="acc-panel color">
                                    <div class="acc-title"><span class="acc-icon"></span>بيانات المسافرين</div>
                                    <div class="acc-body">
                                        <div class="simple-group">
                                            <h3 class="small-title"></h3>

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">الاسم:</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <input type="text" placeholder="الاسم ">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">النوع</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <select name="destination" class="form-control amr color-3" data-placeholder="">
                                                                <option value=""> ذكر</option>
                                                                <option value="0">انثى</option>


                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4">
                                                    <div class="form-block type-2 clearfix">
                                                        <div class="form-label color-dark-2">تاريخ الميلاد</div>
                                                        <div class="input-style-1 b-50 brd-0 type-2 color-3">
                                                            <img src="img/calendar_icon_grey.png" alt="">
                                                            <input type="text" placeholder="تاريخ الميلاد" class="datepicker">
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="c-button bg-dr-blue-2 hv-dr-blue-2-o pull-left" value="تأكيد الحجز">
                            </form>
                        </div>
                    </div>
                </div>




            </div>
            <div class="col-xs-12 col-md-4">
                <div class="right-sidebar">

                    <div class="popular-tours bg-grey-2 bookinf">
                        <h4 class="color-dark-2">بيانات الحجز</h4>
                        <div class="hotel-small style-2 clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">اسم البرنامج:</span></h6><h6 class="pull-right">برنامج شرم الشيخ</h6>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">تاريخ الرحلة:</span></h6><h6 class="pull-right">26/12/2016</h6>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">تقيم البرنامج:</span></h6>
                                    <div class="rate">
                                        <span class="fa fa-star color-yellow"></span>
                                        <span class="fa fa-star color-yellow"></span>
                                        <span class="fa fa-star color-yellow"></span>
                                        <span class="fa fa-star color-yellow"></span>
                                        <span class="fa fa-star color-yellow"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="popular-tours bg-grey-2 bookinf">
                        <h4 class="color-dark-2">بيانات اعداد المسافرين</h4>
                        <div class="hotel-small style-2 clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">عدد البالغين:</span></h6>
                                    <h6 class="pull-right">10 افراد</h6>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">عدد الاطفال:</span></h6>
                                    <h6 class="pull-right">3 اطفال</h6>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">عدد الرضع:</span></h6>
                                    <h6 class="pull-right">1 رضيع</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="popular-tours bg-grey-2 bookinf">
                        <h4 class="color-dark-2">الغرف المحجوزة</h4>
                        <div class="hotel-small style-2 clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">النوع:</span></h6>
                                    <h6 class="pull-right">ثنائى</h6>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">العدد :</span></h6>
                                    <h6 class="pull-right">5 غرف</h6>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="popular-tours bg-grey-2 bookinf">
                        <h4 class="color-dark-2">الخدمات الاضافية على الاستمارة</h4>
                        <div class="hotel-small style-2 clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">اسم الخدمة:</span></h6>
                                    <h6 class="pull-right">نصف إقامة</h6>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="popular-tours bg-grey-2 bookinf">
                        <h4 class="color-dark-2">الخدمات الاضافية على الافراد</h4>
                        <div class="hotel-small style-2 clearfix">
                            <div class="row">


                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">اسم الخدمة:</span></h6>
                                    <h6 class="pull-right">عشاء</h6>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="pull-right"><span class="booktit">عدد الافراد:</span></h6>
                                    <h6 class="pull-right">10</h6>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="sidebar-text-label bg-dr-blue-2 color-white"><h6><span class="booktit">اجمالى المبلغ :</span> 60000 جنيها</h6></div>




                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php') ?>