<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view("components/admin/meta", $data); ?>
    </head>
    <body class="blue-color">
        <?php $this->load->view("components/admin/header"); ?>
        <?php $this->load->view("components/admin/side_bar"); ?>
        <section id="main-container">
            <?php $this->load->view("main_content/admin/" . $main_content); ?>

            <nav class="navbar-bottom">
                <div class="container-fluid">
                    <h5 style="text-align: center;line-height: 45px;direction: ltr;font-size: 14px; color:#fff; margin: 0;">
                        Copyright © 2016 , Powered By <a target="_blank" href="http://www.mv-is.com" title="Master Vision"><img src="<?php echo \base_url() ?>/assets/copyrightlogoblack.png" style="width: 10%;"> <span style="color: #F6921B;"> Master Vision</span>   </a>  Integrated Solutions All rights reserved.
                    </h5>
                    <!--<h2 style="display: none; text-align: center;line-height: 45px;direction: ltr;font-size: 14px; color:#fff;">Developed by Mahmoud Ramadan Awad </h2>-->
                </div>
            </nav>
        </section>
        <?php $this->load->view("components/admin/footer"); ?>

    </body>
</html>