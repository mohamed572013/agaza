<?php

    class Agaza_reserve extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('About_us_model', 'about_us');
        }

        public function index(){
            $getAgaza = $this->about_us->getAgaza($this->current_user_company->id);
            $this->data['getAgaza'] = $getAgaza;
           //   pri($getAgaza);
            $main_content = 'agaza/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $getAgaza = $this->about_us->getAgaza($this->current_user_company->id);
            $this->data['getAgaza'] = $getAgaza;

            $main_content = 'agaza/index';
            $this->_view($main_content, 'admin');
        }

        function add(){
            
            //pri($array_data);
            $data_array['fname'] = $_POST['fname'];
            $data_array['lname'] = $_POST['lname'];
            $data_array['email'] = $_POST['email'];
            $data_array['phone'] = $_POST['phone'];
            $data_array['message'] = $_POST['message'];
            $data_array['created'] = date("Y-m-d h:i:s a");
            $data_array['program_id'] = $_POST['program_id'];
            
            //pri($where_array);
            $add = $this->about_us->addAgaza($data_array);
            
        }

    }
