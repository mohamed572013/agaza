<!-- Footer ================================================== -->
<style>
    .alert_custom {
        z-index: 1050;
        bottom: 0px;
        right: 0px;
        width: 100%;
        /*background: #c04848;*/
        background: #00a2ff;
        border: medium none;
        border-radius: 0 !important;
        color: #fff;
        font-size: 18px;
        line-height: 28px;
        padding: 20px 10px !important;
        text-align: center;
        display: none;
        position: fixed;
    }
</style>
<div class="alert_custom">
    <!--    <button type="button" class="close" data-dismiss="alert" style="float:right;">✖</button>-->
    <strong style="font-size:24px;" id="alert_message"></strong>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 pull-left">
                <h3><?= (!empty($settings->site_title_ar)) ? $settings->site_title_ar : '' ?></h3>
                <p><?= mb_substr((!empty($settings->site_desc_ar)) ? $settings->site_desc_ar : '', 0, 200) ?> ...</p>
                <p><img src="<?= base_url() ?>img/logo.png" alt="اجازة بوك | Agazabook" class="hidden-xs" width="170" height="30"></p>
            </div>

            <div class="col-md-5 col-sm-12 pull-left">
                <h3>بيانات الأتصال</h3>
                <div class="contact-info">
                    <div class="contact-line color-white"><i class="icon-location"></i><span><?= (!empty($settings->address_ar)) ? $settings->address_ar : '' ?></span></div>
                    <div class="contact-line color-white"><i class="icon-phone"></i><a href="#"><?= (!empty($settings->site_phone)) ? $settings->site_phone : '' ?> </a></div>
                    <div class="contact-line color-white"><i class="icon-mail-alt"></i><a href="mailto:<?= (!empty($settings->site_email)) ? $settings->site_email : '' ?>"><?= (!empty($settings->site_email)) ? $settings->site_email : '' ?></a></div>
                    <div class="pull-left"> <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FAgazaBook%2F&tabs&width=340&height=150px&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="150px" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>
                </div>
            </div>

            <!--   <div class="col-md-3 col-sm-12 pull-left">
     <h3>روابط هامة</h3>
                      <ul>
                              <li><a href="<?= site_url('about_us'); ?>">عن الشركة</a>
                              </li>
                              <li><a href="#"  onclick="return false,">الاسئلة الشائعة</a>
                              </li>
                              <li><a href="<?= site_url('contact_us'); ?>">اتصل بنا</a>
                              </li>
                              <li><a href="<?= site_url('programs'); ?>">برامج</a>
                              </li>
                              <li><a href="<?= site_url('hotels'); ?>">فنادق</a>
                              </li>
                              <li><a href="http://flights.agazabook.com">طيران</a>
                              </li>
                          </ul>


      </div>-->
            <div class="col-md-3 col-sm-12 pull-left" id="newsletter">
                <h3>النشرة البريدية</h3>
                <p>
                    انضم الينا و استمتع بافضل عروض السفر و الرحلات
                </p>
                <div id="message-newsletter_2">
                </div>
                <form method="post" id="subscribeForm">
                    <div class="form-group">
                        <input name="email" id="email" type="text" value="" placeholder="البريد الالكترونى" class="form-control">
                        <div class="help-block"></div>
                    </div>
                    <p>
                        <input type="submit" value="اشترك الان" class="button submit-form" id="submit-newsletter_2">
                    </p>
                </form>
            </div>

        </div>
        <!-- End row -->
        <hr>
        <div class="row">

            <div class="col-sm-4 pull-left">
                <div id="social_footer">
                    <ul>
                        <li><a href="<?= (!empty($settings->site_contacts->facebook)) ? $settings->site_contacts->facebook : '' ?>" target="_blank"><i class="icon-facebook"></i></a>
                        </li>
                        <li><a href="<?= (!empty($settings->site_contacts->twitter)) ? $settings->site_contacts->twitter : '' ?>" target="_blank"><i class="icon-twitter"></i></a>
                        </li>
                        <li><a href="<?= (!empty($settings->site_contacts->instagram)) ? $settings->site_contacts->instagram : '' ?>"><i class="icon-instagram"></i></a>
                        </li>
                        <!--
                                                <li><a href="#0"><i class="icon-pinterest"></i></a>
                                                </li>
                        -->
                    </ul>

                </div>
            </div>
            <div class="col-sm-8 pull-left text-left">All Rights Reserved © Agazabook 2016 | <a target="_blank" href="http://www.mv-is.com/">Powered By MASTER VISION Integrated Solutions</a>

            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
