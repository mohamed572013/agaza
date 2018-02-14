<?php

    class Register extends MY_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('Guest_model', 'guest');
            $this->is_logged_in();
        }

        function index(){
            //pri($this->Employee);

            $main_content = 'register';
            $this->_view($main_content);
        }

        public function add(){
            //pri($_POST);
            $this->form_validation->set_rules('fullname', 'الإسم بالكامل', 'required');
            $this->form_validation->set_rules('email', 'البريد الإلكترونى', 'required');
            $this->form_validation->set_rules('email_confirmation', 'تأكيد البريد الإلكترونى', 'required');
            $this->form_validation->set_rules('password', 'كملة السر', 'required');
            $this->form_validation->set_rules('password_confirmation', 'تأكيد كلمة السر', 'required');
            $ajax = (bool) $this->input->post('ajax');

            if ($this->form_validation->run() == true) {
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $password = $this->guest->password_hashing($_POST['password']);
                $array_data['fullname'] = $fullname;
                $array_data['email'] = $email;
                $array_data['password'] = $password;
                $array_data['last_login'] = date('y-m-d');
                $array_data['branches_id'] = $this->whitelabel_id; //علشان اعرف هوا الجيست سجل من على اجازة بوك ولا من على وايت ليبل وأنهى وايت ليبل
                if ($this->guest->create_guest($array_data)) {
                    if ($ajax) {
                        print_json("success", base_url());
                    }
                }
            } else {
                print_json("error", $this->form_validation->error_array());
            }
        }

        public function is_logged_in(){
            if ($this->isEmployee) {
                redirect(base_url());
            }
        }

    }
