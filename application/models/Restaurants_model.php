<?php

    class Restaurants_model extends CI_Model{

        private $_table = 'restaurants';
        public $images_dimensions = array(
            'm' => array('width' => '267', 'height' => 200),
            'l' => array('width' => '848', 'height' => 464),
            's' => array('width' => '170', 'height' => 93),
        );

        public function __construct(){
            parent::__construct();
        }

        public function findById($id){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('id', $id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }


        // mhmud start

        public function getAllActiveRestaurants($branches_id, $limit = false, $offset = false){
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('branches_id', $branches_id);
            $this->db->where('is_active', 1);
            $this->db->order_by("the_order", "asc");

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



        public function getRestaurantFeatures($restaurant_id) {
            $this->db->select('restaurant_features.title_ar');
            $this->db->from("restaurants_features_all");
            $this->db->join("restaurants_features_all", "restaurants_features_all.feature_id = restaurant_features.id");            
            $this->db->where('restaurants_features_all.restaurant_id', $restaurant_id);            
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getRestaurantSlider($id) {
            $this->db->select('*');
            $this->db->from("restaurants_images");
            $this->db->where('restaurant_id', $id);
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

        public function getRestaurantsByCity($cities, $branches_id, $limit = false, $offset = false) {

            //pri($cities_ids);
            $this->db->select('restaurants.*');
            $this->db->from($this->_table);
            $this->db->join("places", "places.id=restaurants.places_id");
            $this->db->where('restaurants.branches_id', $branches_id);
            $this->db->where('restaurants.is_active', 1);
            if($cities) {
                $cities_ids = array_keys($cities);                
                $this->db->where_in('places.id', $cities_ids);
            }
			$this->db->distinct();
            $this->db->order_by("restaurants.the_order", "asc");

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




        public function getRestaurantsByCitySidebar($branches_id, $cities, $limit = false, $offset = false) {
            $this->db->select('restaurants.*');
            $this->db->from($this->_table);
            $this->db->join("places", "places.id=restaurants.places_id");
            $this->db->where('restaurants.branches_id', $branches_id);
            $this->db->where('restaurants.is_active', 1);
            if($cities) {
                $cities_ids = array_keys($cities);                            
                $this->db->where_in('restaurants.places_id', $cities_ids);                
            }
			$this->db->distinct();
            $this->db->order_by("restaurants.the_order", "asc");

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


        public function getRestaurantsByTitle($restaurants, $branches_id, $limit = false, $offset = false) {
            

            $this->db->select('restaurants.*');
            $this->db->from($this->_table);
            $this->db->where('restaurants.branches_id', $branches_id);
            $this->db->where('restaurants.is_active', 1);

            if($restaurants) {
                $restaurants_ids = array_keys($restaurants);
                $this->db->where_in('restaurants.id', $restaurants_ids);
            }
			$this->db->distinct();
            
            $this->db->order_by("restaurants.the_order", "asc");

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




        public function getRestaurantLike($branches_id, $title) {

            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->like("restaurants.title_ar", $title);
            $this->db->where('is_active', 1);             
            $this->db->where('branches_id', $branches_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getIds($branches_id) {
            $this->db->select('places_id');
            $this->db->from($this->_table);
            $this->db->where('is_active', 1);           
            $this->db->where('branches_id', $branches_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function getAllTitles($branches_id) {
            $this->db->select('id,title_ar');
            $this->db->from($this->_table);
            $this->db->where('is_active', 1);           
            $this->db->where('branches_id', $branches_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }




        public function getCities($branches_id, $restaurants_ids) {
           // pri($restaurants_ids);
            $this->db->select('places.*');
            $this->db->from('places');
            $this->db->where_in('places.id', $restaurants_ids);
            $query = $this->db->get();      
           // pri($query->result())     ;
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }

        }

        public function getAllTags($branches_id) {
            $this->db->select('*');
            $this->db->from("restaurants_tags");        
            $this->db->where('branches_id', $branches_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }


        public function getRestaurantsByTags($branches_id, $tags, $limit = false, $offset = false) {

            //pri($tags_ids);
            $this->db->select('restaurants.*');            
            $this->db->from($this->_table);
            $this->db->join("restaurants_tags_all", "restaurants.id = restaurants_tags_all.restaurant_id");
            //$this->db->join("restaurants_tags", "restaurants_tags.restaurant_id = restaurants.id");
            
            $this->db->where('restaurants.branches_id', $branches_id);
            $this->db->where('restaurants.is_active', 1);
            if($tags) {
                $tags_ids = array_keys($tags);
                $this->db->where_in('restaurants_tags_all.tag_id', $tags_ids);
            }
			$this->db->distinct();
            $this->db->order_by("restaurants.the_order", "asc");

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




        // end mhmud







        // 

        public function places($branches_id){
            $this->db->select('*');
            $this->db->from('places');
            $this->db->where('active', 1);
            $this->db->where('is_delete', 0);
            $this->db->where('place_id', 0);
            $this->db->where('branches_id', $branches_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return false;
            }
        }

        public function GetWhere($table, $order, $order_type, $cond = array()){
            if (count($cond) > 0) {
                foreach ($cond as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->order_by("$order", "$order_type");
            $query = $this->db->get($table);
            return $query->result();
        }

        public function findForDelete($hotel_id, $table){
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where('hotel_id', $hotel_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return true;
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

        public function add($data_array){
            $this->db->insert($this->_table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }

        public function update($data_array = array(), $where_array = array()){
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->update($this->_table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function delete($where_array = array()){
            $this->db->where($where_array);
            $this->db->delete($this->_table);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function do_upload2($image, $path){
            $this->load->library('upload');

            $config['upload_path'] = './' . $path;
            $config['allowed_types'] = 'gif|jpeg|jpg|png';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload($image)) {
                return FALSE;
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->resize_image($data['upload_data']['full_path'], $data['upload_data']['file_name'], $path);

                return $data['upload_data']['file_name'];
            }
        }

        public function do_upload($image, $config, $new_path){
            $this->load->library('upload');
            $this->upload->initialize($config);
            if (!$this->upload->do_upload($image)) {
                return FALSE;
            } else {
                $data = $this->upload->data();
                $file_resized_name = resize5($data, $new_path, $this->images_dimensions, true);
                return $file_resized_name;
            }
        }

        public function resize_image($path, $file, $p){
            $this->load->library('image_lib');
            $this->image_lib->clear();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $path;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 400;
            $config['height'] = 400;
            $config['new_image'] = './' . $p . $file;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

    }
