<?php

    class Reservation extends C_Controller{

        public $serail = 1;

        public function __construct(){
            parent::__construct();
            $this->load->model('Front_programs_model', 'programs');
            $this->load->model('Programs_flight_model', 'programs_flight');
            $this->load->model('Flight_reservation_model', 'flight_reservation');
            $this->load->model('Home_model', 'home');
            $this->load->model('Reservation_model', 'reservation');
        }

        public function index(){
            $main_content = 'reservation/index';
            $this->_view($main_content, 'admin');
        }

        public function show($page_index = 0){

            $main_content = 'reservation/index';
            $this->_view($main_content, 'admin');
        }

        public function confirmation(){
            //pri($_POST);
            $reservation_id = $_POST['reservation_id'];
            $reservation_detail = $this->reservation->findByTableAndID("reservation", $reservation_id);
            if ($reservation_detail->active == 1) {
                print_json('error', _lang('reservation_is_confirmed'));
            }
            $data['active'] = 1;
            $where_array['id'] = $reservation_id;
            $this->reservation->update('reservation', $data, $where_array);
            $programs_flight = $this->reservation->findByTableAndID("programs_flight", $reservation_detail->programs_flight_id);
            $flight_reservation = $this->reservation->findByTableAndID("flight_reservation", $programs_flight->flight_reservation_id);
            if ($flight_reservation->flight_type == 1) {
                $flight_traveller_number = $reservation_detail->number_of_traveller;
                $sql_update = "update flight_reservation set passenger_reserved = ( passenger_reserved + $flight_traveller_number )
                                    where id = $flight_reservation->id  ";
                $this->db->query($sql_update);
            }
            $program = $this->reservation->findByTableAndID('programs', $programs_flight->programs_id);
            $category_id = ($program->category_id == 0) ? $program->parent_category_id : $program->category_id;
            $category = $this->reservation->findByTableAndID('program_categories', $category_id);
            if ($category && $category->hotels_required == 1) {
                $reservation_rooms = $this->reservation->GetWhere("reservation_rooms", "id", "DESC", $where_array);
                foreach ($reservation_rooms as $room) {
                    $sql_update = "update programs_rooms_prices set number_of_rooms_reserved = ( number_of_rooms_reserved + $room->no_of_rooms )
                                    where id = $room->programs_rooms_prices_id ";
                    $this->db->query($sql_update);
                }
            }
            print_json('success', _lang('confirmation_done'));
        }

        public function cancellation(){
            /*
             * pay ways ids
             * 1 auto release
             * 2 credit
             * 1 visa
             */
            //pri($_POST);
            $reservation_id = $_POST['reservation_id'];
            $reservation_detail = $this->reservation->findByTableAndID("reservation", $reservation_id);
            if ($reservation_detail->cancelled == 1) {
                print_json('error', _lang('reservation_is_cancelled_before'));
            }
            $where_array['reservation_id'] = $reservation_id;
//            $this->reservation->delete("reservation_traveller", $where_array);
//            $this->reservation->delete("reservation_extra_services", $where_array);
            $programs_flight = $this->reservation->findByTableAndID("programs_flight", $reservation_detail->programs_flight_id);
            $flight_reservation = $this->reservation->findByTableAndID("flight_reservation", $programs_flight->flight_reservation_id);
            //pri($programs_flight->flight_reservation_id);
            if ($flight_reservation->flight_type == 1) {
                $flight_traveller_number = $reservation_detail->number_of_traveller;
                $sql_update = "update flight_reservation set passenger_reserved = ( passenger_reserved - $flight_traveller_number )
                                    where id = $flight_reservation->id  ";
                $this->db->query($sql_update);
            }
            $program = $this->reservation->findByTableAndID('programs', $programs_flight->programs_id);
            $category_id = ($program->category_id == 0) ? $program->parent_category_id : $program->category_id;
            $category = $this->reservation->findByTableAndID('program_categories', $category_id);
            if ($category && $category->hotels_required == 1) {
                $reservation_rooms = $this->reservation->GetWhere("reservation_rooms", "id", "DESC", $where_array);
                foreach ($reservation_rooms as $room) {
                    $sql_update = "update programs_rooms_prices set number_of_rooms_reserved = ( number_of_rooms_reserved - $room->no_of_rooms )
                                    where id = $room->programs_rooms_prices_id ";
                    $this->db->query($sql_update);
                }
//                $this->reservation->delete("reservation_rooms", $where_array);
            }
            $company_that_made_reservation_id = $reservation_detail->branches_id;
            if ($company_that_made_reservation_id != $this->whitelabel_id) {
                $company = $this->reservation->findByTableAndID("branches", $company_that_made_reservation_id);
                if ($company->pay_ways_id == 2) {
                    $sql_update = "update branches set pay_way_value = ( pay_way_value + $reservation_detail->net_reservation_price )
                                    where id = $company_that_made_reservation_id ";
                    $this->db->query($sql_update);
                }
            }
            $this->reservation->update("reservation", array('cancelled' => 1), array('id' => $reservation_id));
            print_json('success', _lang('cancellation_done'));
        }

        public function print_reservation(){
            $reservation_id = $_POST['reservation_id'];
            $reservation_detail = $this->programs->findByTableAndID("reservation", $reservation_id);
            $programs_flight = $this->programs->findByTableAndID("programs_flight", $reservation_detail->programs_flight_id);
            //pri($programs_flight);
            $this->data['reservation_detail'] = $reservation_detail;

            $programs_flight_id = $programs_flight->id;
            $program_id = $programs_flight->programs_id;
            $flight_reservation_id = $programs_flight->flight_reservation_id;
            $this->data['program_detail'] = $this->programs->get_program($program_id);
            //pri($this->data['program_detail']);
            $this->data['program_dates'] = $this->programs->get_program_dates(false, $programs_flight_id, true);
            $where_array['reservation_id'] = $reservation_id;
            $reservation_travellers = $this->programs->GetWhere("reservation_traveller", "id", "ASC", $where_array);
            if (count($reservation_travellers) <= 6) {
                $this->data['reservation_traveller_first_table'] = $this->programs->GetWhere("reservation_traveller", "id", "ASC", $where_array);
                $this->data['page_break'] = false;
                $table_count = 1;
            } else if (count($reservation_travellers) > 6 && count($reservation_travellers) <= 12) {
                $travellers_pieces = array_chunk($reservation_travellers, ceil(count($reservation_travellers) / 2));
                $this->data['reservation_traveller_first_table'] = $travellers_pieces[0];
                $this->data['reservation_traveller_second_table'] = $travellers_pieces[1];
                $this->data['page_break'] = false;
                $table_count = 2;
            } else if (count($reservation_travellers) > 12) {
                $this->data['reservation_traveller_first_table'] = array_slice($reservation_travellers, 0, 6);
                $this->data['reservation_traveller_second_table'] = array_slice($reservation_travellers, 7, 6);
                $last_table = array_slice($reservation_travellers, 12);
                $last_tables = array_chunk($last_table, ceil(count($last_table) / 2));
                $this->data['reservation_traveller_third_table'] = $last_tables[0];
                $this->data['reservation_traveller_fourth_table'] = $last_tables[1];
                $this->data['page_break'] = true;
            }
            $program = $this->programs->findByTableAndID('programs', $program_id);
            $category_id = ($program->category_id == 0) ? $program->parent_category_id : $program->category_id;
            $category = $this->programs->findByTableAndID('program_categories', $category_id);
            if ($category && $category->hotels_required == 1) {
                $this->data['closed_room'] = $this->programs->reservation_rooms($reservation_id, $programs_flight_id);
                $this->data['program_category_hotels_required'] = $category->hotels_required;
            }
            $this->data['reservation_extra_services_card'] = $this->programs->reservation_extra_services($reservation_id, 1, $program_id);
            $this->data['reservation_extra_services_persons'] = $this->programs->reservation_extra_services($reservation_id, 0, $program_id);

//pri($this->data['reservation_extra_services_card']);
            $print_reservation = $this->load->view("main_content/print_reservation2", $this->data, true);
            echo $print_reservation;
        }

        function data(){

            $this->load->library('datatables');
            $this->datatables
                    ->select('reservation.cancelled as reservation_cancelled,reservation.active as reservation_active,reservation.id as reservation_id,reservation.creation_date, reservation.reservation_code, programs.our_code,b1.title_ar as parent_company_ar,b2.title_ar as child_company_ar,
                              programs.title_ar as program_title_ar, flight_reservation.going_date,programs_flight.id as program_flight_id'
                    )
                    ->from("reservation")
                    ->join('programs_flight', 'reservation.programs_flight_id = programs_flight.id')
                    ->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id')
                    ->join('programs', 'programs.id = programs_flight.programs_id')
                    ->join('branches b1', 'b1.id = reservation.whitelabel_id')
                    ->join('branches b2', 'b2.id = reservation.branches_id')
                    ->where("reservation.is_deleted", "0")
                    ->where("reservation.whitelabel_id", $this->current_user_company->id);



            $this->datatables->add_column('serial', function($data) {
                $CI = & get_instance();
                $back = $CI->serail++;

                return $back;
            }, 'reservation_id');
            $this->datatables->add_column('options', function($data) {
                $CI = & get_instance();
                $reservation = $CI->reservation->findByTableAndID('reservation', $data['reservation_id']);
                $company = $CI->reservation->findByTableAndID('branches', $reservation->branches_id);
                $back = "";
                $back .= '<a href="#" title="' . _lang("print") . '" class="tooltips" onclick="Reservation.print_reservation(this);return false;" data-id="' . $data["reservation_id"] . '" data-program-flight-id="' . $data["program_flight_id"] . '"><i class="fa fa-2x fa-print" aria-hidden="true"></i></a>';
                $back .= "&nbsp;&nbsp;";
                if ($data['reservation_cancelled'] == 0) {
                    $back .= '<a href="#" title="' . _lang("cancellation") . '" class="tooltips" onclick="Reservation.cancellation(this);return false;" data-id="' . $data["reservation_id"] . '" data-program-flight-id="' . $data["program_flight_id"] . '"><i class="fa fa-2x fa-undo text-danger" aria-hidden="true"></i></a>';
                }
                $back .= "&nbsp;&nbsp;";
                if ($company->id != $CI->whitelabel_id && $company->pay_ways_id == 1 && $data['reservation_active'] == 0) {
                    $back .= '<a href="#" title="' . _lang("confirmation") . '" class="tooltips" onclick="Reservation.confirmation(this);return false;" data-id="' . $data["reservation_id"] . '" ><i class="fa fa-2x fa-thumbs-o-up" aria-hidden="true"></i></a>';
                }
                return $back;
            }, 'reservation_id');
            $this->datatables->add_column('reservation_active', function($data) {
                $back = ($data['reservation_active'] == 1) ? 'مؤكد' : 'غير مؤكد';

                return $back;
            }, 'reservation_id');
            $this->datatables->add_column('reservation_cancelled', function($data) {
                $back = ($data['reservation_cancelled'] == 1) ? 'ملغى' : 'غير ملغى';

                return $back;
            }, 'reservation_id');

            $results = $this->datatables->generate();
            echo $results;
            exit;
        }

    }
