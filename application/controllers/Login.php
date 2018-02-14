<?php

    class Login extends MY_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('Employee_model', 'employee');
            $this->load->model('Guest_model', 'guest');
            $this->is_logged_in();
        }

        function index(){
            //pri($this->Employee);

            $main_content = 'login';
            $this->_view($main_content);
        }

        public function check(){
            //pri($_POST);
            $this->form_validation->set_rules('email', 'البريد الإلكترونى', 'required');
            $this->form_validation->set_rules('password', 'كملة السر', 'required');
            $ajax = (bool) $this->input->post('ajax');

            if ($this->form_validation->run() == true) {

                $remember = (bool) $this->input->post('remember');
                $whitelabel_id = $this->whitelabel_id;
                if ($this->employee->employeeLogIn($_POST['email'], $_POST['password'], $whitelabel_id, $remember)) {

                    if ($ajax) {
                        print_json("success", base_url('employee'));
                    }
                } else {
                    if ($this->guest->employeeLogIn($_POST['email'], $_POST['password'], $remember)) {
                        print_json("success", base_url('guest'));
                    } else {
                        if ($ajax)
                            print_json("error", 'هناك خطأ فى اسم المستخدم أو كلمة السر');
                    }
                }
            }
            else {
                print_json("error", $this->form_validation->error_array());
            }
        }

        public function is_logged_in(){
            if ($this->isEmployee) {
                redirect(base_url());
            }
        }

    }
