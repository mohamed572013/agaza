<?php

    class Admin_Controller extends CI_Controller{

        public $User;
        public $isUser = false;
        public $_current_user = null;
        public $current_user_company = null;
        public $current_user_branch = null;
        public $_login_data = null;
        public $_last_view = null;
        public $Modules = array();
        public $Main_pages = array();
        public $Sub_pages = array();
        public $whitelabel_id = 14;

        function __construct(){
            parent::__construct();

            $this->lang->load('app_lang', 'arabic');
            $this->load->model('Users_model');
            $this->load->model('User_model', 'user');
            $this->load->model('Settings_model');
            $this->load->model('Admin_model');
            $this->load->model('Permissions_model', 'permissions');
            $this->load->model('Groups_model', 'Groups');
            $this->load->model('Home_model');
            $this->load->model('Reservation_model', 'reservation');
            $this->_settings = $this->Settings_model->getSettings($this->whitelabel_id);
            if ($this->user->logged_in()) {
                $this->User = $this->user->current_user($this->whitelabel_id);
                $user_permissions = $this->user->permissions($this->User->user_group_id);
                //pri();

                if ($user_permissions) {
                    if ($user_permissions->group_options !== null) {
                        $this->permissions->set_permissions($user_permissions->group_options);
                    } else {
                        $this->permissions->set_permissions(array());
                    }
                }
                $this->config->load('modules');
                $modules = $this->config->item('modules');
                $this->Modules = $modules[$this->User->user_type];
                $this->Main_pages = $modules[$this->User->user_type]['main'];
                $this->Sub_pages = $modules[$this->User->user_type]['sub'];
                //pri($this->Main_pages);
                $this->_current_user = $this->user->current_user($this->whitelabel_id);
                $this->_login_data = (array) $this->user->current_user($this->whitelabel_id);
                $this->isUser = true;
                $this->data['modules'] = $this->Modules;
                $this->data['Main_pages'] = $this->Main_pages;
                $this->data['Sub_pages'] = $this->Sub_pages;
                $this->data['settings'] = $this->_settings;
                $this->lang->load('app_lang', $this->_settings->site_language);
                $this->_lang = $this->lang->language;
                $this->data['lang'] = $this->_lang;
                $this->data['user_login_image'] = "defult.jpg";
                $this->data['main_pages'] = $this->Admin_model->main_pages();
                $this->data['user_data'] = $this->user->current_user($this->whitelabel_id);
                $this->data['page_link_name'] = $this->uri->segment(2);


                $this->data['user_type'] = $this->_current_user->user_type;
                $this->current_user_company = $this->Users_model->getCurrentCompany($this->_current_user->branches_id);
                $this->data['current_user_company'] = $this->Users_model->getCurrentCompany($this->_current_user->branches_id);
                $this->current_user_branch = $this->Users_model->getCurrentbranch($this->_current_user->departments_id);
                $this->data['current_user_branch'] = $this->Users_model->getCurrentbranch($this->_current_user->departments_id);
                $this->login = true;
            }

            $this->data['view_name'] = $this->uri->segment('2');
            $this->data['view_type'] = $this->uri->segment('3');
            $this->data['_id'] = $this->uri->segment('4');
            $this->load->model("notification_model", "notifications");
            
        }

        public function _view($main_content, $type = 'front'){
            $data['main_content'] = $main_content;
            $data['data'] = $this->data;
            $view_dir = 'layouts';
            if ($type == 'front') {
                $this->load->view($view_dir . '/main_layout.php', $data);
            }
            if ($type == 'admin') {
                $this->load->view($view_dir . '/admin_layout.php', $data);
            }
            if ($type == 'haj_umrah') {
                $this->load->view($view_dir . '/haj_umrah_layout.php', $data);
            }
        }




    }
