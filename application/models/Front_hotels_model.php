<?php

    class Front_hotels_model extends CI_Model{

        private $table = 'maka_madina_hotels';
        private $advantages_table = 'hotels_advantage';
        private $images_table = 'maka_madina_hotels_slider';

        public function __construct(){
            parent::__construct();
        }

        public function findByTableAndID($table, $id){
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

        public function getAll($whitelabels_ids, $limit = false, $offset = false, $hotel_name = false, $city_id = false, $filter_array = array()){
            $today = date('Y-m-d');
            $this->db->select('maka_madina_hotels.*,currency.sign as currency_sign,hotels_rooms_prices.from_date,hotels_rooms_prices.to_date');
            $this->db->from('maka_madina_hotels');
            $this->db->join('places p1', 'p1.id=maka_madina_hotels.country_id');
            $this->db->join('places p2', 'p2.id=maka_madina_hotels.places_id');
            $this->db->join('currency', 'currency.id=maka_madina_hotels.currency_id');
            $this->db->join('hotels_rooms_prices', 'maka_madina_hotels.id=hotels_rooms_prices.hotel_id');
            $this->db->join('hotel_advantages', 'maka_madina_hotels.id=hotel_advantages.hotel_id');
            $this->db->where('maka_madina_hotels.active', 1);
            $this->db->where('hotels_rooms_prices.to_date >', $today);
            $this->db->where("maka_madina_hotels.show_in_agazabook", 1);
            if (count($whitelabels_ids) > 0) {
                $this->db->where_in('maka_madina_hotels.branches_id', $whitelabels_ids);
            }
            if ($city_id) {
                $this->db->where('maka_madina_hotels.places_id', $city_id);
            }
            if ($limit && $offset) {

                $this->db->limit($limit, $offset);
            }
            if ($limit && !$offset) {

                $this->db->limit($limit);
            }
            if ($hotel_name) {
                $this->db->like('maka_madina_hotels.title_ar', $hotel_name);
            }
            if (!empty($filter_array)) {
                if (!empty($filter_array['cities_ids'])) {
                    $this->db->where_in('maka_madina_hotels.places_id', $filter_array['cities_ids']);
                }
                if (!empty($filter_array['hotels_ids'])) {
                    $this->db->where_in('maka_madina_hotels.id', $filter_array['hotels_ids']);
                }
                if (!empty($filter_array['stars'])) {
                    $this->db->where_in('maka_madina_hotels.stars', $filter_array['stars']);
                }
                if (!empty($filter_array['advantages_ids'])) {
                    $this->db->where_in('hotel_advantages.hotels_advantage_id', $filter_array['advantages_ids']);
                }
                if (!empty($filter_array['sort'])) {
                    if ($filter_array['sort']['sort_type'] == 'price') { //for price (not now)
                    } else if ($filter_array['sort']['sort_type'] == 'stars') {
                        $this->db->order_by('maka_madina_hotels.stars', $filter_array['sort']['sort_value']);
                    } else {

                    }
                }
                if (!empty($filter_array['inputs_search'])) {
                    foreach ($filter_array['inputs_search'] as $key => $value) {
                        if ($key == 'city_id') {
                            $this->db->where('maka_madina_hotels.places_id', $value);
                        }
                    }
                }
            }
            $this->db->group_by('hotels_rooms_prices.hotel_id');
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function countAll($whitelabels_ids){
            $today = date('Y-m-d');
            $this->db->select('count(distinct hotels_rooms_prices.hotel_id) as count');
            $this->db->from('maka_madina_hotels');
            $this->db->join('hotels_rooms_prices', 'maka_madina_hotels.id=hotels_rooms_prices.hotel_id');
            $this->db->where('maka_madina_hotels.active', 1);
            $this->db->where('hotels_rooms_prices.to_date >', $today);
            if (count($whitelabels_ids) > 0) {
                $this->db->where_in('maka_madina_hotels.branches_id', $whitelabels_ids);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->count;
            } else {
                return false;
            }
        }

        public function getHotelsAdvantages($advantages_ids){
            $this->db->select('*');
            $this->db->from($this->advantages_table);
            $this->db->where('active', '1');
            $this->db->where('is_deleted', 0);
            $this->db->where_in('id', $advantages_ids);
            //$this->db->limit(4);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getHotelsExtraServices($hotel_id){
            $this->db->select('*');
            //$this->db->from('maka_madina_hotels');
            $this->db->from('hotels_extra_services');
            $this->db->join('hotel_extra_services', 'hotels_extra_services.hotel_services_id=hotel_extra_services.id');
            $this->db->where('hotel_extra_services.active', '1');
            $this->db->where('hotel_extra_services.is_deleted', 0);
            $this->db->where('hotels_extra_services.hotel_id', $hotel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getHotelsRoomsPrices($hotel_id){
            $this->db->select('*');
            //$this->db->from('maka_madina_hotels');
            $this->db->from('hotels_rooms_prices');
            $this->db->join('hotel_rooms', 'hotels_rooms_prices.hotel_rooms_id=hotel_rooms.id');
            $this->db->where('hotel_rooms.active', '1');
            $this->db->where('hotel_rooms.is_deleted', 0);
            $this->db->where('hotels_rooms_prices.hotel_id', $hotel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getHotelsRoomsMax($hotel_id, $room_id){
            $this->db->select('*');
            //$this->db->from('maka_madina_hotels');
            $this->db->from('hotels_rooms');
            $this->db->join('hotel_rooms', 'hotel_rooms.id=hotels_rooms.hotel_rooms_id');
            $this->db->where('hotel_rooms.active', '1');
            $this->db->where('hotel_rooms.is_deleted', 0);
            $this->db->where('hotels_rooms.hotel_id', $hotel_id);
            $this->db->where('hotels_rooms.hotel_rooms_id', $room_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getHotelsChaletsPrices($hotel_id){
            $this->db->select('*');
            //$this->db->from('maka_madina_hotels');
            $this->db->from('hotels_extra_services');
            $this->db->join('hotel_extra_services', 'hotels_extra_services.hotel_services_id=hotel_extra_services.id');
            $this->db->where('hotel_extra_services.active', '1');
            $this->db->where('hotel_extra_services.is_deleted', 0);
            $this->db->where('hotels_extra_services.hotel_id', $hotel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getHotelsInCountry($country_id, $hotel_id){
            $this->db->select('*');
            $this->db->from('maka_madina_hotels');
            $this->db->where('active', '1');
            $this->db->where('places_id', $country_id);
            $this->db->where('id !=', $hotel_id);
            $this->db->limit(4);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getHotelCountryAndCity($city_id){
            $this->db->select('p1.id as country_id,p2.id as city_id,p1.title_ar as country_title,p2.title_ar as city_title');
            $this->db->from('places as p2');
            $this->db->join('places as p1', 'p2.place_id = p1.id');
            $this->db->where('p2.id', $city_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function findByTitle($hotel_title, $whitelabel_id = 14){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('active', 1);
            $this->db->where('branches_id', $whitelabel_id);
            $this->db->where('title_ar', $hotel_title);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function findById($id){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('active', 1);
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getHotelsImages($hotel_id){
            $this->db->select('*');
            $this->db->from($this->images_table);
            $this->db->where('active', '1');
            $this->db->where('maka_madina_hotels_id', $hotel_id);
            //$this->db->limit(4);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function countAll2($whitelabel_id = false){
            $this->db->select('count(*) as count');
            $this->db->from($this->table);
            $this->db->where('active', 1);
            if ($whitelabel_id > 0) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            $this->db->where('branches_id', $whitelabel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->count;
            } else {
                return false;
            }
        }

        public function getHotelsForFilter($whitelabels_ids, $offset = false, $filter_array = array(), $city_id = 'all', $new_limit){
            $today = date('Y-m-d');
            $this->db->select('maka_madina_hotels.*,hotels_rooms_prices.from_date,hotels_rooms_prices.to_date');
            $this->db->from('maka_madina_hotels');
            $this->db->join('hotels_rooms_prices', 'maka_madina_hotels.id=hotels_rooms_prices.hotel_id');
            $this->db->where('maka_madina_hotels.active', 1);
            $this->db->where('hotels_rooms_prices.to_date >', $today);
            if (count($whitelabels_ids) > 0) {
                $this->db->where_in('maka_madina_hotels.branches_id', $whitelabels_ids);
            }
            if ($city_id != 'all') {
                $this->db->where('maka_madina_hotels.places_id', $city_id);
            }
            if (!empty($filter_array)) {
                if (!empty($filter_array['cities_ids'])) {
                    $this->db->where_in('maka_madina_hotels.places_id', $filter_array['cities_ids']);
                }
                if (!empty($filter_array['hotels_ids'])) {
                    $this->db->where_in('maka_madina_hotels.id', $filter_array['hotels_ids']);
                }
                if (!empty($filter_array['prices'])) {

                }
                if (!empty($filter_array['stars'])) {
                    $this->db->where_in('maka_madina_hotels.stars', $filter_array['stars']);
                }
                if (!empty($filter_array['advantages_ids'])) {
                    $ids = implode(',', $filter_array['advantages_ids']);
                    $this->db->like('maka_madina_hotels.hotels_advantage_ids', $ids);
                }
                if (!empty($filter_array['sort'])) {
                    if ($filter_array['sort']['sort_type'] == 'price') { //for price (not now)
                    } else if ($filter_array['sort']['sort_type'] == 'stars') {
                        $this->db->order_by('maka_madina_hotels.stars', $filter_array['sort']['sort_value']);
                    } else {

                    }
                }
                if (!empty($filter_array['inputs_search'])) {
                    foreach ($filter_array['inputs_search'] as $key => $value) {
                        if ($key == 'city_id') {
                            $this->db->where('maka_madina_hotels.places_id', $value);
                        }
                    }
                }
            }
            $this->db->group_by('hotels_rooms_prices.hotel_id');
            $limit = ($new_limit) ? $new_limit : 4;
            if ($offset) {
                $this->db->limit($limit, $offset);
            } else {
                $this->db->limit($limit);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getHotelsForFilter2($whitelabel_id = false, $offset = false, $filter_array = array(), $city_id = 'all', $new_limit){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('active', 1);
            if ($whitelabel_id > 0) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            $this->db->where('branches_id', $whitelabel_id);
            if ($city_id != 'all') {
                $this->db->where('places_id', $city_id);
            }
            if (!empty($filter_array)) {
                if (!empty($filter_array['cities_ids'])) {
                    $this->db->where_in('places_id', $filter_array['cities_ids']);
                }
                if (!empty($filter_array['hotels_ids'])) {
                    $this->db->where_in('id', $filter_array['hotels_ids']);
                }
                if (!empty($filter_array['prices'])) {

                }
                if (!empty($filter_array['stars'])) {
                    $this->db->where_in('stars', $filter_array['stars']);
                }
                if (!empty($filter_array['advantages_ids'])) {
                    $ids = implode(',', $filter_array['advantages_ids']);
                    $this->db->like('hotels_advantage_ids', $ids);
                }
                if (!empty($filter_array['sort'])) {
                    if ($filter_array['sort']['sort_type'] == 'price') { //for price (not now)
                    } else if ($filter_array['sort']['sort_type'] == 'stars') {
                        $this->db->order_by($filter_array['sort']['sort_type'], $filter_array['sort']['sort_value']);
                    } else {

                    }
                }
                if (!empty($filter_array['inputs_search'])) {
                    foreach ($filter_array['inputs_search'] as $key => $value) {
                        if ($key == 'city_id') {
                            $this->db->where('places_id', $value);
                        }
                    }
                }
            }

            $limit = ($new_limit) ? $new_limit : 4;
            if ($offset) {
                $this->db->limit($limit, $offset);
            } else {
                $this->db->limit($limit);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getHotelsForFilterCount($whitelabel_id = false, $filter_array = array(), $city_id = 'all'){
            $today = date('Y-m-d');
            $this->db->select('count(distinct hotels_rooms_prices.hotel_id) as count');
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
            if ($city_id != 'all') {
                $this->db->where('maka_madina_hotels.places_id', $city_id);
            }
            if (!empty($filter_array)) {
                if (!empty($filter_array['cities_ids'])) {
                    $this->db->where_in('maka_madina_hotels.places_id', $filter_array['cities_ids']);
                }
                if (!empty($filter_array['hotels_ids'])) {
                    $this->db->where_in('maka_madina_hotels.id', $filter_array['hotels_ids']);
                }
                if (!empty($filter_array['prices'])) {

                }
                if (!empty($filter_array['stars'])) {
                    $this->db->where_in('maka_madina_hotels.stars', $filter_array['stars']);
                }
                if (!empty($filter_array['advantages_ids'])) {
                    $ids = implode(',', $filter_array['advantages_ids']);
                    $this->db->like('maka_madina_hotels.hotels_advantage_ids', $ids);
                }
                if (!empty($filter_array['inputs_search'])) {
                    foreach ($filter_array['inputs_search'] as $key => $value) {
                        if ($key == 'city_id') {
                            $this->db->where('maka_madina_hotels.places_id', $value);
                        }
                    }
                }
            }

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->count;
            } else {
                return false;
            }
        }

        public function getHotelsForFilterCount2($whitelabel_id = false, $filter_array = array(), $city_id = 'all'){
            $this->db->select('count(*) as count');
            $this->db->from($this->table);
            $this->db->where('active', 1);
            if ($whitelabel_id > 0) {
                $whitelabel_id = $whitelabel_id;
            } else {
                $whitelabel_id = 14;
            }
            $this->db->where('branches_id', $whitelabel_id);
            if ($city_id != 'all') {
                $this->db->where('places_id', $city_id);
            }
            if (!empty($filter_array)) {
                if (!empty($filter_array['cities_ids'])) {
                    $this->db->where_in('places_id', $filter_array['cities_ids']);
                }
                if (!empty($filter_array['hotels_ids'])) {
                    $this->db->where_in('id', $filter_array['hotels_ids']);
                }
                if (!empty($filter_array['prices'])) {

                }
                if (!empty($filter_array['stars'])) {
                    $this->db->where_in('stars', $filter_array['stars']);
                }
                if (!empty($filter_array['advantages_ids'])) {
                    $ids = implode(',', $filter_array['advantages_ids']);
                    $this->db->like('hotels_advantage_ids', $ids);
                }
                if (!empty($filter_array['inputs_search'])) {
                    foreach ($filter_array['inputs_search'] as $key => $value) {
                        if ($key == 'city_id') {
                            $this->db->where('places_id', $value);
                        }
                    }
                }
            }

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->count;
            } else {
                return false;
            }
        }

        public function getAllHotelsAdvantages($whitelabel_id = false){
            $this->db->select('*');
            $this->db->from($this->advantages_table);
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

        public function getHotelRoomsMaxAndPrices2($country_id, $hotel_id, $date){
            $this->db->select('*');
            $this->db->from('hotels_rooms_prices');
            $this->db->join('hotel_rooms', 'hotel_rooms.id=hotels_rooms_prices.hotel_rooms_id');
            $this->db->join('hotels_rooms', 'hotels_rooms.hotel_rooms_id=hotel_rooms.id');
            $this->db->where('hotel_rooms.active', '1');
            $this->db->where('hotel_rooms.is_deleted', 0);
            //$this->db->where('hotels_rooms_prices.branches_id', $whitelabel);
            $this->db->where('hotels_rooms_prices.places_id', $country_id);
            $this->db->where('hotels_rooms_prices.hotel_id', $hotel_id);
            $this->db->where('hotels_rooms.hotel_id', $hotel_id);
            $this->db->where('hotels_rooms_prices.from_date <=', $date);
            $this->db->where('hotels_rooms_prices.to_date >=', $date);
            $this->db->where('hotels_rooms_prices.number_of_room >', 'hotels_rooms_prices.number_of_room_reserved');

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
                //return $query->row();
            } else {
                return false;
            }
        }

        public function getHotelRoomsMaxAndPrices($country_id, $hotel_id, $date){
            $this->db->select('id as hotels_rooms_prices_id,hotel_rooms_id,adult_price,child_price');
            //$this->db->from('maka_madina_hotels');
            $this->db->from('hotels_rooms_prices');
            $this->db->where('places_id', $country_id);
            $this->db->where('hotel_id', $hotel_id);
            $this->db->where('from_date <=', $date);
            $this->db->where('to_date >=', $date);
            $this->db->where('number_of_room >', 'number_of_room_reserved');
            //$this->db->where('hotel_rooms_id', 18);

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
                //return $query->row();
            } else {
                return false;
            }
        }

        public function getHotelRooms($country_id, $hotel_id, $date){
            $this->db->select('*');
            //$this->db->from('maka_madina_hotels');
            $this->db->from('hotel_rooms');
            $this->db->join('hotels_rooms_prices', 'hotel_rooms.id=hotels_rooms_prices.hotel_rooms_id');
            $this->db->join('hotels_rooms', 'hotels_rooms.hotel_rooms_id=hotel_rooms.id');
            $this->db->where('hotel_rooms.active', '1');
            $this->db->where('hotel_rooms.is_deleted', 0);
            //$this->db->where('hotel_rooms.branches_id', $whitelabel);
            $this->db->where('hotels_rooms_prices.places_id', $country_id);
            $this->db->where('hotels_rooms_prices.hotel_id', $hotel_id);
            $this->db->where('hotels_rooms.hotel_id', $hotel_id);
            $this->db->where('hotels_rooms_prices.from_date <=', $date);
            $this->db->where('hotels_rooms_prices.to_date >=', $date);
            //$this->db->group_by('hotels_rooms_prices.hotel_rooms_id');


            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getRoomsDatesMinMax($hotel_id){
            $this->db->select('min(p1.from_date) as min_from_date,max(p2.from_date) as max_from_date,min(p3.to_date) as min_to_date,max(p4.to_date) as max_to_date');
            $this->db->from('hotel_rooms');
            $this->db->join('hotels_rooms_prices as p1', 'hotel_rooms.id=p1.hotel_rooms_id');
            $this->db->join('hotels_rooms_prices as p2', 'hotel_rooms.id=p2.hotel_rooms_id');
            $this->db->join('hotels_rooms_prices as p3', 'hotel_rooms.id=p3.hotel_rooms_id');
            $this->db->join('hotels_rooms_prices as p4', 'hotel_rooms.id=p4.hotel_rooms_id');
            $this->db->where('hotel_rooms.active', '1');
            $this->db->where('hotel_rooms.is_deleted', 0);
            //$this->db->where('hotel_rooms.branches_id', $whitelabel);
            $this->db->where('p1.hotel_id', $hotel_id);
            $this->db->where('p2.hotel_id', $hotel_id);
            $this->db->where('p3.hotel_id', $hotel_id);


            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function getHotelsExtraServicesRoomsPersons($hotel_id, $type){
            $this->db->select('*');
            //$this->db->from('maka_madina_hotels');
            $this->db->from('hotels_extra_services');
            $this->db->join('hotel_extra_services', 'hotels_extra_services.hotel_services_id=hotel_extra_services.id');
            $this->db->where('hotel_extra_services.active', '1');
            $this->db->where('hotel_extra_services.is_deleted', 0);
            $this->db->where('hotels_extra_services.hotel_id', $hotel_id);
            if ($type == 'room') {
                $this->db->where('hotel_extra_services.room_or_person', 1);
            }
            if ($type == 'person') {
                $this->db->where('hotel_extra_services.room_or_person', 0);
            }

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function addByTableName($table, $data_array){
            $this->db->insert($table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function updateByTableName($table, $data_array, $where_array){
            $this->db->where($where_array);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->update($table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
            }
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

        public function getHotelReservationRooms($reservation_id){
            $this->db->select('*');
            //$this->db->from('maka_madina_hotels');
            $this->db->from('hotels_reservation_rooms');
            $this->db->join('hotel_rooms', 'hotel_rooms.id=hotels_reservation_rooms.hotel_rooms_id');
            $this->db->join('hotels_rooms_prices', 'hotels_rooms_prices.id=hotels_reservation_rooms.hotels_rooms_prices_id');
            $this->db->where('hotel_rooms.active', '1');
            $this->db->where('hotel_rooms.is_deleted', 0);
            $this->db->where('hotels_reservation_rooms.reservation_id', $reservation_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function reservation_extra_services($reservation_id, $room_or_person, $hotel_id){

            $this->db->select('*');
            $this->db->from('hotels_reservation_extra_services');
            $this->db->join('hotel_extra_services', 'hotel_extra_services.id=hotels_reservation_extra_services.extra_services_id');
            $this->db->join('hotels_extra_services', 'hotels_extra_services.hotel_services_id=hotel_extra_services.id');
            $this->db->where('hotel_extra_services.active', '1');
            $this->db->where('hotel_extra_services.is_deleted', 0);
            $this->db->where('hotel_extra_services.room_or_person', $room_or_person);
            $this->db->where('hotels_reservation_extra_services.reservation_id', $reservation_id);
            $this->db->where('hotels_extra_services.hotel_id', $hotel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

    }
