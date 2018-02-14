<?php

    class Haj_umrah_program extends C_Controller{
        public function __construct(){
            parent::__construct();
            //$this->CheckLogin(true);
            $this->load->model('Haj_umrah_program_model', 'haj_umrah_program');

            if (!empty($this->_settings->site_language)) {
                $this->config->set_item('language', $this->_settings->site_language);
            }
        }

        public function index(){
            $all_haj_umrah_programs = $this->haj_umrah_program->allHajUmrahPrograms($this->current_user_company->id);
            //pri($all_haj_umrah_programs);
            $rooms = $this->haj_umrah_program->rooms($this->current_user_company->id);
            $extra_services = $this->haj_umrah_program->extra_services($this->current_user_company->id);
            $places = $this->haj_umrah_program->places(29);
            //pri($countries);
            $flight_where['flight_reservation.branches_id'] = $this->current_user_company->id;
            $allFlights = $this->haj_umrah_program->GetAllFlights($flight_where);
            $advantages = $this->haj_umrah_program->advantages($this->current_user_company->id);
            $this->data['all_haj_umrah_programs'] = $all_haj_umrah_programs;
            $this->data['allFlights'] = $allFlights;
            //pri($this->data['allFlights']);
            $this->data['rooms'] = $rooms;
            $this->data['extra_services'] = $extra_services;
            $this->data['cities'] = $places;
            $this->data['advantages'] = $advantages;
            $main_content = 'haj_umrah_program/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $all_haj_umrah_programs = $this->haj_umrah_program->allHajUmrahPrograms($this->current_user_company->id);
            //pri($all_haj_umrah_programs);
            $rooms = $this->haj_umrah_program->rooms($this->current_user_company->id);
            $extra_services = $this->haj_umrah_program->extra_services($this->current_user_company->id);
            $places = $this->haj_umrah_program->places(29);
            //pri($places);
            $flight_where['flight_reservation.branches_id'] = $this->current_user_company->id;
            $allFlights = $this->haj_umrah_program->GetAllFlights($flight_where);
            $advantages = $this->haj_umrah_program->advantages($this->current_user_company->id);
            $this->data['all_haj_umrah_programs'] = $all_haj_umrah_programs;
            $this->data['allFlights'] = $allFlights;
            //pri($this->data['allFlights']);
            $this->data['rooms'] = $rooms;
            $this->data['extra_services'] = $extra_services;
            $this->data['cities'] = $places;
            $this->data['advantages'] = $advantages;
            //pri($this->data['cities']);
            $main_content = 'haj_umrah_program/index';
            $this->_view($main_content, 'admin');
        }

        function data(){


            $this->load->library('datatables');
            $this->datatables
                    ->select("*"
                    )
                    //->where("user_type","admin")
                    ->from("maka_madina_hotels")
                    ->where("active", 1)
                    ->where("branches_id", $this->current_user_company->id);

            $this->datatables->add_column('options', function($data) {

                $back = "";
                //if( check_permission("admins", "add_update") ):

                $back .= '<a href="#" title="' . _lang("determine_rooms") . '" class="tooltips testo"  data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="' . _lang("determine_rooms_prices") . '" class="tooltips" onclick="Hotel_data.determine_rooms_prices(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="' . _lang("determine_extra_services_prices") . '" class="tooltips" onclick="Hotel_data.determine_extra_services_prices(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';
                $back .= "&nbsp;&nbsp;";
                $back .= '<a href="#" title="' . _lang("add_hotel_images") . '" class="tooltips" onclick="Hotel_data.add_hotel_images(this);return false;" data-id="' . $data["id"] . '"><i class="fa fa-2x fa-edit"></i></a>';

                //endif;
                return $back;
            }, 'id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

        public function availableRooms(){
            //pri($_POST);
            $hotel_id = $_POST['hotel_id'];
            $rooms = $this->hotel_data->roomsAvailable($this->current_user_company->id, $hotel_id);
            //pri($rooms);
            if ($rooms) {
                print_json('success', $rooms);
            } else {
                print_json('error', 'error');
            }
        }

        public function availableExtraServices(){
            $hotel_id = $_POST['hotel_id'];
            $services = $this->hotel_data->extraServicesAvailable($this->current_user_company->id, $hotel_id);
            if ($services) {
                print_json('success', $services);
            } else {
                print_json('error', 'error');
            }
        }

        function getPlaces(){
            $selected_id = $_POST['selected_id'];
            $cond['place_id'] = $_POST['place_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $str = '<option disabled="disabled">اختر</option>';
            $regions = $this->haj_umrah_program->GetWhere('places', 'id', "ASC", $cond);
            if (count($regions) > 0) {
                foreach ($regions as $p) {
                    if ($p->id == $selected_id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $str .= '<option ' . $selected . ' value=' . $p->id . '>' . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function getHotels(){
            $selected_id = $_POST['selected_id'];
            $cond['branches_id'] = $this->current_user_company->id;
            $cond['region_id'] = $_POST['region_id'];
            $cond['active'] = 1;
            $str = '<option disabled="disabled">اختر</option>';
            $regions = $this->haj_umrah_program->GetWhere('haj_umrah_hotels', 'id', "ASC", $cond);
            if (count($regions) > 0) {
                foreach ($regions as $p) {
                    if ($p->id == $selected_id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $str .= '<option ' . $selected . ' value=' . $p->id . '>' . $p->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function checkProgramNights(){
            $haj_umrah_program_id = $_POST['haj_umrah_program_id'];
            $haj_umrah_program = $this->haj_umrah_program->findById($haj_umrah_program_id); //from haj umrah programs table
            //pri($haj_umrah_program);
            $total_nights = $haj_umrah_program->no_of_nights;
            $nights_added = $this->haj_umrah_program->getSumNightsOfProgram($haj_umrah_program_id); // from haj umrah program cities table
            if ($total_nights > $nights_added) {
                print_json('success', 'success');
            } else {
                print_json('error', _lang('program_nights_error') . $total_nights);
            }
        }

    }