</footer>
<!-- End Footer =============================================== -->

<!-- COMMON SCRIPTS -->
<script src="<?= base_url('assets/front/plugins/jquery/js') ?>/jquery-2.2.4.min.js"></script>
<script src="<?= base_url('assets/front/plugins/jquery/js') ?>/jquery.cookie.js"></script>
<script src="<?= base_url('assets/front/plugins/bootstrap/js') ?>/bootbox.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/front/plugins/js') ?>/pop_up.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/front/plugins/js') ?>/pop_up_func.js"></script>
<script src="<?= base_url('assets/front/plugins/js') ?>/common_scripts_min.js"></script>
<script src="<?= base_url('assets/front/plugins/js') ?>/functions.js"></script>
<script src="<?= base_url('assets/front/plugins/jquery/js') ?>/jquery-ui.js"></script>


<!-- Specific scripts -->
<script src="<?= base_url('assets/front/plugins/layerslider/js') ?>/greensock.js"></script>
<script src="<?= base_url('assets/front/plugins/layerslider/js') ?>/layerslider.transitions.js"></script>
<script src="<?= base_url('assets/front/plugins/layerslider/js') ?>/layerslider.kreaturamedia.jquery.js"></script>
<script src="<?= base_url('assets/front/plugins/jquery/js') ?>/jquery.flexslider.js"></script>
<script src="<?= base_url('assets/front/plugins/jquery/js') ?>/jquery.mousewheel.js"></script>
<script src="<?= base_url('assets/front/plugins/jquery/js') ?>/jquery.history.js"></script>
<script src="<?= base_url('assets/front/plugins/jquery/js') ?>/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/front/plugins/jquery/js') ?>/additional-methods.min.js"></script>
<script src="<?= base_url('assets/front/plugins/js') ?>/modernizr.js"></script>
<script src="<?= base_url('assets/front/plugins/js') ?>/raphael-2.1.4.min.js"></script>
<!--<script src="<?= base_url('assets/front/plugins/js') ?>/justgage.min.js"></script>-->
<!--<script src="<?= base_url('assets/front/plugins/js') ?>/score.js"></script>-->
<script src="<?= base_url('assets/front/plugins/js') ?>/ion.rangeSlider.min.js"></script>
<script src="<?= base_url('assets/front/plugins/js') ?>/switchery.min.js"></script>
<script src="<?= base_url('assets/front/plugins/js') ?>/theia-sticky-sidebar.min.js"></script>
<script src="<?= base_url('assets/front/plugins/js') ?>/sidebar_carousel_detail_page_func.js"></script>
<script src="<?= base_url('assets/front/plugins/jquery/js') ?>/jquery.nicescroll.min.js"></script>
<script src="<?= base_url('assets/front/js') ?>/pjax.js"></script>
<script src="<?= base_url('assets/front/plugins/bootstrap/js') ?>/bootstrap-datepicker.js"></script>
<script src="<?= base_url('assets/front/plugins/js') ?>/datepicker_func.js"></script>

<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=59b8d96e0a46e80012bb4420&product=inline-share-buttons' async='async'></script>


<script type="text/javascript">
        function dohop_source(request, response) {
            $.ajax({
                jsonp: "cb",
                url: "http://picker.dohop.com/search/?lang=ar&sid=completer",
                dataType: "jsonp",
                data: {m: 10, input: request.term},
                success: function (data) {
                    response($.map(data.standard, function (item) {
                        return {label: item.p + "(" + item.ac + ") " + item.c, value: item.p + "(" + item.ac + ") " + item.c};
                    }));
                }
            });
        }
        $(document).ready(
                function () {
                    $("#a1").autocomplete({source: dohop_source, minLength: 2});
                    $("#a2").autocomplete({source: dohop_source, minLength: 2});
                    $("#d1").datepicker({numberOfMonths: 2, showButtonPanel: true, dateFormat: "dd.mm.y", minDate: new Date(),
                        onSelect: function (text, inst) {
                            $("#d2").datepicker("option", "minDate", $("#d1").datepicker("getDate"));
                        }
                    });
                    $("#d2").datepicker({numberOfMonths: 2, showButtonPanel: true, dateFormat: "dd.mm.y", minDate: new Date()});
                }
        );
