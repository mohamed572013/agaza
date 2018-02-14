<?php

    class Haj_umrah_home_model extends CI_Model{

        private $_table = 'hotels';

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

        public function getAllCities($in_out_egypt = 'all'){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            if ($in_out_egypt == 'all') {
                $this->db->where('place_id !=', 0);
            }
            if ($in_out_egypt == 'in_egypt') {
                $this->db->where('place_id =', 1);
            }
            if ($in_out_egypt == 'out_egypt') {
                $this->db->where('place_id !=', 0);
                $this->db->where('place_id !=', 1);
            }


            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getAllCountries(){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $this->db->where('place_id', 0);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getCountryById($country_id){
            $this->db->select('title_ar');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $this->db->where('id', $country_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row()->title_ar;
            } else {
                return false;
            }
        }

        public function getAllCitiesInCountry($country_id){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $this->db->where('place_id', $country_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getCountryIdByTitle($country_title){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $title_ar = trim($country_title);
            //pri($title_ar);
            $this->db->where('title_ar', $title_ar);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row()->id;
            } else {
                return false;
            }
        }

        public function getCityByTitle($city_title, $place_id){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $title_ar = trim($city_title);
            $this->db->where('title_ar', $title_ar);
            $this->db->where('place_id', $place_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getAllHotels($whitelabel_id = 0){
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
            $this->db->group_by('hotels_rooms_prices.hotel_id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

    }
