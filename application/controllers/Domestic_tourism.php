<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Domestic_tourism extends MY_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Home_model', 'home');
            $this->load->model('Front_programs_model', 'programs');
            $this->load->model('Employee_model');
        }

        public function index(){
            //pri($this->Guest);
            if ($this->whitelabel_id > 0) {
                $where_array['programs.branches_id'] = $this->whitelabel_id;
            } else {
                $where_array = array();
            }
            $hotels = $this->home->getAllHotels(0);
            $cities = $this->home->getAllCities();
            $slider_programs = $this->programs->getSliderPrograms($where_array);
            //pri($slider_programs);
            $special_offers = $this->programs->get_offers_reserved_viewed_Programs('special_offer', $where_array);
            $last_added = $this->programs->get_offers_reserved_viewed_Programs('last_added', $where_array);
            //pri($special_offers);

            $most_viewed = $this->programs->get_offers_reserved_viewed_Programs('most_viewed', $where_array);
            //pri($most_viewed);
            $most_reserved = $this->programs->get_offers_reserved_viewed_Programs('most_reserved', $where_array);
            if (count($special_offers) < 0) {
                $special_offers = false;
                $special_offers_count = 0;
            }
            if (count($most_viewed) < 0) {
                $most_viewed = false;
            }
            if (count($most_reserved) < 0) {
                $most_reserved = false;
            }
            if (count($last_added) < 0) {
                $last_added = false;
            }
            $this->data['special_offers'] = $special_offers;
            $this->data['special_offers_count'] = count($special_offers);
            $this->data['most_viewed'] = $most_viewed;
            $this->data['most_reserved'] = $most_reserved;
            $this->data['last_added'] = $last_added;
            $this->data['slider_programs'] = $slider_programs;
            $this->data['cities'] = $cities;
            $this->data['hotels'] = $hotels;
            //pri($this->data['last_added']);
            $main_content = 'index';
            $this->_view($main_content);
        }

        function subscribe(){

            $cond['email'] = strip_tags($_POST['email']);
            $test = $this->home->GetWhere("subscribe", "id", "DESC", $cond);

            if (count($test) > 0) {
                echo "<div class='alert alert-success' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" . $this->lang->line("data_exist") . '</div>';
            } else {
                $s_data = $this->home->addwithTable("subscribe", $cond);
                if ($s_data) {
                    echo "<div class='alert alert-success' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> تم التسجيل بنجاح</div>";
                } else {
                    echo "<div class='alert alert-danger' ><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>فشل فى عملية التسجيل </div>";
                }
            }
        }

        function ReservationLogin(){

            $cond['user_name'] = strip_tags($_POST['username']);
            $cond['user_password'] = \md5(strip_tags($_POST['password']));
            $cond['admin_or_reservarion'] = 1;
            $users = $this->home->GetWhere("users", "user_id", "DESC", $cond);

            if (count($users) > 0 && $users[0]->user_id > 0) {
                $user_id = $users[0]->user_id;
                $get_user_data = $this->get_user_data($user_id);
                $session_user_data = array(
                    'reservarion_user_id' => $users[0]->user_id,
                    'reservarion_user_group_id' => $users[0]->user_group_id,
                    'reservarion_user_name' => $users[0]->user_name,
                    'reservarion_user_password' => $users[0]->user_password,
                    'reservarion_user_code' => $get_user_data->employees_code,
                    'reservarion_user_branch_code' => $get_user_data->branch_code,
                    'reservarion_user_branches_image' => $get_user_data->branches_image,
                    'reservarion_user_branches_name' => $get_user_data->branches_name,
                );
                $this->session->set_userdata($session_user_data, '', '7200');



                //\print_r($this->session->userdata("reservarion_user_id"));
                echo '1';
            } else {
                echo '0';
            }
        }

        function ReservationLogout(){

            $session_user_data = array(
                'reservarion_user_id' => "",
                'reservarion_user_group_id' => "",
                'reservarion_user_name' => "",
                'reservarion_user_password' => "",
                'reservarion_user_code' => "",
                'reservarion_user_branch_code' => "",
                'reservarion_user_branches_image' => "",
                'reservarion_user_branches_name' => "",
            );
            $this->session->set_userdata($session_user_data);
            $this->session->unset_userdata($session_user_data);
        }

        public function contact_form_send(){

            $form_data["admin"] = $this->data['site_email'];
            $form_data['name'] = strip_tags($_POST['name']);
            $form_data['email'] = strip_tags($_POST['email']);
            $form_data['subject'] = strip_tags($_POST['subject']);
            $form_data['message'] = strip_tags($_POST['message']);

//        echo $this->mahmoud_share->send_contact_mail_info($form_data);
//        exit();
            if ($this->send_contact_mail_info($form_data)) {
                //echo "yes";
                echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> تم الارسال بنجاح</div>';
            } else {
                //echo "no";
                echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> فشل فى عملية  الارسال من فضلك حوال مره اخرى  </div>';
            }
        }

        function send_contact_mail_info($param){
            $this->load->library('email');

            $from = $param["email"];
            $this->email->from($from, $param["name"]);

            $to = $param["admin"];
            $subject = "Message from Omera Partners website  ";
            $this->email->to($to);
            $this->email->subject($subject);
            $message = "";
            foreach ($param as $key => $value) {
                if ($key != "admin") {
                    $key = str_replace('_', ' ', $key);
                    $message.=" " . $key . " : " . $value . ". <br/> ";
                }
            }
//        return $message;exit();
            $this->email->message($message);

//If the email is sent
            if ($this->email->send()) {
// echo $this->email->print_debugger();
                return true;
            } else { //echo $this->email->print_debugger();
                return false;
            }
        }

        public function checkLoginForAjax(){
            //pri($_POST);
            if ($this->isEmployee) {//because of he is employee ,the whitelabel_id in my controller should be greater than 0
                $data['visitor_type'] = 'employee';

                $company_id = $this->whitelabel_id;
                if ($company_id == 0) {

                    $data['company_url'] = 'http://localhost/new_agaza/';
                } else {
                    $company = $this->Employee_model->getCompany($company_id);
                    $data['company_url'] = $company->site_url;
                }

                print_json('success', $data);
            } else if ($this->isGuest) {
                $data['visitor_type'] = 'guest';
                if ($this->whitelabel_id > 0) {
                    $company_id = $this->whitelabel_id;
                    $company = $this->Employee_model->getCompany($company_id);
                    $data['company_url'] = $company->site_url;
                } else {//that is meaning that site is agazabook
                    $program_id = $_POST['program_id'];
                    $program = $this->programs->get_program($program_id);
                    $program_company_id = $program->program_branches_id;
                    $company = $this->Employee_model->getCompany($program_company_id);
                    $data['company_url'] = $company->site_url;
                }
                print_json('success', $data);
            } else {
                print_json('error', 'لابد من تسجيل الدخول أولا');
            }
        }

    }
