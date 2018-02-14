<?php

    class Hotels_rooms_prices extends C_Controller{
        public function __construct(){
            parent::__construct();
//            $this->CheckLogin(true);
            $this->load->model('Hotel_extra_services_model', 'hotel_extra_service');
            $this->load->model('Hotels_extra_services_model', 'hotels_extra_services');
            $this->load->model('Hotel_rooms_model', 'hotel_rooms');
            $this->load->model('Hotels_rooms_prices_model', 'hotels_rooms_prices');
            $this->load->model('Hotels_rooms_prices_dates_model', 'hotels_rooms_prices_dates');
            $this->load->model('Places_model', 'places');

            if (!empty($this->_settings->site_language)) {
                $this->config->set_item('language', $this->_settings->site_language);
            }
        }

        public function index(){
            $all_hotels = $this->hotel_prices->allHotels($this->current_user_company->id);
            //pri($hotel_extra_services);
            $this->data['all_hotels'] = $all_hotels;
            $main_content = 'hotel_prices/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $all_hotels = $this->hotel_prices->allHotels($this->current_user_company->id);
            //pri($hotel_extra_services);
            $this->data['all_hotels'] = $all_hotels;
            $main_content = 'hotel_prices/index';
            $this->_view($main_content, 'admin');
        }

        public function row(){
            // pri($_POST);
            $hotels_rooms_prices_id = $_POST['hotels_rooms_prices_id'];
            $find = $this->hotels_rooms_prices->find($hotels_rooms_prices_id);
            //pri($find);
            if ($find) {
                print_json('success', $find);
            } else {
                print_json('error', 'error');
            }
        }

        public function add(){
            //pri($_POST);
            $hotel_id = $_POST['hotel_id'];
            $places_id = $_POST['country_id'];
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            $rooom_id = $_POST['rooom_id'];
            //$wrong_dates = $this->wrong_dates($from_date, $to_date);
            $check_date_in = $this->check_date_in($hotel_id, $places_id, $rooom_id, $from_date, $to_date);
            $check_added_before = $this->hotels_rooms_prices->check_added_before($hotel_id, $places_id, $rooom_id, $from_date, $to_date, false);

            if ($check_date_in) {
                print_json('error', $check_date_in);
            } else {
                if ($check_added_before) {
                    print_json('error', _lang('added_before'));
                }
            }
            //pri('stop');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('country_id', 'البلد', 'required');
            $this->form_validation->set_rules('rooom_id', 'الغرفة', 'required');
            $this->form_validation->set_rules('from_date', 'من تاريخ', 'required');
            $this->form_validation->set_rules('to_date', 'الى تاريخ', 'required');
            $this->form_validation->set_rules('adult_price', 'السعر بالنسبة للبالغين', 'required');
            //$this->form_validation->set_rules('child_price', 'السعر بالنسبة للأطفال', 'required');
            $this->form_validation->set_rules('number_of_room', 'المتاح', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $days = GetDays($_POST['from_date'], $_POST['to_date']);
                $data_array['places_id'] = $_POST['country_id'];
                $data_array['hotel_rooms_id'] = $_POST['rooom_id'];
                $data_array['hotel_id'] = $_POST['hotel_id'];
                $data_array['adult_price'] = $_POST['adult_price'];
                //$data_array['child_price'] = $_POST['child_price'];
                $data_array['from_date'] = $_POST['from_date'];
                $data_array['to_date'] = $_POST['to_date'];
                $data_array['number_of_room'] = $_POST['number_of_room'];
                $data_array['number_of_room_in_period'] = $_POST['number_of_room'] * count($days);
                $add = $this->hotels_rooms_prices->add($data_array);
                if ($add) {
                    if (count($days) > 1) {
                        foreach ($days as $day) {
                            $hotels_rooms_prices_dates_data['hotels_rooms_prices_id'] = $add;
                            $hotels_rooms_prices_dates_data['date'] = $day;
                            $hotels_rooms_prices_dates_data['number_of_room'] = $_POST['number_of_room'];
                            $this->hotels_rooms_prices_dates->add($hotels_rooms_prices_dates_data);
                        }
                    }
                    print_json('success', 'تمت الأضافة بنجاح');
                } else {
                    print_json('error', 'error');
                }
            }
        }

        function edit(){
            $hotels_rooms_prices_id = $_POST['hotels_rooms_prices_id'];
            $hotel_id = $_POST['hotel_id'];
            $places_id = $_POST['country_id'];
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
            $rooom_id = $_POST['rooom_id'];
            //$wrong_dates = $this->wrong_dates($from_date, $to_date);
            $check_date_in = $this->check_date_in($hotel_id, $places_id, $rooom_id, $from_date, $to_date, $hotels_rooms_prices_id);
            $check_added_before = $this->hotels_rooms_prices->check_added_before($hotel_id, $places_id, $rooom_id, $from_date, $to_date, $hotels_rooms_prices_id);

            if ($check_date_in) {
                print_json('error', $check_date_in);
            } else {
                if ($check_added_before) {
                    print_json('error', _lang('added_before'));
                }
            }

            //pri('stop');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('country_id', 'البلد', 'required');
            $this->form_validation->set_rules('rooom_id', 'الغرفة', 'required');
            $this->form_validation->set_rules('from_date', 'من تاريخ', 'required');
            $this->form_validation->set_rules('to_date', 'الى تاريخ', 'required');
            $this->form_validation->set_rules('adult_price', 'السعر بالنسبة للبالغين', 'required');
            //$this->form_validation->set_rules('child_price', 'السعر بالنسبة للأطفال', 'required');
            $this->form_validation->set_rules('number_of_room', 'المتاح', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $days = GetDays($_POST['from_date'], $_POST['to_date']);
                $data_array['places_id'] = $_POST['country_id'];
                $data_array['hotel_rooms_id'] = $_POST['rooom_id'];
                $data_array['adult_price'] = $_POST['adult_price'];
                //$data_array['child_price'] = $_POST['child_price'];
                $data_array['from_date'] = $_POST['from_date'];
                $data_array['to_date'] = $_POST['to_date'];
                $data_array['number_of_room'] = $_POST['number_of_room'];
                $data_array['number_of_room_in_period'] = $_POST['number_of_room'] * count($days);
                $where_array['id'] = $hotels_rooms_prices_id;
                //pri($where_array);
                $update = $this->hotels_rooms_prices->update($data_array, $where_array);
                if ($update) {
                    if (count($days) > 1) {
                        $hotels_rooms_prices_dates_where_array['hotels_rooms_prices_id'] = $hotels_rooms_prices_id;
                        $this->hotels_rooms_prices_dates->delete($hotels_rooms_prices_dates_where_array);
                        foreach ($days as $day) {
                            $hotels_rooms_prices_dates_data['hotels_rooms_prices_id'] = $hotels_rooms_prices_id;
                            $hotels_rooms_prices_dates_data['date'] = $day;
                            $hotels_rooms_prices_dates_data['number_of_room'] = $_POST['number_of_room'];
                            $this->hotels_rooms_prices_dates->add($hotels_rooms_prices_dates_data);
                        }
                    }
                    print_json('success', 'تم التعديل بنجاح');
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $hotels_rooms_prices_id = $_POST['hotels_rooms_prices_id'];
            $where_array['id'] = $hotels_rooms_prices_id;
            $delete = $this->hotels_rooms_prices->delete($where_array);
            if ($delete) {
                $hotels_rooms_prices_dates_where_array['hotels_rooms_prices_id'] = $hotels_rooms_prices_id;
                $this->hotels_rooms_prices_dates->delete($hotels_rooms_prices_dates_where_array);
                print_json('success', 'تم الحذف بنجاح');
            } else {
                print_json('error', 'تم الحذف بنجاح');
            }
        }

        function data($hotel_id){
            $key = '';
            $value = '';
            if ($hotel_id == 'all') {
                $key = 'hotel_id !=';
                $value = 0;
            } else {
                $key = 'hotel_id';
                $value = $hotel_id;
            }
            //pri($this->db->select('*')->from('hotels_rooms')->get()->result());
            $this->load->library('datatables');
            $this->datatables
                    ->select("hotels_rooms_prices.id as hotels_rooms_prices_id,hotels_rooms_prices.from_date,hotels_rooms_prices.to_date,"
                            . "hotels_rooms_prices.number_of_room,hotels_rooms_prices.number_of_room_reserved,hotels_rooms_prices.adult_price,"
                            . "hotels_rooms_prices.child_price,places.title_ar as place_title_ar,hotel_rooms.title_ar as hotel_title_ar")
                    //->where("user_type","admin")
                    ->from("hotels_rooms_prices")
                    ->join("places", "hotels_rooms_prices.places_id=places.id")
                    ->join("hotel_rooms", "hotels_rooms_prices.hotel_rooms_id=hotel_rooms.id")
                    ->where($key, $value);
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Hotel_data.edit_rooms_prices(this);return false;" data-id="' . $data["hotels_rooms_prices_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="حذف" class="tooltips" onclick="Hotel_data.delete_rooms_prices(this);return false;" data-id="' . $data["hotels_rooms_prices_id"] . '"><i class="fa fa-2x fa-times text-danger"></i></a>';


                //endif;
                return $back;
            }, 'hotels_rooms_prices_id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        public function wrong_dates($from_date, $to_date){
            $today = date('Y-m-d');
            $errros = array();
            if ($from_date < $today) {
                $errros['from_date'] = _lang('date_in_the_past');
            }
            if ($to_date < $today) {
                $errros['to_date'] = _lang('date_in_the_past');
            }
            if (!empty($errros)) {
                return $errros;
            } else {
                return false;
            }
        }

        public function check_date_in($hotel_id, $places_id, $rooom_id, $from_date, $to_date, $hotels_rooms_prices_id = false){
            $errros = array();
            $check_date_in_for_from_date = $this->hotels_rooms_prices->check_date_in($hotel_id, $places_id, $rooom_id, $from_date, false, $hotels_rooms_prices_id);
            $check_date_in_for_to_date = $this->hotels_rooms_prices->check_date_in($hotel_id, $places_id, $rooom_id, false, $to_date, $hotels_rooms_prices_id);
            if ($from_date && $check_date_in_for_from_date) {
                $errros['from_date'] = _lang('date_found_in_other_date');
            }
            if ($to_date && $check_date_in_for_to_date) {
                $errros['to_date'] = _lang('date_found_in_other_date');
            }
            if (!empty($errros)) {
                return $errros;
            } else {
                return false;
            }
        }

    }
