<?php

    class Front_destinations_model extends CI_Model{

        private $table = 'maka_madina_shrines';

        public function __construct(){
            parent::__construct();
        }

        public function getHoteslCombinedDestibations($section_type, $limit = 6){
            $this->db->select('*');
            $this->db->from('agaza_special_offers');
            $this->db->where('section_type', $section_type);
            $this->db->limit($limit);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getShrinesInCity($city_id, $offset = false){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('places_id', $city_id);
            $this->db->where('active', 1);
            if ($offset) {
                $this->db->limit(6, $offset);
            } else {
                $this->db->limit(6);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getShrinesInCityCount($city_id){
            $this->db->select('count(*) as count');
            $this->db->from($this->table);
            $this->db->where('places_id', $city_id);
            $this->db->where('active', 1);

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row()->count;
            } else {
                return false;
            }
        }

        public function getHotelsInCity($city_id, $whitelabel_id = false, $offset = false){
            $today = date('Y-m-d');
            $this->db->select('maka_madina_hotels.*,hotels_rooms_prices.from_date,hotels_rooms_prices.to_date');
            $this->db->from('maka_madina_hotels');
            $this->db->join('hotels_rooms_prices', 'maka_madina_hotels.id=hotels_rooms_prices.hotel_id');
            $this->db->where('maka_madina_hotels.active', 1);
            $this->db->where('hotels_rooms_prices.to_date >', $today);

            if ($whitelabel_id) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            $this->db->where('maka_madina_hotels.branches_id', $whitelabel_id);
            $this->db->where('maka_madina_hotels.active', 1);
            $this->db->where('maka_madina_hotels.places_id', $city_id);

            if ($offset) {
                $this->db->limit(4, $offset);
            } else {
                $this->db->limit(4);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getShrinesByTitle($shrine_title){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('title_ar', $shrine_title);
            $this->db->where('active', 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getPrograms($offset = false, $where_array = array(), $cancel_limit = false){
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

            if (!$cancel_limit) {
                if ($offset) {
                    $this->db->limit(6, $offset);
                } else {
                    $this->db->limit(6);
                }
            }


            $this->db->group_by("programs.id");
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

    }
