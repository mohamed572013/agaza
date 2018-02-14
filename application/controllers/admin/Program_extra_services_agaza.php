<?php

    class Program_extra_services extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Programs_model', 'programs');
            $this->load->model('Program_extra_services_model', 'program_extra_services');
        }

        public function row(){
            //pri($_POST);
            $programs_extra_service_id = $_POST['programs_extra_service_id'];
            $find = $this->program_extra_services->find($programs_extra_service_id);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            /* check if there is the same data in the table */
            $where_array['extra_service_id'] = $_POST['extra_services_id'];
            $where_array['programs_id'] = $_POST['program_id'];
            $check = $this->program_extra_services->findWhere($where_array);
            if ($check) {
                print_json('error', _lang('added_before'));
            }
            /* end */
            $this->load->library('form_validation');
            $this->form_validation->set_rules('extra_services_id', 'الخدمة', 'required');
            $this->form_validation->set_rules('price', 'السعر', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['extra_service_id'] = $_POST['extra_services_id'];
                $data_array['price'] = $_POST['price'];
                $data_array['programs_id'] = $_POST['program_id'];
                //pri($data_array);
                $add = $this->program_extra_services->add($data_array);
                //pri($add);
                if ($add) {
                    print_json('success', _lang('added_successfully'));
                } else {
                    print_json('error', 'error');
                }
            }
        }

        function edit(){

            /* check if there is the same data in the table */
            $programs_extra_service_id = $_POST['programs_extra_service_id'];
            $find = $this->program_extra_services->find($programs_extra_service_id);
            $check_where_array['extra_service_id !='] = $find->extra_service_id;
            $check_where_array['extra_service_id'] = $_POST['extra_services_id'];
            $check_where_array['programs_id'] = $_POST['program_id'];
            $check = $this->program_extra_services->findWhere($check_where_array);
            if ($check) {
                print_json('error', _lang('added_before'));
            }
            /* end */

            //pri('sss');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('extra_services_id', 'الخدمة', 'required');
            $this->form_validation->set_rules('price', 'السعر', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['extra_service_id'] = $_POST['extra_services_id'];
                $data_array['price'] = $_POST['price'];
                $where_array['id'] = $programs_extra_service_id;
                //pri($where_array);
                $update = $this->program_extra_services->update($data_array, $where_array);
                if ($update) {
                    print_json('success', _lang('updated_successfully'));
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $programs_extra_service_id = $_POST['programs_extra_service_id'];
            $where_array['id'] = $programs_extra_service_id;
            $delete = $this->program_extra_services->delete($where_array);
            if ($delete) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data($program_id){
            $this->load->library('datatables');
            $this->datatables
                    ->select("extra_services.title_ar as extra_service_title_ar,extra_services.person_or_card as person_or_card,"
                            . "programs_extra_service.id as programs_extra_services_id,programs_extra_service.price as price"
                    )
                    //->where("user_type","admin")
                    ->from("programs_extra_service")
                    ->join("extra_services", "extra_services.id=programs_extra_service.extra_service_id")
                    ->where('extra_services.branches_id', $this->current_user_company->id)
                    ->where('programs_extra_service.programs_id', $program_id);
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Program_data.edit_extra_services(this);return false;" data-id="' . $data["programs_extra_services_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="حذف" class="tooltips" onclick="Program_data.delete_extra_services(this);return false;" data-id="' . $data["programs_extra_services_id"] . '"><i class="fa fa-2x fa-times text-danger"></i></a>';


                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        function GetCItyHotel(){
            //$cond['branches_id'] = $this->current_user_company->id;
            $cond['branches_id'] = 14;
            $cond['places_id'] = $_POST['places_id'];
            $cond['active'] = 1;
            $str = '<option disabled="disabled" selected>اختر</option>';
            $hotels = $this->haj_umrah_program->GetWhere('maka_madina_hotels', 'id', "ASC", $cond);
            if (count($hotels) > 0) {
                foreach ($hotels as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_en . " - " . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function gatCountryCities(){
            $cond['place_id'] = $_POST['country_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $str = '<option disabled="disabled" selected>اختر</option>';
            $cities = $this->haj_umrah_program->GetWhere('places', 'id', "ASC", $cond);
            if (count($cities) > 0) {
                foreach ($cities as $p) {
                    $str .= '<option value=' . $p->id . '>' . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        public function availableRooms(){
            //pri($_POST);
            $haj_umrah_program_flights_id = $_POST['haj_umrah_program_flights_id'];
            $rooms = $this->haj_umrah_program->availableRooms($this->current_user_company->id, $haj_umrah_program_flights_id);
            //pri($rooms);
            if ($rooms) {
                print_json('success', $rooms);
            } else {
                print_json('error', 'error');
            }
        }

    }
