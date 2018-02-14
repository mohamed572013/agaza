<!--Left navigation section start-->
<section id="left-navigation">
    <!--Left navigation user details start-->
    <img src="assets/admin/rtl/images/agazabbokwh.png" alt="mas" class="img-responsive">



    <!--    <div class="user-image">

            <img src="" alt=""/>
            <div class="user-online-status"><span class="user-status is-online"></span> </div>
        </div>-->

    <!--Left navigation user details end-->

    <!--Phone Navigation Menu icon start-->
    <div class="phone-nav-box visible-xs">
        <a class="phone-logo" href="#" title="<?= site_url() ?>">
            <h1><?= $settings->site_title_ar ?></h1>

        </a>





        <a class="phone-nav-control" href="javascript:void(0)">
            <span class="fa fa-bars"></span>
        </a>
        <div class="clearfix"></div>
    </div>
    <!--Phone Navigation Menu icon start-->

    <!--Left navigation start-->

    <ul class="mainNav">
        <div class="scrollNav">
            <?php if (check_permission('admin', 'open')) { ?>
                    <li>
                        <a href="<?= \base_url('admin/') ?>">
                            <i class="glyphicon glyphicon-home"></i> <span><?= $lang['home']; ?></span>
                        </a>
                    </li>
                <?php } ?>
            <?php if (check_permission('settings', 'open')) { ?>
                    <li>
                        <a href="<?= \base_url('admin/settings') ?>">
                            <i class="glyphicon glyphicon-cog"></i> <span><?= $lang['site_settings']; ?></span>
                        </a>
                    </li>
                <?php } ?>


            <?php
                if (count($main_pages) > 0) {
                    foreach ($main_pages as $value) {
                        if ($value->name == 'admin' || $value->name == 'settings') {
                            continue;
                        }
                        if (main_page_one_parent_id($page_link_name) == $value->id) {
                            $main_menu_active = "active";
                        } else {
                            $main_menu_active = "";
                        }
                        ?>
                        <?php if (check_permission($value->name, 'open')) { ?>

                            <li class="<?= $main_menu_active; ?>">
                                <a href="#">
                                    <i class="glyphicon glyphicon-user"></i> <span><?= _lang($value->name); ?></span>
                                </a>
                                <ul>
                                    <?php
                                    $pages_sub = sub_pages($value->id);

                                    if (count($pages_sub) > 0) {
                                        foreach ($pages_sub as $value_page) {
                                            if ($page_link_name == $value_page->controller) {
                                                $active_li = "active";
                                            } else {
                                                $active_li = "";
                                            }
                                            ?>

                                            <?php if (check_permission($value_page->name, 'open')) { ?>
                                                <li ><a  class="<?php echo $active_li; ?>" href="<?= \base_url("admin/$value_page->controller/show") ?>"> <?= _lang($value_page->name); ?></a></li>
                                            <?php } ?>

                                            <?php
                                        }
                                    }
                                    ?>

                                </ul>
                            </li>

                        <?php } ?>
                        <?php
                    }
                }
            ?>

        </div>

    </ul>

    <!--Left navigation end-->
</section>
<!--Left navigation section end-->



