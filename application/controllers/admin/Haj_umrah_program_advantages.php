<?php

    class Haj_umrah_program_advantages extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Haj_umrah_program_model', 'haj_umrah_program');
            $this->load->model('Haj_umrah_program_advantages_model', 'haj_umrah_program_advantages');

            if (!empty($this->_settings->site_language)) {
                $this->config->set_item('language', $this->_settings->site_language);
            }
        }

        public function row(){
            //pri($_POST);
            $haj_umrah_program_advantages_id = $_POST['haj_umrah_program_advantages_id'];
            $find = $this->haj_umrah_program_advantages->find($haj_umrah_program_advantages_id);
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
            $where_array['programs_advantage_id'] = $_POST['programs_advantage_id'];
            $where_array['haj_umrah_programs_id'] = $_POST['haj_umrah_program_id'];
            $check = $this->haj_umrah_program_advantages->findWhere($where_array);
            if ($check) {
                print_json('error', _lang('added_before'));
            }
            /* end */
            //pri('sss');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('programs_advantage_id', 'ميزة', 'required');
            $this->form_validation->set_rules('advantage_price', 'السعر', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['programs_advantage_id'] = $_POST['programs_advantage_id'];
                $data_array['price'] = $_POST['advantage_price'];
                $data_array['haj_umrah_programs_id'] = $_POST['haj_umrah_program_id'];

                //pri($data_array);
                $add = $this->haj_umrah_program_advantages->add($data_array);
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
            $haj_umrah_program_advantages_id = $_POST['haj_umrah_program_advantages_id'];
            /* check if there is the same data in the table */
            $find = $this->haj_umrah_program_advantages->find($haj_umrah_program_advantages_id);
            $check_where_array['haj_umrah_programs_id'] = $_POST['haj_umrah_program_id'];
            $check_where_array['programs_advantage_id !='] = $find->programs_advantage_id;
            $check_where_array['programs_advantage_id'] = $_POST['programs_advantage_id'];
            $check = $this->haj_umrah_program_advantages->findWhere($check_where_array);
            if ($check) {
                print_json('error', _lang('added_before'));
            }
            /* end */
            $this->load->library('form_validation');
            $this->form_validation->set_rules('programs_advantage_id', 'ميزة', 'required');
            $this->form_validation->set_rules('advantage_price', 'السعر', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['programs_advantage_id'] = $_POST['programs_advantage_id'];
                $data_array['price'] = $_POST['advantage_price'];
                $where_array['id'] = $haj_umrah_program_advantages_id;
                //pri($where_array);
                $update = $this->haj_umrah_program_advantages->update($data_array, $where_array);
                if ($update) {
                    print_json('success', _lang('updated_successfully'));
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $haj_umrah_program_advantages_id = $_POST['haj_umrah_program_advantages_id'];
            $where_array['id'] = $haj_umrah_program_advantages_id;
            $delete = $this->haj_umrah_program_advantages->delete($where_array);
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
                    ->select("programs_advantage.title_ar as advantage_title_ar,"
                            . "haj_umrah_program_advantages.id as haj_umrah_program_advantages_id,haj_umrah_program_advantages.price as price"
                    )
                    //->where("user_type","admin")
                    ->from("haj_umrah_program_advantages")
                    ->join("programs_advantage", "programs_advantage.id=haj_umrah_program_advantages.programs_advantage_id")
                    ->where('programs_advantage.branches_id', $this->current_user_company->id)
                    ->where('haj_umrah_program_advantages.haj_umrah_programs_id', $haj_umrah_programs_id);
//            $this->datatables->add_column('places_id', function($data) {
//                return $this->places->find($data['places_id'])->title_ar;
//            }, 'places_id');
//            $this->datatables->add_column('chalets_others_id', function($data) {
//                return $this->chalet_other->find($data['chalets_others_id'])->title_ar;
//            }, 'places_id');
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Haj_umrah_program.edit_advantages(this);return false;" data-id="' . $data["haj_umrah_program_advantages_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="حذف" class="tooltips" onclick="Haj_umrah_program.delete_advantages(this);return false;" data-id="' . $data["haj_umrah_program_advantages_id"] . '"><i class="fa fa-2x fa-times"></i></a>';


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
