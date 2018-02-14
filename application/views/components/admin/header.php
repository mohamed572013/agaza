<!--Navigation Top Bar Start-->
<nav class="navigation">
    <div class="container-fluid">
        <!--Logo text start-->
        <div class="header-logo">
            <a href="<?= site_url() ?>" target="_blank">
                <h4><?= $settings->site_title_ar ?></h4>
            </a>
        </div>
        <!--Logo text End-->
        <div class="top-navigation">
            <!--Collapse navigation menu icon start -->
            <div class="menu-control hidden-xs">
                <a href="javascript:void(0)">
                    <i class="fa fa-bars"></i>
                </a>
            </div>


            <!--Collapse navigation menu icon end -->
            <!--Top Navigation Start-->

            <ul>

              					<li class="dropdown" id="notifications-block"></li> 

                <li>
                    <a href="<?= \base_url('admin/logout') ?>">
                        <i class="fa fa-power-off"></i>
                    </a>
                </li>

            </ul>
            <ul class="breadcrumb hidden-xs" style="background: none !important;">
                <li><a href="<?= base_url('admin') ?>"><i class="fa fa-home"></i></a></li>


                <li>
                    <span style="color: #333">  <?= $lang['branches_name']; ?>: </span>
                    <span><?= $current_user_company->title_ar; ?></span>

                </li>
                <li>
                    <span style="color: #333">  <?= $lang['departments_name']; ?>: </span>
                    <span><?= $current_user_branch->title_ar; ?></span>

                </li>
                <li>
                    <span style="color: #333">  <?= $lang['user_name']; ?>: </span>
                    <span><?= $user_data->user_name; ?></span>

                </li>
            </ul>
            <!--Top Navigation End-->
        </div>
    </div>
</nav>
