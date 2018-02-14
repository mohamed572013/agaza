<?php

    class Program_rooms_prices extends C_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Program_rooms_prices_model', 'program_rooms_prices');
        }

        public function row(){
            //pri($_POST);
            $programs_rooms_prices_id = $_POST['programs_rooms_prices_id'];
            $find = $this->program_rooms_prices->find($programs_rooms_prices_id);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_POST);
            /* check if there is the same data in the table */
            $where_array['programs_flight_id'] = $_POST['programs_flights_id'];
            $where_array['hotel_rooms_id'] = $_POST['hotel_rooms_id'];
            $check = $this->program_rooms_prices->findWhere($where_array);
            if ($check) {
                print_json('error', _lang('added_before'));
            }
            //pri('here');
            /* end */
            $this->load->library('form_validation');
            $this->form_validation->set_rules('hotel_rooms_id', 'الغرفة', 'required');
            $this->form_validation->set_rules('number_of_rooms', 'عدد الغرفة المتاح', 'required');
            $this->form_validation->set_rules('adult_price', 'سعر البالغ', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['hotel_rooms_id'] = $_POST['hotel_rooms_id'];
                $data_array['number_of_rooms'] = $_POST['number_of_rooms'];
                $data_array['price'] = $_POST['adult_price'];
                $data_array['programs_flight_id'] = $_POST['programs_flights_id'];

                //pri($data_array);
                $add = $this->program_rooms_prices->add($data_array);
                if ($add) {
                    print_json('success', _lang('added_successfully'));
                } else {
                    print_json('error', 'error');
                }
            }
        }

        function edit(){
            //pri($_POST);
            /* check if there is the same data in the table */
            $programs_rooms_prices_id = $_POST['programs_rooms_prices_id'];
            $find = $this->program_rooms_prices->find($programs_rooms_prices_id);
            $check_where_array['hotel_rooms_id !='] = $find->hotel_rooms_id;
            $check_where_array['programs_flight_id'] = $_POST['programs_flights_id'];
            $check_where_array['hotel_rooms_id'] = $_POST['hotel_rooms_id'];
            $check = $this->program_rooms_prices->findWhere($check_where_array);
            if ($check) {
                print_json('error', _lang('added_before'));
            }

            /* end */
            $this->load->library('form_validation');
            $this->form_validation->set_rules('hotel_rooms_id', 'الغرفة', 'required');
            $this->form_validation->set_rules('number_of_rooms', 'عدد الغرفة المتاح', 'required');
            $this->form_validation->set_rules('adult_price', 'سعر البالغ', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['hotel_rooms_id'] = $_POST['hotel_rooms_id'];
                $data_array['number_of_rooms'] = $_POST['number_of_rooms'];
                $data_array['price'] = $_POST['adult_price'];
                $data_array['programs_flight_id'] = $_POST['programs_flights_id'];
                $where_array['id'] = $programs_rooms_prices_id;
                //pri($where_array);
                $update = $this->program_rooms_prices->update($data_array, $where_array);
                if ($update) {
                    print_json('success', _lang('updated_successfully'));
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $programs_rooms_prices_id = $_POST['programs_rooms_prices_id'];
            $where_array['id'] = $programs_rooms_prices_id;
            //pri($where_array);
            $delete = $this->program_rooms_prices->delete($where_array);
            if ($delete) {
                print_json('success', _lang('deleted_successfully'));
            } else {
                print_json('error', 'error');
            }
        }

        function data($programs_flights_id){
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
                    ->select("hotel_rooms.title_ar as room_title_ar,programs_rooms_prices.price as room_price,"
                            . "programs_rooms_prices.number_of_rooms as number_of_rooms,programs_rooms_prices.number_of_rooms_reserved as number_of_rooms_reserved,"
                            . "programs_rooms_prices.id as programs_rooms_prices_id"
                    )
                    //->where("user_type","admin")
                    ->from("programs_rooms_prices")
                    ->join("hotel_rooms", "hotel_rooms.id=programs_rooms_prices.hotel_rooms_id")
                    ->where('hotel_rooms.branches_id', $this->current_user_company->id)
                    ->where('programs_rooms_prices.programs_flight_id', $programs_flights_id);
//            $this->datatables->add_column('places_id', function($data) {
//                return $this->places->find($data['places_id'])->title_ar;
//            }, 'places_id');
//            $this->datatables->add_column('chalets_others_id', function($data) {
//                return $this->chalet_other->find($data['chalets_others_id'])->title_ar;
//            }, 'places_id');
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Program_data.edit_rooms_prices(this);return false;" data-id="' . $data["programs_rooms_prices_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="حذف" class="tooltips" onclick="Program_data.delete_rooms_prices(this);return false;" data-id="' . $data["programs_rooms_prices_id"] . '"><i class="fa fa-2x fa-times text-danger"></i></a>';


                //endif;
                return $back;
            }, 'programs_rooms_prices_id');

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
