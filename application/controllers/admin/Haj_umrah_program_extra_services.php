<?php

    class Haj_umrah_program_extra_services extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Haj_umrah_program_model', 'haj_umrah_program');
            $this->load->model('Haj_umrah_program_extra_services_model', 'haj_umrah_program_extra_services');

            if (!empty($this->_settings->site_language)) {
                $this->config->set_item('language', $this->_settings->site_language);
            }
        }

        public function row(){
            //pri($_POST);
            $haj_umrah_program_extra_services_id = $_POST['haj_umrah_program_extra_services_id'];
            $find = $this->haj_umrah_program_extra_services->find($haj_umrah_program_extra_services_id);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            /* check if there is the same data in the table */
            //pri($_POST);
            $where_array['extra_services_id'] = $_POST['extra_services_id'];
            $where_array['haj_umrah_programs_id'] = $_POST['haj_umrah_program_id'];
            $check = $this->haj_umrah_program_extra_services->findWhere($where_array);
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
                $data_array['extra_services_id'] = $_POST['extra_services_id'];
                $data_array['price'] = $_POST['price'];
                $data_array['haj_umrah_programs_id'] = $_POST['haj_umrah_program_id'];

                //pri($data_array);
                $add = $this->haj_umrah_program_extra_services->add($data_array);
                //pri($add);
                if ($add) {
                    print_json('success', _lang('added_successfully'));
                } else {
                    print_json('error', 'error');
                }
            }
        }

        function edit(){
            //pri($_POST);
            $haj_umrah_program_extra_services_id = $_POST['haj_umrah_program_extra_services_id'];
            /* check if there is the same data in the table */
            $find = $this->haj_umrah_program_extra_services->find($haj_umrah_program_extra_services_id);
            $check_where_array['haj_umrah_programs_id'] = $_POST['haj_umrah_program_id'];
            $check_where_array['extra_services_id !='] = $find->extra_services_id;
            $check_where_array['extra_services_id'] = $_POST['extra_services_id'];
            $check = $this->haj_umrah_program_extra_services->findWhere($check_where_array);
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
                $data_array['extra_services_id'] = $_POST['extra_services_id'];
                $data_array['price'] = $_POST['price'];
                $where_array['id'] = $haj_umrah_program_extra_services_id;
                //pri($where_array);
                $update = $this->haj_umrah_program_extra_services->update($data_array, $where_array);
                if ($update) {
                    print_json('success', _lang('updated_successfully'));
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $haj_umrah_program_extra_services_id = $_POST['haj_umrah_program_extra_services_id'];
            $where_array['id'] = $haj_umrah_program_extra_services_id;
            $delete = $this->haj_umrah_program_extra_services->delete($where_array);
            if ($delete) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data($haj_umrah_programs_id){
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
                    ->select("extra_services.title_ar as extra_service_title_ar,extra_services.person_or_card as person_or_card,"
                            . "haj_umrah_program_extra_services.id as haj_umrah_program_extra_services_id,haj_umrah_program_extra_services.price as price"
                    )
                    //->where("user_type","admin")
                    ->from("haj_umrah_program_extra_services")
                    ->join("extra_services", "extra_services.id=haj_umrah_program_extra_services.extra_services_id")
                    ->where('extra_services.branches_id', $this->current_user_company->id)
                    ->where('haj_umrah_program_extra_services.haj_umrah_programs_id', $haj_umrah_programs_id);
//            $this->datatables->add_column('places_id', function($data) {
//                return $this->places->find($data['places_id'])->title_ar;
//            }, 'places_id');
//            $this->datatables->add_column('chalets_others_id', function($data) {
//                return $this->chalet_other->find($data['chalets_others_id'])->title_ar;
//            }, 'places_id');
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Haj_umrah_program.edit_extra_services(this);return false;" data-id="' . $data["haj_umrah_program_extra_services_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="حذف" class="tooltips" onclick="Haj_umrah_program.delete_extra_services(this);return false;" data-id="' . $data["haj_umrah_program_extra_services_id"] . '"><i class="fa fa-2x fa-times"></i></a>';


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
