<title>
    <?php
        if (isset($page_title)) {
            echo $page_title;
        } else {
            echo'agazabook';
        }
    ?>
</title>
<meta charset="utf-8">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<meta name="keywords" content="اجازة بوك, اجازة,بوك,رحلات," />
<meta name="description" content="موقع اجازة بوك لخدمات السياحة و حجز الرحلات و الفنادق">

<link href="<?= base_url('assets/front/images/favicon.png') ?>" rel="shortcut icon"/>
<link href="<?= base_url('assets/front/css/bootstrap-rtl.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/front/css/bootstrap-datetimepicker.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/front/css/jquery-ui.structure.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/front/css/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/front/css/font-awesome.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/front/css/select2.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/front/css/soap.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/front/css/style.css') ?>" rel="stylesheet" type="text/css"/>
<!--<link href="<?= base_url('assets/front/css/animations.css') ?>" rel="stylesheet" type="text/css"/>-->
<link href="<?= base_url('assets/front/css/hover.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/front/css/customs.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/front/css/alwesam.css') ?>" rel="stylesheet" type="text/css"/>

<script>
        var config = {
            base_url: '<?php echo base_url(); ?>'
        };
        var lang = {
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
