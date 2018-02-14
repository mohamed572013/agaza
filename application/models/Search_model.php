<?php

    class Search_model extends CI_Model{
        public function __construct(){
            parent::__construct();
        }

        public function GetHotels($array_where = array()){
            if (isset($array_where) && \count($array_where) > 0) {
                $this->db->where($array_where);
            }
            $this->db->order_by('id', 'ASC');

            $query = $this->db->get($this->_table, 1000);
            return $query->result();
        }

        public function GetHomePrograms($limit = 12){
            $today = \date("Y-m-d");
            $this->db->select('programs.*');
            $this->db->from('programs');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'programs_flight.flight_reservation_id = flight_reservation.id');
            $this->db->where('programs.active', '1');
            $this->db->where('programs_flight.active', '1');
            $this->db->where('programs.active', "1");

            $this->db->where('programs.program_view_in_home', "1");
            $this->db->where('flight_reservation.going_date >=', "$today");

            $this->db->order_by('programs.this_order', 'ASC');
            $this->db->order_by('programs.special_offer', 'DESC');
            $this->db->order_by('flight_reservation.going_date', 'ASC');
            $this->db->group_by('programs.id');
            $this->db->limit($limit);

            $query = $this->db->get();

            return $query->result();
            //  return $this->db->last_query();
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
            if ($this->db->insert($table, $array_date)) {
                return true;
            } else {
                return false;
            }
        }

        public function add($table, $array_date = array()){
            if ($this->db->insert($table, $array_date)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }

        public function findById($table, $id){
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getPrograms($limit, $offset, $cancel_limit = false, $where_array = array()){
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
            $this->db->where("flight_reservation.active", 1);
            $this->db->where("flight_reservation.going_date >=", $today);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->order_by("flight_reservation.going_date", "ASC");
            if (!$cancel_limit) {
                $this->db->limit($limit, $offset);
            }
            $this->db->group_by("programs_flight.programs_id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getPrograms2($limit, $offset, $cancel_limit = false, $where_array = array()){
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
            $this->db->order_by("programs.this_order", "ASC");
            $this->db->order_by("flight_reservation.going_date", "ASC");
            if (!$cancel_limit) {
                $this->db->limit($limit, $offset);
            }
            $this->db->group_by("programs_flight.programs_id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getCitiesLike($title_ar, $branches_id){
            $this->db->select('*');
            $this->db->from('places');

            $this->db->where('place_id !=', 0);
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $this->db->where('branches_id', $branches_id);
            $this->db->like('title_ar', $title_ar);
            //$this->db->like('title_ar', $title_ar);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getAllHotels($title_ar, $places_id, $whitelabel_id){
            $today = date('Y-m-d');
            $this->db->select('maka_madina_hotels.*,hotels_rooms_prices.from_date,hotels_rooms_prices.to_date');
            $this->db->from('maka_madina_hotels');
            $this->db->join('hotels_rooms_prices', 'maka_madina_hotels.id=hotels_rooms_prices.hotel_id');
            $this->db->where('maka_madina_hotels.active', 1);
            $this->db->where('hotels_rooms_prices.to_date >', $today);
            if ($places_id) {
                $this->db->where('maka_madina_hotels.places_id', $places_id);
            }
            if ($title_ar) {
                $this->db->like('maka_madina_hotels.title_ar', $title_ar);
            }
            $this->db->where('maka_madina_hotels.branches_id', $whitelabel_id);
            $this->db->group_by('hotels_rooms_prices.hotel_id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getHotelsLike($title_ar, $branches_id){
            $this->db->select('*');
            $this->db->from('maka_madina_hotels');
            $this->db->where('branches_id', $branches_id);
            $this->db->where('active', 1);
            $this->db->like('title_ar', $title_ar, 'after');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getCitiesByTitle($title_ar){
            $this->db->select('*');
            $this->db->from('places');

            $this->db->where('place_id !=', 0);
            $this->db->where('title_ar', $title_ar);
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $query = $this->db->get();
            //pri($this->db->last_query());
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getCityById($city_id){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('id', $city_id);
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $query = $this->db->get();
            //pri($this->db->last_query());
            if ($query->num_rows() > 0) {
                return $query->row()->title_ar;
            } else {
                return '';
            }
        }

        public function getCityByTitle($city_id, $branches_id){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('title_ar', $city_id);
            $this->db->where('branches_id', $branches_id);
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $query = $this->db->get();
            //pri($this->db->last_query());
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getHotelsByTitle($title_ar, $whitelabel_id = false){
            $this->db->select('*');
            $this->db->from('maka_madina_hotels');
            $this->db->where('active', 1);
            if ($whitelabel_id) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            $this->db->where('title_ar', $title_ar);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getHotelsInCity($city_id, $whitelabel_id = false, $offset = false){
            $this->db->select('*');
            $this->db->from('maka_madina_hotels');

            if ($whitelabel_id) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            $this->db->where('branches_id', $whitelabel_id);
            $this->db->where('active', 1);
            $this->db->where('places_id', $city_id);

            if ($offset) {
                $this->db->limit(2, $offset);
            } else {
                $this->db->limit(2);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getAllHotelsInCity($city_id, $whitelabel_id){
            $this->db->select('*');
            $this->db->from('maka_madina_hotels');
            $this->db->where('branches_id', $whitelabel_id);
            $this->db->where('active', 1);
            $this->db->where('places_id', $city_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function countAllInCity($city_id, $whitelabel_id = false){
            $this->db->select('count(*) as count');
            $this->db->from('maka_madina_hotels');
            $this->db->where('active', 1);
            if ($whitelabel_id) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            $this->db->where('branches_id', $whitelabel_id);
            $this->db->where('places_id', $city_id);
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
            $this->db->join('programs_cities', 'programs.id = programs_cities.programs_id');
            $this->db->join('programs_rooms_prices', 'programs_flight.id = programs_rooms_prices.programs_flight_id');
            $this->db->join('places', 'programs_cities.places_id = places.id');
            $this->db->join('maka_madina_hotels as hotels', 'programs_cities.hotel_id = hotels.id');
            $this->db->where("programs.active", "1");
            $this->db->where("programs_flight.active", "1");
            $this->db->where("flight_reservation.active", 1);
            $this->db->where("flight_reservation.going_date >=", $today);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->group_by("programs_flight.programs_id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getAllHotelsAdvantages($whitelabel_id = false){
            $this->db->select('*');
            $this->db->from('hotels_advantage');
            $this->db->where('active', '1');
            $this->db->where('is_deleted', 0);
            if ($whitelabel_id > 0) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            $this->db->where('branches_id', $whitelabel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getSearchedHotel($hotel_id, $where_array = array()){
            $today = date('Y-m-d');
            $this->db->select('maka_madina_hotels.*');
            $this->db->from('maka_madina_hotels');
            $this->db->join('hotels_rooms_prices', 'maka_madina_hotels.id=hotels_rooms_prices.hotel_id');
            $this->db->join('hotel_rooms', 'hotels_rooms_prices.hotel_rooms_id=hotel_rooms.id');
            $this->db->join('hotels_rooms', 'hotel_rooms.id=hotels_rooms.hotel_rooms_id');
            $this->db->where('hotel_rooms.active', '1');
            $this->db->where('hotel_rooms.is_deleted', 0);
            $this->db->where('maka_madina_hotels.id', $hotel_id);
            $this->db->where('hotels_rooms_prices.to_date >', $today);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

    }