</script>



<!--


<script type="text/javascript">
        function dohop_source(request, response) {
            $.ajax({
                jsonp: "cb",
                url: "http://picker.dohop.com/search/?lang=en&sid=completer",
                dataType: "jsonp",
                data: {m: 10, input: request.term},
                success: function (data) {
                    response($.map(data.standard, function (item) {
                        return {label: item.p + "(" + item.ac + ") " + item.c, value: item.p + "(" + item.ac + ") " + item.c};
                    }));
                }
            });
        }
        $(document).ready(
                function () {
                    $("#a1").autocomplete({source: dohop_source, minLength: 2});
                    $("#a2").autocomplete({source: dohop_source, minLength: 2});
//                    $("#d1").datepicker({numberOfMonths: 2, showButtonPanel: true, dateFormat: "dd.mm.y", minDate: new Date(),
//                        onSelect: function (text, inst) {
//                            $("#d2").datepicker("option", "minDate", $("#d1").datepicker("getDate"));
//                        }
//                    });
//                    $("#d2").datepicker({numberOfMonths: 2, showButtonPanel: true, dateFormat: "dd.mm.y", minDate: new Date()});
                    $('#d1').datetimepicker(
                            {
                                format: 'YYYY-MM-DD',
                                useCurrent: false,
                                minDate: new Date(),
                            }
                    );
                    $('#d2').datetimepicker(
                            {
                                format: 'YYYY-MM-DD',
                                useCurrent: false,
                            }
                    );
                    $("#d1").on("dp.change", function (e) {
                        var date = new Date(e.date)
                        //date.setDate(date.getDate() + 1)

                        $('#d2').data("DateTimePicker").minDate(date);
                    });
                }
        );
</script>
-->

<script type="text/javascript">
        'use strict';
        $('#layerslider').layerSlider({
            autoStart: true,
            navButtons: true,
            navStartStop: false,
            showCircleTimer: false,
            responsive: true,
            responsiveUnder: 900,
            layersContainer: 1170,
            skinsPath: '<?= base_url('assets/front/plugins/layerslider/skins') ?>/'
                    // Please make sure that you didn't forget to add a comma to the line endings
                    // except the last line!
        });
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 210,
            itemMargin: 5,
            asNavFor: '#slider'
        });
        $('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });
        $('.flexslider').flexslider({
            animation: "slide",
            controlNav: "thumbnails"
        });
        
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                size: 'small'
            });
        });</script>
<script>

        $(document).ready(
                function () {

//                $("html").niceScroll();
                    $(".scroll").niceScroll({
                        cursorcolor: "#222",
                        railalign: "left"
                    });
                }

        );</script>

<script src="<?= base_url('assets/front/plugins/js') ?>/infobox.js"></script>
<script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-89280678-1', 'auto');
        ga('send', 'pageview');

</script>



<script type="text/javascript">
    
    

</script>




<!-- Histats.com  START (html only)-->
<a href="/" alt="page hit counter" target="_blank" style="display: none;" >
    <embed src="http://s10.histats.com/511.swf"  flashvars="jver=1&acsid=3680584&domi=4"  quality="high"  width="95" height="18" name="511.swf"  align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" /></a>
<img  src="//sstatic1.histats.com/0.gif?3680584&101" alt="website page counter" border="0" style="display: none;">
<!-- Histats.com  END  -->
</body>


<?php
    global $_require;
    if (!empty($_require)) {
        foreach ($_require as $key => $value) {
            if ($key == 'js') {
                $path = 'assets/front/js';
            }
            if ($key == 'css') {
                $path = 'assets/front/css';
            }
            foreach ($value as $file) {
                echo '<script src="' . base_url($path . '/' . $file) . '"></script>';
            }
        }
    }
?>
</html>
