<?php

    class Front_programs_model extends CI_Model{
        public function __construct(){
            parent::__construct();
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

        public function get_offers_reserved_viewed_Programs($type = "by_order", $where_array = array(), $limit = false, $offset = false, $whitelabels_ids = array(), $filter_array = array()){
            $today = date("Y-m-d");
            $this->db->select('programs.special_offer, programs.slider_image as program_slider_image,programs.branches_id as program_branches_id,programs.agaza_desc_ar as program_desc_ar,currency.sign as currency_sign,flight_reservation.flight_type,programs.id as program_id,programs.agaza_title_ar as program_title,programs.maka_nights as nights,places.title_ar,programs.price_start_from,'
                    . 'flight_reservation.going_date,flight_reservation.return_date,'
                    . 'programs.image,programs_flight.id as program_flight_id,programs_flight.offer_description,places.title_ar as place_title_ar,places.title_en as place_title_en,places.id as programs_cities_id, agaza_programs.url as agaza_programs_url, agaza_programs.image_url as agaza_programs_image_url, agaza_programs.slider_url as agaza_programs_slider_url,programs.agaza_image');
            $this->db->from('agaza_programs');
            $this->db->join("programs", "agaza_programs.program_id=programs.id");
            $this->db->join('currency', 'programs.currency_id = currency.id');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join('programs_cities', 'programs.id = programs_cities.programs_id');
            $this->db->join('places', 'agaza_programs.places_id = places.id');
            $this->db->group_start();
            $this->db->where('flight_reservation.flight_type', 1);
            $this->db->where('flight_reservation.going_date >=', $today);
            $this->db->or_group_start();
            $this->db->where('flight_reservation.flight_type', 2);
            $this->db->where('flight_reservation.return_date >=', $today);
            $this->db->group_end();
            $this->db->group_end();
            $this->db->where("programs.show_in_agazabook", 1);
            $this->db->where("flight_reservation.active", 1);
            $this->db->where("programs.active", 1);
            $this->db->where("agaza_programs.is_active", 1);
            if ($type == 'most_viewed') {
                $this->db->order_by("programs.viewed_no", "DESC");
            }
            if ($type == 'special_offer') {
                $this->db->where("programs.special_offer", 1);
            }
            if ($type == 'most_reserved') {
                $this->db->order_by("programs.reserved_no", "DESC");
            }
            if ($type == 'by_order') {
                $this->db->order_by("programs.agaza_this_order", "asc");
            }
            if (count($whitelabels_ids) > 0) {
                $this->db->where_in('programs.branches_id', $whitelabels_ids);
            }
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }


            if (!empty($filter_array)) {
                if (!empty($filter_array['cities_ids'])) {
                    //pri($filter_array['cities_ids']);
                    $this->db->where_in('programs_cities.places_id', $filter_array['cities_ids']);
					$this->db->or_where_in('agaza_programs.places_id', $filter_array['cities_ids']);
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



            if ($limit && $offset) {
                $this->db->limit($limit, $offset);
            }
            if ($limit && !$offset) {
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



        public function getAllAgazaPrograms() {
            
            $today = date("Y-m-d");
            $this->db->select("programs.agaza_title_ar as title_ar, programs.id");
            $this->db->from('agaza_programs');
            $this->db->join("programs", "agaza_programs.program_id=programs.id");
            $this->db->join('currency', 'programs.currency_id = currency.id');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join('programs_cities', 'programs.id = programs_cities.programs_id');
            $this->db->join('places', 'agaza_programs.places_id = places.id');
            $this->db->group_start();
            $this->db->where('flight_reservation.flight_type', 1);
            $this->db->where('flight_reservation.going_date >=', $today);
            $this->db->or_group_start();
            $this->db->where('flight_reservation.flight_type', 2);
            $this->db->where('flight_reservation.return_date >=', $today);
            $this->db->group_end();
            $this->db->group_end();
            $this->db->where("programs.show_in_agazabook", 1);
            $this->db->where("flight_reservation.active", 1);
            $this->db->where("programs.active", 1);
            $this->db->where("agaza_programs.is_active", 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }
          



        public function getProgramsLike($branches_id, $title) {
            $today = date("Y-m-d");
            $this->db->select("programs.agaza_title_ar as title_ar, programs.id");
            $this->db->from("programs");
            $this->db->join("agaza_programs", "agaza_programs.program_id=programs.id");
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->like("programs.agaza_title_ar", $title);
            $this->db->where("agaza_programs.is_active", 1);
            $this->db->where('flight_reservation.going_date >=', $today);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }





public function getCitiesLike($branches_id, $title) {
            
            $this->db->select('*');
            $this->db->from('places');
            $this->db->like("places.title_ar", $title);
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);    
            $this->db->where('place_id <>', 0);            
            $this->db->where('branches_id', $branches_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getIds() {
            $this->db->select('places_id');
            $this->db->from("agaza_programs");
            $this->db->where('is_active', 1);  
            $this->db->distinct();
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        
        }

        public function getProgramsByCity($limit = false, $offset = false, $filter_array = array()) {

            //pri($cities_ids);
            $today = date("Y-m-d");
            $this->db->select('programs.slider_image as program_slider_image,programs.branches_id as program_branches_id,programs.agaza_desc_ar as program_desc_ar,currency.sign as currency_sign,flight_reservation.flight_type,programs.id as program_id,programs.agaza_title_ar as program_title,programs.maka_nights as nights,places.title_ar,programs.price_start_from,'
                    . 'flight_reservation.going_date,flight_reservation.return_date,'
                    . 'programs.image,programs_flight.id as program_flight_id,programs_flight.offer_description,places.title_ar as place_title_ar,places.title_en as place_title_en,places.id as programs_cities_id, agaza_programs.url as agaza_programs_url, agaza_programs.image_url as agaza_programs_image_url, agaza_programs.slider_url as agaza_programs_slider_url,programs.agaza_image');
            $this->db->from('agaza_programs');
            $this->db->join("programs", "agaza_programs.program_id=programs.id");
            $this->db->join('currency', 'programs.currency_id = currency.id');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join('programs_cities', 'programs.id = programs_cities.programs_id');
            $this->db->join('places', 'agaza_programs.places_id = places.id');
            $this->db->group_start();
            $this->db->where('flight_reservation.flight_type', 1);
            $this->db->where('flight_reservation.going_date >=', $today);
            $this->db->or_group_start();
            $this->db->where('flight_reservation.flight_type', 2);
            $this->db->where('flight_reservation.return_date >=', $today);
            $this->db->group_end();
            $this->db->group_end();
            $this->db->where("programs.show_in_agazabook", 1);
            $this->db->where("flight_reservation.active", 1);
            $this->db->where("programs.active", 1);
            $this->db->where("agaza_programs.is_active", 1);
           
            $this->db->order_by("programs.agaza_this_order", "asc");


            if (!empty($filter_array)) {
                if (!empty($filter_array['cities_ids'])) {
                    $cities = $filter_array['cities_ids'];
                    //pri($filter_array['cities_ids']);
                    $this->db->where_in('programs_cities.places_id', $filter_array['cities_ids']);
                    $this->db->or_where("agaza_programs.places_id IN ($cities)");
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

            if($limit && !$offset) {
                $this->db->limit($limit);
            }

            if($limit && $offset) {
                $this->db->limit($limit, $offset);   
            }

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }


        public function getProgramsByProgram($titles = "") {
            $today = date("Y-m-d");
            $this->db->select('programs.slider_image as program_slider_image,programs.branches_id as program_branches_id,programs.agaza_desc_ar as program_desc_ar,currency.sign as currency_sign,flight_reservation.flight_type,programs.id as program_id,programs.agaza_title_ar as program_title,programs.maka_nights as nights,places.title_ar,programs.price_start_from,'
                    . 'flight_reservation.going_date,flight_reservation.return_date,'
                    . 'programs.image,programs_flight.id as program_flight_id,programs_flight.offer_description,places.title_ar as place_title_ar,places.title_en as place_title_en,places.id as programs_cities_id, agaza_programs.url as agaza_programs_url, agaza_programs.image_url as agaza_programs_image_url, agaza_programs.slider_url as agaza_programs_slider_url,programs.agaza_image');
            $this->db->from('agaza_programs');
            $this->db->join("programs", "agaza_programs.program_id=programs.id");
            $this->db->join('currency', 'programs.currency_id = currency.id');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->join('programs_cities', 'programs.id = programs_cities.programs_id');
            $this->db->join('places', 'agaza_programs.places_id = places.id');
            $this->db->group_start();
            $this->db->where('flight_reservation.flight_type', 1);
            $this->db->where('flight_reservation.going_date >=', $today);
            $this->db->or_group_start();
            $this->db->where('flight_reservation.flight_type', 2);
            $this->db->where('flight_reservation.return_date >=', $today);
            $this->db->group_end();
            $this->db->group_end();
            $this->db->where("programs.show_in_agazabook", 1);
            $this->db->where("flight_reservation.active", 1);
            $this->db->where("programs.active", 1);
            $this->db->where("agaza_programs.is_active", 1);
           
            if($titles != "") {
                $this->db->where_in("agaza_programs.program_id", $titles);
            }

            $this->db->limit(12);

            $this->db->group_by("programs.id");


            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }


        public function getMinMaxPrice($where_array = array()) {
        $today = date("Y-m-d");
        $this->db->select('min(programs.price_start_from) as min_price,max(programs.price_start_from) as max_price');
        $this->db->from('programs');
        $this->db->join("agaza_programs", "agaza_programs.program_id=programs.id");
        
        $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
        $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
        $this->db->group_start();
        $this->db->where('flight_reservation.flight_type', 1);
        $this->db->where('flight_reservation.going_date >=', $today);
        $this->db->or_group_start();
        $this->db->where('flight_reservation.flight_type', 2);
        $this->db->where('flight_reservation.return_date >=', $today);
        $this->db->group_end();
        $this->db->group_end();
        $this->db->where("programs.active", "1");
        $this->db->where("programs.is_delete", 0);
        $this->db->where("flight_reservation.active", 1);
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


         public function getCities($places_ids) {
           // pri($restaurants_ids);
            $this->db->select('places.*');
            $this->db->from('places');
            $this->db->where_in('places.id', $places_ids);
            $query = $this->db->get();      
           // pri($query->result())     ;
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }

        }



        public function get_program($program_id){
            $today = date("Y-m-d");
            $this->db->select(
                    'programs.agaza_keywords_ar,programs.category_id,programs.parent_category_id,currency.sign as currency_sign,flight_reservation.flight_type,flight_reservation.return_date,programs.id as program_id,programs.branches_id as program_branches_id,programs.maka_nights as nights,programs.agaza_title_ar as program_title,programs.agaza_desc_ar as program_desc,'
                    . 'programs.agaza_program_include_ar as program_include_ar,programs.price_start_from,programs_levels.title_ar AS programs_levels_title,programs.agaza_image,programs.agaza_keywords_ar,programs.agaza_desc_ar,'
                    . 'flight_reservation.going_date,programs.image,programs.slider_image,programs_flight.id as program_flight_id,agaza_programs.url as agaza_url,agaza_programs.image_url as agaza_image_url, agaza_programs.slider_url as agaza_slider_url,agaza_programs.branches_id as agaza_branch_id'
            );
            $this->db->from('programs');
            $this->db->join("agaza_programs", "agaza_programs.program_id=programs.id");
            $this->db->join('currency', 'programs.currency_id = currency.id');
            $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
            $this->db->join('programs_levels', 'programs_levels.id = programs.programs_levels');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
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
            $this->db->from('programs');
            $this->db->join('programs_advantage_all', 'programs.id = programs_advantage_all.programs_id');
            $this->db->join('programs_advantage', 'programs_advantage.id = programs_advantage_all.programs_advantage_id');
            $this->db->where("programs_advantage.active", 1);
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
            $this->db->from('programs');
            $this->db->join('programs_extra_service', 'programs.id = programs_extra_service.programs_id');
            $this->db->join('extra_services', 'extra_services.id = programs_extra_service.extra_service_id');
            $this->db->where("extra_services.active", 1);
            $this->db->where("programs.active", 1);
            $this->db->where("programs.id", $program_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function get_program_images($program_id){
            $this->db->select('programs_slider.title_ar,programs_slider.image');
            $this->db->from('programs');
            $this->db->join('programs_slider', 'programs_slider.programs_id = programs.id');
            //$this->db->where("programs.active", 1);
            $this->db->where("programs.id", $program_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function get_program_room_prices($program_flight_id){
            $this->db->select('hotel_rooms.title_ar,hotel_rooms.title_en,hotel_rooms.no_of_bed , programs_rooms_prices.*');
            $this->db->from('programs_rooms_prices');
            $this->db->join('hotel_rooms', 'programs_rooms_prices.hotel_rooms_id = hotel_rooms.id');
            $this->db->join('programs_flight', 'programs_rooms_prices.programs_flight_id = programs_flight.id');
            $this->db->where("programs_flight.id", $program_flight_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function get_program_dates($program_id = false, $program_flight_id = false, $one = false){
            $this->db->select('
            programs.id as program_id,flight_reservation.id as flight_reservation_id,programs_flight.flight_reservation_id ,
            flight_reservation.going_date ,flight_reservation.return_date , programs_flight.child_price,
            programs_flight.infant_price,programs_flight.adult_price ,  programs_flight.id as programs_flight_id'
            );
            $this->db->from('programs');
            $this->db->join('programs_flight', 'programs.id = programs_flight.programs_id');
            $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
            $this->db->where("flight_reservation.active", 1);
            if ($program_flight_id) {
                $this->db->where("programs_flight.id", $program_flight_id);
            }
            if ($program_id) {
                $this->db->where("programs.id", $program_id);
            }

            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                if ($one) {
                    return $query->row();
                } else {
                    return $query->result();
                }
            } else {
                return false;
            }
        }

        public function program_cities($program_id){
            $today = date("Y-m-d");
            $this->db->select('places.image as place_image,places.title_ar as place_title,places.desc_ar as place_desc_ar');
            $this->db->from('programs');
            $this->db->join('programs_cities', 'programs.id = programs_cities.programs_id');
            $this->db->join('places', 'programs_cities.places_id = places.id');
            $this->db->where("programs.active", 1);
            $this->db->where("places.active", 1);
            $this->db->where("programs.id", $program_id);
            $this->db->group_by("programs_cities.places_id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function program_hotels($program_id){
            $today = date("Y-m-d");
            $this->db->select('maka_madina_hotels.image as hotel_image,maka_madina_hotels.title_ar as hotel_title,maka_madina_hotels.desc_ar as hotel_desc_ar,maka_madina_hotels.stars as hotel_stars');
            $this->db->from('programs');
            $this->db->join('programs_cities', 'programs.id = programs_cities.programs_id');
            $this->db->join('maka_madina_hotels', 'programs_cities.hotel_id = maka_madina_hotels.id');
            $this->db->where("programs.active", 1);
            $this->db->where("maka_madina_hotels.active", 1);
            $this->db->where("programs.id", $program_id);
            $this->db->group_by("programs_cities.hotel_id");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }






    public function getAllCities($title) {       
        $this->db->select('places.*');
        $this->db->from('places');        
        
        $this->db->where("places.title_ar LIKE '%$title%'");        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllHotels($where_array = array(), $hotel_name = false, $lang = "", $limit = false) {
        $today = date('Y-m-d');
        $this->db->select('maka_madina_hotels.*');
        $this->db->from('maka_madina_hotels');
        $this->db->join('programs_cities', 'maka_madina_hotels.id=programs_cities.hotel_id');
        $this->db->join('programs', 'programs.id=programs_cities.programs_id');
        $this->db->join('places', 'places.id=maka_madina_hotels.places_id');
        $this->db->join('programs_flight', 'programs_flight.programs_id = programs.id');
        $this->db->join('flight_reservation', 'flight_reservation.id = programs_flight.flight_reservation_id');
        if (count($where_array) > 0) {
            foreach ($where_array as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        $this->db->where("programs.active", "1");
        $this->db->where('maka_madina_hotels.active', 1);
        $this->db->where('maka_madina_hotels.is_delete', 0);
        if ($hotel_name) {
            if ($lang == "ar") {
                $this->db->like('maka_madina_hotels.title_ar', $hotel_name);
            } else {
                $this->db->like('maka_madina_hotels.title_en', $hotel_name);
            }
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        $this->db->group_by('programs_cities.hotel_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }




    }
