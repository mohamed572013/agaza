<?php

    class Hotels_chalets_others_prices extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Hotel_extra_service_model', 'hotel_extra_service');
            $this->load->model('Hotels_extra_services_model', 'hotels_extra_services');
            $this->load->model('Hotel_rooms_model', 'hotel_rooms');
            $this->load->model('Hotels_rooms_prices_model', 'hotels_rooms_prices');
            $this->load->model('Places_model', 'places');
            $this->load->model('Chalet_other_model', 'chalet_other');
            $this->load->model('Hotels_chalets_others_prices_model', 'hotels_chalets_others_prices');

            if (!empty($this->_settings->site_language)) {
                $this->config->set_item('language', $this->_settings->site_language);
            }
        }

        public function row(){
            // pri($_POST);
            $hotels_chalets_others_prices_id = $_POST['hotels_chalets_others_prices_id'];
            $find = $this->hotels_chalets_others_prices->find($hotels_chalets_others_prices_id);
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
            $places_id = $_POST['coountry_id'];
            $from_date = $_POST['froom_date'];
            $to_date = $_POST['too_date'];
            $chalets_others_id = $_POST['chalets_others_id'];
            $wrong_dates = $this->wrong_dates($from_date, $to_date);
            $check_date_in = $this->check_date_in($hotel_id, $places_id, $chalets_others_id, $from_date, $to_date);
            $check_added_before = $this->hotels_chalets_others_prices->check_added_before($hotel_id, $places_id, $chalets_others_id, $from_date, $to_date, false);

            if (!$check_added_before) {
                if (!$wrong_dates) {
                    if ($check_date_in) {
                        print_json('error', $check_date_in);
                    }
                } else {
                    print_json('error', $wrong_dates);
                }
            } else {
                print_json('error', _lang('added_before'));
            }
            //pri('stop');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('coountry_id', 'المنطقة', 'required');
            $this->form_validation->set_rules('chalets_others_id', 'شاليه و أخرى', 'required');
            $this->form_validation->set_rules('froom_date', 'من تاريخ', 'required');
            $this->form_validation->set_rules('too_date', 'الى تاريخ', 'required');
            $this->form_validation->set_rules('price', 'السعر ', 'required');
            $this->form_validation->set_rules('number_of_chalet', 'المتاح', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['places_id'] = $_POST['coountry_id'];
                $data_array['chalets_others_id'] = $_POST['chalets_others_id'];
                $data_array['hotel_id'] = $_POST['hotel_id'];
                $data_array['price'] = $_POST['price'];
                $data_array['from_date'] = $_POST['froom_date'];
                $data_array['to_date'] = $_POST['too_date'];
                $data_array['number_of_chalet'] = $_POST['number_of_chalet'];
                //$data_array['branches_id'] = $this->current_user_company->id;
                //pri($data_array);
                $add = $this->hotels_chalets_others_prices->add($data_array);
                if ($add) {
                    print_json('success', 'تمت الأضافة بنجاح');
                } else {
                    print_json('error', 'error');
                }
            }
        }

        function edit(){
            $hotels_chalets_others_prices_id = $_POST['hotels_chalets_others_prices_id'];
            $hotel_id = $_POST['hotel_id'];
            $places_id = $_POST['coountry_id'];
            $from_date = $_POST['froom_date'];
            $to_date = $_POST['too_date'];
            $chalets_others_id = $_POST['chalets_others_id'];
            $wrong_dates = $this->wrong_dates($from_date, $to_date);
            $check_date_in = $this->check_date_in($hotel_id, $places_id, $chalets_others_id, $from_date, $to_date, $hotels_chalets_others_prices_id);
            $check_added_before = $this->hotels_chalets_others_prices->check_added_before($hotel_id, $places_id, $chalets_others_id, $from_date, $to_date, $hotels_chalets_others_prices_id);
            //pri($this->db->last_query());
            if (!$check_added_before) {
                if (!$wrong_dates) {
                    if ($check_date_in) {
                        print_json('error', $check_date_in);
                    }
                } else {
                    print_json('error', $wrong_dates);
                }
            } else {
                print_json('error', _lang('added_before'));
            }

            //pri('stop');
            $hotels_chalets_others_prices_id = $_POST['hotels_chalets_others_prices_id'];
            $this->load->library('form_validation');
            $this->form_validation->set_rules('coountry_id', 'المنطقة', 'required');
            $this->form_validation->set_rules('chalets_others_id', 'شاليه و أخرى', 'required');
            $this->form_validation->set_rules('froom_date', 'من تاريخ', 'required');
            $this->form_validation->set_rules('too_date', 'الى تاريخ', 'required');
            $this->form_validation->set_rules('price', 'السعر ', 'required');
            $this->form_validation->set_rules('number_of_chalet', 'المتاح', 'required');
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                print_json('error', $errors);
            } else {
                $data_array['places_id'] = $_POST['coountry_id'];
                $data_array['chalets_others_id'] = $_POST['chalets_others_id'];
                $data_array['price'] = $_POST['price'];
                $data_array['from_date'] = $_POST['froom_date'];
                $data_array['to_date'] = $_POST['too_date'];
                $data_array['number_of_chalet'] = $_POST['number_of_chalet'];
                $where_array['id'] = $hotels_chalets_others_prices_id;
                $update = $this->hotels_chalets_others_prices->update($data_array, $where_array);
                if ($update) {
                    print_json('success', 'تم التعديل بنجاح');
                } else {
                    print_json('error', _lang('no_affected_rows'));
                }
            }
        }

        public function delete(){
            //pri($_POST);
            $hotels_chalets_others_prices_id = $_POST['hotels_chalets_others_prices_id'];
            $where_array['id'] = $hotels_chalets_others_prices_id;
            $delete = $this->hotels_chalets_others_prices->delete($where_array);
            if ($delete) {
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
                    ->select("hotels_chalets_others_prices.id as hotels_chalets_others_prices_id,hotels_chalets_others_prices.from_date,hotels_chalets_others_prices.to_date,hotels_chalets_others_prices.number_of_chalet,"
                            . "hotels_chalets_others_prices.number_of_chalet_reserved,hotels_chalets_others_prices.price,places.title_ar as place_title_ar,chalets_others.title_ar as chalet_title_ar")
                    //->where("user_type","admin")
                    ->from("hotels_chalets_others_prices")
                    ->join("places", "hotels_chalets_others_prices.places_id=places.id")
                    ->join("chalets_others", "hotels_chalets_others_prices.chalets_others_id=chalets_others.id")
                    ->where($key, $value);
            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="تعديل" class="tooltips" onclick="Hotel_data.edit_chalets_others_prices(this);return false;" data-id="' . $data["hotels_chalets_others_prices_id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="حذف" class="tooltips" onclick="Hotel_data.delete_chalets_others_prices(this);return false;" data-id="' . $data["hotels_chalets_others_prices_id"] . '"><i class="fa fa-2x fa-times text-danger"></i></a>';


                //endif;
                return $back;
            }, 'hotels_chalets_others_prices_id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        public function wrong_dates($from_date, $to_date){
            $today = date('Y-m-d');
            $errros = array();
            if ($from_date < $today) {
                $errros['froom_date'] = _lang('date_in_the_past');
            }
            if ($to_date < $today) {
                $errros['too_date'] = _lang('date_in_the_past');
            }
            if (!empty($errros)) {
                return $errros;
            } else {
                return false;
            }
        }

        public function check_date_in($hotel_id, $places_id, $chalets_others_id, $from_date, $to_date, $hotels_rooms_prices_id = false){
            $errros = array();
            $check_date_in_for_from_date = $this->hotels_chalets_others_prices->check_date_in($hotel_id, $places_id, $chalets_others_id, $from_date, false, $hotels_rooms_prices_id);
            $check_date_in_for_to_date = $this->hotels_chalets_others_prices->check_date_in($hotel_id, $places_id, $chalets_others_id, false, $to_date, $hotels_rooms_prices_id);
            if ($from_date && $check_date_in_for_from_date) {
                $errros['froom_date'] = _lang('date_found_in_other_date');
            }
            if ($to_date && $check_date_in_for_to_date) {
                $errros['too_date'] = _lang('date_found_in_other_date');
            }
            if (!empty($errros)) {
                return $errros;
            } else {
                return false;
            }
        }

    }
