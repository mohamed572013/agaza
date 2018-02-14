<?php
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    /**
     * Description of ajax
     *
     * @author Abd Elfttah Ahmed <thisphp.com@gmail.com>
     */
    class Ajax extends MY_Controller{

        public $_upload_config = array();

        public function __construct(){
            parent::__construct();
            $this->load->model('Ajax_model', 'ajax_model');
            $this->load->model('Front_hotels_model', 'hotels');
            $this->load->model('Home_model', 'home');
        }

        public function upload($dir = ''){
            if (!empty($dir)) {
                $dir = \trim($dir);
            }

            $array_return = array(
                'success' => 'false',
                'data' => 'error'
            );

            $this->_upload_config['upload_path'] = 'uploads/' . $dir;
            $this->_upload_config['allowed_types'] = 'gif|jpg|png';
            $this->_upload_config['max_size'] = 10240;

            $this->load->library('upload', $this->_upload_config);

            $return_files = array();
            $file_upload = $_FILES['file_upload'];
            unset($_FILES['file_upload']);
            foreach ($file_upload['name'] as $key => $value) {
                $_FILES['file_upload'] = array(
                    'name' => $value,
                    'type' => $file_upload['type'][$key],
                    'tmp_name' => $file_upload['tmp_name'][$key],
                    'error' => $file_upload['error'][$key],
                    'size' => $file_upload['size'][$key],
                );
                if (!$this->upload->do_upload('file_upload')) {
                    $array_return['data'] = $this->upload->display_errors();
                } else {
                    $return_files[] = $this->upload->data();
                }
            }
            if (\count($return_files) > 0) {
                $files_data = array();
                foreach ($return_files as $key => $value) {
                    $files_data[] = \trim($this->_upload_config['upload_path'], '/') . '/' . $value['file_name'];
                }
                $array_return = array(
                    'success' => 'true',
                    'data' => $files_data
                );
            }
            echo \json_encode($array_return);
            die();
        }

        function gatCountryCities(){
            $cond['place_id'] = $_POST['country_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $cities = $this->ajax_model->GetWhere('places', 'id', "ASC", $cond);
            if (count($cities) > 0) {
                $str = "";
                foreach ($cities as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_en . " - " . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function gatCompanyBranches(){
            //show all companies and all branches of current user company
            if ($this->_current_user->user_type == 'super admin') {
                $cond_branches['parent_id'] = $this->current_user_company->id;
                $cond_departments['branches_id'] = $this->current_user_company->id;
            }

            //admin can't see companie or branches
            if ($this->_current_user->user_type == 'admin') {

            }
            $cond['company'] = $_POST['company'];
            $cond['is_deleted'] = 0;
            $cond['active'] = 1;
            $str = "";
            $str .= '<option value="">' . $this->_lang['choose_branches'] . '</option>';

            $branches = $this->ajax_model->GetWhere('branches', 'id', "ASC", $cond);
            if (count($branches) > 0) {
                foreach ($branches as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_ar . " - " . $p->title_en . '</option>';
                }
            }

            echo $str;
        }

        function gatBranchesDepartments(){
            $cond['branches_id'] = $_POST['branches_id'];
            $cond['is_deleted'] = 0;
            $cond['active'] = 1;
            $str = "";
            $str .= '<option value="">' . _lang('choose_departments') . '</option>';
            $departments = $this->ajax_model->GetWhere('departments', 'id', "ASC", $cond);
            if (count($departments) > 0) {
                foreach ($departments as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_ar . " - " . $p->title_en . '</option>';
                }
            }

            echo $str;
        }

        function gatDepartmentsEmployees(){
            $cond['departments_id'] = $_POST['departments_id'];
            $cond['is_deleted'] = 0;
            $str = "";
            $str .= '<option value="">' . $this->_lang['choose_employee'] . '</option>';
            $employees = $this->ajax_model->GetWhere('employees', 'id', "ASC", $cond);
            if (count($employees) > 0) {
                foreach ($employees as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_ar . " - " . $p->title_en . '</option>';
                }
            }

            echo $str;
        }

        function get_number_charcter(){
            $this->load->library('ArNumbers');

            $amount_char = "";
            $x = new ArNumbers();
            $x->setFeminine(1);
            $x->setFormat(1);
            $amount_num = $_POST['amount_num'];
            $amount_arr = explode(".", $amount_num);
            if (count($amount_arr) > 1) {
                $amount_char1 = $x->int2str($amount_arr[0]);
                $amount_char2 = $x->int2str($amount_arr[1]);
                $amount_char = $amount_char1 . " - " . $amount_char2;
            } else
                $amount_char = $x->int2str($amount_num);

            echo $amount_char;
        }

//        public function moreHotels(){
//            pri($_POST);
//            //pri($new_limit);
//            $offset = $_POST['current_length'];
//            $city_id = $_POST['city'];
//            $hotels = $this->hotels->getHotelsForFilter(0, $offset, $filter_array, $city_id, $new_limit);
//            //pri($this->db->last_query());
//            $new_hotels = array();
//            if (!empty($hotels)) {
//                foreach ($hotels as $hotel) {
//                    $hotels_advantage_ids = $hotel->hotels_advantage_ids;
//                    $hotels_advantage_ids_array = explode(',', $hotels_advantage_ids);
//                    $hotels_advantages = $this->hotels->getHotelsAdvantages($hotels_advantage_ids_array);
//                    $hotels_advantages = ($hotels_advantages) ? $hotels_advantages : array();
//                    $hotel->advantages = $hotels_advantages;
//                    $country_city = $this->hotels->getHotelCountryAndCity($hotel->places_id);
//                    $hotel->country = $country_city->country_title;
//                    $hotel->city = $country_city->city_title;
//                    $new_hotels[] = $hotel;
//                }
//            }
//            if (count($new_hotels) > 0) {
//                $this->data['hotels'] = $new_hotels;
//                $this->data['all_hotels_count'] = $this->hotels->getHotelsForFilterCount(0, $filter_array, $city_id);
//                $hotels_view = $this->load->view('main_content/ajax/hotels_filter', $this->data, true);
//            } else {
//                $hotels_view = '';
//            }
//
//            echo $hotels_view;
//        }
        public function moreHotels(){
            //pri($_POST);
            //pri($new_limit);
            $offset = $_POST['current_length'];
            $city_id = $_POST['city'];
            $hotels = $this->hotels->getHotelsForFilter(0, $offset, $filter_array = array(), $city_id, false);
            //pri($this->db->last_query());
            $new_hotels = array();
            if (!empty($hotels)) {
                foreach ($hotels as $hotel) {
                    $hotels_advantage_ids = $hotel->hotels_advantage_ids;
                    $hotels_advantage_ids_array = explode(',', $hotels_advantage_ids);
                    $hotels_advantages = $this->hotels->getHotelsAdvantages($hotels_advantage_ids_array);
                    $hotels_advantages = ($hotels_advantages) ? $hotels_advantages : array();
                    $hotel->advantages = $hotels_advantages;
                    $country_city = $this->hotels->getHotelCountryAndCity($hotel->places_id);
                    $hotel->country = $country_city->country_title;
                    $hotel->city = $country_city->city_title;
                    $hotel->country_id = $country_city->country_id;
                    $hotel->city_id = $country_city->city_id;
                    $new_hotels[] = $hotel;
                }
            }
            if (count($new_hotels) > 0) {
                $this->data['hotels'] = $new_hotels;
                $hotels_view = $this->load->view('main_content/ajax/destinations_hotels_more', $this->data, true);
            } else {
                $hotels_view = '';
            }

            echo $hotels_view;
        }

        public function moreShrines(){  //for destinations page
            //pri($_POST);
            //pri($new_limit);
            $offset = $_POST['current_length'];
            $city_id = $_POST['city'];
            $shrines = $this->destinations->getShrinesInCity($city_id, $offset);
            if (count($shrines) > 0) {
                $this->data['shrines'] = $shrines;
                $hotels_view = $this->load->view('main_content/ajax/destinations_shrines_more', $this->data, true);
            } else {
                $hotels_view = '';
            }

            echo $hotels_view;
        }

        public function morePrograms(){ //for destinations page
            $offset = $_POST['current_length'];
            $city_id = $_POST['city'];
            $where_array['places.id'] = $city_id;
            $programs = $this->destinations->getPrograms($offset, $where_array);
            //pri($this->db->last_query());
            if (count($programs) > 0) {
                $this->data['programs'] = $programs;
                $ajax_content = $this->load->view('main_content/ajax/destinations_programs_more', $this->data, true);
            } else {
                $ajax_content = '';
            }

            echo $ajax_content;
        }

        public function getCitiesInOutEgypt(){ //for ajax
            //pri($_POST);
            $in_out_egypt = $_POST['in_out_egypt'];
            $cities = $this->home->getAllCities($in_out_egypt);
            $new_cities = array();
            if (!empty($cities)) {
                foreach ($cities as $city) {
                    $city->country_name = $this->home->getCountryById($city->place_id);
                    $new_cities[] = $city;
                }
            }
            //pri($new_cities);
            //$this->data['country_name'] = 'sss';

            if (count($new_cities) > 0) {
                $this->data['cities'] = $new_cities;
                $ajax_content = $this->load->view('main_content/ajax/cities', $this->data, true);
            } else {
                $ajax_content = '';
            }

            echo $ajax_content;
        }

    }
