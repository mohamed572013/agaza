<div class="loading blue">
    <div class="loading-center">
        <div class="loading-center-absolute">
            <div class="object object_four"></div>
            <div class="object object_three"></div>
            <div class="object object_two"></div>
            <div class="object object_one"></div>
        </div>
    </div>
</div>

<header class="color-1 hovered menu-3">
    <div class="linetop slideLeft"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="nav">
                    <a href="<?= base_url(); ?>" class="logo">
                        <img  class="slideDown" src="<?= base_url('assets/front/images/theme-1/maslogo.png') ?>" alt="alwesam tours">                    </a>
                    <div class="nav-menu-icon">
                        <a href="#"><i></i></a>
                    </div>
                    <nav class="menu slideRight">
                        <ul>
                            <li class="type-1 active"><a href="<?= site_url('haj_umrah'); ?>">الرئيسية</a></li>

                            <li class="type-1"><a href="<?= site_url(''); ?>" onclick="return false">برامجنا</a></li>
                            <li class="type-1"><a href="<?= site_url(''); ?>" onclick="return false">فنادقنا</a></li>
                            <li class="type-1"><a href="<?= site_url(''); ?>" onclick="return false">المزارات</a></li>
                            <!--                            <li class="type-1"><a href="urprogram.php">صمم برنامجك</a></li>-->
                            <li class="type-1"><a href="<?= site_url('about_us'); ?>">عن شركتنا</a></li>
                            <li class="type-1"><a href="<?= site_url('contact_us'); ?>">إتصل بنا</a></li>
                            <li class="type-1"><a href="<?= site_url('domestic_tourism'); ?>">السياحة الداخلية</a></li>

                            <?php if ($this->isEmployee || $this->isGuest) { ?>
                                    <?php
                                    if (isset($this->Guest->fullname)) {
                                        $name = $this->Guest->fullname;
                                    }
                                    if (isset($this->Employee->title_ar)) {
                                        $name = $this->Employee->title_ar;
                                    }
                                    ?>
                                    <li class="type-1"><a>
                                            <span class="pull-right hello">مرحبا</span>  <span class="pull-right uname"><?= $name ?></span>
                                        </a></li>
                                    <li class="type-1"><a href="<?= base_url('logout'); ?>"><i class="fa fa-user-times" aria-hidden="true"></i> خروج</a></li>

                                <?php } else { ?>
                                    <li class="type-1"><a href="<?= base_url('login'); ?>"><i class="fa fa-user" aria-hidden="true"></i> تسجيل الدخول</a></li>
                                    <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>