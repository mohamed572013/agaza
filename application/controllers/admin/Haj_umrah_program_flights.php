<?php

    class Haj_umrah_program_flights extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Haj_umrah_program_model', 'haj_umrah_program');
            $this->load->model('Haj_umrah_program_cities_model', 'haj_umrah_program_cities');
            $this->load->model('Haj_umrah_program_flights_model', 'haj_umrah_program_flights');

            if (!empty($this->_settings->site_language)) {
                $this->config->set_item('language', $this->_settings->site_language);
            }
        }

        public function row(){
            // pri($_POST);
            $haj_umrah_program_flights_id = $_POST['haj_umrah_program_flights_id'];
            //pri($haj_umrah_programs_flight_id);
            $find = $this->haj_umrah_program_flights->find($haj_umrah_program_flights_id);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            $haj_umrah_program_id = $_POST['haj_umrah_program_id'];
            $going_date = $_POST['going_date'];
            $return_date = $_POST['return_date'];
            $this->nights_check($haj_umrah_program_id, $going_date, $return_date);
            //pri('stop');
            /* check if there is the same data in the table */
            $where_array['haj_umrah_programs_id'] = $_POST['haj_umrah_program_id'];
            $where_array['flight_reservation_id'] = $_POST['flight_reservation_id'];
            $check = $this->haj_umrah_program_flights->findWhere($where_array);
            if ($check) {
                print_json('error', _lang('added_before'));
            }
            /* end */
            $this->load->library('form_validation');
            $this->form_validation->set_rules('flight_reservation_id', 'الرحلة', 'required');
            $this->form_validation->set_rules('child_price', 'سعر الطفل', 'required');
            $this->form_validation->set_rules('infant_price', 'سعر الرضيع', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['flight_reservation_id'] = $_POST['flight_reservation_id'];
                $data_array['child_price'] = $_POST['child_price'];
                $data_array['infant_price'] = $_POST['infant_price'];
                $data_array['haj_umrah_programs_id'] = $_POST['haj_umrah_program_id'];

                //pri($data_array);
                $add = $this->haj_umrah_program_flights->add($data_array);
                if ($add) {
                    print_json('success', _lang('added_successfully'));
                } else {
                    print_json('error', 'error');
                }
            }
        }

        function edit(){
            //pri($_POST);
            $haj_umrah_program_id = $_POST['haj_umrah_program_id'];
            $going_date = $_POST['going_date'];
            $return_date = $_POST['return_date'];
            $this->nights_check($haj_umrah_program_id, $going_date, $return_date);
            //pri('stop');
            $haj_umrah_program_flights_id = $_POST['haj_umrah_programs_flights_id'];
            /* check if there is the same data in the table */
            $find = $this->haj_umrah_program_flights->find($haj_umrah_program_flights_id);
            $check_where_array['haj_umrah_programs_id'] = $_POST['haj_umrah_program_id'];
            $check_where_array['flight_reservation_id !='] = $find->flight_reservation_id;
            $check_where_array['flight_reservation_id'] = $_POST['flight_reservation_id'];
            $check = $this->haj_umrah_program_flights->findWhere($check_where_array);
            if ($check) {
                print_json('error', _lang('added_before'));
            }
            //pri('ss');
            /* end */
            $this->load->library('form_validation');
            $this->form_validation->set_rules('flight_reservation_id', 'الرحلة', 'required');
            $this->form_validation->set_rules('child_price', 'سعر الطفل', 'required');
            $this->form_validation->set_rules('infant_price', 'سعر الرضيع', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['flight_reservation_id'] = $_POST['flight_reservation_id'];
                $data_array['child_price'] = $_POST['child_price'];
                $data_array['infant_price'] = $_POST['infant_price'];
                $where_array['id'] = $haj_umrah_program_flights_id;
                $update = $this->haj_umrah_program_flights->update($data_array, $where_array);
                if ($update) {
                    print_json('success', _lang('updated_successfully'));
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $haj_umrah_program_flights_id = $_POST['haj_umrah_programs_flights_id'];
            $where_array['id'] = $haj_umrah_program_flights_id;
            $delete = $this->haj_umrah_program_flights->delete($where_array);
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
                    ->select(' haj_umrah_program_flights.id as haj_umrah_program_flights_id , flight_reservation.*  , c1.title_ar AS name_from_city, '
                            . 'c2.title_ar AS name_to_city ,c3.title_ar AS return_name_from_city, '
                            . 'c4.title_ar AS  return_name_to_city , travel_way.title_ar as travel_way')
                    //->where("user_type","admin")
                    ->from('flight_reservation')
                    ->join('places AS c1', 'flight_reservation.going_from_place = c1.id')
                    ->join('places AS c2', 'flight_reservation.going_to_place = c2.id')
                    ->join('places AS c3', 'flight_reservation.return_from_place = c3.id')
                    ->join('places AS c4', 'flight_reservation.return_to_place = c4.id')
                    ->join('travel_way', 'flight_reservation.travel_way_id = travel_way.id')
                    ->join('haj_umrah_program_flights', 'flight_reservation.id = haj_umrah_program_flights.flight_reservation_id')
                    ->where("haj_umrah_program_flights.haj_umrah_programs_id", $haj_umrah_program_id)
                    ->where("haj_umrah_program_flights.active", 1);
//            $this->datatables->add_column('places_id', function($data) {
//                return $this->places->find($data['places_id'])->title_ar;
//            }, 'places_id');
            $this->datatables->add_column('room_prices', function($data) {
                $back = '<a href="" class="program-data-box" data-type="program_rooms_prices" data-id="' . $data["haj_umrah_program_flights_id"] . '">' . _lang('room_prices') . '</a>';
                return $back;
            }, 'id');
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Haj_umrah_program.edit_flights(this);return false;" data-id="' . $data["haj_umrah_program_flights_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="حذف" class="tooltips" onclick="Haj_umrah_program.delete_flights(this);return false;" data-id="' . $data["haj_umrah_program_flights_id"] . '"><i class="fa fa-2x fa-times"></i></a>';


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

        public function nights_check($haj_umrah_program_id, $going_date, $return_date){
            $haj_umrah_program = $this->haj_umrah_program->findById($haj_umrah_program_id); //from haj umrah programs table
            $total_nights = $haj_umrah_program->no_of_nights;
            $days = GetDays($going_date, $return_date);

            $days_count = count($days);
            $days_count_as_nights = $days_count - 1;
            //pri($days_count_as_nights);
            if ($total_nights == $days_count_as_nights) {

            } else {
                print_json('error', _lang('program_nights_error') . $total_nights);
            }
        }

    }
