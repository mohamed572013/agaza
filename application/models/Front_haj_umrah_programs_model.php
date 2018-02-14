<?php

    class Front_haj_umrah_programs_model extends CI_Model{
        public function __construct(){
            parent::__construct();
        }

        public function GetCountWhere($table, $array_where = array()){
            $count = 0;
            $this->db->select('count(id) as counts');
            $this->db->from("$table");
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $query = $this->db->get();
            $result = $query->result();
            if ($result[0]->counts > 0) {
                $count = $result[0]->counts;
            }
            return $count;
        }

        public function GetProgram($prog_id){
            $sql = "SELECT (programs.maka_nights+programs.madina_nights) AS nights ,programs_levels.title_ar AS programs_levels_title ,makah_hotel.title_ar as maka_name
						,programs.maka_hotel_id,	programs.madina_hotel_id,programs_seasons.title_ar AS programs_seasons_title, programs.*
					FROM `programs`
					JOIN programs_seasons ON programs_seasons.id = programs.programs_seasons
					JOIN programs_levels ON programs_levels.id = programs.programs_levels
					JOIN maka_madina_hotels as makah_hotel  ON makah_hotel.id = programs.maka_hotel_id

					WHERE programs.id = $prog_id AND programs.active = 1";
            $query = $this->db->query($sql);
            $result = $query->row();

            return $result;
        }

        public function GetallProgramAdvantage($Programs){
            $this->db->select('programs_advantage.title_ar ,programs_advantage.image ');

            $this->db->from('programs_advantage_all');
            $this->db->join('programs_advantage', 'programs_advantage_all.programs_advantage_id = programs_advantage.id');
            $this->db->where("programs_advantage_all.active", 1);
            $this->db->where("programs_advantage_all.programs_id", $Programs);
            $query = $this->db->get();
            return $query->result();
        }

        public function GetclosedRoomsreservation($reservation_id){
            $sql = "SELECT hotel_rooms.title_ar, reservation_closed_rooms.no_of_rooms , hotel_rooms.no_of_bed, programs_rooms_prices.price
                    FROM  `reservation_closed_rooms`
                    JOIN hotel_rooms ON hotel_rooms.id = reservation_closed_rooms.hotel_rooms_id
                    JOIN programs_rooms_prices ON programs_rooms_prices.id = reservation_closed_rooms.programs_rooms_prices_id

                    WHERE reservation_closed_rooms.reservation_id = $reservation_id ";
            $query = $this->db->query($sql);
            $result = $query->result();

            return $result;
        }

        public function reservation_extra_services($reservation_id, $card_or_person, $program_id){
            $sql = "SELECT  `reservation_extra_services`.person_or_card, reservation_extra_services.number_of_traveller, extra_services.title_ar, programs_extra_service.price
                    FROM  `reservation_extra_services`

                    JOIN extra_services ON extra_services.id = reservation_extra_services.extra_services_id
                    JOIN programs_extra_service ON programs_extra_service.extra_service_id = extra_services.id
                    JOIN programs ON programs.id = programs_extra_service.programs_id
                    WHERE reservation_extra_services.reservation_id =$reservation_id and extra_services.person_or_card = $card_or_person
                    and programs.id = $program_id
";
            $query = $this->db->query($sql);
            $result = $query->result();

            return $result;
        }

        public function reservation_extra_services2($reservation_id, $card_or_person){
            $sql = "SELECT  `reservation_extra_services`.person_or_card, reservation_extra_services.number_of_traveller, extra_services.title_ar, programs_extra_service.price
                    FROM  `reservation_extra_services`
                    JOIN extra_services ON extra_services.id = reservation_extra_services.extra_services_id
                    JOIN programs_extra_service ON programs_extra_service.extra_service_id = extra_services.id
                    JOIN programs ON programs.id = programs_extra_service.programs_id
                    WHERE reservation_extra_services.reservation_id =$reservation_id and extra_services.person_or_card = $card_or_person
";
            $query = $this->db->query($sql);
            $result = $query->result();

            return $result;
        }

        public function GetCountprogramsWhere(){
            $count = 0;
            $today = \date("Y-m-d");
            $this->db->select('count(programs.id) as counts');
            $this->db->from('programs');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'programs_flight.flight_reservation_id = flight_reservation.id');
            $this->db->where('programs.active', '1');
            $this->db->where('programs_flight.active', '1');
            $this->db->where('programs.active', "1");
            $this->db->where('flight_reservation.going_date >=', "$today");
            $this->db->group_by('programs.id');

            $query = $this->db->get();
            $result = $query->result();
            if ($result[0]->counts > 0) {
                $count = $result[0]->counts;
            }
            return $count;
        }

        public function GetCountprogramsFlightreservation($programs_id, $flight_reservation_id){
            $count = 0;

            $this->db->select('count(reservation.id) as counts');
            $this->db->from('reservation');
            $this->db->where('reservation.programs_id', "$programs_id");
            $this->db->where('reservation.flight_reservation_id', "$flight_reservation_id");

            $query = $this->db->get();
            $result = $query->result();
            if ($result[0]->counts > 0) {
                $count = $result[0]->counts;
            }
            return $count + 1;
        }

        public function GetProgramDates($prog_id, $flight_reservation_id = 0){
            $today = \date("Y-m-d");
            $this->db->select('flight_reservation.id,(flight_reservation.passenger_num - flight_reservation.passenger_reserved) AS flight_available ,
            programs_flight.flight_reservation_id  ,flight_reservation.going_date  , programs_flight.child_price,
            programs_flight.infant_price ,  programs_flight.id as programs_flight_id');
            $this->db->from('programs');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'programs_flight.flight_reservation_id = flight_reservation.id');
            $this->db->where('programs.active', '1');
            $this->db->where('programs_flight.active', '1');
            $this->db->where('programs.active', "1");
            $this->db->where('programs.id', "$prog_id");
            $this->db->where('flight_reservation.going_date >=', "$today");
            if ($flight_reservation_id > 0) {
                $this->db->where('flight_reservation.id', "$flight_reservation_id");
            }
            $this->db->order_by("flight_reservation.going_date", "ASC");

            $query = $this->db->get();
            $result = $query->result();

            return $result;
        }

        public function GetallProgramRooms_prices($prog_id, $flight_reservation_id = 0){
            $this->db->select('hotel_rooms.title_ar , programs_rooms_prices.*,flight_reservation.going_date');

            $this->db->from('programs_rooms_prices');
            $this->db->join('hotel_rooms', 'programs_rooms_prices.hotel_rooms_id = hotel_rooms.id');
            $this->db->join('programs_flight', 'programs_flight.id = programs_rooms_prices.programs_flight_id');
            $this->db->join('flight_reservation', 'programs_flight.flight_reservation_id = flight_reservation.id');
            $this->db->join('programs', 'programs.id = programs_flight.programs_id');
            $this->db->where("programs_rooms_prices.active", 1);
            $this->db->where('programs_flight.active', "1");
            $this->db->where('programs.active', "1");
            $this->db->where("programs.id", $prog_id);
            if ($flight_reservation_id > 0) {
                $this->db->where('flight_reservation.id', "$flight_reservation_id");
            }

            $this->db->order_by("flight_reservation.going_date", "ASC");
            $query = $this->db->get();
            return $query->result();
//			return $this->db->last_query();
        }

        public function GetWhereWithLimitPagingPrograms($page_index, $per_page){
            $today = \date("Y-m-d");
            $q = "SELECT DISTINCT(programs.id) , `programs`.*
				FROM `programs`
				JOIN `programs_flight` ON `programs_flight`.`programs_id` = `programs`.`id`
				JOIN `flight_reservation` ON `programs_flight`.`flight_reservation_id` = `flight_reservation`.`id`
				WHERE `programs`.`active` = '1'  AND `programs_flight`.`active` = '1'
				AND `flight_reservation`.`active` = '1' AND `flight_reservation`.`going_date` >= '$today'
					ORDER BY `programs`.`this_order` ASC, `programs`.`special_offer` ASC,
					`flight_reservation`.`going_date` ASC

					limit $page_index,$per_page";
            $query = $this->db->query($q);
            return $query->result();
        }

        public function GetProgramPriceRoomNum($program_id, $flight_reservation_id){
            $q = "SELECT hotel_rooms.title_ar , hotel_rooms.no_of_bed as hotel_rooms_bed  , hotel_rooms.id as hotel_rooms_id,programs_rooms_prices.price , (programs_rooms_prices.number_of_rooms - programs_rooms_prices.number_of_rooms_reserved) AS max_room_num ,
						programs_rooms_prices.id AS programs_rooms_prices_id
				FROM hotel_rooms
				JOIN programs_rooms_prices on programs_rooms_prices.hotel_rooms_id = hotel_rooms.id
				JOIN programs_flight ON programs_flight.id = programs_rooms_prices.programs_flight_id
				JOIN programs ON programs.id = programs_flight.programs_id
				JOIN flight_reservation ON flight_reservation.id = programs_flight.flight_reservation_id
				WHERE hotel_rooms.active = 1 AND programs_rooms_prices.active = 1 AND programs_flight.active = 1 AND programs.active = 1
						AND flight_reservation.active = 1 AND programs_flight.programs_id = $program_id AND programs_flight.flight_reservation_id = $flight_reservation_id ";
            $query = $this->db->query($q);
            return $query->result();
        }

        public function programs_extra_service($program_id, $person_or_card){
            $q = "SELECT programs_extra_service.extra_service_id as programs_extra_service_id , programs_extra_service.price ,
						programs_extra_service.extra_service_id ,extra_services.title_ar
				FROM extra_services
				JOIN programs_extra_service on programs_extra_service.extra_service_id = extra_services.id
				WHERE programs_extra_service.active = 1 AND extra_services.active = 1 AND programs_extra_service.programs_id = $program_id
						AND extra_services.person_or_card = $person_or_card";
            $query = $this->db->query($q);
            return $query->result();
        }

        public function GetWhereSearch($programs_seasons, $programs_levels, $going_from_place, $date){
            $today = \date("Y-m-d");

            $start = strtotime("-7 day", strtotime($date));
            $start = date('Y-m-d', $start);
            $end = strtotime("+7 day", strtotime($date));
            $end = date('Y-m-d', $end);

            $this->db->select('programs.*');
            $this->db->from("programs");
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'programs_flight.flight_reservation_id = flight_reservation.id');
            $this->db->where('programs.active', '1');
            $this->db->where('programs_flight.active', '1');
            $this->db->where('flight_reservation.active', '1');

            $this->db->where('flight_reservation.going_date >=', "$today");
            $this->db->where('flight_reservation.going_date >=', "$start");
            $this->db->where('flight_reservation.going_date <=', "$end");
            if ($programs_seasons > 0) {
                $this->db->where("programs.programs_seasons", $programs_seasons);
            }
            if ($programs_levels > 0) {
                $this->db->where("programs.programs_levels", $programs_levels);
            }
            if ($going_from_place > 0) {
                $this->db->where("flight_reservation.going_from_place", $going_from_place);
            }
            $this->db->order_by("programs.this_order", "ASC");
            $this->db->order_by("flight_reservation.going_date", "ASC");
            $this->db->group_by('programs.id');

            $query = $this->db->get();
            return $query->result();
