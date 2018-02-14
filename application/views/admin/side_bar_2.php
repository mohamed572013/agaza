<!--Left navigation section start-->
<section id="left-navigation">
    <!--Left navigation user details start-->
    <img src="assets/admin/rtl/images/agazabbokwh.png" alt="mas" class="img-responsive">



    <div class="user-image">
        <img src="<?php echo \base_url("uploads/employees/$user_login_image"); ?>" alt=""/>
        <div class="user-online-status"><span class="user-status is-online"></span> </div>
    </div>

    <!--Left navigation user details end-->

    <!--Phone Navigation Menu icon start-->
    <div class="phone-nav-box visible-xs">
        <a class="phone-logo" href="#" title="<?= $settings->site_url ?>">
            <h1>Agazabook</h1>
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
            <!--

                                    <li>
                                            <a href="#">
                                                    <i class="glyphicon glyphicon-user"></i> <span><?= $lang['users']; ?></span>
                                            </a>
                                            <ul>
                                                    <li><a href="<?= \base_url('admin/users/show') ?>"> <?= $lang['view'] . ' ' . $lang['user']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/users/add') ?>"> <?= $lang['add'] . ' ' . $lang['user']; ?></a></li>
                                            </ul>
                                    </li>


                                    <li>
                                            <a href="#">
                                                    <i class="glyphicon glyphicon-list-alt"></i> <span><?= $lang['basic_data']; ?></span>
                                            </a>
                                            <ul>
                                                    <li><a href="<?= \base_url('admin/branches/show') ?>"> <?= $lang['view'] . ' ' . $lang['branches']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/departments/show') ?>"> <?= $lang['view'] . ' ' . $lang['departments']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/employees/show') ?>"> <?= $lang['view'] . ' ' . $lang['employees']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/activities/show') ?>"> <?= $lang['view'] . ' ' . $lang['activities']; ?></a></li>

                                                    <li><a href="<?= \base_url('admin/banks/show') ?>"> <?= $lang['view'] . ' ' . $lang['banks']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/currency/show') ?>"> <?= $lang['view'] . ' ' . $lang['currency']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/save/show') ?>"> <?= $lang['view'] . ' ' . $lang['save']; ?></a></li>
                                            </ul>
                                    </li>

                                    <li>
                                            <a href="#">
                                                    <i class="glyphicon glyphicon-list-alt"></i> <span> <?php echo $lang['partners']; ?></span>
                                            </a>
                                            <ul>
                                                    <li><a href="<?= \base_url('admin/partners/show') ?>"> <?= $lang['view'] . ' ' . $lang['partners']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/receipt_of_cash_partners/show') ?>"> <?= $lang['receipt_of_cash_partners']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/exchange_request_cash_partners/show') ?>"> <?= $lang['exchange_request_cash_partners']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/exchange_pay_cash_partners/show') ?>"> <?= $lang['exchange_pay_cash_partners']; ?></a></li>

                                            </ul>
                                    </li>
                                    <li>
                                            <a href="#">
                                                    <i class="glyphicon glyphicon-list-alt"></i> <span> <?php echo $lang['suppliers']; ?></span>
                                            </a>
                                            <ul>
                                                    <li><a href="<?= \base_url('admin/suppliers/show') ?>"> <?= $lang['view'] . ' ' . $lang['suppliers']; ?></a></li>

                                                    <li><a href="<?= \base_url('admin/request_supply_cash_supplier/show') ?>"> <?= $lang['request_supply_cash_supplier']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/receipt_of_cash_supplier/show') ?>"> <?= $lang['receipt_of_cash_supplier']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/request_pay_cash/show') ?>"> <?= $lang['request_pay_cash']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/pay_of_cash/show') ?>"> <?= $lang['pay_of_cash']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/exchange_request_cash/show') ?>"> <?= $lang['exchange_request_cash']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/exchange_pay_cash/show') ?>"> <?= $lang['exchange_pay_cash']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/suppliers_fatora/show') ?>"> <?= $lang['suppliers_fatora']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/suppliers_fatora_delete/show') ?>"> <?= $lang['suppliers_fatora_delete']; ?></a></li>
                                            </ul>
                                    </li>
                                    <li>
                                            <a href="#">
                                                    <i class="glyphicon glyphicon-list-alt"></i> <span> <?php echo $lang['customers']; ?></span>
                                            </a>
                                            <ul>

                                                    <li><a href="<?= \base_url('admin/customers/show') ?>"> <?= $lang['view'] . ' ' . $lang['customers']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/request_supply_cash/show') ?>"> <?= $lang['request_supply_cash']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/receipt_of_cash/show') ?>"> <?= $lang['receipt_of_cash']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/ohda_settlement/show') ?>"> <?= $lang['ohda_settlement']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/request_supply_cash_under_account/show') ?>"> <?= $lang['request_supply_cash_under_account']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/receipt_of_cash_under_account/show') ?>"> <?= $lang['receipt_of_cash_under_account']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/exchange_request_cash_customers/show') ?>"> <?= $lang['exchange_request_cash_customers']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/exchange_pay_cash_customers/show') ?>"> <?= $lang['exchange_pay_cash_customers']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/customers_fatora/show') ?>"> <?= $lang['customers_fatora']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/customers_fatora_delete/show') ?>"> <?= $lang['customers_fatora_delete']; ?></a></li>
                                            </ul>
                                    </li>
                                    <li>
                                            <a href="#">
                                                    <i class="glyphicon glyphicon-list-alt"></i> <span> <?php echo $lang['other']; ?></span>
                                            </a>
                                            <ul>

                                                    <li><a href="<?= \base_url('admin/request_supply_cash_other/show') ?>"> <?= $lang['request_supply_cash_other']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/receipt_of_cash_other/show') ?>"> <?= $lang['receipt_of_cash_other']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/exchange_request_cash_other/show') ?>"> <?= $lang['exchange_request_cash_other']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/exchange_pay_cash_other/show') ?>"> <?= $lang['exchange_pay_cash_other']; ?></a></li>

                                                    <li><a href="<?= \base_url('admin/cost_value_editing/show') ?>"> <?= $lang['cost_value_editing']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/converting_checks_to_cash/show') ?>"> <?= $lang['converting_checks_to_cash']; ?></a></li>
                                            </ul>
                                    </li>

                                    <li>
                                            <a href="#">
                                                    <i class="glyphicon glyphicon-list-alt"></i> <span><?php echo $lang['reports']; ?></span>
                                            </a>
                                            <ul>
                                                    <li><a href="<?= \base_url('admin/save_movement_report/show') ?>"> <?= $lang['save_movement_report']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/cost_value_editing_report/show') ?>"> <?= $lang['cost_value_editing_report']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/customer_statment_account/show') ?>"> <?= $lang['customer_statment_account']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/supplier_statment_account/show') ?>"> <?= $lang['supplier_statment_account']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/partner_statment_account/show') ?>"> <?= $lang['partner_statment_account']; ?></a></li>
                                            </ul>
                                    </li>
                                    <li>
                                            <a href="#">
                                                    <i class="glyphicon glyphicon-list-alt"></i> <span><?php echo $lang['receipts_and_exchange_cash_reports']; ?></span>
                                            </a>
                                            <ul>
                                                    <li><a href="<?= \base_url('admin/cash_receipts_report/show') ?>"> <?= $lang['cash_receipts_report']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/cash_receipts_exchange_report/show') ?>"> <?= $lang['cash_receipts_exchange_report']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/ohda_settlement_complate_report/show') ?>"> <?= $lang['ohda_settlement_complate_report']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/ohda_settlement_not_complate_report/show') ?>"> <?= $lang['ohda_settlement_not_complate_report']; ?></a></li>
                                                    <li><a href="<?= \base_url('admin/receipts_associated_exchange/show') ?>"> <?= $lang['receipts_associated_exchange']; ?></a></li>
                                    </ul>
                            </li>

            -->

        </div>

    </ul>

    <!--Left navigation end-->
</section>
<!--Left navigation section end-->



