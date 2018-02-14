<?php

    class Contact_us extends MY_Controller{
        public function __construct(){

            parent::__construct();
            $this->load->model('Contact_us_model', 'contact_us');
        }

        public function index(){
            $main_content = "contact_us/index";
            $this->_view($main_content);
        }

        public function send(){
            //pri($_POST);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('firstname', 'الأسم الأول', 'required');
            $this->form_validation->set_rules('lastname', 'الأسم الأخير', 'required');
            $this->form_validation->set_rules('email', 'البريد الإلكترونى', 'required');
            $this->form_validation->set_rules('mobile', 'رقم الموبايل', 'required');
            $this->form_validation->set_rules('message', 'الرسالة', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $mobile = $_POST['mobile'];
                $msg = $_POST['message'];
                $subject = 'from agazabook';
                $message = '<h3>from:' . $firstname . ' ' . $lastname . '</h3>';
                $message .= '<p>message:' . $msg . '</p>';
                $send = $this->sendEmail(array(
                    'from' => 'etravelgate2112@gmail.com',
                    'to' => 'info@agazabook.com',
                    'subject' => $subject,
                    'message' => $message,
                    'reply_to' => $email,
                    'name' => $firstname . ' ' . $lastname,
                ));
                // echo $this->email->print_debugger();
                if ($send) {
                    print_json('success', 'sending_email_successfully');
                } else {
                    print_json('error', 'sending_email_error');
                }
            }
        }

        public function sendEmail($email_data = array()){
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => '465',
                'smtp_user' => 'etravelgate2112@gmail.com',
                'smtp_pass' => 'mvis2007',
                'mailtype' => 'html',
                'charset' => 'utf-8'
            );
            $this->load->library('email');
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from($email_data['from']);
            $this->email->reply_to($email_data['reply_to'], $email_data['name']);
            $this->email->to($email_data['to']);  // replace it with receiver mail id
            $this->email->subject($email_data['subject']); // replace it with relevant subject
            $this->email->message($email_data['message']);
            $send = $this->email->send();
            // echo $this->email->print_debugger();
            if ($send) {
                return true;
            } else {
                return false;
            }
        }

    }
