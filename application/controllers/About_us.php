<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class About_us extends MY_Controller{
        public function __construct(){

            parent::__construct();
            $this->load->model('About_us_model', 'about_us');
        }

        public function index(){
            $about_us = $this->about_us->getAboutUs($this->whitelabel_id);
            //pri($about_us);
            $this->data['about_us'] = $about_us;
            $main_content = "about_us/index";
            $this->_view($main_content);
        }

    }
