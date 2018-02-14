<?php

    class Program_data extends C_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Program_data_model', 'program_data');
        }

        public function index(){
            $allPrograms = $this->program_data->allPrograms($this->current_user_company->id);
            //pri($all_haj_umrah_programs);
            $rooms = $this->program_data->rooms($this->current_user_company->id);
            $extra_services = $this->program_data->extra_services($this->current_user_company->id);
            $places = $this->program_data->places($this->current_user_company->id);
            //pri($places);
            $flight_where['flight_reservation.branches_id'] = $this->current_user_company->id;
            $allFlights = $this->program_data->GetAllFlights($flight_where);
            $advantages = $this->program_data->advantages($this->current_user_company->id);
            $this->data['currency'] = $this->program_data->GetWhere("currency", "id", "ASC", array('branches_id' => $this->current_user_company->id));
            $this->data['allPrograms'] = $allPrograms;
            $this->data['allFlights'] = $allFlights;
            //pri($this->data['allFlights']);
            $this->data['rooms'] = $rooms;
            $this->data['extra_services'] = $extra_services;
            $this->data['cities'] = $places;
            $this->data['advantages'] = $advantages;
            //pri($this->data['cities']);
            $main_content = 'program_data/index';
            $this->_view($main_content, 'admin');
        }

        public function show(){
            $allPrograms = $this->program_data->allPrograms($this->current_user_company->id);
            //pri($all_haj_umrah_programs);
            $rooms = $this->program_data->rooms($this->current_user_company->id);
            $extra_services = $this->program_data->extra_services($this->current_user_company->id);
            $places = $this->program_data->places($this->current_user_company->id);
            //pri($places);
            $flight_where['flight_reservation.branches_id'] = $this->current_user_company->id;
            $allFlights = $this->program_data->GetAllFlights($flight_where);
            $advantages = $this->program_data->advantages($this->current_user_company->id);
            $this->data['currency'] = $this->program_data->GetWhere("currency", "id", "ASC", array('branches_id' => $this->current_user_company->id));
            $this->data['allPrograms'] = $allPrograms;
            $this->data['allFlights'] = $allFlights;
            //pri($this->data['allFlights']);
            $this->data['rooms'] = $rooms;
            $this->data['extra_services'] = $extra_services;
            $this->data['cities'] = $places;
            $this->data['advantages'] = $advantages;
            //pri($this->data['cities']);
            $main_content = 'program_data/index';
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

        function getCities(){

            $selected_id = $_POST['selected_id'];
            $cond['place_id'] = $_POST['country_id'];
            $cond['is_delete'] = 0;
            $cond['active'] = 1;
            $str = '<option disabled="disabled">اختر</option>';
            $cities = $this->program_data->GetWhere('places', 'id', "ASC", $cond);
            if (count($cities) > 0) {
                foreach ($cities as $c) {
                    if ($c->id == $selected_id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $str .= '<option ' . $selected . ' value=' . $c->id . '>' . $c->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function getHotels(){
            //pri($_POST);
            $selected_id = $_POST['selected_id'];
            $cond['branches_id'] = $this->current_user_company->id;
            $cond['places_id'] = $_POST['city_id'];
            $cond['active'] = 1;
            $str = '<option disabled="disabled">اختر</option>';
            $hotels = $this->program_data->GetWhere('maka_madina_hotels', 'id', "ASC", $cond);
            //pri($hotels);
            if (count($hotels) > 0) {
                foreach ($hotels as $h) {
                    if ($h->id == $selected_id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $str .= '<option ' . $selected . ' value=' . $h->id . '>' . $h->title_ar . '</option>';
                }
            }

            echo $str;
        }

        function checkProgramNights(){
            $program_id = $_POST['program_id'];
            $program = $this->program_data->findById($program_id); //from haj umrah programs table

            $total_nights = $program->maka_nights;
            $nights_added = $this->program_data->getSumNightsOfProgram($program_id); // from haj umrah program cities table
            //pri($total_nights);
            if ($total_nights > $nights_added) {
                print_json('success', 'success');
            } else {
                print_json('success', _lang('program_nights_error') . $total_nights);
            }
        }

    }
