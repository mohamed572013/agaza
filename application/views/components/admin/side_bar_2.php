<!--Left navigation section start-->
<section id="left-navigation">
    <!--Left navigation user details start-->
    <img src="assets/admin/rtl/images/maslogo.png" alt="mas" class="img-responsive">



    <div class="user-image">
        <img src="<?php echo \base_url("uploads/employees/$user_login_image"); ?>" alt=""/>
        <div class="user-online-status"><span class="user-status is-online"></span> </div>
    </div>

    <!--Left navigation user details end-->

    <!--Phone Navigation Menu icon start-->
    <div class="phone-nav-box visible-xs">
        <a class="phone-logo" href="#" title="<?= $settings->site_url ?>">
            <h1>Omera Partner</h1>
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
            <li>
                <a href="<?= \base_url('admin/') ?>">
                    <i class="glyphicon glyphicon-home"></i> <span><?= $lang['home']; ?></span>
                </a>
            </li>

            <?php if ($this->_current_user->user_type != 'ws') { ?>
                    <li>
                        <a href="<?= \base_url('admin/settings/home') ?>">
                            <i class="glyphicon glyphicon-cog"></i> <span><?= $lang['site_settings']; ?></span>
                        </a>
                    </li>
                <?php } ?>
            <!--		<li>
                                    <a href="#">
                                            <i class="glyphicon glyphicon-screenshot"></i> <span><?= $lang['groups']; ?></span>
                                    </a>
                                    <ul>
                                            <li><a href="<?= \base_url('admin/groups/show') ?>"> <?= $lang['view'] . ' ' . $lang['group']; ?></a></li>
                                            <li><a href="<?= \base_url('admin/groups/add') ?>"> <?= $lang['add'] . ' ' . $lang['group']; ?></a></li>
                                    </ul>
                            </li>-->

            <?php
                $page_link_name = $this->uri->segment(2);
                //echo $page_link_name;
                $sql = "SELECT parent_id  from pages WHERE controller = '$page_link_name'  ";
                $query = $this->db->query($sql);
                $result = $query->result();
                if (\count($result) > 0) {
                    $active_parent_id = $result[0]->parent_id;
                } else {
                    $active_parent_id = 0;
                }

                if (\count($main_pages) > 0) {
                    foreach ($main_pages as $value) {
                        if ($active_parent_id == $value->id) {
                            $main_menu_active = "active";
                        } else {
                            $main_menu_active = "";
                        }
                        ?>
                        <?php
//                        if ($this->_current_user->user_type == 'super admin' && $value->name == 'hotels') {
//                            continue;
//                        }
                        if ($this->_current_user->user_type == 'admin' && ($value->name == 'hotels' || $value->name == 'settings' || $value->name == 'flight' || $value->name == 'programms' || $value->name == 'user_management')) {
                            continue;
                        }
                        if ($this->_current_user->user_type == 'ws' && ($value->name == 'settings' || $value->name == 'basic_data' || $value->name == 'flight' || $value->name == 'programms' || $value->name == 'user_management')) {
                            continue;
                        }
                        ?>
                        <li class="<?php echo $main_menu_active; ?>">
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i> <span><?= $lang["$value->name"]; ?></span>
                            </a>
                            <ul>
                                <?php
                                $pages_sub = $this->Users_model->GetAllMainMenuPages($value->id, $sub_pages);
                                if (\count($pages_sub) > 0) {
                                    foreach ($pages_sub as $value_page) {
                                        $page_link_controller = $value_page->controller;
                                        $page_sub_name = _lang($value_page->name);
                                        if ($page_link_name == $page_link_controller) {
                                            $active_li = "active";
                                        } else {
                                            $active_li = "";
                                        }
                                        ?>
                                        <?php
                                        if ($this->_current_user->user_type == 'admin' && ($value_page->name == 'hotels' || $value_page->name == 'branches' || $value_page->name == 'departments' || $value_page->name == 'places' || $value_page->name == 'home_slider' || $value_page->name == 'news' || $value_page->name == 'ads')) {
                                            continue;
                                        }
                                        ?>
                                        <li ><a  class="<?php echo $active_li; ?>" href="<?= \base_url("admin/$page_link_controller/show") ?>"> <?= $page_sub_name; ?></a></li>

                                        <?php
                                    }
                                }
                                ?>

                            </ul>
                        </li>

                        <?php
                    }
                }
                //pr($main_pages);
            ?>


        </div>

    </ul>

    <!--Left navigation end-->
</section>
<!--Left navigation section end-->