//			return $this->db->last_query();
        }

        public function GetWhere($table, $order, $order_type, $cond = array(), $limit = 0){
            if (count($cond) > 0) {
                foreach ($cond as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            if ($limit > 0) {
                $this->db->limit($limit);
            }
            $this->db->order_by("$order", "$order_type");
            $query = $this->db->get($table);
            return $query->result();
        }

        public function GetWhereNotEqualId($table, $order, $order_type, $cond = array(), $id){
            if (count($cond) > 0) {
                foreach ($cond as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->where("id !=", $id);
            $this->db->order_by("$order", "$order_type");
            $query = $this->db->get($table);
            return $query->result();
        }

        public function addwithTable($table, $array_date = array()){
            $this->db->insert($table, $array_date);
            return $this->db->insert_id();
        }

        public function getSliderPrograms($where_array = array()){
            $today = date("Y-m-d");
            $this->db->select('programs.slider_image as slider_image,programs.id as program_id,programs.no_of_nights as nights,,programs.title_ar as program_title,places.title_ar,programs.price_start_from,'
                    . 'hotels.title_ar as hotel_title,flight_reservation.going_date,flight_reservation.return_date,programs.image,program_flights.id as program_flight_id');
            $this->db->from('haj_umrah_programs as programs');
            $this->db->join('haj_umrah_program_flights as program_flights', 'program_flights.haj_umrah_programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = program_flights.flight_reservation_id');
            $this->db->join('haj_umrah_program_cities', 'programs.id = haj_umrah_program_cities.haj_umrah_programs_id');

            $this->db->join('haj_umrah_program_rooms_prices', 'program_flights.id = haj_umrah_program_rooms_prices.haj_umrah_program_flights_id');

            $this->db->join('places', 'haj_umrah_program_cities.region_id = places.id');
            $this->db->join('haj_umrah_hotels as hotels', 'haj_umrah_program_cities.hotel_id = hotels.id');

            $this->db->where("programs.active", "1");
            $this->db->where("programs.show_in_slider", 1);
            $this->db->where("program_flights.active", "1");
            $this->db->where("flight_reservation.going_date >=", $today);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->order_by("programs.created_at", "DESC");
            $this->db->limit(8);
            $this->db->group_by("programs.id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getPrograms($limit, $offset, $cancel_limit = false, $where_array = array()){
            $today = date("Y-m-d");
            $this->db->select('programs.id as program_id,programs.maka_nights as nights,,programs.title_ar as program_title,programs.price_start_from,'
                    . 'flight_reservation.going_date,programs.image,program_flights.id as program_flight_id');
            $this->db->from('haj_umrah_programs as programs');
            $this->db->join('haj_umrah_program_flights as program_flights', 'program_flights.haj_umrah_programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = program_flights.flight_reservation_id');
            //$this->db->join('programs_cities', 'programs.id = programs_cities.programs_id');

            $this->db->join('haj_umrah_program_rooms_prices', 'program_flights.id = haj_umrah_program_rooms_prices.haj_umrah_program_flights_id');



            //$this->db->join('places', 'programs_cities.places_id = places.id');
            // $this->db->join('maka_madina_hotels as hotels', 'programs_cities.hotel_id = hotels.id');


            $this->db->where("programs.active", "1");
            $this->db->where("program_flights.active", "1");
            $this->db->where("flight_reservation.going_date >=", $today);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->order_by("programs.created_at", "DESC");
            if (!$cancel_limit) {
                $this->db->limit($limit, $offset);
            }
            $this->db->group_by("programs.id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function get_program($program_id){
            $today = date("Y-m-d");
            $this->db->select(
                    'programs.id as program_id,programs.branches_id as program_branches_id,programs.no_of_nights as nights,programs.title_ar as program_title,programs.desc_ar as program_desc,'
                    . 'programs.price_start_from,programs_levels.title_ar AS programs_levels_title,'
                    . 'flight_reservation.going_date,programs.image,program_flights.id as program_flight_id'
            );
            $this->db->from('haj_umrah_programs as programs');
            $this->db->join('haj_umrah_program_flights as program_flights', 'program_flights.haj_umrah_programs_id = programs.id');
            $this->db->join('programs_levels', 'programs_levels.id = programs.programs_levels');
            $this->db->join('flight_reservation', 'flight_reservation.id = program_flights.flight_reservation_id');
            $this->db->where("programs.active", "1");
            $this->db->where("program_flights.active", "1");
            $this->db->where("flight_reservation.going_date >=", $today);
            $this->db->where("programs.active", 1);
            $this->db->where("programs.id", $program_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function get_program_advantages($program_id){
            $this->db->select('programs_advantage.title_ar ,programs_advantage.image');
            $this->db->from('haj_umrah_programs as programs');
            $this->db->join('haj_umrah_program_advantages', 'programs.id = haj_umrah_program_advantages.haj_umrah_programs_id');
            $this->db->join('programs_advantage', 'programs_advantage.id = haj_umrah_program_advantages.programs_advantage_id');
            $this->db->where("programs.active", 1);
            $this->db->where("programs.id", $program_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function get_program_services($program_id){
            $this->db->select('extra_services.title_ar,extra_services.person_or_card');
            $this->db->from('haj_umrah_programs as programs');
            $this->db->join('haj_umrah_program_extra_services', 'programs.id = haj_umrah_program_extra_services.haj_umrah_programs_id');
            $this->db->join('extra_services', 'extra_services.id = haj_umrah_program_extra_services.extra_services_id');
            $this->db->where("programs.id", $program_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function get_program_images($program_id){
            $this->db->select('haj_umrah_programs_slider.image');
            $this->db->from('haj_umrah_programs as programs');
            $this->db->join('haj_umrah_programs_slider', 'haj_umrah_programs_slider.haj_umrah_programs_id = programs.id');
            $this->db->where("programs.active", 1);
            $this->db->where("programs.id", $program_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function get_program_room_prices($program_flight_id){
            $this->db->select('hotel_rooms.title_ar,hotel_rooms.title_en,hotel_rooms.no_of_bed , haj_umrah_program_rooms_prices.*');
            $this->db->from('haj_umrah_program_rooms_prices');
            $this->db->join('hotel_rooms', 'haj_umrah_program_rooms_prices.hotel_rooms_id = hotel_rooms.id');
            $this->db->join('haj_umrah_program_flights', 'haj_umrah_program_rooms_prices.haj_umrah_program_flights_id = haj_umrah_program_flights.id');
            $this->db->where("haj_umrah_program_flights.id", $program_flight_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function get_program_dates($program_id, $program_flight_id = false, $one_date_after_today = false){
            $today = date("Y-m-d");
            $this->db->select('
            flight_reservation.id as flight_reservation_id,program_flights.flight_reservation_id ,
            flight_reservation.going_date , program_flights.child_price,
            program_flights.infant_price ,  program_flights.id as programs_flight_id'
            );
            $this->db->from('haj_umrah_programs as programs');
            $this->db->join('haj_umrah_program_flights as program_flights', 'programs.id = program_flights.haj_umrah_programs_id');
            $this->db->join(' flight_reservation', 'flight_reservation.id = program_flights.flight_reservation_id');
            $this->db->join('haj_umrah_program_rooms_prices', 'program_flights.id = haj_umrah_program_rooms_prices.haj_umrah_program_flights_id');
            $this->db->where("programs.active", 1);
            $this->db->where("flight_reservation.active", 1);
            $this->db->where("program_flights.active", 1);
            $this->db->where("flight_reservation.going_date >=", $today);


            if ($program_flight_id) {
                $this->db->where("programs_flight.id", $program_flight_id);
            } else {
                $this->db->where("programs.id", $program_id);
                $this->db->group_by("programs.id");
            }

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                if ($one_date_after_today) {
                    return $query->row();
                } else {
                    return $query->result();
                }
            } else {
                return 'sss';
            }
        }

        public function programs_cities_hotels($program_id, $get_cities = false){
            $today = date("Y-m-d");
            $this->db->select('haj_umrah_hotels.image as hotel_image,haj_umrah_hotels.title_ar as hotel_title,places.image as place_image,places.title_ar as place_title,'
                    . 'places.desc_ar as place_desc_ar,haj_umrah_hotels.desc_ar as hotel_desc_ar,haj_umrah_hotels.stars as hotel_stars');
            $this->db->from('haj_umrah_programs as programs');
            $this->db->join('haj_umrah_program_cities', 'programs.id = haj_umrah_program_cities.haj_umrah_programs_id');
            $this->db->join('places', 'haj_umrah_program_cities.region_id = places.id');
            $this->db->join('haj_umrah_hotels', 'haj_umrah_program_cities.hotel_id = haj_umrah_hotels.id');
            $this->db->where("programs.active", 1);
            $this->db->where("places.active", 1);
            $this->db->where("haj_umrah_hotels.active", 1);
            $this->db->where("programs.id", $program_id);
            if ($get_cities) {
                $this->db->group_by("haj_umrah_program_cities.region_id");
            }

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function get_offers_reserved_viewed_Programs($type, $where_array = array(), $new_limit = false){
            $today = date("Y-m-d");
            $this->db->select('programs.id as program_id,programs.title_ar as program_title,programs.no_of_nights as nights,places.title_ar,programs.price_start_from,'
                    . 'hotels.title_ar as hotel_title,flight_reservation.going_date,flight_reservation.return_date,'
                    . 'programs.image,program_flights.id as program_flight_id,programs.offer_description');
            $this->db->from('haj_umrah_programs as programs');
            $this->db->join('haj_umrah_program_flights as program_flights', 'program_flights.haj_umrah_programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = program_flights.flight_reservation_id');
            $this->db->join('haj_umrah_program_cities', 'programs.id = haj_umrah_program_cities.haj_umrah_programs_id');
            $this->db->join('haj_umrah_program_rooms_prices', 'program_flights.id = haj_umrah_program_rooms_prices.haj_umrah_program_flights_id');


            $this->db->join('places', 'haj_umrah_program_cities.region_id = places.id');
            $this->db->join('haj_umrah_hotels as hotels', 'haj_umrah_program_cities.hotel_id = hotels.id');

            $this->db->where("program_flights.active", "1");
            $this->db->where("flight_reservation.going_date >=", $today);
            $this->db->where("programs.active", 1);
            if ($type == 'most_viewed') {
                //pri('ssss');
                $this->db->order_by("programs.viewed_no", "DESC");
            }
            if ($type == 'special_offer') {
                //pri('aa');
                $this->db->where("programs.special_offer", 1);
            }
            if ($type == 'most_reserved') {
                //pri('bbb');
                $this->db->order_by("programs.reserved_no", "DESC");
            }
            if ($type == 'last_added') {
                //pri('bbb');
                $this->db->order_by("programs.created_at", "DESC");
            }
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $limit = ($new_limit) ? $new_limit : 8;
            $this->db->group_by("programs.id");
            $this->db->limit($limit);

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function get_offers_reserved_viewed_Programs2($type, $where_array = array(), $new_limit = false){
            $today = date("Y-m-d");
            $this->db->select('programs.id as program_id,programs.title_ar as program_title,programs.maka_nights as nights,places.title_ar,programs.price_start_from,'
                    . 'hotels.title_ar as hotel_title,flight_reservation.going_date,flight_reservation.return_date,'
                    . 'programs.image,programs_flight.id as program_flight_id,programs_flight.offer_description');
            $this->db->from('programs');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join(' maka_madina_hotels as hotels', 'hotels.id = programs.maka_hotel_id');
            $this->db->join('places', 'hotels.places_id = places.id');
            $this->db->where("programs_flight.active", "1");
            $this->db->where("flight_reservation.going_date >=", $today);
            $this->db->where("programs.active", 1);
            if ($type == 'most_viewed') {
                //pri('ssss');
                $this->db->order_by("programs_flight.viewed_no", "DESC");
            }
            if ($type == 'special_offer') {
                //pri('aa');
                $this->db->where("programs_flight.special_offer", 1);
            }
            if ($type == 'most_reserved') {
                //pri('bbb');
                $this->db->order_by("programs_flight.reserved_no", "DESC");
            }
            if ($type == 'last_added') {
                //pri('bbb');
                $this->db->order_by("programs_flight.created_at", "DESC");
            }
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $limit = ($new_limit) ? $new_limit : 8;
            $this->db->limit($limit);
            $this->db->order_by("flight_reservation.going_date", "ASC");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function get_program_id_from_flight($program_flight){
            $this->db->select('programs_id');
            $this->db->from('programs_flight');
            $this->db->where("id", $program_id);
            $this->db->where("active", 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->programs_id;
            } else {
                echo '';
            }
        }

        public function getFlightReservationId($program_flight_id){
            $this->db->select('flight_reservation_id');
            $this->db->from('programs_flight');
            $this->db->where("id", $program_flight_id);
            $this->db->where("active", 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->flight_reservation_id;
            } else {
                echo '';
            }
        }

        public function getCitiesLike($city_name){
            $this->db->select('*');
            $this->db->from('places');

            $this->db->where('place_id !=', 0);
            $this->db->like('title_ar', $city_name);
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getHotelsLike($hotel_name, $whitelabel_id = 0){
            $today = date('Y-m-d');
            $this->db->select('maka_madina_hotels.*,hotels_rooms_prices.from_date,hotels_rooms_prices.to_date');
            $this->db->from('maka_madina_hotels');
            $this->db->join('hotels_rooms_prices', 'maka_madina_hotels.id=hotels_rooms_prices.hotel_id');
            $this->db->where('maka_madina_hotels.active', 1);
            $this->db->where('hotels_rooms_prices.to_date >', $today);
            if ($whitelabel_id > 0) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            $this->db->where('maka_madina_hotels.branches_id', $whitelabel_id);
            $this->db->like('maka_madina_hotels.title_ar', $hotel_name);
            $this->db->group_by('hotels_rooms_prices.hotel_id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getProgramsForFilter($whitelabel_id, $offset = false, $where_array = array(), $filter_array = array(), $new_limit = false){
            $today = date("Y-m-d");
            $this->db->select('programs.id as program_id,programs.maka_nights as nights,,programs.title_ar as program_title,places.title_ar,programs.price_start_from,'
                    . 'hotels.title_ar,flight_reservation.going_date,programs.image,programs_flight.id as program_flight_id');
            $this->db->from('programs');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join('programs_cities', 'programs.id = programs_cities.programs_id');
            $this->db->join('programs_rooms_prices', 'programs_flight.id = programs_rooms_prices.programs_flight_id');


            $this->db->join('places', 'programs_cities.places_id = places.id');
            $this->db->join('maka_madina_hotels as hotels', 'programs_cities.hotel_id = hotels.id');

            $this->db->where("programs.active", "1");
            $this->db->where("programs_flight.active", "1");
            $this->db->where("flight_reservation.going_date >=", $today);
            $this->db->where("programs.active", 1);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            if ($whitelabel_id > 0) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            //pri($filter_array);
            $this->db->where('programs.branches_id', $whitelabel_id);
            if (!empty($filter_array)) {
                if (!empty($filter_array['cities_ids'])) {
                    //pri($filter_array['cities_ids']);
                    $this->db->where_in('programs_cities.places_id', $filter_array['cities_ids']);
                }
                if (!empty($filter_array['hotels_ids'])) {
                    $this->db->where_in('programs_cities.hotel_id', $filter_array['hotels_ids']);
                }
                if (!empty($filter_array['prices'])) {
                    $this->db->where('programs.price_start_from >=', $filter_array['prices']['price_start']);
                    $this->db->where('programs.price_start_from <=', $filter_array['prices']['price_end']);
                }
                if (!empty($filter_array['stars'])) {
                    $this->db->where_in('hotels.stars', $filter_array['stars']);
                }
                if (!empty($filter_array['sort'])) {
                    if ($filter_array['sort']['sort_type'] == 'price_start_from') {
                        $this->db->order_by("programs." . $filter_array['sort']['sort_type'], $filter_array['sort']['sort_value']);
                    } else if ($filter_array['sort']['sort_type'] == 'stars') {
                        $this->db->order_by("hotels." . $filter_array['sort']['sort_type'], $filter_array['sort']['sort_value']);
                    } else {
                        $this->db->order_by("programs.this_order", "ASC");
                        $this->db->order_by("flight_reservation.going_date", "ASC");
                    }
                }
                if (!empty($filter_array['inputs_search'])) {
                    foreach ($filter_array['inputs_search'] as $key => $value) {
                        if ($key == 'p_city') {
                            $this->db->where('places.title_ar', $value);
                        }
                        if ($key == 'p_hotel') {
                            $this->db->where('hotels.title_ar', $value);
                        }
                        if ($key == 'p_arrive_date') {
                            $this->db->where('flight_reservation.going_date <=', $value);
                        }
                        if ($key == 'p_departing_date') {
                            $this->db->where('flight_reservation.going_date >=', $value);
                        }
                    }
                }
            }
            $limit = ($new_limit) ? $new_limit : 6;
            if ($offset) {
                $this->db->limit($limit, $offset);
            } else {
                $this->db->limit($limit);
            }

            $this->db->group_by("programs.id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {

                return $query->result();
            } else {
                return false;
            }
        }

        public function getProgramsForFilter3($whitelabel_id, $offset = false, $where_array = array(), $filter_array = array(), $new_limit = false){
            $today = date("Y-m-d");
            $this->db->select('programs.id as program_id,programs.maka_nights as nights,,programs.title_ar as program_title,places.title_ar,programs.price_start_from,'
                    . 'hotels.title_ar,flight_reservation.going_date,programs.image,programs_flight.id as program_flight_id');
            $this->db->from('programs');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join(' maka_madina_hotels as hotels', 'hotels.id = programs.maka_hotel_id');
            $this->db->join('places', 'hotels.places_id = places.id');
            $this->db->where("programs.active", "1");
            $this->db->where("programs_flight.active", "1");
            $this->db->where("flight_reservation.going_date >=", $today);
            $this->db->where("programs.active", 1);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            if ($whitelabel_id > 0) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            //pri($filter_array);
            $this->db->where('programs.branches_id', $whitelabel_id);
            if (!empty($filter_array)) {
                if (!empty($filter_array['cities_ids'])) {
                    $this->db->where_in('places.id', $filter_array['cities_ids']);
                }
                if (!empty($filter_array['hotels_ids'])) {
                    $this->db->where_in('hotels.id', $filter_array['hotels_ids']);
                }
                if (!empty($filter_array['prices'])) {
                    $this->db->where('programs.price_start_from >=', $filter_array['prices']['price_start']);
                    $this->db->where('programs.price_start_from <=', $filter_array['prices']['price_end']);
                }
                if (!empty($filter_array['stars'])) {
                    $this->db->where_in('hotels.stars', $filter_array['stars']);
                }
                if (!empty($filter_array['sort'])) {
                    if ($filter_array['sort']['sort_type'] == 'price_start_from') {
                        $this->db->order_by("programs." . $filter_array['sort']['sort_type'], $filter_array['sort']['sort_value']);
                    } else if ($filter_array['sort']['sort_type'] == 'stars') {
                        $this->db->order_by("hotels." . $filter_array['sort']['sort_type'], $filter_array['sort']['sort_value']);
                    } else {
                        $this->db->order_by("programs.this_order", "ASC");
                        $this->db->order_by("flight_reservation.going_date", "ASC");
                    }
                }
                if (!empty($filter_array['inputs_search'])) {
                    foreach ($filter_array['inputs_search'] as $key => $value) {
                        if ($key == 'p_city') {
                            $this->db->where('places.title_ar', $value);
                        }
                        if ($key == 'p_hotel') {
                            $this->db->where('hotels.title_ar', $value);
                        }
                        if ($key == 'p_arrive_date') {
                            $this->db->where('flight_reservation.going_date <=', $value);
                        }
                        if ($key == 'p_departing_date') {
                            $this->db->where('flight_reservation.going_date >=', $value);
                        }
                    }
                }
            }
            $limit = ($new_limit) ? $new_limit : 2;
            if ($offset) {
                $this->db->limit($limit, $offset);
            } else {
                $this->db->limit($limit);
            }

            $this->db->group_by("programs_flight.programs_id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {

                return $query->result();
            } else {
                return false;
            }
        }

        public function getProgramsForFilter2($whitelabel_id, $offset = false, $where_array = array(), $cities_ids = array(), $hotels_ids = array(), $prices = array()){
            $today = date("Y-m-d");
            $this->db->select('programs.id as program_id,programs.maka_nights as nights,,programs.title_ar as program_title,places.title_ar,programs.price_start_from,'
                    . 'hotels.title_ar,flight_reservation.going_date,programs.image,programs_flight.id as program_flight_id');
            $this->db->from('programs');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join(' maka_madina_hotels as hotels', 'hotels.id = programs.maka_hotel_id');
            $this->db->join('places', 'hotels.places_id = places.id');
            $this->db->where("programs.active", "1");
            $this->db->where("programs_flight.active", "1");
            $this->db->where("flight_reservation.going_date >=", $today);
            $this->db->where("programs.active", 1);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            if ($whitelabel_id > 0) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            $this->db->where('programs.branches_id', $whitelabel_id);

            if (!empty($cities_ids)) {
                $this->db->where_in('places.id', $cities_ids);
            }
            if (!empty($hotels_ids)) {
                $this->db->where_in('hotels.id', $hotels_ids);
            }
            if (!empty($prices)) {
                $this->db->where('programs.price_start_from >=', $prices['price_start']);
                $this->db->where('programs.price_start_from <=', $prices['price_end']);
            }
            if ($offset) {
                $this->db->limit(2, $offset);
            } else {
                $this->db->limit(2);
            }
            $this->db->order_by("programs.this_order", "ASC");
            $this->db->order_by("flight_reservation.going_date", "ASC");
            $this->db->group_by("programs_flight.programs_id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getProgramsForFilterCount($whitelabel_id, $where_array = array(), $filter_array = array()){
            $today = date("Y-m-d");
            //$this->db->select('count(distinct programs_flight.programs_id) as count');
            $this->db->select('count(distinct programs_flight.programs_id) as count');
            $this->db->from('programs');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join('programs_cities', 'programs.id = programs_cities.programs_id');
            $this->db->join('programs_rooms_prices', 'programs_flight.id = programs_rooms_prices.programs_flight_id');


            $this->db->join('places', 'programs_cities.places_id = places.id');
            $this->db->join('maka_madina_hotels as hotels', 'programs_cities.hotel_id = hotels.id');


            $this->db->where("programs.active", "1");
            $this->db->where("programs_flight.active", "1");
            $this->db->where("flight_reservation.going_date >=", $today);
            $this->db->where("programs.active", 1);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            if ($whitelabel_id > 0) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            $this->db->where('programs.branches_id', $whitelabel_id);
            if (!empty($filter_array)) {
                if (!empty($filter_array['cities_ids'])) {
                    $this->db->where_in('programs_cities.places_id', $filter_array['cities_ids']);
                }
                if (!empty($filter_array['hotels_ids'])) {
                    $this->db->where_in('programs_cities.hotel_id', $filter_array['hotels_ids']);
                }
                if (!empty($filter_array['prices'])) {
                    $this->db->where('programs.price_start_from >=', $filter_array['prices']['price_start']);
                    $this->db->where('programs.price_start_from <=', $filter_array['prices']['price_end']);
                }
                if (!empty($filter_array['stars'])) {
                    $this->db->where_in('hotels.stars', $filter_array['stars']);
                }
                if (!empty($filter_array['sort'])) {
                    if ($filter_array['sort']['sort_type'] == 'price_start_from') {
                        $this->db->order_by("programs." . $filter_array['sort']['sort_type'], $filter_array['sort']['sort_value']);
                    }
                    if ($filter_array['sort']['sort_type'] == 'stars') {
                        $this->db->order_by("hotels." . $filter_array['sort']['sort_type'], $filter_array['sort']['sort_value']);
                    }
                }
                if (!empty($filter_array['inputs_search'])) {
                    foreach ($filter_array['inputs_search'] as $key => $value) {
                        if ($key == 'p_city') {
                            $this->db->where('places.title_ar', $value);
                        }
                        if ($key == 'p_hotel') {
                            $this->db->where('hotels.title_ar', $value);
                        }
                        if ($key == 'p_arrive_date') {
                            $this->db->where('flight_reservation.going_date <=', $value);
                        }
                        if ($key == 'p_departing_date') {
                            $this->db->where('flight_reservation.going_date >=', $value);
                        }
                    }
                }
            }
//            $this->db->order_by("programs.this_order", "ASC");
//            $this->db->order_by("flight_reservation.going_date", "ASC");
            //$this->db->group_by("programs.id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->count;
            } else {
                return false;
            }
        }

        public function getProgramsForFilterCount2($whitelabel_id, $where_array = array(), $filter_array = array()){
            $today = date("Y-m-d");
            $this->db->select('count(distinct programs_flight.programs_id) as count');
            $this->db->from('programs');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join(' maka_madina_hotels as hotels', 'hotels.id = programs.maka_hotel_id');
            $this->db->join('places', 'hotels.places_id = places.id');
            $this->db->where("programs.active", "1");
            $this->db->where("programs_flight.active", "1");
            $this->db->where("flight_reservation.going_date >=", $today);
            $this->db->where("programs.active", 1);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            if ($whitelabel_id > 0) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            $this->db->where('programs.branches_id', $whitelabel_id);
            if (!empty($filter_array)) {
                if (!empty($filter_array['cities_ids'])) {
                    $this->db->where_in('places.id', $filter_array['cities_ids']);
                }
                if (!empty($filter_array['hotels_ids'])) {
                    $this->db->where_in('hotels.id', $filter_array['hotels_ids']);
                }
                if (!empty($filter_array['prices'])) {
                    $this->db->where('programs.price_start_from >=', $filter_array['prices']['price_start']);
                    $this->db->where('programs.price_start_from <=', $filter_array['prices']['price_end']);
                }
                if (!empty($filter_array['stars'])) {
                    $this->db->where_in('hotels.stars', $filter_array['stars']);
                }
                if (!empty($filter_array['sort'])) {
                    if ($filter_array['sort']['sort_type'] == 'price_start_from') {
                        $this->db->order_by("programs." . $filter_array['sort']['sort_type'], $filter_array['sort']['sort_value']);
                    }
                    if ($filter_array['sort']['sort_type'] == 'stars') {
                        $this->db->order_by("hotels." . $filter_array['sort']['sort_type'], $filter_array['sort']['sort_value']);
                    }
                }
                if (!empty($filter_array['inputs_search'])) {
                    foreach ($filter_array['inputs_search'] as $key => $value) {
                        if ($key == 'p_city') {
                            $this->db->where('places.title_ar', $value);
                        }
                        if ($key == 'p_hotel') {
                            $this->db->where('hotels.title_ar', $value);
                        }
                        if ($key == 'p_arrive_date') {
                            $this->db->where('flight_reservation.going_date <=', $value);
                        }
                        if ($key == 'p_departing_date') {
                            $this->db->where('flight_reservation.going_date >=', $value);
                        }
                    }
                }
            }
//            $this->db->order_by("programs.this_order", "ASC");
//            $this->db->order_by("flight_reservation.going_date", "ASC");
            //$this->db->group_by("programs_flight.programs_id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->count;
            } else {
                return false;
            }
        }

        public function getMinMaxPrice($where_array = array()){
            $today = date("Y-m-d");
            $this->db->select('programs.id as program_id,programs.maka_nights as nights,,programs.title_ar as program_title,places.title_ar,programs.price_start_from,'
                    . 'hotels.title_ar,flight_reservation.going_date,programs.image,programs_flight.id as program_flight_id');
            $this->db->from('programs');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join('programs_rooms_prices', 'programs_flight.id = programs_rooms_prices.programs_flight_id');
            $this->db->join(' maka_madina_hotels as hotels', 'hotels.id = programs.maka_hotel_id');
            $this->db->join('places', 'hotels.places_id = places.id');
            $this->db->where("programs.active", "1");
            $this->db->where("programs_flight.active", "1");
            $this->db->where("flight_reservation.going_date >=", $today);
            $this->db->where("programs.active", 1);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->order_by("programs.this_order", "ASC");
            $this->db->order_by("flight_reservation.going_date", "ASC");
            $this->db->group_by("programs_flight.programs_id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function handleMostViewedReservedIncrements($program_id, $type){
            if ($type == 'viewed') {
                $this->db->set('viewed_no', 'viewed_no+1', FALSE);
            }
            if ($type == 'reserved') {
                $this->db->set('reserved_no', 'reserved_no+1', FALSE);
            }

            $this->db->where('id', $program_id);
            $this->db->update('programs'); // gives UPDATE mytable SET field = field+1 WHERE id = 2
        }

    }
