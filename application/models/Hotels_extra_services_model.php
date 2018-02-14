<?php

    class Hotels_extra_services_model extends CI_Model{

        private $table = 'hotels_extra_services';

        public function __construct(){
            parent::__construct();
        }

        public function find($hotels_rooms_id){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('id', $hotels_rooms_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function add($array_date = array()){
            $this->db->insert($this->table, $array_date);
            return $this->db->insert_id();
        }

        public function update($data_array = array(), $where_array = array()){
            $this->db->where($where_array);
            if (count($where_array) > 0) {
                foreach ($where_array as $key => $value) {
                    $this->db->where($key, $value);
                }
            }
            $this->db->update($this->table, $data_array);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function delete($where_array = array()){
            $this->db->where($where_array);
            $this->db->delete($this->table);
            $affected_rows = $this->db->affected_rows();
            if ($affected_rows > 0) {
                return true;
            } else {
                return false;
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

        public function getAboutUs($branches_id){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('branches_id', $branches_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

        public function check_added_before($hotel_id, $extra_service_id, $hotels_extra_services_id = false){
            $this->db->select('*');
            $this->db->from('hotels_extra_services');
            $this->db->join('hotel_extra_services', 'hotels_extra_services.hotel_services_id=hotel_extra_services.id');
            if ($hotels_extra_services_id) {
                $this->db->where('hotels_extra_services.id !=', $hotels_extra_services_id);
            }
            $this->db->where('hotels_extra_services.hotel_id', $hotel_id);
            $this->db->where('hotels_extra_services.hotel_services_id', $extra_service_id);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return false;
            }
        }

    }
