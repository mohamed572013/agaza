<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="اجازة بوك ترويج وتسويق البرامج والفنادق الخاصة بشركة السياحة نوفر لك رحلات شرم الشيخ ورحلات الغردقة ورحلات العين السخنة ورحلات الحج والعمرة وحجز تذاكر طيران ورحلات الى أوروبا ورحلات شهر العسل">
        <meta name="keywords" content="طيران,فنادق,شرم الشيخ,الغردقة,رحلات,برامج سياحة, العين السخنة,الحج,العمرة,مزارات,اجازة,فندق,تذاكر طيران,طيران مخفض,حج وعمرة,اجازة بوك,agazabook">
        <meta name="author" content="MASTER VISION Integrated Solutions">
        <title>Going to</title>

        <!-- Favicons-->
        <link rel="shortcut icon" href="http://agazabook.com/img/favicon.ico" type="image/x-icon">




        <!-- BASE CSS -->
        <link href="http://agazabook.com/assets/front/plugins/css/animate.min.css" rel="stylesheet">
        <link href="http://agazabook.com/assets/front/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- YOUR CUSTOM CSS -->
        <link href="http://agazabook.com/assets/front/css/custom.css" rel="stylesheet">

    </head>
    <body class="no-overflow" data-color="theme-3">

        <div class="container mt20">

            <div class="col-md-12 text-center mt20">
                <h1 class="mt20">مبرووك</h1>
                <h2>لقد وجدت عرض رائع</h2>
                <p>سوف تحجز الآن مع   <span style="color: #0069d6"><?= $details->url ?></span> </p>
                <div class="co_logo">
                    <img  src="" alt="" />
                </div>

                <p class="countdown">
                <div id="status"></div>
                </p>
                <div class="button-search">

                    <a id="btn_go" href="<?= $details->url ?>" class="button btn btn-primary">اذهب الأن</a>
                </div>

            </div>





        </div>
        <script src="http://agazabook.com/assets/front/plugins/jquery/js/jquery-2.2.4.min.js"></script>
        <script src="http://agazabook.com/assets/front/plugins/bootstrap/js/bootbox.min.js"></script>
        <script>
                function countDown(secs, elem) {
                    var element = document.getElementById(elem);
                    var btn_go = document.getElementById('btn_go');
                    element.innerHTML = "سوف تتوجه الأن بعد " + secs;
                    if (secs < 1) {
                        clearTimeout(timer);
                        element.innerHTML = '';
                        btn_go.innerHTML = 'تحميل الصفحة!';
                        window.location = '<?= $url ?>';
                        //element.innerHTML += '<a href="#">Click here now</a>';
                    }
                    secs--;
                    var timer = setTimeout('countDown(' + secs + ',"' + elem + '")', 1000);
                }
                countDown(1, "status");

                $(document).ready(function() {
                    setTimeout(function() {
                        alert("dddd");
                    }, 1500);
                });
        </script>

    </body>
</html>
