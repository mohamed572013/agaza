<?php

    class Employee_model extends CI_Model{

        var $SALT_ONE = "mv-is.com";
        var $SALT_TWO = "AHMEDMOHSEN";
        var $ENCRYPT_KEY = "IM-DEVELOPER.COM";
        var $session_id = false;
        var $session_data = false;
        var $is_logged = false;

        /* table info */
        var $table = "employees";
        var $idCol = "id";
        var $usernameCol = "username";
        var $emailCol = "email";
        var $passwordCol = "password";

        function __construct(){
            parent::__construct();
            $this->load->database();
            $this->load->helper('cookie');
            $this->load->library('session');
            //$this->load->library('encrypt');

            $this->startSession();
        }

        /**
         * initialize image preferences
         *
         * @access	public
         * @param	array
         * @return	bool
         */
        function initialize($props = array()){
            /*
             * Convert array elements into class variables
             */
            if (count($props) > 0) {
                foreach ($props as $key => $val) {
                    $this->$key = $val;
                }
            }
        }

        //return  $this->is_logged vlaue (true or false)
        private function startSession(){
            $this->is_logged = $this->loginCheck();
        }

        public function logged_in(){
            return $this->is_logged;
        }

        //check id if he is a user or not and if he is  a user set cookies
        public function employeeLogIn($email, $Password, $Remember = false, $branches_id){
            if ($this->isEmployee($email, $Password, $branches_id)) {
                if ($this->setUserCookie($email, $Password, $Remember, $branches_id)) {

                    return true;
                }
            }
            return false;
        }

        function get_current_info(){

            if ($this->session_data) {
                $info = $this->session_data;
                $user_base64_d = base64_decode($info);
                return json_decode($user_base64_d);
            }
        }

        private function isEmployee($email, $password, $branches_id){
            if ($employee = $this->getUserInfo(false, $email, $branches_id)) {
                if ($this->validate_password($employee->password, $password))
                    return true;
            }
            return false;
        }

        private function loginCheck(){

            if ($this->session->userdata('AGAZA_EMPLOYEE_SESSION_DATA')) {
                if (!$this->confirmCookie($this->session->userdata('AGAZA_EMPLOYEE_SESSION_DATA'))) {
                    $this->session->unset_userdata("AGAZA_EMPLOYEE_SESSION_DATA");

                    if (get_cookie('AGAZA_EMPLOYEE_SESSION_DATA') !== NULL) {
                        delete_cookie("AGAZA_EMPLOYEE_SESSION_DATA");
                    }

                    $this->session_data = null;
                    return false;
                }

                $this->session_data = $this->session->userdata('AGAZA_EMPLOYEE_SESSION_DATA');
                return true;
            }

            return false;
        }

        private function confirmCookie($session_data){
            $user_base64_d = base64_decode($session_data);
            $user_info = json_decode($user_base64_d);
            if (
                            $this->db
                            ->select("COUNT(*) AS Count")
                            ->from($this->table)
                            ->where($this->emailCol, $user_info->email)
                            ->get()->row()->Count
            ) {
                return true;
            } else {
                return false;
            }
        }

        private function setUserCookie($email, $Password, $Remember = false, $branches_id, $long = '3600', $type = 'second'){
            switch ($type) {
                case 'millisecond': $long = $long / 1000;
                    break;
                case 'minute': $long = $long * 60;
                    break;
                case 'hour': $long = $long * 3600;
                    break;
                case 'day': $long = $long * 3600 * 24;
                    break;
                case 'week': $long = $long * 3600 * 24 * 7;
                    break;
                case 'month': $long = $long * 3600 * 24 * 29.53;
                    break;
                case 'year': $long = $long * 3600 * 24 * 365.2425;
                    break;
                case 'second':
                default: $long = $long;
                    break;
            }
            $userInfo = $this->getUserInfo(false, $email, $branches_id);
            $session_info = array(
                'id' => $userInfo->{$this->idCol},
                'email' => $userInfo->{$this->emailCol},
            );

            $time = time();
            $secret = $this->SALT_ONE . $this->SALT_TWO; // Secret key, that you've entered on the website's admin panel.
            $user_base64 = base64_encode(json_encode($session_info));
            $this->session->set_userdata("AGAZA_EMPLOYEE_SESSION_DATA", $user_base64);
            $this->session_data = $user_base64;
            $this->is_logged = true;

            $timeNow = date('y-m-d');

            $this->db->where($this->idCol, $userInfo->{$this->idCol});
            $this->db->set("last_login", $timeNow);
            $this->db->update($this->table);

            if ($Remember) {
                set_cookie("AGAZA_EMPLOYEE_SESSION_DATA", $user_base64, time() + $long);
            }

            return true;
        }

        private function validate_password($employee_password, $password){
            $password = $this->password_hashing($password);
            if ($employee_password == $password) {
                return true;
            }
            return false;
        }

        private function password_hashing($password){
            return md5($password);
        }

        function getUserInfo($user_id = FALSE, $email = FALSE, $branches_id){
            if ($user_id) {
                $user = $this->db->from("employees")->where($this->idCol, $user_id)->where('branches_id', $branches_id)->get()->row();
                return $user;
            } else {
                $user = $this->db->from("employees")->where($this->emailCol, $email)->where('branches_id', $branches_id)->get()->row();
                return $user;
            }
        }

        function current_user($branches_id){
            if ($this->logged_in()) {
                if ($user_info = $this->get_current_info()) {
                    $user = $this->getUserInfo($user_info->id, false, $branches_id);
                    //pri($user);
                    return $user;
                }
            }
            return false;
        }

        public static function logout(){
            $CI = & get_instance();
            $CI->session->sess_destroy();
        }

        public function Employee_company_parent_id($employee_company_id){
            $this->db->select('parent_id');
            $this->db->from('branches');
            $this->db->where("id", $employee_company_id);
            $this->db->where("active", 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->parent_id;
            } else {
                echo '';
            }
        }

        public function getCompany($company_id){
            $this->db->select('*');
            $this->db->from('branches');
            $this->db->where('active', 1);
            $this->db->where('is_deleted', 0);
            $this->db->where('id', $company_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

    }
