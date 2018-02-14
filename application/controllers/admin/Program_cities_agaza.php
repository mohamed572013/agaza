<?php

    class Program_cities extends C_Controller{

        private $haj_umrah_program_id;

        public function __construct(){
            parent::__construct();
            $this->load->model('Program_cities_model', 'program_cities');
            $this->load->model('Program_data_model', 'program_data');
            $this->load->model('Programs_model', 'programs');
            $this->load->model('Program_categories_model', 'program_categories');
        }

        public function row(){
            // pri($_POST);
            $program_cities_id = $_POST['program_cities_id'];
            $find = $this->program_cities->find($program_cities_id);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_POST);
            $program_id = $_POST['program_id'];
            $new_no_of_nigts = $_POST['nights'];
            $this->nights_check($program_id, $new_no_of_nigts);
            $program = $this->programs->findById($program_id);
            $category = $this->program_categories->find($program->category_id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('country_id', 'البلد', 'required');
            $this->form_validation->set_rules('city_id', 'المدينة', 'required');
            if ($category && $category->hotels_required == 1) {
                $this->form_validation->set_rules('hotel_id', 'الفندق', 'required');
            }

            $this->form_validation->set_rules('nights', 'عدد الليالى', 'required');
            if ($this->form_validation->run() == false) {

                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {

                $data_array['country_id'] = $_POST['country_id'];
                $data_array['places_id'] = $_POST['city_id'];
                $data_array['hotel_id'] = (isset($_POST['hotel_id'])) ? $_POST['hotel_id'] : 0;
                $data_array['nights'] = $_POST['nights'];
                $data_array['programs_id'] = $_POST['program_id'];

                //pri($data_array);
                $add = $this->program_cities->add($data_array);
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
            $program_cities_id = $_POST['program_cities_id'];
            $program_id = $_POST['program_id'];
            $new_no_of_nigts = $_POST['nights'];
            $this->nights_check($program_id, $new_no_of_nigts, $program_cities_id);
            $program = $this->programs->findById($program_id);
            $category = $this->program_categories->find($program->category_id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('country_id', 'البلد', 'required');
            $this->form_validation->set_rules('city_id', 'المدينة', 'required');
            if ($category && $category->hotels_required == 1) {
                $this->form_validation->set_rules('hotel_id', 'الفندق', 'required');
            }
            $this->form_validation->set_rules('nights', 'عدد الليالى', 'required');
            if ($this->form_validation->run() == false) {

                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {

                $data_array['country_id'] = $_POST['country_id'];
                $data_array['places_id'] = $_POST['city_id'];
                $data_array['hotel_id'] = (isset($_POST['hotel_id'])) ? $_POST['hotel_id'] : 0;
                $data_array['nights'] = $_POST['nights'];
                $where_array['id'] = $program_cities_id;
                //pri($data_array);
                $update = $this->program_cities->update($data_array, $where_array);
                if ($update) {
                    print_json('success', _lang('updated_successfully'));
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $program_cities_id = $_POST['program_cities_id'];
            $where_array['id'] = $program_cities_id;
            $delete = $this->program_cities->delete($where_array);
            if ($delete) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data($program_id){

            $this->load->library('datatables');
            $this->datatables
                    ->select("programs_cities.id as programs_cities_id,programs_cities.nights as hotel_nights,"
                            . "places.title_ar as city_title_ar"
                    )
                    ->from("programs_cities")
                    ->join("places", "programs_cities.places_id=places.id")
                    ->where('programs_id', $program_id);

            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Program_data.edit_cities(this);return false;" data-id="' . $data["programs_cities_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="حذف" class="tooltips" onclick="Program_data.delete_cities(this);return false;" data-id="' . $data["programs_cities_id"] . '"><i class="fa fa-2x fa-times text-danger"></i></a>';


                //endif;
                return $back;
            }, 'programs_cities_id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        function getCountryCities(){
            //$cond['branches_id'] = $this->current_user_company->id;
            //pri($_POST);
            $cond['place_id'] = $_POST['country_id'];
            $cond['active'] = 1;
            $str = '<option disabled="disabled" selected>اختر</option>';
            $places = $this->program_data->GetWhere('places', 'id', "ASC", $cond);
            if (count($places) > 0) {
                foreach ($places as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_en . " - " . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function gatCityHotels(){
            $cond['branches_id'] = $this->current_user_company->id;
            $cond['places_id'] = $_POST['city_id'];
            $cond['active'] = 1;
            $str = '<option disabled="disabled" selected>اختر</option>';
            $cities = $this->program_data->GetWhere('maka_madina_hotels', 'id', "ASC", $cond);
            if (count($cities) > 0) {
                foreach ($cities as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function nights_check($program_id, $new_no_of_nigts, $program_cities_id = false){
            $program_id = $program_id;
            $program = $this->programs->findById($program_id); //from haj umrah programs table
            $total_nights = $program->maka_nights;
            $nights_added = $this->program_data->getSumNightsOfProgram($program_id, $program_cities_id); // from haj umrah program cities table
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
