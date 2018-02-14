<?php

    class Hotels_reservation extends C_Controller{

        public $serail = 1;

        public function __construct(){
            parent::__construct();
            $this->load->model('Front_hotels_model', 'hotels');
            $this->load->model('Reservation_model', 'reservation');
        }

        public function index(){
            $main_content = 'hotels_reservation/index';
            $this->_view($main_content, 'admin');
        }

        public function show($page_index = 0){

            $main_content = 'hotels_reservation/index';
            $this->_view($main_content, 'admin');
        }

        public function confirmation(){
            //pri($_POST);
            $reservation_id = $_POST['reservation_id'];
            $reservation_detail = $this->reservation->findByTableAndID("hotels_reservation", $reservation_id);
            $hotels_reservation_rooms_prices = $this->reservation->GetWhere("hotels_reservation_rooms_prices", "id", "DESC", array('reservation_id' => $reservation_id));
            $days = GetDays($reservation_detail->arrive_date, $reservation_detail->departing_date);
            array_shift($days);
            foreach ($hotels_reservation_rooms_prices as $one) {
                foreach ($days as $day) {
                    $sql_update = "update hotels_rooms_prices_dates set number_of_room_reserved = ( number_of_room_reserved + $one->no_of_rooms )
                                    where hotels_rooms_prices_id = $one->hotels_rooms_prices_id and date = '$day'";
                    $query = $this->db->query($sql_update);
                    $hotels_reservation_rooms_prices_dates_data['hotels_reservation_rooms_prices_id'] = $one->id;
                    $hotels_reservation_rooms_prices_dates_data['date'] = $day;
                    //$this->reservation->add("hotels_reservation_rooms_prices_dates", $hotels_reservation_rooms_prices_dates_data);
                }
            }
            $data['active'] = 1;
            $where_array['id'] = $reservation_id;
            $this->reservation->update('hotels_reservation', $data, $where_array);
            print_json('success', _lang('confirmation_done'));
        }

        public function cancellation(){
            //pri($_POST);
            $reservation_id = $_POST['reservation_id'];
            $reservation_detail = $this->reservation->findByTableAndID("hotels_reservation", $reservation_id);
            if ($reservation_detail->cancelled == 1) {
                print_json('error', _lang('reservation_is_cancelled_before'));
            }
            $hotels_reservation_rooms_prices = $this->reservation->GetWhere("hotels_reservation_rooms_prices", "id", "DESC", array('reservation_id' => $reservation_id));
            $days = GetDays($reservation_detail->arrive_date, $reservation_detail->departing_date);
            array_shift($days);
            foreach ($hotels_reservation_rooms_prices as $one) {
                foreach ($days as $day) {
                    $sql_update = "update hotels_rooms_prices_dates set number_of_room_reserved = ( number_of_room_reserved - $one->no_of_rooms )
                                    where hotels_rooms_prices_id = $one->hotels_rooms_prices_id and date = '$day'";
                    $query = $this->db->query($sql_update);
                    $hotels_reservation_rooms_prices_dates_data['hotels_reservation_rooms_prices_id'] = $one->id;
                    $hotels_reservation_rooms_prices_dates_data['date'] = $day;
                    //$this->reservation->add("hotels_reservation_rooms_prices_dates", $hotels_reservation_rooms_prices_dates_data);
                }
            }
            $data['cancelled'] = 1;
            $where_array['id'] = $reservation_id;
            $this->reservation->update('hotels_reservation', $data, $where_array);
            print_json('success', _lang('cancellation_done'));
        }

        public function print_reservation(){
            $reservation_id = $_POST['reservation_id'];
            $cond['id'] = $reservation_id;
            $this->data['reservation_detail'] = $this->hotels->GetWhere("hotels_reservation", "id", "ASC", $cond);

            $hotel_id = $this->data['reservation_detail'][0]->hotel_id;

            $this->data['hotel_detail'] = $this->hotels->findById($hotel_id);

            $cond_person['reservation_id'] = $reservation_id;
            $reservation_travellers = $this->hotels->GetWhere("hotels_reservation_persons", "id", "ASC", $cond_person);
            if (count($reservation_travellers) <= 6) {
                $this->data['reservation_traveller_first_table'] = $this->hotels->GetWhere("hotels_reservation_persons", "id", "ASC", $cond_person);
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

            $this->data['rooms'] = $this->hotels->getHotelReservationRooms($reservation_id);

            $this->data['reservation_extra_services_rooms'] = $this->hotels->reservation_extra_services($reservation_id, 1, $hotel_id);
            //pri($this->data['closed_room']);
            $this->data['reservation_extra_services_persons'] = $this->hotels->reservation_extra_services($reservation_id, 0, $hotel_id);
            $print_reservation = $this->load->view("main_content/hotels/print_reservation", $this->data, true);
            echo $print_reservation;
        }

        function data(){
            //pri($this->current_user_company->id);
            $this->load->library('datatables');
            $this->datatables
                    ->select('hotels_reservation.cancelled as reservation_cancelled,hotels_reservation.active as reservation_active,hotels_reservation.id as reservation_id,hotels_reservation.creation_date, hotels_reservation.reservation_code,b1.title_ar as parent_company_ar,b2.title_ar as child_company_ar,
                              hotels_reservation.arrive_date,hotels_reservation.departing_date,maka_madina_hotels.title_ar as hotel_title_ar'
                    )
                    ->from("hotels_reservation")
                    ->join('maka_madina_hotels', 'hotels_reservation.hotel_id = maka_madina_hotels.id')
                    ->join('branches b1', 'b1.id = hotels_reservation.whitelabel_id')
                    ->join('branches b2', 'b2.id = hotels_reservation.branches_id')
                    // ->where("hotels_reservation.is_deleted", "0")
                    ->where("hotels_reservation.whitelabel_id", $this->current_user_company->id);

            $this->datatables->add_column('serial', function($data) {
                $CI = & get_instance();
                $back = $CI->serail++;

                return $back;
            }, 'reservation_id');
            $this->datatables->add_column('options', function($data) {
                $CI = & get_instance();
                $reservation = $CI->reservation->findByTableAndID('hotels_reservation', $data['reservation_id']);
                $company = $CI->reservation->findByTableAndID('branches', $reservation->branches_id);
                $back = "";
                $back .= '<a href="#" title="' . _lang("print") . '" class="tooltips" onclick="Hotels_reservation.print_reservation(this);return false;" data-id="' . $data["reservation_id"] . '" ><i class="fa fa-2x fa-print" aria-hidden="true"></i></a>';
                $back .= "&nbsp;&nbsp;";
                if ($data['reservation_cancelled'] == 0) {
                    $back .= '<a href="#" title="' . _lang("cancellation") . '" class="tooltips" onclick="Hotels_reservation.cancellation(this);return false;" data-id="' . $data["reservation_id"] . '" ><i class="fa fa-2x fa-undo text-danger" aria-hidden="true"></i></a>';
                }
                $back .= "&nbsp;&nbsp;";
                if ($company->id != $CI->whitelabel_id && $company->pay_ways_id == 1 && $data['reservation_active'] == 0) {
                    $back .= '<a href="#" title="' . _lang("confirmation") . '" class="tooltips" onclick="Hotels_reservation.confirmation(this);return false;" data-id="' . $data["reservation_id"] . '" ><i class="fa fa-2x fa-thumbs-o-up" aria-hidden="true"></i></a>';
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
