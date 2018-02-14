<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if(isset($data['seo']) && $data['seo'] != "") { ?>
<meta name="description" content="<?= strip_tags($data['seo']['keywords']) ?>">
<meta name="keywords" content="<?= strip_tags($data['seo']['description']) ?>">
<?php } else { ?>
<meta name="description" content="اجازة بوك ترويج وتسويق البرامج والفنادق الخاصة بشركة السياحة نوفر لك رحلات شرم الشيخ ورحلات الغردقة ورحلات العين السخنة ورحلات الحج والعمرة وحجز تذاكر طيران ورحلات الى أوروبا ورحلات شهر العسل">
<meta name="keywords" content="طيران,فنادق,شرم الشيخ,الغردقة,رحلات,برامج سياحة, العين السخنة,الحج,العمرة,مزارات,اجازة,فندق,تذاكر طيران,طيران مخفض,حج وعمرة,اجازة بوك,agazabook">
<?php } ?>
<meta name="author" content="MASTER VISION Integrated Solutions">
<title>اجازة بوك | Agazabook</title>

<!-- Favicons-->
<link rel="shortcut icon" href="<?= base_url() ?>img/favicon.ico" type="image/x-icon">
<meta property="fb:app_id" content="302084966936348" />
<meta property="og:url"                content="<?= $og_url ?>" />
<meta property="og:type"               content="article" />
<?php if(isset($data['og']) && $data['og'] != "") { ?>
    <meta property="og:title"              content="<?= $data['og']['title'] ?>" />
    <meta property="og:description"        content="<?= strip_tags($data['og']['description']) ?>" />
    <meta property="og:image"              content="<?= $data['og']['image'] ?>" />
<?php } else { ?>
    <meta property="og:title"              content="اجازة بوك | Agazabook" />
    <meta property="og:description"        content="" />
    <meta property="og:image"              content="http://agazabook.com/assets/admin/rtl/images/Agazabook.png" />
<?php } ?>

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,300" rel="stylesheet" type="text/css">

<!-- BASE CSS -->
<link href="<?= base_url('assets/front/plugins/css') ?>/animate.min.css" rel="stylesheet">
<link href="<?= base_url('assets/front/plugins/bootstrap/css') ?>/bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url('assets/front/plugins/css') ?>/style.css" rel="stylesheet">
<link href="<?= base_url('assets/front/plugins/css') ?>/menu.css" rel="stylesheet">
<link href="<?= base_url('assets/front/plugins/jquery/css') ?>/jquery-ui.css" rel="stylesheet">
<link href="<?= base_url('assets/front/plugins/css/icon_fonts/css') ?>/all_icons.min.css" rel="stylesheet">

<!-- SPECIFIC CSS -->
<link href="<?= base_url('assets/front/plugins/layerslider/css') ?>/layerslider.min.css" rel="stylesheet">
<!-- SPECIFIC CSS -->
<link href="<?= base_url('assets/front/plugins/css') ?>/ion.rangeSlider.css" rel="stylesheet">
<link href="<?= base_url('assets/front/plugins/css') ?>/magnific-popup.min.css" rel="stylesheet">
<link href="<?= base_url('assets/front/plugins/css') ?>/date_time_picker.css" rel="stylesheet">
<link href="<?= base_url('assets/front/plugins/css') ?>/date_time_picker.css" rel="stylesheet">
<link href="<?= base_url('assets/front/plugins/css') ?>/flexslider.css" rel="stylesheet">
<link href="<?= base_url('assets/front/plugins/css') ?>/pop_up.css" rel="stylesheet">
<!-- YOUR CUSTOM CSS -->
<link href="<?= base_url('assets/front/css') ?>/custom.css" rel="stylesheet">

<!--[if lt IE 9]>
  <script src="js/html5shiv.min.js"></script>
  <script src="js/respond.min.js"></script>
<![endif]-->

<script>
        var config = {
            base_url: '<?php echo site_url() . '/'; ?>',
            url: '<?php echo base_url(); ?>',
            admin_url: '<?= base_url() ?>admin/'
        };
        var lang = {
            title_slug: "title_ar",
            form_client: {
                username: {
                    required: "ادخل الاسم"
                },
                phone: {
                    required: "ادخل التليفون "
                },
                email: {
                    required: "ادخل البريد الاإلكترونى"
                },
                address: {
                    required: "ادخل العنوان"
                },
                birthdate: {
                    required: "ادخل تاريخ الميلاد"
                }
            },
            form_travellers_num: {
                adult_num: {
                    required: "ادخل عدد البالغين"
                }
            },
            form_travellers_info: {
                "travellers_names[]": {
                    required: "ادخل الاسم"
                },
                "travellers_gender[]": {
                    required: "ادخل السن"
                }
            },
        };
</script>
