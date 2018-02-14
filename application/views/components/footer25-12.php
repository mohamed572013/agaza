<!-- Footer ================================================== -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 pull-left">
                <h3>عن شركتنا</h3>
                <p>ترويج وتسويق البرامج والفنادق الخاصة بشركة السياحة </p>
                <p><img src="<?= base_url() ?>img/logo.png" alt="img" class="hidden-xs" width="170" height="30" data-retina="true">
                </p>
            </div>
            
                <div class="col-md-3 col-sm-12 pull-left">
                <h3>بيانات الأتصال</h3>
                <div class="contact-info">
                    <div class="contact-line color-white"><i class="icon-location"></i><span>19 أ عمارات العبور صلاح سالم - القاهرة جمهورية مصر العربية</span></div>
                    <div class="contact-line color-white"><i class="icon-phone"></i><a href="#">14963622 (+202) </a></div>
                    <div class="contact-line color-white"><i class="icon-mail-alt"></i><a href="mailto:">info@agazabook.com</a></div>
                    <div class="contact-line color-white"><i class="icon-globe"></i><a href="#">www.agazabook.com</a></div>

                </div>
            </div>
            
            <div class="col-md-2 col-sm-12 pull-left">
                <h3>روابط هامة</h3>
                <ul>
                    <li><a href="#" onclick="return false,">عن الشركة</a>
                    </li>
                    <li><a href="#"  onclick="return false,">الاسئلة الشائعة</a>
                    </li>
                    <li><a href="#"  onclick="return false,">اتصل بنا</a>
                    </li>
                    <li><a href="#"  onclick="return false,">برامج</a>
                    </li>
                    <li><a href="#"  onclick="return false,">فنادق</a>
                    </li>
                    <li><a href="#"  onclick="return false,">طيران</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-12 pull-left" id="newsletter">
                <h3>النشرة البريدية</h3>
                <p>
                    انضم الينا و استمتع بافضل عروض السفر و الرحلات
                </p>
                <div id="message-newsletter_2">
                </div>
                <form method="post" action="#" name="newsletter_2" id="newsletter_2">
                    <div class="form-group">
                        <input name="email_newsletter_2" id="email_newsletter_2" type="email" value="" placeholder="البريد الالكترونى" class="form-control">
                    </div>
                    <p>
                        <input type="submit" value="اشترك الان" class="button" id="submit-newsletter_2">
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
                        <li><a href="#0"><i class="icon-facebook"></i></a>
                        </li>
                        <li><a href="#0"><i class="icon-twitter"></i></a>
                        </li>
                        <li><a href="#0"><i class="icon-google"></i></a>
                        </li>
                        <li><a href="#0"><i class="icon-instagram"></i></a>
                        </li>
                        <li><a href="#0"><i class="icon-pinterest"></i></a>
                        </li>
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
<!--<script src="<?= base_url('assets/front/plugins/bootstrap/js') ?>/bootstrap.rtl.js"></script>-->
<script src="<?= base_url('assets/front/plugins/bootstrap/js') ?>/bootbox.min.js"></script>
<script src="<?= base_url('assets/front/plugins/js') ?>/common_scripts_min.js"></script>

<!--<script src="<?= base_url('assets/front/plugins/js') ?>functions.js"></script>-->

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
<script src="<?= base_url('assets/front/js') ?>/pjax.js"></script>
<script type="text/javascript">
                            'use strict';
                            $('#layerslider').layerSlider({
                            autoStart: true,
                                    navButtons: false,
                                    navStartStop: false,
                                    showCircleTimer: false,
                                    responsive: true,
                                    responsiveUnder: 1400,
                                    layersContainer: 1170,
                                    skinsPath: '<?= base_url('assets/front/plugins/layerslider/skins') ?>'
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
                            $("#range").ionRangeSlider({
                            hide_min_max: true,
                                    keyboard: true,
                                    min: 30,
                                    max: 180,
                                    from: 60,
                                    to: 130,
                                    type: 'double',
                                    step: 1,
                                    prefix: "Min. ",
                                    grid: false
                            });
                            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                            elems.forEach(function (html) {
                            var switchery = new Switchery(html, {
                            size: 'small'
                            });
                            });</script>

<script src="<?= base_url('assets/front/plugins/js') ?>/infobox.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89280678-1', 'auto');
  ga('send', 'pageview');

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
