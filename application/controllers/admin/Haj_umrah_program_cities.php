<?php

    class Haj_umrah_program_cities extends C_Controller{

        private $haj_umrah_program_id;

        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Haj_umrah_program_model', 'haj_umrah_program');
            $this->load->model('Haj_umrah_program_cities_model', 'haj_umrah_program_cities');

            if (!empty($this->_settings->site_language)) {
                $this->config->set_item('language', $this->_settings->site_language);
            }
        }

        public function row(){
            // pri($_POST);
            $haj_umrah_program_cities_id = $_POST['haj_umrah_program_cities_id'];
            $find = $this->haj_umrah_program_cities->find($haj_umrah_program_cities_id);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_POST);
            $haj_umrah_program_id = $_POST['haj_umrah_program_id'];
            $new_no_of_nigts = $_POST['nights'];
            $this->nights_check($haj_umrah_program_id, $new_no_of_nigts);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('city_id', 'المدينة', 'required');
            $this->form_validation->set_rules('region_id', 'المنطقة', 'required');
            $this->form_validation->set_rules('hotel_id', 'الفندق', 'required');
            $this->form_validation->set_rules('nights', 'عدد الليالى', 'required');
            if ($this->form_validation->run() == false) {

                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {

                $data_array['city_id'] = $_POST['city_id'];
                $data_array['region_id'] = $_POST['region_id'];
                $data_array['hotel_id'] = $_POST['hotel_id'];
                $data_array['nights'] = $_POST['nights'];
                $data_array['this_order'] = $_POST['this_order'];
                $data_array['haj_umrah_programs_id'] = $_POST['haj_umrah_program_id'];

                //pri($data_array);
                $add = $this->haj_umrah_program_cities->add($data_array);
                if ($add) {
                    print_json('success', _lang('added_successfully'));
                } else {
                    print_json('error', 'error');
                }
            }
        }

        function edit(){
            //pri($_POST);
            //$this->haj_umrah_program_id = $_POST['haj_umrah_program_id'];
            $haj_umrah_program_cities_id = $_POST['haj_umrah_program_cities_id'];
            $haj_umrah_program_id = $_POST['haj_umrah_program_id'];
            $new_no_of_nigts = $_POST['nights'];
            $this->nights_check($haj_umrah_program_id, $new_no_of_nigts, $haj_umrah_program_cities_id);

            $haj_umrah_program_cities_id = $_POST['haj_umrah_program_cities_id'];
            $this->form_validation->set_rules('city_id', 'المدينة', 'required');
            $this->form_validation->set_rules('region_id', 'المنطقة', 'required');
            $this->form_validation->set_rules('hotel_id', 'الفندق', 'required');
            $this->form_validation->set_rules('nights', 'عدد الليالى', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['city_id'] = $_POST['city_id'];
                $data_array['region_id'] = $_POST['region_id'];
                $data_array['hotel_id'] = $_POST['hotel_id'];
                $data_array['nights'] = $_POST['nights'];
                $data_array['this_order'] = $_POST['this_order'];
                $where_array['id'] = $haj_umrah_program_cities_id;
                $update = $this->haj_umrah_program_cities->update($data_array, $where_array);
                if ($update) {
                    print_json('success', _lang('updated_successfully'));
                } else {
                    print_json('error', \_lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $haj_umrah_program_cities_id = $_POST['haj_umrah_program_cities_id'];
            $where_array['id'] = $haj_umrah_program_cities_id;
            $delete = $this->haj_umrah_program_cities->delete($where_array);
            if ($delete) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data($haj_umrah_program_id){
//            $key = '';
//            $value = '';
//            if ($haj_umrah_program_id == 'all') {
//                $key = 'haj_umrah_programs_id !=';
//                $value = 0;
//            } else {
//                $key = 'haj_umrah_programs_id';
//                $value = $haj_umrah_program_id;
//            }
            //pri($this->db->select('*')->from('hotels_rooms')->get()->result());
            $this->load->library('datatables');
            $this->datatables
                    ->select("*"
                    )
                    //->where("user_type","admin")
                    ->from("haj_umrah_program_cities")
                    ->where('haj_umrah_programs_id', $haj_umrah_program_id);
//            $this->datatables->add_column('places_id', function($data) {
//                return $this->places->find($data['places_id'])->title_ar;
//            }, 'places_id');
//            $this->datatables->add_column('chalets_others_id', function($data) {
//                return $this->chalet_other->find($data['chalets_others_id'])->title_ar;
//            }, 'places_id');
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Haj_umrah_program.edit_cities(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="حذف" class="tooltips" onclick="Haj_umrah_program.delete_cities(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-times"></i></a>';


                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        function GetCityRegions(){
            //$cond['branches_id'] = $this->current_user_company->id;
            $cond['place_id'] = $_POST['city_id'];
            $cond['active'] = 1;
            $str = '<option disabled="disabled" selected>اختر</option>';
            $hotels = $this->haj_umrah_program->GetWhere('places', 'id', "ASC", $cond);
            if (count($hotels) > 0) {
                foreach ($hotels as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_en . " - " . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function gatRegionHotels(){
            $cond['branches_id'] = $this->current_user_company->id;
            $cond['region_id'] = $_POST['region_id'];
            $cond['active'] = 1;
            $str = '<option disabled="disabled" selected>اختر</option>';
            $cities = $this->haj_umrah_program->GetWhere('haj_umrah_hotels', 'id', "ASC", $cond);
            if (count($cities) > 0) {
                foreach ($cities as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function nights_check($haj_umrah_program_id, $new_no_of_nigts, $haj_umrah_program_cities_id = false){
            $haj_umrah_program_id = $haj_umrah_program_id;
            $haj_umrah_program = $this->haj_umrah_program->findById($haj_umrah_program_id); //from haj umrah programs table
            $total_nights = $haj_umrah_program->no_of_nights;
            $nights_added = $this->haj_umrah_program->getSumNightsOfProgram($haj_umrah_program_id, $haj_umrah_program_cities_id); // from haj umrah program cities table
            if ($total_nights >= ($nights_added + $new_no_of_nigts)) {

            } else {
                print_json('error', _lang('program_nights_error') . $total_nights);
            }
        }

//        public function nights_check($str){
//            if ($str == 'test') {
//                $this->form_validation->set_message('nights_check', 'The {field} field can not be the word "test"');
//                return FALSE;
//            } else {
//                return TRUE;
//            }
//        }
    }
