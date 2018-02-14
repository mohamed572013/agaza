<?php

    class Home_model extends CI_Model{

        private $_table = 'hotels';

        public function __construct(){
            parent::__construct();
        }

        public function getHoteslCombinedDestibations($branches_id, $section_type, $limit = 6){
            $this->db->select('*');
            $this->db->from('agaza_special_offers');
            $this->db->where('section_type', $section_type);
            $this->db->where('branches_id', $branches_id);
            $this->db->limit($limit);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }
		
		
		public function set_global_sql() {
			$query = $this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
			$result = $query->result();
		}

        public function getSettings($branches_id){
            $this->db->select('*');
            $this->db->from('branches_settings');
            $this->db->where('branches_id', $branches_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
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

        public function getWhere($table, $order, $order_type, $cond = array(), $limit = 0){
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
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
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

        public function add($table, $data_array = array()){
            $this->db->insert($table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }

        public function getAllCountries($whitelabel_id){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $this->db->where('place_id', 0);
            $this->db->where('branches_id', $whitelabel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getCountryById($country_id){
            $this->db->select('title_ar,title_en');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $this->db->where('id', $country_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getAllCitiesInCountry($country_id, $whitelabel_id){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $this->db->where('place_id', $country_id);
            $this->db->where('branches_id', $whitelabel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getCountryIdByTitle($country_title, $whitelabel_id){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $title_ar = trim($country_title);
            //pri($title_ar);
            $this->db->where('title_ar', $title_ar);
            $this->db->where('branches_id', $whitelabel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row()->id;
            } else {
                return false;
            }
        }

        public function getCityByTitle($city_title, $place_id, $whitelabel_id){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $title_ar = trim($city_title);
            $this->db->where('title_ar', $title_ar);
            $this->db->where('place_id', $place_id);
            $this->db->where('branches_id', $whitelabel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getCityById($city_id){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $this->db->where('id', $city_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getAllCities($whitelabels_ids, $limit = false){
            $whitelabels_ids = implode(',', $whitelabels_ids);
            $sql = "select * from places where branches_id in ($whitelabels_ids) and place_id in (select id from places where place_id=0 and branches_id in ($whitelabels_ids)) ";
            if ($limit) {
                $sql.='limit 6';
            }
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getAllHotels($whitelabels_ids){
            $today = date('Y-m-d');
            $this->db->select('maka_madina_hotels.*');
            $this->db->from('maka_madina_hotels');
            $this->db->join('programs_cities', 'maka_madina_hotels.id=programs_cities.hotel_id');
            $this->db->join('programs', 'programs.id=programs_cities.programs_id');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join('programs_rooms_prices', 'programs_flight.id = programs_rooms_prices.programs_flight_id');
            $this->db->group_start();
            $this->db->where('flight_reservation.flight_type', 1);
            $this->db->where('flight_reservation.going_date >=', $today);
            $this->db->or_group_start();
            $this->db->where('flight_reservation.flight_type', 2);
            $this->db->where('flight_reservation.return_date >=', $today);
            $this->db->group_end();
            $this->db->group_end();
            $this->db->where("programs.active", "1");
            $this->db->where('maka_madina_hotels.active', 1);
            $this->db->where_in('programs.branches_id', $whitelabels_ids);
            $this->db->group_by('programs_cities.hotel_id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

    }
