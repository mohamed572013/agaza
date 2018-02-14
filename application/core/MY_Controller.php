<?php

    class MY_Controller extends CI_Controller{

        public $data = array(),
                $_lang = null,
                $lang_code = null,
                $_settings = null,
                $login = null,
                $check_admin = null,
                $_login_data = null,
                $_last_view = null,
                $_current_user = null,
                $current_user_company = null,
                $current_user_branch = null,
                $Employee = null,
                $isEmployee = null,
                $Guest = null,
                $isGuest = null,
                $employee_company_id = null,
                $whitelabel_id = 14;

        public function __construct(){
            parent::__construct();


		//	pri($result);
			


            $this->load_lang_files();
            $this->load->model('Home_model', 'home');
            $this->load->model('About_us_model', 'about_us');
            $this->_lang = $this->lang->lang();
            $this->data['about_us'] = $this->about_us->getAboutUs($this->whitelabel_id);
            $this->data['current_lang'] = $this->_lang;
            $settings = $this->home->getSettings($this->whitelabel_id);
            if ($settings) {
                $settings->site_contacts = json_decode($settings->site_contacts);
            }
            $this->data['settings'] = $settings; 
			
			
			
			$this->data['og_url'] = base_url() . urldecode($this->uri->uri_string());
            $this->data['og_type'] = "package";
            $this->data['og_title'] = "";
            $this->data['og_description'] = "";
        }

        public function view($view_path, $assign = '', $view_type = false){
            $this->data[] = $assign;
            $this->data['view_name'] = $this->uri->segment('2');
            $this->data['view_type'] = $this->uri->segment('3');
            $this->data['_id'] = $this->uri->segment('4');

            $view_dir = 'home';
            try {
                if ($view_type === true) {
                    $this->load->view($view_path, $this->data);
                    $this->_last_view = true;
                } else {
                    if ($this->_last_view != true) {
                        $this->load->view($view_dir . '/header.php', $this->data);
                        $this->load->view($view_dir . '/side_bar.php');
                        $this->load->view($view_path);
                        $this->load->view($view_dir . '/footer.php');
                    }
                }
            } catch (Exception $exc) {
                echo $exc->getMessage();
            }
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

        

        public function SendMail($array_mail = array()){
            if ($this->_settings->smtp_active == '1') {
                $smtp_config = array(
                    'protocol' => 'smtp',
                    'smtp_crypto' => 'tls',
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'smtp_port' => $this->_settings->smtp_port,
                    'smtp_host' => $this->_settings->smtp_host,
                    'smtp_user' => $this->_settings->smtp_username,
                    'smtp_pass' => $this->_settings->smtp_password,
                );
                $this->email->initialize($smtp_config);
            }
            $this->email->from($this->_settings->site_mail, $this->_settings->site_name);
            $this->email->to($array_mail['to']);
            $this->email->subject($array_mail['subject']);
            $this->email->message($array_mail['message']);
            return $this->email->send();
        }

        public function load_lang_files(){
            $this->lang_code = $this->lang->lang();
            //pri($this->lang_code);
            $lang_array = array(
                "ar" => "arabic",
                "en" => "english",
                "fr" => "french"
            );
            if (realpath(APPPATH . "language/" . $lang_array[$this->lang_code])) {
                $langFiles = scandir(realpath(APPPATH . "language/" . $lang_array[$this->lang_code]));
            }
            if (!$this->session->userdata("lang_files")) {
                $lang_files = array();
                foreach ($langFiles as $lang) {
                    if (endsWith($lang, "_lang.php")) {
                        $this->lang->load(str_replace("_lang.php", "", $lang));
                        $lang_files[] = str_replace("_lang.php", "", $lang);
                    }
                }
                $this->session->set_userdata("lang_files", $lang_files);
            } else {
                $lang_files = $this->session->userdata("lang_files");
                foreach ($lang_files as $lang) {
                    $this->lang->load($lang);
                }
            }
        }

	
    }

    require_once APPPATH . "/core/Admin_Controller.php";
    require_once APPPATH . "/core/C_Controller.php";
